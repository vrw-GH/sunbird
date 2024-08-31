<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Posts archive template
**/

get_header(); 
global $tx;
$t_id = get_queried_object()->term_id;
$term_meta = get_option( "taxonomy_$t_id" );
$cat_style = $term_meta['tx_post_term_meta'];

?>

<div class="container space-content">
	<div class="row">

	<?php 
	if ( $tx['cat_temp_style'] == 'cat_style_1' || $tx['cat_temp_style'] == 'cat_style_2' || $tx['cat_temp_style'] == 'cat_style_3' || $cat_style == 'style-1' || $cat_style == 'style-2' || $cat_style == 'style-3' ) { 

		if ( $tx['cat_temp_style'] == 'cat_style_1' || $cat_style == 'style-1' ) { 
			get_template_part('template-parts/archive/style', 'one');
		}
		elseif ( $tx['cat_temp_style'] == 'cat_style_2' || $cat_style == 'style-2' ) { 
			get_template_part('template-parts/archive/style', 'two');
		}
		elseif ( $tx['cat_temp_style'] == 'cat_style_3' || $cat_style == 'style-3' ) { 
			get_template_part('template-parts/archive/style', 'three');
		}

	} 
	?>
	
<?php get_footer();