<?php
namespace AvasElements\Modules\NewsTicker;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-news-ticker';
	}

	public function get_widgets() {
		$widgets = [
			'NewsTicker',
		];

		return $widgets;
	}
}
