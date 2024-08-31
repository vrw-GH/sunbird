<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Template Name: Portfolio (Publish & Reload page)
*
**/

get_header();

$portfolio_layout = get_post_meta($post->ID, 'portfolio_layout', true);
$portfolio_filter = get_post_meta($post->ID, 'portfolio_filter', true);
$col = get_post_meta($post->ID, 'columns', true);
$popup = get_post_meta($post->ID, 'popup', true);
$display = get_post_meta($post->ID, 'display', true);
$item_per_page = get_post_meta($post->ID, 'item_per_page', true);
$title = get_post_meta($post->ID, 'title', true);
$desc = get_post_meta($post->ID, 'desc', true);
$enlarge = get_post_meta($post->ID, 'enlarge', true);
$link = get_post_meta($post->ID, 'link', true);
$port_category = get_post_meta($post->ID, 'port_category', true);
?>


<div class="container<?php if($portfolio_layout) : echo esc_attr($portfolio_layout); endif; ?> space-content">
  <div class="tx-row">
  <?php tx_content_page(); ?>
  <?php if($portfolio_filter == 'yes') : ?>
    <div class="portfolio-filter-wrap">
      <ul class="portfolio-filters">
        <?php
          $terms = get_terms('portfolio-category');
          $terms_count = count($terms); 
        ?>
        <li class="active" data-filter="*"><?php echo esc_html__('All', 'avas'); ?></li>
        <?php if ( $terms_count > 0 ) :
                foreach ( $terms as $term ) :
                  $term_name = strtolower($term->name);
                  $term_name = str_replace(' ', '-', $term_name);
                  echo '<li  data-filter=".'.esc_attr($term_name).'">'.esc_attr($term->name).'</li>';
                endforeach;
              endif;
        ?>
      </ul><!-- /.portfolio-filters -->
    </div> <!-- /.portfolio-filter-wrap -->

  <?php elseif($portfolio_filter == 'no') : ?>
  <?php else : ?>  
    <div class="portfolio-filter-wrap">
      <ul class="portfolio-filters">
        <?php
          $terms = get_terms('portfolio-category');
          $terms_count = count($terms); 
        ?>
        <li class="active" data-filter="*"><?php echo esc_html__('All', 'avas'); ?></li>
        <?php if ( $terms_count > 0 ) :
                foreach ( $terms as $term ) :
                  $term_name = strtolower($term->name);
                  $term_name = str_replace(' ', '-', $term_name);
                  echo '<li  data-filter=".'.esc_attr($term_name).'">'.esc_attr($term->name).'</li>';
                endforeach;
              endif;
        ?>
      </ul><!-- /.portfolio-filters -->
    </div> <!-- /.portfolio-filter-wrap -->
  <?php endif; ?>

  <?php
  if ( get_query_var('paged') ) :
      $paged = get_query_var('paged');
  elseif ( get_query_var('page') ) :
      $paged = get_query_var('page');
  else :
      $paged = 1;
  endif;

  $pagination = ( $item_per_page ) ? $item_per_page : 12;

  $args = array(
          'post_type'       => 'portfolio',
          'status'          => 'published', 
          'posts_per_page'  => $pagination,
          'paged'           => $paged,
    );

  $port_query = new WP_Query( $args );
  ?>

  <div class="tx-portfolio">
    <?php
      if ($port_query->have_posts()) : while ($port_query->have_posts()) : $port_query->the_post();

        global $post;
        $terms = get_the_terms( $post->ID, 'portfolio-category' );
        if ( $terms && ! is_wp_error( $terms ) ) :
          $taxonomy = array();
          foreach ( $terms as $term ) :
            $taxonomy[] = $term->name;
          endforeach;
          $cat_name = join( " ", str_replace(' ', '-', $taxonomy));
          $cat_link = get_term_link( $term );
          $cat = strtolower($cat_name);
        else :
          $cat = '';
        endif;

        if ( has_post_thumbnail() ) :

        $cols = ( $col ) ? $col : 4; ?>

          <div class="col-md-<?php echo esc_attr($cols); ?> tx-portfolio-item <?php echo esc_attr($cat); ?>">
            <div class="tx-port-img">
              <?php
                $img_url = get_the_post_thumbnail_url(get_the_ID(), '');
                $img_h_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-h-thumb');
                $img_v_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-v-thumb');
              ?>
              <?php if($display == 'masonry') : ?>
                <img src="<?php echo esc_attr($img_url); ?>" alt="<?php echo the_title(); ?>" >
              <?php elseif($display == 'grid-h') : ?>
                <img src="<?php echo esc_attr($img_h_grid); ?>" alt="<?php echo the_title(); ?>" >
              <?php elseif($display == 'grid-v') : ?>
                <img src="<?php echo esc_attr($img_v_grid); ?>" alt="<?php echo the_title(); ?>" >
              <?php else : ?>
                <img src="<?php echo esc_attr($img_url); ?>" alt="<?php the_title(); ?>" >
              <?php endif; ?>
            </div><!-- /.tx-port-img -->

            <div class="tx-port-overlay">
              <div class="tx-port-overlay-content">
                <?php if(!empty($cat)) : ?>
                  <?php if($port_category == 'show') : ?>
                  <div class="tx-port-cat">
                    <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_attr($cat); ?></a>
                  </div><!-- /.tx-port-cat -->
                  <?php elseif($port_category == 'hide') : ?>
                  <?php else : ?>
                  <div class="tx-port-cat">
                    <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_attr($cat); ?></a>
                  </div><!-- /.tx-port-cat -->
                  <?php endif; ?>  
                <?php endif; ?>  
                <?php if($title == 'show') : ?>
                  <h4 class="tx-port-title"><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
                <?php elseif($title == 'hide') : ?>
                <?php else : ?>
                  <h4 class="tx-port-title"><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
                <?php endif; ?>
                
                <?php if($desc == 'show') : ?>
                  <p class="tx-port-excp"><?php echo esc_html(tx_excerpt_limit(5)); ?></p>  
                <?php elseif($desc == 'hide') : ?>
                <?php else : ?>
                  <p class="tx-port-excp"><?php echo esc_html(tx_excerpt_limit(5)); ?></p>
                <?php endif; ?>

                <div class="tx-port-enlrg-link">
                  <?php if($enlarge == 'show') : ?>
                    <a class="tx-port-enlarge" href="#item-<?php echo get_the_id(); ?>" data-effect="mfp-zoom-in"><i class="la la-search"></i></a>
                  <?php elseif($enlarge == 'hide') : ?>
                  <?php else : ?>
                    <a class="tx-port-enlarge" href="#item-<?php echo get_the_id(); ?>" data-effect="mfp-zoom-in"><i class="la la-search"></i></a>
                  <?php endif; ?>

                  <?php if($link == 'show') : ?>
                    <a class="tx-port-link" href="<?php echo get_the_permalink(); ?>"><i class="la la-link"></i></a>
                  <?php elseif($link == 'hide') : ?>
                  <?php else : ?>
                    <a class="tx-port-link" href="<?php echo get_the_permalink(); ?>"><i class="la la-link"></i></a>
                  <?php endif; ?>                
                </div><!-- ./tx-port-enlrg-link -->
              </div><!-- /.tx-port-overlay-content -->
            </div><!-- ./tx-port-overlay -->

            <?php $img_enlarge = get_the_post_thumbnail(get_the_ID(), 'full'); ?>

            <?php if($popup == 'no-content') : ?>
            <div id="item-<?php echo get_the_id(); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
              <?php echo wp_sprintf($img_enlarge); ?>
            </div><!-- /.tx-port-enlrg-content -->
                  
            <?php elseif($popup == 'content') : ?>  
            <div id="item-<?php echo get_the_id(); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
              <div class="tx-port-enlrg-content-left">
                <?php echo wp_sprintf($img_enlarge); ?>
              </div><!-- /.tx-port-enlrg-content-left -->

              <div class="tx-port-enlrg-content-right">
                <h3 class="tx-port-enlrg-content-title"><?php echo esc_html(the_title());?></h3>
                <div class="tx-port-enlarge-content-desc"><?php echo wp_sprintf(tx_content(75)); ?></div>
              </div><!-- /.tx-port-enlrg-content-right -->
            </div><!-- /.tx-port-enlrg-content -->
            
            <?php else : ?>
              <div id="item-<?php echo get_the_id(); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
                <?php echo wp_sprintf($img_enlarge); ?>
              </div>
            <?php endif; ?>
          </div><!-- /.tx-portfolio-item -->

    <?php
        endif;
      endwhile;
      else:  
      get_template_part('template-parts/content/content', 'none');
      endif;
    ?>
  </div><!-- /.tx-portfolio -->

  <?php
    wp_reset_postdata();
  ?>

  <div class="clear"></div>

  <!-- pagination -->
  <?php tx_pagination_number($port_query->max_num_pages,"",$paged); ?>

<?php get_footer();