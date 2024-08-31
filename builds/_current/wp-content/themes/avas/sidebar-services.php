<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ============================
*       Services Sidebar
* ============================
*/
global $tx;

	if (is_active_sidebar('sidebar-services')) : ?>
		<div id="secondary" class="widget-area col-lg-4 col-md-6 col-sm-12" role="complementary">
	        <?php dynamic_sidebar('sidebar-services'); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
