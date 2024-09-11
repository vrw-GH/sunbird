<?php
/**
 * The Template for displaying all single products
 *
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $tx;
get_header();
  

?>

<div class="container space-content">
	<div class="row">
<?php if($tx['woo-single-sidebar-select'] == 'woo-single-sidebar-left') : get_sidebar('woo-single'); endif; ?>
<div class="col-md-<?php echo tx_woo_single_sidebar_no_sidebar(); ?>">
            
        <?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
		?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
            
</div>


<?php
if($tx['woo-single-sidebar-select'] == 'woo-single-sidebar-right') : get_sidebar('woo-single'); endif; 
get_footer(); 