<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
* ===================
* 	Functions file
* ===================
*/

/* ---------------------------------------------------------
  Shortcode support for contact form 7
------------------------------------------------------------ */
function tx_shortcodes_in_cf7( $form ) {
$form = do_shortcode( $form );
return $form;
}
add_filter( 'wpcf7_form_elements', 'tx_shortcodes_in_cf7' );

// Enabled Shortcode for widget
add_filter('widget_text', 'do_shortcode');


/* ---------------------------------------------------------
  remove Elementor welcome screen after activate plugin
------------------------------------------------------------ */
add_action( 'admin_init', function() {
  if ( did_action( 'elementor/loaded' ) ) {
    remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
  }
}, 1 );


/* ---------------------------------------------------------
  Redux extension function
------------------------------------------------------------ */
$redux_opt_name = "tx";

if ( !function_exists( 'tx_redux_extension_loader' ) ) {
  function tx_redux_extension_loader( $ReduxFramework ) {
    $path    = dirname( __FILE__ ) . '/extensions/';
    $folders = scandir( $path, 1 );
    foreach ( $folders as $folder ) {
      if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
        continue;
      }
      $extension_class = 'ReduxFramework_Extension_' . $folder;
      if ( ! class_exists( $extension_class ) ) {
        // In case you wanted override your override, hah.
        $class_file = $path . $folder . '/extension_' . $folder . '.php';
        $class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
        if ( $class_file ) {
          require_once $class_file;
        }
      }
      if ( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
        $ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
      }
    }
  }
  // Modify {$redux_opt_name} to match your opt_name
  add_action( "redux/extensions/{$redux_opt_name}/before", 'tx_redux_extension_loader', 0 );
}

/* ---------------------------------------------------------
  remove Activate Demo Mode in pluigin
------------------------------------------------------------ */
    function tx_DemoModeLink() { 
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
        }
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
        }
    }
    add_action('init', 'tx_DemoModeLink');

/* ---------------------------------------------------------
  remove Redux menu from admin > Settings > Redux
------------------------------------------------------------ */
  add_action( 'admin_menu', 'tx_remove_submenu_page', 999 );
  function tx_remove_submenu_page() {
    remove_submenu_page( 'options-general.php', 'redux-framework');
  }

/* ---------------------------------------------------------
  Title Limit
------------------------------------------------------------ */
function tx_title($n) {
  global $post;
  $title = get_the_title($post->ID);
  $title = substr($title,0,$n);
  echo $title;
}

/* ---------------------------------------------------------
  video embed for video post format
------------------------------------------------------------ */
if(!function_exists('tx_post_video_link')) :
  add_action( 'tx_post_video_link', 'tx_post_video_link' );
  function tx_post_video_link() {
    global $post;
    $post_video_link = get_post_meta( $post->ID, 'post_link', true );
    if(!empty($post_video_link)) :
    global $wp_embed;
    $post_embed = $wp_embed->run_shortcode('[embed width="1140"]'.$post_video_link.'[/embed]');
    echo $post_embed;

    endif;
  }
endif;

/* ---------------------------------------------------------
  video embed for portfolio post type
------------------------------------------------------------ */
if(!function_exists('tx_portfolio_video_link')) :
  add_action( 'tx_portfolio_video_link', 'tx_portfolio_video_link' );
  function tx_portfolio_video_link() {
    global $post;
    $post_video_link = get_post_meta( $post->ID, 'port_vid_link', true );
    if(!empty($post_video_link)) :
    global $wp_embed;
    $post_embed = $wp_embed->run_shortcode('[embed width="1140"]'.$post_video_link.'[/embed]');
    echo $post_embed;

    endif;
  }
endif;

/* ---------------------------------------------------------
  Theme update notice
------------------------------------------------------------ */
function tx_theme_update_notice() {

  empty(wp_get_theme()->parent()) ? $vers = wp_get_theme()->Version : $vers = wp_get_theme()->parent()->Version;

  if($vers < 6.3) :
 ?>
  <script>
    jQuery(document).ready(function($){'use strict';      
      alert("<?php echo esc_html__('To work the theme properly please update the theme and clear cache from everywhere such as browser, cache plugin, CDN, etc.', 'avas-core'); ?>");
    });
  </script>
<?php 
  endif;
}
add_action('admin_head', 'tx_theme_update_notice');

/* ---------------------------------------------------------
  Remove Query Strings From Static Resources
------------------------------------------------------------ */
if(!function_exists('tx_remove_script_version')) :
  function tx_remove_script_version( $src ) {
    $parts = explode( '?ver', $src );
          return $parts[0];
  }
endif;

if(!function_exists('tx_emove_query_strings')) :
  function tx_emove_query_strings() {
    global $tx;
    if( isset($tx['remove_query_strings']) ) :
      if($tx['remove_query_strings'] == 1) :
        add_filter( 'script_loader_src', 'tx_remove_script_version', 15, 1 );
        add_filter( 'style_loader_src', 'tx_remove_script_version', 15, 1 );
      endif;
    endif;
  }
  add_action( 'init', 'tx_emove_query_strings' );

endif;

/* ---------------------------------------------------------
    Disable emojis in WordPress
------------------------------------------------------------ */
if(!function_exists('tx_disable_emojis')) :
add_action( 'init', 'tx_disable_emojis' );
function tx_disable_emojis() {
  global $tx;
  if( isset($tx['remove_wordpress_emoji']) ) :
    if($tx['remove_wordpress_emoji'] == 1) :
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
      remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
      add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    endif;
  endif;
}
endif;

if(!function_exists('disable_emojis_tinymce')) :
function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
endif;

/* ---------------------------------------------------------
  EOF
------------------------------------------------------------ */

