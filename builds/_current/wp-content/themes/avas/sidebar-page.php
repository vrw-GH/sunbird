<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ============================
*       Page Sidebar Right
* ============================
*/
global $tx;

	  if (is_active_sidebar('sidebar-page')) : ?>
		<div id="secondary" class="widget-area col-lg-4 col-md-6 col-sm-12" role="complementary">
	        <?php dynamic_sidebar('sidebar-page'); ?>
		</div><!-- #secondary -->
	<?php endif;
