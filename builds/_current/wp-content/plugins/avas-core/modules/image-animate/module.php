<?php
namespace AvasElements\Modules\ImageAnimate;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-image-animate';
	}

	public function get_widgets() {
		$widgets = [
			'ImageAnimate',
		];

		return $widgets;
	}
}
