<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ============================
*       Post Sidebar
* ============================
*/
global $tx;

	if (is_active_sidebar('sidebar-single')) : ?>
		<div id="secondary" class="widget-area col-lg-4 col-md-5 col-sm-12" role="complementary">
	        <?php dynamic_sidebar('sidebar-single'); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
