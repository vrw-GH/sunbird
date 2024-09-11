<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* header style 5
*
*/
global $tx;
?>

<?php if ($tx['header_on_off']) : ?>
<div class="header-style-five">
	<div id="h-style-5" class="main-header">
		<div class="container<?php echo tx_header_layout(); ?>">
			<div class="row">
		    	<!-- logo -->
			    <div class="col-lg-3 col-sm-12">
			    	<div class="row">
			        	<?php do_action('tx_logo'); ?>
			    	</div>
			    </div><!-- logo end -->
		    	<div class="col-lg-9 col-sm-12">
		    		<div class="row">
		    			<!-- Main Menu -->	
		                <?php get_template_part( 'template-parts/header/menu/main', 'menu' ); ?>
		                <div class="menu-area-right">
		                <!-- Side menu -->
		                <?php get_template_part( 'template-parts/header/menu/side', 'menu' ); ?>
		                <!-- Search icon -->
		                <?php do_action('tx_search_icon'); ?>
		                <!-- Cart icon -->
		            	<?php do_action('tx_cart_icon'); ?>
		                <!-- Menu Button -->
		                <?php do_action('tx_menu_btn'); ?>
		                </div><!-- /.menu-area-righ -->
		            </div>
		        </div><!-- /.col-md-9 col-sm-12 -->
			</div> <!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /#h-style-5 -->
	<div class="tx-header-overlay"></div><!-- overlay color -->
	<div class="container<?php echo tx_header_layout(); ?> banner-business">
		<div class="row">
			<div class="col-lg-8 col-sm-12 col-xs-12 tx-center">
		        <?php if($tx['banner-bussiness-switch'] == '1') : ?>
	                <?php tx_head_ads(); ?>
	                <?php endif; ?>
	                <?php if($tx['banner-bussiness-switch'] == '2') : ?>
	                <?php get_template_part( 'template-parts/header/business', 'info' ); ?>
	                <?php endif; ?>
		    </div><!-- header ads -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- header-style-five -->
<?php endif; ?>