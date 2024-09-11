<?php
/**
 * The template for displaying product search form
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-field">
		<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'avas' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</div>
	<div class="search-button">
		<button type="submit" class="search-submit"><i class="la la-search"></i></button>
	</div>
		<input type="hidden" name="post_type" value="product" />
</form>

