<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Template Name: Full Width Image
* Template Post Type: post
*
*/
get_header();
tx_setPostViews(get_the_ID());
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
?>


	<?php if (have_posts()): while (have_posts()): the_post(); ?>

		<div class="post-full-width-featured-wrap">
		
		<?php if ( has_post_format('video') ) { ?>
					<?php 
			            $post_video_link = get_post_meta( $post->ID, 'post_link', true );
        				if( function_exists('tx_post_video_link') &&  $post_video_link ) { ?>
			            <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
			        <?php } else {
			            if (has_post_thumbnail()) : ?>
			                <div class="featured-thumb">
			                    <?php the_post_thumbnail('tx-1920x600-thumb'); ?>
			                </div>
			        <?php endif; 
			            } ?>

        		<?php } elseif ( has_post_format('gallery') ) {
 					$images = get_post_meta($post->ID, 'tx_gallery_id', true); 
			        if(function_exists('tx_add_gallery_metabox') && $images) { ?>
			<div class="flexslider">
                <ul class="slides">
                <?php         
                if($images) :
                foreach ($images as $image) {
                $gallery = wp_get_attachment_image($image, 'tx-1920x600-thumb');
                    echo '<li>';                
                    echo  wp_kses_post($gallery);
                    echo '</li>';  
                }
                endif;
                ?>
                </ul>
            </div><!-- slider end -->
			        <?php } else { ?> 
			        <?php if (has_post_thumbnail()) : ?>
			            <div class="featured-thumb" style="background-image: url(<?php echo esc_attr($featured_img_url); ?>)"></div>
			        <?php endif; }
        		} else { 

				if (has_post_thumbnail()) : ?>
			            <div class="featured-thumb" style="background-image: url(<?php echo esc_attr($featured_img_url); ?>)"></div>
			    <?php endif;

        		} ?>

		</div><!-- /.post-full-width-featured-wrap -->
		<div class="container tx-single-full-width-contents">
			<div class="row">
		<div class="title-mag">
			<header class="entry-header">
		            <h1 class="entry-title"><?php the_title(); ?></h1>
		            <?php if ('post' == get_post_type()) : ?>
		                <div class="entry-meta">
		                    <?php tx_date(); ?>
		                    <?php tx_author(); ?>
		                    <?php tx_comments(); ?>
		                    <?php echo tx_getPostViews(get_the_ID()); ?>
		                    <?php do_action('tx_social_share_header'); ?>
		                </div><!-- .entry-meta -->
		            <?php endif; ?>
		        </header><!-- .entry-header -->
		</div><!-- /.title-mag -->
        <?php if($tx['sidebar-single'] == 'sidebar-left') : get_sidebar('single'); endif; ?>
		<div id="primary" class="col-md-<?php echo tx_sidebar_no_sidebar(); ?>">
        <main id="main" class="site-main">
            
                <?php
			        if ( is_home () || is_category() || is_archive() ) {
			        the_excerpt('');
			        } else {
			        /* translators: %s: Name of current post */
			        the_content(sprintf(
			                        esc_attr__('Read more %s &rarr;', 'avas'), the_title('<span class="screen-reader-text">"', '"</span>', false)
			        ));
			        }
			    ?>
			    <div class="clearfix"></div>
			    <footer class="entry-footer">
			        <?php tx_category(); ?>
			        <?php tx_tags(); ?>
			    </footer><!-- .entry-footer -->
			    <?php
			        if ( is_home () || is_category() || is_archive() ) {
			        
			        } else {
			            
			               do_action('tx_social_share'); 
			            
			    } ?>
                <?php
                if (class_exists('ReduxFramework')) {
                    if ($tx['prev-next-posts']) :
                        do_action('tx_pagination'); 

                    endif;
                }
                ?>
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
                 <!--BEGIN .author-bio-->
            
        </main><!-- #main -->
    	</div><!-- #primary -->

<?php endwhile; // end of the loop.  ?>
<?php endif; ?>
<?php if($tx['sidebar-single'] == 'sidebar-right') : get_sidebar('single'); endif;
get_footer();