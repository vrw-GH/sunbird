<?php


use PopupBox\Settings_Helper;

defined( 'ABSPATH' ) || exit;

$show = [
	'general_start' => __( 'General', 'popup-box' ),
	'everywhere'    => __( 'Everywhere', 'popup-box' ),
	'shortcode'     => __( 'Shortcode', 'popup-box' ),
	'general_end'   => __( 'General', 'popup-box' ),
	'post_start'    => __( 'Posts', 'popup-box' ),
	'post_all'      => __( 'All posts', 'popup-box' ),
	'post_selected' => __( 'Selected posts', 'popup-box' ),
	'post_category' => __( 'Post has category', 'popup-box' ),
	'post_tag'      => __( 'Post has tag', 'popup-box' ),
	'post_end'      => __( 'Posts End', 'popup-box' ),
	'page_start'    => __( 'Pages', 'popup-box' ),
	'page_all'      => __( 'All pages', 'popup-box' ),
	'page_selected' => __( 'Selected pages', 'popup-box' ),
	'page_type'     => __( 'Page type', 'popup-box' ),
	'page_end'      => __( 'Pages End', 'popup-box' ),
	'archive_start' => __( 'Archives', 'popup-box' ),
	'is_archive'    => __( 'All Archives', 'popup-box' ),
	'is_category'   => __( 'All Categories', 'popup-box' ),
	'is_tag'        => __( 'All Tags', 'popup-box' ),
	'is_author'     => __( 'All Authors', 'popup-box' ),
	'is_date'       => __( 'All Dates', 'popup-box' ),
	'_is_category'  => __( 'Category', 'popup-box' ),
	'_is_tag'       => __( 'Tag', 'popup-box' ),
	'_is_author'    => __( 'Author', 'popup-box' ),
	'archive_end'   => __( 'Archives End', 'popup-box' ),

];


$pages_type = [
	'is_front_page' => __( 'Home Page', 'popup-box' ),
	'is_home'       => __( 'Posts Page', 'popup-box' ),
	'is_search'     => __( 'Search Pages', 'popup-box' ),
	'is_404'        => __( '404 Pages', 'popup-box' ),
];

$operator = [
	'1' => 'is',
	'0' => 'is not',
];


$args = [
	//region Display Rules
	'show' => [
		'type'  => 'select',
		'title' => __( 'Display', 'popup-box' ),
		'val'   => 'everywhere',
		'atts'  => $show,
	],

	'operator' => [
		'type'  => 'select',
		'title' => __( 'Is or is not', 'popup-box' ),
		'atts'  => $operator,
		'val'   => '1',
		'class' => 'is-hidden',
	],

	'ids' => [
		'type'  => 'text',
		'title' => __( 'Enter ID\'s', 'popup-box' ),
		'atts'  => [
			'placeholder' => __( 'Enter IDs, separated by comma.', 'popup-box' )
		],
		'class' => 'is-hidden',
	],

	'page_type' => [
		'type'  => 'select',
		'title' => __( 'Specific page types', 'popup-box' ),
		'atts'  => $pages_type,
		'class' => 'is-hidden',
	],
	//endregion

];


return $args;
