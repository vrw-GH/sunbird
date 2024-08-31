<?php
namespace AvasElements\Modules\Flipster;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-flipster';
	}

	public function get_widgets() {
		$widgets = [
			'Flipster',
		];

		return $widgets;
	}
}
