<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*
*/
/* ---------------------------------------------------------
  Pagination Older Newer
------------------------------------------------------------ */
if ( !function_exists('tx_navigation' )) :
  add_action('tx_navigation','tx_navigation');
  function tx_navigation() {
  // Don't print empty markup if there's only one page.
  if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
    return;
  }
  ?>
  <nav aria-label="Page navigation" role="navigation">
    <h2 class="sr-only"><?php esc_html_e( 'Posts navigation', 'avas' ); ?></h2>
    <ul class="pagination">
      <?php if ( get_next_posts_link() ) : ?>
      <li class="page-link"><?php next_posts_link( esc_attr__( 'Older posts', 'avas' ) ); ?></li>
      <?php endif; ?>
      <?php if ( get_previous_posts_link() ) : ?>
      <li class="page-link"><?php previous_posts_link( esc_attr__( 'Newer posts', 'avas' ) ); ?></li>
      <?php endif; ?>
    </ul><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}
endif;

/* ---------------------------------------------------------
  Pagination Prev Next
------------------------------------------------------------ */
if ( !function_exists('tx_pagination' )) :
  add_action('tx_pagination','tx_pagination');
  function tx_pagination() {
  // Don't print empty markup if there's nowhere to navigate.
  $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
  $next     = get_adjacent_post( false, '', false );
  if ( ! $next && ! $previous ) {
    return;
  }
  ?>
  <nav aria-label="Page navigation" role="navigation" class="post-navigation">
    <h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'avas' ); ?></h2>
    <ul class="pagination">
      <?php
        previous_post_link( '<li class="page-link previous" aria-label="Previous">%link</li>',  esc_attr__( 'Previous Post', 'avas' ) );
        next_post_link( '<li class="page-link next" aria-label="Next">%link</li>', esc_attr__( 'Next Post', 'avas' ) );
      ?>
    </ul><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}
endif;

/* ---------------------------------------------------------
  Pagination Number
------------------------------------------------------------ */
if ( !function_exists('tx_pagination_number' )) :
  function tx_pagination_number($numpages = '', $pagerange = '', $paged='') {
  if (empty($pagerange)) {
    $pagerange = 2;
  }
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => true,
    'prev_text'       => '<i class="la la-long-arrow-left"></i>',
    'next_text'       => '<i class="la la-long-arrow-right"></i>',
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );
  $paginate_links = paginate_links($pagination_args);
  if ($paginate_links) {
    echo "<nav class='tx-pagination'>";
    echo wp_kses_post($paginate_links); 
    echo "</nav>";
  }
}
endif;

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 