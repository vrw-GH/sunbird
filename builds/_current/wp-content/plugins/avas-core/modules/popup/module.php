<?php
namespace AvasElements\Modules\Popup;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-popup';
	}

	public function get_widgets() {
		$widgets = [
			'Popup',
		];

		return $widgets;
	}
}
