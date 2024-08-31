<?php
namespace AvasElements\Modules\WoocommerceGrid\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WoocommerceGrid extends Widget_Base {

    public function get_name() {
        return 'avas-woocommerce-grid';
    }

    public function get_title() {
        return esc_html__( 'Avas Woo Product Grid', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {
        if ( class_exists( 'WooCommerce' ) ) {
        $this->start_controls_section(
            'section_posts_carousel',
            [
                'label' => esc_html__('Settings', 'avas-core'),
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
            'product_categories',
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
            'posts_per_page',
            [
                'label' => esc_html__('Product Per Page', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );
        // $this->add_control(
        //     'offset',
        //     [
        //         'label' => esc_html__( 'Offset', 'avas-core' ),
        //         'type' => Controls_Manager::NUMBER,
               
        //     ]
        // );
        $this->add_control(
            'display_columns',
            [
                'label' => esc_html__('Columns per row', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
            ]
        );
        $this->add_responsive_control(
            'column_margin',
            [
                'label'         => esc_html__( 'Product Space', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .woocommerce ul.products li.product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'min_height',
            [
                'label' => esc_html__( 'Product Height', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .woocommerce ul.products li.product' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
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
                'separator' => 'before',
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
                'separator' => 'before'
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
            'pagination',
            [
                'label' => esc_html__( 'Pagination', 'avas-core' ),
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
                'default' => 'hide',
               
            ]
        );

        $this->end_controls_section();
                
        $this->start_controls_section(
            'section_styling',
            [
                'label' => esc_html__('Styles', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                'label' => esc_html__( 'Title Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-loop-product__title' => 'color: {{VALUE}};',
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
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-product__title',
            ]
        );


        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .price' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .price, {{WRAPPER}} .woocommerce ul.products li.product .price ins',
            ]
        );
        $this->add_control(
            'sale_price_color',
            [
                'label' => esc_html__( 'Sale Price Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .price del' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sale_price_typography',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .price del',
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
            'pagination_color',
            [
                'label'     => esc_html__( 'Pagination Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination span, {{WRAPPER}} .tx-pagination a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'pagination_border_color',
            [
                'label'     => esc_html__( 'Pagination Border Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination span, {{WRAPPER}} .tx-pagination a' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_control(
            'pagination_hover_color',
            [
                'label'     => esc_html__( 'Pagination Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination a:hover, {{WRAPPER}} .tx-pagination span' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_control(
            'pagination_hover_border_color',
            [
                'label'     => esc_html__( 'Pagination Hover Border Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination a:hover, {{WRAPPER}} .tx-pagination span' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_control(
            'pagination_hover_bg_color',
            [
                'label'     => esc_html__( 'Pagination Hover Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination a:hover, {{WRAPPER}} .tx-pagination span' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'pagination_typography',
                   'selector'  => '{{WRAPPER}} .tx-pagination span, {{WRAPPER}} .tx-pagination a',
                   'condition' => [
                      'pagination' => 'show',
                    ],
              ]
        );
        
        $this->end_controls_section();

    }
    }

    protected function render() {
    if ( class_exists( 'WooCommerce' ) ) :
        $settings = $this->get_settings();
        $display_columns = $settings['display_columns'];
        $new_badge = $settings['new_badge'];
        $new_badge_duration = $settings['new_badge_duration']['size'];
        $sale_badge = $settings['sale_badge'];
        $featured_badge = $settings['featured_badge'];
        $pagination = $settings['pagination'];
        
        if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;

        $query_args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $settings['posts_per_page'],
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'paged'               => $paged,
        //    'offset' => $settings['offset'],
        );
        
        if($settings['product_type'] == 'featured'){
            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            );
        } 

        elseif ( !empty($settings['product_categories']) ) {            
            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $settings['product_categories'],
            );
        }
    
        $loop = new \WP_Query($query_args);
        global $product;
        
        if ($loop->have_posts()) : ?>

            <div class="woocommerce">

                <ul class="products columns-<?php echo esc_attr( $display_columns ); ?>">
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                   

                        <li <?php wc_product_class( '', $product ); ?>>
                        <?php
                            woocommerce_template_loop_product_link_open();
                            // product gallery first image hover
                            TX_Helper::woo_image_hover();
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

            </div> <!-- .woocommerce -->
            <div class="clearfix"></div>
            <!-- pagination -->
            <?php
                if($pagination == 'show') :
                tx_pagination_number($loop->max_num_pages,"",$paged);
                endif;
            ?>
        <?php endif; ?>

        <?php
        else: 
        echo '<h4 class="text-align-center">' . esc_html__( 'Please install and activate WooCoommerce plugin', 'avas-core' ) . '</h4>';
        endif; // class WooCommerce
     
    } // render()
} // class Portfolio
