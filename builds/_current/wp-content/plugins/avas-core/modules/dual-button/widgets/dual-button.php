<?php
namespace AvasElements\Modules\DualButton\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Border;
use elementor\Group_Control_Background;
use elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class DualButton extends Widget_Base {

	public function get_name() {
		return 'avas-dual-button';
	}

	public function get_title() {
		return esc_html__( 'Avas Dual Button', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-dual-button';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'button', 'dual', 'multi', 'primary', 'secondary' ];
	}
	
	protected function register_controls() {
		$this->start_controls_section(
			'btn_content',
			[
				'label' => esc_html__( 'Buttons', 'avas-core' ),
			]
		);
        $this->start_controls_tabs( 'btn_tabs' );

        $this->start_controls_tab(
            'btn_primary',
            [
                'label' => esc_html__( 'Primary', 'avas-core' ),
            ]
        );
        $this->add_control(
                'btn_primary_text',
                [
                    'label'       => esc_html__( 'Primary Button Text', 'avas-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block'   => true,
                    'default'     => 'PRIMARY',
                    'placeholder' => esc_html__( 'Enter primary button text', 'avas-core' ),
                ]
        );
        $this->add_control(
            'btn_primary_link_url',
            [
                'label'       => esc_html__( 'Primary Link URL', 'avas-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
                'default'     => [
                    'url' => '#',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_primary_width',
            [
                'label' => esc_html__( 'Primary Button Width', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],
                    'px' => [
                        'max' => 1200,
                    ],
                ],
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-primary' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'btn_primary_icon',
                [
                    'label'            => esc_html__( 'Primary Button Icon', 'avas-core' ),
                    'type'             => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                ]
        );
        $this->add_control(
            'btn_primary_icon_position',
            [
                'label' => esc_html__( 'Primary Button Icon Position', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__( 'Before', 'avas-core' ),
                    'after' => esc_html__( 'After', 'avas-core' ),
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'btn_primary_icon[value]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_primary_icon_indent',
            [
                'label' => esc_html__( 'Primary Button Icon Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-pri-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-dual-btn-pri-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'btn_primary_icon[value]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_secondary',
            [
                'label' => esc_html__( 'Secondary', 'avas-core' ),
            ]
        );
        $this->add_control(
                'btn_secondary_text',
                [
                    'label'       => esc_html__( 'Secondary Button Text', 'avas-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block'   => true,
                    'default'     => 'SECONDARY',
                    'placeholder' => esc_html__( 'Enter secondary button text', 'avas-core' ),
                ]
        );
        $this->add_control(
            'btn_secondary_link_url',
            [
                'label'       => esc_html__( 'Secondary Link URL', 'avas-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
                'default'     => [
                    'url' => '#',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_secondary_width',
            [
                'label' => esc_html__( 'Secondary Button Width', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'max' => 100,
                    ],
                    'px' => [
                        'max' => 1200,
                    ],
                ],
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-secondary' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
                'btn_secondary_icon',
                [
                    'label'            => esc_html__( 'Secondary Button Icon', 'avas-core' ),
                    'type'             => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                ]
        );
        $this->add_control(
            'btn_secondary_icon_position',
            [
                'label' => esc_html__( 'Secondary Button Icon Position', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__( 'Before', 'avas-core' ),
                    'after' => esc_html__( 'After', 'avas-core' ),
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'btn_secondary_icon[value]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_secondary_icon_indent',
            [
                'label' => esc_html__( 'Secondary Button Icon Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-sec-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-dual-btn-sec-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'btn_secondary_icon[value]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->end_controls_tab();   
        $this->end_controls_tabs();
		
		$this->add_responsive_control(
            'btn_alignment',
            [
                'label' => esc_html__( 'Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'avas-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors'         => [
					'{{WRAPPER}} .tx-dual-btn-wrap'   => 'justify-content: {{VALUE}};',
				],
                'separator' => 'before',
            ]
        );
        if(!is_rtl()):
        $this->add_responsive_control(
            'btn_gap',
            [
                'label' => esc_html__( 'Gap', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-primary' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        endif;
        if(is_rtl()):
            $this->add_responsive_control(
            'btn_gap_rtl',
            [
                'label' => esc_html__( 'Gap', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-primary' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        endif;
		$this->end_controls_section();

		$this->start_controls_section(
            'btn_styles_primary',
            [
                'label'                 => esc_html__( 'Primary Button Style', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->start_controls_tabs( 'btn_primary_tabs_style' );

		$this->start_controls_tab(
			'btn_primary_tab_normal',
			[
				'label' => esc_html__( 'Normal', 'avas-core' ),
			]
		);
        $this->add_control(
            'btn_pri_gradient',
            [
                'label' => esc_html__( 'Gradient Background Color', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none'  => esc_html__( 'None', 'avas-core' ),
                    'color-1'  => esc_html__( 'Color 1', 'avas-core' ),
                    'color-2'  => esc_html__( 'Color 2', 'avas-core' ),
                    'color-3'  => esc_html__( 'Color 3', 'avas-core' ),
                    'color-4'  => esc_html__( 'Color 4', 'avas-core' ),
                    'color-5'  => esc_html__( 'Color 5', 'avas-core' ),
                    'color-6'  => esc_html__( 'Color 6', 'avas-core' ),
                    'color-7'  => esc_html__( 'Color 7', 'avas-core' ),
                    'color-8'  => esc_html__( 'Color 8', 'avas-core' ),
                    'color-9'  => esc_html__( 'Color 9', 'avas-core' ),
                    'color-10'  => esc_html__( 'Color 10', 'avas-core' ),
                    'color-11'  => esc_html__( 'Color 11', 'avas-core' ),
                    'color-12'  => esc_html__( 'Color 12', 'avas-core' ),
                    'color-13'  => esc_html__( 'Color 13', 'avas-core' ),
                    'color-14'  => esc_html__( 'Color 14', 'avas-core' ),
                    'color-15'  => esc_html__( 'Color 15', 'avas-core' ),
                    'color-16'  => esc_html__( 'Color 16', 'avas-core' ),
                    'color-17'  => esc_html__( 'Color 17', 'avas-core' ),
                    'color-18'  => esc_html__( 'Color 18', 'avas-core' ),
                    'color-19'  => esc_html__( 'Color 19', 'avas-core' ),
                    'color-20'  => esc_html__( 'Color 20', 'avas-core' ),
                    'color-21'  => esc_html__( 'Color 21', 'avas-core' ),
                    'color-22'  => esc_html__( 'Color 22', 'avas-core' ),
                    'color-23'  => esc_html__( 'Color 23', 'avas-core' ),
                    'color-24'  => esc_html__( 'Color 24', 'avas-core' ),
                    'color-25'  => esc_html__( 'Color 25', 'avas-core' ),
                    'color-26'  => esc_html__( 'Color 26', 'avas-core' ),
                    'color-27'  => esc_html__( 'Color 27', 'avas-core' ),
                    'color-28'  => esc_html__( 'Color 28', 'avas-core' ),
                    'color-29'  => esc_html__( 'Color 29', 'avas-core' ),
                    'color-30'  => esc_html__( 'Color 30', 'avas-core' ),
                    'color-31'  => esc_html__( 'Color 31', 'avas-core' ),
                    'color-32'  => esc_html__( 'Color 32', 'avas-core' ),
                    'color-33'  => esc_html__( 'Color 33', 'avas-core' ),
                    'color-34'  => esc_html__( 'Color 34', 'avas-core' ),
                    'color-35'  => esc_html__( 'Color 35', 'avas-core' ),
                    'color-36'  => esc_html__( 'Color 36', 'avas-core' ),
                    'color-37'  => esc_html__( 'Color 37', 'avas-core' ),
                    'color-38'  => esc_html__( 'Color 38', 'avas-core' ),
                    'color-39'  => esc_html__( 'Color 39', 'avas-core' ),
                    'color-40'  => esc_html__( 'Color 40', 'avas-core' ),
                    'color-41'  => esc_html__( 'Color 41', 'avas-core' ),
                    'color-42'  => esc_html__( 'Color 42', 'avas-core' ),
                    'color-43'  => esc_html__( 'Color 43', 'avas-core' ),
                    'color-44'  => esc_html__( 'Color 44', 'avas-core' ),
                    'color-45'  => esc_html__( 'Color 45', 'avas-core' ),
                    'color-46'  => esc_html__( 'Color 46', 'avas-core' ),
                    'color-47'  => esc_html__( 'Color 47', 'avas-core' ),
                    'color-48'  => esc_html__( 'Color 48', 'avas-core' ),
                    'color-49'  => esc_html__( 'Color 49', 'avas-core' ),
                    'color-50'  => esc_html__( 'Color 50', 'avas-core' ),
                ],
                'default' => 'none',
            ]
        );
        $this->add_control(
            'btn_primary_bg_color',
            [
                'label' => esc_html__('Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-primary' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'btn_pri_gradient' => 'none'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_pri_custom_bg',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-dual-btn-primary',
            ]
        );
		$this->add_control(
            'btn_primary_color',
            [
                'label' => esc_html__('Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-primary' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'btn_primary_typo',
                'selector'  => '{{WRAPPER}} .tx-dual-btn-primary',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_primary_box_shadow',
                'selector' => '{{WRAPPER}} .tx-dual-btn-primary',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'btn_primary_border',
                'selector'    =>    '{{WRAPPER}} .tx-dual-btn-primary'
            ]
        );
        $this->add_responsive_control(
            'btn_primary_border_radius',
            [
                'label'   => esc_html__( 'Border Radius', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-primary'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_primary_padding',
            [
                'label'         => esc_html__( 'Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-dual-btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_tab();

        $this->start_controls_tab(
			'btn_primary_tab_hover',
			[
				'label' => esc_html__( 'Hover', 'avas-core' ),
			]
		);
        $this->add_control(
            'btn_primary_hov_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'avas-core' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_control(
            'btn_pri_bg_hov_color',
            [
                'label' => esc_html__('Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-primary:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'btn_pri_gradient' => 'none'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_pri_custom_bg_hov',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-dual-btn-primary:hover',
            ]
        );
		$this->add_control(
            'btn_pri_hov_color',
            [
                'label' => esc_html__('Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-primary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'btn_pri_hov_border',
                'selector'    =>    '{{WRAPPER}} .tx-dual-btn-primary:hover'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_primary_hov_box_shadow',
                'selector' => '{{WRAPPER}} .tx-dual-btn-primary:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'btn_styles_secondary',
            [
                'label'                 => esc_html__( 'Secondary Button Style', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'btn_secondary_tabs_style' );
        $this->start_controls_tab(
            'btn_secondary_tab_normal',
            [
                'label' => esc_html__( 'Normal', 'avas-core' ),
            ]
        );
        $this->add_control(
            'btn_sec_gradient',
            [
                'label' => esc_html__( 'Gradient Background Color', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none'  => esc_html__( 'None', 'avas-core' ),
                    'color-1'  => esc_html__( 'Color 1', 'avas-core' ),
                    'color-2'  => esc_html__( 'Color 2', 'avas-core' ),
                    'color-3'  => esc_html__( 'Color 3', 'avas-core' ),
                    'color-4'  => esc_html__( 'Color 4', 'avas-core' ),
                    'color-5'  => esc_html__( 'Color 5', 'avas-core' ),
                    'color-6'  => esc_html__( 'Color 6', 'avas-core' ),
                    'color-7'  => esc_html__( 'Color 7', 'avas-core' ),
                    'color-8'  => esc_html__( 'Color 8', 'avas-core' ),
                    'color-9'  => esc_html__( 'Color 9', 'avas-core' ),
                    'color-10'  => esc_html__( 'Color 10', 'avas-core' ),
                    'color-11'  => esc_html__( 'Color 11', 'avas-core' ),
                    'color-12'  => esc_html__( 'Color 12', 'avas-core' ),
                    'color-13'  => esc_html__( 'Color 13', 'avas-core' ),
                    'color-14'  => esc_html__( 'Color 14', 'avas-core' ),
                    'color-15'  => esc_html__( 'Color 15', 'avas-core' ),
                    'color-16'  => esc_html__( 'Color 16', 'avas-core' ),
                    'color-17'  => esc_html__( 'Color 17', 'avas-core' ),
                    'color-18'  => esc_html__( 'Color 18', 'avas-core' ),
                    'color-19'  => esc_html__( 'Color 19', 'avas-core' ),
                    'color-20'  => esc_html__( 'Color 20', 'avas-core' ),
                    'color-21'  => esc_html__( 'Color 21', 'avas-core' ),
                    'color-22'  => esc_html__( 'Color 22', 'avas-core' ),
                    'color-23'  => esc_html__( 'Color 23', 'avas-core' ),
                    'color-24'  => esc_html__( 'Color 24', 'avas-core' ),
                    'color-25'  => esc_html__( 'Color 25', 'avas-core' ),
                    'color-26'  => esc_html__( 'Color 26', 'avas-core' ),
                    'color-27'  => esc_html__( 'Color 27', 'avas-core' ),
                    'color-28'  => esc_html__( 'Color 28', 'avas-core' ),
                    'color-29'  => esc_html__( 'Color 29', 'avas-core' ),
                    'color-30'  => esc_html__( 'Color 30', 'avas-core' ),
                    'color-31'  => esc_html__( 'Color 31', 'avas-core' ),
                    'color-32'  => esc_html__( 'Color 32', 'avas-core' ),
                    'color-33'  => esc_html__( 'Color 33', 'avas-core' ),
                    'color-34'  => esc_html__( 'Color 34', 'avas-core' ),
                    'color-35'  => esc_html__( 'Color 35', 'avas-core' ),
                    'color-36'  => esc_html__( 'Color 36', 'avas-core' ),
                    'color-37'  => esc_html__( 'Color 37', 'avas-core' ),
                    'color-38'  => esc_html__( 'Color 38', 'avas-core' ),
                    'color-39'  => esc_html__( 'Color 39', 'avas-core' ),
                    'color-40'  => esc_html__( 'Color 40', 'avas-core' ),
                    'color-41'  => esc_html__( 'Color 41', 'avas-core' ),
                    'color-42'  => esc_html__( 'Color 42', 'avas-core' ),
                    'color-43'  => esc_html__( 'Color 43', 'avas-core' ),
                    'color-44'  => esc_html__( 'Color 44', 'avas-core' ),
                    'color-45'  => esc_html__( 'Color 45', 'avas-core' ),
                    'color-46'  => esc_html__( 'Color 46', 'avas-core' ),
                    'color-47'  => esc_html__( 'Color 47', 'avas-core' ),
                    'color-48'  => esc_html__( 'Color 48', 'avas-core' ),
                    'color-49'  => esc_html__( 'Color 49', 'avas-core' ),
                    'color-50'  => esc_html__( 'Color 50', 'avas-core' ),
                ],
                'default' => 'none',
            ]
        );
        $this->add_control(
            'btn_secondary_bg_color',
            [
                'label' => esc_html__('Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-secondary' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'btn_sec_gradient' => 'none'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_secondary_custom_bg',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-dual-btn-secondary',
            ]
        );
        $this->add_control(
            'btn_secondary_color',
            [
                'label' => esc_html__('Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-secondary' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'btn_secondary_typo',
                'selector'  => '{{WRAPPER}} .tx-dual-btn-secondary',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_secondary_box_shadow',
                'selector' => '{{WRAPPER}} .tx-dual-btn-secondary',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'btn_secondary_border',
                'selector'    =>    '{{WRAPPER}} .tx-dual-btn-secondary'
            ]
        );
        $this->add_responsive_control(
            'btn_secondary_border_radius',
            [
                'label'   => esc_html__( 'Border Radius', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-secondary'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_secondary_padding',
            [
                'label'         => esc_html__( 'Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-dual-btn-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_secondary_tab_hover',
            [
                'label' => esc_html__( 'Hover', 'avas-core' ),
            ]
        );
        $this->add_control(
            'btn_secondary_hov_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'avas-core' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_control(
            'btn_secondary_bg_hov_color',
            [
                'label' => esc_html__('Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-secondary:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'btn_sec_gradient' => 'none'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_secondary_custom_bg_hov',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-dual-btn-secondary:hover',
            ]
        );
        $this->add_control(
            'btn_secondary_hov_color',
            [
                'label' => esc_html__('Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-dual-btn-secondary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'btn_secondary_hov_border',
                'selector'    =>    '{{WRAPPER}} .tx-dual-btn-secondary:hover'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_secondary_hov_box_shadow',
                'selector' => '{{WRAPPER}} .tx-dual-btn-secondary:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$target_primary = $settings['btn_primary_link_url']['is_external'] ? '_blank' : '_self';
        $target_secondary = $settings['btn_secondary_link_url']['is_external'] ? '_blank' : '_self';

        	$this->add_render_attribute( 'btn-primary-link', 'href', $settings['btn_primary_link_url']['url'] );
            $this->add_render_attribute( 'btn-primary-link', 'class', 'tx-dual-btn-primary ' . $settings['btn_pri_gradient'] . ' elementor-animation-' . $settings['btn_primary_hov_animation'] );
            $this->add_render_attribute( 'btn-secondary-link', 'href', $settings['btn_secondary_link_url']['url'] );
            $this->add_render_attribute( 'btn-secondary-link', 'class', 'tx-dual-btn-secondary ' . $settings['btn_sec_gradient'] . ' elementor-animation-' . $settings['btn_secondary_hov_animation'] );
		?>

		<div class="tx-dual-btn-wrap">

            <?php if ($settings['btn_primary_text'] !='') : ?>
                <a <?php echo $this->get_render_attribute_string( 'btn-primary-link' ); ?> target="<?php echo esc_attr($target_primary); ?>" >
                    <?php if( $settings['btn_primary_icon'] !='' && $settings['btn_primary_icon_position'] =='before'  ) : ?>
                        <span class="tx-dual-btn-pri-icon-before"><?php Icons_Manager::render_icon( $settings['btn_primary_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <?php echo esc_attr( $settings['btn_primary_text'] ); ?>
                    <?php if( $settings['btn_primary_icon'] !='' && $settings['btn_primary_icon_position'] =='after'  ) : ?>
                        <span class="tx-dual-btn-pri-icon-after"><?php Icons_Manager::render_icon( $settings['btn_primary_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?><!-- primary button end -->

            <?php if ($settings['btn_secondary_text'] !='') : ?>
                <a <?php echo $this->get_render_attribute_string( 'btn-secondary-link' ); ?> target="<?php echo esc_attr($target_secondary); ?>" >
                    <?php if( $settings['btn_secondary_icon'] !='' && $settings['btn_secondary_icon_position'] =='before'  ) : ?>
                        <span class="tx-dual-btn-sec-icon-before"><?php Icons_Manager::render_icon( $settings['btn_secondary_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <?php echo esc_attr( $settings['btn_secondary_text'] ); ?>
                    <?php if( $settings['btn_secondary_icon'] !='' && $settings['btn_secondary_icon_position'] =='after'  ) : ?>
                        <span class="tx-dual-btn-sec-icon-after"><?php Icons_Manager::render_icon( $settings['btn_secondary_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?><!-- secondary button end -->
			
		</div><!-- tx-dual-btn-wrap -->
		
		
<?php } // render()

} // class
