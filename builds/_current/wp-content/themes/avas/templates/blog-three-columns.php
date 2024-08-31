<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Template Name: Blog - Three Columns
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
		global $tx;
		$args = array(
		'post_type' => 'post',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => $tx['blog-posts-per-page'],
		'paged' => $paged,

		);

		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : ?>

  	 	<!-- the loop -->
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="col-md-4 col-sm-12 post blog-cols">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
					<?php if ( has_post_format('video') ) { ?>
					<?php 
			            $post_video_link = get_post_meta( $post->ID, 'post_link', true );
        				if( function_exists('tx_post_video_link') &&  $post_video_link ) { ?>
			            <div class="video_post_link"><?php do_action('tx_post_video_link'); ?></div>
			        <?php } else {
			            if (has_post_thumbnail()) : ?>
			                <div class="zoom-thumb featured-thumb">
			                    <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			                    <?php the_post_thumbnail('tx-bc-img'); ?>
			                    </a>
			                </div>
			        <?php endif; 
			            } ?>

        		<?php } elseif ( has_post_format('gallery') ) {
 					$images = get_post_meta($post->ID, 'tx_gallery_id', true); 
			        if(function_exists('tx_add_gallery_metabox') && $images) { ?>
			            <div class="gallery-slider"><!-- slider start -->         
			                <ul class="posts-gallery-slider cS-hidden">
			                <?php         
			                $images = get_post_meta($post->ID, 'tx_gallery_id', true);  
			                if($images) :
			                foreach ($images as $image) {

			                $image_thumb_url = wp_get_attachment_image_src($image, 'tx-s-thumb'); 
			                $thumbs = $image_thumb_url[0];
			                $gallery = wp_get_attachment_link($image, 'tx-bc-img');

			                    echo '<li data-thumb = "'.$thumbs.'">';                
			                    echo  wp_kses_post($gallery);
			                    echo '</li>';  
			                }
			                  endif;
			                ?>
			                </ul>
			            </div><!-- slider end --> 
			        <?php } else { ?> 
			        <?php if (has_post_thumbnail()) : ?>
			            <div class="zoom-thumb featured-thumb">
			                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			                <?php the_post_thumbnail('tx-bc-img'); ?>
			                </a>
			            </div>
			        <?php endif; }
        		} else { 

				if (has_post_thumbnail()) : ?>
			            <div class="zoom-thumb featured-thumb">
			                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
			                <?php the_post_thumbnail('tx-bc-img'); ?>
			                </a>
			            </div>
			        <?php endif;

        		} ?>
				<div class="details-box">
                    <?php tx_date(); ?>
                        <h4 class="post-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                        <?php the_title(); ?>
                        </a></h4>
                        <?php if ('post' == get_post_type()) : ?>
                    <div class="entry-meta">
                    <?php tx_category(); ?>
                    <?php tx_comments(); ?>
                    <?php echo tx_getPostViews(get_the_ID()); ?>
                    </div>
                    <?php endif; ?><!-- .entry-meta -->
                    <?php echo tx_excerpt(35); ?>

                <div class="tx-clear"></div>
  
                </div>
			</article>	
		</div>

		<?php endwhile; ?><!-- end of the loop -->
		<?php wp_reset_postdata(); ?>
		<?php else:  ?>
    	<?php get_template_part('template-parts/content/content', 'none'); ?>
  		<?php endif; ?>
  		<div class="tx-clear"></div>
  		<!-- pagination here -->
		<?php tx_pagination_number($query->max_num_pages,"",$paged); ?>



<?php get_footer();