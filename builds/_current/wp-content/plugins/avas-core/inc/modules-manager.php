<?php
namespace AvasElements;

final class ModuleManager {
	/**
	 * @var Module_Base[]
	 */
	private $modules = [];

	public function __construct() {
		$modules = [
			'animated-heading',
			'animated-shape',
			'background-clip-text',
			'background-slider',
			'breadcrumbs',
			'button',
			'call-to-action',
			'cart',
			'chart',
			'circle-info',
			'circle-progress-bar',
			'contact-form-seven',
			'countdown',
			'coupon',
			'courses',
			'courses-carousel',
			'dual-button',
			'features',
			'flip-box',
			'flipster',
			'gallery',
			'gravity-form',
			'heading',
			'hotspot',
			'icon-box',
			'image-animate',
			'image-box',
			'image-comparison',
			'image-hover',
			'image-magnifier',
			'image-mask',
			'image-scrolling',
			'image-slide',
			'instagram',
			'lottie',
			'mailchimp',
			'menu',
			'news-ticker',
			'page-title',
			'popup',
			'portfolio',
			'portfolio-carousel',
			'post-alter',
			'post-carousel',
			'post-grid',
			'post-list',
			'post-masonry-grid',
			'post-tiled',
			'price-menu',		
			'price-table',
			'profile',
			'profile-carousel',
			'search',
			'services',
			'services-carousel',
			'side-menu',
			'source-code',
			'sprite-spin',
			'table',
			'team',
			'team-alter',
			'team-carousel',
			'template-shortcode',
			'testimonial',
			'timeline',
			'woocommerce-carousel',
			'woocommerce-grid',
			'wrapper-link'
		];

		foreach ( $modules as $module_name ) {
			$class_name = str_replace( '-', ' ', $module_name );
			$class_name = str_replace( ' ', '', ucwords( $class_name ) );
			$class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

			
			if ( $class_name::is_active() ) {
				$this->modules[ $module_name ] = $class_name::instance();
			}
		}
	}

	/**
	 * @param string $module_name
	 *
	 * @return Module_Base|Module_Base[]
	 */
	public function get_modules( $module_name ) {
		if ( $module_name ) {
			if ( isset( $this->modules[ $module_name ] ) ) {
				return $this->modules[ $module_name ];
			}

			return null;
		}

		return $this->modules;
	}
}

