<?php
/**
* 
* header style 3
*
*/
global $tx;
?>

<?php if ($tx['header_on_off']) : ?>
<div id="h-style-3" class="main-header">
	<div class="tx-header-overlay"></div><!-- overlay color -->
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
	        </div>
		</div> <!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#h-style-3 -->
<?php endif; ?>