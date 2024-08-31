<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Footer Style 1
*
*/
global $tx;
$footer_cols = $tx['footer-bottom-layout1'];
?>
<div class="container footer-style-1">
    <div class="row">
		<div class="col-lg-<?php echo esc_attr($footer_cols); ?> col-sm-12">
		    <div class="copyright">
		    <?php  if ( class_exists( 'ReduxFramework' ) ) { ?>
		        <p><?php echo wp_kses_post($tx['copyright']); ?></p>
		    <?php } else { ?>
		        <p>Copryright &copy; <?php echo date("Y"); ?>, By <a href="https://1.envato.market/mPA2X">Avas WP Theme</a> | All rights reserved.</p>
		    <?php } ?>
		    </div>
		</div>
		<?php if($tx['footer-bottom-layout1'] == '6') : ?>
		<div class="col-lg-<?php echo esc_attr($footer_cols); ?> col-sm-12">
		    <!-- social link start -->
		    <?php if ( class_exists( 'ReduxFramework' ) ) : ?>
		    	<?php if($tx['social_icons_footer'])  : ?>
		            
		        <?php if ($tx['social']) { ?>
		        <div class="social_media"> 
		            <?php if (function_exists('tx_social_media')) :
		                    echo tx_social_media(); 
		            endif;
		            ?>
		        </div>
		        <?php }
		        endif; 
		    endif ?> <!-- social link end -->
		    <!-- footer menu start -->
		    <?php if ( class_exists( 'ReduxFramework' ) ) : ?>
		        <?php if($tx['footer-menu'])  : 
		        	if ( has_nav_menu( 'footer_menu' ) ) {
		            	wp_nav_menu( array(
		                    'theme_location' => 'footer_menu',
		                    'menu_class'     => 'footer-menu',
		                    'depth'          => 1,
		                    ) );
		            }
		            endif; 
		        endif; ?><!-- footer menu end -->
		</div>
		<?php endif; ?>
	</div>
</div>