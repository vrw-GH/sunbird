<?php
namespace AvasElements\Modules\PostMasonryGrid\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostMasonryGrid extends Widget_Base {

    public function get_name() {
        return 'avas-post-masonry-grid';
    }

    public function get_title() {
        return esc_html__( 'Avas Post Masonry Grid', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() { 
        return [ 'infinite-scroll','tx-isotope','tx-imagesloaded' ]; 
    }

	protected function register_controls() {

        
        $this->start_controls_section(
            'post_masonry_grid_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );

        $this->add_control(
            'post_masonry_grid_layout',
            [
                'label' => esc_html__( 'Post Layout', 'avas-core' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'avas-core' ),
                    'overlay' => esc_html__( 'Overlay', 'avas-core' ),
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_count',
            [
                'label' => esc_html__( 'Post Count', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_columns',
            [
                'label' => esc_html__( 'Columns', 'avas-core' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,             
                'desktop_default' => '33.330%',
                'mobile_default' => '100%',
                'options' => [
                    '100%' => esc_html__( '1 Column', 'avas-core' ),
                    '50%' => esc_html__( '2 Column', 'avas-core' ),
                    '33.330%' => esc_html__( '3 Columns', 'avas-core' ),
                    '25%' => esc_html__( '4 Columns', 'avas-core' ),
                    '20%' => esc_html__( '5 Columns', 'avas-core' ),
                    '16.67%' => esc_html__( '6 Columns', 'avas-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-column' => 'width: {{VALUE}};',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'post_masonry_grid_masonry',
            [
                'label' => esc_html__( 'Masonry Layout', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_image_display',
            [
                'label' => esc_html__( 'Show Image', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'full',
                'condition' => [
                    'post_masonry_grid_image_display' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'post_masonry_grid_avatar',
            [
                'label' => esc_html__( 'Avatar', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_title',
            [
                'label' => esc_html__( 'Title', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
          'p_l_title_text_limit',
          [
            'label'         => esc_html__( 'Title text limit', 'avas-core' ),
            'type'          => Controls_Manager::NUMBER,
            'label_block'   => true,
            'default'       => 50,
            'condition' => [
                'post_masonry_grid_title' => 'yes',
            ],
          ]
        );
        $this->add_control(
            'post_masonry_grid_excerpt',
            [
                'label' => esc_html__( 'Excerpt', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_excerpt_count',
            [
                'label' => esc_html__( 'Excerpt Words', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '30',
                'condition' => [
                    'post_masonry_grid_excerpt' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_meta_data_location',
            [
                'label' => esc_html__( 'Meta Data Location', 'avas-core' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'default' => 'middle',
                'options' => [
                    'top' => esc_html__( 'Top', 'avas-core' ),
                    'middle' => esc_html__( 'Middle', 'avas-core' ),
                    'bottom' => esc_html__( 'Bottom', 'avas-core' ),
                ],
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_meta_data',
            [
                'label' => esc_html__( 'Meta Data', 'avas-core' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'default' => [ 'date', 'categories' ],
                'multiple' => true,
                'options' => [
                    'author' => esc_html__( 'Author', 'avas-core' ),
                    'date' => esc_html__( 'Date', 'avas-core' ),
                    'categories' => esc_html__( 'Categories', 'avas-core' ),
                    'comments' => esc_html__( 'Comment Count', 'avas-core' ),
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_meta_data_divider',
            [
                'label' => esc_html__( 'Meta Divider', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '-',
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-meta li span:after' => 'content: "{{VALUE}}"',
                ],
                'condition' => [
                    'post_masonry_grid_meta_data!' => '',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_read_more',
            [
                'label' => esc_html__( 'Read More', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator' => 'before',
                'default' => 'yes',
                'condition' => [
                    'post_masonry_grid_layout' => 'default',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_read_more_text',
            [
                'label' => esc_html__( 'Read More Text', 'avas-core' ),
                'default' => esc_html__( 'Read More', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'post_masonry_grid_read_more' => 'yes',
                    'post_masonry_grid_layout' => 'default',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_overlay_tax',
            [
                'label' => esc_html__( 'Taxonomy Overlay', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_overlay_tax_overlay',
            [
                'label' => esc_html__( 'Taxonomy Overlay', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'cat',
                'options' => [
                    'cat' => esc_html__( 'Category', 'avas-core' ),
                    'tag' => esc_html__( 'Tag', 'avas-core' ),
                ],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_posts_order',
            [
                'label' => esc_html__( 'Post Order', 'avas-core' )
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_order_by',
            [
                'label' => esc_html__( 'Order By', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__( 'Default - Date', 'avas-core' ),
                    'title' => esc_html__( 'Post Title', 'avas-core' ),
                    'menu_order' => esc_html__( 'Menu Order', 'avas-core' ),
                    'modified' => esc_html__( 'Last Modified', 'avas-core' ),
                    'comment_count' => esc_html__( 'Comment Count', 'avas-core' ),
                    'rand' => esc_html__( 'Random', 'avas-core' ),
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_order_asc_desc',
            [
                'label' => esc_html__( 'Order', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'avas-core' ),
                    'DESC' => esc_html__( 'Descending', 'avas-core' ),
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_offset_count',
            [
                'label' => esc_html__( 'Offset Count', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => '0',
                'default' => '0',
                'description' => esc_html__( 'Use this to skip over posts (Example: 3 would skip the first 3 posts.)', 'avas-core' ),
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_posts_global_query',
            [
                'label' => esc_html__( 'Query', 'avas-core' )
            ]
        );
        
        $this->add_control(
            'post_type_control',
            [
                'label' => esc_html__( 'Post Type', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => TX_Helper::get_all_post_types(),
                'default' => 'post',
            ]
        );
        
        $this->add_control(
            'post_type_author',
            [
                'label' => esc_html__( 'Author', 'avas-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => TX_Helper::get_all_auhtors(),
            ]
        );
        
        
        $this->add_control(
            'post_type_categories',
            [
                'label' => esc_html__( 'Categories', 'avas-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => TX_Helper::get_post_type_categories('category'),
                'condition' => [
                    'post_type_control' => 'post',
                ],
            ]
        );
        
        $this->add_control(
            'post_type_tags',
            [
                'label' => esc_html__( 'Tags', 'avas-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => TX_Helper::get_all_tags(),
                'condition' => [
                    'post_type_control' => 'post',
                ],
            ]
        );
        
        $post_formats_terms = get_terms( array( 'taxonomy' => 'post_format' ));
        if ( ! empty( $post_formats_terms ) && ! is_wp_error( $post_formats_terms ) ){
            $this->add_control(
                'post_type_post_formats',
                [
                    'label' => esc_html__( 'Post Format', 'avas-core' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => TX_Helper::get_post_format(),
                    'condition' => [
                        'post_type_control' => 'post',
                    ],
                ]
            );
        }
        
        $this->add_control(
            'post_masonry_grid_exclude',
            [
                'label' => esc_html__( 'Choose Posts to Exclude', 'avas-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => TX_Helper::get_all_posts(),
                'condition' => [
                    'post_type_control' => 'post',
                ],
            ]
        );
        
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_posts_pagination',
            [
                'label' => esc_html__( 'Pagination', 'avas-core' )
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_pagination',
            [
                'label' => esc_html__( 'Pagination', 'avas-core' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'avas-core' ),
                    'default' => esc_html__( 'Default Pagination', 'avas-core' ),
                    'infinite' => esc_html__( 'Infinite Loading', 'avas-core' ),
                    'load-more' => esc_html__( 'Load More Button', 'avas-core' ),
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_pagination_prev',
            [
                'label' => esc_html__( 'Previous Label', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '&lsaquo; Previous',
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_pagination_next',
            [
                'label' => esc_html__( 'Next Label', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Next &rsaquo;',
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );
    
        $this->add_control(
            'post_masonry_grid_pagination_load_more',
            [
                'label' => esc_html__( 'Load More Label', 'avas-core' ),
                'description' => esc_html__( 'Load More button will display in live page only.', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Load More',
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_pagination_load_more_icon',
            [
                'type' => Controls_Manager::ICON,
                'label' => esc_html__( 'Icon', 'avas-core' ),
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_pagination_load_more_icon_indent',
            [
                'label' => esc_html__( 'Icon Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-infinite span i' => 'padding-left: {{SIZE}}px;',
                ],
                'condition' => [
                    'post_masonry_grid_pagination_load_more_icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'post_masonry_grid_pagination_no_post',
            [
                'label' => esc_html__( 'No More Posts Label', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'NO MORE POSTS',
                'condition' => [
                    'post_masonry_grid_pagination!' => 'none',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        
        $this->start_controls_section(
            'section_main_container_styles',
            [
                'label' => esc_html__( 'Main Styles', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'elements_post_list_content_background',
                'types' => [ 'none', 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-style',
                'condition' => [
                    'post_masonry_grid_layout' => 'default',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'elements_post_list_overlay_background',
                'types' => [ 'none', 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-overlay-layout .tx-post-overlay-positioning',
                'condition' => [
                    'post_masonry_grid_layout' => 'overlay',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_margin_left_right',
            [
                'label' => esc_html__( 'Margin Left/Right', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-margin' => 'margin-left:-{{SIZE}}px; margin-right:-{{SIZE}}px;',
                    '{{WRAPPER}} .tx-post-masonry-grid-image-padding' => 'padding-left: {{SIZE}}px; padding-right:{{SIZE}}px;',
                ],
                'render_type' => 'template'
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-margin' => 'margin-top:-{{SIZE}}px;',
                    '{{WRAPPER}} .tx-post-masonry-grid-image-padding' => 'padding-top:{{SIZE}}px; padding-bottom:{{SIZE}}px;',
                ],
                'render_type' => 'template'
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_cotainer_brdr_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-style' => 'border-radius:{{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_overlay_height',
            [
                'label' => esc_html__( 'Height', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 350,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 900,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-overlay-layout .tx-post-masonry-grid-overlay-image' => 'height: {{SIZE}}px;',
                ],
                'condition' => [
                    'post_masonry_grid_layout' => 'overlay',
                ],
                'render_type' => 'template'
            ]
        );
        
        $this->add_control(
            'elements_post_list_vertical_position',
            [
                'label' => esc_html__( 'Vertical', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'avas-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__( 'Middle', 'avas-core' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'avas-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'bottom',
                'selectors' => [
                    '{{WRAPPER}} .tx-post-vertical-align' => '{{VALUE}}',
                ],
                'condition' => [
                    'post_masonry_grid_layout' => 'overlay',
                ],
                'selectors_dictionary' => [
                    'top' => 'display:block; position:static;',
                    'middle' => 'display:table-cell; vertical-align:middle;  position:static;',
                    'bottom' => 'position:absolute; bottom:0px; display:block;',
                ],

            ]
        );
        
        $this->add_responsive_control(
            'elements_post_list_content_align',
            [
                'label' => esc_html__( 'Align', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-style' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'elements_post_list_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_pagination_hover_background_overlay',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Hover Background Color', 'avas-core' ),
                'separator' => 'before',
                'condition' => [
                    'post_masonry_grid_layout' => 'overlay',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'elements_post_list_overlay_background_hover',
                'types' => [ 'none', 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-overlay-layout:hover .tx-post-overlay-positioning',
                'condition' => [
                    'post_masonry_grid_layout' => 'overlay',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'elements_post_list_border',
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-container',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_masonry_grid_box_shadow',
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-style',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_main_text_styles',
            [
                'label' => esc_html__( 'Text Styles', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_heading_color',
            [
                'label' => esc_html__( 'Title Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-post-masonry-grid-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_heading_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_heading_spacing',
            [
                'label' => esc_html__( 'Title Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-title' => 'margin-bottom:{{SIZE}}px;',
                ],
                'render_type' => 'template'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'post_masonry_grid_heading_typography',
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-title',
            ]
        );
        
        
        $this->add_control(
            'post_masonry_grid_heading_meta_styles',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Meta Styles', 'avas-core' ),
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_meta_color',
            [
                'label' => esc_html__( 'Meta Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-meta' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-post-masonry-grid-meta a' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_masonry_grid_meta_border_color',
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-meta',
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_meta_spacing',
            [
                'label' => esc_html__( 'Meta Margins', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_meta_spacing_padding',
            [
                'label' => esc_html__( 'Meta Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_meta_color_sep',
            [
                'label' => esc_html__( 'Separator Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-meta li.tx-post-masonry-grid-meta-item span:after' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_meta_separator_spacing',
            [
                'label' => esc_html__( 'Separator Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-meta li.tx-post-masonry-grid-meta-item span:after' => 'padding-right:{{SIZE}}px; padding-left:{{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'post_masonry_grid_meta_typography',
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-meta',
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_heading_excerpt_styles',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Excerpt Styles', 'avas-core' ),
                'separator' => 'before',
                'condition' => [
                    'post_masonry_grid_excerpt' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_excerpt_color',
            [
                'label' => esc_html__( 'Excerpt Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-excerpt' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_excerpt' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_excerpt_spacing',
            [
                'label' => esc_html__( 'Excerpt Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-excerpt' => 'margin-bottom:{{SIZE}}px;',
                ],
                'render_type' => 'template',
                'condition' => [
                    'post_masonry_grid_excerpt' => 'yes',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'post_masonry_grid_excerpt_typography',
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-excerpt, {{WRAPPER}} .tx-post-masonry-grid-excerpt p',
                'condition' => [
                    'post_masonry_grid_excerpt' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_heading_read_more_styles',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Read More Styles', 'avas-core' ),
                'separator' => 'before',
                'condition' => [
                    'post_masonry_grid_read_more' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_read_more_color',
            [
                'label' => esc_html__( 'Read More Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-read-more' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_read_more' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_read_more_color_hover',
            [
                'label' => esc_html__( 'Read More Hover', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-read-more:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_read_more' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_read_more_spacing',
            [
                'label' => esc_html__( 'Read More Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-read-more' => 'margin-bottom:{{SIZE}}px;',
                ],
                'render_type' => 'template',
                'condition' => [
                    'post_masonry_grid_read_more' => 'yes',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'post_masonry_grid_read_more_typography',
                'selector' => '{{WRAPPER}} .tx-post-masonry-read-more',
                'condition' => [
                    'post_masonry_grid_read_more' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_main_image_styles',
            [
                'label' => esc_html__( 'Image Styles', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'post_masonry_grid_layout' => 'default',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_image_hover_trasparency',
            [
                'label' => esc_html__( 'Image Hover Transparency', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'step' => 0.1,
                        'min' => 0,
                        'max' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-image:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_image_background',
            [
                'label' => esc_html__( 'Image Background', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-image' => 'background: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_image_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-image img' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        
        $this->start_controls_section(
            'section_main_avatar_tax_styles',
            [
                'label' => esc_html__( 'Taxonomy Overlay Styles', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'elements_post_list_taxonomy_positionn_vertical',
            [
                'label' => esc_html__( 'Vertical', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'avas-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'avas-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'top' => 'top:0px; bottom:auto;',
                    'bottom' => 'top:auto; bottom:0px;',
                ],

            ]
        );
        
        $this->add_control(
            'elements_post_list_taxonomy_position',
            [
                'label' => esc_html__( 'Horizontal', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay' => '{{VALUE}}',
                ],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
                'selectors_dictionary' => [
                    'left' => 'left:0px; right:auto;',
                    'right' => 'left:auto; right:0px;',
                ],

            ]
        );
        
        $this->add_responsive_control(
            'elements_post_list_taxonomy_position_margins',
            [
                'label' => esc_html__( 'Taxonomy Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'elements_post_list_taxonomy_position_spacing',
            [
                'label' => esc_html__( 'Taxonomy Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 25,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay a' => 'margin-left:{{SIZE}}px;',
                ],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_taxonomy_color',
            [
                'label' => esc_html__( 'Taxonomy Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'post_masonry_grid_taxonomy_color_hover',
            [
                'label' => esc_html__( 'Taxonomy Color Hover', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_taxonomy_background',
            [
                'label' => esc_html__( 'Taxonomy Background', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay a' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'post_masonry_grid_taxonomy_background_hover',
            [
                'label' => esc_html__( 'Taxonomy Background Hover', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay a:hover' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_avatar_taxonomy_radius',
            [
                'label' => esc_html__( 'Taxonomy Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay a' => 'border-radius:{{SIZE}}px;',
                ],
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'post_masonry_grid_taxonomy_typo',
                'selector' => '{{WRAPPER}} .tx-post-masonry-grid-taxonomy-overlay a',
                'condition' => [
                    'post_masonry_grid_overlay_tax' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_main_avatar_main_styles',
            [
                'label' => esc_html__( 'Avatar Styles', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'post_masonry_grid_avatar' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'elements_post_list_avatar_position_vertical',
            [
                'label' => esc_html__( 'Vertical', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'avas-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'avas-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-avatar' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'top' => 'top:0px; bottom:auto;',
                    'bottom' => 'top:auto; bottom:0px;',
                ],

            ]
        );
        
        $this->add_control(
            'elements_post_list_avatar_position',
            [
                'label' => esc_html__( 'Horizontal', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .tx-post-avatar' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'left:0px; right:auto;',
                    'right' => 'left:auto; right:0px;',
                ],

            ]
        );

        $this->add_responsive_control(
            'post_masonry_grid_avatar_margins',
            [
                'label' => esc_html__( 'Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_avatar_width',
            [
                'label' => esc_html__( 'Avatar Size', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-avatar' => 'width:{{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_avatar_border_radius',
            [
                'label' => esc_html__( 'Avatar Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-avatar img' => 'border-radius:{{SIZE}}px;',
                ],
                'condition' => [
                    'post_masonry_grid_avatar' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_main_pagination_styles',
            [
                'label' => esc_html__( 'Pagination Styles', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'post_masonry_grid_pagination!' => 'none',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'elements_post_list_pagination_align',
            [
                'label' => esc_html__( 'Align', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .tx-post-pagination-container' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'elements_post_list_padingation_padding',
            [
                'label' => esc_html__( 'Margins', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-pagination-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_pagination_between_spacing',
            [
                'label' => esc_html__( 'Space Between Page Numbers', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-pagination-container ul li' => 'padding-left:{{SIZE}}px; padding-right:{{SIZE}}px;',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagi_numb_border',
                'selector' => '{{WRAPPER}} .tx-post-pagination-container ul li',
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );
        $this->add_control(
            'post_masonry_grid_pagi_num_color',
            [
                'label' => esc_html__( 'Number Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-pagination-container ul li a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );
        $this->add_control(
            'post_masonry_grid_pagi_num_hov_color',
            [
                'label' => esc_html__( 'Number Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-pagination-container ul li a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );
        $this->add_control(
            'post_masonry_grid_pagi_num_active_color',
            [
                'label' => esc_html__( 'Number Active Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-pagination-container ul li .current' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );
        $this->add_control(
            'post_masonry_grid_pagi_num_bg_color',
            [
                'label' => esc_html__( 'Background', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-pagination-container ul li' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );
        $this->add_control(
            'post_masonry_grid_pagi_num_bg_hov_color',
            [
                'label' => esc_html__( 'Background Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-pagination-container ul li:hover' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'default',
                ],
            ]
        );

        $this->add_control(
            'post_masonry_grid_pagination_load_more_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Load More Button Styles', 'avas-core' ),
                'separator' => 'before',
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-post-infinite a',
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_masonry_grid_pagination_load_more_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-infinite a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );
        
        $this->start_controls_tabs( 'elements_load_more_btn_tabs' );

        $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'avas-core' ), 'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ], ] );

        $this->add_control(
            'elements_load_more_btn_text_color',
            [
                'label' => esc_html__( 'Text Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-infinite a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );
        
        $this->add_control(
            'elements_load_more_btn_background_color',
            [
                'label' => esc_html__( 'Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-infinite a' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'elements_load_more_btn_border_main_control',
                'selector' => '{{WRAPPER}} .tx-post-infinite a',
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab( 'elements_hover', [ 'label' => esc_html__( 'Hover', 'avas-core' ), 'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ], ] );

        $this->add_control(
            'elements_load_more_btn_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-infinite a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );

        $this->add_control(
            'elements_load_more_btn_hover_background_color',
            [
                'label' => esc_html__( 'Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-infinite a:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );

        $this->add_control(
            'elements_load_more_btn_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-infinite a:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => 'load-more',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        
        $this->add_control(
            'post_masonry_grid_pagination_load_more_gif_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Loading Image', 'avas-core' ),
                'separator' => 'before',
                'condition' => [
                    'post_masonry_grid_pagination' => ['load-more', 'infinite'],
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_pagination_load_more_gif_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__( 'GIF Loading Image', 'avas-core' ),
                'condition' => [
                    'post_masonry_grid_pagination' => ['load-more', 'infinite'],
                ],
            ]
        );
        
        
        $this->add_control(
            'post_masonry_grid_loading_image_brdr_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [ 'px' => '100' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #infscr-loading img' => 'border-radius:{{SIZE}}px;',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => ['load-more', 'infinite'],
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_loading_image_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [ 'px' => '20' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #infscr-loading img' => 'padding:{{SIZE}}px;',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => ['load-more', 'infinite'],
                ],
            ]
        );
        
        $this->add_control(
            'post_masonry_grid_loading_image_background',
            [
                'label' => esc_html__( 'Background', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #infscr-loading img' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'post_masonry_grid_pagination' => ['load-more', 'infinite'],
                ],
            ]
        );
        
        $this->end_controls_section();      
       
    }

    
    protected function render( ) {
        
      $settings = $this->get_settings();
      $title_text_limit   = $settings['p_l_title_text_limit'];

      // title text limit
        if( $title_text_limit ){
            $title_text_limit = $title_text_limit;
        } else {
            $title_text_limit = 50;
        }


        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {   $paged = get_query_var('page'); } else {  $paged = 1; }
        
        
        $post_per_page = $settings['post_masonry_grid_count'];
        $offset = $settings['post_masonry_grid_offset_count'];
        $offset_new = $offset + (( $paged - 1 ) * $post_per_page);
        
        $authorarray = $settings['post_type_author']; // get custom field value
        if($authorarray >= 1) { 
            $authorid = implode(', ', $authorarray); 
        } else {
            $authorid = '';
        }
        
        
        $catarray = $settings['post_type_categories']; // get custom field value
        if($catarray >= 1 && $settings['post_type_control'] == 'post' ) { 
            $catids = implode(', ', $catarray); 
        } else {
            $catids = '';
        }
        
        $tagarray = $settings['post_type_tags']; // get custom field value
        if($tagarray >= 1 && $settings['post_type_control'] == 'post') {             
            $tagids = implode(', ', $tagarray);
         $tagidsexpand = explode(', ', $tagids);
            
        } else {
            $tagidsexpand = '';
        }
        
        if ( ! empty( $settings['post_type_post_formats'] ) ){
            
        $formatarray = $settings['post_type_post_formats']; // get custom field value
        if($formatarray >= 1) { 
            $formatids = implode(', ', $formatarray);
         $formatidsexpand = explode(', ', $formatids);
            $formatoperator = 'IN'; 
        } else {
            $formatidsexpand = '';
            $formatoperator = 'NOT IN'; 
        }
        
    } else {
        $formatidsexpand = '';
        $formatoperator = 'NOT IN'; 
    }
    
    $post_exclude_array = $settings['post_masonry_grid_exclude']; // get custom field value
    if($post_exclude_array >= 1 && $settings['post_type_control'] == 'post') { 
        $post_exlude_id = $post_exclude_array;
    } else {
        $post_exlude_id = array();
    }


    if( !empty($settings['post_type_categories']) ):
        $args = array(
            'post_type'                 =>  $settings['post_type_control'],
            'ignore_sticky_posts'   => 1,
            'post__not_in'          => $post_exlude_id,
            'posts_per_page'            =>  $post_per_page,
            'paged'                         => $paged,
            'order'                     => $settings['post_masonry_grid_order_asc_desc'],
            'orderby'                   => $settings['post_masonry_grid_order_by'],
            'offset'                    => $offset_new,
            'author'                        => $authorid,
        //    'cat'                           => $catids,
            'tag__in'                   =>  $tagidsexpand,
            'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $settings['post_type_categories'],
                    ),
                )
                
        );
    elseif( !empty($settings['post_type_post_formats']) ):
        $args = array(
            'post_type'                 =>  $settings['post_type_control'],
            'ignore_sticky_posts'   => 1,
            'post__not_in'          => $post_exlude_id,
            'posts_per_page'            =>  $post_per_page,
            'paged'                         => $paged,
            'order'                     => $settings['post_masonry_grid_order_asc_desc'],
            'orderby'                   => $settings['post_masonry_grid_order_by'],
            'offset'                    => $offset_new,
            'author'                        => $authorid,
            'cat'                           => $catids,
            'tag__in'                   =>  $tagidsexpand,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' =>   'post_format',
                    'field'    =>   'id',
                    'operator'    =>    $formatoperator,
                    'terms'    =>   $formatidsexpand,
                )
            )
                
        );
    else:
        $args = array(
            'post_type'                 =>  $settings['post_type_control'],
            'ignore_sticky_posts'   => 1,
            'post__not_in'          => $post_exlude_id,
            'posts_per_page'            =>  $post_per_page,
            'paged'                         => $paged,
            'order'                     => $settings['post_masonry_grid_order_asc_desc'],
            'orderby'                   => $settings['post_masonry_grid_order_by'],
            'offset'                    => $offset_new,
            'author'                        => $authorid,
            'cat'                           => $catids,
            'tag__in'                   =>  $tagidsexpand,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' =>   'post_format',
                    'field'    =>   'id',
                    'operator'    =>    $formatoperator,
                    'terms'    =>   $formatidsexpand,
                )
            )
                
        );
    endif;    

        $post_loop = new \WP_Query( $args );
        
    ?>
    
    <div class="tx-post-masonry-grid-wrapper <?php if($settings['elements_post_list_content_background_background']  == "none" || $settings['elements_post_list_overlay_background_background']  == "none" ) :  ?> tx-transparent-bg<?php endif; ?>">
        <div class="tx-post-masonry-grid-margin">
            <div id="tx-post-masonry-grid-<?php echo esc_attr($this->get_id()); ?>">
            <?php  while($post_loop->have_posts()): $post_loop->the_post();?>
                <div class="tx-post-masonry-grid-item tx-post-masonry-grid-column">
                    <div class="tx-post-masonry-grid-image-padding">
                        <div class="tx-isotope-animation">
                            <?php if ( $settings['post_masonry_grid_layout'] == 'overlay' ) : ?>
                                <div class="tx-post-masonry-grid-style tx-post-masonry-grid-overlay-layout">
                                            
                                    <?php $featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
                                            
                                        <a href="<?php the_permalink(); ?>" class="tx-post-masonry-grid-overlay-image" <?php if( ! empty( $featured_image_url ) && !empty( $settings['post_masonry_grid_image_display'] ) ): ?> style="background:url(<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size'])?>); background-repeat: no-repeat;  background-position:center center;  background-size: cover;"<?php endif; ?>>

                                        <div class="tx-post-overlay-positioning">
                                            <div class="tx-post-display-table">
                                                <div class="tx-post-vertical-align">
                                                    <div class="tx-post-masonry-grid-container">
                                                    
                                                        <?php if ( $settings['post_masonry_grid_meta_data_location'] == 'top' ) : ?>
                                                            <ul class="tx-post-masonry-grid-meta">
                                                            <?php if ( in_array( 'author', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_date() ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php $i = 0;
                                                        $sep = ', ';
                                                        $cats = '';
                                                        foreach ( ( get_the_category() ) as $category ) {
                                                          if (0 < $i)
                                                            $cats .= $sep;
                                                          $cats .= $category->cat_name;
                                                          $i++;
                                                        }
                                                        echo $cats; ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
                                                            </ul>
                                                        <?php endif; ?>
                                                    
                                                        <?php if ( ! empty( $settings['post_masonry_grid_title'] ) ) : ?><h3 class="tx-post-masonry-grid-title"><?php echo TX_Helper::title_lenth($title_text_limit); ?></h3><?php endif; ?> 
                                                        
                                                            <?php if ( $settings['post_masonry_grid_meta_data_location'] == 'middle' ) : ?>
                                                            <ul class="tx-post-masonry-grid-meta">
                                                            <?php if ( in_array( 'author', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php $i = 0;
                                                        $sep = ', ';
                                                        $cats = '';
                                                        foreach ( ( get_the_category() ) as $category ) {
                                                          if (0 < $i)
                                                            $cats .= $sep;
                                                          $cats .= $category->cat_name;
                                                          $i++;
                                                        }
                                                        echo $cats; ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
                                                            </ul>
                                                            <?php endif; ?>
                                                    
                                                    
                                                            <?php if ( ! empty( $settings['post_masonry_grid_excerpt'] ) ) : ?>
                                                                <div class="tx-post-masonry-grid-excerpt">
                                                                <?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?><p><?php echo TX_Helper::excerpt_limit($settings['post_masonry_grid_excerpt_count'] ); ?></p><?php endif; ?> 
                                                                </div>
                                                            <?php endif; ?>
                                                    
                                                            <?php if ( $settings['post_masonry_grid_meta_data_location'] == 'bottom' ) : ?>
                                                                <ul class="tx-post-masonry-grid-meta">
                                                                <?php if ( in_array( 'author', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['post_masonry_grid_meta_data'] ) ) : ?>
                                                                    <li class="tx-post-masonry-grid-meta-item">
                                                                        <span>
                                                                            <?php 
                                                                                $i = 0;
                                                                                $sep = ', ';
                                                                                $cats = '';
                                                                                foreach ( ( get_the_category() ) as $category ) {
                                                                                    if (0 < $i)
                                                                                        $cats .= $sep;
                                                                                        $cats .= $category->cat_name;
                                                                                        $i++;
                                                                                }
                                                                                echo $cats; 
                                                                            ?>
                                                                        </span>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if ( in_array( 'comments', $settings['post_masonry_grid_meta_data'] ) ) : ?>
                                                                    <li class="tx-post-masonry-grid-meta-item"><span><?php comments_number(); ?></span></li>
                                                                <?php endif; ?> 
                                                                </ul>
                                                            <?php endif; ?>
                                                        <div class="tx-clearfix"></div>
                                                    </div><!-- close .tx-post-masonry-grid-container -->
                                                                                    
                                                    </div><!-- close .tx-post-vertical-align -->
                                            </div>
                                        </div><!-- close .tx-post-overlay-positioning -->
                                            
                                            </a>
                                            <?php if ( ! empty( $settings['post_masonry_grid_overlay_tax'] ) ) : ?>
                                                <div class="tx-post-masonry-grid-taxonomy-overlay">
                                                    <?php if ( $settings['post_masonry_grid_overlay_tax_overlay'] == 'cat' ) : ?><?php the_category(' ') ?><?php endif; ?>
                                                    <?php if ( $settings['post_masonry_grid_overlay_tax_overlay'] == 'tag' ) : ?><?php the_tags(' ') ?><?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $settings['post_masonry_grid_avatar'] ) ) : ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="tx-post-avatar"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '250'); ?></a><?php endif; ?>                             
                                </div><!-- close .tx-post-masonry-grid-style -->
                                            
                                    <?php else: ?>
                                        <div class="tx-post-masonry-grid-style">
                                            <?php   
                                            $featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                                            if( ! empty( $featured_image_url ) && !empty( $settings['post_masonry_grid_image_display'] ) ): ?>
                                            <div class="tx-post-masonry-grid-image-container">
                                                    <a href="<?php the_permalink(); ?>" class="tx-post-masonry-grid-image"><?php the_post_thumbnail($settings['image_size']); ?></a>
                                                    <?php if ( ! empty( $settings['post_masonry_grid_avatar'] ) ) : ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="tx-post-avatar"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '250'); ?></a><?php endif; ?>
                                                    <?php if ( ! empty( $settings['post_masonry_grid_overlay_tax'] ) ) : ?>
                                                        <div class="tx-post-masonry-grid-taxonomy-overlay">
                                                            <?php if ( $settings['post_masonry_grid_overlay_tax_overlay'] == 'cat' ) : ?><?php the_category(' ') ?><?php endif; ?>
                                                            <?php if ( $settings['post_masonry_grid_overlay_tax_overlay'] == 'tag' ) : ?><?php the_tags(' ') ?><?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                    
                                                <div class="tx-post-masonry-grid-container">
                                        
                                                    <?php if ( $settings['post_masonry_grid_meta_data_location'] == 'top' ) : ?>
                                                    <ul class="tx-post-masonry-grid-meta">
                                                        <?php if ( in_array( 'author', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_category(', ') ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
                                                    </ul>
                                                    <?php endif; ?>
                                        
                                                    <?php if ( ! empty( $settings['post_masonry_grid_title'] ) ) : ?><h3 class="tx-post-masonry-grid-title"><a href="<?php the_permalink(); ?>"><?php echo TX_Helper::title_lenth($title_text_limit); ?></a></h3><?php endif; ?> 
                                        
                                                    <?php if ( $settings['post_masonry_grid_meta_data_location'] == 'middle' ) : ?>
                                                    <ul class="tx-post-masonry-grid-meta">
                                                        <?php if ( in_array( 'author', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_category(', ') ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
                                                    </ul>
                                                    <?php endif; ?>
                                                    
                                        
                                                    <?php if ( ! empty( $settings['post_masonry_grid_excerpt'] ) ) : ?>
                                                    <div class="tx-post-masonry-grid-excerpt">
                                                        <?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?><p><?php echo TX_Helper::excerpt_limit($settings['post_masonry_grid_excerpt_count'] ); ?></p><?php endif; ?> 
                                                    </div>
                                                    <?php endif; ?> 
                                                    <div class="tx-clearfix"></div>
                                                    <?php if ( ! empty( $settings['post_masonry_grid_read_more'] ) ) : ?><a class="tx-post-masonry-read-more" href="<?php the_permalink(); ?>"><?php echo esc_attr($settings['post_masonry_grid_read_more_text'] ); ?></a><?php endif; ?>

                                                    
                                                    <div class="tx-clearfix"></div>
                                            
                                                    <?php if ( $settings['post_masonry_grid_meta_data_location'] == 'bottom' ) : ?>
                                                    <ul class="tx-post-masonry-grid-meta">
                                                        <?php if ( in_array( 'author', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php the_category(', ') ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['post_masonry_grid_meta_data'] ) ) : ?><li class="tx-post-masonry-grid-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
                                                    </ul>
                                                    <?php endif; ?>
                                                    <div class="tx-clearfix"></div>
                                            
                                                </div><!-- close .tx-post-masonry-grid-container -->
                                            
                                                <div class="tx-clearfix"></div>
                                        </div><!-- close .tx-post-masonry-grid-style -->
                                    <?php endif; ?><!-- close post_masonry_grid_layout layout -->

                            </div><!-- close .tx-isotope-animation -->
                        </div><!-- close .tx-post-masonry-grid-image-padding -->
                </div><!-- close .tx-post-masonry-grid-item progression-masonry-col -->
                <?php  endwhile; // end of the loop. ?>

            </div><!-- close #tx-post-masonry-grid-<?php echo esc_attr($this->get_id()); ?>  -->
        </div><!-- close .tx-post-masonry-grid-margin-->
    </div><!-- close .tx-post-masonry-grid-wrapper -->
    
    
    <?php if ( $settings['post_masonry_grid_pagination'] == 'default' ) : ?>
        <div class="tx-post-pagination-container">
            <?php
        
            $page_tot = ceil(($post_loop->found_posts - $offset) / $post_per_page);
        
            if ( $page_tot > 1 ) {
            $big        = 999999999;
          echo paginate_links( array(
                  'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
                  'format'    => '?paged=%#%',
                  'current'   => max( 1, $paged ),
                  'total'     => ceil(($post_loop->found_posts - $offset) / $post_per_page),
                  'prev_next' => true,
                    'prev_text'    => esc_attr($settings['post_masonry_grid_pagination_prev'] ),
                    'next_text'    => esc_attr($settings['post_masonry_grid_pagination_next'] ),
                  'end_size'  => 1,
                  'mid_size'  => 2,
                  'type'      => 'list'
              )
          );
            }
            ?>
        </div><!-- close .tx-post-pagination-container -->
    <?php endif; ?>
    
    <?php if ( $settings['post_masonry_grid_pagination'] == 'load-more' ) : ?>
        <div class="tx-post-pagination-container">
            <?php $page_tot = ceil(($post_loop->found_posts - $offset) / $post_per_page); if ( $page_tot > 1 ) : ?>
                <div class="tx-post-load-more">
                    <div id="tx-infinite-nav<?php echo esc_attr($this->get_id()); ?>" class="tx-post-infinite">
                        <div class="tx-post-nav-previous">
                           <?php next_posts_link( $settings['post_masonry_grid_pagination_load_more'] . '<span><i class="fa ' . $settings['post_masonry_grid_pagination_load_more_icon'] . '"></i></span>', $post_loop->max_num_pages ); ?>
                
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div><!-- close .tx-post-pagination-container -->
    <?php endif; ?>
    
    <?php if ( $settings['post_masonry_grid_pagination'] == 'infinite' ) : ?>
        <div class="tx-post-pagination-container">
            <?php $page_tot = ceil(($post_loop->found_posts - $offset) / $post_per_page); if ( $page_tot > 1 ) : ?><div id="tx-infinite-nav<?php echo esc_attr($this->get_id()); ?>" class="tx-post-infinite"><div class="tx-post-nav-previous"><?php next_posts_link( 'Next', $post_loop->max_num_pages ); ?></div></div><?php endif ?>
        </div><!-- close .tx-post-pagination-container -->
    <?php endif; ?>
    
    
    <script>
    jQuery(document).ready(function($) { 'use strict';  
        /* Default Isotope Load Code */
        var $container<?php echo esc_attr($this->get_id()); ?> = $('#tx-post-masonry-grid-<?php echo esc_attr($this->get_id()); ?>').isotope();
        $container<?php echo esc_attr($this->get_id()); ?>.imagesLoaded( function() {
            
            $(".tx-post-masonry-grid-item").addClass("tx-isotope-animation-start");
            
            $container<?php echo esc_attr($this->get_id()); ?>.isotope({
                itemSelector: '#tx-post-masonry-grid-<?php echo esc_attr($this->get_id()); ?> .tx-post-masonry-grid-item',             
                percentPosition: true,
                layoutMode: <?php if ( ! empty( $settings['post_masonry_grid_masonry'] ) ) : ?>"masonry"<?php else: ?>"fitRows"<?php endif; ?> 
            });
            
        });
        /* END Default Isotope Code */
        <?php if ( $settings['post_masonry_grid_pagination'] == 'infinite' || $settings['post_masonry_grid_pagination'] == 'load-more' ) : ?>
        /* Begin Infinite Scroll */
        $container<?php echo esc_attr($this->get_id()); ?>.infinitescroll({
        errorCallback: function(){  $("#tx-infinite-nav<?php echo esc_attr($this->get_id()); ?>").delay(500).fadeOut(500, function(){ $(this).remove(); }); },
          navSelector  : "#tx-infinite-nav<?php echo esc_attr($this->get_id()); ?>",  
          nextSelector : "#tx-infinite-nav<?php echo esc_attr($this->get_id()); ?> .tx-post-nav-previous a", 
          itemSelector : "#tx-post-masonry-grid-<?php echo esc_attr($this->get_id()); ?> .tx-post-masonry-grid-item", 
            loading: {
                img: "<?php $image = $settings['post_masonry_grid_pagination_load_more_gif_image']; $imageurl = wp_get_attachment_image_src($image['id'], 'full'); ?><?php if ( $imageurl )  : ?><?php echo esc_url($imageurl[0]);?><?php else: ?><?php echo plugins_url( '/img/loading.gif', __FILE__ ) ; ?><?php endif; ?>",
                 msgText: "",
                finishedMsg: "<div id='tx-no-more-posts'><?php echo esc_attr($settings['post_masonry_grid_pagination_no_post']); ?></div>",
                speed: 0, }
          },
          // trigger Isotope as a callback
          function( newElements ) {
              
              //Add JS as needed here
              
            var $newElems = $( newElements );
    
                $newElems.imagesLoaded(function(){
                    
                $container<?php echo esc_attr($this->get_id()); ?>.isotope( "appended", $newElems );
                $(".tx-post-masonry-grid-item").addClass("tx-isotope-animation-start");
                
            });

          }
        );
        /* END Infinite Scroll */
        
        <?php endif; ?>
        
        <?php if ( $settings['post_masonry_grid_pagination'] == 'load-more' ) : ?>
        /* PAUSE FOR LOAD MORE */
        $(window).unbind(".infscr");
        // Resume Infinite Scroll
        $("#tx-infinite-nav<?php echo esc_attr($this->get_id()); ?> .tx-post-nav-previous a").click(function(){
            $container<?php echo esc_attr($this->get_id()); ?>.infinitescroll("retrieve");
            return false;
        });
        /* End Infinite Scroll */
        <?php endif; ?>
        
    });
    </script>
    
    <div class="tx-clearfix"></div>
    
    <?php wp_reset_postdata();
    }

    protected function content_template() {}

} // class 
