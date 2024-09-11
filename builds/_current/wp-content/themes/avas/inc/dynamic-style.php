<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/

/* ---------------------------------------------------------
  Dynamic styles
------------------------------------------------------------ */
if ( !function_exists( 'tx_custom_css' ) ) :
  add_action('wp_head', 'tx_custom_css');
  function tx_custom_css() {
    global $tx;
    // cumstom header background image support for all header styles
    if ( get_header_image() ) : ?>
      <style type="text/css">
        #h-style-1,#h-style-2,#h-style-3,#h-style-4,#h-style-5,#h-style-6,#h-style-7,#h-style-8,#h-style-9,#h-style-10 {
          background-image: url(<?php header_image(); ?>) !important;
        }
      </style>
    <?php endif;

    // header style 10 position
     if($tx['header-style-10-position'] == 'right') : ?>
      <style type="text/css">
        #h-style-10{left:auto;right:0;}
      </style>
    <?php endif; ?>

    <!-- header style 10 width -->
    <style type="text/css">#h-style-10{width:<?php echo esc_attr($tx['header-style10-width']); ?>px}</style>
    
<?php
    // Menu alignment
     if($tx['menu-alignment'] == 'none') : ?>
      <style type="text/css">
        .main-menu{float:none}
      </style>
    <?php endif;
    if($tx['menu-alignment'] == 'left') : ?>
      <style type="text/css">
        .main-menu{float:left}
      </style>
    <?php endif;
    if($tx['menu-alignment'] == 'right') : ?>
      <style type="text/css">
        .main-menu{float:right}
      </style>
    <?php endif;
    if($tx['menu-alignment'] == 'center') : ?>
      <style type="text/css">
        .main-menu{float:none;text-align:center;display:block}
      </style>
    <?php endif;

    // Menu Highlight callouts text button animation
    if($tx['menu-highlight-animation'] == 1) : ?>
      <style type="text/css">
        .tx-menu-highlight{animation:none}
      </style>
    <?php endif;

    // Menu Item animated border 
    if($tx['menu_item_border'] == 1) : ?>
      <style type="text/css">
        .main-menu>li:hover>a:hover:before{opacity:1}
      </style>
    <?php endif;
    // Top border
    if($tx['menu_item_border_select'] == 'menu_item_border_top' ) : ?>
      <style type="text/css">
        .main-menu>li a:before {top:0;border-top:2px solid}
      </style>
    <?php endif; 
    // Bottom border
    if ($tx['menu_item_border_select'] == 'menu_item_border_bottom') : ?>
      <style type="text/css">
        .main-menu>li a:before {bottom:0;border-bottom:2px solid}
      </style>
    <?php endif;

    // Menu Item Separator
    if($tx['menu-item-seprator'] == 1) : ?>
      <style type="text/css">
        .main-menu>li.menu-item-has-children>a:after {display: none}
      </style>
    <?php endif;

    // menu drop down arrow
    if($tx['menu-dropdown-icon'] == 1) : ?>
      <style type="text/css">
        .main-menu>li.menu-item-has-children>a:after {content: "\f107";top:<?php echo esc_attr($tx['menu-dropdown-icon-valign']); ?>px}
      </style>
    <?php endif;

    // Responsive menu backgroung color
     if(isset($tx['mobile-menu-bg-color'])) : ?>
      <style type="text/css">
        @media (max-width: 768px){.navbar-nav{background-color: <?php echo esc_attr($tx['mobile-menu-bg-color']); ?>;}}
      </style>
    <?php endif;

    // Responsive menu item color
    if(isset($tx['mobile-menu-item-color'])) : ?>
      <style type="text/css">
        @media (max-width: 768px){.navbar-collapse>ul>li>a, .navbar-collapse>ul>li>ul>li>a, .navbar-collapse>ul>li>ul>li>ul>li>a, .navbar-collapse>ul>li>ul>li>ul>li>ul>li>a, .navbar-collapse>ul>li>ul>li>ul>li>ul>li>ul>li>a,.mb-dropdown-icon:before{color: <?php echo esc_attr($tx['mobile-menu-item-color']); ?> !important}}
      </style>
    <?php endif; 

    // Menu button border radius
    if(!empty($tx['menu-btn-border-radius'])) : ?>
      <style type="text/css">
        .tx-menu-btn {border-radius: <?php echo esc_attr($tx['menu-btn-border-radius']); ?>px}
      </style>
    <?php endif;

    // Logo resize desktop
    if( !empty($tx['logo-resize']) ) : ?>
      <style type="text/css">
        .tx_logo img {height:<?php echo esc_attr($tx['logo-resize']); ?>px}
      </style>
    <?php endif;

    // Logo resize responsive
    if( !empty($tx['logo-resize-responsive']) ) : ?>
      <style type="text/css">
        @media(max-width: 768px){.tx_logo img {height:<?php echo esc_attr($tx['logo-resize-responsive']); ?>px}}
      </style>
    <?php endif;

  // header overlay
    if ($tx['header_overlay'] == 1) : ?>
      <style type="text/css">
        .home .tx-header {position: absolute}
      </style>
    <?php endif;

  // sticky header enable / disable
     if($tx['sticky_header'] == 1) : 
      $scroll = $tx['sticky-scroll'];
    ?>
      <style type="text/css">
        .sticky-header .header-style-one,.sticky-header .header-style-two,.sticky-header #h-style-3.main-header,.sticky-header .header-style-four,.sticky-header .header-style-five,.sticky-header .header-style-six,.sticky-header .header-style-seven,.sticky-header .header-style-eight,.sticky-header #h-style-9.main-header {position: fixed;width: 100%;top: 0;z-index: 1000;}
        .sticky-header .header-style-five .banner-business {display: none;}
        .admin-bar .sticky-header .header-style-one,.admin-bar .sticky-header .header-style-two,.admin-bar .sticky-header #h-style-3.main-header,.admin-bar .sticky-header .header-style-four,.admin-bar .sticky-header .header-style-five,.admin-bar .sticky-header .header-style-six,.admin-bar .sticky-header .header-style-seven,.admin-bar .sticky-header .header-style-eight,.admin-bar .sticky-header #h-style-9.main-header {top: 32px}
      </style>

      <script>
        jQuery(document).ready(function(e){"use strict";e(document).on("scroll",function(){e(document).scrollTop()>=<?php echo esc_attr($scroll);?>?e("#header").addClass("sticky-header"):e("#header").removeClass("sticky-header")})});    
      </script>
    
    <?php endif;
    if($tx['sticky_main_header'] == 0) : ?>
      <style type="text/css">
        .sticky-header #h-style-1,.sticky-header #h-style-2,.sticky-header #h-style-4,.sticky-header #h-style-6,.sticky-header #h-style-7,.sticky-header #h-style-8 {display: none}
      </style>
    <?php endif;

    // Portfolio style    
    global $post;
    if( !is_object($post) ) :
      return;
    endif;

    $gutter = get_post_meta($post->ID, 'gutter', true);
    if($gutter) : ?>
      <style type="text/css">
        .tx-portfolio-item .tx-port-img, .tx-portfolio-item .tx-port-overlay {margin:<?php echo esc_attr($gutter); ?>px}
      </style>
    <?php endif;
    
    // woocommerce
    if(class_exists('WooCommerce')) :
    if($tx['woo_number_result'] == '0') : ?>
      <style type="text/css">
        .woocommerce-result-count {display: none}
      </style>
    <?php endif;

    if($tx['woo_default_sorting_dropdown'] == '0') : ?>
      <style type="text/css">
        .woocommerce-ordering {display: none}
      </style>
    <?php 
    endif;
    endif;

    // LearnPress
    if(class_exists('LearnPress')) :
    if($tx['lp_search'] == '0') : ?>
      <style type="text/css">
        .post-type-archive-lp_course .learn-press-search-course-form {display: none}
      </style>
    <?php endif;
    endif;
    
    // Custom CSS
    if(!empty($tx['custom_css'])) : ?>
      <style type="text/css">
        <?php echo esc_attr( $tx['custom_css'] ); ?>
      </style>
    <?php 
    endif;
    

    // Footer top widget alignment
    if($tx['footer-top-widget-alignment'] == 'left') : ?>
      <style type="text/css">
        #footer-top aside{display:block;}
      </style>
    <?php endif;

    if($tx['footer-top-widget-alignment'] == 'center') : ?>
      <style type="text/css">
        #footer-top aside{display:table;}
      </style>
    <?php endif;


  } // function tx_custom_css
endif;

    // Custom JS Head
    add_action('wp_head', 'custom_js_head');
    function custom_js_head() {
      global $tx;
      if( !empty($tx['custom_js_head']) ) {
        echo wp_sprintf( $tx['custom_js_head'] ); 
      }
    }

    // Custom JS Footer
    add_action('wp_footer', 'custom_js_footer');
    function custom_js_footer() {
      global $tx;
      if( !empty($tx['custom_js_footer']) ) {
        echo  wp_sprintf( $tx['custom_js_footer'] ) ; 
      }
    }
   
 // EOF       