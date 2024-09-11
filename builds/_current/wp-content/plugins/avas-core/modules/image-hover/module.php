<?php
namespace AvasElements\Modules\ImageHover;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-image-hover';
	}

	public function get_widgets() {
		$widgets = [
			'ImageHover',
		];

		return $widgets;
	}
}
