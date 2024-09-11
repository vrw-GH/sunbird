<?php
namespace AvasElements\Modules\WoocommerceCarousel\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WoocommerceCarousel extends Widget_Base {

    public function get_name() {
        return 'avas-woocommerce-carousel';
    }

    public function get_title() {
        return esc_html__( 'Avas Woo Product Carousel', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
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
    if ( class_exists( 'WooCommerce' ) ) {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );

        $this->add_control(
            'product_type',
            [
                'label'   => esc_html__( 'Product Type', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'featured'        => esc_html__( 'Featured', 'avas-core' ),
                    'product_cat' => esc_html__( 'Categories', 'avas-core' ),
                ],
                'default' => 'product_cat',
            ]
        );
        
        $this->add_control(
            'categories',
            [
                'label'       => esc_html__( 'Categories', 'avas-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => TX_Helper::get_post_type_categories('product_cat'),
                'default'     => [],
                'label_block' => true,
                'multiple'    => true,
                'condition'   => [
                    'product_type'    => 'product_cat',
                ],
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Products', 'avas-core' ),
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
                'label'   => esc_html__( 'Order by', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'     => esc_html__( 'Date', 'avas-core' ),
                    'title'    => esc_html__( 'Title', 'avas-core' ),
                    'category' => esc_html__( 'Category', 'avas-core' ),
                    'rand'     => esc_html__( 'Random', 'avas-core' ),
                ],
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
            'sale_badge',
            [
                'label' => esc_html__( 'Sale Badge', 'avas-core' ),
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
                
            ]
        );
        $this->add_control(
            'featured_badge',
            [
                'label' => esc_html__( 'Featured Badge', 'avas-core' ),
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
                
            ]
        );
        $this->add_control(
            'new_badge',
            [
                'label' => esc_html__( 'New Badge', 'avas-core' ),
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
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'new_badge_duration',
            [
                'label' => esc_html__( 'New badge display for days', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 7,
                ],
                'condition' => [
                    'new_badge' => 'show'
                ],
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
                'default' => 4
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
            'cont_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product, {{WRAPPER}} .woocommerce-page ul.products li.product' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cont_shadow',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product, {{WRAPPER}} .woocommerce-page ul.products li.product',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-loop-product__title, {{WRAPPER}} .woocommerce ul.products li.product .button' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .woocommerce ul.products li.product .button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_bg_color',
            [
                'label'     => esc_html__( 'Title Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selectors'  => '{{WRAPPER}} .woocommerce-carousel-wrapper .woocommerce-loop-product__title, {{WRAPPER}} .woocommerce ul.products li.product .button',
              ]
        );
        $this->add_control(
            'price_reg_color',
            [
                'label'     => esc_html__( 'Regular Price Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .price del' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'reg_price_typography',
                   'selector'  => '{{WRAPPER}} .woocommerce ul.products li.product .price del',
              ]
        );
        $this->add_control(
            'price_sale_color',
            [
                'label'     => esc_html__( 'Sale Price Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .price' => 'color: {{VALUE}};',
                ],

                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'sale_price_typography',
                   'selector'  => '{{WRAPPER}} .woocommerce ul.products li.product .price ins',
              ]
        );
        $this->add_control(
            'prod_sale_badge_color',
            [
                'label' => esc_html__( 'Sale Badge Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .onsale' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'sale_badge' => 'show'
                ]
            ]
        );
        $this->add_control(
            'prod_sale_badge_bg_color',
            [
                'label' => esc_html__( 'Sale Badge Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .onsale' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'sale_badge' => 'show'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_sale_badge_typography',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .onsale',
                'condition' => [
                    'sale_badge' => 'show'
                ]
            ]
        );
        $this->add_control(
            'prod_new_badge_color',
            [
                'label' => esc_html__( 'New Badge Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .itsnew.onsale' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'new_badge' => 'show'
                ]
            ]
        );
        $this->add_control(
            'prod_new_badge_bg_color',
            [
                'label' => esc_html__( 'New Badge Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .itsnew.onsale' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'new_badge' => 'show'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_new_badge_typography',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .itsnew.onsale',
                'condition' => [
                    'new_badge' => 'show'
                ]
            ]
        );
        $this->add_control(
            'prod_featured_badge_color',
            [
                'label' => esc_html__( 'Featured Badge Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .featured.itsnew.onsale' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'featured_badge' => 'show'
                ]
            ]
        );
        $this->add_control(
            'prod_featured_badge_bg_color',
            [
                'label' => esc_html__( 'Featured Badge Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .featured.itsnew.onsale' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'featured_badge' => 'show'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_featured_badge_typography',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .featured.itsnew.onsale',
                'condition' => [
                    'featured_badge' => 'show'
                ]
            ]
        );
        $this->add_control(
            'prod_cart_color',
            [
                'label' => esc_html__( 'Add to Cart Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'prod_cart_hover_color',
            [
                'label' => esc_html__( 'Add to Cart Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'prod_cart_bg_color',
            [
                'label' => esc_html__( 'Add to Cart Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_cart_typography',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .button',
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
    }
    protected function render() {
        if ( class_exists( 'WooCommerce' ) ) {

        $settings = $this->get_settings();
        $navigation = $settings['navigation'];
        $categories = $settings['categories'];
        $new_badge = $settings['new_badge'];
        $new_badge_duration = $settings['new_badge_duration']['size'];
        $sale_badge = $settings['sale_badge'];
        $featured_badge = $settings['featured_badge'];
        $number_of_posts = $settings['number_of_posts'];

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        if($settings['product_type'] == 'featured'){
            $query_args = array(
                'post_type' => 'product',
                'showposts' => $number_of_posts,
                'offset' => $settings['offset'],
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                    ),
                )
            );

        } 


        elseif( !empty($categories) ) {

            $query_args = array(
                'post_type' => 'product',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'showposts' => $number_of_posts,
                'offset' => $settings['offset'],
                'post_status' => 'publish',
                'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => $categories,
                    ),
                )
            );

        } else {

            $query_args = array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'showposts' => $number_of_posts,
                'offset' => $settings['offset'],
                'orderby'             => $settings['orderby'],
                'order'               => $settings['order'],
            );
        }

        $this->add_render_attribute( 'tx-carousel', 'class', 'products columns-1 tx-carousel owl-carousel owl-theme' );
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


        $course_query = new \WP_Query( $query_args );
        global $product;
        
        ?>

        <div class="woocommerce-carousel-wrapper woocommerce">

            <?php
          
            if ($course_query->have_posts()) : ?>

                <ul <?php echo $this->get_render_attribute_string( 'tx-carousel' ); ?> >
                <?php while ($course_query->have_posts()) : $course_query->the_post(); ?>
                
                <?php  global $product; ?>
                    <li <?php wc_product_class( '', $product ); ?>>
                            
                        <?php
                            woocommerce_template_loop_product_link_open();

                            // sale badge
                            if( $sale_badge == 'show' ) :
                            wc_get_template( 'loop/sale-flash.php' );
                            endif;
                            
                            // new badge
                            if( $new_badge == 'show' ) :
                                global $product;
                                $created = strtotime( $product->get_date_created() );
                                if ( ( time() - ( 60 * 60 * 24 * $new_badge_duration ) ) < $created ) {
                                ?>
                                    <span class="itsnew onsale"><?php echo esc_html__( 'New', 'avas' ); ?></span>
                                <?php
                                }
                            endif;

                            // featured badge
                            if( $featured_badge == 'show' ) :
                                global $product;
                                $featured = $product->is_featured();
                                if($featured) : ?>
                                    <span class="featured itsnew onsale"><?php echo esc_html__( 'Featured', 'avas' ); ?></span>
                                <?php endif;
                            endif;

                            woocommerce_template_loop_product_thumbnail();

                            // quick view
                            if ( class_exists( 'WPCleverWoosq' ) ) : 
                                echo do_shortcode( '[woosq]' );
                            endif;

                            // wishlist
                            if ( class_exists( 'WPCleverWoosw' ) ) :
                                echo do_shortcode( '[woosw]' );
                            endif;
                            
                            // compare
                            if ( class_exists( 'WPCleverWoosc' ) ) :
                                echo do_shortcode( '[woosc]' );
                            endif;

                            // product gallery first image hover
                            TX_Helper::woo_image_hover();

                            woocommerce_template_loop_add_to_cart( $args = array() );
                            woocommerce_template_loop_product_title();

                            wc_get_template( 'loop/rating.php' );

                            wc_get_template( 'loop/price.php' );

                            woocommerce_template_loop_product_link_close();

                            
                            
                            ?>

                        </li>
                

                <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
         
            <?php
           
            endif;
            ?>
            <div class="clearfix"></div>
        </div><!-- woocommerce-carousel-wrapper -->

<?php
        } else {
            echo '<h4 class="text-align-center">' . esc_html__( 'Please install and activate WooCommerce plugin', 'avas-core' ) . '</h4>';

        } // Class woocommerce

    } // function render()

} // class Portfolio