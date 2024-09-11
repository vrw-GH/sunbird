<?php
namespace AvasElements\Modules\Iconbox\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Group_Control_Background;
use elementor\Group_Control_Box_Shadow;
use elementor\Icons_Manager;
use elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class IconBox extends Widget_Base {

	public function get_name() {
		return 'avas-icon-box';
	}

	public function get_title() {
		return esc_html__( 'Avas Icon Box', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'icon', 'box' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'ib_settings',
			[
				'label' => esc_html__( 'Settings', 'avas-core' ),
			]
		);
		$this->add_responsive_control(
			'ib_select',
			[
				'label' => esc_html__( 'Select Icon or Image', 'avas-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => esc_html__( 'Icon', 'avas-core' ),
						'icon' => 'far fa-smile-beam',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'avas-core' ),
						'icon' => 'far fa-image',
					]
				],
				'default' => 'icon',
			]
		);
		$this->add_control(
			'ib_icon',
			[
				'label' => esc_html__( 'Icon', 'avas-core' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-snowflake',
					'library' => 'fa-solid',
				],
				'condition' => [
					'ib_select' => 'icon'
				]
			]
		);
		$this->add_control(
			'ib_image',
			[
				'label' => esc_html__( 'Image', 'avas-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ib_select' => 'image'
				]
			]
		);
		$this->add_control(
			'ib_style',
			[
				'label' => esc_html__( 'Layout', 'avas-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' => esc_html__( 'Style 1', 'avas-core' ),
					'style-2' => esc_html__( 'Style 2', 'avas-core' ),
					'style-3' => esc_html__( 'Style 3', 'avas-core' ),
				],
				'default' => 'style-1',
			]
		);
		$this->add_control(
			'ib_position',
			[
				'label' => esc_html__( 'Position', 'avas-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'avas-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'avas-core' ),
						'icon' => 'eicon-v-align-middle',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'avas-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_control(
			'ib_icon_space_vertical_left',
			[
				'label' => esc_html__( 'Icon Spacing Vertical', 'avas-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'condition' => [
					'ib_position' => 'left',
					'ib_style' => 'style-2',
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap.style-2.left .tx-icon-box-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ib_icon_space_horizontal_left',
			[
				'label' => esc_html__( 'Icon Spacing Horizontal', 'avas-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'condition' => [
					'ib_position' => 'left',
					'ib_style' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap.style-2.left .tx-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ib_icon_space_vertical_right',
			[
				'label' => esc_html__( 'Icon Spacing Vertical', 'avas-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'condition' => [
					'ib_position' => 'right',
					'ib_style' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap.style-2.right .tx-icon-box-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ib_icon_space_horizontal_right',
			[
				'label' => esc_html__( 'Icon Spacing Horizontal', 'avas-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'default' => [
					'size' => 20,
				],
				'condition' => [
					'ib_position' => 'right',
					'ib_style' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap.style-2.right .tx-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ib_title',
			[
				'label'   => esc_html__( 'Title', 'avas-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default'     => esc_html__( 'This is the title', 'avas-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
            'ib_html_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h4',
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
			'ib_link',
			[
				'label'        => esc_html__( 'Title Link', 'avas-core' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'ib_link_url',
			[
				'label'       => esc_html__( 'Title Link URL', 'avas-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'condition'   => [
				 'ib_link' => 'yes'
				]
			]
		);

		$this->add_control(
			'ib_desc',
			[
				'label'   => esc_html__( 'Description', 'avas-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
				'default'     => esc_html__( 'Suspendisse potenti Phasellus euismod libero in neque molestie et mentum libero maximus. Etiam in enim vestibulum suscipit sem quis molestie nibh.', 'avas-core' ),
				'placeholder' => esc_html__( 'Enter your description', 'avas-core' ),
			]
		);
		$this->add_control(
			'ib_btn',
			[
				'label'        => esc_html__( 'Button', 'avas-core' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'ib_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'avas-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read More', 'avas-core' ),
				'placeholder' => esc_html__( 'Enter Text', 'avas-core' ),
				'condition' => [
				'ib_btn' => 'yes'
				]
			]

		);

		$this->add_control(
			'ib_btn_link',
			[
				'label'     => esc_html__( 'Button Link', 'avas-core' ),
				'type'      => Controls_Manager::URL,
				'dynamic'   => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'avas-core' ),
				'default'     => [
					'url' => '#',
				],
				'condition' => [
				'ib_btn' => 'yes'
				]
			]
		);
		$this->add_control(
			'ib_btn_icon',
			[
				'label' => esc_html__( 'Button Icon', 'avas-core' ),
				'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'tx_selected_icon',
                'skin'             => 'inline',
                'exclude_inline_options' => ['svg'],
                'label_block'      => false,
				'condition' => [
					'ib_btn' => 'yes'
				]
			]
		);

		$this->add_control(
			'ib_btn_icon_position',
			[
				'label' => esc_html__( 'Button Icon Position', 'avas-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before' => esc_html__( 'Before', 'avas-core' ),
					'after' => esc_html__( 'After', 'avas-core' ),
				],
				'condition' => [
					'ib_btn' => 'yes'
				],
			]
		);

		$this->add_control(
			'ib_btn_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'avas-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'condition' => [
					'ib_btn' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .tx-ib-btn-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tx-ib-btn-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'ib_styles',
            [
                'label'                 => esc_html__( 'Style', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'ib_normal',
			[
				'label' => esc_html__( 'Normal', 'avas-core' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ib_bg',
				'selector'  => '{{WRAPPER}} .tx-icon-box-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_bg_border',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-wrap'
			]
		);
		$this->add_responsive_control(
			'ib_bg_border_radius',
			[
				'label'      => esc_html__( 'Background Border Radius', 'avas-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tx-icon-box-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ib_bg_shadow',
				'selector' => '{{WRAPPER}} .tx-icon-box-wrap'
			]
		);
		$this->add_control(
			'ib_bg_rotate',
			[
				'label'   => esc_html__( 'Rotate', 'avas-core' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_responsive_control(
            'ib_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ib_icon_color',
            [
                'label' => esc_html__('Icon Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-icon-box-icon svg' => 'fill: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ib_icon_bg_color',
            [
                'label' => esc_html__('Icon Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon i, {{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ib_icon_size',
            [
                'label' => esc_html__('Icon Size', 'avas-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 999,
                    ],
                
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-icon-box-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-icon-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
			'ib_icon_rotate',
			[
				'label'   => esc_html__( 'Icon Rotate', 'avas-core' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-icon img'   => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .tx-icon-box-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_icon_border',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon i, {{WRAPPER}} .tx-icon-box-icon svg'
			]
		);
		$this->add_responsive_control(
			'ib_icon_border_radius',
			[
				'label'      => esc_html__( 'Icon Border Radius', 'avas-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon i, {{WRAPPER}} .tx-icon-box-icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'ib_icon_margin_bottom',
            [
                'label' => esc_html__('Icon Margin Bottom', 'avas-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon i, {{WRAPPER}} .tx-icon-box-icon svg' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
		$this->add_responsive_control(
            'ib_icon_padding',
            [
                'label' => esc_html__( 'Icon Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon i, {{WRAPPER}} .tx-icon-box-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ib_icon_shadow',
				'selector' => '{{WRAPPER}} .tx-icon-box-icon i, {{WRAPPER}} .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-icon svg'
			]
		);
        $this->add_control(
            'ib_title_color',
            [
                'label' => esc_html__('Title Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ib_title_typography',
				'selector'  => '{{WRAPPER}} .tx-icon-box-title',
			]
		);
        $this->add_control(
            'ib_desc_color',
            [
                'label' => esc_html__('Description Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ib_desc_typography',
				'selector'  => '{{WRAPPER}} .tx-icon-box-desc, {{WRAPPER}} .tx-icon-box-desc p, {{WRAPPER}} .tx-icon-box-desc div, {{WRAPPER}} .tx-icon-box-desc span, {{WRAPPER}} .tx-icon-box-desc h1, {{WRAPPER}} .tx-icon-box-desc h2, {{WRAPPER}} .tx-icon-box-desc h3, {{WRAPPER}} .tx-icon-box-desc h4, {{WRAPPER}} .tx-icon-box-desc h5, {{WRAPPER}} .tx-icon-box-desc h6',
			]
		);
		$this->add_control(
            'ib_btn_color',
            [
                'label' => esc_html__('Button Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ib_btn_bg_color',
            [
                'label' => esc_html__('Button Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ib_btn_typography',
				'selector'  => '{{WRAPPER}} .tx-icon-box-btn',
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_btn_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-btn'
			]
		);
		$this->add_responsive_control(
			'ib_btn_border_radius',
			[
				'label'      => esc_html__( 'Button Border Radius', 'avas-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tx-icon-box-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'ib_btn_padding',
            [
                'label' => esc_html__( 'Button Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ib_btn_margin',
            [
                'label' => esc_html__( 'Button Space', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
			'ib_hover',
			[
				'label' => esc_html__( 'Hover', 'avas-core' ),
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ib_bg_hov',
				'selector'  => '{{WRAPPER}} .tx-icon-box-wrap:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_bg_border_hov',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-wrap:hover'
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ib_bg_hov_shadow',
				'selector' => '{{WRAPPER}} .tx-icon-box-wrap:hover'
			]
		);
		$this->add_control(
			'ib_bg_rotate_hov',
			[
				'label'   => esc_html__( 'Hover Rotate', 'avas-core' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap:hover'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_control(
            'ib_icon_hov_color',
            [
                'label' => esc_html__('Icon Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon:hover i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ib_icon_bg_hov_color',
            [
                'label' => esc_html__('Icon Background Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-icon:hover i' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_icon_border_hov',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-icon:hover img, {{WRAPPER}} .tx-icon-box-icon:hover i'
			]
		);
		$this->add_control(
			'ib_icon_rotate_hov',
			[
				'label'   => esc_html__( 'Icon Rotate Hover', 'avas-core' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tx-icon-box-wrap:hover .tx-icon-box-icon img, {{WRAPPER}} .tx-icon-box-wrap:hover .tx-icon-box-icon i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
        $this->add_control(
            'ib_title_hov_color',
            [
                'label' => esc_html__('Title Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-title:hover' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ib_btn_hov_color',
            [
                'label' => esc_html__('Button Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn:hover' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ib_btn_bg_hov_color',
            [
                'label' => esc_html__('Button Background Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-icon-box-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ib_btn_hov_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => 	'{{WRAPPER}} .tx-icon-box-btn:hover'
			]
		);



		$this->end_controls_tab();



        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$target = $settings['ib_link_url']['is_external'] ? '_blank' : '_self';
		$target_btn = $settings['ib_btn_link']['is_external'] ? '_blank' : '_self';
		$migrated  = isset( $settings['__fa4_migrated']['ib_btn_icon'] );
        $is_new    = empty( $settings['tx_selected_icon'] ) && Icons_Manager::is_migration_allowed();

		?>	
		<div class="tx-icon-box-wrap <?php echo esc_attr($settings['ib_style'] . ' ' . $settings['ib_position']); ?>">

			<div class="tx-icon-box-icon">
				<?php 
					if ($settings['ib_select'] == 'icon') { 
						Icons_Manager::render_icon( $settings['ib_icon'], [ 'aria-hidden' => 'true' ] );
					}
					if ($settings['ib_select'] == 'image') { ?>
						<img src="<?php echo esc_attr($settings['ib_image']['url']); ?>">
					<?php }
				?>

				<?php if($settings['ib_style'] == 'style-3') : ?>
				<?php if($settings['ib_link'] == 'yes') : ?>
				<a href="<?php echo esc_url($settings['ib_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-icon-box-title">
				<?php echo esc_html($settings['ib_title']); ?>
				</<?php echo esc_attr($settings['ib_html_tag']); ?>>
				</a>
				<?php else : ?>
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-icon-box-title">
				<?php echo esc_html($settings['ib_title']); ?>
				</<?php echo esc_attr($settings['ib_html_tag']); ?>>
				<?php endif; ?>
				<?php endif; ?>

			</div><!-- tx-icon-box-icon -->

			<div class="tx-icon-box-content-wrap">

				<?php if($settings['ib_style'] == 'style-1' || $settings['ib_style'] == 'style-2') : ?>
				<?php if($settings['ib_link'] == 'yes') : ?>
				<a href="<?php echo esc_url($settings['ib_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-icon-box-title">
				<?php echo esc_html($settings['ib_title']); ?>
				</<?php echo esc_attr($settings['ib_html_tag']); ?>>
				</a>
				<?php else : ?>
				<<?php echo esc_attr($settings['ib_html_tag']); ?> class="tx-icon-box-title">
				<?php echo esc_html($settings['ib_title']); ?>
				</<?php echo esc_attr($settings['ib_html_tag']); ?>>
				<?php endif; ?>
				<?php endif; ?>

				<div class="tx-icon-box-desc"><?php echo wp_kses_post($settings['ib_desc']); ?></div>
				<?php if($settings['ib_btn'] == 'yes') : ?>
				<div class="tx-icon-box-btn-wrap">
					<a class="tx-icon-box-btn" href="<?php echo esc_url($settings['ib_btn_link']['url']); ?>" target="<?php echo esc_attr($target_btn); ?>">
						

						<?php if ( ! empty( $settings['ib_btn_icon']['value'] ) && $settings['ib_btn_icon_position'] =='before' ) :
			                if ( $is_new || $migrated ) :
			                    Icons_Manager::render_icon( $settings['ib_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'tx-ib-btn-icon-before'] );
			                else :
			             ?>
			                <i class="<?php echo esc_attr($settings['tx_selected_icon']); ?> tx-ib-btn-icon-before" aria-hidden="true"></i>
			            <?php endif; ?>
			            <?php endif; ?>


						<?php echo esc_html($settings['ib_btn_text']); ?>

						<?php if ( ! empty( $settings['ib_btn_icon']['value'] ) && $settings['ib_btn_icon_position'] =='after' ) :
			                if ( $is_new || $migrated ) :
			                    Icons_Manager::render_icon( $settings['ib_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'tx-ib-btn-icon-after'] );
			                else :
			             ?>
			                <i class="<?php echo esc_attr($settings['tx_selected_icon']); ?> tx-ib-btn-icon-after" aria-hidden="true"></i>
			            <?php endif; ?>
			            <?php endif; ?>

					</a>
				</div><!-- tx-icon-box-btn-wrap -->
				<?php endif; ?>
			</div><!-- tx-icon-box-content-wrap -->

		</div><!-- tx-icon-box-wrap -->

<?php }

}
