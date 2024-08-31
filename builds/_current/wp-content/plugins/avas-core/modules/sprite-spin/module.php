<?php
namespace AvasElements\Modules\SpriteSpin;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-sprite-spin';
	}

	public function get_widgets() {
		$widgets = [
			'SpriteSpin',
		];

		return $widgets;
	}
}
