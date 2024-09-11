<?php
namespace AvasElements\Modules\Button;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-button';
	}

	public function get_widgets() {
		$widgets = [
			'Button',
		];

		return $widgets;
	}
}
