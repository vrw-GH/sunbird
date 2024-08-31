<?php
namespace AvasElements\Modules\WrapperLink;

use AvasElements\Base\Module_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function __construct() {

		// Section
		add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_section']);
		add_action('elementor/element/section/sec_wraplink/before_section_end', [$this,	'register_controls'], 10, 2);

		// Column
		add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'register_section']);
		add_action('elementor/element/column/sec_wraplink/before_section_end',[$this, 'register_controls'],	10,	2);

		// Widget
		add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_section']);
		add_action('elementor/element/common/sec_wraplink/before_section_end',	[$this,	'register_controls'], 10, 2);

		add_action('elementor/frontend/before_render', [$this, 'wrapper_link_before_render'], 10, 1);

	}

	public function get_name() {
		return 'avas-wrapper-link';
	}

	public function register_section($element) {

		if ('section' === $element->get_name() || 'column' === $element->get_name()) {
			$tabs = Controls_Manager::TAB_LAYOUT;
		} else {
			$tabs = Controls_Manager::TAB_CONTENT;
		}

		$element->start_controls_section(
			'sec_wraplink',
			[
				'tab'   => $tabs,
				'label' => esc_html__('Wrapper Link', 'avas-core'),
			]
		);

		$element->end_controls_section();
	}

	public function register_controls($element, $args) {

		$element->add_control(
			'tx_wrapper_link',
			[
				'label'              => esc_html__('Link URL', 'avas-core'),
				'type'               => Controls_Manager::URL,
				'placeholder'        => esc_html__('https://your-website.com', 'avas-core'),
				'show_external'      => true,
				'default'            => ['url' => ''],
				'dynamic'            => ['active' => true],
				'render_type'        => 'none',
			]
		);
	}

	public function wrapper_link_before_render($element)	{
		$element_link = $element->get_settings_for_display('tx_wrapper_link');

		if ( $element_link && !empty($element_link['url']) ) {
			$element->add_render_attribute(
				'_wrapper',
				[
					'data-tx-wrapper-link' => json_encode($element_link),
					'style' => 'cursor: pointer',
					'class' => 'tx-wrapper-link'
				]
			);

			wp_enqueue_script( 'tx-wrapper-link' );
		}
	}

       
 }

