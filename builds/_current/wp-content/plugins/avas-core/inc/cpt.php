<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
*
*
*/
global $tx;

/*-------------------------------------------------------
 *             Register Services
*-------------------------------------------------------*/
if(!function_exists('tx_services')) :
add_action( 'init', 'tx_services' );
function tx_services() {
		global $tx;
		if(isset($tx['service_post_type']) && $tx['service_post_type'] == true) {
		if(isset($tx['service-slug']) && $tx['service-slug'] != ''){
			$service_slug = $tx['service-slug'];
		} else {
			$service_slug = 'service';
		}

		if(isset($tx['services_title'])) :
		$st = $tx['services_title'];
		$labels = array(
		'name'               => esc_html__( $st, 'avas-core' ),
		'singular_name'      => esc_html__( $st,  'avas-core' ),
		'menu_name'          => esc_html__( $st, 'avas-core' ),
		'name_admin_bar'     => esc_html__( $st,  'avas-core' ),
		'add_new'            => esc_html__( 'Add New '.$st, 'avas-core' ),
		'add_new_item'       => esc_html__( 'Add New '.$st, 'avas-core' ),
		'new_item'           => esc_html__( 'New '.$st, 'avas-core' ),
		'edit_item'          => esc_html__( 'Edit '.$st, 'avas-core' ),
		'view_item'          => esc_html__( 'View '.$st, 'avas-core' ),
		'all_items'          => esc_html__( 'All '.$st, 'avas-core' ),
		'search_items'       => esc_html__( 'Search '.$st, 'avas-core' ),
		'parent_item_colon'  => esc_html__( 'Parent '.$st.':', 'avas-core' ),
		'not_found'          => esc_html__( 'No '.$st.' found.', 'avas-core' ),
		'not_found_in_trash' => esc_html__( 'No '.$st.' found in Trash.', 'avas-core' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => $service_slug), // Permalink
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_icon'			 => 'dashicons-admin-tools',
		'menu_position'      => null,
		'supports'           => array( 'title','thumbnail','editor', 'comments' )
	);

	register_post_type( 'service', $args );
	endif;
}
}
endif;

/*-------------------------------------------------------
 *             Service Texonomy
*-------------------------------------------------------*/
if( !function_exists('tx_service_taxonomy') ) :
	add_action( 'init', 'tx_service_taxonomy'); 
	function tx_service_taxonomy() {
		global $tx;
		if(isset($tx['service_post_type'])) {
		if(isset($tx['service-cat-slug']) && $tx['service-cat-slug'] != ''){
			$service_cat_slug = $tx['service-cat-slug'];
		} else {
			$service_cat_slug = 'service-category';
		}
		if(isset($tx['services_title'])) :
		$st = $tx['services_title'];
			register_taxonomy(
			'service-category',  		
			'service',                  //post type name
			array(
				'hierarchical'          => true,
				'label'                 => esc_html__($st.' Category', 'avas-core'),  //Display name
				'query_var'             => true,
				'show_admin_column'     => true,
				'rewrite'               => array(
				'slug'                  => $service_cat_slug, // This controls the base slug that will display before each term
				'with_front'    		=> true // Don't display the category base before
					)
				)
			);
			endif;
		}
	}
endif;

/*-------------------------------------------------------
 *    Service texonomy filter show at backend
*-------------------------------------------------------*/
function tx_service_taxonomy_filter( $post_type, $which ) {

  // Apply this only on a specific post type
  if ( 'service' !== $post_type )
    return;

  // A list of taxonomy slugs to filter by
  $taxonomies = array( 'service-category' );

  foreach ( $taxonomies as $taxonomy_slug ) {

    // Retrieve taxonomy data
    $taxonomy_obj = get_taxonomy( $taxonomy_slug );
    $taxonomy_name = $taxonomy_obj->labels->name;

    // Retrieve taxonomy terms
    $terms = get_terms( $taxonomy_slug );

    // Display filter HTML
    echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
    echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
    foreach ( $terms as $term ) {
      printf(
        '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
        $term->slug,
        ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
        $term->name,
        $term->count
      );
    }
    echo '</select>';
  }

}
add_action( 'restrict_manage_posts', 'tx_service_taxonomy_filter' , 10, 2);

/*-------------------------------------------------------
 *             Register portfolio
*-------------------------------------------------------*/

if( !function_exists('tx_portfolio') ) :
add_action( 'init', 'tx_portfolio' );
function tx_portfolio() {
	global $tx;
	if(isset($tx['portfolio_post_type']) && $tx['portfolio_post_type'] == true) {
	if(isset($tx['portfolio-slug']) && $tx['portfolio-slug'] != ''){
		$portfolio_slug = $tx['portfolio-slug'];
	} else {
		$portfolio_slug = 'portfolio';
	}
	
	if(isset($tx['portfolio_title'])) :
	$pt = $tx['portfolio_title'];
	$labels = array(
		'name'               => esc_html__( $pt, 'avas-core' ),
		'singular_name'      => esc_html__( $pt,  'avas-core' ),
		'menu_name'          => esc_html__( $pt, 'avas-core' ),
		'name_admin_bar'     => esc_html__( $pt,  'avas-core' ),
		'add_new'            => esc_html__( 'Add New '.$pt, 'avas-core' ),
		'add_new_item'       => esc_html__( 'Add New '.$pt, 'avas-core' ),
		'new_item'           => esc_html__( 'New '.$pt, 'avas-core' ),
		'edit_item'          => esc_html__( 'Edit '.$pt, 'avas-core' ),
		'view_item'          => esc_html__( 'View '.$pt, 'avas-core' ),
		'all_items'          => esc_html__( 'All '.$pt, 'avas-core' ),
		'search_items'       => esc_html__( 'Search '.$pt, 'avas-core' ),
		'parent_item_colon'  => esc_html__( 'Parent '.$pt.':', 'avas-core' ),
		'not_found'          => esc_html__( 'No '.$pt.' found.', 'avas-core' ),
		'not_found_in_trash' => esc_html__( 'No '.$pt.' found in Trash.', 'avas-core' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => $portfolio_slug), // Permalink
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_icon'			 => 'dashicons-screenoptions',
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt', 'comments' )
	);
	register_post_type( 'portfolio', $args );
	endif;
}
}
endif;
/*-------------------------------------------------------
 *             Portfolio texonomy
*-------------------------------------------------------*/
if( !function_exists('tx_portfolio_taxonomy') ) :
add_action( 'init', 'tx_portfolio_taxonomy'); 	
function tx_portfolio_taxonomy() {
	global $tx;
	if(isset($tx['portfolio_post_type'])) {
	if(isset($tx['portfolio-cat-slug']) && $tx['portfolio-cat-slug'] != ''){
		$portfolio_cat_slug = $tx['portfolio-cat-slug'];
	} else {
		$portfolio_cat_slug = 'portfolio-category';
	}
	if(isset($tx['portfolio_title'])) :
	$pt = $tx['portfolio_title'];
	register_taxonomy(
		'portfolio-category',  
		'portfolio',                  //post type name
		array(
			'hierarchical'          => true,
			'label'                 => esc_html__($pt.' Category','avas-core'),  //Display name
			'query_var'             => true,
			'show_admin_column'     => true,
			'rewrite'               => array(
			'slug'                  => $portfolio_cat_slug, // This controls the base slug that will display before each term
			'with_front'    		=> true // Don't display the category base before
				)
			)
	);
	endif;
	}
}
endif;
/*-------------------------------------------------------
 *    Portfolio texonomy filter show at backend
*-------------------------------------------------------*/
function tx_portfolio_taxonomy_filter( $post_type, $which ) {

  // Apply this only on a specific post type
  if ( 'portfolio' !== $post_type )
    return;

  // A list of taxonomy slugs to filter by
  $taxonomies = array( 'portfolio-category' );

  foreach ( $taxonomies as $taxonomy_slug ) {

    // Retrieve taxonomy data
    $taxonomy_obj = get_taxonomy( $taxonomy_slug );
    $taxonomy_name = $taxonomy_obj->labels->name;

    // Retrieve taxonomy terms
    $terms = get_terms( $taxonomy_slug );

    // Display filter HTML
    echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
    echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
    foreach ( $terms as $term ) {
      printf(
        '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
        $term->slug,
        ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
        $term->name,
        $term->count
      );
    }
    echo '</select>';
  }

}
add_action( 'restrict_manage_posts', 'tx_portfolio_taxonomy_filter' , 10, 2);

/*-------------------------------------------------------
 *             Team
*-------------------------------------------------------*/
if( !function_exists('tx_team') ) :
add_action( 'init', 'tx_team' );	
function tx_team() {
	global $tx;
	if(isset($tx['team_post_type']) && $tx['team_post_type'] == true) {
	if(isset($tx['team-slug']) && $tx['team-slug'] != ''){
		$team_slug = $tx['team-slug'];
	} else {
		$team_slug = 'team';
	}
	if(isset($tx['team_title'])) :
	$tt = $tx['team_title'];
	$labels = array(
		'name'               => esc_html__( $tt, 'avas-core' ),
		'singular_name'      => esc_html__( $tt,  'avas-core' ),
		'menu_name'          => esc_html__( $tt, 'avas-core' ),
		'name_admin_bar'     => esc_html__( $tt,  'avas-core' ),
		'add_new'            => esc_html__( 'Add New', 'avas-core' ),
		'add_new_item'       => esc_html__( 'Add New', 'avas-core' ),
		'new_item'           => esc_html__( 'New '.$tt, 'avas-core' ),
		'edit_item'          => esc_html__( 'Edit '.$tt, 'avas-core' ),
		'view_item'          => esc_html__( 'View '.$tt, 'avas-core' ),
		'all_items'          => esc_html__( 'View All', 'avas-core' ),
		'search_items'       => esc_html__( 'Search '.$tt, 'avas-core' ),
		'parent_item_colon'  => esc_html__( 'Parent '.$tt.':', 'avas-core' ),
		'not_found'          => esc_html__( 'No '.$tt.' found.', 'avas-core' ),
		'not_found_in_trash' => esc_html__( 'No '.$tt.' found in Trash.', 'avas-core' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => $team_slug), // Permalink
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_icon'			 => 'dashicons-admin-users',
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail', 'editor', 'comments' )
	);

	register_post_type( 'team', $args );
	endif;
}
}
endif;

/*-------------------------------------------------------
 *             Team Texonomy
*-------------------------------------------------------*/
if( !function_exists('tx_team_taxonomy') ) :
add_action( 'init', 'tx_team_taxonomy'); 
function tx_team_taxonomy() {
	global $tx;
	if(isset($tx['team_post_type'])) {
	if(isset($tx['team-cat-slug']) && $tx['team-cat-slug'] != ''){
		$team_cat_slug = $tx['team-cat-slug'];
	} else {
		$team_cat_slug = 'team-category';
	}
		if(isset($tx['team_title'])) :
		$tt = $tx['team_title'];
		register_taxonomy(
		'team-category',  
		'team',                  	//post type name
		array(
			'hierarchical'          => true,
			'label'                 => esc_html__($tt.' Category', 'avas-core'),  //Display name
			'query_var'             => true,
			'show_admin_column'     => true,
			'rewrite'               => array(
			'slug'                  => $team_cat_slug, // This controls the base slug that will display before each term
			'with_front'    		=> true // Don't display the category base before
				)
			)
		);
		endif;
	
}
}
endif;
/*-------------------------------------------------------
 *    Team texonomy filter show at backend
*-------------------------------------------------------*/
function tx_team_taxonomy_filter( $post_type, $which ) {

  // Apply this only on a specific post type
  if ( 'team' !== $post_type )
    return;

  // A list of taxonomy slugs to filter by
  $taxonomies = array( 'team-category' );

  foreach ( $taxonomies as $taxonomy_slug ) {

    // Retrieve taxonomy data
    $taxonomy_obj = get_taxonomy( $taxonomy_slug );
    $taxonomy_name = $taxonomy_obj->labels->name;

    // Retrieve taxonomy terms
    $terms = get_terms( $taxonomy_slug );

    // Display filter HTML
    echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
    echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
    foreach ( $terms as $term ) {
      printf(
        '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
        $term->slug,
        ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
        $term->name,
        $term->count
      );
    }
    echo '</select>';
  }

}
add_action( 'restrict_manage_posts', 'tx_team_taxonomy_filter' , 10, 2);


/*-------------------------------------------------------
 *             EOF
*-------------------------------------------------------*/