<?php
namespace AvasElements\Modules\PostMasonryGrid;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-post-masonry-grid';
	}

	public function get_widgets() {
		$widgets = [
			'PostMasonryGrid',
		];

		return $widgets;
	}
}
