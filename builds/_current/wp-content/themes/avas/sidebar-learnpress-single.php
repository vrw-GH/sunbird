<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* 
* LearnPress Single Sidebar
* 
*/
global $tx;

	  if (is_active_sidebar('sidebar-learnpress-single')) : ?>
		<div id="secondary" class="widget-area col-lg-3 col-md-6 col-sm-12" role="complementary">
	        <?php dynamic_sidebar('sidebar-learnpress-single'); ?>
		</div><!-- #secondary -->
	<?php endif;
