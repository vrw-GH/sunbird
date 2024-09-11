<?php
namespace AvasElements\Modules\TeamCarousel\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TeamCarousel extends Widget_Base {

    public function get_name() {
        return 'avas-team-carousel';
    }

    public function get_title() {
        return esc_html__( 'Avas Team Carousel', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-posts-carousel';
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
            'team_categories',
            [
                'label'       => esc_html__( 'Categories', 'avas-core' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => TX_Helper::get_post_type_categories('team-category'),
                'default'     => [],
                'label_block' => true,
                'multiple'    => true,
            ]
        );
        $this->add_control(
            'display',
            [
                'label'     => esc_html__( 'Style', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid_t',
                'options'   => [
                        'grid_t'    => esc_html__('Grid','avas-core'),
                        'card_t'    => esc_html__('Card','avas-core'),
                    ],
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
            'title',
            [
                'label' => esc_html__( 'Name', 'avas-core' ),
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
            'title_lenth',
            [
                'label' => esc_html__( 'Name Lenth', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '30',
                'condition' => [
                    'title' => 'show',
                ]

            ]
        );
        $this->add_control(
            'category_display',
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
            'bio',
            [
                'label' => esc_html__( 'Bio', 'avas-core' ),
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
                'label' => esc_html__( 'Bio Words Limit', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '15',
                'condition' => [
                    'bio' => 'show',
                ],
            ]
        );
        $this->add_control(
            'social_media',
            [
                'label' => esc_html__( 'Social Profile', 'avas-core' ),
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
                'default' => 800,
                'step'  => 50,
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
                'default' => 2500,
                'step'  => 500,
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
                    '{{WRAPPER}} .team figcaption' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'display' => 'grid_t'
                ],
            ]
        );
        $this->add_control(
            'card_bg_color',
            [
                'label'     => esc_html__( 'Card Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-team-card' => 'background-color: {{VALUE}};',
                ],

                'condition' => [
                    'display' => 'card_t'
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team figcaption h4 a, {{WRAPPER}} .tx-team-card h4 a' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .team figcaption h4 a:hover, {{WRAPPER}} .tx-team-card:hover h4 a' => 'color: {{VALUE}};',
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
                   'selector'  => '{{WRAPPER}} .team figcaption h4, {{WRAPPER}} .tx-team-card h4',
                   'condition' => [
                      'title' => 'show',
                    ],
              ]
        );
        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Bio Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team .team-bio' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_typography',
                   'selector'  => '{{WRAPPER}} .team .team-bio',
              ]
        );
        $this->add_control(
            'cate_color',
            [
                'label'     => esc_html__( 'Category Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team .team-cat a' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .team .team-cat a:hover' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'cat_typography',
                   'selector'  => '{{WRAPPER}} .team .team-cat a',
              ]
        );
        $this->add_control(
            'social_icon_color',
            [
                'label'     => esc_html__( 'Social Icon Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social i, {{WRAPPER}} .team-social i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social li, {{WRAPPER}} .team.card_t .team-social li' => 'border-color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'social_media' => 'show',
                ],
            ]
        );
        $this->add_control(
            'social_icon_hov_color',
            [
                'label'     => esc_html__( 'Social Icon Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social li:hover, {{WRAPPER}} .team-social li:hover i, {{WRAPPER}} .team.card_t .team-social li:hover, {{WRAPPER}} .team.card_t .team-social li:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social li:hover, {{WRAPPER}} .team.card_t .team-social li:hover' => 'border-color: {{VALUE}};'

                ],
                'condition' => [
                    'social_media' => 'show',
                ],
            ]
        );
        $this->add_responsive_control(
            'social_media_icon_size',
            [
                'label' => esc_html__( 'Social Media Icon Size', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-social i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'social_media' => 'show',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'social_media_border',
                'selector'    =>    '{{WRAPPER}} .team-social li',
                'condition' => [
                      'social_media' => 'show',
                    ],
            ]
        );
        $this->add_responsive_control(
            'social_media_padding',
            [
                'label' => esc_html__( 'Social Media Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-social li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                      'social_media' => 'show',
                    ],
            ]
        );
        $this->add_responsive_control(
            'social_media_margin',
            [
                'label' => esc_html__( 'Social Media Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .team-social li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                      'social_media' => 'show',
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
      
        $settings = $this->get_settings_for_display();
        $team_categories = $settings['team_categories'];
        $social_media = $settings['social_media'];

            $this->add_render_attribute( 'tx-carousel', 'class', 'tx-carousel team owl-carousel owl-theme' );
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

       
        if( !empty($team_categories) ) {

            $query_args = array(
                'post_type' => 'team',
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'tax_query' => array(
                'relation' => 'AND',
                    array(
                        'taxonomy' => 'team-category',
                        'field'    => 'slug',
                        'terms'    => $team_categories,
                    ),
                )
            );

        } else {

            $query_args = array(
                'post_type' => 'team',
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
                <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
                            <div class="team <?php echo esc_attr($settings['display']); ?>">
                                <figure>
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_post_thumbnail('tx-t-thumb'); ?>      
                                    <?php if( 'grid_t' === $settings['display'] ) : ?>
                                    <figcaption>
                                        <?php if($settings['title'] == 'show') : ?>
                                        <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo TX_Helper::title_lenth($settings['title_lenth']); ?></a></h4>
                                        <?php endif; ?>
                                        
                                        <?php
                                            global $post;
                                            $terms = get_the_terms( $post->ID, 'team-category' );
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

                                        <?php if(!empty($cat_name) && $settings['category_display'] == 'show') : ?>
                                        <p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
                                        <?php endif; ?>

                                        <?php if($settings['bio'] == 'show') : ?>
                                        <div class="team-bio"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                        <?php endif; ?>

                                        <?php 
                                        if($social_media =='show') : 
                                            do_action('tx_single_team_social_icons');
                                        endif; ?>
                                    </figcaption>
                                    <?php endif; ?>
                                    </a>
                                    <?php if( 'card_t' === $settings['display'] ) : ?>
                                        <div class="tx-team-card">
                                            <?php if($settings['title'] == 'show') : ?>
                                        <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo TX_Helper::title_lenth($settings['title_lenth']); ?></a></h4>
                                        <?php endif; ?>
                                        
                                        <?php
                                            global $post;
                                            $terms = get_the_terms( $post->ID, 'team-category' );
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

                                        <?php if(!empty($cat_name) && $settings['category_display'] == 'show') : ?>
                                        <p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
                                        <?php endif; ?>

                                        <?php if($settings['bio'] == 'show') : ?>
                                        <div class="team-bio"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                        <?php endif; ?>

                                        <?php 
                                        if($social_media =='show') : 
                                            do_action('tx_single_team_social_icons');
                                        endif; ?>
                                        </div>
                                    <?php endif; ?> 
                                </figure>
                            </div>

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