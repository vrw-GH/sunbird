<?php

defined( 'ABSPATH' ) || exit;

return [
	'content' => [
		'type'  => 'editor',
		'class' => 'is-full',
		'val'   => __( 'Welcome to Popup Box plugin', 'popup-box' ),
		'atts'  => [
			'class' => 'wpie-fulleditor',
		]
	],

	'shortcode_type' => [
		'type'  => 'select',
		'title' => __( 'Shortcode Type', 'popup-box' ),
		'val'   => 'button',
		'atts'  => [
			'button' => __( 'Button', 'popup-box' ),
			'video'  => __( 'Video', 'popup-box' ),
			'iframe' => __( 'Iframe', 'popup-box' ),
		],
	],

	'shortcode_video_from' => [
		'type'  => 'select',
		'title' => esc_attr__( 'Video Hosting', 'popup-box' ),
		'atts'  => [
			'youtube' => esc_attr__( 'YouTube', 'popup-box' ),
			'vimeo'   => esc_attr__( 'Vimeo', 'popup-box' ),
		],
	],

	'shortcode_video_id' => [
		'title' => esc_attr__( 'Video ID', 'popup-box' ),
		'type'  => 'text',
		'atts'  => [
			'placeholder' => esc_attr__( 'Enter video ID', 'popup-box' ),
		],
	],

	'shortcode_video_width' => [
		'title' => esc_attr__( 'Video Width', 'popup-box' ),
		'type'  => 'number',
		'val'   => '560',
		'atts'  => [
			'min'  => '0',
			'step' => '1',
		],
		'addon' => 'px',
	],

	'shortcode_video_height' => [
		'title' => esc_attr__( 'Video Height', 'popup-box' ),
		'type'  => 'number',
		'val'   => '315',
		'atts'  => [
			'min'  => '0',
			'step' => '1',
		],
		'addon' => 'px',
	],

	'shortcode_btn_type' => [
		'type'  => 'select',
		'title' => esc_attr__( 'Button Type', 'popup-box' ),
		'val'   => 'close',
		'atts'  => [
			'close' => esc_attr__( 'Popup Close Button', 'popup-box' ),
			'link'  => esc_attr__( 'Button with Link', 'popup-box' ),
		],
	],

	'shortcode_btn_size' => [
		'type'  => 'select',
		'title' => esc_attr__( 'Button Size', 'popup-box' ),
		'val'   => 'normal',
		'atts'  => [
			'small'  => esc_attr__( 'Small', 'popup-box' ),
			'normal' => esc_attr__( 'Normal', 'popup-box' ),
			'medium' => esc_attr__( 'Medium', 'popup-box' ),
			'large'  => esc_attr__( 'Large', 'popup-box' ),
		],
	],

	'shortcode_btn_fullwidth' => [
		'type'  => 'select',
		'title' => esc_attr__( 'Full Width', 'popup-box' ),
		'val'   => '',
		'atts'  => [
			''    => esc_attr__( 'No', 'popup-box' ),
			'yes' => esc_attr__( 'Yes', 'popup-box' ),
		],
	],

	'shortcode_btn_text' => [
		'type'  => 'text',
		'title' => esc_attr__( 'Button Text', 'popup-box' ),
		'val'   => esc_attr__( 'Close Popup', 'popup-box' ),
	],

	'shortcode_btn_color' => [
		'title' => __( 'Text Color', 'popup-box' ),
		'type'  => 'text',
		'val'   => '#ffffff',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
	],

	'shortcode_btn_bgcolor' => [
		'title' => __( 'Background Color', 'popup-box' ),
		'type'  => 'text',
		'val'   => '#00d1b2',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
	],

	'shortcode_btn_link' => [
		'title' => __( 'Link', 'popup-box' ),
		'type'  => 'text',
		'val'   => '',
		'atts'  => [
			'placeholder' => esc_attr__( 'Enter URL', 'popup-box' ),
		],
	],

	'shortcode_btn_target' => [
		'type'  => 'select',
		'title' => esc_attr__( 'Target', 'popup-box' ),
		'val'   => '_blank',
		'atts'  => [
			'_blank' => esc_attr__( 'New tab', 'popup-box' ),
			'_self'  => esc_attr__( 'Same tab', 'popup-box' ),
		],
	],

	'iframe_link' => [
		'type'  => 'text',
		'title' => esc_attr__( 'Iframe link', 'popup-box' ),
		'val'   => '',
		'atts'  => [
			'placeholder' => 'https://',
		],
	],

	'iframe_width' => [
		'title' => esc_attr__( 'Width', 'popup-box' ),
		'type'  => 'number',
		'val'   => '600',
		'atts'  => [
			'min' => '0',
		],
		'addon' => [
			'type' => 'select',
			'name' => 'iframe_width_unit',
			'atts' => [
				''  => __( 'px', 'popup-box' ),
				'%' => __( '%', 'popup-box' ),
			],
		],
	],

	'iframe_height' => [
		'title' => esc_attr__( 'Height', 'popup-box' ),
		'type'  => 'number',
		'val'   => '450',
		'atts'  => [
			'min' => '0',
		],
		'addon' => [
			'type' => 'select',
			'name' => 'iframe_height_unit',
			'atts' => [
				''  => __( 'px', 'popup-box' ),
				'%' => __( '%', 'popup-box' ),
			],
		],
	],

];