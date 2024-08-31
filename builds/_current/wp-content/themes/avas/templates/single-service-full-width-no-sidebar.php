<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Template Name: Full Width No Sidebar
* Template Post Type: service
*
*/
global $tx;
get_header();
?>
<div class="container space-content">
    <div class="row">	
        <?php if (have_posts()): while (have_posts()): the_post(); ?>

		<div class="col-lg-12 col-sm-12 service-image">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('tx-xl-thumb'); ?>
            <?php endif; ?>
		</div>
        
        <div class="col-lg-12 col-sm-12">
            <div class="service-content">
                <?php the_content(); ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
        <?php endif; ?><!-- End left part -->

<?php get_footer(); ?>
