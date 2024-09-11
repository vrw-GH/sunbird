<?php
namespace AvasElements;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class TX_Load {

	private static $_instance;

	private $_modules_manager;

	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
	private function _includes() {
		require TX_PLUGIN_PATH . 'inc/modules-manager.php';
		require TX_PLUGIN_PATH . 'inc/helper.php';
	}

	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$has_class_alias = isset( $this->classes_aliases[ $class ] );

		// Backward Compatibility: Save old class name for set an alias after the new class is loaded
		if ( $has_class_alias ) {
			$class_alias_name = $this->classes_aliases[ $class ];
			$class_to_load = $class_alias_name;
		} else {
			$class_to_load = $class;
		}

		if ( ! class_exists( $class_to_load ) ) {
			$filename = strtolower(
				preg_replace(
					[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$class_to_load
				)
			);
			$filename = TX_PLUGIN_PATH . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include( $filename );
			}
		}

		if ( $has_class_alias ) {
			class_alias( $class_alias_name, $class );
		}
	}

	public function elementor_init() {
		$this->_modules_manager = new ModuleManager();

		// Add element category in panel
		$category = \Elementor\Plugin::instance();
		$category->elements_manager->add_category(
			'avas-elements', // category name
			[
				'title' => esc_html__( 'Avas Widgets', 'avas-core' ), 
				'icon' => 'font',
			],
			1
		);
	}

	private function setup_hooks() {
		add_action( 'elementor/init', [ $this, 'elementor_init' ] );

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
		
		// Register Widget Scripts
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'widget_scripts' ] );

	}

	public function widget_styles() {

		wp_register_style( 'animation', TX_PLUGIN_URL . '/assets/css/animation.min.css' );
		wp_register_style( 'tx-owl-carousel', TX_CSS . 'owl.carousel.min.css' );
		wp_register_style( 'tx-magnific-popup', TX_CSS . 'magnific-popup.min.css' );
		wp_register_style( 'vegas', TX_PLUGIN_URL . '/assets/css/vegas.min.css' );
		wp_register_style( 'slick', TX_PLUGIN_URL . '/assets/css/slick.min.css' );
		wp_register_style( 'PrismJS', TX_PLUGIN_URL . '/assets/css/widgets/source-code/prism.min.css' );
		wp_register_style( 'tx-source-code', TX_PLUGIN_URL . '/assets/css/widgets/source-code/source-code.min.css' );
		wp_register_style( 'tx-mailchimp', TX_PLUGIN_URL . '/assets/css/widgets/mailchimp/mailchimp.min.css' );
	}

	public function widget_scripts() {

		wp_register_script( 'animated-heading', TX_PLUGIN_URL . '/assets/js/widgets/animated-heading/animated-heading.min.js' );
		wp_register_script( 'typed', TX_PLUGIN_URL . '/assets/js/widgets/animated-heading/typed.min.js' );
		wp_register_script( 'morphext', TX_PLUGIN_URL . '/assets/js/widgets/animated-heading/morphext.min.js' );
		wp_register_script( 'tx-chart', TX_PLUGIN_URL . '/assets/js/widgets/chart/tx-chart.min.js' );
		wp_register_script( 'chart', TX_PLUGIN_URL . '/assets/js/widgets/chart/chart.min.js' );
		wp_register_script( 'circle-progress-bar', TX_PLUGIN_URL . '/assets/js/widgets/circle-progress-bar/circle-progress-bar.min.js' );
		wp_register_script( 'asPieProgress', TX_PLUGIN_URL . '/assets/js/widgets/circle-progress-bar/jquery-asPieProgress.min.js' );
		wp_register_script( 'tx-countdown', TX_PLUGIN_URL . '/assets/js/widgets/countdown/tx-countdown.min.js' );
		wp_register_script( 'countdown', TX_PLUGIN_URL . '/assets/js/widgets/countdown/countdown.min.js' );
		wp_register_script( 'coupon', TX_PLUGIN_URL . '/assets/js/widgets/coupon/coupon.min.js' );
		wp_register_script( 'flipster', TX_PLUGIN_URL . '/assets/js/widgets/flipster/jquery.flipster.min.js' );
		wp_register_script( 'gallery', TX_PLUGIN_URL . '/assets/js/widgets/gallery/gallery.min.js' );
		wp_register_script( 'hotspot', TX_PLUGIN_URL . '/assets/js/widgets/hotspot/hotspot.min.js' );
		wp_register_script( 'tx-image-comparison', TX_PLUGIN_URL . '/assets/js/widgets/image-comparison/image-comparison.min.js' );
		wp_register_script( 'image-comparison', TX_PLUGIN_URL . '/assets/js/widgets/image-comparison/image-compare-viewer.min.js' );
		wp_register_script( 'image-slide', TX_PLUGIN_URL . '/assets/js/widgets/image-slide/image-slide.min.js' );
		wp_register_script( 'infiniteslidev2', TX_PLUGIN_URL . '/assets/js/widgets/image-slide/infiniteslidev2.min.js' );
		wp_register_script( 'instagram', TX_PLUGIN_URL . '/assets/js/widgets/instagram/instagram.min.js' );
		wp_register_script( 'instafeed', TX_PLUGIN_URL . '/assets/js/widgets/instagram/instafeed.min.js' );
		wp_register_script( 'lity', TX_PLUGIN_URL . '/assets/js/widgets/popup/lity.min.js' );
		wp_register_script( 'tx-lottie', TX_PLUGIN_URL . '/assets/js/widgets/lottie/tx-lottie.min.js' );
		wp_register_script( 'lottie', TX_PLUGIN_URL . '/assets/js/widgets/lottie/lottie.min.js' );
		wp_register_script( 'menu', TX_PLUGIN_URL . '/assets/js/widgets/menu/menu.min.js' );
		wp_register_script( 'infinite-scroll', TX_PLUGIN_URL . '/assets/js/widgets/post-masonry-grid/infinite-scroll.pkgd.min.js' );
		wp_register_script( 'avas-timeline', TX_PLUGIN_URL . '/assets/js/widgets/timeline/timeline.min.js' );
		wp_register_script( 'carousel-widgets', TX_PLUGIN_URL . '/assets/js/carousel-widgets.min.js' );
		wp_register_script( 'tx-owl-carousel', TX_JS . 'owl.carousel.min.js' );
		wp_register_script( 'tx-isotope', TX_JS . 'isotope.pkgd.min.js' );
		wp_register_script( 'tx-magnific-popup', TX_JS . 'jquery.magnific-popup.min.js' );
		wp_register_script( 'tx-imagesloaded', TX_JS . 'imagesloaded.pkgd.min.js' );
		wp_register_script( 'tx-wrapper-link', TX_PLUGIN_URL . '/assets/js/widgets/wrapper-link/wrapper-link.min.js' );
		wp_register_script( 'vegas', TX_PLUGIN_URL . '/assets/js/vegas.min.js' );
		wp_register_script( 'spritespin', TX_PLUGIN_URL . '/assets/js/widgets/sprite-spin/spritespin.min.js' );
		wp_register_script( 'spritespin-widget', TX_PLUGIN_URL . '/assets/js/widgets/sprite-spin/spritespin-widget.min.js' );
		wp_register_script( 'tx-circle-info', TX_PLUGIN_URL . '/assets/js/widgets/circle-info/tx-circle-info.min.js' );
		wp_register_script( 'tx-panel-slider', TX_PLUGIN_URL . '/assets/js/widgets/panel-slider/panel-slider.js' );
		wp_register_script( 'slick', TX_PLUGIN_URL . '/assets/js/slick.min.js' );
		wp_register_script( 'PrismJS', TX_PLUGIN_URL . '/assets/js/widgets/source-code/prism.min.js' );
		wp_register_script( 'tx-source-code', TX_PLUGIN_URL . '/assets/js/widgets/source-code/source-code.min.js' );
		wp_register_script( 'tx-lightzoom', TX_PLUGIN_URL . '/assets/js/widgets/image-magnifier/lightzoom.min.js' );
		wp_register_script( 'table', TX_PLUGIN_URL . '/assets/js/widgets/table/table.min.js' );
		
		// localize script
        wp_localize_script(
           'coupon',
           'txCopied',
            esc_html__('Copied!', 'avas-core')
        );
		
	}

	private function __construct() {
		
		spl_autoload_register( [ $this, 'autoload' ] );
		
		$this->_includes();
		
		$this->setup_hooks();
	}
}

TX_Load::instance();
