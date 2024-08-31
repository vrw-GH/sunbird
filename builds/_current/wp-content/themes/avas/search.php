<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
 *===========================
 * search results
 *===========================
 * 
 */

get_header();

?>

<div class="container space-single">
    <div class="row">
        <div id="primary" class="col-lg-8 col-md-8">
            <main id="main" class="site-main">
            <?php if (have_posts()) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php printf(esc_html__('Search Results for: %s', 'avas'), '<span>' . get_search_query() . '</span>'); ?></h1>
                </header><!-- .page-header -->

                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    get_template_part('template-parts/content/content', 'search');
                    ?>
                <?php endwhile; ?>
                <?php tx_navigation(); ?>
            <?php else : ?>
                <?php get_template_part('template-parts/content/content', 'none'); ?>
            <?php endif; ?>
            </main><!-- #main -->
        </div><!-- #primary -->

<?php
get_sidebar();
get_footer();