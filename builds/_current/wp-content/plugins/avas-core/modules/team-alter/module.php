<?php
namespace AvasElements\Modules\TeamAlter;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-Team-alter';
	}

	public function get_widgets() {
		$widgets = [
			'TeamAlter',
		];

		return $widgets;
	}
}
