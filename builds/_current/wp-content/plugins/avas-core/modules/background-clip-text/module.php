<?php
namespace AvasElements\Modules\BackgroundClipText;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-background-clip-text';
	}

	public function get_widgets() {
		$widgets = [
			'BackgroundClipText',
		];

		return $widgets;
	}
}
