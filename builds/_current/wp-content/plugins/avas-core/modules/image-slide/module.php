<?php
namespace AvasElements\Modules\ImageSlide;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-image-slide';
	}

	public function get_widgets() {
		$widgets = [
			'ImageSlide',
		];

		return $widgets;
	}
}
