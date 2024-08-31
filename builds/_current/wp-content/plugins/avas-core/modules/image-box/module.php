<?php
namespace AvasElements\Modules\ImageBox;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-image-box';
	}

	public function get_widgets() {
		$widgets = [
			'ImageBox',
		];

		return $widgets;
	}
}
