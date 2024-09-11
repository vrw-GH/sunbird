<?php
/**
 * 
 * @package tx
 * @author theme-x
 * @link https://theme-x.org/
 *
 * ====================================
 *         Single Video
 * ====================================
 */
global $tx;
get_header();
?>

    <div class="video_post_section">
        <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
    </div><!-- video section -->


<div class="container space-single">
    <div class="row">
        <?php if($tx['sidebar-single'] == 'sidebar-left') : get_sidebar('single'); endif; ?>
        <div id="primary" class="col-md-<?php echo tx_sidebar_no_sidebar(); ?>">
            <main id="main" class="site-main">
                <?php while (have_posts()) : the_post(); ?>
                    <?php tx_setPostViews(get_the_ID()); ?>
                    <?php get_template_part( 'template-parts/content/content', get_post_format() ); ?>
                    <?php do_action('tx_pagination'); ?>
                    <?php 
                    if(class_exists('ReduxFramework')) {
                    if ($tx['related-posts']) :
                        get_template_part( 'template-parts/content/related', 'posts' );
                    endif;
                }
                    ?> <!-- related posts -->
                    <?php 
                        if (!post_password_required()) :
                            do_action('tx_author_bio');
                        endif;    
                    ?><!-- author bio -->

                    <?php
                    if ($tx['comments-posts']) :
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    endif;
                    ?> <!-- comments -->
                     
                <?php endwhile; // end of the loop.  ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    <?php if($tx['sidebar-single'] == 'sidebar-right') : get_sidebar('single'); endif; ?>
<?php get_footer();