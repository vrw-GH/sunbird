<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ============================
*       Right Sidebar
* ============================
*/
global $tx;

	  if (is_active_sidebar('sidebar-post')) : ?>
		<div id="secondary" class="widget-area col-lg-4 col-md-5 col-sm-12" role="complementary">
	        <?php dynamic_sidebar('sidebar-post'); ?>
		</div><!-- #secondary -->
	<?php endif;
