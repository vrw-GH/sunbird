<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*
*/
?>

<div class="related-posts">
	<?php
        $rp_query = new WP_Query(
	    array(
			'category__in'   => wp_get_post_categories( $post->ID ),
			'posts_per_page' => 12,
			'post__not_in'   => array( $post->ID )
		    )
	   	); ?>
<h3 class="related-posts-title"><?php echo esc_html__('Related Posts','avas'); ?></h3>
	   	<?php if( $rp_query->have_posts() ) { ?>
	   	<div class="related-posts-loop owl-carousel"> 
	    <?php while( $rp_query->have_posts() ) { 
			$rp_query->the_post(); ?>
			<div class="related-posts-item">		
		    	<a rel="external" href="<?php the_permalink();?>">
		    		<?php if (has_post_thumbnail()) {
		    			the_post_thumbnail('tx-r-thumb'); 
		    		} else { ?>
		    			<img src="<?php echo TX_IMAGES.'related-posts.png'; ?>" alt="<?php the_title()?>">
		    		<?php } 
		    		?>
		    	</a>
		    	<div class="overlay">
		    		<?php the_title(sprintf('<h6 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h6>'); ?>
		    	</div>
			</div><?php
	    	}
	    	wp_reset_postdata(); ?>
	    </div>
   		<?php }


	?>
</div>
    
