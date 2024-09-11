<?php
namespace AvasElements\Modules\Hotspot;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-hotspot';
	}

	public function get_widgets() {
		$widgets = [
			'Hotspot',
		];

		return $widgets;
	}
}
