<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ======================================================================
*   This is main functions file you may add your custom functions here. 
* ======================================================================
*/
/**

 *        Hide SKU, Cats, Tags @ Single Product Page - WooCommerce

*/

 remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

//Hide Price Range for WooCommerce Variable Products
add_filter( 'woocommerce_variable_sale_price_html', 
'lw_variable_product_price', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 
'lw_variable_product_price', 10, 2 );

function lw_variable_product_price( $v_price, $v_product ) {

// Product Price
$prod_prices = array( $v_product->get_variation_price( 'min', true ), 
                            $v_product->get_variation_price( 'max', true ) );
$prod_price = $prod_prices[0]!==$prod_prices[1] ? sprintf(__('From: %1$s', 'woocommerce'), 
                       wc_price( $prod_prices[0] ) ) : wc_price( $prod_prices[0] );

// Regular Price
$regular_prices = array( $v_product->get_variation_regular_price( 'min', true ), 
                          $v_product->get_variation_regular_price( 'max', true ) );
sort( $regular_prices );
$regular_price = $regular_prices[0]!==$regular_prices[1] ? sprintf(__('From: %1$s','woocommerce')
                      , wc_price( $regular_prices[0] ) ) : wc_price( $regular_prices[0] );

if ( $prod_price !== $regular_price ) {
$prod_price = '<del>'.$regular_price.$v_product->get_price_suffix() . '</del> <ins>' . 
                       $prod_price . $v_product->get_price_suffix() . '</ins>';
}
return $prod_price;
}

//Hide “From:$X”
add_filter('woocommerce_get_price_html', 'lw_hide_variation_price', 10, 2);
function lw_hide_variation_price( $v_price, $v_product ) {
$v_product_types = array( 'variable');
if ( in_array ( $v_product->product_type, $v_product_types ) && !(is_shop()) ) {
return '';
}
// return regular price
return $v_price;
}

 add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 9999 );
  function remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}


add_filter("woocommerce_reset_variations_link", "__return_false" );

// Remove the product description Title
add_filter( 'woocommerce_product_description_heading', '__return_null' );



global $tx;
$theme = wp_get_theme();
if ( ! defined( 'TX_THEME_VERSION' ) ) {
  define('TX_THEME_VERSION', $theme->get('Version'));
}
if ( ! defined( 'TX_THEME_DIR' ) ) {
  define( 'TX_THEME_DIR', trailingslashit( get_template_directory() ) );
}
if ( ! defined( 'TX_THEME_URL' ) ) {
  define( 'TX_THEME_URL', trailingslashit( get_template_directory_uri() ) );
}
if ( ! defined( 'TX_STYLESHEET_DIR' ) ) {
  define( 'TX_STYLESHEET_DIR', trailingslashit( get_stylesheet_directory() ) );
}
if ( ! defined( 'TX_STYLESHEET_URL' ) ) {
  define( 'TX_STYLESHEET_URL', trailingslashit( get_stylesheet_directory_uri() ) );
}
if ( ! defined( 'TX_CSS' ) ) {
  define( 'TX_CSS', TX_THEME_URL . 'assets/css/' );
}
if ( ! defined( 'TX_JS' ) ) {
  define( 'TX_JS', TX_THEME_URL . 'assets/js/' );
}
if ( ! defined( 'TX_IMAGES' ) ) {
  define( 'TX_IMAGES', TX_THEME_URL . 'assets/images/' );
}

// Welcome Screen
require_once TX_THEME_DIR . 'inc/welcome.php';

// TGM plugin activation
require_once TX_THEME_DIR . 'inc/tgm.php';

// Functions for header, footer, logo, favicon, etc
require_once TX_THEME_DIR . 'inc/functions.php';

// Theme options
require_once TX_THEME_DIR . 'inc/theme-options.php';

// Dynamic Styles
require_once TX_THEME_DIR . 'inc/dynamic-style.php';

// Demo Import
require_once TX_THEME_DIR . 'inc/import.php';

// Ajax Login
require_once TX_THEME_DIR . 'inc/login.php'; 

// Mega Menu
require_once TX_THEME_DIR . 'inc/mega-menu.php';

// Post Meta Categories, Tags etc
require_once TX_THEME_DIR . 'inc/post-meta.php';

// Pagination
require_once TX_THEME_DIR . 'inc/pagination.php';

// Comments callback
require_once TX_THEME_DIR . 'inc/comments-callback.php';

// Widgets Sidebars
require_once TX_THEME_DIR . 'inc/custom-sidebars.php';

// LearnPress plugin's functions for Education
if ( class_exists( 'LearnPress' ) ) {
  require_once TX_THEME_DIR . 'learnpress/lp-functions.php'; 
}

// Woocommerece plugin's functions for eCommerce Shop
if ( class_exists( 'WooCommerce' ) ) {
  require_once TX_THEME_DIR . 'woocommerce/woo-functions.php'; 
}

/* ---------------------------------------------------------
   Enqueue Styles and Scripts
------------------------------------------------------------ */ 

if(!function_exists('tx_enqueue')):
  add_action('wp_enqueue_scripts', 'tx_enqueue');
  function tx_enqueue() {
  global $tx;
  // CSS
  wp_enqueue_style( 'bootstrap', TX_CSS . 'bootstrap.min.css' ); 
  wp_enqueue_style( 'tx-main', TX_CSS . 'main.min.css' );
  wp_enqueue_style( 'font-awesome-4', TX_CSS . 'font-awesome.min.css' ); // v4.7.0
  wp_enqueue_style( 'fontawesome', TX_CSS . 'fontawesome.min.css' ); // v5+
  wp_enqueue_style( 'line-awesome', TX_CSS . 'line-awesome.min.css' );
  wp_enqueue_style( 'owl-carousel', TX_CSS . 'owl.carousel.min.css' );
  wp_enqueue_style( 'lightslider', TX_CSS . 'lightslider.min.css' );

  // rtl support
  if(is_rtl()):
    wp_enqueue_style( 'tx-rtl', TX_CSS . 'rtl.min.css');
  endif;

  // JS
  wp_enqueue_script( 'tx-main-scripts', TX_JS . 'main.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'bootstrap', TX_JS . 'bootstrap.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'owl-carousel', TX_JS . 'owl.carousel.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'lightslider', TX_JS . 'lightslider.min.js', array('jquery'), false, true );

  if( $tx['cookie_notice'] ) :
    wp_enqueue_script( 'cookieconsent', TX_JS . 'cookieconsent.min.js', array('jquery'), false, true );
  endif;
  
  // Load WP Comment Reply JS
  if( is_singular() && comments_open() ) {
    wp_enqueue_script( 'comment-reply' );
  }

}
endif;

/* ---------------------------------------------------------
   Enqueue Styles for Admin
------------------------------------------------------------ */
if( !function_exists('tx_admin_enqueue') ):
  add_action('admin_enqueue_scripts', 'tx_admin_enqueue');
  function tx_admin_enqueue() {

    wp_enqueue_style( 'tx-admin-style', TX_CSS . 'admin.min.css' );
    wp_enqueue_style( 'font-awesome-admin', TX_CSS . 'font-awesome.min.css' ); // v4.7.0
  }
endif;


/* ---------------------------------------------------------
  Theme Setup
------------------------------------------------------------ */

if( !function_exists('tx_theme_setup') ) :
  add_action( 'after_setup_theme', 'tx_theme_setup' );
  function tx_theme_setup() {

    // menu setup
    register_nav_menus (array(
      'top_menu'    => esc_html__('Top Menu','avas'),
      'main_menu'   => esc_html__('Main Menu','avas'),
      'left_menu'   => esc_html__('Left Menu(For Header Style 9 only)','avas'),
      'right_menu'  => esc_html__('Right Menu(For Header Style 9 only)','avas'),
      'side_menu'   => esc_html__('Side Header Menu','avas'),
      'footer_menu' => esc_html__('Footer Menu','avas'),
      'mobile_menu' => esc_html__('Mobile Menu','avas'),
    ));

    // Makes theme available for translation.
    load_theme_textdomain( 'avas', TX_THEME_DIR . '/languages' );

    // Supported posts formats
    add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

    // Add RSS Links to head section
    add_theme_support( 'automatic-feed-links' );

    // Title tag support
    add_theme_support( 'title-tag' );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
      'height'      => 100,
      'width'       => 400,
      'flex-height' => true,
      'flex-width'  => true,
      'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Custom header support
    $args = array(
        'width'              => 1920,
        'height'             => 100,
        'flex-width'         => true,
        'flex-height'        => true,
    );
    add_theme_support( 'custom-header', $args );

    // Custom backgrounds support
    add_theme_support( 'custom-background', array() );

  // WooCommerce support
  if ( class_exists( 'WooCommerce' ) ) {

    add_theme_support('woocommerce');

    // WooCommerce product gallery zoom support
    add_theme_support( 'wc-product-gallery-zoom' );

    // WooCommerce product gallery lightbox support
    add_theme_support( 'wc-product-gallery-lightbox' );

    // WooCommerce product gallery slider support
    add_theme_support( 'wc-product-gallery-slider' );
  }
    // Enable WP Responsive embedded content
    add_theme_support( 'responsive-embeds' );

    // Enable WP Gutenberg Align Wide
    add_theme_support( 'align-wide' );

    // Enable WP Gutenberg Block Style
    add_theme_support( 'wp-block-styles' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Partial refresh support in the Customize
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Enable support for custom Editor Style.
    add_editor_style( 'custom-editor-style.css' );

    // Enable Custom Color Scheme For Block Style
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'deep cerise', 'avas' ),
            'slug' => 'deep-cerise',
            'color' => '#e51681',
        ),    
        array(
            'name' => esc_html__( 'strong magenta', 'avas' ),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name' => esc_html__( 'light grayish magenta', 'avas' ),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ),
        array(
            'name' => esc_html__( 'very light gray', 'avas' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => esc_html__( 'very dark gray', 'avas' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
        array(
            'name'  =>  esc_html__( 'strong blue', 'avas' ),
            'slug'  => 'strong-blue',
            'color' => '#0073aa',
        ),
        array(
            'name'  =>  esc_html__( 'lighter blue', 'avas' ),
            'slug'  => 'lighter-blue',
            'color' => '#229fd8',
        ),
    ) );

    // Block Font Sizes
    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => esc_html__( 'Small', 'avas' ),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__( 'Regular', 'avas' ),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => esc_html__( 'Large', 'avas' ),
            'size' => 36,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__( 'Huge', 'avas' ),
            'size' => 50,
            'slug' => 'larger'
        )
    ) );

    // Content Width
    if ( ! isset( $content_width ) ) {
      $content_width = 1140;
    }
  }
endif;

/* ------------------------------------------------------------------------
  Enable support for Post Thumbnails on posts, pages and custom post type.
--------------------------------------------------------------------------- */ 
if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
    add_image_size('tx-xxl-thumb', 1920, 1280, false); // Double Extra large thumbnail
    add_image_size('tx-xxl-gallery', 1920, 1280, false); // Double Extra large thumbnail
    add_image_size('tx-1920x600-thumb', 1920, 600, true); // full width 1920x600px
    add_image_size('tx-xl-thumb', 1140, 500, true); // Extra large thumbnail
    add_image_size('tx-l-thumb', 750, 420, true); // large thumbnail
    add_image_size('tx-ts-thumb', 470, 560, true); // team single thumbnail
    add_image_size('tx-t-thumb', 270, 300, true); // team template thumbnail
    add_image_size('tx-tf-thumb', 320, 360, true); // team full width template
    add_image_size('tx-s-thumb', 100, 75, true); // small thumbnail
    add_image_size('tx-pe-thumb', 150, 100, true); // project experience thumbnail
    add_image_size('tx-m-thumb', 580, 460, true ); // medium thumbnail
    add_image_size('tx-serv-thumb', 370, 270, true ); // services thumbnail
    add_image_size('tx-serv-overlay-thumb', 370, 470, true ); // services overlay thumbnail
    add_image_size('tx-ms-size', 350, 220, true ); // medium small
    add_image_size('tx-bc-thumb', 360, 220, true); // blog three cols, two cols
    add_image_size('tx-r-thumb', 270, 188, true); // related post thumbnail
    add_image_size('tx-c-thumb', 320, 220, true); // Posts carousel widget thumbnail
    add_image_size('tx-port-grid-h-thumb', 485, 335, true); // Portfolio grid horizontal thumbnail
    add_image_size('tx-port-grid-v-thumb', 390, 438, true); // Portfolio grid vertical thumbnail
    add_image_size('tx-timeline-thumb', 460, 300, true); // Timeline widget thumbnail
    add_image_size('tx-admin-post-thumb', 80, 80, false); // thumbail on all posts type in backend
    add_image_size('tx-masonry-cols-3', 620); // Post masonry widget thumbnail for 3 columns post full width
    add_image_size('tx-masonry-cols-4', 460); // Post masonry widget thumbnail for 4 columns post full width
    add_image_size('tx-masonry-cols-5', 365); // Post masonry widget thumbnail for 5 columns post full width
    add_image_size('tx-masonry-cols-6', 300); // Post masonry widget thumbnail for 6 columns post full width

/* ---------------------------------------------------------
  Title limit
------------------------------------------------------------ */
  function tx_max_title_length( $title ) {
    global $tx;
      if (class_exists('ReduxFramework')) {

        $max = $tx['title-length']; 
        if( strlen( $title ) > $max ) {
        return substr( $title, 0, $max );
        } else {
        return $title;
        }

      }else{

        $max = 85;
        if( strlen( $title ) > $max ) {
        return substr( $title, 0, $max );
        } else {
        return $title;
      }
    }
  }

  // avoid menu title
  function tx_set_title_length() {
    add_filter( 'the_title', 'tx_max_title_length', 10, 2);
  }

 // avoid menu title
 add_action( 'loop_start', 'tx_set_title_length');


/* ---------------------------------------------------------
  Excerpt word limit
------------------------------------------------------------ */
  function tx_excerpt($limit) {
    global $tx;
    if (class_exists('ReduxFramework')) {
     $limit = $tx['excerpt-word-limit'];
    }else{
      $limit = 35;
    }
      $excerpt = explode(' ', '<p class="tx-excerpt">'.get_the_excerpt().'</p>', $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      if(class_exists('ReduxFramework')) {
        $rmt = $tx['read-more-text'];
        if($tx['read-more']) :
          
          $excerpt .= '<div class="tx-read-more"><a href="'. esc_url(get_permalink()) .'">'. esc_html($rmt) .'</a></div>';

        endif;
      }
      return $excerpt;
  }
  add_filter('the_excerpt', 'tx_excerpt');

/* ---------------------------------------------------------
  Excerpt word limit
------------------------------------------------------------ */
function tx_excerpt_limit($limit) {

      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt);
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

      return $excerpt;
  }

/* ---------------------------------------------------------
  Content word limit
------------------------------------------------------------ */
  function tx_content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
  }

/* ---------------------------------------------------------
  Page content
------------------------------------------------------------ */
if(!function_exists('tx_content_page')) :
  add_action( 'tx_content_page', 'tx_content_page' );
  function tx_content_page() { ?>
        <div id="primary" class="col-md-12">
            <div id="main" class="site-main">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content/content', 'page'); ?>
                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                <?php endwhile; // end of the loop.  ?>
            </div><!-- #main -->
        </div><!-- #primary -->

<?php }

endif;

/* ---------------------------------------------------------
  Post format
------------------------------------------------------------ */
function tx_post_format( $template ) {
    if ( is_single() && has_post_format() ) {
        $post_format_template = locate_template( 'single-' . get_post_format() . '.php' );
        if ( $post_format_template ) {
            $template = $post_format_template;
        }
    }

    return $template;
}   
add_filter( 'template_include', 'tx_post_format' );


/* ----------------------------------------------------------------
    Index, Archives, Category etc post page Sidebar / No Sidebar
----------------------------------------------------------------- */
if(!function_exists('tx_sidebar_no_sidebar')) :
  function tx_sidebar_no_sidebar() {
    if (class_exists('ReduxFramework')) {
      global $tx;
      if($tx['sidebar-select'] == null || $tx['sidebar-select'] == 'sidebar-none') {
        echo 12;
      } else {
       echo 8;
      }
    }else{
      echo 8;
    }

  }
endif;

/* ---------------------------------------------------------
    Single Post Sidebar / No Sidebar
------------------------------------------------------------ */
if(!function_exists('tx_single_sidebar')) :
  function tx_single_sidebar() {
    global $tx;
    if($tx['sidebar-single'] == null || $tx['sidebar-single'] == 'sidebar-none') {
      echo 12;
    } else {
     echo 8;
    }
  }
endif;

/* ---------------------------------------------------------
    Add sideber class to body for index, archive etc page
------------------------------------------------------------ */
if ( !function_exists('tx_sidebar_class_body_archive')) :

    add_filter('body_class', 'tx_sidebar_class_body_archive');
    function tx_sidebar_class_body_archive($classes = '') {
        global $tx;
        if($tx['sidebar-select'] == 'sidebar-right') {
        $classes[] = 'sidebar-right';
        }

        elseif ($tx['sidebar-select'] == 'sidebar-left') {
            $classes[] = 'sidebar-left';
        }else{
            $classes[] = 'no-sidebar';
        }
    return $classes;

    }
endif;

/* ---------------------------------------------------------
    Add sideber class to body for single post
------------------------------------------------------------ */
if ( !function_exists('tx_sidebar_classes_body_single')) :

    add_filter('body_class', 'tx_sidebar_classes_body_single');
    function tx_sidebar_classes_body_single($classes = '') {
        global $tx;
        if($tx['sidebar-single'] == 'sidebar-right') {
        $classes[] = 'sidebar-right';
        }

        elseif ($tx['sidebar-single'] == 'sidebar-left') {
            $classes[] = 'sidebar-left';
        }else{
            $classes[] = 'no-sidebar';
        }
    return $classes;

    }
endif;

/* ---------------------------------------------------------
    Remove Category: and Tag: word from archive title
------------------------------------------------------------ */
if(!function_exists('tx_remove_cat_tag_word')) :
function tx_remove_cat_tag_word( $title ) {
    if ( is_category() || is_tag() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'tx_remove_cat_tag_word' );
endif;

/* ---------------------------------------------------------
    Tag limit
------------------------------------------------------------ */

//Register tag cloud filter callback
add_filter('widget_tag_cloud_args', 'tx_tag_widget_limit');
//Limit number of tags inside widget
function tx_tag_widget_limit($args) {
    global $tx;
//Check if taxonomy option inside widget is set to tags
if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
$args['number'] = $tx['tag_limit']; //Limit number of tags
}
return $args;
}

/* ---------------------------------------------------------
    Display post thumbnail on posts list at backend
------------------------------------------------------------ */

function tx_admin_post_cols($cols) {
    return array_merge(
        array_splice($cols, 0, 1),
        ["tx-admin-thumb" => "Thumb"],
        $cols
    );
}

function tx_admin_post_thumb_col($col, $id) {
    if ($col == "tx-admin-thumb") {
        $link = get_edit_post_link();
        $thumb = get_the_post_thumbnail($id, "tx-admin-post-thumb");
        echo wp_kses_post($thumb ? "<a href='$link'>$thumb</a>" : '<img src="'.TX_IMAGES.'no-image.png">');
    }
}

add_filter('manage_posts_columns','tx_admin_post_cols');
add_action('manage_posts_custom_column', 'tx_admin_post_thumb_col', 10, 2 );


/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */




