<?php
/**
 * 
 * @package tx
 * @author theme-x
 * @link https://theme-x.org/

/* ---------------------------------------------------------
  Project carousel
------------------------------------------------------------ */

  global $tx;
  $args = array(
      'post_type' => 'portfolio',
      'posts_per_page' => $tx['project-exp-count'],
      'post_status' => 'publish',
      'orderby' => 'rand',
    );
    $query = new WP_Query( $args ); ?>
    <?php if ( $query->have_posts() ) : ?>
     <!-- the loop -->
    <div class="project-carousel owl-carousel">
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
      <div class="item row ">
        <div class="col-md-12">
        <figure>
          <a href="<?php the_permalink(); ?>" rel="bookmark">
          <?php the_post_thumbnail('tx-pe-thumb'); ?>    
          </a>
          <figcaption>
            <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
          </figcaption>
        </figure>
        </div>
      </div>        
    <?php endwhile; ?>
    </div> <!-- end loop -->
  <?php wp_reset_postdata(); ?>
  <?php else: ?>
    <p><?php esc_html_e( 'Sorry, nothing found.', 'avas' ); ?></p>
  <?php endif; 
