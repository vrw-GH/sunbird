<?php
namespace AvasElements\Modules\CoursesCarousel;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-courses-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'CoursesCarousel',
		];

		return $widgets;
	}
}
