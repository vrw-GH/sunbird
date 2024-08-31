<?php
namespace AvasElements\Modules\PostAlter;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-post-alter';
	}

	public function get_widgets() {
		$widgets = [
			'PostAlter',
		];

		return $widgets;
	}
}
