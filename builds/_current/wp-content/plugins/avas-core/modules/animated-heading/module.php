<?php
namespace AvasElements\Modules\AnimatedHeading;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-animated-heading';
	}

	public function get_widgets() {
		$widgets = [
			'AnimatedHeading',
		];

		return $widgets;
	}
}
