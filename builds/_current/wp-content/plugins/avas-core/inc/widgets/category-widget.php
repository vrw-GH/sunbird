<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
*=====================================
* Category widget
*
**/

class tx_Categories_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'tx_categories_widget', 
		// Widget name will appear in UI
		esc_html__('Avas Categories', 'avas-core'), 
		// Widget description
		array( 'description' => esc_html__( 'A list or dropdown of categories.', 'avas-core' ), ) 
		);
	}
		
	public function widget( $args, $instance ) {
		static $first_dropdown = true;

		if(isset($instance['title'])) :
			$title = apply_filters( 'widget_title', $instance['title'] );
		endif;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		if ( ! empty($instance['post_type']) ) {
            $post_type     = $instance['post_type'];
        } else {
            $post_type     = 'post';
        }

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number ) {
			$number = 10;
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h,
			'taxonomy'    => $post_type,
			'number'    => $number,
		);

		if ( $d ) {
			echo sprintf( '<form action="%s" method="get">', esc_url( home_url() ) );
			$dropdown_id    = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
			$first_dropdown = false;

			echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';

			$cat_args['show_option_none'] = esc_html__( 'Select Category', 'avas-core' );
			$cat_args['id']               = $dropdown_id;

			/**
			 * Filters the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 * @since 4.9.0 Added the `$instance` parameter.
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 * @param array $instance Array of settings for the current widget.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args, $instance ) );

			echo '</form>';
			?>

	<script type='text/javascript'>
	/* <![CDATA[ */
	(function() {
		var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
		function onCatChange() {
			if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
				dropdown.parentNode.submit();
			}
		}
		dropdown.onchange = onCatChange;
	})();
	/* ]]> */
	</script>

			<?php
		} else {
			?>
		<ul>
			<?php
			$cat_args['title_li'] = '';
			wp_list_categories( apply_filters( 'widget_categories_args', $cat_args, $instance ) );
			?>
		</ul>
			<?php
		}

		echo $args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		//Defaults
		$instance     = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$count        = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown     = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10; 
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
		<p>
		<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php esc_html_e('Post Type', 'avas-core'); ?></label>
		    <?php
		        $options = array(
		                'category' 				=> 'Post',
		                'service-category' 		=> 'Service',
		                'portfolio-category' 	=> 'Portfolio',
		                'team-category' 		=> 'Team',
		                'course-category' 		=> 'Course',
		        );
		            if(isset($instance['post_type'])) $post_type = $instance['post_type'];
		            ?>
		            <select class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
		                <?php
		                $op = '<option value="%s"%s>%s</option>';

		                foreach ($options as $key=>$value ) {
							$post_type = [];
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
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of category to show:', 'avas-core' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show post counts' ); ?></label><br />

		</p>
		<?php
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['post_type'] 	  = strip_tags( $new_instance['post_type'] );
		$instance['count']        = ! empty( $new_instance['count'] ) ? 1 : 0;
		$instance['hierarchical'] = ! empty( $new_instance['hierarchical'] ) ? 1 : 0;
		$instance['dropdown']     = ! empty( $new_instance['dropdown'] ) ? 1 : 0;
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}
} // Class tx_recent_post_widget ends here
// Register and load the widget
function tx_category_load_widget() {
	register_widget( 'tx_Categories_Widget' );
}
add_action( 'widgets_init', 'tx_category_load_widget' );
/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 