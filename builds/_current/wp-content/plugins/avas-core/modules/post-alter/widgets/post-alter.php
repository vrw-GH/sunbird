<?php
namespace AvasElements\Modules\PostAlter\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostAlter extends Widget_Base {

    public function get_name() {
        return 'avas-post-alter';
    }

    public function get_title() {
        return esc_html__( 'Avas Post Alter', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }
	protected function register_controls() {
        $this->start_controls_section(
            'ft_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__( 'Post Type', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => TX_Helper::get_all_post_types(),
                'default' => 'post',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'tx-alter-thumb',
            ]
        );
        $this->add_control(
            'tax_query',
            [
                'label' => esc_html__( 'Categories', 'avas-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => TX_Helper::get_all_categories(),
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Posts', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
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
            'post_sortby',
            [
                'label'     => esc_html__( 'Post sort by', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'latestpost',
                'options'   => [
                        'latestpost'      => esc_html__( 'Latest posts', 'avas-core' ),
                        'popularposts'    => esc_html__( 'Popular posts', 'avas-core' ),
                        'mostdiscussed'    => esc_html__( 'Most discussed', 'avas-core' ),
                    ],
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
                    'modified' => esc_html__('Modified date', 'avas-core'),
                    'parent' => esc_html__('By parent', 'avas-core'),
                    'rand' => esc_html__('Random order', 'avas-core'),
                    'comment_count' => esc_html__('Comment count', 'avas-core'),
                    'menu_order' => esc_html__('Menu order', 'avas-core'),
                    'post__in' => esc_html__('By include order', 'avas-core'),
                ),
                'default' => 'date',
                'condition' => [
                    'post_sortby' => ['latestpost'],
                ]
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
                'default' => 'show'
            ]
        );
        $this->add_control(
            'title_lenth',
            [
                'label' => esc_html__( 'Title Lenth', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '50',
                'condition' => [
                    'title' => 'show',
                ]

            ]
        );
        $this->add_control(
            'date',
            [
                'label' => esc_html__( 'Date', 'avas-core' ),
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
                'default' => 'show'
            ]
        );
        
        $this->add_control(
            'post_category',
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
            ]
        );
        $this->add_control(
            'comments',
            [
                'label' => esc_html__( 'Comments', 'avas-core' ),
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
            'views',
            [
                'label' => esc_html__( 'Views', 'avas-core' ),
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
            'desc',
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
                'default' => 'show'
            ]
        );
        $this->add_control(
            'excerpt_words',
            [
                'label' => esc_html__( 'Excerpt Words', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '24',
                'condition' => [
                    'desc' => 'show',
                ],
            ]
        );
        $this->add_control(
            'read_more',
            [
                'label' => esc_html__( 'Read More', 'avas-core' ),
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
            'read_more_txt',
            [
                'label' => esc_html__( 'Read More text', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
                'condition' => [
                    'read_more' => 'show',
                ],
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
                'default' => 'show',
               
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'pa_style',
            [
                'label' => esc_html__('Styles', 'avas-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'pa_image_radius',
            [
                'label'      => esc_html__( 'Image Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-post-alter-image-content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
         $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pa_image_border',
                'selector'    =>    '{{WRAPPER}} .tx-post-alter-image-content img'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'pa_image_shadow',
                'selector' => '{{WRAPPER}} .tx-post-alter-image-content img'
            ]
        );
       
        $this->add_responsive_control(
            'pa_spacing',
            [
                'label' => esc_html__('Space between post', 'avas-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-alter-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'pa_transform',
            [
                'label' => esc_html__('Content Position(X)', 'avas-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-alter-wrap:nth-child(odd) .tx-post-alter-text-content, {{WRAPPER}} .tx-post-alter-wrap:nth-child(even) .tx-post-alter-image-content' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],

            ]
        );
        $this->add_control(
            'pa_content_bg_color',
            [
                'label' => esc_html__('Content Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-alter-text-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'pa_content_shadow',
                'selector' => '{{WRAPPER}} .tx-post-alter-text-content'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pa_content_border',
                'selector'    =>    '{{WRAPPER}} .tx-post-alter-text-content'
            ]
        );
        $this->add_responsive_control(
            'pa_content_radius',
            [
                'label'      => esc_html__( 'Content Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-post-alter-text-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'pa_content_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-alter-text-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pa_title_color',
            [
                'label' => esc_html__('Title Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-alter-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show'
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'pa_title_hov_color',
            [
                'label' => esc_html__('Title Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-alter-title:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pa_title_typography',
                'selector' => '{{WRAPPER}} .tx-post-alter-title',
                'condition' => [
                    'title' => 'show'
                ]
            ]
        );
        $this->add_control(
            'pa_meta_color',
            [
                'label' => esc_html__('Meta Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comments-link a, {{WRAPPER}} .nickname, {{WRAPPER}} .post-category a, {{WRAPPER}} .post-time, {{WRAPPER}} .post-views' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'pa_meta_hov_color',
            [
                'label' => esc_html__('Meta Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .comments-link a:hover, {{WRAPPER}} .post-category a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pa_meta_icon_color',
            [
                'label' => esc_html__('Meta Icon Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-meta i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pa_meta_typography',
                'selector' => '{{WRAPPER}} .comments-link a, {{WRAPPER}} .nickname, {{WRAPPER}} .post-category a, {{WRAPPER}} .post-time, {{WRAPPER}} .post-views, {{WRAPPER}} .entry-meta i',
            ]
        );
        $this->add_control(
            'pa_desc_color',
            [
                'label' => esc_html__('Description Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-alter-desc' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'desc' => 'show',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pa_desc_typography',
                'selector' => '{{WRAPPER}} .tx-post-alter-desc',
                'condition' => [
                    'desc' => 'show',
                ]
            ]
        );
        $this->add_control(
            'pa_read_more_txt_color',
            [
                'label' => esc_html__('Read More Text Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-read-more' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_control(
            'pa_read_more_txt_hov_color',
            [
                'label' => esc_html__('Read More Text Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-read-more:hover, {{WRAPPER}} .tx-post-read-more:focus' => 'color: {{VALUE}};',
                ],
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_control(
            'pa_read_more_bg_color',
            [
                'label' => esc_html__('Read More Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-read-more' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_control(
            'pa_read_more_bg_hov_color',
            [
                'label' => esc_html__('Read More Background Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-read-more:hover, {{WRAPPER}} .tx-post-read-more:focus' => 'background-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_control(
            'pa_read_more_br_color',
            [
                'label' => esc_html__('Read More Border Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-read-more' => 'border-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_control(
            'pa_read_more_br_hov_color',
            [
                'label' => esc_html__('Read More Border Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-read-more:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pa_read_more_typography',
                'selector' => '{{WRAPPER}} .tx-post-read-more',
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pa_read_more_border',
                'selector'    =>    '{{WRAPPER}} .tx-post-read-more',
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_responsive_control(
            'pa_read_more_border_radius',
            [
                'label'      => esc_html__( 'Read More Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-post-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_responsive_control(
            'pa_read_more_padding',
            [
                'label'             => esc_html__( 'Read More Padding', 'avas-core' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .tx-post-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'read_more' => 'show' 
                ]
            ]
        );
        $this->add_responsive_control(
            'pa_read_more_margin',
            [
                'label'             => esc_html__( 'Read More Margin', 'avas-core' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .tx-post-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [ 
                    'read_more' => 'show' 
                ]
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

    protected function render() {
        $settings = $this->get_settings_for_display();
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $showposts = '';
        $title = $settings['title'];
        $title_lenth = $settings['title_lenth'];
        $desc = $settings['desc'];
        $post_category = $settings['post_category'];
        $pagination = $settings['pagination'];

        // title lenth limit
        if( $title_lenth ){
            $title_lenth = $title_lenth;
        } else {
            $title_lenth = 50;
        }

        if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;

        $query_args = TX_Helper::setup_query_args($settings, $showposts);
        $post_query = new \WP_Query( $query_args );

        if ($post_query->have_posts()) : 
            while ($post_query->have_posts()) : $post_query->the_post();
        ?>
            <div class="tx-post-alter-wrap">

                <div class="tx-post-alter-image-content">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-thumb">
                            <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size'])?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                        </div><!-- featured-thumb -->
                    <?php endif; ?>
                </div><!-- tx-post-alter-image-content -->

                <?php if( $title == 'show' || $settings['date'] == 'show' || $post_category == 'show' || $settings['comments'] == 'show' || $settings['views'] == 'show' || $desc == 'show' || 'show' === $settings['read_more'] ) : ?>
                <div class="tx-post-alter-text-content">
                    <?php if($title == 'show') : ?>
                        <h3 class="tx-post-alter-title">
                           <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                            <?php echo TX_Helper::title_lenth($title_lenth); ?>
                            </a>
                        </h3>
                    <?php endif; ?>

                    <?php if ('post' == get_post_type()) : ?>
                        <div class="entry-meta">
                            <?php if($settings['date'] == 'show') : tx_date(); endif; ?>
                            <?php if($post_category == 'show') : tx_category(); endif ?>
                            <?php if($settings['comments'] == 'show') : tx_comments(); endif; ?>
                            <?php if($settings['views'] == 'show') : echo tx_getPostViews(get_the_ID()); endif; ?>
                        </div>
                    <?php endif; ?><!-- .entry-meta -->
                    <?php if($desc == 'show') : ?>
                        <div class="tx-post-alter-desc"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                    <?php endif; ?>
                    <?php if( 'show' === $settings['read_more'] ): ?>
                        <a class="tx-post-read-more" href="<?php the_permalink(); ?>"><?php echo esc_html__( $settings['read_more_txt'], 'avas-core' ) ?></a>
                    <?php endif; ?>
                </div><!-- tx-post-alter-text-content -->
                <?php endif; ?>

            </div><!-- tx-post-alter-wrap -->
        <?php endwhile;
                wp_reset_postdata();
            else:  
                get_template_part('template-parts/content/content', 'none');
            endif; ?>
        
            <div class="tx-clear"></div>

            <!-- pagination -->
            <?php if($pagination == 'show') : tx_pagination_number($post_query->max_num_pages,"",$paged); endif; ?>

<?php   } // render()
} // class 
