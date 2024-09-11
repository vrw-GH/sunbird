<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*
* All meta tags functions here.
*/


/* date */
if (!function_exists('tx_date')) :
  add_action('tx_date', 'tx_date');
  function tx_date() {
    if ( class_exists( 'ReduxFramework' ) ) {
    global $tx;
    if ($tx['post-time']) :
      echo '<span class="post-time"><i class="fa fa-clock-o"></i>';
      echo  the_time(' M j, Y'); 
      echo '</span>';
    endif;
    } else {
      echo '<span class="post-time"><i class="fa fa-clock-o"></i>';
      echo  the_time(' M j, Y'); 
      echo '</span>';
    }
  }
endif;


/* author */
if (!function_exists('tx_author')) :
  add_action('tx_author', 'tx_author');
  function tx_author() {
    if ( class_exists( 'ReduxFramework' ) ) {
    global $tx;
    if ($tx['post-author']) :
      echo '<span class="nickname">';
      echo '<i class="fa fa-user-o"></i> ';
      echo '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) . '">' . esc_html( get_the_author() ) . '</a>';
      echo '</span>';
    endif;
    } else {
      echo '<span class="nickname">';
      echo '<i class="fa fa-user-o"></i> ';
      echo '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) . '">' . esc_html( get_the_author() ) . '</a>';
      echo '</span>';
    }
  }
endif;

/* comments */
if (!function_exists('tx_comments')) :
  add_action('tx_comments', 'tx_comments');
  function tx_comments() {
  	global $tx;
    if ( class_exists( 'ReduxFramework' ) ) {
    if ($tx['post-comment']) :
  	if ( 'post' == get_post_type() ) {
      echo '<span class="comments-link"><i class="fa fa-comment-o"></i> ';
    if ( ! comments_open() && get_comments_number() < 1 ) :
      comments_number( esc_html__( 'No Comments', 'avas' ), esc_html__( '1 Comment', 'avas' ), esc_html__( '% Comments', 'avas' ) );
    else :
      echo '<a href="' . esc_url( get_comments_link() ) . '">';
      comments_number( esc_html__( 'No Comment', 'avas' ), esc_html__( '1 Comment', 'avas' ), esc_html__( '% Comments', 'avas' ) );
      echo '</a>';
      endif;
          echo '</span>';
      }
      endif;
    } else {
      if ( 'post' == get_post_type() ) {
      echo '<span class="comments-link"><i class="fa fa-comment-o"></i> ';
    if ( ! comments_open() && get_comments_number() < 1 ) :
      comments_number( esc_html__( 'No Comments', 'avas' ), esc_html__( '1 Comment', 'avas' ), esc_html__( '% Comments', 'avas' ) );
    else :
      echo '<a href="' . esc_url( get_comments_link() ) . '">';
      comments_number( esc_html__( 'Leave a Comment', 'avas' ), esc_html__( '1 Comment', 'avas' ), esc_html__( '% Comments', 'avas' ) );
      echo '</a>';
      endif;
          echo '</span>';
      }
    }
  }
endif;

/* category */
if (!function_exists('tx_category')) :
  add_action('tx_category', 'tx_category');
  function tx_category() {
    if ( class_exists( 'ReduxFramework' ) ) {
    global $tx; 
    if ($tx['post-category']) :
    	if (has_category()) {
        echo '<i class="fa fa-folder-open-o"></i> ' ;
        echo '<span class="post-category">';
        echo the_category(', ');
        echo '</span>';
    }
    endif;
    } else {
      if (has_category()) {
        echo '<i class="fa fa-folder-open-o"></i> ' ;
        echo '<span class="post-category">';
        echo the_category(', ');
        echo '</span>';
      }
    }
  }
endif;

/* tags */
if (!function_exists('tx_tags')) :
  add_action('tx_tags', 'tx_tags');
  function tx_tags() {
    if ( class_exists( 'ReduxFramework' ) ) {
    global $tx; 
    if ($tx['post-tag']) :
      if (has_tag( )) {
        echo '<i class="fa fa-tags"></i> ';
        echo '<span class="post-tag">';
        echo the_tags('', ', ', '<br />');
        echo '</span>';
      }
    endif;
    } else {
      if (has_tag( )) {
          echo '<i class="fa fa-tags"></i> ';
          echo '<span class="post-tag">';
          echo the_tags('', ', ', '<br />');
          echo '</span>';
        }
    }
  }
endif;

/* ---------------------------------------------------------
    Post View
------------------------------------------------------------ */

if ( ! function_exists('tx_getPostViews')) {
     // function to display number of posts.
    function tx_getPostViews($postID){
      global $tx;
      if ($tx['post-views']) :
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return '<span class="post-views"><i class="fa fa-eye"></i> 0 <span>' . esc_html__('View', 'avas') . '</span></span>';
        }
        return '<span class="post-views"><i class="fa fa-eye"></i> '.$count.' <span>' . esc_html__('Views', 'avas') . '</span></span>';
      endif;
    }
}

if ( ! function_exists('tx_setPostViews')) {
    // function to count views.
    function tx_setPostViews($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 
