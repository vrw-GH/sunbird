<?php
/**
 * 
 * @package tx
 * @author theme-x
 * @link https://theme-x.org/
 *
 * ====================================
 *         Single Post
 * ====================================
 */
global $tx;
get_header();
?>
<div class="container space-content">
<div class="row">
    <?php if($tx['sidebar-single'] == 'sidebar-left') : get_sidebar('single'); endif; ?>
    <div id="primary" class="col-lg-<?php echo tx_single_sidebar(); ?> col-md-7 col-sm-12">
        <main id="main" class="site-main">
            <?php while (have_posts()) : the_post(); ?>
                <?php tx_setPostViews(get_the_ID()); ?>
                <?php get_template_part( 'template-parts/content/content', get_post_format() ); ?>
                <?php
                if(class_exists('ReduxFramework')) {
                    if ($tx['related-posts']) :
                        get_template_part( 'template-parts/content/related', 'posts' );
                    endif;
                }
                ?><!-- related posts -->
                <?php
                if (class_exists('ReduxFramework')) {
                    if ($tx['prev-next-posts']) :
                        do_action('tx_pagination'); 

                    endif;
                }
                ?>
                <?php 
                     if (!post_password_required()) :
                        if ($tx['author-bio-posts']) :
                            do_action('tx_author_bio'); 
                        endif;
                    endif;    
                ?><!-- author bio -->
                <?php
                if (class_exists('ReduxFramework')) {
                    if ($tx['comments-posts']) :
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    endif;
                }else{
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                }
                ?> <!-- comments -->
            <?php endwhile; // end of the loop.  ?>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php if($tx['sidebar-single'] == 'sidebar-right') : get_sidebar('single'); endif; ?>
<?php get_footer();