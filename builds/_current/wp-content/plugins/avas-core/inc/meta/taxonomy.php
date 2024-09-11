<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*/

// Add term page
function tx_taxonomy_add_new_meta_field() {

?>
	<div class="form-field">
		<label for="term_meta[tx_post_term_meta]"><?php esc_html_e( 'Template Style', 'avas-core' ); ?></label>
		<select name="term_meta[tx_post_term_meta]" id="term_meta[tx_post_term_meta]">
            <option value="style-1"><?php echo esc_html_e( 'Style One', 'avas-core' ); ?></option>
            <option value="style-2"><?php echo esc_html_e( 'Style Two', 'avas-core' ); ?></option>
            <option value="style-3"><?php echo esc_html_e( 'Style Three', 'avas-core' ); ?></option>
        </select>

	</div>
<?php
}
add_action( 'category_add_form_fields', 'tx_taxonomy_add_new_meta_field', 10, 2 );
add_action( 'post_tag_add_form_fields', 'tx_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function tx_taxonomy_edit_meta_field($term) {
	
	// put the term ID into a variable
	$t_id = $term->term_id;
	
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); 
	$selected = isset( $term_meta['tx_post_term_meta'] ) ? esc_attr( $term_meta['tx_post_term_meta'] ) : '';

	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[tx_post_term_meta]"><?php esc_html_e( 'Template Style', 'avas-core' ); ?></label></th>
		<td>
			<select name="term_meta[tx_post_term_meta]" id="term_meta[tx_post_term_meta]">
	            <option value="style-1" <?php selected( $selected, 'style-1' ); ?>><?php echo esc_html_e( 'Style One', 'avas-core' ); ?></option>
	            <option value="style-2" <?php selected( $selected, 'style-2' ); ?>><?php echo esc_html_e( 'Style Two', 'avas-core' ); ?></option>
	            <option value="style-3" <?php selected( $selected, 'style-3' ); ?>><?php echo esc_html_e( 'Style Three', 'avas-core' ); ?></option>
	        </select>
		</td>
	</tr>
		
<?php
}

add_action( 'category_edit_form_fields', 'tx_taxonomy_edit_meta_field', 10, 2 );
add_action( 'post_tag_edit_form_fields', 'tx_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function tx_save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}

		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_category', 'tx_save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_category', 'tx_save_taxonomy_custom_meta', 10, 2 );

add_action( 'create_term', 'tx_save_taxonomy_custom_meta', 10, 2 );
add_action( 'edited_term', 'tx_save_taxonomy_custom_meta', 10, 2 );

// EOF