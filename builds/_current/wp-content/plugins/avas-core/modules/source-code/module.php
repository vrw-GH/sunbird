<?php
namespace AvasElements\Modules\SourceCode;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-source-code';
	}

	public function get_widgets() {
		$widgets = [
			'SourceCode',
		];

		return $widgets;
	}
}
