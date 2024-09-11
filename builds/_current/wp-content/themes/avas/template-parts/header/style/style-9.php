<?php
/**
* 
* header style 9
*
*/
global $tx;
?>

<?php if ($tx['header_on_off']) : ?>
<div id="h-style-9" class="main-header">
	<div class="tx-header-overlay"></div><!-- overlay color -->
	<div class="container<?php echo tx_header_layout(); ?>">
		<div class="row">
			<!-- Left menu -->
			<?php get_template_part( 'template-parts/header/menu/left', 'menu' ); ?>
	    	<!-- logo -->
		    <div class="col-lg-2 col-sm-12">
		    	<div class="row">
		    		<div class="tx-centerx">
		        	<?php do_action('tx_logo'); ?>
		        	</div>
		        </div>
		    </div><!-- logo end -->
	    	<div class="col-lg-5 col-sm-12 d-none d-sm-none d-md-block">
	    		<div class="row">
		    		<!-- Right menu -->	
		            <?php get_template_part( 'template-parts/header/menu/right', 'menu' ); ?>

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
	        </div><!-- Display in desktop only -->
	        <!-- Mobile menu -->
	        <?php get_template_part( 'template-parts/header/menu/mobile', 'menu' ); ?>
    		<div class="menu-area-right d-md-none d-lg-none">
			    <!-- Side menu -->
				<?php get_template_part( 'template-parts/header/menu/side', 'menu' ); ?>
				<!-- Search icon -->
				<?php do_action('tx_search_icon'); ?>
				<!-- Cart icon -->
				<?php do_action('tx_cart_icon'); ?>
				<!-- Menu Button -->
				<?php do_action('tx_menu_btn'); ?>
		    </div><!-- /.menu-area-righ --><!-- Display in mobile only -->
		</div> <!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#h-style-9 -->
<?php endif; ?>