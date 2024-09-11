<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user = LP_Global::user();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
    // @deprecated
    do_action( 'learn_press_before_courses_loop_item' );

    // @since 3.0.0
    do_action( 'learn-press/before-courses-loop-item' );
    ?>

    <div class="lp-course-price">
    <?php global $course; if ( $price_html = $course->get_price_html() ) { ?>
    <?php if ( $course->get_origin_price() != $course->get_price() ) { ?>
    <?php $origin_price_html = $course->get_origin_price_html(); ?>
        <span class="origin-price"><?php echo esc_html($origin_price_html, 'avas'); ?></span>
    <?php } ?>
        <span class="price"><?php echo esc_html($price_html, 'avas'); ?></span>
    <?php } ?>
    </div>

<a href="<?php the_permalink(); ?>" class="course-permalink">
<?php $course = LP_Global::course();
?>
<div class="course-thumbnail">
<?php echo wp_kses_post($course->get_image( 'course_thumbnail' )); ?>
</div>
</a>

<div class="course-summary">
<div class="course-cateogory">
    <?php
    	global $post;
        $terms = get_the_terms( $post->ID , 'course_category' );
        if ($terms) :
           
        foreach ( $terms as $term ) {
        echo '<a href="'.get_term_link($term->term_id).'">'.$term->name .'</a>';
        }
        endif;
    ?>
</div>     
<?php the_title( sprintf( '<h3 class="course-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
<p><?php echo tx_excerpt_limit(10);?></p>                                    
</div>
<?php //do_action( 'learn_press_after_courses_loop_item' ); ?>
    
<div class="edu-course-footer">
    <?php echo tx_lp_author(); ?>
    <?php echo tx_lp_rating(); ?>
    <?php echo tx_lp_student_endrolled(); ?>
    <?php echo '<div class="lp_post_views">'.tx_getPostViews(get_the_ID()).'</div>'; ?>
</div>

</div><!-- end content -->