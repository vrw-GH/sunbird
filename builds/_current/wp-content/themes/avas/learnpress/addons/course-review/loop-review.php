<?php
/**
 * Template for displaying loop course review.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/course-review/loop-review.php.
 *
 * @author ThimPress
 * @package LearnPress/Course-Review/Templates
 * version  3.0.1
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
?>

<li>
    <div class="review-author">
		<?php echo get_avatar( $review->user_email ) ?>
    </div>
    <div class="review-author-info">
        <h4 class="user-name"><?php echo esc_html($review->user_login,'avas'); ?></h4>
        <?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $review->rate ) ); ?>
        <p class="review-title"><?php echo esc_html($review->title,'avas'); ?></p>
        <p class="review-content"><?php echo esc_html($review->content,'avas'); ?></p>
    </div>
    
</li>