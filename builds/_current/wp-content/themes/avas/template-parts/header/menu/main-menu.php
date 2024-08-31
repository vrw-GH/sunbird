<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
**/
?>

<nav class="site-navigation navigation">

   <div class="d-none d-sm-none d-md-block">
        <div class="menubar site-nav-inner">
            <!-- Menu goes here -->
            <?php 
             if ( has_nav_menu( 'main_menu' ) ) {
                 wp_nav_menu(
                 array(
                    'theme_location' => 'main_menu',
                    'container_class' => 'navbar-responsive-collapse',
                    'menu_class' => 'nav navbar-nav main-menu tx-mega-menu',
                    'fallback_cb' => '',
                    'menu_id' => 'main-menu',
                )
            );
          }elseif(is_user_logged_in()){
                echo '<h5 class="no-menu">';
                echo esc_html_e('No Menu assigned. Go to Appearance > Menus and create a menu or select a menu if  created already.', 'avas');
                echo '</h5>';
              }
             ?>
        </div> <!-- menubar -->
    </div> <!-- desktop menu -->

    <?php 
      if ( has_nav_menu( 'mobile_menu' ) ) { 
      get_template_part( 'template-parts/header/menu/mobile', 'menu' );
     } else {
    ?>

    <div id="responsive-menu" class="d-md-none d-lg-none">
        <div class="navbar-header">
            <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="x"><i class="la la-navicon"></i></span>
            </button>
        </div><!-- /.navbar-header -->
        <div class="collapse navbar-collapse">
            <?php
              if ( has_nav_menu( 'main_menu' ) ) {
                  wp_nav_menu( array(
                      'theme_location'      => 'main_menu',
                      'container'           => false,
                      'menu_class'          => 'nav navbar-nav tx-res-menu',
                      'fallback_cb'         => '',
                      'depth'               => 5,
                      )
                  );
              }elseif(is_user_logged_in()) {
                    echo '<h5 class="no-menu">';
                    echo esc_html_e('No Menu assigned. Go to Appearance > Menus and create a menu or select a menu if  created already.', 'avas');
                    echo '</h5>';
                  }
              ?>
        </div><!-- /.navbar-collapse -->
    </div><!--/#responsive-menu-->
    <?php } ?>
  </nav><!-- End of navigation -->