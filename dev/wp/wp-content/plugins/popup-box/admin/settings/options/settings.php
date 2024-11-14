<?php

defined( 'ABSPATH' ) || exit;

return [
	//region Triggers
	'triggers' => [
		'type' => 'select',
		'title'   => esc_attr__( 'Trigger Types', 'popup-box' ),
		'value' => 'auto',
		'atts' => [
			'auto'       => esc_attr__( 'Auto', 'popup-box' ),
			'click'      => esc_attr__( 'Click', 'popup-box' ),
			'scrolled'   => esc_attr__( 'Scrolled', 'popup-box' ),
		],
	],

	'delay' => [
		'type' => 'number',
		'title'   => esc_attr__( 'Delay time', 'popup-box' ),
		'val' => 0,
		'atts' => [
			'min'   => '0',
		],
		'addon'   => 'sec',
	],

	'distance' => [
		'type' => 'number',
		'title'   => esc_attr__( 'Scroll distance', 'popup-box' ),
		'val' => 50,
		'atts' => [
			'min'   => '0',
			'max'   => '100',
		],
		'addon'   => '%',
	],



	'cookie' => [
		'type' => 'number',
		'title'   => [
			'label' => __( 'Show once', 'popup-box' ),
			'name'  => 'cookie_checkbox',
			'val'   => 0,
			'toggle' => true,
		],
		'val' => '1',
		'atts' => [
			'min'   => '0',
		],
		'addon' => 'days',

	],

	//endregion

	//region CLose Popup
	'close_overlay' => [
		'type' => 'checkbox',
		'title'   => esc_attr__( 'Overlay', 'popup-box' ),
		'val' => 1,
		'label' => esc_attr__( 'Enable', 'popup-box' ),
	],

	'close_Esc' => [
		'type' => 'checkbox',
		'title'   => esc_attr__( 'Esc', 'popup-box' ),
		'val' => 1,
		'label' => esc_attr__( 'Enable', 'popup-box' ),
	],
	//endregion

];