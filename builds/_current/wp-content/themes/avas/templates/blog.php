<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* ============================
*   Template Name: Blog
* ============================
*
*/
get_header();
global $tx;
?>
<div class="container space-content">
	<div class="row">
		<?php tx_content_page(); ?>
		<?php 
		if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;

		$args = array(
		'post_type' => 'post',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => $tx['blog-posts-per-page'],
		'paged' => $paged,

		);

		$query = new WP_Query( $args ); ?>
	<?php if($tx['sidebar-select'] == 'sidebar-left') : get_sidebar(); endif; ?>
	    <div id="primary" class="col-lg-<?php echo tx_sidebar_no_sidebar(); ?> col-md-7 col-sm-12">
	        <main id="main" class="site-main">
	            <?php if ( $query->have_posts() ) : ?>
	                <?php while( $query->have_posts() ) : $query->the_post(); ?>
	                    <?php get_template_part('template-parts/content/content', get_post_format()); ?>
	                <?php endwhile; ?>
	                <div class="tx-clear"></div>
	                <?php tx_pagination_number($query->max_num_pages,"",$paged); ?>
	            <?php else : ?>
	                <?php get_template_part('template-parts/content/content', 'none'); ?>
	            <?php endif; ?>
	        </main><!-- #main -->
	    </div><!-- #primary -->
	 
	<?php if($tx['sidebar-select'] == 'sidebar-right') : get_sidebar(); endif; ?>
	
<?php get_footer(); 