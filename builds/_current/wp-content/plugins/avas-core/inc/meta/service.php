<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*/

/* ---------------------------------------------------------
   Brochure meta boxes for Service post type
------------------------------------------------------------ */
// Add a meta box
add_action( 'admin_menu', 'tx_service_meta_box_add' );
function tx_service_meta_box_add() {
    add_meta_box(
        'brochure',
        esc_html__( 'Brochure Details', 'avas-core' ),
        'tx_brochure_details',
        'service',
        'normal',
        'low' 
    );
}
 
// Meta Box HTML
function tx_brochure_details( $post ) {
    wp_nonce_field( 'tx_brochure_details_nonce', 'tx_brochure_details_nonce' );
    $brochure_title = get_post_meta( $post->ID, 'brochure_title', true );
    $brochure_desc = get_post_meta( $post->ID, 'brochure_desc', true );
    $brochure_img = get_post_meta( $post->ID, 'brochure_img', true );
    $brochure_file = get_post_meta( $post->ID, 'brochure_file', true );
    $form_shortcode = get_post_meta( $post->ID, 'form_shortcode', true );
    ?>
    
    <!-- Brochure Title -->
    <table class="tx_brochure_details brochure-title">
        <tbody>
            <tr>
                <th><?php esc_html_e('Brochure Title','avas-core'); ?></th>
                <td><input type="text" name="brochure_title" id="brochure_title" value="<?php echo esc_attr($brochure_title); ?>" placeholder="<?php echo esc_html__('Please enter title here ex: Our Brochure etc','avas-core') ?>" size="78" /></td>
            </tr>
        </tbody>
    </table><!-- /.brochure-title -->

    <!-- Brochure Description -->
    <table class="tx_brochure_details brochure-desc">
        <tbody>
            <tr>
                <th><?php esc_html_e('Brochure Description','avas-core'); ?></th>
                <td><textarea name="brochure_desc" id="brochure_desc" placeholder="<?php echo esc_html__('Please enter description here','avas-core') ?>" cols="73" ><?php echo esc_html($brochure_desc); ?></textarea></td>
                
            </tr>
        </tbody>
    </table><!-- /.brochure-desc -->

    <?php 
    // Brochure Image
    $brochure_img_id = get_post_meta(get_the_ID(), 'brochure_img', true);
    $brochure_img_url = wp_get_attachment_image_src( $brochure_img_id, 'tx-ms-size' );
    $brochure_image = isset($brochure_img_url[0]) ? $brochure_img_url[0] : '';
    ?>
    <div class="tx_brochure_details brochure-image">
        <?php if (!empty($brochure_image)) : ?>
        <p class="brochure_img_display"><img src="<?php echo esc_attr($brochure_image); ?>" /></p>
        <?php endif; ?>
        <p class="brochure_img_msg"><?php echo esc_html__('Please click Upload Image button to upload Brochure image.', 'avas-core'); ?></p>
        <a href="#" class="brochure_img button"><?php echo esc_html__('Upload Image', 'avas-core'); ?></a>
        <input type="hidden" name="brochure_img" id="brochure_img" value="<?php echo esc_attr($brochure_img); ?>" />
        <a href="#" class="brochure_img_remove button"><?php echo esc_html__('Remove Image', 'avas-core'); ?></a>
    </div><!-- /.brochure-image -->

    <?php
    // Brochure File
    $brochure_file_id = get_post_meta(get_the_ID(), 'brochure_file', true);
    $brochure_file_name = basename( get_attached_file( $brochure_file_id ) );
    ?>
    <div class="tx_brochure_details brochure-file">
        <?php if (!empty($brochure_file_name)) : ?>
        <h4 class="brochure_file_display"><?php echo esc_attr($brochure_file_name); ?></h4>
        <?php endif; ?>
        <p class="brochure_file_msg"><?php echo esc_html__('Please click Upload File button to upload Brochure file', 'avas-core'); ?></p>
        <a href="#" class="brochure_file button"><?php echo esc_html__('Upload File', 'avas-core'); ?></a>
        <input type="hidden" name="brochure_file" id="brochure_file" value="<?php echo esc_attr($brochure_file); ?>" />
        <a href="#" class="brochure_file_remove button"><?php echo esc_html__('Remove File','avas-core'); ?></a>
    </div><!-- /.brochure-file -->

    <!-- Form Shortcode -->
    <table class="tx_brochure_details form-shortcode">
        <tbody>
            <tr>
                <th><?php esc_html_e('Form Shortcode','avas-core'); ?></th>
                <td><input type="text" name="form_shortcode" id="tx_form_shortcode" value="<?php echo esc_attr($form_shortcode); ?>" placeholder="<?php echo esc_html__('Please enter shortcode here ex: Contact Form 7 shortcode etc','avas-core') ?>" size="75" /></td>
            </tr>
        </tbody>
    </table><!-- /.form-shortcode -->

<?php 
}


// Save Meta Box data
add_action('save_post', 'tx_brochure_save');
function tx_brochure_save( $post_id ) {
    if ( ! isset( $_POST['tx_brochure_details_nonce'] ) || ! wp_verify_nonce( $_POST['tx_brochure_details_nonce'], 'tx_brochure_details_nonce' ) ) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $brochure_title_data = isset( $_POST[ 'brochure_title' ] ) ? sanitize_text_field( $_POST[ 'brochure_title' ] ) : '';
    $brochure_desc_data = isset( $_POST[ 'brochure_desc' ] ) ? sanitize_text_field( $_POST[ 'brochure_desc' ] ) : '';
    $brochure_img_data = isset( $_POST[ 'brochure_img' ] ) ? sanitize_text_field( $_POST[ 'brochure_img' ] ) : '';
    $brochure_file_data = isset( $_POST[ 'brochure_file' ] ) ? sanitize_text_field( $_POST[ 'brochure_file' ] ) : '';
    $form_shortcode_data = isset( $_POST[ 'form_shortcode' ] ) ? sanitize_text_field( $_POST[ 'form_shortcode' ] ) : '';

    update_post_meta( $post_id, 'brochure_title', $brochure_title_data );
    update_post_meta( $post_id, 'brochure_desc', $brochure_desc_data );
    update_post_meta( $post_id, 'brochure_img', $brochure_img_data );
    update_post_meta( $post_id, 'brochure_file', $brochure_file_data );
    update_post_meta( $post_id, 'form_shortcode', $form_shortcode_data );

}

// Add Script to Backend
add_action( 'admin_enqueue_scripts', 'tx_brochure_enqueue_scripts');
function tx_brochure_enqueue_scripts( $brochure ) {
    $cpt = 'service';

    if( in_array($brochure, array('post.php', 'post-new.php') ) ) {
        $screen = get_current_screen();

        if( is_object( $screen ) && $cpt == $screen->post_type ) {
            wp_enqueue_script( 'brochure', TX_PLUGIN_URL . '/assets/js/brochure.min.js', array('jquery'), null, false );
        }
    }
}


/* ---------------------------------------------------------
   Services Template Settings
------------------------------------------------------------ */
add_action('add_meta_boxes', 'tx_services_settings');
function tx_services_settings()
{
    global $post;

     if(!empty($post))
     {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

         if($pageTemplate == 'templates/services.php' ) // display on services template only
         {
            add_meta_box(
                'tx_services_settings', // $id
                esc_html__('Services Settings','avas-core'), // $title
                'tx_services_settings_cb', // $callback
                'page', // $page
                'normal', // $context
                'high'); // $priority
         }
     }
}

function tx_services_settings_cb( $post ) {
wp_nonce_field( 'tx_services_settings_nonce', 'tx_services_settings_nonce' );

$item_per_page = get_post_meta( $post->ID, 'item_per_page', true );
$display = get_post_meta( $post->ID, 'display', true );
$title = get_post_meta( $post->ID, 'title', true );
$desc = get_post_meta( $post->ID, 'desc', true );
$link = get_post_meta( $post->ID, 'link', true );
$serv_category = get_post_meta( $post->ID, 'serv_category', true );
?>
   
  <div class="tx-portfolio-settings">
     
    
    <div>
        <p for="display"><?php echo esc_html_e('Display Type','avas-core'); ?></p>
        <select name="display" id="display">
          <option value="grid" <?php selected( $display, 'grid' ); ?>><?php echo esc_html_e('Grid','avas-core'); ?></option>
          <option value="overlay" <?php selected( $display, 'overlay' ); ?>><?php echo esc_html_e('Overlay','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="serv_category"><?php echo esc_html_e('Category(For Grid only)','avas-core'); ?></p>
        <select name="serv_category" id="serv_category">
          <option value="show" <?php selected( $serv_category, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $serv_category, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
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
        <p for="link"><?php echo esc_html_e('Link(For Overlay only)','avas-core'); ?></p>
        <select name="link" id="link">
          <option value="show" <?php selected( $link, 'show' ); ?>><?php echo esc_html_e('Show','avas-core'); ?></option>
          <option value="hide" <?php selected( $link, 'hide' ); ?>><?php echo esc_html_e('Hide','avas-core'); ?></option>
        </select>
    </div>
    <div>
        <p for="item_per_page"><?php echo esc_html_e('Item per page','avas-core'); ?></p>
        <input type="text" name="item_per_page" id="item_per_page" value="<?php echo $item_per_page; ?>" placeholder="<?php echo esc_html_e('Default 9. Enter -1 to show all','avas-core'); ?>" size="27" />

    </div>

<?php
}

add_action( 'save_post', 'tx_services_settings_save' );
function tx_services_settings_save( $post_id ) {

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['tx_services_settings_nonce'] ) || !wp_verify_nonce( $_POST['tx_services_settings_nonce'], 'tx_services_settings_nonce' ) ) return;
     
    // if our current user can't edit this page, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
$item_per_page_data = isset( $_POST[ 'item_per_page' ] ) ? sanitize_text_field( $_POST[ 'item_per_page' ] ) : '';
$display_data = isset( $_POST[ 'display' ] ) ? sanitize_text_field( $_POST[ 'display' ] ) : '';
$title_data = isset( $_POST[ 'title' ] ) ? sanitize_text_field( $_POST[ 'title' ] ) : '';
$desc_data = isset( $_POST[ 'desc' ] ) ? sanitize_text_field( $_POST[ 'desc' ] ) : '';
$link_data = isset( $_POST[ 'link' ] ) ? sanitize_text_field( $_POST[ 'link' ] ) : '';
$serv_category_data = isset( $_POST[ 'serv_category' ] ) ? sanitize_text_field( $_POST[ 'serv_category' ] ) : '';

update_post_meta( $post_id, 'item_per_page', $item_per_page_data );
update_post_meta( $post_id, 'display', $display_data );
update_post_meta( $post_id, 'title', $title_data );
update_post_meta( $post_id, 'desc', $desc_data );
update_post_meta( $post_id, 'link', $link_data );
update_post_meta( $post_id, 'serv_category', $serv_category_data );        

}
/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */