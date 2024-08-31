<?php
namespace AvasElements\Modules\ImageComparison;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-image-comparison';
	}

	public function get_widgets() {
		$widgets = [
			'ImageComparison',
		];

		return $widgets;
	}
}
