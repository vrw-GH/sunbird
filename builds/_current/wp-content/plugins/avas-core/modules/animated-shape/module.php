<?php
namespace AvasElements\Modules\AnimatedShape;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-animated-shape';
	}

	public function get_widgets() {
		$widgets = [
			'AnimatedShape',
		];

		return $widgets;
	}
}
