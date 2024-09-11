<?php
namespace AvasElements\Modules\PostTiled\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostTiled extends Widget_Base {

    public function get_name() {
        return 'avas-post-tiled';
    }

    public function get_title() {
        return esc_html__( 'Avas Post Tiled', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-posts-group';
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
            'layout',
            [
                'label'             => esc_html__( 'Styles', 'avas-core' ),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                   'layout-1'       => esc_html__( 'Style 1', 'avas-core' ),
                   'layout-2'       => esc_html__( 'Style 2', 'avas-core' ),
                   'layout-3'       => esc_html__( 'Style 3', 'avas-core' ),
                   'layout-4'       => esc_html__( 'Style 4', 'avas-core' ),
                   'layout-5'       => esc_html__( 'Style 5', 'avas-core' ),
                   'layout-6'       => esc_html__( 'Style 6', 'avas-core' ),
                   'layout-7'       => esc_html__( 'Style 7', 'avas-core' ),
                   'layout-8'       => esc_html__( 'Style 8', 'avas-core' ),
                   'layout-9'       => esc_html__( 'Style 9', 'avas-core' ),
                   'layout-10'      => esc_html__( 'Style 10', 'avas-core' ),
                   'layout-11'      => esc_html__( 'Style 11', 'avas-core' ),
                   'layout-12'      => esc_html__( 'Style 12', 'avas-core' ),
                   'layout-13'      => esc_html__( 'Style 13', 'avas-core' ),
                ],
                'default'           => 'layout-13',
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Post Types', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post',
                'options' => TX_Helper::get_all_post_types(),
            ]
        );
        $this->add_control(
            'taxonomy_filter',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Taxonomy', 'avas-core'),
                'options' => TX_Helper::get_all_taxonomies(),
                'default' => 'category',
            ]
        );
        $this->add_control(
            'tax_query',
            [
                'label' => esc_html__( 'Categories', 'avas-core' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => TX_Helper::get_all_categories(),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'exclude' => [ 'custom' ],
                'default' => 'tx-m-thumb',
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
            'offset',
            [
                'label' => esc_html__( 'Offset', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
               
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Posts', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'condition' => [
                    'layout' => ['layout-0'],
                ],
            ]
        );
        $this->add_control(
            'category',
            [
                'label' => esc_html__( 'Category', 'avas-core' ),
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

            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'avas-core' ),
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

            ]
        );
        $this->add_control(
            'title_lenth',
            [
                'label' => esc_html__( 'Title Lenth', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '50',
                'condition' => [
                    'title' => 'yes',
                ]

            ]
        );
        $this->add_control(
            'author',
            [
                'label' => esc_html__( 'Author', 'avas-core' ),
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

            ]
        );
        $this->add_control(
            'date',
            [
                'label' => esc_html__( 'Date', 'avas-core' ),
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
                'selector'          => '{{WRAPPER}} .post-tiled .post-tiled-content',
            ]
        );
        $this->add_control(
            'content_padding',
            [
                'label'             => esc_html__( 'Padding', 'ex' ),
                'type'              => Controls_Manager::DIMENSIONS,
                'size_units'        => [ 'px', 'em', '%' ],
                'selectors'         => [
                    '{{WRAPPER}} .post-tiled .post-tiled-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'category_bg_color',
            [
                'label'     => esc_html__( 'Category Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-tiled-category a' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                      'category' => 'yes',
                    ],

            ]
        );
        $this->add_control(
            'category_bg_hov_color',
            [
                'label'     => esc_html__( 'Category BG Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-tiled-category a:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                      'category' => 'yes',
                    ],

            ]
        );
        $this->add_control(
            'category_color',
            [
                'label'     => esc_html__( 'Category Font Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-tiled-category a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                      'category' => 'yes',
                    ],

            ]
        );
        $this->add_control(
            'category_hov_color',
            [
                'label'     => esc_html__( 'Category Font Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-tiled-category a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                      'category' => 'yes',
                    ],

            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-tiled-title a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
                      'title' => 'yes',
                    ],

            ]
        );
        $this->add_control(
            'title_hov_color',
            [
                'label'     => esc_html__( 'Title Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-tiled-title a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                      'title' => 'yes',
                    ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} .post-tiled-title',
                   'condition' => [
                      'title' => 'yes',
                    ],
              ]
        );
        $this->add_control(
            'meta_color',
            [
                'label'     => esc_html__( 'Meta Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-tiled-meta, {{WRAPPER}} .post-tiled-meta a, {{WRAPPER}} .post-tiled-meta i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',

            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $thumb = $settings['image_size'];
        $layout = $settings['layout'];
        $offset = $settings['offset'];
        $taxonomy_filter = $settings['taxonomy_filter'];
        $category = $settings['category'];
        $title = $settings['title'];
        $title_lenth = $settings['title_lenth'];
        $author = $settings['author'];
        $date = $settings['date'];

        // title lenth limit
        if( $title_lenth ){
            $title_lenth = $title_lenth;
        } else {
            $title_lenth = 50;
        }

        $this->add_render_attribute( 'post-tiled', 'class', 'post-tiled clearfix' );

        if ($layout) :
            $this->add_render_attribute( 'post-tiled', 'class', 'post-tiled-' . $layout );
        endif;

        if ( $layout == 'layout-12' ) {
            $showposts = '2';
        }

                elseif ( $layout == 'layout-2' || $layout == 'layout-3' || $layout == 'layout-7' || $layout == 'layout-9' || $layout == 'layout-10' ) {
                    $showposts = '3';
                }
        
                elseif ( $layout == 'layout-1' || $layout == 'layout-6' || $layout == 'layout-8' ) {
                    $showposts = '4';
                }
                
                elseif ( $layout == 'layout-4' || $layout == 'layout-5' || $layout == 'layout-13' ) {
                    $showposts = '5';
                }
                elseif ( $layout == 'layout-11' ) {
                    $showposts = '6';
                }
                else {
                    $showposts = '3';
                }
        $position = 1;
        $query_args = TX_Helper::setup_query_args( $settings, $showposts );
        $pt_query = new \WP_Query( $query_args );

        ?>

        <div <?php echo $this->get_render_attribute_string( 'post-tiled' ); ?>>

            <?php if ($pt_query->have_posts()) : while ($pt_query->have_posts()) : $pt_query->the_post(); ?>

                <?php
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

                if ( $layout == 'layout-1' || $layout == 'layout-2' || $layout == 'layout-3' || $layout == 'layout-4' ) {

                        if ( $position == 2 ) { ?><div class="post-tiled-block-right"><?php }
                    }

                    elseif ( $layout == 'layout-13' ) {

                        if ( $position == 1 ) { ?><div class="post-tiled-block-left"><?php }
                    }
                ?>
                <div class="post-tiled-block post-tiled-block-<?php echo intval( $position ); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), $thumb); ?>
                        <div class="post-tiled-block-bg" <?php echo 'style="background-image:url('.esc_url( $thumb_url ).')"'; ?>></div>
                    <?php endif; ?>

                    <div class="post-tiled-content">
                        <?php if($category == 'yes') : ?>
                        <div class="post-tiled-category">
                            <a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat_name); ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if($title == 'yes') : ?>
                        <h3 class="post-tiled-title"><a href="<?php the_permalink() ?>"><?php echo TX_Helper::title_lenth($title_lenth); ?></a></h3>
                        <?php endif; ?>
                        <div class="post-tiled-meta entry-meta">
                            <?php if($author == 'yes') : ?>
                            <span class="post-tiled-author"><?php tx_author(); ?></span>
                            <?php endif; ?>
                            <?php if($date == 'yes') : ?>
                            <span class="post-tiled-date"><?php tx_date(); ?></span>
                            <?php endif; ?>
                        </div><!-- post-tiled-meta  -->
                    </div><!-- post-tiled-content -->
                </div><!-- post-tiled-block -->
            <?php

                    if ( $layout == 'layout-1' ) {
                        if ( $position == 4 ) { ?></div><?php }
                    }
                    elseif ( $layout == 'layout-2' || $layout == 'layout-3' ) {
                        if ( $position == 3 ) { ?></div><?php }
                    }
                    if ( $layout == 'layout-4' ) {
                        if ( $position == 5 ) { ?></div><?php }
                    }
                    elseif ( $layout == 'layout-11' ) {
                        if ( $position == 6 ) { ?><?php }
                    }
                    elseif ( $layout == 'layout-13' ) {
                        if ( $position == 2 ) { ?></div><?php }
                    }
                $position++; endwhile; endif; wp_reset_postdata();
        ?>
            
        </div><!-- post-tiled -->
        <div class="clearfix"></div>


<?php
    } //render()

} //class 