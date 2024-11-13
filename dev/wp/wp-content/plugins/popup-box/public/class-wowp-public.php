<?php

/**
 * Class WOWP_Public
 *
 * This class handles the public functionality of the Float Menu Pro plugin.
 *
 * @package    PopupBox
 * @subpackage Public
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace PopupBox;

use PopupBox\Admin\DBManager;
use PopupBox\Publish\Conditions;
use PopupBox\Publish\Display;
use PopupBox\Publish\Singleton;

defined( 'ABSPATH' ) || exit;

class WOWP_Public {

	private string $pefix;

	public function __construct() {
		$this->includes();
		// prefix for plugin assets
		$this->pefix = '.min';

		add_shortcode( WOWP_Plugin::SHORTCODE, [ $this, 'shortcode' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'assets' ] );
		add_action( 'wp_footer', [ $this, 'footer' ] );

	}

	public function includes(): void {
		require_once plugin_dir_path( __FILE__ ) . 'class-script-maker.php';
		require_once plugin_dir_path( __FILE__ ) . 'class-shortcodes.php';
	}

	public function shortcode( $atts ) {
		$atts = shortcode_atts(
			[ 'id' => "" ],
			$atts,
			WOWP_Plugin::SHORTCODE
		);

		if ( empty( $atts['id'] ) ) {
			return '';
		}

		$singleton = Singleton::getInstance();

		if ( $singleton->hasKey( $atts['id'] ) ) {
			return '';
		}

		$result = DBManager::get_data_by_id( $atts['id'] );

		if ( empty( $result->param ) ) {
			return '';
		}

		$conditions = Conditions::init( $result );

		if ( $conditions === false ) {
			return '';
		}

		$param = maybe_unserialize( $result->param );
		$singleton->setValue( $atts['id'], $param );

		return '';
	}

	public function assets(): void {
		$handle  = WOWP_Plugin::SLUG;
		$assets  = plugin_dir_url( __FILE__ ) . 'assets/';
		$version = WOWP_Plugin::info( 'version' );
		$this->check_display();
		$singleton    = Singleton::getInstance();
		$args         = $singleton->getValue();
		$is_shortcode = $this->check_shortcode();
		if ( $is_shortcode === true || ! empty( $args ) ) {
			wp_enqueue_style( $handle, $assets . 'css/style' . $this->pefix . '.css', null, $version );
		}
	}


	public function footer(): void {
		$handle  = WOWP_Plugin::SLUG;
		$assets  = plugin_dir_url( __FILE__ ) . 'assets/';
		$version = WOWP_Plugin::info( 'version' );

		$singleton = Singleton::getInstance();
		$args      = $singleton->getValue();

		if ( empty( $args ) ) {
			return;
		}

		wp_enqueue_style( $handle, $assets . 'css/style' . $this->pefix . '.css', null, $version );
		wp_enqueue_script( $handle, $assets . 'js/jsPopup' . $this->pefix . '.js', [], $version, true );

		$data = [];
		foreach ( $args as $id => $param ) {
			$this->create_popup( $id, $param );
			$script      = new Script_Maker( $id, $param );
			$data[ $id ] = $script->init();
		}

		wp_localize_script( $handle, 'PopupBoxObj', $data );
	}

	public function allowed_properties( $allowed_properties ) {
		$allowed_properties[] = 'display';
		$allowed_properties[] = 'list-style';

		return $allowed_properties;
	}

	private function check_display(): void {
		$results = DBManager::get_all_data();
		if ( $results !== false ) {
			foreach ( $results as $result ) {
				$param = maybe_unserialize( $result->param );
				if ( Display::init( $result->id, $param ) === true && Conditions::init( $result ) === true ) {
					$singleton = Singleton::getInstance();
					$singleton->setValue( $result->id, $param );
				}
			}
		}
	}

	private function check_shortcode(): bool {
		global $post;

		return is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, WOWP_Plugin::SHORTCODE );
	}

	private function create_popup( $id, $param ) {
		add_filter( 'safe_style_css', [ $this, 'allowed_properties' ], 10, 1 );
		echo '<div class="ds-popup" id="ds-popup-' . absint( $id ) . '">';
		echo '<div class="ds-popup-wrapper"><div class="ds-popup-content">';
		echo do_shortcode( wp_kses_post( $param['content'] ) );
		echo '</div></div></div>';
		remove_filter( 'safe_style_css', [ $this, 'allowed_properties' ], 10, 1 );
	}

}