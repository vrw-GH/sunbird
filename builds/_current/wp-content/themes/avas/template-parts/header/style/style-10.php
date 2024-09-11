<?php
/**
* 
* header style 10
*
*/
global $tx;
?>

<?php if ($tx['header_on_off']) : ?>
<div id="h-style-10" class="main-header">
	<div class="tx-header-overlay"></div><!-- overlay color -->
	<div class="container<?php echo tx_header_layout(); ?>">
		<div class="row">
	    	<!-- logo -->
		    <div class="col-lg-12 col-sm-12">
		    	<div class="row">
		        	<?php do_action('tx_logo'); ?>
		        </div>
		    </div><!-- logo end -->
	    	<div class="col-lg-12 col-sm-12">
	    		<div class="row">
		    		<!-- Main Menu -->	
		            <?php get_template_part( 'template-parts/header/menu/main', 'menu' ); ?>
	        	</div>
	        </div>
	        <?php // Menu widget area
            if (is_active_sidebar('side-menu-widget')) : ?>
            <div class="side_menu_widget" role="complementary">
                <?php dynamic_sidebar('side-menu-widget'); ?>
            </div><!-- /.side_menu_widget -->
            <?php endif; ?>
		</div> <!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#h-style-3 -->
<?php endif; ?>