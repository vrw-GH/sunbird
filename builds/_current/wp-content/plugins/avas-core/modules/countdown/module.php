<?php
namespace AvasElements\Modules\Countdown;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-countdown';
	}

	public function get_widgets() {
		$widgets = [
			'Countdown',
		];

		return $widgets;
	}
}
