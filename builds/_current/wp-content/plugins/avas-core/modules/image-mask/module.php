<?php
namespace AvasElements\Modules\ImageMask;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-image-mask';
	}

	public function get_widgets() {
		$widgets = [
			'ImageMask',
		];

		return $widgets;
	}
}
