<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*  Sub Header
*/
global $tx;

$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

  if( (is_page() && $tx['sub_h_post_title']['page'] == '1') || (is_singular('post') && $tx['sub_h_post_title']['post'] == '1') || (is_singular('post') && $tx['sub_h_post_title']['post'] == '1') || (is_tag() && $tx['sub_h_post_title']['post'] == '1') || (is_category() && $tx['sub_h_post_title']['post'] == '1') || (is_author() && $tx['sub_h_post_title']['post'] == '1') || (is_singular('portfolio') && $tx['sub_h_post_title']['portfolio'] == '1') || (is_post_type_archive('portfolio') && $tx['sub_h_post_title']['portfolio'] == '1') || (is_tax('portfolio-category') && $tx['sub_h_post_title']['portfolio'] == '1') || (is_singular('service') && $tx['sub_h_post_title']['service'] == '1') || (is_post_type_archive('service') && $tx['sub_h_post_title']['service'] == '1') || (is_tax('service-category') && $tx['sub_h_post_title']['service'] == '1') || (is_singular('team') && $tx['sub_h_post_title']['team'] == '1') || (is_post_type_archive('team') && $tx['sub_h_post_title']['team'] == '1') || (is_tax('team-category') && $tx['sub_h_post_title']['team'] == '1') || (is_post_type_archive('lp_course') && $tx['sub_h_post_title']['lp_course'] == '1') || (is_singular('lp_course') && $tx['sub_h_post_title']['lp_course'] == '1') || (is_post_type_archive('product') && $tx['sub_h_post_title']['product'] == '1') || (is_singular('product') && $tx['sub_h_post_title']['product'] == '1') || (is_page() && $tx['sub_h_post_breadcrumbs']['page'] == '1') || (is_singular('post') && $tx['sub_h_post_breadcrumbs']['post'] == '1') || (is_tag() && $tx['sub_h_post_breadcrumbs']['post'] == '1') || (is_category() && $tx['sub_h_post_breadcrumbs']['post'] == '1') || (is_author() && $tx['sub_h_post_breadcrumbs']['post'] == '1') || (is_post_type_archive('service') && $tx['sub_h_post_breadcrumbs']['service'] == '1') || (is_tax('service-category') && $tx['sub_h_post_breadcrumbs']['service'] == '1') || (is_singular('service') && $tx['sub_h_post_breadcrumbs']['service'] == '1') || (is_post_type_archive('portfolio') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1') || (is_tax('portfolio-category') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1') || (is_singular('portfolio') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1') || (is_post_type_archive('team') && $tx['sub_h_post_breadcrumbs']['team'] == '1') || (is_tax('team-category') && $tx['sub_h_post_breadcrumbs']['team'] == '1') || (is_singular('team') && $tx['sub_h_post_breadcrumbs']['team'] == '1') || (is_post_type_archive('lp_course') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1') || (is_singular('lp_course') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1') || (is_post_type_archive('product') && $tx['sub_h_post_breadcrumbs']['product'] == '1') || (is_singular('product') && $tx['sub_h_post_breadcrumbs']['product'] == '1') ) : ?>

  <div class="sub-header" <?php if(is_page()) { if (has_post_thumbnail()) : echo 'style="background-image:url('.$featured_img_url.')"'; endif; } ?>>
    <div class="sub-header-overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <?php 
          if (class_exists('ReduxFramework')) {
            if($tx['sub_h_title']): 

              if ( (is_home()) && (get_option('show_on_front') == 'page') && (get_option('page_for_posts') != 0) ) :
                echo '<h1 class="sub-header-title">' . esc_html(get_the_title(get_option('page_for_posts'))) . '</h1>';
              endif;

              if(is_page() && $tx['sub_h_post_title']['page'] == '1') :
                the_title('<h1 class="sub-header-title">', '</h1>');
              endif; // page title

              if(is_singular('post') && $tx['sub_h_post_title']['post'] == '1') :
                the_title('<h1 class="sub-header-title">', '</h1>');
              endif; // post title
              if(is_tag() && $tx['sub_h_post_title']['post'] == '1') :
                the_archive_title('<h1 class="sub-header-title">', '</h1>');
              endif; // tag title
              if(is_category() && $tx['sub_h_post_title']['post'] == '1') :
                the_archive_title('<h1 class="sub-header-title">', '</h1>');
              endif; // category title
              if(is_author() && $tx['sub_h_post_title']['post'] == '1') :
                the_archive_title('<h1 class="sub-header-title">', '</h1>');
              endif; // author single page

              if(is_singular('portfolio') && $tx['sub_h_post_title']['portfolio'] == '1') :
                 the_title('<h1 class="sub-header-title">', '</h1>');
              endif; // portfolio single page
              if(is_post_type_archive('portfolio') && $tx['sub_h_post_title']['portfolio'] == '1') :
                echo '<h1 class="sub-header-title">';
                post_type_archive_title();
                echo '</h1>';
              endif; // portfolio archive page
              if(is_tax('portfolio-category') && $tx['sub_h_post_title']['portfolio'] == '1') :
                echo '<h1 class="sub-header-title">';
                single_term_title();
                echo '</h1>';
              endif; // portfolio category page

              if(is_singular('service') && $tx['sub_h_post_title']['service'] == '1') :
                the_title('<h1 class="sub-header-title">', '</h1>');
              endif; // service single page
              if(is_post_type_archive('service') && $tx['sub_h_post_title']['service'] == '1') :
                echo '<h1 class="sub-header-title">';
                post_type_archive_title();
                echo '</h1>';
              endif; // service archive page
              if(is_tax('service-category') && $tx['sub_h_post_title']['service'] == '1') :
                echo '<h1 class="sub-header-title">';
                single_term_title();
                echo '</h1>';
              endif; // service category page

              if(is_singular('team') && $tx['sub_h_post_title']['team'] == '1') :
                the_title('<h1 class="sub-header-title">', '</h1>');
              endif; // team single page
              if(is_post_type_archive('team') && $tx['sub_h_post_title']['team'] == '1') :
                echo '<h1 class="sub-header-title">';
                post_type_archive_title();
                echo '</h1>';
              endif; // team archive page
              if(is_tax('team-category') && $tx['sub_h_post_title']['team'] == '1') :
                echo '<h1 class="sub-header-title">';
                single_term_title();
                echo '</h1>';
              endif; // team category page

            if(class_exists('LearnPress')) :
              if(is_post_type_archive('lp_course') && $tx['sub_h_post_title']['lp_course'] == '1') :
                echo '<h1 class="sub-header-title">';
                post_type_archive_title();
                echo '</h1>';
              endif; // learnpress course archive page
              if(is_singular('lp_course') && $tx['sub_h_post_title']['lp_course'] == '1') :
                the_title('<h1 class="sub-header-title">', '</h1>');
              endif; // learnpress course single page
            endif;

            if(class_exists('WooCommerce')) :
              if(is_post_type_archive('product') && $tx['sub_h_post_title']['product'] == '1') :
                echo '<h1 class="sub-header-title">';
                woocommerce_page_title();
                echo '</h1>';
              endif; // woocommerce shop archive page
              if(is_singular('product') && $tx['sub_h_post_title']['product'] == '1') :
                the_title('<h1 class="sub-header-title">', '</h1>');
              endif; // woocommerce product single page
              if(is_product_category() && $tx['sub_h_post_title']['product'] == '1') :
                echo '<h1 class="sub-header-title">';
                single_term_title();
                echo '</h1>';
              endif; // woocommerce product category page
              if(is_product_tag() && $tx['sub_h_post_title']['product'] == '1') :
                echo '<h1 class="sub-header-title">';
                single_term_title();
                echo '</h1>';
              endif; // woocommerce product tag page
            endif; // woocommerce class

            endif; // title end

          } else {
              if(is_singular('post')) :
                the_title('<h1 class="sub-header-title">', '</h1>');
              endif;
              if(is_category()) :
                single_cat_title('<h1 class="sub-header-title">', '</h1>');
              endif;
              if(is_tag()) :
                single_tag_title('<h1 class="sub-header-title">', '</h1>');
              endif;
              if(is_page()) :
                the_title('<h1 class="sub-header-title">', '</h1>');
              endif;

            }
          ?>
          
        </div> <!-- title end -->

        <div class="col-lg-12 col-md-12 col-sm-12">
          <?php  
              if($tx['breadcrumbs']) :
                if(is_page() && $tx['sub_h_post_breadcrumbs']['page'] == '1'){
                  do_action('tx_breadcrumbs');
                } // page breadcrumbs

                if(is_singular('post') && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post breadcrumbs
                if(is_tag() && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post tag breadcrumbs
                if(is_category() && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post cat breadcrumbs
                if(is_author() && $tx['sub_h_post_breadcrumbs']['post'] == '1'){
                  do_action('tx_breadcrumbs');
                } // post author breadcrumbs

                if(is_post_type_archive('service') && $tx['sub_h_post_breadcrumbs']['service'] == '1'){
                  do_action('tx_breadcrumbs');
                } // service archive breadcrumbs
                if(is_tax('service-category') && $tx['sub_h_post_breadcrumbs']['service'] == '1'){
                  do_action('tx_breadcrumbs');
                } // service tax breadcrumbs
                if(is_singular('service') && $tx['sub_h_post_breadcrumbs']['service'] == '1'){
                  do_action('tx_breadcrumbs');
                } // service breadcrumbs

                if(is_post_type_archive('portfolio') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1'){
                  do_action('tx_breadcrumbs');
                } // portfolio archive breadcrumbs
                if(is_tax('portfolio-category') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1'){
                  do_action('tx_breadcrumbs');
                } // portfolio tax breadcrumbs
                if(is_singular('portfolio') && $tx['sub_h_post_breadcrumbs']['portfolio'] == '1'){
                  do_action('tx_breadcrumbs');
                } // portfolio breadcrumbs

                if(is_post_type_archive('team') && $tx['sub_h_post_breadcrumbs']['team'] == '1'){
                  do_action('tx_breadcrumbs');
                } // team archive breadcrumbs
                 if(is_tax('team-category') && $tx['sub_h_post_breadcrumbs']['team'] == '1'){
                  do_action('tx_breadcrumbs');
                } // team tax breadcrumbs
                if(is_singular('team') && $tx['sub_h_post_breadcrumbs']['team'] == '1'){
                  do_action('tx_breadcrumbs');
                } // team breadcrumbs

              if(class_exists('LearnPress')) :  
                if(is_post_type_archive('lp_course') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1'){
                  do_action('tx_breadcrumbs');
                } // lp_course archive breadcrumbs
                if(is_singular('lp_course') && $tx['sub_h_post_breadcrumbs']['lp_course'] == '1'){
                  do_action('tx_breadcrumbs');
                } // lp_course breadcrumbs
              endif;

              if(class_exists('WooCommerce')) :
                if(is_post_type_archive('product') && $tx['sub_h_post_breadcrumbs']['product'] == '1'){
                  do_action('tx_breadcrumbs');
                } // product archive breadcrumbs
                if(is_singular('product') && $tx['sub_h_post_breadcrumbs']['product'] == '1'){
                  do_action('tx_breadcrumbs');
                } // product breadcrumbs
                if(is_product_category() && $tx['sub_h_post_breadcrumbs']['product'] == '1'){
                  do_action('tx_breadcrumbs');
                } // product cat breadcrumbs
                if(is_product_tag() && $tx['sub_h_post_breadcrumbs']['product'] == '1'){
                  do_action('tx_breadcrumbs');
                } // product tag breadcrumbs
              endif; // class WooCommerce

              endif;
          ?>
        </div><!-- breadcrumbs end  -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.sub-header -->
  <?php endif; ?>