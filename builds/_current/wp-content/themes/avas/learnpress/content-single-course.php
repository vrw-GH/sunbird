<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-single-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}
?>
<div class="course-thumbnail">

 <?php 
 
 global $post;
 $image = get_post_meta($post->ID, 'tx_gallery_id', true);
 //$gallery = wp_get_attachment_link($image, 'single_course_gallery');

if ( $image ) { ?>

<div class="item">  <!-- slider starts -->         
	<ul id="course-gallery" class="gallery list-unstyled cS-hidden">
        <?php         
        $images = get_post_meta($post->ID, 'tx_gallery_id', true);  
        if($images) :
    	    foreach ($images as $img) {
                $image_thumb_url = wp_get_attachment_image_src($img, 'single_course_image'); 
                $thumbs = $image_thumb_url[0];
                $gallery = wp_get_attachment_image($img, 'single_course_image');
                    echo '<li data-thumb = "'.$thumbs.'">';                
                    echo  wp_kses_post($gallery);
                    echo '</li>';  
            }
                  endif;
            ?>
    </ul>
</div>  <!-- slider end -->

<?php } else {

if ( has_post_thumbnail() ) {

	the_post_thumbnail('single_course_image'); 
	}
}

?>

</div>



<div class="row">

	<div class="col-md-9">
		

<?php
/**
 * @deprecated
 */
do_action( 'learn_press_before_main_content' );
do_action( 'learn_press_before_single_course' );
do_action( 'learn_press_before_single_course_summary' );

/**
 * @since 3.0.0
 */
do_action( 'learn-press/before-main-content' );

do_action( 'learn-press/before-single-course' );

?>

<div id="learn-press-course" class="course-tabs">
	<?php
	/**
	 * @since 3.0.0
	 *
	 * @see learn_press_single_course_summary()
	 */

	do_action( 'learn-press/single-course-summary' );
	?>
</div>
<?php

/**
 * @since 3.0.0
 */
do_action( 'learn-press/after-main-content' );

do_action( 'learn-press/after-single-course' );
tx_setPostViews(get_the_ID()); 
/**
 * @deprecated
 */
do_action( 'learn_press_after_single_course_summary' );
do_action( 'learn_press_after_single_course' );
do_action( 'learn_press_after_main_content' );
?>

</div><!-- col-md-9 -->


<div id="secondary" class="col-md-3 lp-sidebar">
<?php
global $course;
$is_required = $course->is_required_enroll();
$course = LP()->global['course'];
$user   = learn_press_get_current_user();
$is_enrolled = $user->has_enrolled_course($course->get_id());

		if ( ! $is_enrolled ) { ?>
			<div class="course-payment">
				<?php
			learn_press_course_price();
			learn_press_course_buttons(); ?>
			</div>
<?php		}

// course features
tx_course_info();


if (is_active_sidebar('sidebar-learnpress-single')) :
	dynamic_sidebar('sidebar-learnpress-single');
endif; 
?>
</div><!-- sidebar -->
</div><!-- row -->
<?php tx_related_courses(); ?>



