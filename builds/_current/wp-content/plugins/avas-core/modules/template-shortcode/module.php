<?php
namespace AvasElements\Modules\TemplateShortcode;

use AvasElements\Base\Module_Base;
use Elementor\TemplateLibrary\Source_Local;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_plugin_active('elementor-pro/elementor-pro.php') ) {
	return;
}

class Module extends Module_Base {

	public function get_name() {
		return 'avas-template-shortcode';
	}

	const SHORTCODE = 'elementor-template';

	public function __construct() {
		$this->add_actions();

	}

	public function shortcode( $attributes = [] ) {
		if ( empty( $attributes['id'] ) ) {
			return '';
		}

		$include_css = false;

		if ( isset( $attributes['css'] ) && 'false' !== $attributes['css'] ) {
			$include_css = (bool) $attributes['css'];
		}

		return Plugin::instance()->frontend->get_builder_content_for_display( $attributes['id'], $include_css );
	}

	private function add_actions() {
		add_shortcode( self::SHORTCODE, [ $this, 'shortcode' ] );
	}

}