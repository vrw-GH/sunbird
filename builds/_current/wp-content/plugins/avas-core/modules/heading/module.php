<?php
namespace AvasElements\Modules\Heading;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-heading';
	}

	public function get_widgets() {
		$widgets = [
			'Heading',
		];

		return $widgets;
	}
}
