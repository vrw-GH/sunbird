<?php
namespace AvasElements\Modules\PortfolioCarousel\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;

use AvasElements\TX_Load;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PortfolioCarousel extends Widget_Base {

    public function get_name() {
        return 'avas-portfolio-carousel';
    }

    public function get_title() {
        return esc_html__( 'Avas Portfolio Carousel', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-posts-carousel';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() {
        return [ 'tx-owl-carousel','tx-magnific-popup','tx-imagesloaded', 'carousel-widgets','tx-isotope' ];
    }

    public function get_style_depends() {
        return [ 'tx-owl-carousel','tx-magnific-popup' ];
    }

	protected function register_controls() {
       
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content Settings', 'avas-core' )
            ]
        );
        
        $this->add_control(
            'tx_categories',
            [
                'label'       => esc_html__( 'Categories', 'avas-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => TX_Helper::get_post_type_categories('portfolio-category'),
                'default'     => [],
                'label_block' => true,
                'multiple'    => true,
            ]
        );
        
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Posts', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 8
            ]
        );
        
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'ASC' => esc_html__('Ascending', 'avas-core'),
                    'DESC' => esc_html__('Descending', 'avas-core'),
                ),
                'default' => 'DESC',
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'none' => esc_html__('No order', 'avas-core'),
                    'ID' => esc_html__('Post ID', 'avas-core'),
                    'author' => esc_html__('Author', 'avas-core'),
                    'title' => esc_html__('Title', 'avas-core'),
                    'date' => esc_html__('Published date', 'avas-core'),
                    'rand' => esc_html__('Random order', 'avas-core'),
                    'menu_order' => esc_html__('Menu order', 'avas-core'),
                ),
                'default' => 'date',
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__( 'Offset', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
               
            ]
        );
        $this->add_control(
            'display',
            [
                'label'     => esc_html__( 'Style', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'vertical',
                'options'   => [
                        'vertical'    => esc_html__('Vertical','avas-core'),
                        'horizontal'    => esc_html__('Horizontal','avas-core'),
                        'card-h'    => esc_html__('Card Horizontal','avas-core'),
                        'card-v'    => esc_html__('Card Vertical','avas-core'),
                    ],
            ]
        );
        $this->add_responsive_control(
            'card_padding',
            [
                'label'       => esc_html__( 'Card Padding', 'avas-core' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => [ 'px', 'em', '%' ],
                'selectors'   => [
                    '{{WRAPPER}} .tx-port-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'terms' => [
                                [
                                    'name' => 'display',
                                    'operator' => '==',
                                    'value' => 'card-v'
                                ],
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'display',
                                    'operator' => '==',
                                    'value' => 'card-h'
                                ],
                            ]
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'effects',
            [
                'label' => esc_html__( 'Hover Effects', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'effects-1',
                'options' => [
                    'effects-0' => esc_html__( 'No Effect', 'avas-core' ),
                    'effects-1' => esc_html__( 'Effect 1', 'avas-core' ),
                    'effects-2' => esc_html__( 'Effect 2', 'avas-core' ),
                    'effects-3' => esc_html__( 'Effect 3', 'avas-core' ),
                    'effects-4' => esc_html__( 'Effect 4', 'avas-core' ),
                ],
            ]
        );
        $this->add_control(
            'overlay',
            [
                'label' => esc_html__( 'Overlay', 'avas-core' ),
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
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'avas-core' ),
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
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'terms' => [
                                [
                                    'name' => 'display',
                                    'operator' => '==',
                                    'value' => 'card-v'
                                ],
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'display',
                                    'operator' => '==',
                                    'value' => 'card-h'
                                ],
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'overlay',
                                    'operator' => '==',
                                    'value' => 'show'
                                ],
                            ]
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'category_display',
            [
                'label' => esc_html__( 'Category', 'avas-core' ),
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
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'terms' => [
                                [
                                    'name' => 'display',
                                    'operator' => '==',
                                    'value' => 'card-v'
                                ],
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'display',
                                    'operator' => '==',
                                    'value' => 'card-h'
                                ],
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'overlay',
                                    'operator' => '==',
                                    'value' => 'show'
                                ],
                            ]
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'bio',
            [
                'label' => esc_html__( 'Excerpt', 'avas-core' ),
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
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'terms' => [
                                [
                                    'name' => 'display',
                                    'operator' => '==',
                                    'value' => 'card-v'
                                ],
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'display',
                                    'operator' => '==',
                                    'value' => 'card-h'
                                ],
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'overlay',
                                    'operator' => '==',
                                    'value' => 'show'
                                ],
                            ]
                        ],
                        
                    ]
                ],
            ]
        );
        $this->add_control(
            'enlarge',
            [
                'label' => esc_html__( 'Popup Icon', 'avas-core' ),
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
                'condition' => [
                    'overlay' => 'show'
                ]
            ]
        );
        $this->add_control(
            'popup',
            [
                'label' => esc_html__( 'Popup', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no-content',
                'options' => [
                    'no-content' => esc_html__( 'Image Only', 'avas-core' ),
                    'content' => esc_html__( 'With Content',   'avas-core' ),
                ],
                 'condition' => [
                    'enlarge' => 'show',
                    'overlay' => 'show'
                    
                ]
            ]
        );
        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link Icon', 'avas-core' ),
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
                'condition' => [
                    'overlay' => 'show'
                ]
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
                'default' => 2
            ]
        );
        $this->add_control(
            'display_laptop',
            [
                'label' => esc_html__( 'Posts Per Row on Laptop', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3
            ]
        );
        $this->add_control(
            'display_desktop',
            [
                'label' => esc_html__( 'Posts Per Row on Desktop', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3
            ]
        );
        $this->add_control(
            'gutter',
            [
                'label' => esc_html__( 'Gutter', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 20
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
                'label' => esc_html__('Slide Change Speed', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'autoplay_timeout',
            [
                'label' => esc_html__('Slide Change Delay', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
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
                'default' => 'yes',
                'toggle' => false,
                'condition' => [
                    'autoplay' => 'yes'
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
                'default' => 'yes',
                'toggle' => false,
               
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
        $this->add_control(
            'overlay_bg_color',
            [
                'label' => esc_html__('Overlay Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'overlay_border_color',
            [
                'label' => esc_html__('Overlay Border Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-overlay:before, {{WRAPPER}} .tx-port-overlay:after' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'card_bg_color',
            [
                'label'     => esc_html__( 'Card Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-card-content' => 'background-color: {{VALUE}};',
                ],

                'separator' => 'before',
            ]
      );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__( 'Title Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-title a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} .tx-port-title',
                   'condition' => [
                      'title' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Excerpt Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-excp' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_typography',
                   'selector'  => '{{WRAPPER}} .tx-port-excp',
              ]
        );
        $this->add_control(
            'cate_color',
            [
                'label'     => esc_html__( 'Category Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-cat a' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'cate_hov_color',
            [
                'label'     => esc_html__( 'Category Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-cat a:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'cat_typography',
                   'selector'  => '{{WRAPPER}} .tx-port-cat a',
              ]
        );
        $this->add_control(
            'icons_color',
            [
                'label'     => esc_html__( 'Popup & Link Icons Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-enlrg-link a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'icons_hov_color',
            [
                'label'     => esc_html__( 'Popup & Link Icons Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-enlrg-link a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icons_bg_color',
            [
                'label'     => esc_html__( 'Popup & Link Icons Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-enlarge, {{WRAPPER}} .tx-port-link' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'icons_typography',
                   'selector'  => '{{WRAPPER}} .tx-port-enlrg-link a',
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
        $tx_categories = $settings['tx_categories'];

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

       
        if( !empty($tx_categories) ) {

            $query_args = array(
                'post_type' => 'portfolio',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'portfolio-category',
                        'field'    => 'slug',
                        'terms'    => $tx_categories,
                    ),
                )
            );

        } else {

            $query_args = array(
                'post_type' => 'portfolio',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
            );
        }
        global $post;

        $post_query = new \WP_Query( $query_args );

        ?>

        <div class="tx-carousel-wrapper">

            <?php
          
            if ($post_query->have_posts()) : 

            ?>

            <div <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
                <?php while ($post_query->have_posts()) : $post_query->the_post();
                        global $post;
                        $terms = get_the_terms( $post->ID, 'portfolio-category' );
                        if ( $terms && ! is_wp_error( $terms ) ) :
                          $taxonomy = array();
                          foreach ( $terms as $term ) :
                            $taxonomy[] = $term->name;
                          endforeach;
                          $cat_name = join( " ", $taxonomy);
                          $cat_link = get_term_link( $term );
                        else:
                        $cat_name = '';
                        endif;
                ?>
                <div class="<?php echo esc_attr( $settings['effects'] ); ?> tx-portfolio-item <?php echo esc_attr( $settings['display'] ); ?>">
                    
                    <div class="tx-port-overlay">
                        <div class="tx-port-img">
                          <?php
                            $img_h_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-h-thumb');
                            $img_v_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-v-thumb');
                            $img_name = get_post(get_post_thumbnail_id())->post_title;
                          ?>
                          
                          <?php if ($settings['display'] == 'vertical' || $settings['display'] == 'card-v') : ?>
                            <img src="<?php echo esc_attr($img_v_grid); ?>" alt="<?php echo esc_attr($img_name); ?>" >
                          <?php endif; ?>
                          <?php if ($settings['display'] == 'horizontal' || $settings['display'] == 'card-h') : ?>
                            <img src="<?php echo esc_attr($img_h_grid); ?>" alt="<?php echo esc_attr($img_name); ?>" >
                          <?php endif; ?>

                        </div><!-- /.tx-port-img -->
                    <?php if($settings['overlay'] == 'show') : ?>
                        <div class="tx-port-overlay-content">
                        <div class="tx-port-overlay-content-wrap">

                    <?php if('vertical' === $settings['display'] || 'horizontal' === $settings['display']): ?>
                        <?php if(!empty($cat_name) && $settings['category_display'] == 'show') : ?>
                          <div class="tx-port-cat">
                            <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_attr($cat_name); ?></a>
                          </div><!-- /.tx-port-cat -->
                        <?php endif; ?>  
                        
                        <?php if($settings['title'] == 'show') : ?>
                          <h4 class="tx-port-title"><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
                        <?php endif; ?>
                        
                        <?php if($settings['bio'] == 'show') : ?>
                          <p class="tx-port-excp"><?php echo esc_html(tx_excerpt_limit(5)); ?></p>  
                        <?php endif; ?>
                    <?php endif; ?>

                        <div class="tx-port-enlrg-link">
                          <?php if($settings['enlarge'] == 'show') : ?>
                            <a class="tx-port-enlarge" href="#item-<?php echo get_the_id(); ?>" data-effect="mfp-zoom-in"><i class="bi bi-search"></i></a>
                          <?php endif; ?>

                          <?php if($settings['link'] == 'show') : ?>
                            <a class="tx-port-link" href="<?php echo get_the_permalink(); ?>"><i class="bi bi-link-45deg"></i></a>
                          <?php endif; ?>

                        </div><!-- ./tx-port-enlrg-link -->
                        </div><!-- tx-port-overlay-content-wrap -->
                      </div><!-- /.tx-port-overlay-content -->
                      <?php endif; ?>
                    </div><!-- ./tx-port-overlay -->
                    

                    <?php $img_enlarge = get_the_post_thumbnail(get_the_ID(), 'full'); ?>

                    <?php if($settings['popup'] == 'no-content') : ?>
                    <div id="item-<?php echo get_the_id(); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
                      <?php echo wp_sprintf($img_enlarge); ?>
                    </div><!-- /.tx-port-enlrg-content -->
                    <?php endif; ?>      
                    
                    <?php if($settings['popup'] == 'content') : ?>  
                    <div id="item-<?php echo get_the_id(); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
                      <div class="tx-port-enlrg-content-left">
                        <?php echo wp_sprintf($img_enlarge); ?>
                      </div><!-- /.tx-port-enlrg-content-left -->

                      <div class="tx-port-enlrg-content-right">
                        <h3 class="tx-port-enlrg-content-title"><?php echo esc_html(the_title());?></h3>
                        <p><?php echo wp_sprintf(tx_content(75)); ?></p>
                      </div><!-- /.tx-port-enlrg-content-right -->
                    </div><!-- /.tx-port-enlrg-content -->
                    <?php endif; ?>

                    <?php if('card-h' === $settings['display'] || 'card-v' === $settings['display']): ?>
                    <div class="tx-port-card-content">
                        <?php if(!empty($cat_name) && $settings['category_display'] == 'show') : ?>
                          <div class="tx-port-cat">
                            <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_attr($cat_name); ?></a>
                          </div><!-- /.tx-port-cat -->
                        <?php endif; ?>  
                        
                        <?php if($settings['title'] == 'show') : ?>
                          <h4 class="tx-port-title"><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
                        <?php endif; ?>
                        
                        <?php if($settings['bio'] == 'show') : ?>
                          <p class="tx-port-excp"><?php echo esc_html(tx_excerpt_limit(5)); ?></p>  
                        <?php endif; ?>
                    </div><!-- tx-port-card-content -->
                    <?php endif; ?>
                </div><!-- tx-portfolio-item -->


                <?php endwhile;
                wp_reset_postdata(); ?>
            </div><!-- tx-carousel -->
            
           
         
            <?php
            else:
                get_template_part('template-parts/content/content', 'none');
            endif;
            ?>
            <div class="clearfix"></div>
        </div><!-- tx-carousel-wrapper -->


<?php

    } // render()

} // class 