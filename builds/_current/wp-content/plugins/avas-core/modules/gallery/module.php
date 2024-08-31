<?php
namespace AvasElements\Modules\Gallery;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-gallery';
	}

	public function get_widgets() {
		$widgets = [
			'Gallery',
		];

		return $widgets;
	}
}
