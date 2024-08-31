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
  Sidebars setup
------------------------------------------------------------ */
if( !function_exists('tx_widget_setup') ) :


      add_action('widgets_init','tx_widget_setup'); 
      function tx_widget_setup() {

      // Right Sidebar 
      register_sidebar(array(
            'name'          => esc_html__( 'Post Sidebar', 'avas' ),
            'id'            => 'sidebar-post',
            'description'   => esc_html__('Display in blog, post archive.', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar Single 
      register_sidebar(array(
            'name'          => esc_html__( 'Post Single Sidebar', 'avas' ),
            'id'            => 'sidebar-single',
            'description'   => esc_html__('Display in single post', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar Page Right
      register_sidebar(array(
            'name'          => esc_html__( 'Page Sidebar Right', 'avas' ),
            'id'            => 'sidebar-page',
            'description'   => esc_html__('Will show in page right side', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar Page Left
      register_sidebar(array(
            'name'          => esc_html__( 'Page Sidebar Left', 'avas' ),
            'id'            => 'sidebar-page-left',
            'description'   => esc_html__('Will show in page left side', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar Portfolio
      global $tx;
      if(isset($tx['portfolio_post_type']) && $tx['portfolio_post_type'] == 1) :
      register_sidebar(array(
            'name'          => esc_html__( 'Portfolio Single Post Sidebar', 'avas' ),
            'id'            => 'sidebar-portfolio',
            'description'   => esc_html__('Display in Portfolio single page', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // Sidebar Services
      global $tx;
      if(isset($tx['service_post_type']) && $tx['service_post_type'] == 1) :
      register_sidebar(array(
            'name'          => esc_html__( 'Services Single Post Sidebar', 'avas' ),
            'id'            => 'sidebar-services',
            'description'   => esc_html__('Display in Team single page', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // Sidebar Team
      global $tx;
      if(isset($tx['team_post_type']) && $tx['team_post_type'] == 1) :
      register_sidebar(array(
            'name'          => esc_html__( 'Team Single Post Sidebar', 'avas' ),
            'id'            => 'sidebar-team',
            'description'   => esc_html__('Display in Services single page', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // Sidebar LearnPress
      if(class_exists('LearnPress')) :
      register_sidebar(array(
            'name'          => esc_html__( 'LearnPress Sidebar', 'avas' ),
            'id'            => 'sidebar-learnpress',
            'description'   => esc_html__('Display in LearnPress Course page', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar LearnPress Single Page
      register_sidebar(array(
            'name'          => esc_html__( 'LearnPress Single Post Sidebar', 'avas' ),
            'id'            => 'sidebar-learnpress-single',
            'description'   => esc_html__('Will show in LearnPress Course single page', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // WooCommerce Sidebar
      if(class_exists('WooCommerce')) :
      register_sidebar(array(
            'name'          => esc_html__( 'WooCommerce Shop Sidebar', 'avas' ),
            'id'            => 'sidebar-woo',
            'description'   => esc_html__('Will display in WooCommerce Shop page', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // WooCommerce Single Sidebar
      register_sidebar(array(
            'name'          => esc_html__( 'WooCommerce Single Post Sidebar', 'avas' ),
            'id'            => 'sidebar-woo-single',
            'description'   => esc_html__('Will display in WooCommerce Single product page', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // Side Menu
      global $tx;
      if(isset($tx['side_menu']) && $tx['side_menu'] == 1) :
      register_sidebar(array(
            'name'          => esc_html__( 'Side Menu', 'avas' ),
            'id'            => 'side-menu-widget',
            'description'   => esc_html__('Side menu widget', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // Mega Menu
      for($x = 1; $x < 5; $x++) {
      register_sidebar(array(
            'id'            => 'mega-menu-'.$x,
            'name'          => esc_html__('Mega Menu | '.$x, 'avas'),
            'description'   => esc_html__('Widgets for Mega Menu', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            ));
      }

      // Footer
      for($x = 1; $x < 7; $x++) {
      register_sidebar(array(
            'id'            => 'footer-'.$x,
            'name'          => esc_html__('Footer | '.$x, 'avas'),
            'description'   => esc_html__('Widgets for Footer', 'avas'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            ));
      }

      
}    

endif;

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 