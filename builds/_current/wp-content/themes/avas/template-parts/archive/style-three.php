<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Posts archive template style three
**/
global $tx;
?>


		<?php if($tx['sidebar-select'] == 'sidebar-left') : get_sidebar(); endif; ?>
	    <div id="primary" class="col-md-<?php echo tx_sidebar_no_sidebar(); ?>">
	    <div class="row">
	    	
		<?php
		// Check if there are any posts to display
		if ( have_posts() ) : ?>
	  
		<!-- the loop -->
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="tx-cat-style3">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
				<div class="tx-cat-style3-left">
					<?php if ( has_post_format('video') ) : ?>
					<?php 
			            $post_video_link = get_post_meta( $post->ID, 'post_link', true );
        				if( function_exists('tx_post_video_link') &&  $post_video_link ) { ?>
			            <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
			        <?php } else {
			            if (has_post_thumbnail()) : ?>
			                <div class="zoom-thumb featured-thumb">
			                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			                    <?php the_post_thumbnail('tx-r-thumb'); ?>
			                    </a>
			                </div>
			        <?php endif; 
			            } ?>

        		<?php elseif(has_post_thumbnail()) : ?>
			            <div class="zoom-thumb featured-thumb">
			                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			                <?php the_post_thumbnail('tx-r-thumb'); ?>
			                </a>
			            </div>
			        <?php endif;

        		 ?>
        		</div><!-- tx-cat-style3-left -->
				<div class="tx-cat-style3-right">
                        <h4 class="post-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                        <?php the_title(); ?>
                        </a></h4>
                        <?php if ('post' == get_post_type()) : ?>
                    <div class="entry-meta">
                    <?php tx_date(); ?>	
                    <?php tx_category(); ?>
                    <?php tx_comments(); ?>
                    <?php echo tx_getPostViews(get_the_ID()); ?>
                    </div>
                    <?php endif; ?><!-- .entry-meta -->
                    <?php echo tx_excerpt(35); ?>
                </div><!-- tx-cat-style3-right -->
			</article>
		</div><!-- tx-cat-style3 -->
		<?php endwhile; ?><!-- end of the loop -->
		<?php wp_reset_postdata(); ?>
		<?php else:  ?>
    	<?php get_template_part('template-parts/content/content', 'none'); ?>
  		<?php endif; ?>
  		<div class="tx-clear"></div>
		<?php tx_pagination_number(); ?>
		
		</div> <!-- end .row -->
		</div> <!-- end #primary -->


		<?php if (class_exists('ReduxFramework')) {
			if($tx['sidebar-select'] == 'sidebar-right') : 
				get_sidebar(); 
			endif; 
		} else {
			get_sidebar();
		} ?>