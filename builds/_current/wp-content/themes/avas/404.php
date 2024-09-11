<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* ============================
*        404 Error page
* ============================
*
*/

get_header(); 

?>

<div class="container">
	<div class="row">
		<div class="error-404">
			<h1><?php esc_html_e('404', 'avas'); ?></h1>	
			<h4><?php esc_html_e('OOPS! SOMETHING WENT WRONG' , 'avas'); ?></h4>
			<p><?php esc_html_e('The page you are looking for doesn\'t exist.', 'avas'); ?></p>
		</div><!-- /.error-404 -->
	</div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer();