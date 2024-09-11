<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ======================================================================
* functions for header, footer, etc.
* ======================================================================
*/

/* ---------------------------------------------------------
  Mobile version enable / disable
------------------------------------------------------------ */
add_action( 'wp_head', 'tx_mob_desk_switch', 0 );
function tx_mob_desk_switch() {
  global $tx;
  if($tx['mob_version']) : ?>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        
<?php endif;
}

/* ---------------------------------------------------------
  Layout
------------------------------------------------------------ */
// page layout
if (!function_exists('tx_page_layout')) :
  function tx_page_layout() {
  global $tx;
  if ($tx['page-layout'] == 'full-width') {
    echo '-fluid';
  }
  elseif ($tx['page-layout'] == 'boxed') {
    echo '';
  }else{
    echo '-fluid';
  }
}
endif;

// header layout
if (!function_exists('tx_header_layout')) :
  function tx_header_layout() {
  global $tx;
  if ($tx['header-layout'] == 'width') {
    echo '-fluid';
  }
  if ($tx['header-layout'] == 'boxed') {
    echo '';
  }
}
endif;

/* ---------------------------------------------------------
  Header Style
------------------------------------------------------------ */
if(!function_exists('tx_header_style')):
  add_action( 'header-style', 'tx_header_style' );  
  function tx_header_style() {
    global $tx;
    if($tx['header-select'] == 'header1') {
      get_template_part( 'template-parts/header/style/style', '1' ); 
    }
    elseif($tx['header-select'] == 'header2') {
      get_template_part( 'template-parts/header/style/style', '2' );
    }            
    elseif($tx['header-select'] == 'header3') {
      get_template_part( 'template-parts/header/style/style', '3' );
    }
    elseif($tx['header-select'] == 'header4') {
      get_template_part( 'template-parts/header/style/style', '4' );
    }  
    elseif($tx['header-select'] == 'header5') {
      get_template_part( 'template-parts/header/style/style', '5' );
    }                     
    elseif($tx['header-select'] == 'header6') {
      get_template_part( 'template-parts/header/style/style', '6' );
    }
    elseif($tx['header-select'] == 'header7') {
      get_template_part( 'template-parts/header/style/style', '7' );
    }    
    elseif($tx['header-select'] == 'header8') {
      get_template_part( 'template-parts/header/style/style', '8' );
    }
    elseif($tx['header-select'] == 'header9') {
      get_template_part( 'template-parts/header/style/style', '9' );
    }
    elseif($tx['header-select'] == 'header10') {
      get_template_part( 'template-parts/header/style/style', '10' );
    }                                     
  }
endif;

/* ---------------------------------------------------------
   Favicon
------------------------------------------------------------ */
if( !function_exists('tx_favicon') ) :
    function tx_favicon() {
      global $tx;
        if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
         if($tx['favicon'] != '') {     
          echo '<link rel="shortcut icon" href="' . wp_kses_post($tx['favicon']['url']) . '"/>';
        } else {
          echo '<link rel="shortcut icon" href="' . TX_IMAGES . 'icon.png"/>';
        }
      }
    }
endif;

/* ---------------------------------------------------------
   Logo
------------------------------------------------------------ */
if(!function_exists('tx_logo')) :
  add_action( 'tx_logo', 'tx_logo' );
  function tx_logo() {
    global $tx; 
    if ( class_exists( 'ReduxFramework' ) ) {
    ?>

        <?php if (isset($tx['tx_logo']['url']) && ($tx['tx_logo']['url'] != "" )) : ?>
          <a class="navbar-brand tx_logo" href="<?php if($tx['logo_link_url']!= "") : echo esc_url($tx['logo_link_url']); else: echo esc_url(get_site_url()); endif; ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><img src="<?php echo esc_url($tx['tx_logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a> 
        <?php endif; ?>

<?php
} elseif (has_custom_logo()) {
  $custom_logo_id = get_theme_mod( 'custom_logo' );
              $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
            echo '<a class="navbar-brand tx_logo" href="'.esc_url(get_site_url()).'"><img src="' . esc_url( $custom_logo_url ) . '" alt="' . esc_attr(get_bloginfo('name')) . '"></a>';
} else {
  echo '<a class="navbar-brand tx_logo" href="'.esc_url(get_site_url()).'"><h1>'. esc_attr(get_bloginfo('name')) .'</h1></a>';
}


  }
endif;

/* ---------------------------------------------------------
  Search popup
------------------------------------------------------------ */
if (!function_exists('tx_search')) :
  add_action( 'tx_search', 'tx_search' );
  function tx_search() { ?>
    <div id="search" class="search-form">
      <form role="search" id="search-form" class="search-box" action="<?php echo esc_url(home_url('/')); ?>" method="get">
          <input type="search" required="" aria-required="true" name="s" placeholder="<?php esc_html_e('Search here ...','avas'); ?>" value="<?php echo get_search_query(); ?>">
          <span class="search-close"><i class="la la-times"></i></span>
      </form>
    </div>
<?php
  }
endif;  
                      

/* ---------------------------------------------------------
  Menu Button
------------------------------------------------------------ */
if (!function_exists('tx_menu_btn')) :
  add_action( 'tx_menu_btn', 'tx_menu_btn' );
  function tx_menu_btn() {
    global $tx;
    if($tx['menu_btn_switch']) {
    ?>
    <div class="tx-menu-btn-wrap">
      <a href="<?php if($tx['menu_btn_url']){echo esc_url($tx['menu_btn_url']);} ?>" <?php tx_menu_btn_link_new_window(); ?> class="tx-menu-btn"><?php if($tx['menu_btn_txt']){printf(esc_html__('%s','avas'),$tx['menu_btn_txt']);} ?></a>
    </div>
<?php }
}
endif;

/* ---------------------------------------------------------
  menu button link open in new window target = _blank
------------------------------------------------------------ */
if(!function_exists('tx_menu_btn_link_new_window')) :
  function tx_menu_btn_link_new_window() {
    global $tx;

    if ($tx['menu_btn_link_new_window'] == '1') {
      echo 'target="_blank"';
    }
     if ($tx['menu_btn_link_new_window'] == '0') {
      echo '';
    }
  }
endif;

/* ---------------------------------------------------------
  Search Icon
------------------------------------------------------------ */
if(!function_exists('tx_search_icon')) :
  add_action( 'tx_search_icon', 'tx_search_icon' );
  function tx_search_icon() {
      global $tx;
      if($tx['search']) {  
       // echo '<ul class="search-icon">';
        echo '<a class="search-icon" href="#search"><i class="la la-search"></i></a>';
      //  echo '</ul>';
      }
  }
endif;

/* ---------------------------------------------------------
    cart icon
------------------------------------------------------------ */

if(!function_exists('tx_cart_icon')) :
  add_action( 'tx_cart_icon', 'tx_cart_icon' );
  function tx_cart_icon() {
    global $tx;
    if($tx['tx-cart']) : 
     if ( class_exists( 'WooCommerce' ) ) { ?> 
      <!-- <div class="woo_cart"> -->
        <?php global $woocommerce;
          echo '<a class="tx-cart" href="'. esc_url( wc_get_cart_url() ) .'"><i class="la la-shopping-cart"></i><span>'. $woocommerce->cart->cart_contents_count .'</span></a>';
        ?>
      <!-- </div> -->
        <?php  
          } else {
          echo esc_html_e('Activate WooCommerce plugin or go to Theme Options > Header > Menu > Cart Icon > Off.', 'avas');
          } 
          endif;
  }
endif;

/* ---------------------------------------------------------
  Header Banner Ads
------------------------------------------------------------ */
if (!function_exists('tx_head_ads')) :
  function tx_head_ads() {
    global $tx;
      if($tx['banner-bussiness-switch'] =='1')  : ?>
      <div class="head_ads">
        <?php if ($tx['h_ads_switch'] == '1') : 
        if (isset($tx['head_ad_banner']['url']) && ($tx['head_ad_banner']['url'] != "" ) && isset($tx['head_ad_banner_link'])) { ?>
        <a href="<?php echo esc_attr( $tx['head_ad_banner_link'] ); ?>" <?php tx_head_ad_banner_link_new_window(); ?>><img src="<?php echo esc_url($tx['head_ad_banner']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
        <?php } 
        endif;
        ?> <!-- banner ads end-->
        <?php 
        if ($tx['h_ads_switch'] == '2') :
            echo wp_sprintf( $tx['head_ad_js'] );
        endif; ?> <!-- adsense codes -->
      </div><!-- /.head_ads -->
      <?php endif; 
  }
endif;


/* ---------------------------------------------------------
  News Ticker
------------------------------------------------------------ */
if (!function_exists('tx_news_ticker')) :
  add_action( 'tx_news_ticker', 'tx_news_ticker' );
  function tx_news_ticker() {
    global $tx;
    if(isset($tx['news_ticker_categories'])) {
      $query = array(
      'posts_per_page' => $tx['newsticker-posts-per-page'],
      'cat' => $tx['news_ticker_categories'],
      'order' => $tx['news_ticker_order'],
      'nopaging' => 0,
      'meta_key' => 'post_views_count',
      'orderby' => $tx['news_ticker_orderby'],
      'post_status' => 'publish',
      );
    } else {
      $query = array(
      'posts_per_page' => $tx['newsticker-posts-per-page'],
      'order' => $tx['news_ticker_order'],
      'nopaging' => 0,
      'meta_key' => 'post_views_count',
      'orderby' => $tx['news_ticker_orderby'],
      'post_status' => 'publish',
      );
    }
    $args = new WP_Query($query);
    if ($args->have_posts()) {
    ?>
<div class="news-ticker-wrap">
    <div class="tx_news_ticker_main">
      <div class="tx_news_ticker_bar">
        <?php echo esc_html__($tx['news_ticker_bar_text'],'avas'); ?>
      </div><!-- /.tx_news_ticker_bar -->
    </div><!-- /.tx_news_ticker_main -->

    <div id="news-ticker" class="news-ticker owl-carousel">
        <?php
       
        while ($args->have_posts()) : $args->the_post();?>
          <div class="news-inner">
            <?php the_title(sprintf('<h6 class="news-ticker-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h6>'); ?>
          </div>
<?php 
        endwhile;
        wp_reset_postdata(); ?>
    </div>
</div><!-- /.news-ticker-wrap -->
<?php        
    } 
  }
endif;

/* ---------------------------------------------------------
  ads link open in new window target = _blank
------------------------------------------------------------ */
if(!function_exists('tx_head_ad_banner_link_new_window')) :

  function tx_head_ad_banner_link_new_window() {
    global $tx;

    if ($tx['head_ad_banner_link_new_window'] == '1') {
      echo 'target="_blank"';
    }
    if ($tx['head_ad_banner_link_new_window'] == '0') {
      echo '';
    }
  }

endif;

/* ---------------------------------------------------------
  Insert ads after paragraph of single post content.
------------------------------------------------------------ */
add_filter( 'the_content', 'tx_insert_post_ads' );
function tx_insert_post_ads( $content ) {
    global $tx;
    $s_ad_banner_link = (!empty($tx['s_ad_banner_link'])) ? $tx['s_ad_banner_link'] : '';
    $img_code = '<div class="ad_300_250"><a href="'.$s_ad_banner_link.'"><img src="'.$tx['s_ad_banner']['url'].'" alt="ads" ></a></div>';
    if(isset($tx['s_ad_js'])) {
    $js_code = '<div class="ad_300_250">'.$tx['s_ad_js'].'</div>';
   }
    if($tx['post_ads']) :
    if ( is_singular('post') && ! is_admin() ) {
      global $tx;
      if (!empty($tx['s_ad_banner']['url'] && $tx['s_ads_switch'])) {
        if(isset($tx['s_ads_after_p'])) {
        return tx_insert_after_paragraph( $img_code, $tx['s_ads_after_p'], $content );
        }
      }
      else{
        return tx_insert_after_paragraph( $js_code, $tx['s_ads_after_p'], $content );
      }
    }
    endif;
    return $content;
}
  
// Parent Function that makes the magic happen
function tx_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    foreach ($paragraphs as $index => $paragraph) {
 
        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }
 
        if ( $paragraph_id == $index + 1 ) {
            $paragraphs[$index] .= $insertion;
        }
    }
     
    return implode( '', $paragraphs );
}

/* ---------------------------------------------------------
  Sticky Header
------------------------------------------------------------ */
if(!function_exists('tx_sticky_header')) :

  function tx_sticky_header() {
    global $tx;

    if ($tx['sticky_header'] == '1') {
      echo 'float-panel';
    }

    if ($tx['sticky_header'] == '0') {
      echo 'no-sticky';
    }
    

  }

endif;

/* ---------------------------------------------------------
  Footer layout
------------------------------------------------------------ */
if(!function_exists('tx_footer_width')) :
function tx_footer_width() {
  global $tx;
  if ($tx['footer_layout'] == 'boxed') {
    echo '';
  }
   if ($tx['footer_layout'] == 'width') {
    echo '-fluid';
  }
}
endif;

/* ---------------------------------------------------------
  Footer Style
------------------------------------------------------------ */
if(!function_exists('tx_footer_style')):
  add_action( 'footer-style', 'tx_footer_style' );  
  function tx_footer_style() {
    global $tx;
    if($tx['footer-select'] == 'footer1') {
      get_template_part( 'template-parts/footer/style/style', '1' ); 
    }
    elseif($tx['footer-select'] == 'footer2') {
      get_template_part( 'template-parts/footer/style/style', '2' );
    }        
    elseif($tx['footer-select'] == 'footer3') {
      get_template_part( 'template-parts/footer/style/style', '3' );
    }                                      
  }
endif;

/* ---------------------------------------------------------
  Cookie Notice Bar
------------------------------------------------------------ */

add_action( 'wp_footer', 'tx_cookieconsent', 900 );

function tx_cookieconsent() {
  global $tx;
  if( $tx['cookie_notice'] ) {
  ?>
  <script>
      'use strict';
      const cc = new CookieConsent({
        type: 'opt-out',
        content: {
            header: '<?php echo esc_html__( 'Cookies used on the website!', 'avas' ); ?>',
            message: '<?php echo wp_kses_post( $tx['cookie_notice_text'] ); ?>',
            dismiss: '<?php echo esc_attr( $tx['cookie_notice_accept'] ); ?>',
            link: '<?php echo esc_attr( $tx['cookie_notice_learnmore_text'] ); ?>',
            href: '<?php echo esc_url( $tx['cookie_notice_learnmore_link'] ); ?>',
            target: '_blank',
            policy: '' // Cookie Policy
        },
        elements: {
            deny: '',
        },
        cookie: {
            expiryDays: '<?php echo esc_attr( $tx['cookie_expiry'] ); ?>',
            domain: '',
        },
        position: '<?php echo esc_attr( $tx['cookie_notice_position'] ); ?>',
        
      });
    </script>
<?php
    }
 }


/* ---------------------------------------------------------
  EOF
------------------------------------------------------------ */

