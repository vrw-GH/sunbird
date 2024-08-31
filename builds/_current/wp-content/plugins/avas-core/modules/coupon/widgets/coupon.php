<?php
namespace AvasElements\Modules\Coupon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Coupon extends Widget_Base {

    public function get_name() {
        return 'avas-coupon';
    }

    public function get_title() {
        return esc_html__( 'Avas Coupon', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-tags';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_style_depends() {
        return [ 'tx-owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'jquery-swiper','coupon','tx-owl-carousel' ];
    }

	protected function register_controls() {
       
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Coupons', 'avas-core' )
            ]
        );
        $this->add_control(
            'layout',
            [
                'label'                 => esc_html__( 'Layout', 'avas-core' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'grid',
                'options'               => [
                   'grid'           => esc_html__( 'Grid', 'avas-core' ),
                   'carousel'       => esc_html__( 'Carousel', 'avas-core' ),
                ],
                'frontend_available'    => true,
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'coupon_title', 
            [
                'label' => esc_html__('Coupon Title', 'avas-core'),
                'default' => 'Coupon Title',
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'coupon_discount', 
            [
                'label' => esc_html__('Coupon Discount', 'avas-core'),
                'default' => 'Coupon Discount',
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'coupon_code', 
            [
                'label' => esc_html__('Coupon Code', 'avas-core'),
                'default' => 'Coupon Code',
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'coupon_image',
            [
                'label' => esc_html__('Coupon Image', 'avas-core'),
                'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                'label_block' => true,
            ]

        );
        $repeater->add_control(
            'coupon_details', 
            [
                'label' => esc_html__('Coupon Details', 'avas-core'),
                'default' => 'Lorem ipsum dolor sit amet consectetur adipie scing elit sed do eiusmod tempor incididunt.',
                'type' => Controls_Manager::WYSIWYG,
            ]
        );
        $repeater->add_control(
            'ib_btn_text', 
            [
                'label' => esc_html__('Button Text', 'avas-core'),
                'default' => 'View Details',
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'ib_btn_link',
            [
                'label'     => esc_html__( 'Button Link', 'avas-core' ),
                'type'      => Controls_Manager::URL,
                'dynamic'   => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'avas-core' ),
            ]
        );

        $this->add_control(
            'coupons',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [

                    [
                        'coupon_title' => esc_html__('Coupon One', 'avas-core'),
                        'coupon_code' => esc_html__('ABCDOFF', 'avas-core'),
                        'profile_details' => esc_html__('Lorem ipsum dolor sit amet consectetur adipie scing elit sed do eiusmod tempor incididunt.', 'avas-core'),
                    ],
                    [
                        'coupon_title' => esc_html__('Coupon Two', 'avas-core'),
                        'coupon_discount' => esc_html__('25% OFF', 'avas-core'),
                        'coupon_code' => esc_html__('EFGH25', 'avas-core'),
                        'profile_details' => esc_html__('Lorem ipsum dolor sit amet consectetur adipie scing elit sed do eiusmod tempor incididunt.', 'avas-core'),
                    ],
                    [
                        'coupon_title' => esc_html__('Coupon Three', 'avas-core'),
                        'coupon_code' => esc_html__('IOSEL75', 'avas-core'),
                        'profile_details' => esc_html__('Lorem ipsum dolor sit amet consectetur adipie scing elit sed do eiusmod tempor incididunt.', 'avas-core'),
                    ],
                ],

                'title_field' => '{{coupon_title}}',
            ]
        );
        $this->add_control(
            'img_width',
            [
                'label' => esc_html__( 'Image Size', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 357,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-wrapper .tx-coupon-container img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'             => [
                    'layout'       => ['grid']
                ],
            ]
        );
        $this->add_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-wrapper .tx-coupon-container img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                'condition'             => [
                    'layout'       => ['grid']
                ],
            ]
        );
        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
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
                'selectors'         => [
                    '{{WRAPPER}} .tx-coupon-content'   => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'coupon_settings',
            [
                'label' => esc_html__('Settings', 'avas-core'),
            ]
        );
        $this->add_responsive_control(
            'grid_cols',
            [
                'label'                 => esc_html__( 'Columns', 'avas-core' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'default'               => '3',
                'tablet_default'        => '2',
                'mobile_default'        => '1',
                'options'               => [
                   '1'              => esc_html__( '1', 'avas-core' ),
                   '2'              => esc_html__( '2', 'avas-core' ),
                   '3'              => esc_html__( '3', 'avas-core' ),
                   '4'              => esc_html__( '4', 'avas-core' ),
                   '5'              => esc_html__( '5', 'avas-core' ),
                   '6'              => esc_html__( '6', 'avas-core' ),
                   '7'              => esc_html__( '7', 'avas-core' ),
                   '8'              => esc_html__( '8', 'avas-core' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-coupon-wrapper .tx-coupon-container' => 'width: calc( 100% / {{VALUE}} )',
                ],
                'render_type'           => 'template',
                'condition'             => [
                    'layout'       => ['grid']
                ],
            ]
        );

        $this->add_responsive_control(
            'columns_gap',
            [
                'label'                 => esc_html__( 'Column Gap', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => '25',
                    'unit' => 'px',
                ],
                'size_units'            => [ 'px', '%' ],
                'range'                 => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'tablet_default'        => [
                    'unit' => 'px',
                ],
                'mobile_default'        => [
                    'unit' => 'px',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-coupon-wrapper .tx-coupon-container' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .tx-coupon-wrapper' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
                ],
                'render_type'           => 'template',
                'condition'             => [
                    'layout'       => ['grid']
                ],
            ]
        );       
        $this->add_responsive_control(
            'rows_gap',
            [
                'label'                 => esc_html__( 'Row Gap', 'avas-core' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => '25',
                    'unit' => 'px',
                ],
                'size_units'            => [ 'px', '%' ],
                'range'                 => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'tablet_default'        => [
                    'unit' => 'px',
                ],
                'mobile_default'        => [
                    'unit' => 'px',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-coupon-wrapper .tx-coupon-container' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'render_type'           => 'template',
                'condition'             => [
                    'layout'       => ['grid']
                ],
            ]
        );
        $this->add_control(
            'coupon_title_tag',
            [
                'label'                 => esc_html__( 'Coupon Title Tag', 'avas-core' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'h4',
                'options'               => [
                    'h1'     => esc_html__( 'H1', 'avas-core' ),
                    'h2'     => esc_html__( 'H2', 'avas-core' ),
                    'h3'     => esc_html__( 'H3', 'avas-core' ),
                    'h4'     => esc_html__( 'H4', 'avas-core' ),
                    'h5'     => esc_html__( 'H5', 'avas-core' ),
                    'h6'     => esc_html__( 'H6', 'avas-core' ),
                    'div'    => esc_html__( 'div', 'avas-core' ),
                    'span'   => esc_html__( 'span', 'avas-core' ),
                    'p'      => esc_html__( 'p', 'avas-core' ),
                ],
            ]
        );
        $this->add_control(
            'copy',
            [
                'label' => esc_html__('Copy Text', 'avas-core'),
                'default' => 'Copy',
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'display_mobile',
            [
                'label' => esc_html__( 'Coupon Per Row on Mobile', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'condition'        => [
                    'layout'       => 'carousel'
                ],
            ]
        );
        $this->add_control(
            'display_tablet',
            [
                'label' => esc_html__( 'Coupon Per Row on Tablet', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2,
                'condition'        => [
                    'layout'       => ['carousel']
                ],
            ]
        );
        $this->add_control(
            'display_laptop',
            [
                'label' => esc_html__( 'Coupon Per Row on Laptop', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'condition'        => [
                    'layout'       => ['carousel']
                ],
            ]
        );
        $this->add_control(
            'display_desktop',
            [
                'label' => esc_html__( 'Coupon Per Row on Desktop', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'condition'        => [
                    'layout'       => ['carousel']
                ],
            ]
        );
        $this->add_control(
            'gutter',
            [
                'label' => esc_html__( 'Gutter', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'condition'        => [
                    'layout'       => ['carousel']
                ],
            ]
        );
        
        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'yes',
                'toggle' => false,
                'separator' => 'before',
                'condition'        => [
                    'layout'       => ['carousel']
                ],
            ]
        );
        $this->add_control(
            'smart_speed',
            [
                'label' => esc_html__('Slide Speed', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 800,
                'step' => 50,
                'condition' => [
                    'autoplay' => 'yes',
                    'layout'   => 'carousel'
                ]
            ]
        );
        $this->add_control(
            'autoplay_timeout',
            [
                'label' => esc_html__('Slide Delay', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2500,
                'step' => 500,
                'condition' => [
                    'autoplay' => 'yes',
                    'layout'   => 'carousel'
                ]
            ]
        );
        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__( 'Autoplay pause on hover', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'yes',
                'toggle' => false,
                 'condition' => [
                    'autoplay' => 'yes',
                    'layout'   => 'carousel'
                ]
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => esc_html__( 'Loop', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'yes',
                'toggle' => false,
                'condition'        => [
                    'layout'       => ['carousel']
                ],
            ]
        );
        
        $this->add_control(
            'navigation',
            [
                'label' => esc_html__( 'Navigation', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'no',
                'toggle' => false,
                'condition'        => [
                    'layout'       => ['carousel']
                ],
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => esc_html__( 'Dots', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'none',
                'toggle' => false,
                'selectors'         => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-dots'   => 'display: {{VALUE}};',
                ],
                'condition'        => [
                    'layout'       => ['carousel']
                ],
            ]
        );
        $this->end_controls_section();

        // Style section started
        $this->start_controls_section(
            'styles',
            [
              'label'   => esc_html__( 'Content', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cont_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-coupon-item',
            ]
        );
        $this->add_control(
            'cont_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .tx-coupon-item'
            ]
        );
        $this->add_control(
            'cont_bg_color',
            [
                'label'     => esc_html__( 'Content Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-content' => 'background-color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'cont_pad',
            [
                'label' => esc_html__( 'Content Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cont_only_border',
                'label' => esc_html__( 'Content Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-coupon-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_only_box_shadow',
                'selector' => '{{WRAPPER}} .tx-coupon-content'
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'discount_styles',
            [
                'label' => esc_html__('Discount', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'discount_color',
            [
                'label'     => esc_html__( 'Discount Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-discount' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'discount_bg_color',
            [
                'label'     => esc_html__( 'Discount Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-discount' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'discount_typography',
                   'label'     => esc_html__( 'Discount Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-coupon-discount',
                   
              ]
        );
        $this->add_responsive_control(
            'disc_padding',
            [
                'label' => esc_html__( 'Discount Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-discount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'disc_border',
                'label' => esc_html__( 'Discount Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-coupon-discount',
            ]
        );
        $this->add_control(
            'disc_border_radius',
            [
                'label' => esc_html__( 'Discount Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-discount' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'disc_margin',
            [
                'label' => esc_html__( 'Discount Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-discount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'disc_position_x',
            [
                'label' => esc_html__( 'Discount Position Left to Right', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                   
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-discount' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'disc_position_y',
            [
                'label' => esc_html__( 'Discount Position Top to Bottom', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                   
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-discount' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'code_styles',
            [
                'label' => esc_html__('Coupon Code', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'coupon_color',
            [
                'label'     => esc_html__( 'Coupon Code Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-code-text' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'code_bg_color',
            [
                'label'     => esc_html__( 'Coupon Code Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-code' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'coupon_after_copy_color',
            [
                'label'     => esc_html__( 'Coupon Code After Copy Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-copied .tx-coupon-code-text' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'code_typography',
                   'label'     => esc_html__( 'Coupon Code Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-coupon-code-text',
                   
              ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'code_border',
                'label' => esc_html__( 'Coupon Code Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-coupon-code',
            ]
        );
        $this->add_control(
            'code_border_radius',
            [
                'label' => esc_html__( 'Coupon Code Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-code' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'code_padding',
            [
                'label' => esc_html__( 'Coupon Code Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-code' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'code_margin',
            [
                'label' => esc_html__( 'Coupon Code Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-code' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'code_alignment',
            [
                'label' => esc_html__( 'Coupon Code Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
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
                'selectors'         => [
                    '{{WRAPPER}} .tx-coupon-code'   => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'copy_styles',
            [
                'label' => esc_html__('Code Copy', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'copy_color',
            [
                'label'     => esc_html__( 'Code Copy Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-copy-text' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'copy_hov_color',
            [
                'label'     => esc_html__( 'Code Copy Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-copy-text:hover, {{WRAPPER}} .tx-coupon-copy-text:focus, {{WRAPPER}} .tx-coupon-copy-text:active' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'copy_bg_color',
            [
                'label'     => esc_html__( 'Code Copy Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-copy-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'copy_bg_hov_color',
            [
                'label'     => esc_html__( 'Code Copy Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-copy-text:hover, {{WRAPPER}} .tx-coupon-copy-text:focus, {{WRAPPER}} .tx-coupon-copy-text:active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'copy_typography',
                   'label'     => esc_html__( 'Code Copy Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-coupon-copy-text',
                   
              ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'copy_border',
                'label' => esc_html__( 'Code Copy Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-coupon-copy-text',
            ]
        );
        $this->add_control(
            'copy_border_radius',
            [
                'label' => esc_html__( 'Code Copy Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-copy-text' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'copy_padding',
            [
                'label' => esc_html__( 'Code Copy Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-copy-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'copy_margin',
            [
                'label' => esc_html__( 'Code Copy Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-copy-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'title_styles',
            [
                'label' => esc_html__('Title', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Coupon Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-title' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'label'     => esc_html__( 'Coupon Title Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-coupon-title',
                   
              ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'details_styles',
            [
                'label' => esc_html__('Details', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'details_color',
            [
                'label'     => esc_html__( 'Coupon Details Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-details' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'coupon_details_typography',
                   'label'     => esc_html__( 'Coupon Details Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-coupon-details',
                   
              ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'btn_styles',
            [
                'label' => esc_html__('Button', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_color',
            [
                'label'     => esc_html__( 'Button Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_color',
            [
                'label'     => esc_html__( 'Button Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-btn a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_hov_color',
            [
                'label'     => esc_html__( 'Button Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-btn a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_hov_color',
            [
                'label'     => esc_html__( 'Button Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-btn a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'btn_typography',
                   'label'     => esc_html__( 'Button Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-coupon-btn a',
                   
              ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Button Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-coupon-btn a',
            ]
        );
        $this->add_control(
            'btn_border_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-btn a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__( 'Button Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_magin',
            [
                'label' => esc_html__( 'Button Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-coupon-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_alignment',
            [
                'label' => esc_html__( 'Button Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
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
                'selectors'         => [
                    '{{WRAPPER}} .tx-coupon-btn'   => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'nav_styles',
            [
                'label' => esc_html__('Navigation', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'        => [
                    'navigation'    => 'yes',
                    'layout'        => 'carousel'
                ],
            ]
        );
        $this->add_control(
            'navigation_color',
            [
                'label'     => esc_html__( 'Navigation Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev i, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'navigation_hover_color',
            [
                'label'     => esc_html__( 'Navigation Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev:hover i, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
      
        $this->add_control(
            'navigation_hover_bg_color',
            [
                'label'     => esc_html__( 'Navigation Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'navigation_hover_bg_hover_color',
            [
                'label'     => esc_html__( 'Navigation Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .tx-carousel.owl-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'dots_bg_color',
            [
                'label'     => esc_html__( 'Dots Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot span' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'dots' => 'block',
                ],
            ]
        );
        $this->add_control(
            'dots_active_bg_color',
            [
                'label'     => esc_html__( 'Dots Active Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot.active span' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'dots' => 'block',
                ],
            ]
        );
        $this->add_control(
            'dots_size',
            [
                'label' => esc_html__( 'Dots Size', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                   
                ],
                'default' => [
                    'size' => 12,
                ],
                'condition' => [
                    'dots' => 'block',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-carousel.owl-carousel button.owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
     

        $this->end_controls_section();
    }
    
    protected function render() {
      
        $settings = $this->get_settings();
        
        $this->add_render_attribute( 'tx-coupon-wrapper', 'class', 'tx-coupon-wrapper' );
        $this->add_render_attribute( 'tx-coupon-container', 'class', 'tx-coupon-container' );
        $this->add_render_attribute( 'tx-carousel', 'class', 'tx-carousel owl-carousel owl-theme' );
        $this->add_render_attribute(
                [
                    'tx-carousel' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                               'navigation' => ('yes' === $settings['navigation']),
                               'autoplay' => ('yes' === $settings['autoplay']),
                               'autoplay_timeout' => absint($settings['autoplay_timeout']),
                               'smart_speed' => absint($settings['smart_speed']),
                               'pause_on_hover' => ('yes' === $settings['pause_on_hover']),
                               'loop' => ('yes' === $settings['loop']),
                               'display_mobile' => $settings['display_mobile'],
                               'display_tablet' => $settings['display_tablet'],
                               'display_laptop' => $settings['display_laptop'],
                               'display_desktop' => $settings['display_desktop'],
                               'gutter' => $settings['gutter'],
                            ]))
                        ]
                    ]
                ]
        );
    ?>
       
    <?php if('grid' === $settings['layout']) : ?>
        <div <?php echo $this->get_render_attribute_string( 'tx-coupon-wrapper' ); ?> >
            <?php foreach ( $settings['coupons'] as $coupon ) : 
                $target = $coupon['ib_btn_link']['is_external'] ? '_blank' : '_self'; ?>
                <div <?php echo $this->get_render_attribute_string( 'tx-coupon-container' ); ?> >
                    <div class="tx-coupon-item">
                        <div class="tx-coupon-image">
                            <?php if(!empty($coupon['coupon_discount'])) : ?>
                                <span class="tx-coupon-discount"><?php echo esc_html( $coupon['coupon_discount'] ); ?></span>
                            <?php endif; ?>
                            <?php if(!empty($coupon['coupon_image']['url'])) : ?>
                                <img src="<?php echo esc_attr($coupon['coupon_image']['url']);?>" alt="<?php echo esc_attr( $coupon['coupon_title'] ); ?>">
                            <?php endif; ?>
                            <?php if(!empty($coupon['coupon_code'])): ?>
                            <div class="tx-coupon-code" data-coupon-code="<?php echo $coupon['coupon_code']; ?>">
                                <span class="tx-coupon-code-text"><?php echo esc_html( $coupon['coupon_code'] ); ?></span>
                                <span class='tx-coupon-copy-text'><?php echo esc_html( $settings['copy'] ); ?></span>
                            </div><!-- tx-coupon-code -->
                            <?php endif; ?>
                        </div><!-- tx-coupon-image -->
                        <div class="tx-coupon-content">
                            <<?php echo esc_attr( $settings['coupon_title_tag'] ); ?> class="tx-coupon-title"><?php echo esc_html( $coupon['coupon_title'] ); ?></<?php echo esc_attr( $settings['coupon_title_tag'] ); ?>>
                            <div class="tx-coupon-details"><?php echo wp_kses_post( $coupon['coupon_details'] ); ?></div>
                            <?php if( !empty( $coupon['ib_btn_text'] ) ) : ?>
                                <div class="tx-coupon-btn">
                                    <a href="<?php echo esc_url($coupon['ib_btn_link']['url']); ?>" target="<?php echo esc_attr($target); ?>">
                                        <?php echo esc_html($coupon['ib_btn_text']); ?>
                                    </a>
                                </div><!-- tx-coupon-btn -->
                            <?php endif; ?>
                        </div><!-- tx-coupon-content -->
                    </div><!-- tx-coupon-item -->
                </div><!-- tx-coupon-container -->
            <?php endforeach; ?>
        </div><!-- tx-coupon-wrapper -->
    <?php endif; ?><!-- grid layout -->

    <?php if('carousel' === $settings['layout']) : ?>
        <div <?php echo $this->get_render_attribute_string( 'tx-coupon-wrapper' ); ?> >
            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
                <?php foreach ( $settings['coupons'] as $coupon ) : 
                    $target = $coupon['ib_btn_link']['is_external'] ? '_blank' : '_self'; ?>
                        <div class="tx-coupon-item">
                            <div class="tx-coupon-image">
                                <?php if(!empty($coupon['coupon_discount'])) : ?>
                                    <span class="tx-coupon-discount"><?php echo esc_html( $coupon['coupon_discount'] ); ?></span>
                                <?php endif; ?>
                                <?php if(!empty($coupon['coupon_image']['url'])) : ?>
                                    <img src="<?php echo esc_attr($coupon['coupon_image']['url']);?>" alt="<?php echo esc_attr( $coupon['coupon_title'] ); ?>">
                                <?php endif; ?>
                                <?php if(!empty($coupon['coupon_code'])): ?>
                                <div class="tx-coupon-code" data-coupon-code="<?php echo $coupon['coupon_code']; ?>">
                                    <span class="tx-coupon-code-text"><?php echo esc_html( $coupon['coupon_code'] ); ?></span>
                                    <span class='tx-coupon-copy-text'><?php echo esc_html( $settings['copy'] ); ?></span>
                                </div><!-- tx-coupon-code -->
                                <?php endif; ?>
                            </div><!-- tx-coupon-image -->
                            <div class="tx-coupon-content">
                                <<?php echo esc_attr( $settings['coupon_title_tag'] ); ?> class="tx-coupon-title"><?php echo esc_html( $coupon['coupon_title'] ); ?></<?php echo esc_attr( $settings['coupon_title_tag'] ); ?>>
                                <div class="tx-coupon-details"><?php echo wp_kses_post( $coupon['coupon_details'] ); ?></div>
                                <?php if( !empty( $coupon['ib_btn_text'] ) ) : ?>
                                <div class="tx-coupon-btn">
                                    <a href="<?php echo esc_url($coupon['ib_btn_link']['url']); ?>" target="<?php echo esc_attr($target); ?>">
                                        <?php echo esc_html($coupon['ib_btn_text']); ?>
                                    </a>
                                </div><!-- tx-coupon-btn -->
                            <?php endif; ?>
                            </div><!-- tx-coupon-content -->
                        </div><!-- tx-coupon-item -->
                <?php endforeach; ?>
            </div><!-- tx-carousel -->
        </div><!-- tx-coupon-wrapper -->
    <?php endif; ?><!-- carousel layout -->

<?php
     
    } // function render()

} // class Portfolio