<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Portfolio archives
*
**/

global $tx;
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


<div class="container space-content">
  <div class="tx-row">

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
        ?>

          <div class="col-lg-4 col-sm-6 tx-portfolio-item">
            <div class="tx-port-img">
              <?php
                $img_url = get_the_post_thumbnail_url(get_the_ID(), '');
                $img_h_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-h-thumb');
                $img_v_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-v-thumb');
              ?>
              
                <img src="<?php echo esc_attr($img_h_grid); ?>" alt="<?php the_title(); ?>" >
              
            </div><!-- /.tx-port-img -->

            <div class="tx-port-overlay">
              <div class="tx-port-overlay-content">
              <?php if($cat != '') : ?>
                <div class="tx-port-cat">
                  <a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_attr($cat); ?></a>
                </div><!-- /.tx-port-cat -->
              <?php endif; ?>
                  <h4 class="tx-port-title"><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
                <div class="tx-port-enlrg-link">
                    <a class="tx-port-enlarge" href="#item-<?php echo get_the_id(); ?>" data-effect="mfp-zoom-in"><i class="la la-search"></i></a>
                    <a class="tx-port-link" href="<?php echo get_the_permalink(); ?>"><i class="la la-link"></i></a>
                </div><!-- ./tx-port-enlrg-link -->
              </div><!-- /.tx-port-overlay-content -->
            </div><!-- ./tx-port-overlay -->

            <?php $img_enlarge = get_the_post_thumbnail(get_the_ID(), 'full'); ?>
              <div id="item-<?php echo get_the_id(); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
                <?php echo wp_sprintf($img_enlarge); ?>
              </div>
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