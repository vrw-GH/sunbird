<?php
namespace AvasElements\Modules\Services;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-services';
	}

	public function get_widgets() {
		$widgets = [
			'Services',
		];

		return $widgets;
	}
}
