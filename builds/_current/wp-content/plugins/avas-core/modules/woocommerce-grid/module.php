<?php
namespace AvasElements\Modules\WoocommerceGrid;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-woocommerce-grid';
	}

	public function get_widgets() {
		$widgets = [
			'WoocommerceGrid',
		];

		return $widgets;
	}
}
