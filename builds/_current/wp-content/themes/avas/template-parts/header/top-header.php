<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*  Top Header
*/
global $tx;
?>

<?php if ($tx['top_head']) : ?>
    <div id="top_head" class="top-header">
        <div class="container<?php echo tx_header_layout(); ?>">
        	<div class="row alt-row-sm">
        		<div class="col-md-7 col-sm-12 col-xs-12">
                    <div class="row">
        			<div class="top-header-left-area">
                        <?php if($tx['tx-date']) { ?>
                            <div class="tx-date">
                                <i class="fa fa-clock-o"></i><?php echo date('l, d M y '); ?>
                            </div><!-- /.tx-date -->
                        <?php } // Date
                    	 
                           	$welcome_msg = $tx['welcome_msg'];
                            if( $tx['wm_switch'] ) {
                                echo '<div class="welcome_msg">'.$welcome_msg.'</div>';
                            } // welcome message

                            if($tx['tx-phone']) : ?>
                                <div class="phone-number">
                                    <i class="fa fa-phone-square"></i><?php echo esc_html($tx['phone-number']); ?>
                                </div>
                        <?php endif; // Phone Number

                            if($tx['tx-email']) : ?>
                                <div class="email-address">
                                    <i class="fa fa-envelope-o"></i><?php echo esc_html($tx['email-address']); ?>
                                </div>
                        <?php endif; // Email Address
                            if($tx['news_ticker']) {
                                do_action('tx_news_ticker');
                            } // News Ticker
                        ?>
                           
                	</div><!-- /.top-header-left -->
                </div>
            	</div><!-- /.col-md-7 col-sm-12 col-xs-12 -->

            	<div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="top-header-right-area">
                            <?php 
                                
                                if ($tx['social_buton_top']) : ?>
                                        <div class="social_media"> 
                                            <?php if (function_exists('tx_social_media')) :
                                                      echo tx_social_media(); 
                                                  endif;
                                            ?>
                                        </div>
                                <?php endif; //social buttons

                                if ($tx['login_reg']) :
                                    tx_login_register();
                                endif; // login

                                if($tx['top_menu'] ) :
                                    if ( has_nav_menu( 'top_menu' ) ) { ?>
                                    <div class="d-none d-sm-none d-md-block"> 
                                    <?php wp_nav_menu( array(
                                        'theme_location' => 'top_menu',
                                        'menu_class'     => 'top_menu',
                                        'depth'          => 2,
                                        ) );
                                    ?>
                                    </div>
                                   


                            <div id="responsive-menu-top" class="d-md-none d-lg-none">
                                <div class="navbar-header">
                                    <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".top-nav-collapse">
                                      <span class="x"><i class="la la-navicon"></i></span>
                                    </button>
                                </div><!-- /.navbar-header -->
                                <div class="collapse top-nav-collapse">
                                    <?php
                                      if ( has_nav_menu( 'top_menu' ) ) {
                                          wp_nav_menu( array(
                                              'theme_location'      => 'top_menu',
                                              'container'           => false,
                                              'menu_class'          => 'nav navbar-nav tx-res-menu',
                                              'fallback_cb'         => '',
                                              'depth'               => 2,
                                              )
                                          );
                                      }
                                      ?>
                                </div><!-- /.navbar-collapse -->
                            </div><!--/#responsive-menu-->
                             <?php } 
                                endif; // top menu
                        
                            ?>
                        </div>
                    </div>
            	</div><!-- /.col-md-5 col-sm-12 col-xs-12 -->
            </div><!-- /.row -->
        </div> <!-- /.container -->
    </div><!-- /.top-header -->
<?php endif; ?>