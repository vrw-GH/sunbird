<?php
namespace Burst;

use Burst\Traits\Admin_Helper;
use Burst\Traits\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Auto installer for Burst Pro
 *
 * @version 1
 */
if ( ! class_exists( 'Auto_Installer' ) ) {
	class Auto_Installer {
		use Helper;
		use Admin_Helper;

		private $version              = 1;
		private $api_url              = '';
		private $license              = '';
		private $item_id              = '';
		private $slug                 = '';
		private $health_check_timeout = 5;
		private $plugin_name          = '';
		private $plugin_constant      = '';
		private $steps;
		private $prefix;
		private $dashboard_url;
		private $instructions;
		private $account_url;
		private $known_plugins = [
			'burst_pro',
		];
		/**
		 * Class constructor.
		 */
		public function __construct() {
			// only doing an exists check.
            // phpcs:ignore
			if ( ! isset( $_GET['license'], $_GET['item_id'], $_GET['plugin'] ) || ( isset( $_GET['install_pro'] ) && $_GET['install_pro'] !== 'true' ) ) {
				return;
			}

			// only doing a comparison.
            // phpcs:ignore
			if ( ! in_array( $_GET['plugin'], $this->known_plugins, true ) ) {
				return;
			}

			// actions after nonce verification.
            // phpcs:ignore
			$this->license = $this->sanitize_license_key( $_GET['license'] );
            // phpcs:ignore
			$this->item_id = (int) $_GET['item_id'];

			// Set up hooks.
			$this->init();
		}

		/**
		 * Sanitize the plugin slug.
		 */
		private function sanitize_plugin_key( string $slug ): string {
			$slug = sanitize_title( $slug );
			if ( in_array( $slug, $this->known_plugins, true ) ) {
				return $slug;
			}
			return '';
		}

		/**
		 * Sanitize a license key (32-character hexadecimal string).
		 *
		 * @param string $key The input license key.
		 * @return string Sanitized license key, or empty string if invalid.
		 */
		private function sanitize_license_key( string $key ): string {
			$key = strtolower( trim( $key ) );

			if ( preg_match( '/^[a-f0-9]{32}$/', $key ) ) {
				return $key;
			}

			return '';
		}

		/**
		 * Get suggested plugin information
		 */
		private function get_suggested_plugin( string $attr ): string {
			$dir_url    = plugin_dir_url( __FILE__ ) . 'img/';
			$suggestion = [
				'icon_url'          => $dir_url . 'all-in-one-security.png',
				'constant'          => 'AIO_WP_SECURITY_VERSION',
				'title'             => 'All-In-One Security (AIOS) – Security and Firewall',
				'description_short' => __( 'Easy to use security for WordPress', 'burst-statistics' ),
				'disabled'          => '',
				'button_text'       => __( 'Install', 'burst-statistics' ),
				'slug'              => 'wp-security',
				'description'       => __( 'All the tools you need to secure your website.', 'burst-statistics' ),
				'install_url'       => 'all-in-one%2520security%2520firewall%2520aios%2520security%2520updraftplus&tab=search&type=term',
			];

			$admin_url                 = is_multisite() ? network_admin_url( 'plugin-install.php?s=' ) : admin_url( 'plugin-install.php?s=' );
			$suggestion['install_url'] = $admin_url . $suggestion['install_url'];
			if ( defined( $suggestion['constant'] ) ) {
				$suggestion['install_url'] = '#';
				$suggestion['button_text'] = __( 'Installed', 'burst-statistics' );
				$suggestion['disabled']    = 'disabled';
			}

			return $suggestion[ $attr ];
		}

		/**
		 * Set up WordPress filters to hook into WP's update process.
		 *
		 * @uses add_filter()
		 */
		public function init(): void {
			add_action( 'admin_init', [ $this, 'setup_properties' ] );
			add_action( 'admin_footer', [ $this, 'print_install_modal' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
			add_action( 'wp_ajax_rsp_upgrade_destination_clear', [ $this, 'process_ajax_destination_clear' ] );
			add_action( 'wp_ajax_rsp_upgrade_activate_license', [ $this, 'process_ajax_activate_license' ] );
			add_action( 'wp_ajax_rsp_upgrade_package_information', [ $this, 'process_ajax_package_information' ] );
			add_action( 'wp_ajax_rsp_upgrade_install_plugin', [ $this, 'process_ajax_install_plugin' ] );
			add_action( 'wp_ajax_rsp_upgrade_activate_plugin', [ $this, 'process_ajax_activate_plugin' ] );
		}

		/**
		 * Set up properties for the upgrade process
		 */
		public function setup_properties(): void {
			// not stored in the database, only used to verify if it is the correct plugin.
            // phpcs:ignore
			$plugin = $this->sanitize_plugin_key( $_GET['plugin'] );
			switch ( $plugin ) {
				case 'burst_pro':
					$this->slug            = 'burst-pro/burst-pro.php';
					$this->plugin_name     = 'Burst';
					$this->plugin_constant = 'BURST_PRO';
					$this->prefix          = 'burst_';
					$this->api_url         = 'https://burst-statistics.com';
					$this->dashboard_url   = add_query_arg( [ 'page' => 'burst' ], admin_url( 'admin.php' ) );
					$this->account_url     = 'https://burst-statistics.com/account';
					$this->instructions    = 'https://burst-statistics.com/how-to-install-burst-pro';
					break;
			}

			$this->steps = [
				[
					'action'  => 'rsp_upgrade_destination_clear',
					'doing'   => __( 'Checking if plugin folder exists...', 'burst-statistics' ),
					'success' => __( 'Able to create destination folder', 'burst-statistics' ),
					'error'   => __( 'Destination folder already exists', 'burst-statistics' ),
					'type'    => 'folder',
				],
				[
					'action'  => 'rsp_upgrade_activate_license',
					'doing'   => __( 'Validating license...', 'burst-statistics' ),
					'success' => __( 'License valid', 'burst-statistics' ),
					'error'   => __( 'License invalid', 'burst-statistics' ),
					'type'    => 'license',
				],
				[
					'action'  => 'rsp_upgrade_package_information',
					'doing'   => __( 'Retrieving package information...', 'burst-statistics' ),
					'success' => __( 'Package information retrieved', 'burst-statistics' ),
					'error'   => __( 'Failed to gather package information', 'burst-statistics' ),
					'type'    => 'package',
				],
				[
					'action'  => 'rsp_upgrade_install_plugin',
					'doing'   => __( 'Installing plugin...', 'burst-statistics' ),
					'success' => __( 'Plugin installed', 'burst-statistics' ),
					'error'   => __( 'Failed to install plugin', 'burst-statistics' ),
					'type'    => 'install',
				],
				[
					'action'  => 'rsp_upgrade_activate_plugin',
					'doing'   => __( 'Activating plugin...', 'burst-statistics' ),
					'success' => __( 'Plugin activated', 'burst-statistics' ),
					'error'   => __( 'Failed to activate plugin', 'burst-statistics' ),
					'type'    => 'activate',
				],
			];
		}

		/**
		 * Enqueue javascript
		 */
		public function enqueue_assets( string $hook ): void {
			// no data is processed, only a comparison.
            // phpcs:ignore
			if ( $hook === 'plugins.php' && isset( $_GET['install_pro'] ) ) {
				$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
				wp_register_style( 'rsp-upgrade-css', plugin_dir_url( __FILE__ ) . "upgrade-to-pro$minified.css", false, $this->version );
				wp_enqueue_style( 'rsp-upgrade-css' );
				wp_enqueue_script( 'rsp-ajax-js', plugin_dir_url( __FILE__ ) . "ajax$minified.js", [], $this->version, true );
				wp_enqueue_script( 'rsp-upgrade-js', plugin_dir_url( __FILE__ ) . "upgrade-to-pro$minified.js", [], $this->version, true );
				wp_localize_script(
					'rsp-upgrade-js',
					'rsp_upgrade',
					[
						'steps'          => $this->steps,
						'admin_url'      => admin_url( 'admin-ajax.php' ),
						'token'          => wp_create_nonce( 'upgrade_to_pro_nonce' ),
						'finished_title' => __( 'Installation finished', 'burst-statistics' ),
					]
				);
			}
		}

		/**
		 * Calls the API and, if successfull, returns the object delivered by the API.
		 *
		 * @uses get_bloginfo()
		 * @uses wp_remote_post()
		 * @uses is_wp_error()
		 */
		private function api_request(): mixed {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return false;
			}
			global $edd_plugin_url_available;

			// Do a quick status check on this domain if we haven't already checked it.
			$store_hash = md5( $this->api_url );
			if ( ! is_array( $edd_plugin_url_available ) || ! isset( $edd_plugin_url_available[ $store_hash ] ) ) {
				$test_url_parts = wp_parse_url( $this->api_url );
				$port           = ! empty( $test_url_parts['port'] ) ? ':' . $test_url_parts['port'] : '';
				$host           = ! empty( $test_url_parts['host'] ) ? $test_url_parts['host'] : '';
				$test_url       = 'https://' . $host . $port;
				$response       = wp_remote_get(
					$test_url,
					[
						'timeout'   => $this->health_check_timeout,
						'sslverify' => true,
					]
				);
                //phpcs:ignore
                $edd_plugin_url_available[ $store_hash ] = is_wp_error( $response ) ? false : true;
			}

			if ( false === $edd_plugin_url_available[ $store_hash ] ) {
				return false;
			}

			if ( $this->api_url === trailingslashit( home_url() ) ) {
				// Don't allow a plugin to ping itself.
				return false;
			}

			$api_params = [
				'edd_action' => 'get_version',
				'license'    => ! empty( $this->license ) ? $this->license : '',
				'item_id'    => isset( $this->item_id ) ? $this->item_id : false,
				'url'        => home_url(),
			];
			$request    = wp_remote_post(
				$this->api_url,
				[
					'timeout'   => 15,
					'sslverify' => true,
					'body'      => $api_params,
				]
			);
			if ( ! is_wp_error( $request ) ) {
				$request = json_decode( wp_remote_retrieve_body( $request ) );
			}

			if ( $request && isset( $request->sections ) ) {
				$request->sections = maybe_unserialize( $request->sections );
			} else {
				$request = false;
			}

			if ( $request && isset( $request->banners ) ) {
				$request->banners = maybe_unserialize( $request->banners );
			}

			if ( $request && isset( $request->icons ) ) {
				$request->icons = maybe_unserialize( $request->icons );
			}

			if ( ! empty( $request->sections ) ) {
				foreach ( $request->sections as $key => $section ) {
					$request->$key = (array) $section;
				}
			}

			return $request;
		}

		/**
		 * Prints a modal with bullets for each step of the install process
		 */
		public function print_install_modal(): void {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			if ( is_admin() && $this->item_id > 0 ) {
				$dashboard_url = $this->dashboard_url;
				$plugins_url   = admin_url( 'plugins.php' );
				?>
				<div id="rsp-step-template">
					<div class="rsp-install-step {step}">
						<div class="rsp-step-color">
							<div class="rsp-grey rsp-bullet"></div>
						</div>
						<div class="rsp-step-text">
							<span>{doing}</span>
						</div>
					</div>
				</div>
				<div id="rsp-plugin-suggestion-template">
					<div class="rsp-recommended"><?php esc_html_e( 'Recommended by Burst Statistics', 'burst-statistics' ); ?></div>
					<div class="rsp-plugin-suggestion">
						<div class="rsp-icon"><img alt="suggested plugin icon" src="<?php echo esc_url( $this->get_suggested_plugin( 'icon_url' ) ); ?>"></div>
						<div class="rsp-summary">
							<div class="rsp-title"><?php echo esc_html( $this->get_suggested_plugin( 'title' ) ); ?></div>
							<div class="rsp-description_short"><?php echo esc_html( $this->get_suggested_plugin( 'description_short' ) ); ?></div>
							<div class="rsp-rating">
							<?php
								$plugin_info = $this->get_plugin_info( $this->get_suggested_plugin( 'slug' ) );

							if ( ! is_wp_error( $plugin_info ) && ! empty( $plugin_info->rating ) ) {
								wp_star_rating(
									[
										'rating' => $plugin_info->rating,
										'type'   => 'percent',
										'number' => $plugin_info->num_ratings,
									]
								);
							}
							?>
								</div>
						</div>
						<div class="rsp-description"><?php echo esc_html( $this->get_suggested_plugin( 'description' ) ); ?></div>
						<div class="rsp-install-button"><a class="button-secondary" <?php echo esc_attr( $this->get_suggested_plugin( 'disabled' ) ); ?> href="<?php echo esc_url( $this->get_suggested_plugin( 'install_url' ) ); ?>"><?php echo esc_html( $this->get_suggested_plugin( 'button_text' ) ); ?></a></div>
					</div>
				</div>
				<div class="rsp-modal-transparent-background">
					<div class="rsp-install-plugin-modal">
						<h3><?php esc_html_e( 'Installing', 'burst-statistics' ) . ' ' . esc_html( $this->plugin_name ); ?></h3>
						<div class="rsp-progress-bar-container">
							<div class="rsp-progress rsp-grey">
								<div class="rsp-bar rsp-green" style="width:0%"></div>
							</div>
						</div>
						<div class="rsp-install-steps">

						</div>
						<div class="rsp-footer">
							<a href="<?php echo esc_url( $dashboard_url ); ?>" role="button" class="button-primary rsp-yellow rsp-hidden rsp-btn rsp-visit-dashboard">
								<?php esc_html_e( 'Visit Dashboard', 'burst-statistics' ); ?>
							</a>
							<a href="<?php echo esc_url( $plugins_url ); ?>" role="button" class="button-primary rsp-red rsp-hidden rsp-btn rsp-cancel">
								<?php esc_html_e( 'Cancel', 'burst-statistics' ); ?>
							</a>
							<div class="rsp-error-message rsp-folder rsp-package rsp-install rsp-activate rsp-hidden">
								<span>
								<?php
								esc_html_e( 'An Error Occurred:', 'burst-statistics' );
								?>
								</span>&nbsp;
								<?php
								// translators: 1: opening anchor tag for manual install link, 2: closing anchor tag.
								printf( esc_html( __( 'Install %sManually%s.', 'burst-statistics' ) ) . '&nbsp;', '<a target="_blank" href="' . esc_url( $this->instructions ) . '">', '</a>' );
								?>
							</div>
							<div class="rsp-error-message rsp-license rsp-hidden"><span>
							<?php
								esc_html_e( 'An Error Occurred:', 'burst-statistics' );
							?>
								</span>&nbsp;
								<?php
								// translators: 1: opening anchor tag to the license page, 2: closing anchor tag.
								printf( esc_html( __( 'Check your %slicense%s.', 'burst-statistics' ) ) . '&nbsp;', '<a target="_blank" href="' . esc_url( $this->account_url ) . '">', '</a>' );
								?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		}

		/**
		 * Retrieve plugin info for rating use
		 *
		 * @uses plugins_api() Get the plugin data.
		 * @param  string $slug The WP.org directory repo slug of the plugin.
		 * @version 1.0
		 */
		private function get_plugin_info( string $slug = '' ): mixed {
			require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
			$plugin_info = get_transient( 'rsp_' . $slug . '_plugin_info' );
			if ( empty( $plugin_info ) ) {
				$plugin_info = plugins_api( 'plugin_information', [ 'slug' => $slug ] );
				if ( ! is_wp_error( $plugin_info ) ) {
					set_transient( 'rsp_' . $slug . '_plugin_info', $plugin_info, WEEK_IN_SECONDS );
				}
			}
			return $plugin_info;
		}

		/**
		 * Ajax GET request
		 *
		 * Checks if the destination folder already exists
		 *
		 * Requires from GET:
		 * - 'token' => wp_nonce 'upgrade_to_pro_nonce'
		 * - 'plugin' (This will set $this->slug (Ex. 'really-simple-ssl-pro/really-simple-ssl-pro.php'), based on which plugin)
		 *
		 * Echoes array [success]
		 */
		public function process_ajax_destination_clear(): void {
			$error    = false;
			$response = [
				'success' => false,
			];
			$message  = __( 'Could not install.', 'burst-statistics' );

			if ( empty( $this->slug ) ) {
				$error = true;
			}

			// nonce is verified through our wrapper function.
            // phpcs:ignore
			if ( ! isset( $_GET['token'] ) || ! $this->verify_nonce( $_GET['token'], 'upgrade_to_pro_nonce' ) ) {
				$error   = true;
				$message = __( 'Nonce verification failed.', 'burst-statistics' );
			}

			global $wp_filesystem;
			if ( ! $wp_filesystem || ! is_a( $wp_filesystem, 'WP_Filesystem_Base' ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
				WP_Filesystem();
			}

			if ( ! $error && ! current_user_can( 'activate_plugins' ) ) {
				$error   = true;
				$message = __( 'You do not have permission to install plugins!', 'burst-statistics' );
			}

			if ( ! $error ) {
				if ( defined( $this->plugin_constant ) ) {
					deactivate_plugins( $this->slug );
				}

				$file = trailingslashit( WP_CONTENT_DIR ) . 'plugins/' . $this->slug;
				if ( $wp_filesystem->is_file( $file ) ) {
					$dir = dirname( $file );
					// it the upgrade is running in the detected plugin, don't rename, but exit.
					$new_dir = $dir . '_' . time();
					set_transient( 'burst_upgrade_dir', $new_dir, WEEK_IN_SECONDS );
					$wp_filesystem->move( $dir, $new_dir );
					// prevent uninstalling code by previous plugin.
					wp_delete_file( trailingslashit( $new_dir ) . 'uninstall.php' );
				}
			}

			if ( ! $error && file_exists( $file ) ) {
				$error    = true;
				$response = [
					'success' => false,
					'message' => __( 'Could not rename folder!', 'burst-statistics' ),
				];
			}

			if ( ! $error && strlen( $this->slug ) > 0 ) {
				if ( ! file_exists( WP_PLUGIN_DIR . '/' . $this->slug ) ) {
					$response = [
						'success' => true,
					];
				}
			}

			if ( $error ) {
				$response = [
					'success' => false,
					'message' => $message,
				];
			}
			wp_send_json( $response );
		}


		/**
		 * Ajax GET request
		 *
		 * Links the license on the website to this site
		 *
		 * Requires from GET:
		 * - 'token' => wp_nonce 'upgrade_to_pro_nonce'
		 * - 'license'
		 * - 'item_id'
		 *
		 * (Without this link you cannot download the pro package from the website)
		 *
		 * Echoes array [license status, response message]
		 */
		public function process_ajax_activate_license(): void {
			$error    = false;
			$response = [
				'success' => false,
				'message' => '',
			];

			if ( ! current_user_can( 'activate_plugins' ) ) {
				$error = true;
			}

			// nonce is verified through our wrapper function.
            // phpcs:ignore
			if ( ! $error && isset( $_GET['token'] ) && $this->verify_nonce( $_GET['token'], 'upgrade_to_pro_nonce' ) && isset( $_GET['license'] ) && isset( $_GET['item_id'] ) ) {
				$license  = sanitize_title( $_GET['license'] );//phpcs:ignore
				$item_id  = (int) $_GET['item_id'];//phpcs:ignore
				$response = $this->validate( $license, $item_id );
				update_site_option( $this->prefix . 'auto_installed_license', $license );
			}

			wp_send_json( $response );
		}


		/**
		 * Activate the license on the websites url at EDD.
		 *
		 * Stores values in database:
		 * - {$this->pro_prefix}license_activations_left
		 * - {$this->pro_prefix}license_expires
		 * - {$this->pro_prefix}license_activation_limit
		 *
		 * @return array{success: bool, message: string}
		 */
		private function validate( string $license, int $item_id ): array {
			$message = '';
			$success = false;

			if ( ! current_user_can( 'activate_plugins' ) ) {
				return [
					'success' => $success,
					'message' => $message,
				];
			}

			// data to send in our API request.
			$api_params = [
				'edd_action' => 'activate_license',
				'license'    => $license,
				'item_id'    => $item_id,
				'url'        => home_url(),
			];

			// Call the custom API.
			$response = wp_remote_post(
				$this->api_url,
				[
					'timeout'   => 15,
					'sslverify' => false,
					'body'      => $api_params,
				]
			);

			// make sure the response came back okay.
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = __( 'An error occurred, please try again.', 'burst-statistics' );
				}
			} else {
				$license_data = json_decode( wp_remote_retrieve_body( $response ) );
				if ( false === $license_data->success ) {
					switch ( $license_data->error ) {
						case 'expired':
							$message = sprintf(
							// translators: %s is the license expiration date, e.g. "April 30, 2025".
								__( 'Your license key expired on %s.', 'burst-statistics' ),
								date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires ) )
							);
							break;
						case 'disabled':
						case 'revoked':
							$message = __( 'Your license key has been disabled.', 'burst-statistics' );
							break;
						case 'missing':
							$message = __( 'Missing license.', 'burst-statistics' );
							break;
						case 'invalid':
							$message = __( 'Invalid license.', 'burst-statistics' );
							break;
						case 'site_inactive':
							$message = __( 'Your license is not active for this URL.', 'burst-statistics' );
							break;
						case 'item_name_mismatch':
							$message = __( 'This appears to be an invalid license key for this plugin.', 'burst-statistics' );
							break;
						case 'no_activations_left':
							$message = __( 'Your license key has reached its activation limit.', 'burst-statistics' );
							break;
						default:
							$message = __( 'An error occurred, please try again.', 'burst-statistics' );
							break;
					}
					global $wp_filesystem;
					if ( ! $wp_filesystem || ! is_a( $wp_filesystem, 'WP_Filesystem_Base' ) ) {
						require_once ABSPATH . 'wp-admin/includes/file.php';
						WP_Filesystem();
					}

					// in case of failure, rename back to default.
					$new_dir = get_transient( 'burst_upgrade_dir' );
					if ( $new_dir ) {
						if ( $wp_filesystem->is_file( $new_dir ) ) {
							$default_file = trailingslashit( WP_CONTENT_DIR ) . 'plugins/' . $this->slug;
							$default_dir  = dirname( $default_file );
							$wp_filesystem->move( $new_dir, $default_dir );
						}
					}
				} else {
					$success = $license_data->license === 'valid';
				}
			}

			return [
				'success' => $success,
				'message' => $message,
			];
		}


		/**
		 * Ajax GET request
		 *
		 * Do an API request to get the download link where to download the pro package
		 *
		 * Requires from GET:
		 * - 'token' => wp_nonce 'upgrade_to_pro_nonce'
		 * - 'license'
		 * - 'item_id'
		 *
		 * Echoes array [success, download_link]
		 */
		public function process_ajax_package_information(): void {
			$error         = false;
			$download_link = '';
			if ( ! current_user_can( 'activate_plugins' ) ) {
				$error = true;
			}

            // phpcs:ignore
			if ( ! $error && isset( $_GET['token'] ) && $this->verify_nonce( $_GET['token'], 'upgrade_to_pro_nonce' ) && isset( $_GET['license'] ) && isset( $_GET['item_id'] ) ) {
				$api = $this->api_request();
				if ( $api && isset( $api->download_link ) ) {
					$download_link = $api->download_link;
				} else {
					$error = true;
				}
			}

			$response = [
				'success'       => ! $error,
				'download_link' => $download_link,
			];
			wp_send_json( $response );
		}


		/**
		 * Ajax GET request
		 *
		 * Download and install the plugin
		 *
		 * Requires from GET:
		 * - 'token' => wp_nonce 'upgrade_to_pro_nonce'
		 * - 'download_link'
		 * (Linked license on the website to this site)
		 *
		 * Echoes array [success]
		 */
		public function process_ajax_install_plugin(): void {
			$message = '';

			if ( ! current_user_can( 'activate_plugins' ) ) {
				$response = [
					'success' => false,
					'message' => $message,
				];
				wp_send_json( $response );
			}

			if ( isset( $_GET['token'] ) && $this->verify_nonce( $_GET['token'], 'upgrade_to_pro_nonce' ) && isset( $_GET['download_link'] ) ) {//phpcs:ignore

				$download_link = esc_url_raw( $_GET['download_link'] );// phpcs:ignore
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$skin     = new \WP_Ajax_Upgrader_Skin();
				$upgrader = new \Plugin_Upgrader( $skin );
				$result   = $upgrader->install( $download_link );

				if ( $result ) {
					$response = [
						'success' => true,
					];
				} else {
					if ( is_wp_error( $result ) ) {
						$message = $result->get_error_message();
					}
					$response = [
						'success' => false,
						'message' => $message,
					];
				}

				wp_send_json( $response );
			}
		}


		/**
		 * Ajax GET request
		 *
		 * Do an API request to get the download link where to download the pro package
		 *
		 * Requires from GET:
		 * - 'token' => wp_nonce 'upgrade_to_pro_nonce'
		 * - 'plugin' (This will set $this->slug (Ex. 'really-simple-ssl-pro/really-simple-ssl-pro.php'), based on which plugin)
		 *
		 * Echoes array [success]
		 */
		public function process_ajax_activate_plugin(): void {
			$error = false;
			if ( ! current_user_can( 'activate_plugins' ) ) {
				$error = true;
			}

			// this  is only needed for testing purposes, as the automated test tests this current branch. So the plugin will already be active.
			if ( ! $error && defined( $this->plugin_constant ) ) {
				$response = [
					'success' => true,
				];
				wp_send_json( $response );
			}

			if ( ! $error && isset( $_GET['token'] ) && $this->verify_nonce( $_GET['token'], 'upgrade_to_pro_nonce' ) && isset( $_GET['plugin'] ) ) {//phpcs:ignore
				$networkwide = is_multisite();
				$result      = activate_plugin( $this->slug, '', $networkwide );
				if ( is_wp_error( $result ) ) {
					$error = true;
				}
			}
			$response = [
				'success' => ! $error,
			];
			wp_send_json( $response );
		}
	}
	$burst_auto_installer = new Auto_Installer();
}