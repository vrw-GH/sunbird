<?php
namespace AvasElements\Modules\PageTitle;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-page-title';
	}

	public function get_widgets() {
		$widgets = [
			'PageTitle',
		];

		return $widgets;
	}
}
