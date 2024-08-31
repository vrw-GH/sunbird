<?php
namespace AvasElements\Modules\PriceMenu;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-price-menu';
	}

	public function get_widgets() {
		$widgets = [
			'PriceMenu',
		];

		return $widgets;
	}
}
