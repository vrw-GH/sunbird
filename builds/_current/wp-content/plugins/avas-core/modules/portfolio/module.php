<?php
namespace AvasElements\Modules\Portfolio;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-portfolio';
	}

	public function get_widgets() {
		$widgets = [
			'Portfolio',
		];

		return $widgets;
	}
}
