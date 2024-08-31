<?php
namespace AvasElements\Modules\TeamAlter\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TeamAlter extends Widget_Base {

    public function get_name() {
        return 'avas-Team-alter';
    }

    public function get_title() {
        return esc_html__( 'Avas Team Alter', 'avas-core' );
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
                'default' => 'team',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'tx-team-alter-thumb',
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
            'taxonomy_filter',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Taxonomy', 'avas-core'),
                'options' => TX_Helper::get_all_taxonomies(),
                'default' => 'team-category',
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
            'position',
            [
                'label' => esc_html__( 'Position', 'avas-core' ),
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
            'social',
            [
                'label' => esc_html__( 'Social Icons', 'avas-core' ),
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
            'hire_me',
            [
                'label' => esc_html__( 'Hire Me', 'avas-core' ),
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
        $this->add_control(
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
                    '{{WRAPPER}} .tx-team-alter-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
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
                    '{{WRAPPER}} .tx-team-alter-wrap:nth-child(odd) .tx-team-alter-text-content, {{WRAPPER}} .tx-team-alter-wrap:nth-child(even) .tx-team-alter-image-content' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],

            ]
        );
        $this->add_control(
            'pa_content_bg_color',
            [
                'label' => esc_html__('Content Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'pa_content_shadow',
                'selector' => '{{WRAPPER}} .tx-team-alter-text-content'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pa_content_border',
                'selector'    =>    '{{WRAPPER}} .tx-team-alter-text-content'
            ]
        );
        $this->add_responsive_control(
            'pa_content_radius',
            [
                'label'      => esc_html__( 'Content Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-team-alter-text-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .tx-team-alter-text-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ta_img_bg_color',
            [
                'label' => esc_html__('Image Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-wrap .tx-team-alter-image-content img' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ta_img_shadow',
                'selector' => '{{WRAPPER}} .tx-team-alter-wrap .tx-team-alter-image-content img'
            ]
        );
        $this->add_responsive_control(
            'ta_img_radius',
            [
                'label'      => esc_html__( 'Image Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-team-alter-wrap .tx-team-alter-image-content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ta_img_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-wrap .tx-team-alter-image-content img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pa_title_color',
            [
                'label' => esc_html__('Title Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .tx-team-alter-title:hover' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .tx-team-alter-title',
                'condition' => [
                    'title' => 'show'
                ]
            ]
        );
        $this->add_control(
            'position_color',
            [
                'label' => esc_html__('Position Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-cat a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'position' => 'show'
                ],
            ]
        );
        $this->add_control(
            'position_hov_color',
            [
                'label' => esc_html__('Position Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-cat a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'position' => 'show'
                ],
            ]
        );
        $this->add_control(
            'position_border_color',
            [
                'label' => esc_html__('Position Border Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-cat' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'position' => 'show'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'selector' => '{{WRAPPER}} .tx-team-alter-text-content .team-cat a',
                'condition' => [
                    'position' => 'show'
                ],
            ]
        );
        $this->add_control(
            'ta_desc_color',
            [
                'label' => esc_html__('Description Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-desc' => 'color: {{VALUE}};',
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
                'name' => 'ta_desc_typography',
                'selector' => '{{WRAPPER}} .tx-team-alter-desc',
                'condition' => [
                    'desc' => 'show',
                ]
            ]
        );
        $this->add_control(
            'social_color',
            [
                'label' => esc_html__('Social Icon Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_control(
            'social_hov_color',
            [
                'label' => esc_html__('Social Icon Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_control(
            'social_bg_color',
            [
                'label' => esc_html__('Social Icon Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_control(
            'social_bg_hov_color',
            [
                'label' => esc_html__('Social Icon Background Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_control(
            'social_icon_border_color',
            [
                'label' => esc_html__('Social Icon Border Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_control(
            'social_bord_hov_color',
            [
                'label' => esc_html__('Social Icon Border Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_responsive_control(
            'social_icon_size',
            [
                'label' => esc_html__( 'Social Icon Size', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 14,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'social' => 'show',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'social_border',
                'selector'    =>    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i',
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_responsive_control(
            'social_border_radius',
            [
                'label'      => esc_html__( 'Social Icon Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_responsive_control(
            'social_padding',
            [
                'label'             => esc_html__( 'Social Icon Padding', 'avas-core' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_responsive_control(
            'social_margin',
            [
                'label'             => esc_html__( 'Social Icon Margin', 'avas-core' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .tx-team-alter-text-content .team-social li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'social' => 'show'
                ],
            ]
        );
        $this->add_control(
            'hire_me_color',
            [
                'label' => esc_html__('Hire Me Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_control(
            'hire_me_hov_color',
            [
                'label' => esc_html__('Hire Me Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_control(
            'hire_mel_bg_color',
            [
                'label' => esc_html__('Hire Me Background Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_control(
            'hire_bg_hov_color',
            [
                'label' => esc_html__('Hire Me Background Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_control(
            'hire_me_brd_color',
            [
                'label' => esc_html__('Hire Me Border Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_control(
            'hire_me_border_hov_color',
            [
                'label' => esc_html__('Hire Me Border Hover Color', 'avas-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hire_me_typography',
                'selector' => '{{WRAPPER}} .tx-team-alter-image-content .hire_me',
                'condition' => [
                    'hire_me' => 'show',
                ]
            ]
        );
        $this->add_responsive_control(
            'hire_me_position',
            [
                'label' => esc_html__('Hire Me Position', 'avas-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'hire_me_border',
                'selector'    =>    '{{WRAPPER}} .tx-team-alter-image-content .hire_me',
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_responsive_control(
            'hire_me_border_radius',
            [
                'label'      => esc_html__( 'Hire Me Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_responsive_control(
            'hire_me_padding',
            [
                'label'             => esc_html__( 'Hire Me Padding', 'avas-core' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],
            ]
        );
        $this->add_responsive_control(
            'hire_me_margin',
            [
                'label'             => esc_html__( 'Hire Me Margin', 'avas-core' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .tx-team-alter-image-content .hire_me' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'hire_me' => 'show'
                ],
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
        $position = $settings['position'];
        $pagination = $settings['pagination'];
        $taxonomy_filter = $settings['taxonomy_filter'];
        $social = $settings['social'];
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
                        
                        global $post;
                        $terms = get_the_terms( $post->ID, $taxonomy_filter );
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
            <div class="tx-team-alter-wrap">

                <div class="tx-team-alter-image-content">
                    <?php 
                        if( 'show' === $settings['hire_me'] ) :
                            $hire_me = get_post_meta( $post->ID, 'hire_me', true );
                            $hour_rate = get_post_meta( $post->ID, 'hour_rate', true );
                            if (!empty($hire_me) || ($hour_rate) ) :
                            $hire_me_hour = $hour_rate;
                    ?>
                            <a href="<?php echo esc_url($hire_me); ?>" class="hire_me"><?php echo esc_attr($hire_me_hour); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-thumb">
                            <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size'])?>" alt="<?php echo esc_attr( get_the_title() ); ?>">

                        </div><!-- featured-thumb -->
                    <?php endif; ?>

                </div><!-- tx-team-alter-image-content -->

                <?php if( $title == 'show' || $position == 'show' || $desc == 'show' ) : ?>
                <div class="tx-team-alter-text-content">
                    <?php if($title == 'show') : ?>
                        <h3 class="tx-team-alter-title">
                           <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                            <?php echo TX_Helper::title_lenth($title_lenth); ?>
                            </a>
                        </h3>

                    <?php endif; ?>
                    <?php if($position == 'show') : ?>
                    <p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
                    <?php endif; ?>

                    <?php if($desc == 'show') : ?>
                        <div class="tx-team-alter-desc"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                    <?php endif; ?>

                  <?php 
                                        if($social_media =='show') : 
                                            do_action('tx_single_team_social_icons');
                                        endif; ?>
                </div><!-- tx-team-alter-text-content -->
                <?php endif; ?>

            </div><!-- tx-team-alter-wrap -->
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
