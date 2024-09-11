<?php
namespace AvasElements\Modules\CircleProgressBar;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-circle-progress-bar';
	}

	public function get_widgets() {
		$widgets = [
			'CircleProgressBar',
		];

		return $widgets;
	}
}
