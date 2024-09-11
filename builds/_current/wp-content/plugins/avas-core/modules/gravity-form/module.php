<?php
namespace AvasElements\Modules\GravityForm;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-gravity-form';
	}

	public function get_widgets() {
		$widgets = [
			'GravityForm',
		];

		return $widgets;
	}
}
