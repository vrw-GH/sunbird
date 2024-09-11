<?php
namespace AvasElements\Modules\Cart;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-cart';
	}

	public function get_widgets() {
		$widgets = [
			'Cart',
		];

		return $widgets;
	}
}
