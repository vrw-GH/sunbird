<?php
namespace AvasElements\Modules\Search;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-search';
	}

	public function get_widgets() {
		$widgets = [
			'Search',
		];

		return $widgets;
	}
}
