<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Services Archives
*
**/
get_header();
?>

<div class="container space-content">
	<div class="row">
		<?php
		  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

		  $args = array(
		          'post_type'       => 'service',
		          'status'          => 'published', 
		          'posts_per_page'  => 9,
		          'paged'           => $paged,
		    );

		  $serv_query = new WP_Query( $args );
		?>
			<?php
      			if ($serv_query->have_posts()) : 
      				while ($serv_query->have_posts()) : $serv_query->the_post();

      				global $post;
			        $terms = get_the_terms( $post->ID, 'service-category' );
			        if ( $terms && ! is_wp_error( $terms ) ) :
			          $taxonomy = array();
			          foreach ( $terms as $term ) :
			            $taxonomy[] = $term->name;
			          endforeach;
			          $cat_name = join( " ", $taxonomy);
			          $cat_link = get_term_link( $term );
			      	else:
			      		$cat_name = '';
			      	endif;	
      		?>
	      				<div class="col-lg-4 col-sm-6">
	      					<div class="tx-services-item">
	      					<?php if (has_post_thumbnail()) : ?>
	      						<div class="tx-services-featured">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
										<?php the_post_thumbnail('tx-serv-thumb'); ?>
									</a>
								</div>
							<?php endif; ?>
								<div class="tx-services-content">
									<h3 class="tx-services-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p class="tx-services-excp"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
									<?php if(!empty($cat_name)) : ?>
										<a class="tx-serv-cat" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat_name); ?></a>
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
		<!-- pagination -->
		<?php tx_pagination_number($serv_query->max_num_pages,"",$paged); ?>

<?php get_footer( ); ?>