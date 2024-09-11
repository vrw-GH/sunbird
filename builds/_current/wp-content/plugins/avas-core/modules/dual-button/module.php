<?php
namespace AvasElements\Modules\DualButton;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-dual-button';
	}

	public function get_widgets() {
		$widgets = [
			'DualButton',
		];

		return $widgets;
	}
}
