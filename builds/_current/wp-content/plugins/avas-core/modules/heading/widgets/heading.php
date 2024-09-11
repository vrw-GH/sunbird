<?php
namespace AvasElements\Modules\Heading\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Heading extends Widget_Base {

    public function get_name() {
        return 'avas-heading';
    }

    public function get_title() {
        return esc_html__( 'Avas Heading', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-t-letter-bold';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'hd_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
            'hd_icon',
            [
                'label' => esc_html__( 'Icon', 'avas-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'tx_selected_icon',
                'skin'             => 'inline',
                'label_block'      => false,
            ]
        );
        $this->add_control(
          'hd_icon_position',
            [
            'label'         => esc_html__( 'Icon Position', 'avas-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'top',
                'options'       => [
                    'top'       => esc_html__( 'Top', 'avas-core' ),
                    'bottom'    => esc_html__( 'Bottom', 'avas-core' ),
                ],
            ]
        );
        $this->add_control(
            'hd_sub',
            [
                'label' => esc_html__( 'Sub Heading', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Sub Heading', 'avas-core' ),
            ]
        );
        $this->add_control(
            'hd_first_part',
            [
                'label' => esc_html__( 'Main Heading (First Part)', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Heading', 'avas-core' ),
            ]
        );
        $this->add_control(
            'hd_last_part',
            [
                'label' => esc_html__( 'Main Heading (Last Part)', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Example', 'avas-core' ),
            ]
        );
        $this->add_control(
            'hd_watermark',
            [
                'label' => esc_html__( 'Watermark Heading', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Watermark', 'avas-core' ),
            ]
        );
        $this->add_control(
            'hd_desc',
            [
                'label' => esc_html__( 'Description', 'avas-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore.', 'avas-core' ),
            ]
        );
        $this->add_control(
            'hd_html_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h2',
                'options'   => [
                        'h1'    => 'H1',
                        'h2'    => 'H2',
                        'h3'    => 'H3',
                        'h4'    => 'H4',
                        'h5'    => 'H5',
                        'h6'    => 'H6',
                        'div'   => 'div',
                        'span'  => 'Span',
                        'p'     => 'P'
                    ],
            ]
        );
        $this->add_control(
            'hd_link',
            [
                'label'        => esc_html__( 'Link', 'avas-core' ),
                'type'         => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'hd_link_url',
            [
                'label'       => esc_html__( 'Link URL', 'avas-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
                'condition' => [
                    'hd_link' => 'yes'
                ]
                
            ]
        );
        $this->add_responsive_control(
            'hd_alignment',
            [
                'label' => esc_html__( 'Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'avas-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => false,
                'prefix_class' => 'tx-hd-align-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_help_docs',
                [
                    'label' => esc_html__( 'Help Docs', 'avas-core' ),
                ]
        );
        $this->add_control(
            'help_doc_title',
                [
                    'type'  => Controls_Manager::RAW_HTML,
                    'raw'   => sprintf( '<a href="https://bit.ly/34GnB1L" target="_blank">View Example <i class="fas fa-external-link-alt"></i></a>', 'avas-core' ),
                ]
            );
        $this->end_controls_section();

		$this->start_controls_section(
			'hd_main_style',
			[
				'label' 	=> esc_html__( 'Main Heading', 'avas-core' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_responsive_control(
            'hd_main_width',
            [
                'label' => esc_html__( 'Width', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-wrap' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'hd_main_border',
                'selector'    =>    '{{WRAPPER}} .tx-hd-title'
            ]
        );
        $this->add_control(
            'hd_title_arrow',
            [
                'label'         => esc_html__( 'Main Heading Arrow', 'avas-core' ),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'hd_title_arrow_vertical',
            [
                'label'   => esc_html__( 'Arrow Vertical Position', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-title:after'   => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'hd_title_arrow' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'hd_title_arrow_horizontal',
            [
                'label'   => esc_html__( 'Arrow Horizontal Position', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-title:after'   => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'hd_title_arrow' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'hd_title_arrow_bg_color',
            [
                'label'     => esc_html__( 'Arrow Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#121212',
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-title:after' => 'border-color: {{VALUE}} rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);',
                ],
                'condition' => [
                    'hd_title_arrow' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_main_padding',
            [
                'label'         => esc_html__( 'Main Heading Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_main_margin',
            [
                'label'         => esc_html__( 'Main Heading Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'hd_main_first_bg_color',
            [
                'label'     => esc_html__( 'Main Heading First Part Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-first-part' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'hd_main_first_bg_hov_color',
            [
                'label'     => esc_html__( 'Main Heading First Part Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-first-part:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hd_main_first_color',
            [
                'label'     => esc_html__( 'Main Heading First Part Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-first-part' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hd_main_first_hov_color',
            [
                'label'     => esc_html__( 'Main Heading First Part Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-first-part:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hd_main_first_border_hov_color',
            [
                'label'     => esc_html__( 'Main Heading First Part Border Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-first-part:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'hd_main_first_typo',
                'label'     => esc_html__( 'Main Heading First Part Typography', 'avas-core' ),
                'selector'  => '{{WRAPPER}} .tx-hd-first-part',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'hd_main_first_text_shadow',
                'label'     => esc_html__( 'Main Heading First Part Text Shadow', 'avas-core' ),
                'selector'  => '{{WRAPPER}} .tx-hd-first-part',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'hd_main_first_border',
                'selector'    =>    '{{WRAPPER}} .tx-hd-first-part'
            ]
        );
        $this->add_responsive_control(
            'hd_main_first_padding',
            [
                'label'         => esc_html__( 'Main Heading First Part Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-first-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_main_first_margin',
            [
                'label'         => esc_html__( 'Main Heading First Part Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-first-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hd_main_last_bg_color',
            [
                'label'     => esc_html__( 'Main Heading Last Part Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-last-part' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'hd_main_last_bg_hov_color',
            [
                'label'     => esc_html__( 'Main Heading Last Part Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-last-part:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hd_main_last_color',
            [
                'label'     => esc_html__( 'Main Heading Last Part Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-last-part' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hd_main_last_hov_color',
            [
                'label'     => esc_html__( 'Main Heading Last Part Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-last-part:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hd_main_last_border_hov_color',
            [
                'label'     => esc_html__( 'Main Heading Last Part Border Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-last-part:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'hd_main_last_typo',
                'label'     => esc_html__( 'Main Heading Last Part Typography', 'avas-core' ),
                'selector'  => '{{WRAPPER}} .tx-hd-last-part',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'hd_main_last_text_shadow',
                'label'     => esc_html__( 'Main Heading Last Part Text Shadow', 'avas-core' ),
                'selector'  => '{{WRAPPER}} .tx-hd-last-part',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'hd_main_last_border',
                'selector'    =>    '{{WRAPPER}} .tx-hd-last-part'
            ]
        );
        $this->add_responsive_control(
            'hd_main_last_padding',
            [
                'label'         => esc_html__( 'Main Heading Last Part Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-last-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_main_last_margin',
            [
                'label'         => esc_html__( 'Main Heading Last Part Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-last-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        $this->start_controls_section(
            'hd_icon_style',
            [
                'label'     => esc_html__( 'Icon', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'hd_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-hd-wrap svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hd_icon_size',
            [
                'label'   => esc_html__( 'Icon Size', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 28,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-icon'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-hd-wrap svg'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_icon_padding',
            [
                'label'         => esc_html__( 'Icon Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-icon,{{WRAPPER}} .tx-hd-wrap svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_icon_margin',
            [
                'label'         => esc_html__( 'Icon Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-icon,{{WRAPPER}} .tx-hd-wrap svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'hd_sub_style',
            [
                'label'     => esc_html__( 'Sub Heading', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'hd_sub_color',
            [
                'label'     => esc_html__( 'Sub Header Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-sub' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'hd_sub_typo',
                'selector'  => '{{WRAPPER}} .tx-hd-sub',
            ]
        );
        $this->add_responsive_control(
            'hd_sub_padding',
            [
                'label'         => esc_html__( 'Sub Header Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-sub' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_sub_margin',
            [
                'label'         => esc_html__( 'Sub Header Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-sub' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'hd_desc_style',
            [
                'label'     => esc_html__( 'Heading Description', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'hd_desc_color',
            [
                'label'     => esc_html__( 'Heading Description Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'hd_desc_typo',
                'selector'  => '{{WRAPPER}} .tx-hd-desc, {{WRAPPER}} .tx-hd-desc p, {{WRAPPER}} .tx-hd-desc div, {{WRAPPER}} .tx-hd-desc h1, {{WRAPPER}} .tx-hd-desc h2, {{WRAPPER}} .tx-hd-desc span, {{WRAPPER}} .tx-hd-desc h2, {{WRAPPER}} .tx-hd-desc h3, {{WRAPPER}} .tx-hd-desc h4, {{WRAPPER}} .tx-hd-desc h5, {{WRAPPER}} .tx-hd-desc h6',
            ]
        );
        $this->add_responsive_control(
            'hd_desc_padding',
            [
                'label'         => esc_html__( 'Heading Description Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_desc_margin',
            [
                'label'         => esc_html__( 'Heading Description Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        $this->start_controls_section(
            'hd_watermark_style',
            [
                'label'     => esc_html__( 'Watermark', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'hd_wm_color',
            [
                'label'     => esc_html__( 'Heading Watermark Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-hd-wm' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'hd_wm_typo',
                'selector'  => '{{WRAPPER}} .tx-hd-wm',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'hd_wm_shadow',
                'selector' => '{{WRAPPER}} .tx-hd-wm'
            ]
        );
        $this->add_responsive_control(
            'hd_wm_padding',
            [
                'label'         => esc_html__( 'Heading Watermark Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-wm' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_wm_margin',
            [
                'label'         => esc_html__( 'Heading Watermark Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-hd-wm' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render( ) {
		$settings = $this->get_settings();
        $target = $settings['hd_link_url']['is_external'] ? '_blank' : '_self';
        if ( ! isset( $settings['tx_selected_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // add old default
            $settings['tx_selected_icon'] = 'far fa-paper-plane';
        }
        $migrated  = isset( $settings['__fa4_migrated']['hd_icon'] );
        $is_new    = empty( $settings['tx_selected_icon'] ) && Icons_Manager::is_migration_allowed();
        ?>
        <div class="tx-hd-wrap">

            <div class="tx-hd-wm"><?php echo wp_kses_post($settings['hd_watermark']); ?></div>

            <?php if ( ! empty( $settings['hd_icon']['value'] ) && $settings['hd_icon_position'] == 'top' ) :
                if ( $is_new || $migrated ) :
                    Icons_Manager::render_icon( $settings['hd_icon'], [ 'aria-hidden' => 'true', 'class' => 'tx-hd-icon' ] );
                else :
             ?>
                <i class="<?php echo esc_attr($settings['tx_selected_icon']); ?> tx-hd-icon" aria-hidden="true"></i>
            <?php endif; ?>
            <?php endif; ?>

            <div class="tx-hd-sub"><?php echo wp_kses_post($settings['hd_sub']); ?></div>
            <?php if($settings['hd_link'] == 'yes') : ?>
            <a class="tx-hd-title-link" href="<?php echo esc_url($settings['hd_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
            <<?php echo esc_attr($settings['hd_html_tag']); ?> class="tx-hd-title">
                <span class="tx-hd-first-part"><?php echo esc_attr( $settings['hd_first_part']); ?></span>
                <span class="tx-hd-last-part"><?php echo esc_attr( $settings['hd_last_part'] ); ?></span>
            </<?php echo esc_attr($settings['hd_html_tag']); ?>>
            </a>
            <?php else: ?>
            <<?php echo esc_attr($settings['hd_html_tag']); ?> class="tx-hd-title">
                <span class="tx-hd-first-part"><?php echo esc_attr( $settings['hd_first_part'] ); ?></span>
                <span class="tx-hd-last-part"><?php echo esc_attr( $settings['hd_last_part'] ); ?></span>
            </<?php echo esc_attr($settings['hd_html_tag']); ?>>    
            <?php endif; ?>

            <div class="tx-hd-desc"><?php echo wp_kses_post($settings['hd_desc']); ?></div>


            <?php if ( ! empty( $settings['hd_icon']['value'] ) && $settings['hd_icon_position'] == 'bottom' ) :
                if ( $is_new || $migrated ) :
                    Icons_Manager::render_icon( $settings['hd_icon'], [ 'aria-hidden' => 'true', 'class' => 'tx-hd-icon' ] );
                else :
             ?>
                <i class="<?php echo esc_attr($settings['tx_selected_icon']); ?> tx-hd-icon" aria-hidden="true"></i>
            <?php endif; ?>
            <?php endif; ?>
       
        </div><!-- tx-hd-wrap -->








<?php
	}
}
