<?php
namespace AvasElements\Modules\Menu;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-menu';
	}

	public function get_widgets() {
		$widgets = [
			'Menu',
		];

		return $widgets;
	}
}
