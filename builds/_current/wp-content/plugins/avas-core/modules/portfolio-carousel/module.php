<?php
namespace AvasElements\Modules\PortfolioCarousel;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-portfolio-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'PortfolioCarousel',
		];

		return $widgets;
	}
}
