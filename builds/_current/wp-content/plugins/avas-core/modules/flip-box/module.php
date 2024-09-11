<?php
namespace AvasElements\Modules\FlipBox;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-flip-box';
	}

	public function get_widgets() {
		$widgets = [
			'FlipBox',
		];

		return $widgets;
	}
}
