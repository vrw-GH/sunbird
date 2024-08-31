<?php
namespace AvasElements\Modules\Services\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Services extends Widget_Base {

    public function get_name() {
        return 'avas-services';
    }

    public function get_title() {
        return esc_html__( 'Avas Services Grid', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
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
                'description' => esc_html__('If you can not see any Services item then please add Services via WordPress Dashboard > Services > Add New Services','avas-core'),
                'default' => 'service',
                'options' => TX_Helper::get_all_post_types(),
                
            ]
        );
        $this->add_control(
            'taxonomy_filter',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Taxonomy', 'avas-core'),
                'options' => TX_Helper::get_all_taxonomies(),
                'default' => 'service-category',
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'exclude' => [ 'custom' ],
                'default' => 'tx-serv-thumb',
            ]
        );
        $this->add_control(
            'display',
            [
                'label'     => esc_html__( 'Style', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                        'grid'    => esc_html__('Grid','avas-core'),
                        'overlay'    => esc_html__('Overlay','avas-core'),
                    ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Number of Columns', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '12' => esc_html__( 'One Column', 'avas-core' ),
                    '6' => esc_html__( 'Two Columns',   'avas-core' ),
                    '4' => esc_html__( 'Three Columns', 'avas-core' ),
                    '3' => esc_html__( 'Four Columns',  'avas-core' ),
                    '2' => esc_html__( 'Six Columns',   'avas-core' ),                   
                    
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
                'default' => 6
            ]
        );
        $this->add_control(
            'offset',
            [
              'label'         => esc_html__( 'Post Offset', 'avas-core' ),
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
                'default' => '20',
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
               
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Overlay Icon', 'avas-core' ),
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
                'default' => 'block',
                'condition' => [
                    'display' => 'grid'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-services-featured a:after'   => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link Arrow', 'avas-core' ),
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
                    'display' => 'overlay',
                ]
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
                'label'     => esc_html__( 'Image Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-overlay-item:before, {{WRAPPER}} .tx-services-featured a:before' => 'background-color: {{VALUE}}',
                ],
                
            ]
        );
        $this->add_control(
            'cont_bg_color',
            [
                'label'     => esc_html__( 'Content Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-content' => 'background-color: {{VALUE}}',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cont_box_shadow',
                'selector' => '{{WRAPPER}} .tx-services-content',
                'condition' => [
                    'display' => 'grid',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'serv_box_shadow_hover',
                'label'     => esc_html__( 'Box Shadow Hover', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-services-item:hover',
                'condition' => [
                    'display' => 'grid',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-item .tx-services-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                    'display' => 'grid',
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
                    '{{WRAPPER}} .tx-services-item .tx-services-title a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                    'display' => 'grid',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} .tx-services-item .tx-services-title',
                   'condition' => [
                      'title' => 'show',
                      'display' => 'grid',
                    ],
              ]
        );
        $this->add_control(
            'title_overlay_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-overlay-item .tx-services-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                    'display' => 'overlay',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_overlay_color_hover',
            [
                'label'     => esc_html__( 'Title Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-overlay-item .tx-services-title:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                    'display' => 'overlay',
                ],
            ]
        );
        $this->add_control(
            'title_overlay_bg_color',
            [
                'label'     => esc_html__( 'Title Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-title-holder' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'title' => 'show',
                    'display' => 'overlay',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_overlay_typography',
                   'selector'  => '{{WRAPPER}} .tx-services-overlay-item .tx-services-title',
                   'condition' => [
                      'title' => 'show',
                      'display' => 'overlay',
                    ],
              ]
        );
        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-item .tx-services-excp' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'desc' => 'show',
                    'display' => 'grid',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_typography',
                   'selector'  => '{{WRAPPER}} .tx-services-item .tx-services-excp',
                   'condition' => [
                      'desc' => 'show',
                      'display' => 'grid',
                    ],
              ]
        );
        $this->add_control(
            'desc_overlay_color',
            [
                'label'     => esc_html__( 'Description Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-overlay-item .tx-services-excp' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'desc' => 'show',
                    'display' => 'overlay',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_overlay_typography',
                   'selector'  => '{{WRAPPER}} .tx-services-overlay-item .tx-services-excp',
                   'condition' => [
                      'desc' => 'show',
                      'display' => 'overlay',
                    ],
              ]
        );
        $this->add_control(
            'cat_color',
            [
                'label'     => esc_html__( 'Category Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-serv-cat' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'serv_category' => 'show',
                    'display' => 'grid',
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
                    '{{WRAPPER}} .tx-serv-cat:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'serv_category' => 'show',
                    'display' => 'grid',
                ],
            ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'cat_typography',
                   'selector'  => '{{WRAPPER}} .tx-serv-cat',
                   'condition' => [
                    'serv_category' => 'show',
                    'display' => 'grid',
                ],
              ]
      );
      $this->add_control(
            'link_color',
            [
                'label'     => esc_html__( 'Link Arrow Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-overlay-item i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'link' => 'show',
                    'display' => 'overlay',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_control(
            'link_hover_color',
            [
                'label'     => esc_html__( 'Link Arrow Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-services-overlay-item i:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'link' => 'show',
                    'display' => 'overlay',
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
            ]
        );


      $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
        $display = $settings['display'];
        $title = $settings['title'];
        $title_lenth = $settings['title_lenth'];
        $desc = $settings['desc'];
        $serv_category = $settings['serv_category'];
        $link = $settings['link'];
        $thumb = $settings['image_size'];
        $pagination = $settings['pagination'];
        $columns = $settings['columns'];
        $taxonomy_filter = $settings['taxonomy_filter'];
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


            <div class="row">
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
                    <?php if($display == 'grid') : ?>
                        <div class="col-md-<?php echo esc_attr($columns); ?> col-sm-6">
                            <div class="tx-services-item">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="tx-services-featured">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_post_thumbnail($thumb); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                                <div class="tx-services-content">
                                    <?php if($title == 'show') : ?>
                                    <h3 class="tx-services-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php echo TX_Helper::title_lenth($title_lenth); ?></a></h3>
                                    <?php endif; ?>
                                    <?php if($desc == 'show') : ?>
                                    <div class="tx-services-excp"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                    <?php endif; ?> 
                                    <?php if(!empty($cat_name) && $serv_category == 'show') : ?>
                                        <a class="tx-serv-cat" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat_name); ?></a>
                                    <?php endif; ?>
                                </div><!-- /.tx-services-content -->
                            </div><!-- /.tx-services-item -->
                        </div>
                    <?php elseif($display == 'overlay') : ?>
                        <div class="col-md-<?php echo esc_attr($columns); ?> col-sm-6">
                            <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), $thumb); ?>

                            <div class="tx-services-overlay-item" <?php if (has_post_thumbnail()) : echo 'style="background-image:url('.$featured_img_url.')"'; endif;?>>
                                <div class="tx-services-content">
                                    <?php if($title == 'show') : ?>
                                    <div class="tx-services-title-holder">
                                        <h3 class="tx-services-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php echo TX_Helper::title_lenth($title_lenth); ?></a></h3>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty($cat_name) && $serv_category == 'show') : ?>
                                        <a class="tx-serv-cat" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat_name); ?></a>
                                    <?php endif; ?>
                                    <?php if($desc == 'show') : ?>
                                    <div class="tx-services-excp"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                    <?php endif; ?>
                                    <?php if($link == 'show') : ?>  
                                    <a href="<?php the_permalink(); ?>"><i class="bi bi-arrow-right"></i></a>
                                    <?php endif; ?> 
                                </div><!-- /.tx-services-content -->
                            </div><!-- /.tx-services-item -->
                        </div>
                    <?php else : ?>
                        <div class="col-md-<?php echo esc_attr($columns); ?> col-sm-6">
                            <div class="tx-services-item">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="tx-services-featured">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_post_thumbnail($thumb); ?>
                                    </a>
                                    <!-- <div class="tx-port-overlay"></div> -->
                                </div>
                            <?php endif; ?>
                                <div class="tx-services-content">
                                    <h3 class="tx-services-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php echo TX_Helper::title_lenth($title_lenth); ?></a></h3>
                                    <div class="tx-services-excp"><?php echo TX_Helper::excerpt_limit($settings['excerpt_words']); ?></div>
                                </div><!-- /.tx-services-content -->
                            </div><!-- /.tx-services-item -->
                        </div>
                    <?php endif; ?> 

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
        
        <div class="clearfix"></div>
        <!-- pagination -->
        </div><!-- /.row -->

<?php	} // function render()
} // class Services
