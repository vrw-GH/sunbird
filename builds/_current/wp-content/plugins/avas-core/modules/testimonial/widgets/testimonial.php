<?php
namespace AvasElements\Modules\Testimonial\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Testimonial extends Widget_Base {

    public function get_name() {
        return 'avas-testimonial';
    }

    public function get_title() {
        return esc_html__( 'Avas Testimonial', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() {
        return [ 'tx-owl-carousel', 'carousel-widgets' ];
    }

    public function get_style_depends() {
        return [ 'tx-owl-carousel' ];
    }

	protected function register_controls() {
       
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content Settings', 'avas-core' )
            ]
        );
        $this->add_control(
            'testimonial_style',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => esc_html__( 'Style 1', 'avas-core' ),
                    'style-2' => esc_html__( 'Style 2', 'avas-core' ),
                    'style-3' => esc_html__( 'Style 3', 'avas-core' ),
                    'style-4' => esc_html__( 'Style 4', 'avas-core' ),
                    'style-5' => esc_html__( 'Style 5', 'avas-core' ),
                ],
                'default' => 'style-1',
            ]
        );
        $this->add_control(
            'style_5_layout',
            [
                'label' => esc_html__( 'Layout', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inherit' => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'inherit',
                'condition' => [
                    'testimonial_style' => 'style-5'
                ],
                'selectors' => [
                    '{{WRAPPER}} .style-5 .tx-testimonial' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'user_name', 
            [
                'label' => esc_html__( 'Name', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'John Doe' , 'avas-core' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'company_name',
            [
                'label' => esc_html__( 'Company Name', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'user_image',
            [
               'label' => esc_html__('Image', 'avas-core'),
                'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
           'testimonial_details',
           [
                'label' => esc_html__('Testimonials', 'avas-core'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'avas-core' ),
            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__( 'Rating', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                        ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                        ]
                ],
                'default' => 'show',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'stars',
            [
                'label'       => esc_html__( 'Stars', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 's_5',
                'options' => [
                    's_1'  => esc_html__( '1 Star', 'avas-core' ),
                    's_2' => esc_html__( '2 Stars', 'avas-core' ),
                    's_3' => esc_html__( '3 Stars', 'avas-core' ),
                    's_4' => esc_html__( '4 Stars', 'avas-core' ),
                    's_5'   => esc_html__( '5 Stars', 'avas-core' ),
                    ],
                'condition' => [
                    'rating' => 'show',
                ],
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [

                    [
                        'user_name' => esc_html__('John Doe', 'avas-core'),
                        'company_name' => esc_html__('Theme X', 'avas-core'),
                        'testimonial_details' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'avas-core'),
                    ],
                    [
                        'user_name' => esc_html__('Sharon Brinson', 'avas-core'),
                        'company_name' => esc_html__('Envato', 'avas-core'),
                        'testimonial_details' => esc_html__('Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip exea commodo consequat.', 'avas-core'),
                    ],
                    [
                        'user_name' => esc_html__('Felix Mercer', 'avas-core'),
                        'company_name' => esc_html__('Themeforest', 'avas-core'),
                        'testimonial_details' => esc_html__('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'avas-core'),
                    ],
                ],

                'title_field' => '{{{ user_name }}}',
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
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-wrap .owl-carousel .tx-testimonial-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
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
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'img_spacing',
            [
                'label' => esc_html__( 'Image Spacing', 'avas-core' ),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style!' => 'style-1',
                ]
            ]
        );
        $this->add_control(
            'quote',
            [
                'label' => esc_html__( 'Quote', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Show', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'Hide', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show',
                'toggle' => false,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'quote_alignment',
            [
                'label' => esc_html__( 'Quote Alignment', 'avas-core' ),
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
                    '{{WRAPPER}} .tx-testimonial-quote'   => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'quote' => 'show',
                    'testimonial_style!' => 'style-5'
                ],
            ]
        );
        $this->add_responsive_control(
            'test_alignment',
            [
                'label' => esc_html__( 'Testimonial Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'tx-align-left' => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'tx-align-center' => [
                        'title' => esc_html__( 'Center', 'avas-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'tx-align-right' => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'tx-align-center',
                'separator' => 'before'
                // 'toggle' => false,
            ]
        );

        $this->end_controls_section();
         $this->start_controls_section(
            'carousel_settings',
            [
                'label' => esc_html__('Carousel Settings', 'avas-core'),
            ]
        );
         $this->add_control(
            'display_mobile',
            [
                'label' => esc_html__( 'Posts Per Row on Mobile', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'display_tablet',
            [
                'label' => esc_html__( 'Posts Per Row on Tablet', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'display_laptop',
            [
                'label' => esc_html__( 'Posts Per Row on Laptop', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'display_desktop',
            [
                'label' => esc_html__( 'Posts Per Row on Desktop', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'gutter',
            [
                'label' => esc_html__( 'Gutter', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 30
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
            ]
        );
        $this->add_control(
            'smart_speed',
            [
                'label' => esc_html__('Slide Speed', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'step'    => 50,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'autoplay_timeout',
            [
                'label' => esc_html__('Slide Delay', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2500,
                'step'    => 500,
                'condition' => [
                    'autoplay' => 'yes'
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
                'default' => 'no',
                'toggle' => false,
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
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'nav_position',
            [
                'label' => esc_html__( 'Navigation Position', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'tx-nav-top' => [
                        'title' => esc_html__( 'Top', 'avas-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'tx-nav-middle' => [
                        'title' => esc_html__( 'Middle', 'avas-core' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'tx-nav-bottom' => [
                        'title' => esc_html__( 'Bottom', 'avas-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => false,
                'default' => 'tx-nav-bottom',
                'condition' => [
                    'navigation' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'nav_alignment',
            [
                'label' => esc_html__( 'Navigation Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'tx-nav-left' => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'tx-nav-center' => [
                        'title' => esc_html__( 'Center', 'avas-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'tx-nav-right' => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'tx-nav-center',
                'condition' => [
                    'nav_position!' => 'tx-nav-middle',
                    'navigation' => 'yes'
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
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        // Style section started
        $this->start_controls_section(
            'styles',
            [
              'label'   => esc_html__( 'Styles', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-testimonial',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cont_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-testimonial',
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
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .tx-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tx-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .tx-testimonial'
            ]
        );
        $this->add_control(
            'testi_right_color',
            [
                'label'     => esc_html__( 'Testimonial Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-right' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                      'testimonial_style' => 'style-5',
                    ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'testi_right_position',
            [
                'label' => esc_html__( 'Testimonial Position', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                   
                ],
                'default' => [
                    'size' => 15,
                ],
                'condition' => [
                      'testimonial_style' => 'style-5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-right' => 'transform:translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_responsive_control(
            'testi_right_padding',
            [
                'label' => esc_html__( 'Testimonial Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                      'testimonial_style' => 'style-5',
                ],
            ]
        );
        $this->add_control(
            'quote_color',
            [
                'label'     => esc_html__( 'Quote Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-quote, {{WRAPPER}} .tx-testimonial-quote-right' => 'color: {{VALUE}};',
                ],
                'condition' => [
                      'quote' => 'show',
                    ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'quote_typography',
                   'selector'  => '{{WRAPPER}} .tx-testimonial-quote, {{WRAPPER}} .tx-testimonial-quote-right',
                   'condition' => [
                      'quote' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'testi_details_color',
            [
                'label'     => esc_html__( 'Testimonials Details Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-details' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'testi_details_typography',
                   'selector'  => '{{WRAPPER}} .tx-testimonial-details,{{WRAPPER}} .tx-testimonial-details p',
                   
              ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Name Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-name' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'name_typography',
                   'selector'  => '{{WRAPPER}} .tx-testimonial-name',
                   
              ]
        );
        $this->add_control(
            'com_name_color',
            [
                'label'     => esc_html__( 'Company Name Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-testimonial-company' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'com_name_typography',
                   'selector'  => '{{WRAPPER}} .tx-testimonial-company',
                   
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
      
        $settings = $this->get_settings_for_display();

            $this->add_render_attribute( 
                [
                    'tx-testimonial-wrap' => [
                        'class' => [
                            'tx-testimonial-wrap',
                            $settings['nav_position'],
                            $settings['nav_alignment'],
                            $settings['testimonial_style'],
                            $settings['test_alignment'],
                        ] 
                    ]
                ]
            );
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

        <div <?php echo $this->get_render_attribute_string( 'tx-testimonial-wrap' ); ?> >
            
            <?php if($settings['testimonial_style'] == 'style-1') : ?>
            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
               <?php foreach ( $settings['testimonials'] as $testimonial ) : ?>
                   
                    <div class="tx-testimonial <?php echo esc_attr( $testimonial['stars'] ); ?>">
                        <?php if($settings['quote'] == 'show') : ?>
                        <div class="tx-testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <?php endif; ?>

                        <div class="tx-testimonial-details"><?php echo wp_kses_post( $testimonial['testimonial_details'] ); ?></div>
                        <?php if ( $testimonial['rating'] == 'show' ) : ?>
                        <ul class="tx-testimonial-star">
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        </ul>
                        <?php endif;?>
                        <h5 class="tx-testimonial-name"><?php echo esc_html( $testimonial['user_name'] ); ?></h5>
                        <div class="tx-testimonial-company"><?php echo esc_html( $testimonial['company_name'] ); ?></div>
                        <?php if(!empty($testimonial['user_image']['url'])) : ?>
                        <div class="tx-testimonial-image"><img src="<?php echo esc_attr($testimonial['user_image']['url']);?>" alt="<?php echo esc_attr( $testimonial['user_name'] ); ?>"></div>  
                        <?php endif; ?>

                    </div><!-- tx-testimonial -->
               <?php endforeach; ?>
            </div><!-- testimonial-carousel --><!-- style 1 -->
            <?php endif; ?>

            <?php if($settings['testimonial_style'] == 'style-2') : ?>
            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
               <?php foreach ( $settings['testimonials'] as $testimonial ) : ?>
                   
                    <div class="tx-testimonial <?php echo esc_attr( $testimonial['stars'] ); ?>">
                        <?php if($settings['quote'] == 'show') : ?>
                        <div class="tx-testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <?php endif; ?>
                        <?php if(!empty($testimonial['user_image']['url'])) : ?>
                        <div class="tx-testimonial-image"><img src="<?php echo esc_attr($testimonial['user_image']['url']);?>" alt="<?php echo esc_attr( $testimonial['user_name'] ); ?>"></div>  
                        <?php endif; ?>
                        <div class="tx-testimonial-details"><?php echo wp_kses_post( $testimonial['testimonial_details'] ); ?></div>
                        <?php if ( $testimonial['rating'] == 'show' ) : ?>
                        <ul class="tx-testimonial-star">
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        </ul>
                        <?php endif;?>
                        <h5 class="tx-testimonial-name"><?php echo esc_html( $testimonial['user_name'] ); ?></h5>
                        <div class="tx-testimonial-company"><?php echo esc_html( $testimonial['company_name'] ); ?></div>
                        

                    </div><!-- tx-testimonial -->
               <?php endforeach; ?>
            </div><!-- testimonial-carousel --><!-- style 2 -->
            <?php endif; ?>

            <?php if($settings['testimonial_style'] == 'style-3') : ?>
            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
               <?php foreach ( $settings['testimonials'] as $testimonial ) : ?>
                   
                    <div class="tx-testimonial <?php echo esc_attr( $testimonial['stars'] ); ?>">
                        <?php if($settings['quote'] == 'show') : ?>
                        <div class="tx-testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <?php endif; ?>
                        <?php if(!empty($testimonial['user_image']['url'])) : ?>
                        <div class="tx-testimonial-image"><img src="<?php echo esc_attr($testimonial['user_image']['url']);?>" alt="<?php echo esc_attr( $testimonial['user_name'] ); ?>"></div>  
                        <?php endif; ?>
                        <h5 class="tx-testimonial-name"><?php echo esc_html( $testimonial['user_name'] ); ?></h5>
                        <div class="tx-testimonial-company"><?php echo esc_html( $testimonial['company_name'] ); ?></div>
                        <div class="tx-testimonial-details"><?php echo wp_kses_post( $testimonial['testimonial_details'] ); ?></div>
                        <?php if ( $testimonial['rating'] == 'show' ) : ?>
                        <ul class="tx-testimonial-star">
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        </ul>
                        <?php endif;?>
                        
                        

                    </div><!-- tx-testimonial -->
               <?php endforeach; ?>
            </div><!-- testimonial-carousel --><!-- style 3 -->
            <?php endif; ?>

            <?php if($settings['testimonial_style'] == 'style-4') : ?>
            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
               <?php foreach ( $settings['testimonials'] as $testimonial ) : ?>
                   
                    <div class="tx-testimonial <?php echo esc_attr( $testimonial['stars'] ); ?>">
                        <?php if($settings['quote'] == 'show') : ?>
                        <div class="tx-testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <?php endif; ?>

                        <div class="tx-testimonial-details"><?php echo wp_kses_post( $testimonial['testimonial_details'] ); ?></div>
                        <?php if(!empty($testimonial['user_image']['url'])) : ?>
                        <div class="tx-testimonial-image"><img src="<?php echo esc_attr($testimonial['user_image']['url']);?>" alt="<?php echo esc_attr( $testimonial['user_name'] ); ?>"></div>  
                        <?php endif; ?>
                        <h5 class="tx-testimonial-name"><?php echo esc_html( $testimonial['user_name'] ); ?></h5>
                        <div class="tx-testimonial-company"><?php echo esc_html( $testimonial['company_name'] ); ?></div>
                        <?php if ( $testimonial['rating'] == 'show' ) : ?>
                        <ul class="tx-testimonial-star">
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            <li><i class="fas fa-star" aria-hidden="true"></i></li>
                        </ul>
                        <?php endif;?>
                        
                        

                    </div><!-- tx-testimonial -->
               <?php endforeach; ?>
            </div><!-- testimonial-carousel --><!-- style 4 -->
            <?php endif; ?>

            <?php if($settings['testimonial_style'] == 'style-5') : ?>
            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
               <?php foreach ( $settings['testimonials'] as $testimonial ) : ?>
                   
                    <div class="tx-testimonial <?php echo esc_attr( $testimonial['stars'] ); ?>">

                        

                        <?php if(!empty($testimonial['user_image']['url'])) : ?>
                        <div class="tx-testimonial-image"><img src="<?php echo esc_attr($testimonial['user_image']['url']);?>" alt="<?php echo esc_attr( $testimonial['user_name'] ); ?>"></div><!-- tx-testimonial-image -->
                        <?php endif; ?>

                        <div class="tx-testimonial-right">
                            <h5 class="tx-testimonial-name"><?php echo esc_html( $testimonial['user_name'] ); ?></h5>
                            
                            <?php if($settings['quote'] == 'show') : ?>
                            <div class="tx-testimonial-quote"><i class="fas fa-quote-left"></i></div>
                            <?php endif; ?>
                            <div class="tx-testimonial-details"><?php echo wp_kses_post( $testimonial['testimonial_details'] ); ?></div>
                            <?php if($settings['quote'] == 'show') : ?>
                            <div class="tx-testimonial-quote-right"><i class="fas fa-quote-right"></i></div>
                            <?php endif; ?>
                            
                            <div class="tx-testimonial-company"><?php echo esc_html( $testimonial['company_name'] ); ?></div>
                            <?php if ( $testimonial['rating'] == 'show' ) : ?>
                            <ul class="tx-testimonial-star">
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                                <li><i class="fas fa-star" aria-hidden="true"></i></li>
                            </ul>
                            <?php endif;?>

                        </div><!-- tx-testimonial-right -->
                        

                    </div><!-- tx-testimonial -->
               <?php endforeach; ?>
            </div><!-- testimonial-carousel --><!-- style 5 -->
            <?php endif; ?>

        </div><!-- tx-testimonial-wrap -->


<?php

    } // function render()

} // class Portfolio


