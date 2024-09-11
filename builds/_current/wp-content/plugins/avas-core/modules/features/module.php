<?php
namespace AvasElements\Modules\Features;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-features';
	}

	public function get_widgets() {
		$widgets = [
			'Features',
		];

		return $widgets;
	}
}
