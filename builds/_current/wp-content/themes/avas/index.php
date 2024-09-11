<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* ============================
*         Index
* ============================
*
*/
get_header();
?>
<div class="container space-content">
	<div class="row">
	<?php if($tx['sidebar-select'] == 'sidebar-left') : get_sidebar(); endif; ?>
	    <div id="primary" class="col-md-<?php echo tx_sidebar_no_sidebar(); ?>">
	        <main id="main" class="site-main">
	            <?php if (have_posts()) : ?>
	                <?php while (have_posts()) : the_post(); ?>
	                    <?php get_template_part('template-parts/content/content', get_post_format()); ?>
	                <?php endwhile; ?>
	                <?php tx_pagination_number(); ?>
	            <?php else : ?>
	                <?php get_template_part('template-parts/content/content', 'none'); ?>
	            <?php endif; ?>
	        </main><!-- #main -->
	    </div><!-- #primary -->
	<?php 
		if (class_exists('ReduxFramework')) {
			if($tx['sidebar-select'] == 'sidebar-right') : 
				get_sidebar(); 
			endif; 
		} else {
			get_sidebar();
		}
	?>
<?php get_footer(); 