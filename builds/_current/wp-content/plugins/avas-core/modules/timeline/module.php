<?php
namespace AvasElements\Modules\Timeline;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-timeline';
	}

	public function get_widgets() {
		$widgets = [
			'Timeline',
		];

		return $widgets;
	}
}
