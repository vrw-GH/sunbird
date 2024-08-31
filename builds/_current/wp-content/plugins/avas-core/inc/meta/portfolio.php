<?php
/**
*
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*/

/* ---------------------------------------------------------
   Meta Boxes for Portfolio Single Page
------------------------------------------------------------ */ 

add_action('admin_init', 'tx_add_meta_boxes', 1);
function tx_add_meta_boxes() {
	add_meta_box( 
		'project-fields',
		esc_html__( 'Project Details', 'avas-core' ),
		'tx_project_details',
		'portfolio',
		'normal',
		'high'
	);
}

function tx_project_details($post) {
	wp_nonce_field( 'tx_project_tx_portfolio_settings_nonce', 'tx_project_tx_portfolio_settings_nonce' );
	$project_title = get_post_meta( $post->ID, 'project_title', true );
	$project_fields = get_post_meta($post->ID, 'project_fields', true);
	$project_completion_title = get_post_meta( $post->ID, 'project_completion_title', true );
	$completion = get_post_meta( $post->ID, 'completion', true );
	$web_url = get_post_meta( $post->ID, 'web_url', true );
	$btn_txt = get_post_meta( $post->ID, 'btn_txt', true );
	$btn_url = get_post_meta( $post->ID, 'btn_url', true );
	?>

	<script type="text/javascript">
	jQuery(document).ready(function($){
		$( '#add-row' ).on('click', function() {
			var row = $( '.empty-row.screen-reader-text' ).clone(true);
			row.removeClass( 'empty-row screen-reader-text' );
			row.insertBefore( '#project-fieldset-one tbody>tr:last' );
			return false;
		});
  	
		$( '.remove-row' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
	});
	</script>
	
	<table id="project-fieldset-one" class="tx_project_details_table">
		<tbody>
			<tr><th><?php esc_html_e('Project Title','avas-core'); ?></th></tr>
			<tr class="tx_pb_10">
				<td><input type="text" class="widefat" name="project_title" value="<?php echo esc_attr( $project_title ); ?>" size="50" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e('Name','avas-core'); ?></th>
				<th><?php esc_html_e('Details','avas-core'); ?></th>
			</tr>
		<?php
		if ( $project_fields ) :
		foreach ( $project_fields as $field ) { ?>
			<tr>
				<td><input type="text" class="widefat" name="name[]" value="<?php if($field['name'] != '') echo esc_attr( $field['name'] ); ?>" size="50" /></td>
				<td><input type="text" class="widefat" name="value[]" value="<?php if ($field['value'] != '') echo esc_attr( $field['value'] ); ?>" size="50" /></td>
				<td><a class="button remove-row" href="#"><?php esc_html_e('Remove','avas-core'); ?></a></td>
			</tr>
		<?php } else : ?>
			<tr>
				<td><input type="text" class="widefat" name="name[]" /></td>
				<td><input type="text" class="widefat" name="value[]" /></td>
				<td><a class="button remove-row" href="#"><?php esc_html_e('Remove','avas-core'); ?></a></td>
			</tr>
		<?php endif; ?>
			<tr class="empty-row screen-reader-text">
				<td><input type="text" class="widefat" name="name[]" /></td>
				<td><input type="text" class="widefat" name="value[]" /></td>
				<td><a class="button remove-row" href="#"><?php esc_html_e('Remove','avas-core'); ?></a></td>
			</tr>
			<tr><td><a id="add-row" class="button" href="#"><?php esc_html_e('Add New','avas-core'); ?></a>	</td></tr>
		</tbody>	
	</table>
	<table class="tx_project_details_table">
		<tbody>
			<tr>
				<th><?php esc_html_e('Project Completion Title','avas-core'); ?></th>
				<td><input type="text" name="project_completion_title" value="<?php echo esc_attr( $project_completion_title ); ?>" placeholder="<?php esc_html_e('Ex: Completion','avas-core'); ?>" size="42" /></td></tr>
			<tr>	<th><?php esc_html_e('Project Completion Percentage','avas-core'); ?></th>
				<td><input type="text" name="completion" value="<?php echo esc_attr( $completion ); ?>" placeholder="<?php esc_html_e('Ex: 75, do not enter %','avas-core'); ?>" size="42" /></td>
			</tr>
		</tbody>
	</table>
	<table class="tx_project_details_table">
		<tbody>
			<tr>
				<th><?php esc_html_e('Website URL','avas-core'); ?></th>
				<td><input type="text" name="web_url" value="<?php echo esc_attr( $web_url ); ?>" size="60" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e('Button Text','avas-core'); ?></th>
				<td><input type="text" name="btn_txt" value="<?php echo esc_attr( $btn_txt ); ?>" size="60" /></td>
			</tr>
			<tr>
				<th><?php esc_html_e('Button URL','avas-core'); ?></th>
				<td><input type="text" name="btn_url" value="<?php echo esc_attr( $btn_url ); ?>" size="60" /></td>
			</tr>
		</tbody>
	</table>

<?php }

add_action('save_post', 'tx_project_meta_box_save');
function tx_project_meta_box_save($post_id) {
	if ( ! isset( $_POST['tx_project_tx_portfolio_settings_nonce'] ) || ! wp_verify_nonce( $_POST['tx_project_tx_portfolio_settings_nonce'], 'tx_project_tx_portfolio_settings_nonce' ) ) {
		return;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	$project_completion_title_data = isset( $_POST[ 'project_completion_title' ] ) ? sanitize_text_field( $_POST[ 'project_completion_title' ] ) : '';
	$completion_data = isset( $_POST[ 'completion' ] ) ? sanitize_text_field( $_POST[ 'completion' ] ) : '';
	$project_title_data = isset( $_POST[ 'project_title' ] ) ? sanitize_text_field( $_POST[ 'project_title' ] ) : '';
	$web_url_data = isset( $_POST[ 'web_url' ] ) ? sanitize_text_field( $_POST[ 'web_url' ] ) : '';
	$btn_txt_data = isset( $_POST[ 'btn_txt' ] ) ? sanitize_text_field( $_POST[ 'btn_txt' ] ) : '';
	$btn_url_data = isset( $_POST[ 'btn_url' ] ) ? sanitize_text_field( $_POST[ 'btn_url' ] ) : '';
	update_post_meta( $post_id, 'completion', $completion_data );
	update_post_meta( $post_id, 'project_completion_title', $project_completion_title_data );
	update_post_meta( $post_id, 'project_title', $project_title_data );
	update_post_meta( $post_id, 'web_url', $web_url_data );
	update_post_meta( $post_id, 'btn_txt', $btn_txt_data );
	update_post_meta( $post_id, 'btn_url', $btn_url_data );

	$old = get_post_meta($post_id, 'project_fields', true);
	$new = array();
	$names = $_POST['name'];
	$values = $_POST['value'];
	$count = count( $names );

	for ( $i = 0; $i < $count; $i++ ) {
		if ( $names[$i] != '' ) :
			$new[$i]['name'] = stripslashes( strip_tags( $names[$i] ) );
		
			if ( $values[$i] == '' )
				$new[$i]['value'] = '';
			else
				$new[$i]['value'] = stripslashes( $values[$i] );
		endif;
	}
	if ( !empty( $new ) && $new != $old ) {
		update_post_meta( $post_id, 'project_fields', $new );
	}
	elseif ( empty($new) && $old ) {
		delete_post_meta( $post_id, 'project_fields', $old );
	}

}


/* ---------------------------------------------------------
  Portfolio meta
------------------------------------------------------------ */
function tx_portfolio_meta() { 
  global $tx; ?>
    <div class="portfolio-meta">
	  	<?php if ($tx['portfolio-time']) : ?>
	    <div class="portfolio-time">
	    	<span><h5><i class="bi bi-clock"></i> <?php echo esc_html__('Created Date','avas-core'); ?></h5></span>
	    	<?php the_time('F j, Y'); ?>
	    </div>
  		<?php endif;
  		if ($tx['portfolio-author']) : ?>
    	<div class="portfolio-author">
    		<span><h5><i class="bi bi-person-circle"></i>  <?php echo esc_html__('Created By','avas-core'); ?></h5></span>
    		<?php the_author_meta('display_name'); ?>
    	</div>
  		<?php endif;
	  	global $post;
	 	$web_url = get_post_meta( $post->ID, 'web_url', true );
	 	$btn_txt = get_post_meta( $post->ID, 'btn_txt', true );
	 	$btn_url = get_post_meta( $post->ID, 'btn_url', true );
	 	if(!empty($web_url)) : ?>
	  		<div class="portfolio-web">
	    		<span><h5><i class="bi bi-globe"></i> <?php echo esc_html__('Website','avas-core'); ?></h5></span>
	   			<a href="<?php echo esc_url($web_url); ?>" target="_blank"><?php echo esc_html__('Click to visit','avas-core');?></a>
	    	</div>
  		<?php endif;
  		if( !empty($btn_txt) || !empty($btn_url) ) : ?>
  			<a class="tx-single-portfolio-btn" href="<?php echo esc_url($btn_url); ?>"><?php echo esc_html($btn_txt);?></a>
  		<?php endif; ?>
    </div>

<?php }

/* ---------------------------------------------------------
  Custom mata box for video
------------------------------------------------------------ */
add_action( 'add_meta_boxes', 'tx_portfolio_add_meta_box_video' );
function tx_portfolio_add_meta_box_video() {

	$screens = array( 'portfolio' );

		add_meta_box(
			'tx_portfolio_meta_box_vid_id',
			esc_html__( 'Video option', 'avas-core' ),
			'tx_portfolio_meta_box_vid_callback',
			'portfolio', 'side','low'
		);

}

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function tx_portfolio_meta_box_vid_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'tx_portfolio_vid_meta_box', 'tx_portfolio_vid_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$post_link = get_post_meta( $post->ID, 'port_vid_link', true );

	echo '<label for="tx_post_new_field">';
	esc_html_e( 'Please enter Youtube video URL. (Video will not show if you set the portoflio template as "Full Screen".)', 'avas-core' );
	echo '</label> ';
	echo '<br><br>';
	echo '<input placeholder="Example: https://youtu.be/8fLNkMZYlSw" type="text" id="tx_post_new_field" name="tx_post_new_field" value="' . esc_attr( $post_link ) . '" size="30" />';
	echo '<br>';
	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function tx_portfolio_vid_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['tx_portfolio_vid_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['tx_portfolio_vid_meta_box_nonce'], 'tx_portfolio_vid_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['tx_post_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['tx_post_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'port_vid_link', $my_data );
}
add_action( 'save_post', 'tx_portfolio_vid_save_meta_box_data' );


/* ---------------------------------------------------------
   Portfolio Template Settings
------------------------------------------------------------ */
add_action('add_meta_boxes', 'tx_portfolio_settings');
function tx_portfolio_settings()
{
    global $post;

     if(!empty($post))
     {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

         if($pageTemplate == 'templates/portfolio.php' ) // display on portfolio template only
         {
            add_meta_box(
                'tx_portfolio_settings', // $id
                esc_html__('Portfolio Settings','avas'), // $title
                'tx_portfolio_settings_cb', // $callback
                'page', // $page
                'normal', // $context
                'high'); // $priority
         }
     }
}

function tx_portfolio_settings_cb( $post ) {
wp_nonce_field( 'tx_portfolio_settings_nonce', 'tx_portfolio_settings_nonce' );

$gutter = get_post_meta( $post->ID, 'gutter', true );
$item_per_page = get_post_meta( $post->ID, 'item_per_page', true );
$portfolio_layout = get_post_meta( $post->ID, 'portfolio_layout', true );
$portfolio_filter = get_post_meta( $post->ID, 'portfolio_filter', true );
$columns = get_post_meta( $post->ID, 'columns', true );
$display = get_post_meta( $post->ID, 'display', true );
$popup = get_post_meta( $post->ID, 'popup', true );
$title = get_post_meta( $post->ID, 'title', true );
$desc = get_post_meta( $post->ID, 'desc', true );
$link = get_post_meta( $post->ID, 'link', true );
$enlarge = get_post_meta( $post->ID, 'enlarge', true );
$port_category = get_post_meta( $post->ID, 'port_category', true );
$hover_effects = get_post_meta( $post->ID, 'hover_effects', true );
?>
   
  <div class="tx-portfolio-settings">
    <div>
        <p for="portfolio_layout"><?php echo esc_html_e('Layout','avas-core'); ?></p>
        <select name="portfolio_layout" id="portfolio_layout">
            <option value="" <?php selected( $portfolio_layout, '' ); ?>><?php echo esc_html_e('Boxed','avas-core'); ?></option>
            <option value="-fluid" <?php selected( $portfolio_layout, '-fluid' ); ?>><?php echo esc_html_e('Full Width','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="portfolio_filter"><?php echo esc_html_e('Filter','avas-core'); ?></p>
        <select name="portfolio_filter" id="portfolio_filter">
            <option value="yes" <?php selected( $portfolio_filter, 'yes' ); ?>><?php echo esc_html_e('Enable','avas-core'); ?></option>
            <option value="no" <?php selected( $portfolio_filter, 'no' ); ?>><?php echo esc_html_e('Disable','avas-core'); ?></option>
        </select>
    </div>  
    <div>
        <p for="columns"><?php echo esc_html_e('Columns','avas-core'); ?></p>
        <select name="columns" id="columns">
          <option value="4" <?php selected( $columns, '4' ); ?>><?php echo esc_html_e('Three','avas-core'); ?></option>
          <option value="3" <?php selected( $columns, '3' ); ?>><?php echo esc_html_e('Four','avas-core'); ?></option>
          <option value="2" <?php selected( $columns, '2' ); ?>><?php echo esc_html_e('Six','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="display"><?php echo esc_html_e('Display Type','avas-core'); ?></p>
        <select name="display" id="display">
          <option value="masonry" <?php selected( $display, 'masonry' ); ?>><?php echo esc_html_e('Masonry','avas-core'); ?></option>
          <option value="grid-h" <?php selected( $display, 'grid-h' ); ?>><?php echo esc_html_e('Grid Horizontal','avas-core'); ?></option>
          <option value="grid-v" <?php selected( $display, 'grid-v' ); ?>><?php echo esc_html_e('Grid Vertical','avas-core'); ?></option>
          <option value="card-h" <?php selected( $display, 'card-h' ); ?>><?php echo esc_html_e('Card Horizontal','avas-core'); ?></option>
          <option value="card-v" <?php selected( $display, 'card-v' ); ?>><?php echo esc_html_e('Card Vertical','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="port_category"><?php echo esc_html_e('Category','avas-core'); ?></p>
        <select name="port_category" id="port_category">
          <option value="show" <?php selected( $port_category, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $port_category, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="title"><?php echo esc_html_e('Title','avas-core'); ?></p>
        <select name="title" id="title">
          <option value="show" <?php selected( $title, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $title, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="desc"><?php echo esc_html_e('Excerpt','avas-core'); ?></p>
        <select name="desc" id="desc">
          <option value="show" <?php selected( $desc, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $desc, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="enlarge"><?php echo esc_html_e('Enlarge','avas-core'); ?></p>
        <select name="enlarge" id="enlarge">
          <option value="show" <?php selected( $enlarge, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $enlarge, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="link"><?php echo esc_html_e('Link','avas-core'); ?></p>
        <select name="link" id="link">
          <option value="show" <?php selected( $link, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $link, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="popup"><?php echo esc_html_e('Popup','avas-core'); ?></p>
        <select name="popup" id="popup">
          <option value="no-content" <?php selected( $popup, 'no-content' ); ?>><?php echo esc_html_e('Without Content','avas-core'); ?></option>
          <option value="content" <?php selected( $popup, 'content' ); ?>><?php echo esc_html_e('With Content','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="gutter"><?php echo esc_html_e('Gutter','avas-core'); ?></p>
        <input type="text" name="gutter" id="gutter" value="<?php echo $gutter; ?>" placeholder="<?php echo esc_html_e('Number only, Example: 20','avas-core'); ?>" size="27" />

    </div>
    <div>
        <p for="item_per_page"><?php echo esc_html_e('Item per page','avas-core'); ?></p>
        <input type="text" name="item_per_page" id="item_per_page" value="<?php echo $item_per_page; ?>" placeholder="<?php echo esc_html_e('Default 12. Enter -1 to show all','avas-core'); ?>" size="27" />

    </div>
    <div>
        <p for="link"><?php echo esc_html_e('Hover Effects','avas-core'); ?></p>
        <select name="hover_effects" id="hover_effects">
          <option value="effects-1" <?php selected( $hover_effects, 'effects-1' ); ?>><?php echo esc_html_e('Effect 1','avas-core'); ?></option>
          <option value="effects-2" <?php selected( $hover_effects, 'effects-2' ); ?>><?php echo esc_html_e('Effect 2','avas-core'); ?></option>
          <option value="effects-3" <?php selected( $hover_effects, 'effects-3' ); ?>><?php echo esc_html_e('Effect 3','avas-core'); ?></option>
          <option value="effects-4" <?php selected( $hover_effects, 'effects-4' ); ?>><?php echo esc_html_e('Effect 4','avas-core'); ?></option>
          <option value="effects-0" <?php selected( $hover_effects, 'effects-0' ); ?>><?php echo esc_html_e('No Effect','avas-core'); ?></option>
        </select>
    </div>

<?php
}

add_action( 'save_post', 'tx_portfolio_settings_save' );
function tx_portfolio_settings_save( $post_id ) {

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['tx_portfolio_settings_nonce'] ) || !wp_verify_nonce( $_POST['tx_portfolio_settings_nonce'], 'tx_portfolio_settings_nonce' ) ) return;
     
    // if our current user can't edit this page, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
$gutter_data = isset( $_POST[ 'gutter' ] ) ? sanitize_text_field( $_POST[ 'gutter' ] ) : '';
$item_per_page_data = isset( $_POST[ 'item_per_page' ] ) ? sanitize_text_field( $_POST[ 'item_per_page' ] ) : '';
$portfolio_layout_data = isset( $_POST[ 'portfolio_layout' ] ) ? sanitize_text_field( $_POST[ 'portfolio_layout' ] ) : '';
$portfolio_filter_data = isset( $_POST[ 'portfolio_filter' ] ) ? sanitize_text_field( $_POST[ 'portfolio_filter' ] ) : '';
$columns_data = isset( $_POST[ 'columns' ] ) ? sanitize_text_field( $_POST[ 'columns' ] ) : '';
$display_data = isset( $_POST[ 'display' ] ) ? sanitize_text_field( $_POST[ 'display' ] ) : '';
$popup_data = isset( $_POST[ 'popup' ] ) ? sanitize_text_field( $_POST[ 'popup' ] ) : '';
$title_data = isset( $_POST[ 'title' ] ) ? sanitize_text_field( $_POST[ 'title' ] ) : '';
$desc_data = isset( $_POST[ 'desc' ] ) ? sanitize_text_field( $_POST[ 'desc' ] ) : '';
$link_data = isset( $_POST[ 'link' ] ) ? sanitize_text_field( $_POST[ 'link' ] ) : '';
$enlarge_data = isset( $_POST[ 'enlarge' ] ) ? sanitize_text_field( $_POST[ 'enlarge' ] ) : '';
$port_category_data = isset( $_POST[ 'port_category' ] ) ? sanitize_text_field( $_POST[ 'port_category' ] ) : '';
$hover_effects_data = isset( $_POST[ 'hover_effects' ] ) ? sanitize_text_field( $_POST[ 'hover_effects' ] ) : '';

update_post_meta( $post_id, 'gutter', $gutter_data );
update_post_meta( $post_id, 'item_per_page', $item_per_page_data );
update_post_meta( $post_id, 'portfolio_layout', $portfolio_layout_data );
update_post_meta( $post_id, 'portfolio_filter', $portfolio_filter_data );
update_post_meta( $post_id, 'columns', $columns_data );
update_post_meta( $post_id, 'display', $display_data );
update_post_meta( $post_id, 'popup', $popup_data );
update_post_meta( $post_id, 'title', $title_data );
update_post_meta( $post_id, 'desc', $desc_data );
update_post_meta( $post_id, 'link', $link_data );
update_post_meta( $post_id, 'enlarge', $enlarge_data );
update_post_meta( $post_id, 'port_category', $port_category_data );   
update_post_meta( $post_id, 'hover_effects', $hover_effects_data );   

}

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */