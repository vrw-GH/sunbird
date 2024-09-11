<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Services Taxonomy Archives
*
**/
get_header();
?>

<div class="container space-content">
	<div class="row">
		<?php
		  $term = get_queried_object();
		  $args = array(
		          'post_type'       => 'service',
		          'status'          => 'published', 
		          'service-category'  => $term->slug,
		          'posts_per_page'  => -1,
		    );

		  $serv_query = new WP_Query( $args );
		?>
			<?php
      			if ($serv_query->have_posts()) : 
      				while ($serv_query->have_posts()) : $serv_query->the_post();
      		?>
	      				<div class="col-lg-4 col-sm-6">
	      					<div class="tx-services-item">
	      					<?php if (has_post_thumbnail()) : ?>
	      						<div class="tx-services-featured">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
										<?php the_post_thumbnail('tx-serv-thumb'); ?>
									</a>
									<!-- <div class="tx-port-overlay"></div> -->
								</div>
							<?php endif; ?>
								<div class="tx-services-content">
									<h3 class="tx-services-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p class="tx-services-excp"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
									<?php if(!empty($term->name)) : ?>
										<a class="tx-serv-cat" href="#"><?php echo esc_attr($term->name); ?></a>
									<?php endif; ?>
								</div><!-- /.tx-services-content -->
							</div><!-- /.tx-services-item -->
	      				</div>
      		<?php 	endwhile;
      				wp_reset_postdata();
      			else:  
			    	get_template_part('template-parts/content/content', 'none');
			    endif;
			?>
		<div class="clear"></div>

<?php get_footer( ); ?>