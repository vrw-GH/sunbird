<?php
namespace AvasElements\Modules\ImageScrolling;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-image-scrolling';
	}

	public function get_widgets() {
		$widgets = [
			'ImageScrolling',
		];

		return $widgets;
	}
}
