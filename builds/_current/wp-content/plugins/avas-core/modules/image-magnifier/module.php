<?php
namespace AvasElements\Modules\ImageMagnifier;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-image-magnifier';
	}

	public function get_widgets() {
		$widgets = [
			'ImageMagnifier',
		];

		return $widgets;
	}
}
