<?php
namespace AvasElements\Modules\Profile;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-profile';
	}

	public function get_widgets() {
		$widgets = [
			'Profile',
		];

		return $widgets;
	}
}
