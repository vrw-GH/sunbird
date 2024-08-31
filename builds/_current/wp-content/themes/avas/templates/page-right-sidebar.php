<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Template Name: Page - Right Sidebar
**/

get_header();
?>    

<div class="container space-content">
    <div class="row">
        <div id="primary" class="col-md-8">
            <div id="main" class="site-main">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content/content', 'page'); ?>
                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                <?php endwhile; // end of the loop.  ?>
            </div><!-- #main -->
        </div><!-- #primary -->

<?php 
get_sidebar('page');
get_footer();        