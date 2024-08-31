<?php
namespace AvasElements\Modules\Coupon;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-coupon';
	}

	public function get_widgets() {
		$widgets = [
			'Coupon',
		];

		return $widgets;
	}
}
