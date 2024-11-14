<?php

/**
 * Class WOWP_Admin
 *
 * The main admin class responsible for initializing the admin functionality of the plugin.
 *
 * @package    PopupBox
 * @subpackage Admin
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace PopupBox;

use PopupBox\Admin\AdminActions;
use PopupBox\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

class WOWP_Admin {
	public function __construct() {
		Dashboard::init();
		AdminActions::init();
		$this->includes();

		add_action( WOWP_Plugin::PREFIX . '_admin_header_links', [ $this, 'plugin_links' ] );
		add_filter( WOWP_Plugin::PREFIX . '_save_settings', [ $this, 'save_settings' ] );
		add_action( WOWP_Plugin::PREFIX . '_admin_load_assets', [ $this, 'load_assets' ] );

		add_action( 'wp_ajax_popup_preview_content', [ $this, 'popup_preview_content' ] );
	}

	public function popup_preview_content(): void {
		if ( empty( $_POST['security_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['security_nonce'] ) ),
				WOWP_Plugin::PREFIX . '_nonce' ) ) {
			wp_send_json_error( 'Invalid nonce' );
			die();
		}

		$data    = ! empty( $_POST['data'] ) ? wp_kses_post( wp_unslash( $_POST['data'] ) ) : '';
		$content = do_shortcode( wpautop( wp_unslash( $data ) ) );
		wp_send_json_success( $content );
		die();
	}

	public function includes(): void {
		require_once plugin_dir_path( __FILE__ ) . 'class-settings-helper.php';
	}

	public function plugin_links(): void {
		?>
        <div class="wpie-links">
            <a href="<?php
			echo esc_url( WOWP_Plugin::info( 'pro' ) ); ?>" target="_blank">PRO Plugin</a>
            <a href="<?php
			echo esc_url( WOWP_Plugin::info( 'docs' ) ); ?>" target="_blank">Documentation</a>
            <a href="<?php
			echo esc_url( WOWP_Plugin::info( 'rating' ) ); ?>" target="_blank" class="wpie-color-orange">Rating</a>
            <a href="https://www.wordfence.com/r/a0fe3fadb6e08d58/products/wordfence-free/" class="wpie-color-success" target="_blank">Secure your site</a>
        </div>
		<?php
	}

	public function save_settings() {
		$param = ! empty( $_POST['param'] ) ? map_deep( wp_unslash( $_POST['param'] ), 'sanitize_text_field' ) : [];

		if ( isset( $_POST['param']['content'] ) ) {
			$content_param    = wp_kses_post( wp_unslash( $_POST['param']['content'] ) );
			$param['content'] = wp_encode_emoji( $content_param );
		}

		return $param;
	}

	public function sanitize_text( $text ): string {
		return sanitize_text_field( wp_unslash( $text ) );
	}


	public function load_assets(): void {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'wp-tinymce' );
		wp_enqueue_editor();
		wp_enqueue_media();
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
	}

}