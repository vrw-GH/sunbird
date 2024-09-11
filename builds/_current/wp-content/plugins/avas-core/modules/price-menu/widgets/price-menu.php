<?php
namespace AvasElements\Modules\PriceMenu\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PriceMenu extends Widget_Base {

    public function get_name() {
        return 'avas-price-menu';
    }

    public function get_title() {
        return esc_html__( 'Avas Price Menu', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-price-list';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_keywords() {
        return [ 'price', 'menu' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content', 'avas-core' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'menu_title',
            [
                'label' => esc_html__( 'Title', 'avas-core' ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'label_block'   => true,
                'placeholder'   => esc_html__( 'Title', 'avas-core' ),
                'default'       => esc_html__( 'Title', 'avas-core' ),
            ]
        );
        $repeater->add_control(
            'menu_description',
            [
                'label'         => esc_html__( 'Description', 'avas-core' ),
                'type'          => Controls_Manager::TEXTAREA,
                'dynamic'       => [ 'active' => true ],
                'label_block'   => true,
                'placeholder'   => esc_html__( 'Description', 'avas-core' ),
                'default'       => esc_html__( 'Description', 'avas-core' ),
            ]
        );
        $repeater->add_control(
            'menu_price',
            [
               'label'         => esc_html__( 'Price', 'avas-core' ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'label_block'   => true,
                'default'       => '$49',
            ]
        );
        $repeater->add_control(
            'discount',
            [
                'label'         => esc_html__( 'Discount', 'avas-core' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'no',
                'label_on'      => esc_html__( 'On', 'avas-core' ),
                'label_off'     => esc_html__( 'Off', 'avas-core' ),
                'return_value'  => 'yes',
            ]
        );
        $repeater->add_control(
            'original_price',
            [
                'label'         => esc_html__( 'Original Price', 'avas-core' ),
                        'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => '$69',
                'condition'     => [
                    'discount' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'image_switch',
            [
                'label'         => esc_html__( 'Show Image', 'avas-core' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'label_on'      => esc_html__( 'On', 'avas-core' ),
                'label_off'     => esc_html__( 'Off', 'avas-core' ),
                'return_value'  => 'yes',
            ]
        );
        $repeater->add_control(
            'image',
            [
                'label'         => esc_html__( 'Image', 'avas-core' ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [
                    'active'    => true,
                    ],
                'condition'     => [
                    'image_switch' => 'yes',
                        ],
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label'         => esc_html__( 'Link', 'avas-core' ),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [
                    'active'    => true,
                ],
                'placeholder'   => 'https://www.your-link.com',
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label'                 => '',
                'type'                  => Controls_Manager::REPEATER,
                'default'               => [
                    [
                        'menu_title' => esc_html__( 'Menu Item #1', 'avas-core' ),
                        'menu_price' => '$49',
                    ],
                    [
                        'menu_title' => esc_html__( 'Menu Item #2', 'avas-core' ),
                        'menu_price' => '$49',
                    ],
                    [
                        'menu_title' => esc_html__( 'Menu Item #3', 'avas-core' ),
                        'menu_price' => '$49',
                    ],
                ],
               'fields' => $repeater->get_controls(),
               'title_field'       => '{{{ menu_title }}}',
            ]
        );
        
        $this->add_control(
          'menu_style',
          [
             'label'                => esc_html__( 'Menu Style', 'avas-core' ),
             'type'                 => Controls_Manager::SELECT,
             'default'              => 'style-1',
             'options'              => [
                'style-1'           => esc_html__( 'Style 1', 'avas-core' ),
                'style-2'           => esc_html__( 'Style 2', 'avas-core' ),
                'style-3'           => esc_html__( 'Style 3', 'avas-core' ),
                'style-4'           => esc_html__( 'Style 4', 'avas-core' ),
                'style-5'          => esc_html__( 'Style 5', 'avas-core' ),
             ],
          ]
        );
        
        $this->add_responsive_control(
            'menu_align',
            [
                'label'                 => esc_html__( 'Alignment', 'avas-core' ),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'avas-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-style-4'   => 'text-align: {{VALUE}};',
                ],
                'condition'             => [
                    'menu_style' => 'style-4',
                ],
            ]
        );
        
        $this->add_control(
            'title_price_connector',
            [
                'label'                 => esc_html__( 'Title-Price Connector', 'avas-core' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => esc_html__( 'Yes', 'avas-core' ),
                'label_off'             => esc_html__( 'No', 'avas-core' ),
                'return_value'          => 'yes',
                'condition'             => [
                    'menu_style' => 'style-1',
                ],
            ]
        );
        
        $this->add_control(
            'title_separator',
            [
                'label'                 => esc_html__( 'Title Separator', 'avas-core' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => esc_html__( 'Yes', 'avas-core' ),
                'label_off'             => esc_html__( 'No', 'avas-core' ),
                'return_value'          => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_items_style',
            [
                'label'                 => esc_html__( 'Menu Items', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'items_bg_color',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'items_spacing',
            [
                'label'                 => esc_html__( 'Items Spacing', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    '%' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-item-wrap' => 'margin-bottom: calc(({{SIZE}}{{UNIT}})/2); padding-bottom: calc(({{SIZE}}{{UNIT}})/2)',
                ],
            ]
        );

        $this->add_responsive_control(
            'items_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'items_border',
                'label'                 => esc_html__( 'Border', 'avas-core' ),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .tx-price-menu .tx-price-menu-item',
            ]
        );

        $this->add_control(
            'items_border_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'avas-core' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'pricing_table_shadow',
                'selector'              => '{{WRAPPER}} .tx-price-menu-item',
                'separator'             => 'before',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_content_style',
            [
                'label'                 => esc_html__( 'Content', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'menu_style' => 'style-5',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'             => [
                    'menu_style' => 'style-5',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label'                 => esc_html__( 'Title', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'title_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core' ),
                'selector'              => '{{WRAPPER}} .tx-price-menu .tx-price-menu-title',
            ]
        );
        
        $this->add_responsive_control(
            'title_margin',
            [
                'label'                 => esc_html__( 'Margin Bottom', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    '%' => [
                        'min'   => 0,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-header' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_separator_style',
            [
                'label'                 => esc_html__( 'Title Separator', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'title_separator' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'divider_title_border_type',
            [
                'label'                 => esc_html__( 'Border Type', 'avas-core' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'dotted',
                'options'               => [
                    'none'      => esc_html__( 'None', 'avas-core' ),
                    'solid'     => esc_html__( 'Solid', 'avas-core' ),
                    'double'    => esc_html__( 'Double', 'avas-core' ),
                    'dotted'    => esc_html__( 'Dotted', 'avas-core' ),
                    'dashed'    => esc_html__( 'Dashed', 'avas-core' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-divider' => 'border-bottom-style: {{VALUE}}',
                ],
                'condition'             => [
                    'title_separator' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'divider_title_border_weight',
            [
                'label'                 => esc_html__( 'Border Height', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => 1,
                ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 20,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'title_separator' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'divider_title_border_width',
            [
                'label'                 => esc_html__( 'Border Width', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => 100,
                    'unit'      => '%',
                ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 20,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-divider' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'title_separator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'divider_title_border_color',
            [
                'label'                 => esc_html__( 'Border Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-divider' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition'             => [
                    'title_separator' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'divider_title_spacing',
            [
                'label'                 => esc_html__( 'Margin Bottom', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    '%' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-divider' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_price_style',
            [
                'label'                 => esc_html__( 'Price', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'price_badge_heading',
            [
                'label'                 => esc_html__( 'Price Badge', 'avas-core' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'menu_style' => 'style-5',
                ],
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-style-5 .tx-price-menu-price' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'menu_style' => 'style-5',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-style-5 .tx-price-menu-price:after' => 'border-right-color: {{VALUE}}',
                ],
                'condition'             => [
                    'menu_style' => 'style-5',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-price-discount' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'menu_style!' => 'style-5',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'price_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core' ),
                'selector'              => '{{WRAPPER}} .tx-price-menu .tx-price-menu-price-discount',
            ]
        );
        
        $this->add_control(
            'original_price_heading',
            [
                'label'                 => esc_html__( 'Original Price', 'avas-core' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );
        
        $this->add_control(
            'original_price_strike',
            [
                'label'                 => esc_html__( 'Strikethrough', 'avas-core' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => esc_html__( 'On', 'avas-core' ),
                'label_off'             => esc_html__( 'Off', 'avas-core' ),
                'return_value'          => 'yes',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-price-original' => 'text-decoration: line-through;',
                ],
            ]
        );

        $this->add_control(
            'original_price_color',
            [
                'label'                 => esc_html__( 'Original Price Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#a3a3a3',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-price-original' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'original_price_typography',
                'label'                 => esc_html__( 'Original Price Typography', 'avas-core' ),
                'selector'              => '{{WRAPPER}} .tx-price-menu .tx-price-menu-price-original',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_description_style',
            [
                'label'                 => esc_html__( 'Description', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-description' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'description_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core' ),
                'selector'              => '{{WRAPPER}} .tx-price-menu-description',
            ]
        );
        
        $this->add_responsive_control(
            'description_spacing',
            [
                'label'                 => esc_html__( 'Margin Bottom', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    '%' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Image Section
         */
        $this->start_controls_section(
            'section_image_style',
            [
                'label'                 => esc_html__( 'Image', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'image_size',
                'label'                 => esc_html__( 'Image Size', 'avas-core' ),
                'default'               => 'thumbnail',
            ]
        );

        $this->add_control(
            'image_bg_color',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-image img' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'image_width',
            [
                'label'                 => esc_html__( 'Width', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 20,
                        'max'   => 300,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 5,
                        'max'   => 50,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-image img' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'                 => esc_html__( 'Margin', 'avas-core' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'image_border',
                'label'                 => esc_html__( 'Border', 'avas-core' ),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .tx-price-menu-image img',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'avas-core' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_vertical_position',
            [
                'label'                 => esc_html__( 'Vertical Position', 'avas-core' ),
                'type'                  => Controls_Manager::CHOOSE,
                'label_block'           => false,
                'options'               => [
                    'top'       => [
                        'title' => esc_html__( 'Top', 'avas-core' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle'    => [
                        'title' => esc_html__( 'Middle', 'avas-core' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'    => [
                        'title' => esc_html__( 'Bottom', 'avas-core' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu .tx-price-menu-image' => 'align-self: {{VALUE}}',
                ],
                'selectors_dictionary'  => [
                    'top'      => 'flex-start',
                    'middle'   => 'center',
                    'bottom'   => 'flex-end',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_table_title_connector_style',
            [
                'label'                 => esc_html__( 'Title-Price Connector', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'title_price_connector' => 'yes',
                    'menu_style' => 'style-1',
                ],
            ]
        );
        
        $this->add_control(
            'title_connector_vertical_align',
            [
                'label'                 => esc_html__( 'Vertical Alignment', 'avas-core' ),
                'type'                  => Controls_Manager::CHOOSE,
                'default'               => 'middle',
                'options'               => [
                    'top'          => [
                        'title'    => esc_html__( 'Top', 'avas-core' ),
                        'icon'     => 'eicon-v-align-top',
                    ],
                    'middle'       => [
                        'title'    => esc_html__( 'Center', 'avas-core' ),
                        'icon'     => 'eicon-v-align-middle',
                    ],
                    'bottom'       => [
                        'title'    => esc_html__( 'Bottom', 'avas-core' ),
                        'icon'     => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-style-1 .tx-price-title-connector'   => 'align-self: {{VALUE}};',
                ],
                'selectors_dictionary'  => [
                    'top'          => 'flex-start',
                    'middle'       => 'center',
                    'bottom'       => 'flex-end',
                ],
                'condition'             => [
                    'title_price_connector' => 'yes',
                    'menu_style' => 'style-1',
                ],
            ]
        );
        
        $this->add_control(
            'items_divider_style',
            [
                'label'                 => esc_html__( 'Style', 'avas-core' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'dashed',
                'options'              => [
                    'solid'     => esc_html__( 'Solid', 'avas-core' ),
                    'dashed'    => esc_html__( 'Dashed', 'avas-core' ),
                    'dotted'    => esc_html__( 'Dotted', 'avas-core' ),
                    'double'    => esc_html__( 'Double', 'avas-core' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-style-1 .tx-price-title-connector' => 'border-bottom-style: {{VALUE}}',
                ],
                'condition'             => [
                    'title_price_connector' => 'yes',
                    'menu_style' => 'style-1',
                ],
            ]
        );

        $this->add_control(
            'items_divider_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#000',
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-style-1 .tx-price-title-connector' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition'             => [
                    'title_price_connector' => 'yes',
                    'menu_style' => 'style-1',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'items_divider_weight',
            [
                'label'                 => esc_html__( 'Divider Weight', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => '1'],
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-price-menu-style-1 .tx-price-title-connector' => 'border-bottom-width: {{SIZE}}{{UNIT}}; bottom: calc((-{{SIZE}}{{UNIT}})/2)',
                ],
                'condition'             => [
                    'title_price_connector' => 'yes',
                    'menu_style' => 'style-1',
                ],
            ]
        );
        
        $this->end_controls_section();

	}

	 protected function render() {
        $settings = $this->get_settings_for_display();
        $i = 1;
        $this->add_render_attribute( 'price-menu', 'class', 'tx-price-menu' );
        
        if ( $settings['menu_style'] ) {
            $this->add_render_attribute( 'price-menu', 'class', 'tx-price-menu-' . $settings['menu_style'] );
        }
        ?>
        <div <?php echo $this->get_render_attribute_string( 'price-menu' ); ?>>
            <div class="tx-price-menu-items">
                <?php foreach ( $settings['menu_items'] as $index => $item ) : ?>
                    <?php
                        $title_key = $this->get_repeater_setting_key( 'menu_title', 'menu_items', $index );
                        $this->add_render_attribute( $title_key, 'class', 'tx-price-menu-title-text' );
                        $this->add_inline_editing_attributes( $title_key, 'none' );

                        $description_key = $this->get_repeater_setting_key( 'menu_description', 'menu_items', $index );
                        $this->add_render_attribute( $description_key, 'class', 'tx-price-menu-description' );
                        $this->add_inline_editing_attributes( $description_key, 'basic' );

                        $discount_price_key = $this->get_repeater_setting_key( 'menu_price', 'menu_items', $index );
                        $this->add_render_attribute( $discount_price_key, 'class', 'tx-price-menu-price-discount' );
                        $this->add_inline_editing_attributes( $discount_price_key, 'none' );

                        $original_price_key = $this->get_repeater_setting_key( 'original_price', 'menu_items', $index );
                        $this->add_render_attribute( $original_price_key, 'class', 'tx-price-menu-price-original' );
                        $this->add_inline_editing_attributes( $original_price_key, 'none' );
                    ?>
                    <div class="tx-price-menu-item-wrap">
                        <div class="tx-price-menu-item">
                            <?php if ( $item['image_switch'] == 'yes' ) { ?>
                                <div class="tx-price-menu-image">
                                    <?php
                                        if ( ! empty( $item['image']['url'] ) ) :
                                            $image = $item['image'];
                                            $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'image_size', $settings );
                                        ?>
                                        <img src="<?php echo esc_url( $image_url ); ?>" alt=""> 
                                     <?php endif; ?>
                                </div>
                            <?php } ?>

                            <div class="tx-price-menu-content">
                                <div class="tx-price-menu-header">
                                    <?php if ( ! empty( $item['menu_title'] ) ) { ?>
                                        <h4 class="tx-price-menu-title">
                                            <?php
                                                if ( ! empty( $item['link']['url'] ) ) {
                                                    $this->add_render_attribute( 'price-menu-link' . $i, 'href', $item['link']['url'] );

                                                    if ( ! empty( $item['link']['is_external'] ) ) {
                                                        $this->add_render_attribute( 'price-menu-link' . $i, 'target', '_blank' );
                                                    }
                                                    ?>
                                                    <a <?php echo $this->get_render_attribute_string( 'price-menu-link' . $i ); ?>>
                                                        <span <?php echo $this->get_render_attribute_string( $title_key ); ?>>
                                                            <?php echo $item['menu_title']; ?>
                                                        </span>
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span <?php echo $this->get_render_attribute_string( $title_key ); ?>>
                                                        <?php echo $item['menu_title']; ?>
                                                    </span>
                                                    <?php
                                                }
                                            ?>
                                        </h4>
                                    <?php } ?>
                                    
                                    <?php if ( $settings['title_price_connector'] == 'yes' ) { ?>
                                        <span class="tx-price-title-connector"></span>
                                    <?php } ?>
                                    
                                    <?php if ( $settings['menu_style'] == 'style-1' ) { ?>
                                        <?php if ( ! empty( $item['menu_price'] ) ) { ?>
                                            <span class="tx-price-menu-price">
                                                <?php if ( $item['discount'] == 'yes' ) { ?>
                                                    <span <?php echo $this->get_render_attribute_string( $original_price_key ); ?>>
                                                        <?php echo esc_attr( $item['original_price'] ); ?>
                                                    </span>
                                                <?php } ?>
                                                <span <?php echo $this->get_render_attribute_string( $discount_price_key ); ?>>
                                                    <?php echo esc_attr( $item['menu_price'] ); ?>
                                                </span>
                                            </span>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                
                                <?php if ( $settings['title_separator'] == 'yes' ) { ?>
                                    <div class="tx-price-menu-divider-wrap">
                                        <div class="tx-price-menu-divider"></div>
                                    </div>
                                <?php } ?>

                                <?php
                                    if ( ! empty( $item['menu_description'] ) ) {
                                        $description_html = sprintf( '<div %1$s>%2$s</div>', $this->get_render_attribute_string( $description_key ), $item['menu_description'] );
                                        
                                        echo $description_html;
                                    }
                                ?>

                                <?php if ( $settings['menu_style'] != 'style-1' ) { ?>
                                    <?php if ( ! empty( $item['menu_price'] ) ) { ?>
                                        <span class="tx-price-menu-price">
                                            <?php if ( $item['discount'] == 'yes' ) { ?>
                                                <span <?php echo $this->get_render_attribute_string( $original_price_key ); ?>>
                                                    <?php echo esc_attr( $item['original_price'] ); ?>
                                                </span>
                                            <?php } ?>
                                            <span <?php echo $this->get_render_attribute_string( $discount_price_key ); ?>>
                                                <?php echo esc_attr( $item['menu_price'] ); ?>
                                            </span>
                                        </span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php
    } // render
} // class
