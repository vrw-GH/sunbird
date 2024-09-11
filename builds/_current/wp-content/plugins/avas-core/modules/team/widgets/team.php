<?php
namespace AvasElements\Modules\Team\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Team extends Widget_Base {

    public function get_name() {
        return 'avas-team';
    }

    public function get_title() {
        return esc_html__( 'Avas Team', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Post Types', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__('If you can not see any Team item then please add Team via WordPress Dashboard > Team > Add New','avas-core'),
                'default' => 'team',
                'options' => TX_Helper::get_all_post_types(),
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'exclude' => [ 'custom' ],
                'default' => 'tx-t-thumb',
            ]
        );
        $this->add_responsive_control(
            'columns',
            // [
            //     'label' => esc_html__( 'Number of Columns', 'avas-core' ),
            //     'type' => Controls_Manager::SELECT,
            //     'default' => '3',
            //     'options' => [
            //         '12' => esc_html__( 'One Column', 'avas-core' ),
            //         '6' => esc_html__( 'Two Columns',   'avas-core' ),
            //         '4' => esc_html__( 'Three Columns', 'avas-core' ),
            //         '3' => esc_html__( 'Four Columns',  'avas-core' ),
            //         '2' => esc_html__( 'Six Columns',   'avas-core' ),                   
                    
            //     ],
            // ]
            [
                'label' => esc_html__( 'Columns', 'avas-core' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,     
                'desktop_default' => '25%',
                'tablet_default' => '50%',
                'mobile_default' => '100%',
                'options' => [
                    '100%' => esc_html__( '1 Column', 'avas-core' ),
                    '50%' => esc_html__( '2 Column', 'avas-core' ),
                    '33.333%' => esc_html__( '3 Columns', 'avas-core' ),
                    '25%' => esc_html__( '4 Columns', 'avas-core' ),
                    '20%' => esc_html__( '5 Columns', 'avas-core' ),
                    '16.666%' => esc_html__( '6 Columns', 'avas-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .team.grid_t, {{WRAPPER}} .team.card_t' => 'width: {{VALUE}};',
                ],
                'render_type' => 'template'
            ]
        );
        $this->add_control(
            'column_bottom_gap',
            [
                'label' => esc_html__( 'Column Bottom Gap', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .team.grid_t, {{WRAPPER}} .team.card_t' => 'padding: {{SIZE}}{{UNIT}};',
                ],
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
            'offset',
            [
              'label'         => esc_html__( 'Offset', 'avas-core' ),
              'type'          => Controls_Manager::NUMBER,
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
                'default' => '30',
                'condition' => [
                    'title' => 'show',
                ]

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
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__( 'Description', 'avas-core' ),
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
                'label' => esc_html__( 'Desc Words Limit', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '15',
                'condition' => [
                    'desc' => 'show',
                ],
            ]
        );
        $this->add_control(
            'serv_category',
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
                'condition' => [
                    'display' => 'grid',
                ]
            ]
        );
        $this->add_control(
            'social_media',
            [
                'label' => esc_html__( 'Social Media', 'avas-core' ),
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
                'label'     => esc_html__( 'Overlay Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team figcaption' => 'background-color: {{VALUE}}',
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
               
                'separator' => 'before',
                'condition' => [
                    'title' => 'show',
                ],

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
                'label'     => esc_html__( 'Description Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team .team-bio' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'desc' => 'show',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_typography',
                   'selector'  => '{{WRAPPER}} .team .team-bio',
                   'condition' => [
                    'desc' => 'show',
                ],
              ]
      );
      
      
      $this->add_control(
            'cat_color',
            [
                'label'     => esc_html__( 'Category Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team .team-cat a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'serv_category' => 'show',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_control(
            'cat_color_hover',
            [
                'label'     => esc_html__( 'Category Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team .team-cat a:hover' => 'color: {{VALUE}};',
                ],
                 'condition' => [
                    'serv_category' => 'show',
                ],
            ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'cat_typography',
                   'selector'  => '{{WRAPPER}} .team .team-cat a',
                    'condition' => [
                    'serv_category' => 'show',
                ],
              ]
      );
      $this->add_control(
            'social_media_color',
            [
                'label'     => esc_html__( 'Social Icon Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social a, {{WRAPPER}} .team-social i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social li, {{WRAPPER}} .team.card_t .team-social li' => 'border-color: {{VALUE}};'
                ],
               
                'separator' => 'before',
                'condition' => [
                    'social_media' => 'show',
                ],

            ]
      );
      $this->add_control(
            'social_media_hov_color',
            [
                'label'     => esc_html__( 'Social Media Hover Color', 'avas-core' ),
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
            'pagination_color',
            [
                'label'     => esc_html__( 'Pagination Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_control(
            'pagination_hover_color',
            [
                'label'     => esc_html__( 'Pagination Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_control(
            'pagination_current_color',
            [
                'label'     => esc_html__( 'Pagination Active Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li .current' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_control(
            'pagination_border_color',
            [
                'label'     => esc_html__( 'Pagination Border Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_control(
            'pagination_bg_color',
            [
                'label'     => esc_html__( 'Pagination Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover' => 'background-color: {{VALUE}};',
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
                   'selector'  => '{{WRAPPER}} .tx-pagination-widgets ul li',
                   'condition' => [
                      'pagination' => 'show',
                    ],
              ]
      );
      $this->add_responsive_control(
            'pagination_align',
            [
                'label' => esc_html__( 'Pagination Align', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                      'pagination' => 'show',
                    ],
            ]
        );
       $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => esc_html__( 'Pagination Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                      'pagination' => 'show',
                    ],
            ]
        );


      $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
        $title = $settings['title'];
        $desc = $settings['desc'];
        $serv_category = $settings['serv_category'];
        $thumb = $settings['image_size'];
        $pagination = $settings['pagination'];
        $columns = $settings['columns'];
        $taxonomy_filter = $settings['taxonomy_filter'];
        $social_media = $settings['social_media'];
        $showposts = '';
        $offset = $settings['offset'];
        $number_of_posts = $settings['number_of_posts'];

        if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;

        $query_args = TX_Helper::setup_query_args($settings, $showposts);
        $queryd = new \WP_Query( $query_args );
        ?>


            <!-- <div class="row"> -->
                <div class="tx-team-cols">
                <?php
                    if ($queryd->have_posts()) : 
                        while ($queryd->have_posts()) : $queryd->the_post();

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
                    
                            <div class="team <?php echo esc_attr($settings['display']); ?>">
                                <figure>
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_post_thumbnail($thumb); ?>      
                                    
                                    <?php if( 'grid_t' === $settings['display'] ) : ?>
                                    <figcaption>
                                        <?php if($title == 'show') : ?>
                                        <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo TX_Helper::title_lenth($settings['title_lenth']); ?></a></h4>
                                        <?php endif; ?>
                                        
                                        <?php if( !empty($cat_name) && $settings['category_display'] == 'show' ) : ?>
                                        <p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
                                        <?php endif; ?>

                                        <?php if($desc == 'show') : ?>
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
                                            <?php if($title == 'show') : ?>
                                        <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo TX_Helper::title_lenth($settings['title_lenth']); ?></a></h4>
                                        <?php endif; ?>
                                        
                                        <?php if( !empty($cat_name) && $settings['category_display'] == 'show' ) : ?>
                                        <p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
                                        <?php endif; ?>

                                        <?php if($desc == 'show') : ?>
                                        <div class="team-bio"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                        <?php endif; ?>

                                        <?php 
                                        if($social_media =='show') : 
                                            do_action('tx_single_team_social_icons');
                                        endif; ?>
                                        </div>
                                    <?php endif; ?> 
                                </figure>
                            </div><!-- team -->
                    
            <?php endwhile; ?>
            <?php
                 if($pagination == 'show') :
            ?>
                <div class="tx-pagination-widgets">
                <?php
                $page_tot = ceil(($queryd->found_posts - (int)$offset) / (int)$number_of_posts);
                if ( $page_tot > 1 ) {
                $big = 999999999;
                echo paginate_links( array(
                      'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ),
                      'format'    => '?paged=%#%',
                      'current'   => max( 1, $paged ),
                      'total'     => ceil(($queryd->found_posts - (int)$offset) / (int)$number_of_posts),
                      'prev_next' => true,
                        'prev_text'    => esc_html__( 'Prev', 'avas-core' ),
                        'next_text'    => esc_html__( 'Next', 'avas-core' ),
                      'end_size'  => 1,
                      'mid_size'  => 2,
                      'type'      => 'list'
                        )
                    );
                }
                ?>
                </div><!-- /.tx-pagination-widgets -->
            <?php endif; ?>
            <?php
                    wp_reset_postdata();
                else:  
                    get_template_part('template-parts/content/content', 'none');
                endif; ?>
                </div><!-- tx-team-cols -->
            <!-- </div> --><!-- /.row -->
        <div class="clearfix"></div>

        <?php
           
	} // function render()
} // class Portfolio
