<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
*=====================================
* Posts carousel widget.
*/

class tx_posts_carousel_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'tx_posts_carousel_widget', 
        // Widget name will appear in UI
        esc_html__('Avas Posts Carousel', 'avas-core'), 
        // Widget description
        array( 'description' => esc_html__( 'Posts Carousel.', 'avas-core' ), ) 
        );
        // This is where we add the style and script
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
       // add_action( 'admin_footer-widgets.php', array(&$this, 'tx_color_picker'), 9999 );
        add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
    }

    public function enqueue_scripts( $hook_suffix ) {
        if ( 'widgets.php' !== $hook_suffix ) {
            return;
        }

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'underscore' );
    }
    public function print_scripts() { ?>

        <script>
            jQuery(document).ready( function( $ ){'use strict';
                function initColorPicker( widget ) {
                    widget.find( '.tx-color-picker' ).wpColorPicker( {
                        change: _.throttle( function() { // For Customizer
                            $(this).trigger( 'change' );
                        }, 3000 )
                    });
                }

                function onFormUpdate( event, widget ) {
                    initColorPicker( widget );
                }

                $( document ).on( 'widget-added widget-updated', onFormUpdate );

                $( document ).ready( function() {
                    $( '#widgets-right .widget:has(.tx-color-picker)' ).each( function () {
                        initColorPicker( $( this ) );
                    } );
                } );
            });
        </script>

<?php }
// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	extract( $args );
if(isset($instance['title'])) :
	$title = apply_filters( 'widget_title', $instance['title'] );
endif;
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) ) {
echo $args['before_title'] . $title . $args['after_title'];
}

$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number ) {
			$number = 10;
		}

$title_lenth = ( ! empty( $instance['title_lenth'] ) ) ? absint( $instance['title_lenth'] ) : 30;
        if ( ! $title_lenth ) {
            $title_lenth = 30;
        }
$column = ( ! empty( $instance['column'] ) ) ? absint( $instance['column'] ) : 5;
        if ( ! $column ) {
            $column = 5;
        }               
$post_cat_color = ( ! empty( $instance['post_cat_color'] ) ) ? $instance['post_cat_color'] : '#8CC63F';
//$post_cat_color = isset($instance['post_cat_color']) ? absint($instance['post_cat_color']) : '#8CC63F';
$post_title_color = isset($instance['post_title_color']) ? absint($instance['post_title_color']) : '#121212';
$post_title_hover_color = isset($instance['post_title_hover_color']) ? absint($instance['post_title_hover_color']) : '#aedb49';
$post_meta_color = isset($instance['post_meta_color']) ? absint($instance['post_meta_color']) : '#555555';
$categories = isset($instance['categories']) ? absint( $instance['categories'] ) : '';
$show_date = isset($instance['show_date']) ? absint( $instance['show_date'] ) : 1;
$show_views = isset($instance['show_views']) ? absint( $instance['show_views'] ) : 1;


if ( ! empty($instance['orderby']) ) {
    $orderby     = $instance['orderby'];
    } else {
            $orderby     = 'latestpost';
        }


        if ( $orderby == 'popularposts' ) {
			$query = array(
				'posts_per_page' => $number,
				'order' => 'DESC',
				'nopaging' => false,
				'post_status' => 'publish',
				'meta_key' => 'post_views_count',
				'orderby' => 'meta_value_num',
				'ignore_sticky_posts' => true,
				'cat' => $categories
			);
        } else {
			$query = array(
				'posts_per_page' => $number,
				'order' => 'DESC',
				'nopaging' => false,
				'post_status' => 'publish',
				'ignore_sticky_posts' => true,
				'cat' => $categories
			);
        }		
	$args = new WP_Query($query);
	if ($args->have_posts()) :

	$pcc = $instance['post_cat_color'];
    $ptc = $instance['post_title_color'];
    $pthc = $instance['post_title_hover_color'];
	$ptm = $instance['post_meta_color'];
?>

<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12"> 
<div class="row"> 
<div id="<?php echo $this->id; ?>x" class="owl-carousel">
	<?php while ($args -> have_posts()) : $args -> the_post(); ?>
	<div class="item">

	<?php if ($thumbnail_exists = has_post_thumbnail()):  
        $id = get_the_ID();
        $cat = get_the_category($id); ?>
            <div class="pc-img">
            <a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php echo esc_attr( get_the_title() ); ?>"><img  src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(),'tx-c-thumb' )?>" alt="image" ></a>
            </div><!-- pc-img -->
        <?php endif; ?>
            <div class="pc-cat">
                <a href="<?php echo get_category_link($cat[0]->cat_ID); ?>" ><span style="background-color:<?php echo $pcc; ?>;"><?php echo $cat[0]->name; ?></span></a>
            </div><!-- pc-cat -->
            <div class="pc-title">
                <a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" style="color:<?php echo $ptc; ?>;" onMouseOver="this.style.color='<?php echo $pthc; ?>'" onMouseOut="this.style.color='<?php echo $ptc; ?>'" ><?php echo tx_title($title_lenth); ?></a>
            </div><!-- pc-title -->
            <div class="pc-meta" style="color:<?php echo $ptm; ?>;" >
			<?php if ( $show_date ) : ?>
				<span class="ptm"><?php do_action( 'tx_date'); ?></span>
			<?php endif; ?>
			<?php if ( $show_views ) : ?>
			<span class="ptm">
				<?php echo tx_getPostViews(get_the_ID()); ?>
			</span>
			<?php endif; ?>
	        </div><!-- pc-meta -->
		
	</div><!-- item -->

	<?php 
		endwhile;
		wp_reset_postdata();
	?>
</div><!-- owl-carousel -->
</div><!-- row -->
</div><!-- col-lg-12 -->
</div><!-- row -->
</div><!-- container -->

<script>
jQuery(document).ready(function($){var wid="#<?php echo $this->id; ?>";$(wid+'x').owlCarousel({loop:!0,margin:20,autoplay:!0,slideSpeed:200,paginationSpeed:300,autoplayTimeout:2000,autoplayHoverPause:!0,lazyLoad:!0,nav:!0,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsive:{0:{items:1},600:{items:2},768:{items:3},1000:{items:<?php echo $column;?>}}})})
</script>

<?php
endif;

print $after_widget;
} 

// Widget Backend 
public function form( $instance ) {

if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = esc_html__( 'Posts Carousel', 'avas-core' );
}
$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
$title_lenth = isset( $instance['title_lenth'] ) ? absint( $instance['title_lenth'] ) : 30;
$column = isset( $instance['column'] ) ? absint( $instance['column'] ) : 5;
$post_cat_color = ( ! empty( $instance['post_cat_color'] ) ) ? $instance['post_cat_color'] : '#8CC63F';
$post_title_color = ( ! empty( $instance['post_title_color'] ) ) ? $instance['post_title_color'] : '#121212';
$post_title_hover_color = ( ! empty( $instance['post_title_hover_color'] ) ) ? $instance['post_title_hover_color'] : '#AEDB49';
$post_meta_color = ( ! empty( $instance['post_meta_color'] ) ) ? $instance['post_meta_color'] : '#555555';
$show_date = isset($instance['show_date']) ? absint( $instance['show_date'] ) : 1;
$show_views = isset($instance['show_views']) ? absint( $instance['show_views'] ) : 1;
$defaults = array(
			'orderby' => 'latestpost',
			'categories' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'avas-core' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'avas-core' ); ?></label>
<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'title_lenth' ); ?>"><?php esc_html_e( 'Title Length', 'avas-core' ); ?></label>
<input class="tiny-text" id="<?php echo $this->get_field_id( 'title_lenth' ); ?>" name="<?php echo $this->get_field_name( 'title_lenth' ); ?>" type="number" step="1" min="1" value="<?php echo $title_lenth; ?>" size="3" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'column' ); ?>"><?php esc_html_e( 'Column', 'avas-core' ); ?></label>
<input class="tiny-text" id="<?php echo $this->get_field_id( 'column' ); ?>" name="<?php echo $this->get_field_name( 'column' ); ?>" type="number" step="1" min="1" value="<?php echo $column; ?>" size="3" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('Order By', 'avas-core'); ?></label>
    <?php
        $options = array(
                'latestpost' 	=> 'Latest Posts',
                'popularposts' 	=> 'Popular Posts',
        );
            if(isset($instance['orderby'])) $orderby = $instance['orderby'];
            ?>
            <select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
                <?php
                $op = '<option value="%s"%s>%s</option>';

                foreach ($options as $key=>$value ) {

                    if ($orderby === $key) {
                        printf($op, $key, ' selected="selected"', $value);
                    } else {
                        printf($op, $key, '', $value);
                    }
                }
                ?>
            </select>
</p>

<p>
			<label for="<?php print $this->get_field_id('categories'); ?>"><?php esc_html_e('Filter by Categories', 'avas-core'); ?></label>
			<select id="<?php print $this->get_field_id('categories'); ?>" name="<?php print $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php print $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php print $category->cat_name; ?></option>
				<?php } ?>
			</select>
</p>
<p>
            <label for="<?php echo $this->get_field_id( 'post_cat_color' ); ?>"><?php esc_html_e( 'Category color', 'avas-core' ); ?></label>
            <input class="tx-color-picker" type="text" id="<?php echo $this->get_field_id( 'post_cat_color' ); ?>" name="<?php echo $this->get_field_name( 'post_cat_color' ); ?>" value="<?php echo $post_cat_color; ?>" data-default-color="#8CC63F" />                            
</p>
<p>
            <label for="<?php echo $this->get_field_id( 'post_title_color' ); ?>"><?php esc_html_e( 'Title color', 'avas-core' ); ?></label>
            <input class="tx-color-picker" type="text" id="<?php echo $this->get_field_id( 'post_title_color' ); ?>" name="<?php echo $this->get_field_name( 'post_title_color' ); ?>" value="<?php echo esc_attr( $post_title_color ); ?>" data-default-color="#121212" />                            
</p>
<p>
            <label for="<?php echo $this->get_field_id( 'post_title_hover_color' ); ?>"><?php esc_html_e( 'Title hover color', 'avas-core' ); ?></label>
            <input class="tx-color-picker" type="text" id="<?php echo $this->get_field_id( 'post_title_hover_color' ); ?>" name="<?php echo $this->get_field_name( 'post_title_hover_color' ); ?>" value="<?php echo esc_attr( $post_title_hover_color ); ?>" data-default-color="#AEDB49" />                            
</p>
<p>
            <label for="<?php echo $this->get_field_id( 'post_meta_color' ); ?>"><?php esc_html_e( 'Post Meta Color', 'avas-core' ); ?></label>
            <input class="tx-color-picker" type="text" id="<?php echo $this->get_field_id( 'post_meta_color' ); ?>" name="<?php echo $this->get_field_name( 'post_meta_color' ); ?>" value="<?php echo esc_attr( $post_meta_color ); ?>" data-default-color="#555555" />                            
</p>
<p>
			<input type="checkbox" id="<?php echo $this->get_field_name( 'show_date' ); ?>" class="checkbox" name="<?php echo $this->get_field_name( 'show_date' ); ?>" <?php checked( $show_date, 1 ); ?> />
			<label for="<?php echo $this->get_field_name( 'show_date' ); ?>"><?php esc_html_e( 'Display post date','avas-core' ); ?></label>
</p>
<p>
			<input type="checkbox" id="<?php echo $this->get_field_name( 'show_views' ); ?>" class="checkbox" name="<?php echo $this->get_field_name( 'show_views' ); ?>" <?php checked( $show_views, 1 ); ?> />
			<label for="<?php echo $this->get_field_name( 'show_views' ); ?>"><?php esc_html_e( 'Display post views','avas-core' ); ?></label>
</p>

<?php 
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number'] = (int) $new_instance['number'];
$instance['title_lenth'] = (int) $new_instance['title_lenth'];
$instance['column'] = (int) $new_instance['column'];
$instance['categories']  = wp_strip_all_tags( $new_instance['categories'] );
$instance['orderby'] 		= strip_tags( $new_instance['orderby'] );
$instance['show_date'] = isset( $new_instance['show_date'] ) ? 1 : 0;
$instance['show_views'] = isset( $new_instance['show_views'] ) ? 1 : 0;
$instance[ 'post_cat_color' ] = strip_tags( $new_instance['post_cat_color'] );
$instance[ 'post_title_color' ] = strip_tags( $new_instance['post_title_color'] );
$instance[ 'post_title_hover_color' ] = strip_tags( $new_instance['post_title_hover_color'] );
$instance[ 'post_meta_color' ] = strip_tags( $new_instance['post_meta_color'] );

return $instance;
}
} // Class tx_posts_carousel_widget ends here
// Register and load the widget
function tx_posts_carousel_widget_load() {
	register_widget( 'tx_posts_carousel_widget' );
}
add_action( 'widgets_init', 'tx_posts_carousel_widget_load' );
/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 