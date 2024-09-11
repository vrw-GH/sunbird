<?php
namespace AvasElements\Modules\Chart;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-chart';
	}

	public function get_widgets() {
		$widgets = [
			'Chart',
		];

		return $widgets;
	}
}
