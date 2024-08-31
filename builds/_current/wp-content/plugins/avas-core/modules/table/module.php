<?php
namespace AvasElements\Modules\Table;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-table';
	}

	public function get_widgets() {
		$widgets = [
			'Table',
		];

		return $widgets;
	}
}
