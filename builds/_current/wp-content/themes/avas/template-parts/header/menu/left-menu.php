<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Left Menu
*
**/
?>
<div class="col-lg-5 d-none d-sm-none d-md-block">
				<div class="row">
				<?php
				if ( has_nav_menu( 'left_menu' ) ) {
                    wp_nav_menu( array(
                    'theme_location' => 'left_menu',
                    'menu_class'     => 'nav navbar-nav main-menu tx-mega-menu',
                    'depth'          => 5,
                    ) );
                } ?>
            	</div>
			</div>