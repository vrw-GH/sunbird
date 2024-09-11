<?php
namespace AvasElements\Modules\SideMenu;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-side-menu';
	}

	public function get_widgets() {
		$widgets = [
			'SideMenu',
		];

		return $widgets;
	}
}
