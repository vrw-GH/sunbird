<?php
namespace AvasElements\Modules\CircleInfo;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-circle-info';
	}

	public function get_widgets() {
		$widgets = [
			'CircleInfo',
		];

		return $widgets;
	}
}
