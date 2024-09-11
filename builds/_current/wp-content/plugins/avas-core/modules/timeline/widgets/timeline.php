<?php
namespace AvasElements\Modules\Timeline\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Timeline extends Widget_Base {

    public function get_name() {
        return 'avas-timeline';
    }

    public function get_title() {
        return esc_html__( 'Avas Timeline', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }
    public function get_script_depends() {
        return [ 'avas-timeline' ];
    }
	protected function register_controls() {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
          'content_source',
            [
                'label'         => esc_html__( 'Content Source', 'avas-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'dynamic',
                'label_block'   => false,
                'options'       => [
                    'custom'    => esc_html__( 'Custom', 'avas-core' ),
                    'dynamic'   => esc_html__( 'Dynamic', 'avas-core' ),
                ],
            ]
        );
        
        $this->add_control(
            'custom_content',
            [
                'type' => Controls_Manager::REPEATER,
                'condition' => [
                    'content_source' => 'custom'
                ],
                'default' => [
                    [
                        'custom_title' => esc_html__( 'Lorem ipsum dolor sit amet', 'avas-core' ),
                        'custom_excerpt' => esc_html__( 'Consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'avas-core' ),
                        'custom_post_date' => 'January 01, 2019',
                        'custom_btn' => 'Read More',
                        'custom_btn_link' => '#',
                        
                    ],
                    [
                        'custom_title' => esc_html__( 'Lorem ipsum dolor sit amet', 'avas-core' ),
                        'custom_excerpt' => esc_html__( 'Consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'avas-core' ),
                        'custom_post_date' => 'February 14, 2019',
                        'custom_btn' => 'Read More',
                        'custom_btn_link' => '#',
                        
                    ],
                    [
                        'custom_title' => esc_html__( 'Lorem ipsum dolor sit amet', 'avas-core' ),
                        'custom_excerpt' => esc_html__( 'Consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'avas-core' ),
                        'custom_post_date' => 'March 26, 2019',
                        'custom_btn' => 'Read More',
                        'custom_btn_link' => '#',
                        
                    ],
                    [
                        'custom_title' => esc_html__( 'Lorem ipsum dolor sit amet', 'avas-core' ),
                        'custom_excerpt' => esc_html__( 'Consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'avas-core' ),
                        'custom_post_date' => 'April 14, 2019',
                        'custom_btn' => 'Read More',
                        'custom_btn_link' => '#',
                        
                    ]
                ],
                'fields' => [
                    
                    [
                        'name' => 'custom_img',
                        'label' => esc_html__( 'Image', 'avas-core' ),
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
                    ],
                    [
                        'name' => 'custom_img_url',
                        'label' => esc_html__('Image', 'avas-core'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                        'condition' => [
                            'custom_img' => 'show'
                        ]
                    ],
                    [
                        'name' => 'custom_title',
                        'label' => esc_html__( 'Title', 'avas-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__( 'Your title goes here', 'ex' )
                    ],
                    [
                        'name' => 'custom_excerpt',
                        'label' => esc_html__( 'Content', 'avas-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'ex' ),
                    ],
                    [
                        'name' => 'custom_post_date',
                        'label' => esc_html__( 'Post Date', 'avas-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'January 01, 2019', 'avas-core' ),
                    ],
                    [
                        'name' => 'custom_image_or_icon',
                        'label' => esc_html__( 'Circle Image / Icon', 'avas-core' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'img' => [
                                'title' => esc_html__( 'Image', 'avas-core' ),
                                'icon' => 'fa fa-picture-o',
                            ],
                            'icon' => [
                                'title' => esc_html__( 'Icon', 'avas-core' ),
                                'icon' => 'fa fa-info',
                            ],
                            
                        ],
                        'default' => 'icon',
                    ],
                    [
                        'name' => 'custom_icon_image',
                        'label' => esc_html__( 'Circle Image', 'avas-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'condition' => [
                            'custom_image_or_icon' => 'img',
                        ]
                    ],
                    [
                        'name' => 'custom_icon_image_size',
                        'label' => esc_html__( 'Icon Image Size', 'avas-core' ),
                        'type' => Controls_Manager::NUMBER,
                        'default' => 24,
                        'condition' => [
                            'custom_image_or_icon' => 'img',
                        ],
                    ],
                    [
                        'name' => 'custom_circle_icon',
                        'label' => esc_html__( 'Circle Icon', 'avas-core' ),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',
                        'default' => [
                            'value' => 'fas fa-snowflake',
                            'library' => 'fa-solid',
                        ],
                        'condition' => [
                            'custom_image_or_icon' => 'icon',
                        ]
                    ],
                    [
                        'name' => 'custom_btn',
                        'label' => esc_html__( 'Button Text', 'avas-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__( 'Read More', 'avas-core' ),
                    ],
                    [
                        'name'      => 'custom_btn_link',
                        'label'     => esc_html__( 'Button Link', 'avas-core' ),
                        'type'      => Controls_Manager::URL,
                        'dynamic'   => [
                            'active' => true,
                        ],
                        'placeholder' => esc_html__( 'https://your-link.com', 'avas-core' ),
                        'default'     => [
                            'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{custom_title}}',
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Post Types', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post',
                'options' => TX_Helper::get_all_post_types(),
                'condition' => [
                    'content_source' => 'dynamic'
                ]
                
            ]
        );
        $this->add_control(
            'taxonomy_filter',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Taxonomy', 'avas-core'),
                'options' => TX_Helper::get_all_taxonomies(),
                'default' => 'category',
                'condition' => [
                    'content_source' => 'dynamic'
                ]
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
                'condition' => [
                    'content_source' => 'dynamic'
                ]
                
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
                'condition' => [
                    'content_source' => 'dynamic'
                ]
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
                    'condition' => [
                    'content_source' => 'dynamic'
                ]
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
                    'content_source' => 'dynamic',
                    'post_sortby' => ['latestpost'],
                ]
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Posts', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
                'condition' => [
                    'content_source' => 'dynamic'
                ]
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__( 'Offset', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'condition' => [
                    'content_source' => 'dynamic'
                ]
               
            ]
        );
        $this->add_control(
            'dynamic_circle_icon_choose',
            [
                'label' => esc_html__( 'Circle Image / Icon', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'img' => [
                        'title' => esc_html__( 'Image', 'avas-core' ),
                        'icon' => 'fa fa-picture-o',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'avas-core' ),
                        'icon' => 'fa fa-info',
                    ],
                            
                ],
                'default' => 'icon',
            ]
        );
        $this->add_control(
            'dy_circle_image',
            [
                'label' => esc_html__( 'Image', 'avas-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'dynamic_circle_icon_choose' => 'img',
                ]
            ]
        );
        $this->add_control(
            'dy_circle_image_size',
            [
                'label' => esc_html__( 'Image Size', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 24,
                'condition' => [
                    'dynamic_circle_icon_choose' => 'img',
                ],
            ]
        );
        $this->add_control(
            'dy_circle_icon',
            [
                'label' => esc_html__( 'Icon', 'avas-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-snowflake',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'dynamic_circle_icon_choose' => 'icon',
                ]
            ]
        );
        $this->add_control(
            'dy_image',
            [
                'label' => esc_html__( 'Image', 'avas-core' ),
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
                'separator' => 'before',
                'condition' => [
                    'content_source' => 'dynamic'
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
                        'title' => esc_html__( 'Show', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'Hide', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show'
            ]
        );
        $this->add_control(
            'excerpt',
            [
                'label' => esc_html__( 'Excerpt', 'avas-core' ),
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
            ]
        );
        $this->add_control(
            'date',
            [
                'label' => esc_html__( 'Date', 'avas-core' ),
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
                'default' => 'show'
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
                'name'              => 'content_bg',
                'label'             => esc_html__( 'Content Background', 'ex' ),
                'types'             => [ 'classic', 'gradient' ],
                'selector'          => '{{WRAPPER}} .tx-timeline-content',
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Content Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-timeline-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_border',
                    'label' => esc_html__( 'Content Border', 'avas-core' ),
                    'selector' => '{{WRAPPER}} .tx-timeline-content',
                ]
            );

        $this->add_control(
            'content_border_radius',
                [
                    'label' => esc_html__( 'Content Border Radius', 'avas-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-timeline-content' => 'border-radius: {{SIZE}}px;',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'content_shadow',
                    'selector' => '{{WRAPPER}} .tx-timeline-content',
                ]
        );
        $this->add_control(
            'content_arrow_color',
            [
                'label'     => esc_html__( 'Content Arrow Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-container:nth-child(even) .tx-timeline-content::before' => 'border-right-color: {{VALUE}};',
                    '{{WRAPPER}} .tx-timeline-container:nth-child(odd) .tx-timeline-content::before' => 'border-left-color: {{VALUE}};',
                    
                ],
            ]
        );
        
        $this->add_control(
            'line_color',
            [
                'label'     => esc_html__( 'Line Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-line' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
                
            ]
        );
        $this->add_control(
            'overline_color',
            [
                'label'     => esc_html__( 'Over Line Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-line-over.tx-highlighted, {{WRAPPER}} .tx-timeline-line .tx-timeline-line-over' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'line_icon_color',
            [
                'label'     => esc_html__( 'Line Icon Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-icon i' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'line_icon_bg_color',
            [
                'label'     => esc_html__( 'Line Icon Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-icon' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-content h3' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} .tx-timeline-content h3',
                   'condition' => [
                      'title' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label'     => esc_html__( 'Excerpt Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-custom-excerpt, {{WRAPPER}} .tx-excerpt' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                      'excerpt' => 'show',
                    ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'excerpt_typography',
                   'selector'  => '{{WRAPPER}} .tx-timeline-custom-excerpt, {{WRAPPER}} .tx-excerpt',
                    'condition' => [
                      'excerpt' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'date_color',
            [
                'label'     => esc_html__( 'Date Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-date' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'date' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'date_typography',
                   'selector'  => '{{WRAPPER}} .tx-timeline-date, {{WRAPPER}} .tx-timeline-date .post-time',
                   'condition' => [
                      'date' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'btn_color',
            [
                'label'     => esc_html__( 'Button Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-btn a, {{WRAPPER}} .tx-read-more a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
                
            ]
        );
        $this->add_control(
            'btn_hov_color',
            [
                'label'     => esc_html__( 'Button Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-btn a:hover, {{WRAPPER}} .tx-read-more:hover a' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'btn_bg_color',
            [
                'label'     => esc_html__( 'Button Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-btn a, {{WRAPPER}} .tx-read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_hov_color',
            [
                'label'     => esc_html__( 'Button Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-timeline-btn a:hover, {{WRAPPER}} .tx-read-more:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'btn_typography',
                   'selector'  => '{{WRAPPER}} .tx-timeline-btn a, {{WRAPPER}} .tx-read-more a',
              ]
        );
        $this->add_responsive_control(
            'btn_spacing',
            [
                'label' => esc_html__( 'Button Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} tx-timeline-btn a, {{WRAPPER}} .tx-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
      $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
        $taxonomy_filter = $settings['taxonomy_filter'];
        $showposts = '';
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $query_args = TX_Helper::setup_query_args($settings, $showposts);
        $post_query = new \WP_Query( $query_args );
        ?>


        <?php if($settings['content_source'] == 'dynamic') : ?>
        <div id="tx-timeline-<?php echo esc_attr( $this->get_id() ); ?>" class="tx-timeline-wrap">
            <?php if ($post_query->have_posts()) : ?>
                <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
                    <div class="tx-timeline-container">
                        <div class="tx-timeline-line">
                            <div class="tx-timeline-line-over"></div>
                        </div>
                        <div class="tx-timeline-icon">
                            <?php if( $settings['dynamic_circle_icon_choose'] == 'img' ) : ?>
                            <img src="<?php echo esc_attr($settings['dy_circle_image']['url']); ?>" style="width: <?php echo $settings['dy_circle_image_size']; ?>px;" alt="Timeline Image" >
                            <?php elseif( $settings['dynamic_circle_icon_choose'] == 'icon' ) : 
                                Icons_Manager::render_icon( $settings['dy_circle_icon'], [ 'aria-hidden' => 'true' ] );
                            endif; ?>
                        </div>
                        <div class="tx-timeline-content">

                            <?php if (has_post_thumbnail() && $settings['dy_image'] == 'show') : ?>
                                <div class="zoom-thumb featured-thumb">
                                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('tx-timeline-thumb'); ?></a>
                                </div>
                            <?php endif; ?>

                            <?php if($settings['title'] == 'show') : ?>
                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                            <?php endif; ?>

                            <?php if($settings['excerpt'] == 'show') : ?>
                                <div class="tx-timeline-custom-excerpt"><?php echo tx_excerpt(25); ?></div>
                            <?php endif; ?>
                            
                            <?php if($settings['date'] == 'show') : ?>
                                <span class="tx-timeline-date"><?php echo tx_date(); ?></span>
                            <?php endif; ?>

                        </div><!-- tx-timeline-content -->
                    </div><!-- tx-timeline-container -->
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>
        </div><!-- tx-timeline-wrap -->
        

        <?php elseif($settings['content_source'] == 'custom') : ?>
        <div id="tx-timeline-<?php echo esc_attr( $this->get_id() ); ?>" class="tx-timeline-wrap">
                <?php foreach ($settings['custom_content'] as $custom_content) : ?>
                    <div class="tx-timeline-container">
                        <div class="tx-timeline-line">
                            <div class="tx-timeline-line-over"></div>
                        </div>
                       <div class="tx-timeline-icon">
                            <?php if( $settings['dynamic_circle_icon_choose'] == 'img' ) : ?>
                            <img src="<?php echo esc_attr($settings['dy_circle_image']['url']); ?>" style="width: <?php echo $settings['dy_circle_image_size']; ?>px;" alt="Timeline Image" >
                            <?php elseif( $settings['dynamic_circle_icon_choose'] == 'icon' ) : 
                                Icons_Manager::render_icon( $settings['dy_circle_icon'], [ 'aria-hidden' => 'true' ] );
                            endif; ?>
                        </div>
                        <div class="tx-timeline-content">

                            <?php if($custom_content['custom_img'] == 'show') : ?>
                                <img src="<?php echo esc_attr($custom_content['custom_img_url']['url']); ?>" alt="<?php echo esc_html( $custom_content['custom_title'] ); ?>">
                            <?php endif; ?>

                            <?php if($settings['title'] == 'show') : ?>
                                <h3><?php echo $custom_content['custom_title']; ?></h3>
                            <?php endif; ?>

                            <?php if($settings['excerpt'] == 'show') : ?>
                                <div class="tx-timeline-custom-excerpt"><?php echo $custom_content['custom_excerpt']; ?></div>
                            <?php endif; ?>

                            <?php if ( $custom_content['custom_btn_link']['is_external'] && !empty($custom_content['custom_btn'])) : ?>
                                <div class="tx-timeline-btn">
                                <a href="<?php echo $custom_content['custom_btn_link']['url']; ?>" target="_blank"><?php echo esc_html( $custom_content['custom_btn'] ); ?></a>
                                </div>
                            <?php elseif(!empty($custom_content['custom_btn'])) : ?>
                                <div class="tx-timeline-btn">
                                <a href="<?php echo $custom_content['custom_btn_link']['url']; ?>"><?php echo esc_html( $custom_content['custom_btn'] ); ?></a>
                                </div>
                            <?php endif; ?>

                            <?php if($settings['date'] == 'show') : ?>
                                <span class="tx-timeline-date"><?php echo $custom_content['custom_post_date']; ?></span>
                            <?php endif; ?>

                        </div><!-- tx-timeline-content -->
                    </div><!-- tx-timeline-container -->
                <?php endforeach; ?>
        </div><!-- tx-timeline-wrap -->
        <?php endif; ?>


<?php	} // function render()
} // class 
