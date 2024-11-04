<?php
/**
 * Handles global IP functionalities including allow and block lists.
 *
 * @package    WP_Defender\Component\IP
 */

namespace WP_Defender\Component\IP;

use WP_Error;
use Exception;
use WP_Defender\Component;
use WP_Defender\Behavior\WPMUDEV;
use WP_Defender\Controller\Firewall;
use WP_Defender\Model\Setting\Global_Ip_Lockout;
use WP_Defender\Traits\Defender_Dashboard_Client;

/**
 * Handles global IP functionalities including allow and block lists.
 */
class Global_IP extends Component {

	use Defender_Dashboard_Client;

	/**
	 * Global IP list key.
	 */
	public const LIST_KEY                  = 'wpdef_global_ip_list';
	public const DASHBOARD_NOTICE_REMINDER = 'wpdef_global_ip_dashoard_notice_reminder';

	/**
	 * The list of allowed IPs.
	 *
	 * @var array
	 */
	private $allow_list = array();

	/**
	 * The list of blocked IPs.
	 *
	 * @var array
	 */
	private $block_list = array();

	/**
	 * Fetches data from HUB API service method.
	 *
	 * @var array
	 */
	private $global_list = array();

	/**
	 * Instance of WPMUDEV class.
	 *
	 * @var WPMUDEV
	 */
	private $wpmudev;

	/**
	 * The model for global IP lockout settings.
	 *
	 * @var Global_Ip_Lockout
	 */
	protected $model;

	/**
	 * Initializes the WPMUDEV and Global_Ip_Lockout instances and sets up the initial state.
	 */
	public function __construct() {
		$this->wpmudev = wd_di()->get( WPMUDEV::class );
		$this->model   = wd_di()->get( Global_Ip_Lockout::class );
		$this->init();
	}

	/**
	 * Initialize
	 *
	 * @return void
	 */
	public function init(): void {
		$global_ip_list = $this->get_global_ip_list();

		$this->global_list = is_array( $global_ip_list ) ? $global_ip_list : array();
		$this->allow_list  = $global_ip_list['allow_list'] ?? array();
		$this->block_list  = $global_ip_list['block_list'] ?? array();
	}

	/**
	 * Return global ip allow list from HUB.
	 */
	public function allow_list(): array {
		return $this->allow_list;
	}

	/**
	 * Return global ip block list from HUB.
	 */
	public function block_list(): array {
		return $this->block_list;
	}

	/**
	 * Verify is given ip exists in global IP allow list.
	 *
	 * @param  string $ip  ip address.
	 *
	 * @return bool if exists return true else false.
	 */
	public function is_ip_allowed( string $ip ): bool {
		return $this->is_ip_in_format( $ip, $this->allow_list() );
	}

	/**
	 * Verify is given ip exists in global IP block list.
	 *
	 * @param  string $ip  ip address.
	 *
	 * @return bool if exists return true else false.
	 */
	public function is_ip_blocked( string $ip ): bool {
		return $this->is_ip_in_format( $ip, $this->block_list() );
	}

	/**
	 * Check if Global IP is enabled.
	 *
	 * @return bool True for enabled or false for disabled.
	 */
	public function is_global_ip_enabled(): bool {
		return $this->model->enabled;
	}

	/**
	 * Check if Blacklist Auto sync is enabled.
	 *
	 * @return bool True for enabled or false for disabled.
	 */
	public function is_blocklist_autosync_enabled(): bool {
		return $this->model->blocklist_autosync;
	}

	/**
	 * Check if permanently blocked IPs can be synced with HUB.
	 *
	 * @return bool
	 */
	public function can_blocklist_autosync(): bool {
		return $this->wpmudev->is_dash_activated() &&
				$this->wpmudev->is_site_connected_to_hub() &&
				$this->is_global_ip_enabled() &&
				$this->is_blocklist_autosync_enabled();
	}

	/**
	 * Get Global IP list from DB.
	 *
	 * @return mixed
	 */
	public function get_global_ip_list() {
		return get_site_transient( self::LIST_KEY );
	}

	/**
	 * Set Global IP list.
	 *
	 * @param  array $data  The data containing the allow list, block list, last update time, and last update time UTC.
	 *
	 * @return bool|WP_Error
	 */
	public function set_global_ip_list( array $data ) {
		if (
			! isset( $data['allow_list'] ) ||
			! isset( $data['block_list'] ) ||
			! isset( $data['last_update_time'] ) ||
			! isset( $data['last_update_time_utc'] )
		) {
			return new WP_Error( 'defender_hub_api_missing_params', esc_html__( 'Missing parameter(s)', 'defender-security' ) );
		}

		$allow_list = array();
		$block_list = array();
		$errors     = array(
			'allow_list' => array(),
			'block_list' => array(),
		);

		if ( is_array( $data['allow_list'] ) ) {
			foreach ( $data['allow_list'] as $key => $ip ) {
				$error = $this->display_validation_message( $ip );

				if ( ! empty( $error ) ) {
					$errors['allow_list'] = array_merge( $error, $errors['allow_list'] );
					unset( $data['allow_list'][ $key ] );
				}
			}
			$allow_list = $data['allow_list'];
		}

		if ( is_array( $data['block_list'] ) ) {
			foreach ( $data['block_list'] as $key => $ip ) {
				$error = $this->display_validation_message( $ip );

				if ( ! empty( $error ) ) {
					$errors['block_list'] = array_merge( $error, $errors['block_list'] );
					unset( $data['block_list'][ $key ] );
				}
			}
			$block_list = $data['block_list'];
		}

		$value             = array(
			'allow_list'           => $allow_list,
			'block_list'           => $block_list,
			'last_update_time'     => $data['last_update_time'] ?? '',
			'last_update_time_utc' => $data['last_update_time_utc'] ?? '',
		);
		$ret               = set_site_transient( self::LIST_KEY, $value );
		$this->global_list = $value;
		$this->allow_list  = $value['allow_list'];
		$this->block_list  = $value['block_list'];

		if ( ! empty( $errors['allow_list'] ) || ! empty( $errors['block_list'] ) ) {
			return new WP_Error( 'defender_hub_api_invalid_ips', esc_html__( 'Invalid IP(s)', 'defender-security' ), $errors );
		} else {
			return $ret;
		}
	}

	/**
	 * Format Global IP list for frontend.
	 *
	 * @return array
	 */
	public function get_formated_global_ip_list(): array {
		$data = $this->global_list;

		return array(
			'allow_list'           => ! empty( $data['allow_list'] ) && is_array( $data['allow_list'] ) ?
				implode( '<br>', $data['allow_list'] ) :
				'',
			'block_list'           => ! empty( $data['block_list'] ) && is_array( $data['block_list'] ) ?
				implode( '<br>', $data['block_list'] ) :
				'',
			'last_update_time_utc' => ! empty( $data['last_update_time_utc'] ) ?
				$this->format_date_time( $data['last_update_time_utc'] ) :
				esc_html__( 'Never', 'defender-security' ),
			'last_update_time'     => ! empty( $data['last_update_time'] ) ?
				$this->format_date_time( $data['last_update_time'] ) :
				esc_html__( 'Never', 'defender-security' ),
			'is_synced_before'     => ! empty( $data ),
		);
	}

	/**
	 * Fetch Global IP list from HUB if DB has old data.
	 *
	 * @return array|WP_Error On success return global ip list or on failure return WP_Error object.
	 */
	public function fetch_global_ip_list() {
		$data = $this->get_global_ip_list();

		if ( ! is_array( $data ) ) {
			$this->attach_behavior( WPMUDEV::class, WPMUDEV::class );

			try {
				$data = $this->make_wpmu_free_request( WPMUDEV::API_GLOBAL_IP_LIST );
			} catch ( Exception $e ) {
				return new WP_Error( 'defender_hub_api_invalid_returned', $e->getMessage() );
			}

			if ( is_array( $data ) ) {
				$this->set_global_ip_list( $data );
			}
		} else {
			$updated_time = $this->fetch_global_ip_list_updated_time();

			if (
				is_wp_error( $updated_time ) ||
				empty( $updated_time['last_update_time_utc'] ) ||
				empty( $data['last_update_time_utc'] ) ||
				strtotime( $updated_time['last_update_time_utc'] ) > strtotime( $data['last_update_time_utc'] )
			) {
				$this->attach_behavior( WPMUDEV::class, WPMUDEV::class );

				try {
					$data = $this->make_wpmu_free_request( WPMUDEV::API_GLOBAL_IP_LIST );
				} catch ( Exception $e ) {
					return new WP_Error( 'defender_hub_api_invalid_returned', $e->getMessage() );
				}

				if ( is_array( $data ) ) {
					$this->set_global_ip_list( $data );
				}
			}
		}

		if ( ! is_array( $data ) ) {
			$this->log( 'Global IP API Error: Fetch Global IP list', Firewall::FIREWALL_LOG );
			$this->log( $data, Firewall::FIREWALL_LOG );

			return new WP_Error(
				'defender_hub_api_invalid_returned',
				esc_html__( 'API returned invalid data format.', 'defender-security' )
			);
		}

		return $data;
	}

	/**
	 * Fetch Global IP list updated time from HUB.
	 *
	 * @return array|WP_Error
	 */
	public function fetch_global_ip_list_updated_time() {
		$this->attach_behavior( WPMUDEV::class, WPMUDEV::class );

		return $this->make_wpmu_request(
			WPMUDEV::API_GLOBAL_IP_LIST,
			array(
				'_fields' => 'last_update_time_utc',
			)
		);
	}

	/**
	 * Add one or more IPs to the allow_list and/or block_list.
	 *
	 * @param  array $params  The IPs to add.
	 *
	 * @return array|WP_Error
	 */
	public function add_to_global_ip_list( array $params ) {
		$is_allow_list = ! empty( $params['allow_list'] );
		$is_block_list = ! empty( $params['block_list'] );
		if ( ! $is_allow_list && ! $is_block_list ) {
			return new WP_Error(
				'global_ip_invalid_params',
				esc_html__( 'Invalid Global IP parameter(s) provided.', 'defender-security' )
			);
		}

		$data = array();
		if ( $is_allow_list ) {
			$data['allow_list'] = (array) $params['allow_list'];
		}
		if ( $is_block_list ) {
			$data['block_list'] = (array) $params['block_list'];
		}

		$this->attach_behavior( WPMUDEV::class, WPMUDEV::class );
		$ret = $this->make_wpmu_request(
			WPMUDEV::API_GLOBAL_IP_LIST,
			$data,
			array(
				'method' => 'POST',
			)
		);

		if ( is_array( $ret ) ) {
			$this->set_global_ip_list( $ret );
		} else {
			$this->log( 'Global IP API Error: Add IP(s) to allow_list and/or block_list', Firewall::FIREWALL_LOG );
			$this->log( $ret, Firewall::FIREWALL_LOG );
		}

		return $ret;
	}

	/**
	 * Get welcome modal closed timestamp.
	 *
	 * @return false|int
	 */
	public function get_dashboard_notice_reminder() {
		return get_site_option( self::DASHBOARD_NOTICE_REMINDER, false );
	}

	/**
	 * Delete welcome modal closed timestamp.
	 *
	 * @return void
	 */
	public function delete_dashboard_notice_reminder(): void {
		delete_site_option( self::DASHBOARD_NOTICE_REMINDER );
	}

	/**
	 * Check if notice on Defender dashboard can be displayed.
	 *
	 * @return bool
	 */
	public function is_show_dashboard_notice(): bool {
		$reminder = $this->get_dashboard_notice_reminder();
		if ( $this->is_global_ip_enabled() || empty( $reminder ) || time() < $reminder ) {
			return false;
		}

		$is_pro     = $this->wpmudev->is_pro();
		$user_roles = is_user_logged_in() ? $this->get_roles( wp_get_current_user() ) : array();

		$is_show_to_user = false;
		if ( ! $is_pro && ! empty(
			array_intersect(
				$user_roles,
				array(
					$this->super_admin_slug,
					'administrator',
				)
			)
		) ) {
			$is_show_to_user = true;
		} elseif ( $is_pro && $this->is_wpmu_dev_admin() ) {
			$is_show_to_user = true;
		}

		return $is_show_to_user;
	}
}
