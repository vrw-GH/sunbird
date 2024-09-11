<?php
namespace AvasElements\Modules\PostGrid;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-post-grid';
	}

	public function get_widgets() {
		$widgets = [
			'PostGrid',
		];

		return $widgets;
	}
}
