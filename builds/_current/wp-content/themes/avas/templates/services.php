<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Template Name: Services (Publish & Reload page)
*
**/
get_header();

$item_per_page = get_post_meta( $post->ID, 'item_per_page', true );
$display = get_post_meta( $post->ID, 'display', true );
$title = get_post_meta( $post->ID, 'title', true );
$desc = get_post_meta( $post->ID, 'desc', true );
$link = get_post_meta( $post->ID, 'link', true );
$serv_category = get_post_meta( $post->ID, 'serv_category', true );
?>

<div class="container space-content">
	<div class="row">
		<?php tx_content_page(); ?>
		<?php
		  $pagination = ( $item_per_page ) ? $item_per_page : 9;
		  if ( get_query_var('paged') ) :
	      	$paged = get_query_var('paged');
		  elseif ( get_query_var('page') ) :
		      $paged = get_query_var('page');
		  else :
		      $paged = 1;
		  endif;

		  $args = array(
		          'post_type'       => 'service',
		          'status'          => 'published', 
		          'posts_per_page'  => $pagination,
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
      				<?php if($display == 'grid') : ?>
	      				<div class="col-md-4 col-sm-6">
	      					<div class="tx-services-item">
	      					<?php if (has_post_thumbnail()) : ?>
	      						<div class="tx-services-featured">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
										<?php the_post_thumbnail('tx-serv-thumb'); ?>
									</a>
								</div>
							<?php endif; ?>
								<div class="tx-services-content">
									<?php if($title == 'show') : ?>
									<h3 class="tx-services-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php elseif($title == 'hide') : ?>
									<?php else : ?>
									<h3 class="tx-services-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>	
									<?php endif; ?>
									<?php if($desc == 'show') : ?>
									<p class="tx-services-excp"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
									<?php elseif($desc == 'hide') : ?>
									<?php else : ?>
									<p class="tx-services-excp"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
									<?php endif; ?>	
									<?php if(!empty($cat_name)) : ?>
										<?php if($serv_category == 'show'): ?>
											<a class="tx-serv-cat" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat_name); ?></a>
										<?php elseif($serv_category == 'hide'): ?>
										<?php else: ?>
											<a class="tx-serv-cat" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat_name); ?></a>
										<?php endif; ?>
									<?php endif; ?>
								</div><!-- /.tx-services-content -->
							</div><!-- /.tx-services-item -->
	      				</div>
      				<?php elseif($display == 'overlay') : ?>
	      				<div class="col-md-4 col-sm-6">
	      					<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'tx-serv-overlay-thumb'); ?>

	      					<div class="tx-services-overlay-item" <?php if (has_post_thumbnail()) : echo 'style="background-image:url('.$featured_img_url.')"'; endif;?>>
								<div class="tx-services-content">
									<?php if($title == 'show') : ?>
									<div class="tx-services-title-holder">
										<h3 class="tx-services-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									</div>
									<?php elseif($title == 'hide') : ?>
									<?php else : ?>
									<div class="tx-services-title-holder">
										<h3 class="tx-services-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									</div>
									<?php endif; ?>
									<?php if($desc == 'show') : ?>
									<p class="tx-services-excp"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
									<?php elseif($desc == 'hide') : ?>
									<?php else : ?>
									<p class="tx-services-excp"><?php echo esc_html(tx_excerpt_limit(20)); ?></p>
									<?php endif; ?>
									<?php if($link == 'show') : ?>	
									<a href="<?php the_permalink(); ?>"><i class="la la-long-arrow-right"></i></a>
									<?php elseif($link == 'hide') : ?>
									<?php else : ?>
									<a href="<?php the_permalink(); ?>"><i class="la la-long-arrow-right"></i></a>
									<?php endif; ?>	
								</div><!-- /.tx-services-content -->
							</div><!-- /.tx-services-item -->
	      				</div>
      				<?php else : ?>
	      				<div class="col-md-4 col-sm-6">
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
								</div><!-- /.tx-services-content -->
							</div><!-- /.tx-services-item -->
	      				</div>
      				<?php endif; ?>	

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