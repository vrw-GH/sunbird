<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*/

/**
 * Custom mata box for Post format video etc
 */
function tx_post_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'tx_post_meta_box_id',
			esc_html__( 'Video Option', 'avas-core' ),
			'tx_post_plugin_meta_box_callback',
			$screen, 'side','low'
		);
	}
}
add_action( 'add_meta_boxes', 'tx_post_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function tx_post_plugin_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'tx_post_plugin_meta_box', 'tx_post_plugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$post_link = get_post_meta( $post->ID, 'post_link', true );

	echo '<label for="tx_post_new_field">';
	esc_html_e( 'Please enter Youtube video URL. You need to choose "Post Format as Video".', 'avas-core' );
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
function tx_post_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['tx_post_plugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['tx_post_plugin_meta_box_nonce'], 'tx_post_plugin_meta_box' ) ) {
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
	update_post_meta( $post_id, 'post_link', $my_data );
}
add_action( 'save_post', 'tx_post_save_meta_box_data' );

/* ============================================================
          EOF
============================================================ */