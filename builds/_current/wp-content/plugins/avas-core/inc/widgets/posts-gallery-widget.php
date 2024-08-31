<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
*=====================================
* Posts Gallery widget.
*/
class tx_posts_gallery_widget extends WP_Widget {
function __construct() {
parent::__construct(
// Base ID of your widget
'tx_posts_gallery_widget', 
// Widget name will appear in UI
esc_html__('Avas Posts Gallery', 'avas-core'), 
// Widget description
array( 'description' => esc_html__( 'Display posts thumbnail gallery.', 'avas-core' ), ) 
);
}
// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;
		if ( ! $number )
			$number = 6;

		if ( ! empty($instance['post_type']) ) {
            $post_type     = $instance['post_type'];
        } else {
            $post_type     = 'post';
        }

        if ( ! empty($instance['orderby']) ) {
            $orderby     = $instance['orderby'];
        } else {
            $orderby     = 'date';
        }
?>

	<?php $the_query = new WP_Query( apply_filters( 'widget_posts_args', array(
				'post_type' 		  => $post_type,
				'posts_per_page'      => $number,
				'nopaging' 			  => false,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
				'order' 			  => 'DESC',
				'orderby'		  	  => $orderby
			) ) );
	 ?>
    <div class="tx-posts-gallery"> 
    	<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
    	<div class="recent_project_widget">
    		<div class="rprojw_thumb"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('tx-s-thumb'); ?></a></div>
    		
    	</div>
    	<?php 
    		endwhile;
    		wp_reset_postdata();
    	?>
    </div><!-- tx-posts-gallery -->

<?php
echo $args['after_widget'];
}
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = esc_html__( 'Posts Gallery', 'avas-core' );
}
$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6; 
$defaults = array(
			'post_type'	=> 'post',
			'orderby'	=> 'date'
		);
$instance = wp_parse_args( (array) $instance, $defaults );


?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'avas-core' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of project to show:', 'avas-core' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
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
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('Order By', 'avas-core'); ?></label>
    <?php
        $options = array(
        		'date' 				=> 'Date',
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
<?php 
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] 			= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number'] 		= (int) $new_instance['number'];
$instance['post_type'] 		= strip_tags( $new_instance['post_type'] );
$instance['orderby'] 		= strip_tags( $new_instance['orderby'] );
return $instance;
}
} // Class tx_posts_gallery_widget ends here
// Register and load the widget
function tx_posts_gallery_load_widget() {
	register_widget( 'tx_posts_gallery_widget' );
}
add_action( 'widgets_init', 'tx_posts_gallery_load_widget' );
/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 