<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*/

global $tx;

/* ---------------------------------------------------------
  WooCommerce
------------------------------------------------------------ */

//Number of product per row
add_filter('loop_shop_columns', 'tx_product_columns', 999);
function tx_product_columns() {
  global $tx;  
  return $tx['woo-product-per-row'];
}

//remove frist and last class from product
add_filter( 'woocommerce_post_class', 'tx_remove_prod_post_class', 21, 3 ); 
function tx_remove_prod_post_class( $classes ) {
    if ( 'product' == get_post_type() ) {
        $classes = array_diff( $classes, array( 'first','last' ) );
    }
    return $classes;
}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'tx_product_per_page', 20 );
function tx_product_per_page( $cols ) {
    global $tx;
    $cols = $tx['woo-product-per-page'];
    return $cols;
}


 //add hover effect by grabing first gallery image
add_action( 'woocommerce_before_shop_loop_item_title', 'tx_add_hover_image_product', 15 );

function tx_add_hover_image_product() {
    global $product;
    $attachment_ids = $product->get_gallery_image_ids();
    $count = 0;
    foreach( $attachment_ids as $attachment_id ) { 
        $count++;
        //make sure you're on the Shop Page and that you only get the first image
        if(is_shop() && $count <= 1){
    ?>
            <div class="product-secondary-image" style="background-image:url('<?php echo wp_get_attachment_image_src( $attachment_id, 'full' )[0]; ?> '); "></div>
    <?php 
        }
    }
}

function tx_remove_woo_stuff(){
  remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0); // breadcrumbs
}
add_action('template_redirect', 'tx_remove_woo_stuff' );


// re order phone & email on checkout page
add_filter( 'woocommerce_checkout_fields', 'tx_checkout_fields_re_order' );
function tx_checkout_fields_re_order( $fields ) {
  $fields['billing']['billing_phone']['priority'] = 20;
  $fields['billing']['billing_email']['priority'] = 20;
  return $fields;
}

/* ----------------------------------------------------------------
    WooCommerce archive shop page Sidebar / No Sidebar
----------------------------------------------------------------- */
if(!function_exists('tx_woo_sidebar_no_sidebar')) :
  function tx_woo_sidebar_no_sidebar() {
    if (class_exists('ReduxFramework')) {
      global $tx;
      if($tx['woo-sidebar-select'] == null || $tx['woo-sidebar-select'] == 'woo-sidebar-none') {
        echo 12;
      } else {
       echo 9;
      }
    }else{
      echo 9;
    }

  }
endif;

/* ----------------------------------------------------------------
    WooCommerce product single page Sidebar / No Sidebar
----------------------------------------------------------------- */
if(!function_exists('tx_woo_single_sidebar_no_sidebar')) :
  function tx_woo_single_sidebar_no_sidebar() {
    if (class_exists('ReduxFramework')) {
      global $tx;
      if($tx['woo-single-sidebar-select'] == null || $tx['woo-single-sidebar-select'] == 'woo-single-sidebar-none') {
        echo 12;
      } else {
       echo 9;
      }
    }else{
      echo 9;
    }

  }
endif;

// add badge for new item 
add_action( 'woocommerce_before_shop_loop_item_title', 'tx_new_badge_shop_page', 3 );
          
function tx_new_badge_shop_page() {
   global $product;
   global $tx;
   $newness_days = $tx['woo-new-badge-days']; // days
   $created = strtotime( $product->get_date_created() );
   if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
    if($tx['woo-new-badge'] == '1') {
      echo '<span class="itsnew onsale">' . esc_html__( 'New', 'avas' ) . '</span>';
    }
   }
}

// rename sale badge
add_filter( 'woocommerce_sale_flash', 'tx_rename_sale_badge' );
function tx_rename_sale_badge( $html ) {
return str_replace( esc_html__( 'Sale!', 'avas' ), esc_html__( 'Sale', 'avas' ), $html );
}

/* ---------------------------------------------------------
  EOF
------------------------------------------------------------ */

