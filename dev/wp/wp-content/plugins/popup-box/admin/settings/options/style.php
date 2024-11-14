<?php

use PopupBox\Settings_Helper;

defined( 'ABSPATH' ) || exit;

return [
	//region Popup
	'block_page' => [
		'type' => 'checkbox',
		'title'   => esc_attr__( 'Block the page', 'popup-box' ),
		'val' => 0,
		'label' => esc_attr__( 'Enable', 'popup-box' ),
	],

	'width' => [
		'type' => 'number',
		'title'   => __( 'Width', 'popup-box' ),
		'val' => '550',
		'addon' => [
			'type' => 'select',
			'name' => 'width_unit',
			'val' => 'px',
			'atts' => [
				'auto' => __( 'auto', 'popup-box' ),
				'px'   => __( 'px', 'popup-box' ),
				'%'    => __( '%', 'popup-box' ),
			],
		],
	],

	'height' => [
		'type' => 'number',
		'title'   => __( 'Height', 'popup-box' ),
		'val' => '350',
		'addon' => [
			'type' => 'select',
			'name' => 'height_unit',
			'val' => 'px',
			'atts' => [
				'auto' => __( 'auto', 'popup-box' ),
				'px'   => __( 'px', 'popup-box' ),
				'%'    => __( '%', 'popup-box' ),
			],
		],
	],
	
	'zindex' => [
		'type' => 'number',
		'title'   => __( 'Z-index', 'popup-box' ),
		'val' => '999'
	],
	
	'location' => [
		'type' => 'select',
		'title'   => __( 'Location', 'popup-box' ),
		'val' => '-center',
		'atts' => [
			'-center'       => __( 'Center', 'popup-box' ),
			'-topCenter'    => __( 'Top Center', 'popup-box' ),
			'-bottomCenter' => __( 'Bottom Center', 'popup-box' ),
			'-left'         => __( 'Left Center', 'popup-box' ),
			'-topLeft'      => __( 'Top Left', 'popup-box' ),
			'-bottomLeft'   => __( 'Bottom Left', 'popup-box' ),
			'-right'        => __( 'Right Center', 'popup-box' ),
			'-topRight'     => __( 'Top Right', 'popup-box' ),
			'-bottomRight'  => __( 'Bottom Right', 'popup-box' ),
		],
	],

	'top' => [
		'type' => 'number',
		'title'   => __( 'Top', 'popup-box' ),
		'val' => '0',
		'addon' => [
			'type' => 'select',
			'name' => 'top_unit',
			'atts' => [
				'px' => __( 'px', 'popup-box' ),
				'em' => __( 'em', 'popup-box' ),
			],
		],
	],

	'bottom' => [
		'type' => 'number',
		'title'   => __( 'Bottom', 'popup-box' ),
		'val' => '0',
		'addon' => [
			'type' => 'select',
			'name' => 'bottom_unit',
			'atts' => [
				'px' => __( 'px', 'popup-box' ),
				'em' => __( 'em', 'popup-box' ),
			],
		],
	],

	'left' => [
		'type' => 'number',
		'title'   => __( 'Left', 'popup-box' ),
		'val' => '0',
		'addon' => [
			'type' => 'select',
			'name' => 'left_unit',
			'atts' => [
				'px' => __( 'px', 'popup-box' ),
				'em' => __( 'em', 'popup-box' ),
			],
		],
	],

	'right' => [
		'type' => 'number',
		'title'   => __( 'Right', 'popup-box' ),
		'val' => '0',
		'addon' => [
			'type' => 'select',
			'name' => 'right_unit',
			'atts' => [
				'px' => __( 'px', 'popup-box' ),
				'em' => __( 'em', 'popup-box' ),
			],
		],
	],

	'popup_animation' => [
		'type' => 'select',
		'title'   => __( 'Popup Animation', 'popup-box' ),
		'val' => 'fadeIn',
		'atts' => Settings_Helper::animation(),
	],

	'padding' => [
		'type' => 'number',
		'title'   => __( 'Padding', 'popup-box' ),
		'val' => '15',
		'addon' => 'px',
	],

	'radius' => [
		'type' => 'number',
		'title'   => __( 'Radius', 'popup-box' ),
		'val' => '0',
		'addon' => 'px',
	],

	'shadow' => [
		'type' => 'number',
		'title'   => [
			'label' => __( 'Shadow', 'popup-box' ),
			'name'  => 'shadow_checkbox',
			'val'   => '1',
			'toggle' => true,
		],
		'val' => '8',
		'addon' => 'px',
	],

	'shadow_color' => [
		'title' => __( 'Shadow Color', 'popup-box' ),
		'type'  => 'text',
		'val'   => 'rgba(0, 0, 0, 0.5)',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
	],

	'background' => [
		'type'  => 'text',
		'title' => __( 'Background', 'popup-box' ),
		'val'   => '#ffffff',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
	],
	
	'background_img' => [
		'type'  => 'text',
		'title' => [
			'label' => __( 'Background Image', 'popup-box' ),
			'name'  => 'background_img_checkbox',
			'toggle' => true,
		],
		'atts' => [
			'placeholder' => __( 'Enter Image URL', 'popup-box' ),
		],
	],

	'overlay' => [
		'type'  => 'text',
		'title' => [
			'label' => __( 'Enable', 'popup-box' ),
			'name'  => 'overlay_checkbox',
			'val'   => '1',
		],
		'val'   => 'rgba(0, 0, 0, .75)',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
	],

	'overlay_animation' => [
		'type' => 'select',
		'title'   => __( 'Overlay Animation', 'popup-box' ),
		'val' => 'fadeIn',
		'atts' => Settings_Helper::animation(),
	],
	//endregion

	//region Content
	'content_font' => [
		'type'  => 'select',
		'title'   => __( 'Font Family', 'popup-box' ),
		'val' => 'inherit',
		'atts' => [
			'inherit'         => __( 'Use Your Themes', 'popup-box' ),
			'Sans-Serif'      => 'Sans-Serif',
			'Tahoma'          => 'Tahoma',
			'Georgia'         => 'Georgia',
			'Comic Sans MS'   => 'Comic Sans MS',
			'Arial'           => 'Arial',
			'Lucida Grande'   => 'Lucida Grande',
			'Times New Roman' => 'Times New Roman',
		],
	],

	'content_size' => [
		'type'  => 'number',
		'title'   => __( 'Font Size', 'popup-box' ),
		'val' => '16',
		'addon' => 'px',
	],

	'content_padding' => [
		'type'  => 'number',
		'title'   => __( 'Padding', 'popup-box' ),
		'val' => '15',
		'addon' => 'px',
	],

	'border_style' => [
		'type'  => 'select',
		'title'   => __( 'Border Style', 'popup-box' ),
		'val' => 'none',
		'atts' => [
			'none'   => __( 'None', 'popup-box' ),
			'solid'  => __( 'Solid', 'popup-box' ),
			'dotted' => __( 'Dotted', 'popup-box' ),
			'dashed' => __( 'Dashed', 'popup-box' ),
			'double' => __( 'Double', 'popup-box' ),
			'groove' => __( 'Groove', 'popup-box' ),
			'inset'  => __( 'Inset', 'popup-box' ),
			'outset' => __( 'Outset', 'popup-box' ),
			'ridge'  => __( 'Ridge', 'popup-box' ),
		],
	],

	'border_width' => [
		'type'  => 'number',
		'title'   => __( 'Border Thickness', 'popup-box' ),
		'val' => '1',
		'addon' => 'px',
	],

	'border_radius' => [
		'type'  => 'number',
		'title'   => __( 'Border Radius', 'popup-box' ),
		'val' => '0',
		'addon' => 'px',
	],

	'border_color' => [
		'type'  => 'text',
		'title' => __( 'Border Color', 'popup-box' ),
		'val'   => '#d4af37',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
	],
	//endregion
	//region Close Button
	'close' => [
		'type' => 'select',
		'title' => __( 'Close button', 'popup-box' ),
		'val' => '-text',
		'atts'  => [
			'-text' => __( 'Text', 'popup-box' ),
			'-icon' => __( 'Icon', 'popup-box' ),
			'-tag'  => __( 'Box', 'popup-box' ),
		],
	],

	'close_size' => [
		'type'  => 'number',
		'title'   => __( 'Size', 'popup-box' ),
		'val' => '16',
		'addon' => 'px',
	],

	'close_text' => [
		'type'  => 'text',
		'title'   => __( 'Text', 'popup-box' ),
		'val' => __('Close', 'popup-box' ),
	],

	'close_place' => [
		'type' => 'select',
		'title'   => __( 'Place', 'popup-box' ),
		'val' => '',
		'atts'  => [
			''       => __( 'Inside', 'popup-box' ),
			'-outer' => __( 'Outside', 'popup-box' ),
		],
	],

	'close_location' => [
		'type' => 'select',
		'title'   => __( 'Location', 'popup-box' ),
		'val' => '-topRight',
		'atts'  => [
			'-topRight'    => __( 'Top Right', 'popup-box' ),
			'-topLeft'     => __( 'Top Left', 'popup-box' ),
			'-bottomRight' => __( 'Bottom Right', 'popup-box' ),
			'-bottomLeft'  => __( 'Bottom Left', 'popup-box' ),
		],
	],

	'close_color' => [
		'type'  => 'text',
		'title'   => __( 'Color', 'popup-box' ),
		'val'   => '#383838',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
	],

	'close_background' => [
		'type'  => 'text',
		'title'   => __( 'Background', 'popup-box' ),
		'val'   => '#00d1b2',
		'atts'  => [
			'class'              => 'wpie-color',
			'data-alpha-enabled' => 'true',
		],
	],
	//endregion

	//region Mobile
	'mobile' => [
		'type'  => 'number',
		'title' => [
			'label'    => __( 'Show on mobile', 'popup-box' ),
			'name' => 'mobile_checkbox',
			'val' => 1,
			'toggle' => true,
		],
		'val' => '480',
		'addon' => 'px',
	],

	'mobile_width' => [
		'type' => 'number',
		'title'   => __( 'Width', 'popup-box' ),
		'val' => '100',
		'addon' => [
			'type' => 'select',
			'name' => 'mobile_width_unit',
			'atts' => [
				'%'  => __( '%', 'popup-box' ),
				'px' => __( 'px', 'popup-box' ),
			],
		],
	],
	//endregion
	
];