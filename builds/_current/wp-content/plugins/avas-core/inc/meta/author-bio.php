<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*
* Author bio
*/


// add cuser custom field

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
   
    <table class="form-table">
        <tr>
            <th><label for="age"><?php esc_html_e('Age','avas-core'); ?></label></th>
            <td>
                <input type="text" name="age" id="age" value="<?php echo esc_attr( get_the_author_meta( 'age', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="tx-author-age"><?php esc_html_e('Please enter your age','avas-core'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="gender"><?php esc_html_e('Gender','avas-core'); ?></label></th>
            <td>
                <input type="text" name="gender" id="gender" value="<?php echo esc_attr( get_the_author_meta( 'gender', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="tx-author-gender"><?php esc_html_e('Please enter your gender','avas-core'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="address"><?php esc_html_e('Address','avas-core'); ?></label></th>
            <td>
                <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your address','avas-core'); ?></span>
            </td>
        </tr>
    </table>
    <table class="form-table">
        <h3><?php esc_html_e( 'Social Profile', 'avas-core' ); ?></h3>
    <tr>
        <th><label for="facebook"><?php esc_html_e('Facebook','avas-core'); ?></label></th>
        <td>
            <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e('Please enter your Facebook url','avas-core'); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="twitter"><?php esc_html_e('Twitter','avas-core'); ?></label></th>
        <td>
            <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e('Please enter your Twitter url','avas-core'); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="linkedin"><?php esc_html_e('LinkedIn','avas-core'); ?></label></th>
        <td>
            <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e('Please enter your LinkedIn url.','avas-core'); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="instagram"><?php esc_html_e('Instagram','avas-core'); ?></label></th>
        <td>
            <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e('Please enter your Instagram url','avas-core'); ?></span>
        </td>
    </tr>
    
    </table>
<?php }


add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'age', $_POST['age'] );
    update_user_meta( $user_id, 'gender', $_POST['gender'] );
    update_user_meta( $user_id, 'address', $_POST['address'] );
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
    update_user_meta( $user_id, 'instagram', $_POST['instagram'] );

}


/* Adding Image Upload Fields */
add_action( 'show_user_profile', 'tx_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'tx_show_extra_profile_fields' );

function tx_show_extra_profile_fields( $user ) 
{ 

?>
    <style type="text/css">
        .fh-profile-upload-options th,
        .fh-profile-upload-options td,
        .fh-profile-upload-options input {
            vertical-align: top;
        }

        .tx-user-preview-image {
            display: block;
            height: auto;
            width: 250px;
            margin: 15px;
        }
        .user-profile-picture{display: none}
    </style>

    <table class="form-table fh-profile-upload-options">
        <tr>
            <th>
                <label for="image"><?php echo esc_html__('Profile Image', 'avas-core'); ?></label>
            </th>

            <td>
                <img class="tx-user-preview-image" src="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>">

                <input type="text" name="image" id="image" value="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>" class="regular-text" />
                <input type='button' class="button-primary" value="Upload Image" id="uploadimage"/><br />
                <span class="description"><?php echo esc_html__('Please upload an image for your profile.', 'avas-core'); ?></span>
            </td>
        </tr>

    </table>

    <script type="text/javascript">
        (function( $ ) {
            $( '#uploadimage' ).on( 'click', function() {
                tb_show('Profile Image', '<?php echo esc_url(admin_url("media-upload.php?type=image&TB_iframe=1")); ?>' );

                window.send_to_editor = function( html ) 
                {
                    imgurl = $( 'img',html ).attr( 'src' );
                    $( '#image' ).val(imgurl);
                    tb_remove();
                }

                return false;
            });


        })(jQuery);
    </script>

<?php 

}

add_action( 'admin_enqueue_scripts', 'tx_author_enqueue_admin' );
add_action( 'bbp_user_edit_after_about', 'tx_author_enqueue_admin' );
function tx_author_enqueue_admin()
{
    wp_enqueue_script( 'thickbox' );
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
}

add_action( 'personal_options_update', 'tx_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'tx_save_extra_profile_fields' );
function tx_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
{
        return false;
    }

update_user_meta( $user_id, 'image', $_POST[ 'image' ] );

}

add_action( 'tx_author_bio', 'tx_author_bio' );
function tx_author_bio() {

        echo '<div class="author_bio_sec">';
        $authorImage = get_the_author_meta('image');
        echo '<div class="author_pic">';
        if($authorImage){
        echo '<img src='.$authorImage . '>';
        }
        else {
            echo get_avatar(get_the_author_meta('user_email'), '330'); 
        }
        echo '</div>';
        echo '<div class="profile_info">';

        echo '<div class="profile_name">';
        echo '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) . '">' . esc_html( get_the_author() ) . '</a>';
        echo '</div>';

        echo '<div class="profile_age">';
        echo the_author_meta('age');
        echo '</div>';

        echo '<div class="profile_gender">';
        echo the_author_meta('gender');
        echo '</div>';

        echo '<div class="profile_address">';
        echo the_author_meta('address');
        echo '</div>';

        echo '<div class="profile_url">';
        echo the_author_meta('url');
        echo '</div>';


        echo '<div class="profile_description">';
        echo the_author_meta('description');
        echo '</div>';

         echo '<div class="social_profile">';
        $fb = get_the_author_meta('facebook');
        if ($fb !='') {
        echo '<a href="'.$fb.'" target="_blank" class="profile_link_fb"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
        }
        $tw = get_the_author_meta('twitter');
        if ($tw !='') {
        echo '<a href="'.$tw.'" target="_blank" class="profile_link"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
        }
        $in = get_the_author_meta('linkedin');
        if ($in !='') {
        echo '<a href="'.$in.'" target="_blank" class="profile_link"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
        }
        $ig = get_the_author_meta('instagram');
        if ($ig !='') {
        echo '<a href="'.$ig.'" target="_blank" class="profile_link"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
        }
        echo '</div>';


        echo '</div>';
        echo '</div>';
}