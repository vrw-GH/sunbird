<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
*=====================================
* Recent posts widget
*
**/

class tx_Recent_Post_Widget extends WP_Widget {
function __construct() {
parent::__construct(
// Base ID of your widget
'tx_recent_post_widget', 
// Widget name will appear in UI
esc_html__('Avas Recent Posts', 'avas-core'), 
// Widget description
array( 'description' => esc_html__( 'Display recent/popular posts with thumbnail.', 'avas-core' ), ) 
);
		// This is where we add the style and script
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
// This is where we add the style and script
 //   add_action( 'load-widgets.php', array(&$this, 'tx_color_picker') );
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
					widget.find( '.color-picker' ).wpColorPicker( {
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
					$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
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

$title_color = ( ! empty( $instance['title_color'] ) ) ? $instance['title_color'] : '#121212';
$title_hover_color = ( ! empty( $instance['title_hover_color'] ) ) ? $instance['title_hover_color'] : '#aedb49';
$meta_color = ( ! empty( $instance['meta_color'] ) ) ? $instance['meta_color'] : '#555555';


// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) ) {
echo $args['before_title'] . $title . $args['after_title'];
}

$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
$title_lenth = ( ! empty( $instance['title_lenth'] ) ) ? absint( $instance['title_lenth'] ) : 30;
        if ( ! $title_lenth ) {
            $title_lenth = 30;
        }
$categories = isset($instance['categories']) ? absint( $instance['categories'] ) : '';
$show_date = isset($instance['show_date']) ? absint( $instance['show_date'] ) : 1;
$show_views = isset($instance['show_views']) ? absint( $instance['show_views'] ) : 1;

if ( ! empty($instance['post_type']) ) {
            $post_type     = $instance['post_type'];
        } else {
            $post_type     = 'post';
        }


if ( ! empty($instance['orderby']) ) {
            $orderby     = $instance['orderby'];
        } else {
            $orderby     = 'latestpost';
        }



if ( $orderby == 'popularposts' ) {
	$query = array(
		'post_type' 		  => $post_type,
		'posts_per_page' 	  => $number,
		'order' 			  => 'DESC',
		'nopaging' 			  => false,
		'post_status' 		  => 'publish',
		'meta_key' 			  => 'post_views_count',
		'orderby' 			  => 'meta_value_num',
		'ignore_sticky_posts' => true,
		'cat' 				  => $categories
		);

} else {
	$query = array(
		'post_type' 		  => $post_type,
		'posts_per_page' 	  => $number,
		'order' 			  => 'DESC',
		'nopaging' 			  => false,
		'post_status'		  => 'publish',
		'ignore_sticky_posts' => true,
		'cat' 				  => $categories,
		'orderby'			  => $orderby
		);
	}

	$args = new WP_Query($query);
	if ($args->have_posts()) :
?>

<div class="rpbl">
	<?php while ($args -> have_posts()) : $args -> the_post(); ?>
	<div class="rpost">
		<div class="rpthumb"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('tx-s-thumb'); ?></a></div>
		<div class="rpt"><a class="post-title-color" style="color:<?php echo $title_color; ?>;" onMouseOver="this.style.color='<?php echo $title_hover_color; ?>'" onMouseOut="this.style.color='<?php echo $title_color; ?>'" href="<?php the_permalink() ?>"><?php echo tx_title($title_lenth); ?></a>
			<span class="clearfix"></span>
			<span style="color:<?php echo $meta_color; ?>;">
			<?php if ( $show_date ) : ?>
				<span class="rpd ptm"><?php the_time('d M y'); ?></span>
			<?php endif; ?>
			<?php if ( $show_views ) : ?>
				<span class="ptm">
					<?php echo tx_getPostViews(get_the_ID()); ?>
				</span>
			<?php endif; ?>
			</span>
		</div>
	</div>
	<?php 
		endwhile;

		wp_reset_postdata();
	?>
</div>

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
$title = esc_html__( 'Recent posts', 'avas-core' );
}


$title_color = ( ! empty( $instance['title_color'] ) ) ? $instance['title_color'] : '#121212';
$title_hover_color = ( ! empty( $instance['title_hover_color'] ) ) ? $instance['title_hover_color'] : '#aedb49';
$meta_color = ( ! empty( $instance['meta_color'] ) ) ? $instance['meta_color'] : '#555555';

$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5; 
$title_lenth = isset( $instance['title_lenth'] ) ? absint( $instance['title_lenth'] ) : 30;
$show_date = isset($instance['show_date']) ? absint( $instance['show_date'] ) : 1;
$show_views = isset($instance['show_views']) ? absint( $instance['show_views'] ) : 1;
$defaults = array(
			'post_type'	=> 'post',
			'orderby' => 'latestpost',
			'categories' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'avas-core' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'avas-core' ); ?></label>
<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'title_lenth' ); ?>"><?php esc_html_e( 'Title Length:', 'avas-core' ); ?></label>
<input class="tiny-text" id="<?php echo $this->get_field_id( 'title_lenth' ); ?>" name="<?php echo $this->get_field_name( 'title_lenth' ); ?>" type="number" step="1" min="1" value="<?php echo $title_lenth; ?>" size="3" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php esc_html_e('Post Type', 'avas-core'); ?></label>
    <?php
       $options = get_post_types( array( 'public'  => true ) );
        $exclude_cpts = array( 'elementor_library', 'attachment', 'lp_lesson', 'lp_question', 'lp_quiz', 'give_forms' );
        
        foreach ( $exclude_cpts as $exclude_cpt ) :
            unset($options[$exclude_cpt]);
        endforeach;
        
            if(isset($instance['post_type'])) $post_type = $instance['post_type'];
            ?>
            <select class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
                <?php
                $op = '<option value="%s"%s>%s</option>';

                foreach ($options as $key=>$value ) {

                    if ($post_type === $key) {
                        printf($op, $key, ' selected="selected"', $value);
                    } else {
                        printf($op, $key, '', $value);
                    }
                }
                ?>
            </select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('Order By (Popular Posts will not work for custom post type)', 'avas-core'); ?></label>
    <?php
        $options = array(
                'latestpost' 		=> 'Latest Posts',
                'popularposts' 		=> 'Popular Posts',
                'rand' 				=> 'Random',
                'title' 			=> 'Title',
                'id' 				=> 'ID',
                'name' 				=> 'Slug',
                'menu_order' 		=> 'Menu Order',
                'comment_count' 	=> 'Comment Count',
                'none' 				=> 'None',
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
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories','avas-core'); ?></option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php print $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php print $category->cat_name; ?></option>
				<?php } ?>
			</select>
</p>

<p>
			<input type="checkbox" id="<?php echo $this->get_field_name( 'show_date' ); ?>" class="checkbox" name="<?php echo $this->get_field_name( 'show_date' ); ?>" <?php checked( $show_date, 1 ); ?> />
			<label for="<?php echo $this->get_field_name( 'show_date' ); ?>"><?php esc_html_e( 'Display post date','avas-core' ); ?></label>
</p>
<p>
			<input type="checkbox" id="<?php echo $this->get_field_name( 'show_views' ); ?>" class="checkbox" name="<?php echo $this->get_field_name( 'show_views' ); ?>" <?php checked( $show_views, 1 ); ?> />
			<label for="<?php echo $this->get_field_name( 'show_views' ); ?>"><?php esc_html_e( 'Display post views (Will not work for custom post type)','avas-core' ); ?></label>
</p>
<p>
			<label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e( 'Title color' ); ?></label><br>
			<input type="text" name="<?php echo $this->get_field_name( 'title_color' ); ?>" class="color-picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" value="<?php echo $title_color; ?>" data-default-color="#121212" />
</p>
<p>
			<label for="<?php echo $this->get_field_id( 'title_hover_color' ); ?>"><?php _e( 'Title hover color' ); ?></label><br>
			<input type="text" name="<?php echo $this->get_field_name( 'title_hover_color' ); ?>" class="color-picker" id="<?php echo $this->get_field_id( 'title_hover_color' ); ?>" value="<?php echo $title_hover_color; ?>" data-default-color="#aedb49" />
</p>
<p>
			<label for="<?php echo $this->get_field_id( 'meta_color' ); ?>"><?php _e( 'Meta color' ); ?></label><br>
			<input type="text" name="<?php echo $this->get_field_name( 'meta_color' ); ?>" class="color-picker" id="<?php echo $this->get_field_id( 'meta_color' ); ?>" value="<?php echo $meta_color; ?>" data-default-color="#555555" />
</p>
<?php 
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number'] = (int) $new_instance['number'];
$instance['title_lenth'] = (int) $new_instance['title_lenth'];
$instance['categories']  = wp_strip_all_tags( $new_instance['categories'] );
$instance['orderby'] 		= strip_tags( $new_instance['orderby'] );
$instance['post_type'] 		= strip_tags( $new_instance['post_type'] );
$instance['show_date'] = isset( $new_instance['show_date'] ) ? 1 : 0;
$instance['show_views'] = isset( $new_instance['show_views'] ) ? 1 : 0;
$instance[ 'title_color' ] = strip_tags( $new_instance['title_color'] );
$instance[ 'title_hover_color' ] = strip_tags( $new_instance['title_hover_color'] );
$instance[ 'meta_color' ] = strip_tags( $new_instance['meta_color'] );
return $instance;
}
} // Class tx_recent_post_widget ends here
// Register and load the widget
function tx_recent_post_load_widget() {
	register_widget( 'tx_Recent_Post_Widget' );
}
add_action( 'widgets_init', 'tx_recent_post_load_widget' );
/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 