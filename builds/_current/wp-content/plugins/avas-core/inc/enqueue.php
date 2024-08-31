<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*/

/* ---------------------------------------------------------
  Enqueue Scripts
------------------------------------------------------------ */
  add_action( 'wp_enqueue_scripts', 'tx_plugin_enqueue_scripts' );
  function tx_plugin_enqueue_scripts() {
    $elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

    if($elementor_page):
      wp_enqueue_style('tx-style', TX_PLUGIN_URL . '/assets/css/style.min.css');

      // rtl css
      if(is_rtl()):
        wp_enqueue_style('style-rtl', TX_PLUGIN_URL . '/assets/css/style-rtl.min.css');
      endif;
    endif;
   
  }

/* ---------------------------------------------------------
  Admin Enqueue Scripts
------------------------------------------------------------ */
  function tx_plugin_admin_enqueue_scripts() {

    if( isset($_GET["page"]) && $_GET["page"] == "avas") {
      
      wp_enqueue_script('search-options', TX_PLUGIN_URL . '/assets/js/search-options.min.js', array('jquery'), TX_PLUGIN_VERSION, true);
        // localize script
        wp_localize_script(
            'search-options',
            'tx_search_options',
            esc_html__
            ('&#61442; Search...', 'avas-core')
        );

    }
        
  }
  add_action( 'admin_enqueue_scripts', 'tx_plugin_admin_enqueue_scripts' );

  /* ---------------------------------------------------------
  EOF
------------------------------------------------------------ */