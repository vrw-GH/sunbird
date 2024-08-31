<?php
namespace AvasElements\Modules\PostList\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostList extends Widget_Base {

    public function get_name() {
        return 'avas-post-list';
    }

    public function get_title() {
        return esc_html__( 'Avas Post List', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-post-list';
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
                'label_block' => true,
                'multiple' => true,
                'options' => TX_Helper::get_all_categories(),
                
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style-1' => esc_html__('Style 1', 'avas-core'),
                    'style-2' => esc_html__('Style 2', 'avas-core'),
                    'style-3' => esc_html__('Style 3', 'avas-core'),
                    'style-4' => esc_html__('Style 4', 'avas-core'),
                ),
                'default' => 'style-1',
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
                'default' => '6'
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
                'description' => esc_html__( 'This will not work for the first post of Style 1, Style 2 and Style 4.', 'avas-core' ),
                'condition' => [
                    'title' => 'show',
                ]

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
            'author',
            [
                'label' => esc_html__( 'Author', 'avas-core' ),
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
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'              => 'content_bg',
                'label'             => esc_html__( 'Background', 'avas-core' ),
                'types'             => [ 'classic', 'gradient' ],
                'selector'          => '{{WRAPPER}} .tx-post-list-wrap-first .tx-post-list-content',
            ]
        );
        $this->add_responsive_control(
            'style_3_spacing',
            [
                'label' => esc_html__( 'Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-wrap-last' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout' => 'style-3',
                ],
            ]
        );
        $this->add_control(
            'cat_color',
            [
                'label'     => esc_html__( 'Category Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-category a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'cat_bg_color',
            [
                'label'     => esc_html__( 'Category Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-category a' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'cat_bg_hov_color',
            [
                'label'     => esc_html__( 'Category Background Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-category:hover a' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color First Post', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-wrap-first .tx-post-list-title a' => 'color: {{VALUE}};',
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
                'label'     => esc_html__( 'Title First Post Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-wrap-first .tx-post-list-title a:hover' => 'color: {{VALUE}};',
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
                   'selector'  => '{{WRAPPER}} .tx-post-list-wrap-first .tx-post-list-title a',
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
                    '{{WRAPPER}} .tx-post-list-desc' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_typography',
                   'selector'  => '{{WRAPPER}} .tx-post-list-desc',
              ]
        );
        $this->add_control(
            'title_color_last',
            [
                'label'     => esc_html__( 'Title Color Rest Posts', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-wrap-last .tx-post-list-title a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color_hover_last',
            [
                'label'     => esc_html__( 'Title Rest Posts Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-wrap-last .tx-post-list-title a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_last_typography',
                   'selector'  => '{{WRAPPER}} .tx-post-list-wrap-last .tx-post-list-title a',
                   'condition' => [
                      'title' => 'show',
                    ],
              ]
        );
        
        
        $this->add_control(
            'meta_color',
            [
                'label'     => esc_html__( 'Meta Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-meta span, {{WRAPPER}} .tx-post-list-meta span a' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'meta_icon_color',
            [
                'label'     => esc_html__( 'Meta Icons Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-post-list-meta span i' => 'color: {{VALUE}};',
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
		$settings = $this->get_settings();
        $title = $settings['title'];
        $title_lenth = $settings['title_lenth'];
        $post_category = $settings['post_category'];
        $pagination = $settings['pagination'];
        $taxonomy_filter = $settings['taxonomy_filter'];
        $showposts = '';
        $count = 0;

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
        ?>


<?php if($settings['layout'] == 'style-1') : ?>

            <div class="list-group">
            <?php
           
                if ($post_query->have_posts()) : 
                    while ($post_query->have_posts()) : $post_query->the_post();
                    global $post;    
                    $count++
            ?>
                    
                    <?php if ($count == 1) { ?>
                            <div class="tx-post-list-wrap-first style-1">

                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                    
                                    <?php if ( has_post_format('video') ) { ?>
                                    <?php 
                                        $post_video_link = get_post_meta( $post->ID, 'post_link', true );
                                        if( function_exists('tx_post_video_link') &&  $post_video_link ) { ?>
                                        <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
                                    <?php } else {
                                        if (has_post_thumbnail()) : ?>
                                            <div class="zoom-thumb featured-thumb">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('tx-bc-thumb'); ?>
                                                </a>
                                            </div>
                                    <?php endif; 
                                        } ?>    
                                   
                                    <?php } else {  ?>

                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="zoom-thumb featured-thumb">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('tx-bc-thumb'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <?php } ?>

                                    <div class="tx-post-list-content">
                                        <?php if($post_category == 'show') : ?>
                                            <div class="tx-post-list-category">
                                                <?php echo get_the_category_list(' '); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($title == 'show') : ?>
                                            <h4 class="tx-post-list-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                                        <?php endif; ?>

                                        <div class="tx-post-list-meta entry-meta">
                                            <?php if($settings['date'] == 'show') : ?>
                                            <?php tx_date(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['author'] == 'show') : ?>
                                            <?php tx_author(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['views'] == 'show') : ?>
                                            <?php echo tx_getPostViews(get_the_ID()); ?>
                                            <?php endif; ?>
                                        </div><!-- post-tiled-meta  -->
                                    </div><!-- tx-post-list-content -->
                                </article>
                            </div><!-- tx-post-list-wrap-first -->
                    <?php } else { ?>
                            <div class="tx-post-list-wrap-last style-1">

                                 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                    <div class="tx-post-list-left">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="zoom-thumb featured-thumb">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('tx-s-thumb'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($post_category == 'show') : ?>
                                            <div class="tx-post-list-category">
                                                <?php echo get_the_category_list(' '); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="tx-post-list-right">
                                        <?php if($title == 'show') : ?>
                                            <h5 class="tx-post-list-title"><a href="<?php the_permalink() ?>"><?php echo TX_Helper::title_lenth($title_lenth); ?></a></h5>
                                        <?php endif; ?>
                                        <div class="tx-post-list-meta entry-meta">
                                            <?php if($settings['date'] == 'show') : ?>
                                            <?php tx_date(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['author'] == 'show') : ?>
                                            <?php tx_author(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['views'] == 'show') : ?>
                                            <?php echo tx_getPostViews(get_the_ID()); ?>
                                            <?php endif; ?>
                                        </div><!-- post-tiled-meta  -->

                                    </div>
                                </article>
                            </div><!-- tx-post-list-wrap-last -->
                <?php    }

                    ?>
                <?php endwhile;
                    wp_reset_postdata();
                else:  
                    get_template_part('template-parts/content/content', 'none');
                endif; ?>
        
            <div class="tx-clear"></div>
            <!-- pagination -->
            <?php
                if($pagination == 'show') :
                tx_pagination_number($post_query->max_num_pages,"",$paged);
                endif;
            ?>
        </div><!-- /.list-group -->
<?php endif; ?>

<?php if($settings['layout'] == 'style-2') : ?>
<div class="row">
            <?php
           
                if ($post_query->have_posts()) : 
                    while ($post_query->have_posts()) : $post_query->the_post();
                    global $post;    
                    $count++
            ?>
                    
                    <?php if ($count == 1) { ?>
                            <div class="tx-post-list-wrap-first style-2 col-md-6">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                    <?php if ( has_post_format('video') ) { ?>
                                    <?php 
                                        $post_video_link = get_post_meta( $post->ID, 'post_link', true );
                                        if( function_exists('tx_post_video_link') &&  $post_video_link ) { ?>
                                        <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
                                    <?php } else {
                                        if (has_post_thumbnail()) : ?>
                                            <div class="zoom-thumb featured-thumb">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('tx-bc-thumb'); ?>
                                                </a>
                                            </div>
                                    <?php endif; 
                                        } ?>

                                <?php } elseif( has_post_format('gallery') ) {
                                    $images = get_post_meta($post->ID, 'tx_gallery_id', true); 
                                    if( function_exists('tx_add_gallery_metabox') && $images ) { ?>
                                        <div class="gallery-slider"><!-- slider start -->         
                                            <ul class="posts-gallery-slider cS-hidden">
                                            <?php         
                                            $images = get_post_meta($post->ID, 'tx_gallery_id', true);  
                                            if($images) :
                                            foreach ($images as $image) {

                                            $image_thumb_url = wp_get_attachment_image_src($image, 'tx-s-thumb'); 
                                            $thumbs = $image_thumb_url[0];
                                            $gallery = wp_get_attachment_link($image, 'tx-bc-thumb');

                                                echo '<li data-thumb = "'.$thumbs.'">';                
                                                echo  wp_kses_post($gallery);
                                                echo '</li>';  
                                            }
                                              endif;
                                            ?>
                                            </ul>
                                        </div><!-- slider end --> 
                                    <?php } else { ?> 
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="zoom-thumb featured-thumb">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('tx-bc-thumb'); ?>
                                            </a>
                                        </div>
                                    <?php endif; }
                                } else { 

                                if (has_post_thumbnail()) : ?>
                                        <div class="zoom-thumb featured-thumb">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('tx-bc-thumb'); ?>
                                            </a>
                                        </div>
                                    <?php endif;

                                } ?>

                                    <div class="tx-post-list-content">
                                        <?php if($post_category == 'show') : ?>
                                            <div class="tx-post-list-category">
                                                <?php echo get_the_category_list(' '); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($title == 'show') : ?>
                                            <h4 class="tx-post-list-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                                        <?php endif; ?>

                                        <div class="tx-post-list-meta entry-meta">
                                            <?php if($settings['date'] == 'show') : ?>
                                            <?php tx_date(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['author'] == 'show') : ?>
                                            <?php tx_author(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['views'] == 'show') : ?>
                                            <?php echo tx_getPostViews(get_the_ID()); ?>
                                            <?php endif; ?>
                                        </div><!-- post-tiled-meta  -->
                                        <p class="tx-post-list-desc"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
                                    </div><!-- tx-post-list-content -->
                                </article>
                            </div><!-- tx-post-list-wrap-first -->
                    <?php }  else {

                        if($count == 2) {  ?>
                            <div class="col-md-6">
                                <div class="list-group">
                                <?php } ?>

                            <div class="tx-post-list-wrap-last style-2">
                                 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                    <div class="tx-post-list-left">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="zoom-thumb featured-thumb">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('tx-s-thumb'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($post_category == 'show') : ?>
                                            <div class="tx-post-list-category">
                                                <?php echo get_the_category_list(' '); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="tx-post-list-right">
                                        <?php if($title == 'show') : ?>
                                            <h5 class="tx-post-list-title"><a href="<?php the_permalink() ?>"><?php echo TX_Helper::title_lenth($title_lenth); ?></a></h5>
                                        <?php endif; ?>
                                        <div class="tx-post-list-meta entry-meta">
                                            <?php if($settings['date'] == 'show') : ?>
                                            <?php tx_date(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['author'] == 'show') : ?>
                                            <?php tx_author(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['views'] == 'show') : ?>
                                            <?php echo tx_getPostViews(get_the_ID()); ?>
                                            <?php endif; ?>
                                        </div><!-- post-tiled-meta  -->

                                    </div>
                                </article>
                            </div><!-- tx-post-list-wrap-last -->
                            <?php if ( $count == $settings['number_of_posts'] ) { ?>
                                    </div><!-- ist-group -->
                                </div><!-- col-md-6 col-sm-6 -->
                                <?php } ?>
                <?php    }
            ?>
                <?php endwhile;
                    wp_reset_postdata(); ?>
                    
          <?php      else:  
                    get_template_part('template-parts/content/content', 'none');
                endif; ?>
        
            <div class="tx-clear"></div>
            <!-- pagination -->
            <?php
                if($pagination == 'show') :
                tx_pagination_number($post_query->max_num_pages,"",$paged);
                endif;
            ?>
        </div><!-- /.row -->
<?php endif; ?>

<?php if($settings['layout'] == 'style-3') : ?>
<div class="list-group">
<?php
           
                if ($post_query->have_posts()) : 
                    while ($post_query->have_posts()) : $post_query->the_post();
                    global $post;   ?>
                            <div class="tx-post-list-wrap-last style-3">
                                 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                    <div class="tx-post-list-left">
                                        
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="zoom-thumb featured-thumb">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('tx-r-thumb'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>



                                        <?php if($post_category == 'show') : ?>
                                            <div class="tx-post-list-category">
                                                <?php echo get_the_category_list(' '); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="tx-post-list-right">
                                        <?php if($title == 'show') : ?>
                                            <h4 class="tx-post-list-title"><a href="<?php the_permalink() ?>"><?php echo TX_Helper::title_lenth($title_lenth); ?></a></h4>
                                        <?php endif; ?>
                                        <div class="tx-post-list-meta entry-meta">
                                            <?php if($settings['date'] == 'show') : ?>
                                            <?php tx_date(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['author'] == 'show') : ?>
                                            <?php tx_author(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['views'] == 'show') : ?>
                                            <?php echo tx_getPostViews(get_the_ID()); ?>
                                            <?php endif; ?>
                                        </div><!-- post-tiled-meta  -->
                                        <p class="tx-post-list-desc"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
                                    </div>
                                </article>
                            </div><!-- tx-post-list-wrap-last style-3 -->
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                    
          <?php else:  
                    get_template_part('template-parts/content/content', 'none');
                endif; ?>
        
            <div class="tx-clear"></div>
            <!-- pagination -->
            <?php
                if($pagination == 'show') :
                tx_pagination_number($post_query->max_num_pages,"",$paged);
                endif;
            ?>

 </div><!-- ist-group -->

<?php endif; ?>

<?php if($settings['layout'] == 'style-4') : ?>
<div class="row">
            <?php
           
                if ($post_query->have_posts()) : 
                    while ($post_query->have_posts()) : $post_query->the_post();
                    global $post;    
                    $count++
            ?>
                    
                    <?php if ($count == 1) { ?>
                            <div class="tx-post-list-wrap-first style-4 col-md-6">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                    <?php if ( has_post_format('video') ) { ?>
                                    <?php 
                                        $post_video_link = get_post_meta( $post->ID, 'post_link', true );
                                        if( function_exists('tx_post_video_link') &&  $post_video_link ) { ?>
                                        <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
                                    <?php } else {
                                        if (has_post_thumbnail()) : ?>
                                            <div class="zoom-thumb featured-thumb">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('tx-m-thumb'); ?>
                                                </a>
                                            </div>
                                    <?php endif; 
                                        } ?>

                                <?php } elseif( has_post_format('gallery') ) {
                                    $images = get_post_meta($post->ID, 'tx_gallery_id', true); 
                                    if( function_exists('tx_add_gallery_metabox') && $images ) { ?>
                                        <div class="gallery-slider"><!-- slider start -->         
                                            <ul class="posts-gallery-slider cS-hidden">
                                            <?php         
                                            $images = get_post_meta($post->ID, 'tx_gallery_id', true);  
                                            if($images) :
                                            foreach ($images as $image) {

                                            $image_thumb_url = wp_get_attachment_image_src($image, 'tx-s-thumb'); 
                                            $thumbs = $image_thumb_url[0];
                                            $gallery = wp_get_attachment_link($image, 'tx-m-thumb');

                                                echo '<li data-thumb = "'.$thumbs.'">';                
                                                echo  wp_kses_post($gallery);
                                                echo '</li>';  
                                            }
                                              endif;
                                            ?>
                                            </ul>
                                        </div><!-- slider end --> 
                                    <?php } else { ?> 
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="zoom-thumb featured-thumb">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('tx-m-thumb'); ?>
                                            </a>
                                        </div>
                                    <?php endif; }
                                } else { 

                                if (has_post_thumbnail()) : ?>
                                        <div class="zoom-thumb featured-thumb">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('tx-m-thumb'); ?>
                                            </a>
                                        </div>
                                    <?php endif;

                                } ?>

                                    <div class="tx-post-list-content">
                                        <?php if($post_category == 'show') : ?>
                                            <div class="tx-post-list-category">
                                                <?php echo get_the_category_list(' '); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($title == 'show') : ?>
                                            <h4 class="tx-post-list-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                                        <?php endif; ?>

                                        <div class="tx-post-list-meta entry-meta">
                                            <?php if($settings['date'] == 'show') : ?>
                                            <?php tx_date(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['author'] == 'show') : ?>
                                            <?php tx_author(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['views'] == 'show') : ?>
                                            <?php echo tx_getPostViews(get_the_ID()); ?>
                                            <?php endif; ?>
                                        </div><!-- post-tiled-meta  -->
                                        <p class="tx-post-list-desc"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
                                    </div><!-- tx-post-list-content -->
                                </article>
                            </div><!-- tx-post-list-wrap-first -->
                    <?php }  else {

                        if($count == 2) {  ?>
                            <div class="col-md-6">
                                <div class="row">
                                <?php } ?>
                            <div class="col-md-6">
                            <div class="tx-post-list-wrap-last style-4">
                                 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                    <div class="tx-post-list-left">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="zoom-thumb featured-thumb">
                                                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('tx-r-thumb'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($post_category == 'show') : ?>
                                            <div class="tx-post-list-category">
                                                <?php echo get_the_category_list(' '); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="tx-post-list-right">
                                        <?php if($title == 'show') : ?>
                                            <h5 class="tx-post-list-title"><a href="<?php the_permalink() ?>"><?php echo TX_Helper::title_lenth($title_lenth); ?></a></h5>
                                        <?php endif; ?>
                                        <div class="tx-post-list-meta entry-meta">
                                            <?php if($settings['date'] == 'show') : ?>
                                            <?php tx_date(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['author'] == 'show') : ?>
                                            <?php tx_author(); ?>
                                            <?php endif; ?>
                                            <?php if($settings['views'] == 'show') : ?>
                                            <?php echo tx_getPostViews(get_the_ID()); ?>
                                            <?php endif; ?>
                                        </div><!-- post-tiled-meta  -->

                                    </div>
                                </article>
                            </div><!-- tx-post-list-wrap-last style-4-->
                            </div>
                            <?php if ( $count == $settings['number_of_posts'] ) { ?>
                                    </div><!-- ist-group -->
                                </div><!-- col-md-6 col-sm-6 -->
                                <?php } ?>
                <?php    }
            ?>
                <?php endwhile;
                    wp_reset_postdata(); ?>
                    
          <?php      else:  
                    get_template_part('template-parts/content/content', 'none');
                endif; ?>
        
            <div class="tx-clear"></div>
            <!-- pagination -->
            <?php
                if($pagination == 'show') :
                tx_pagination_number($post_query->max_num_pages,"",$paged);
                endif;
            ?>
        </div><!-- /.row -->
<?php endif; ?>


<?php	} // function render()
} // class 
