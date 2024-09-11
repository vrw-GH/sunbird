<?php
namespace AvasElements\Modules\Mailchimp;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-mailchimp';
	}

	public function get_widgets() {
		$widgets = [
			'Mailchimp',
		];

		return $widgets;
	}
}
