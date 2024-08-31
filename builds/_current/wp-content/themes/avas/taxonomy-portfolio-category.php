<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Portfolio taxonomy archives
*
**/

global $tx;
get_header();
?>


<div class="container space-content">
  <div class="tx-row">

  <?php
  $term = get_queried_object();
  $args = array(
          'post_type'           => 'portfolio',
          'status'              => 'published',
          'portfolio-category'  => $term->slug,
          'posts_per_page'      => -1,
    );

  $port_query = new WP_Query( $args );
  ?>

  <div class="tx-portfolio">
    <?php
      if ($port_query->have_posts()) : while ($port_query->have_posts()) : $port_query->the_post();

        if ( has_post_thumbnail() ) :
        ?>

          <div class="col-lg-4 col-sm-6 tx-portfolio-item">
            <div class="tx-port-img">
              <?php
                $img_url = get_the_post_thumbnail_url(get_the_ID(), '');
                $img_h_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-h-thumb');
                $img_v_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-v-thumb');
                $img_name = get_post(get_post_thumbnail_id())->post_title;
              ?>
              
                <img src="<?php echo esc_attr($img_h_grid); ?>" alt="<?php echo esc_attr($img_name); ?>" >
              
            </div><!-- /.tx-port-img -->

            <div class="tx-port-overlay">
              <div class="tx-port-overlay-content">
                <?php if(!empty($term->name)) : ?>
                <div class="tx-port-cat">
                  <a href="#"><?php echo esc_attr($term->name); ?></a>
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

<?php get_footer();