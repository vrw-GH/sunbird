<?php
namespace AvasElements\Modules\Instagram\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Group_Control_Background;
use elementor\Group_Control_Box_Shadow;
use elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Instagram extends Widget_Base {

	public function get_name() {
		return 'avas-instagram';
	}

	public function get_title() {
		return esc_html__( 'Avas Instagram', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-instagram-post';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'instagram', 'feed', 'social media' ];
	}

    public function get_script_depends() {
        return [ 'instafeed','instagram' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'tx_instagram_feed_content_section',
            [
                'label' => esc_html__('Content', 'avas-core')
            ]
        );

        // instagram access token
        $this->add_control(
            'tx_instagram_feed_access_token',
            [   
                'label'         => esc_html__( 'Access Token', 'avas-core' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'IGQVJXX01DWHhzUjZAvcTI0MFlvaDRDMVIxVlZAhR1VCdjdjU08zb200WEpfRS1iN3RDQ3hJdWNYSnV2ZAlVST2t0Um5TRVFEN0xPaUlGSjZA5U3g4ZAHloUGtmSkJmQlJ2bUItOGdKZAWR1SVdyVGU1SjliMgZDZD',
                'label_block' => true,
            ]
        );    

        $this->add_control(
            'tx_instagram_feed_access_token_important_note',
            [
                'label' => esc_html__( 'Get Access Token', 'avas-core' ),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => '<a href="https://developers.facebook.com/docs/instagram-basic-display-api/getting-started" target="_blank">Get Access Token</a>',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_instagram_feed_Setting_section',
            [
                'label' => esc_html__('Settings', 'avas-core')
            ]
        );

        $this->add_control(
            'tx_instagram_feed_photos_number',
            [
                'label'         => esc_html__('Number of Photos', 'avas-core' ),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'step'          => 1,
                'default'       => 6            
            ]
        );

        $this->add_responsive_control(
            'tx_instagram_feed_column_number',
            [
                'label' => esc_html__( 'Number of Column', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'tx-col-1'  => esc_html__( 'Column 1', 'avas-core' ),
                    'tx-col-2'  => esc_html__( 'Column 2', 'avas-core' ),
                    'tx-col-3'  => esc_html__( 'Column 3', 'avas-core' ),
                    'tx-col-4'  => esc_html__( 'Column 4', 'avas-core' ),
                    'tx-col-5'  => esc_html__( 'Column 5', 'avas-core' ),
                    'tx-col-6'  => esc_html__( 'Column 6', 'avas-core' ),
                ],
                'desktop_default' => 'tx-col-3',
                'tablet_default' => 'tx-col-2',
                'mobile_default' => 'tx-col-1',
                'selectors_dictionary' => [
                    'tx-col-1' => 'grid-template-columns: repeat(1, 1fr);',
                    'tx-col-2' => 'grid-template-columns: repeat(2, 1fr);',
                    'tx-col-3' => 'grid-template-columns: repeat(3, 1fr);',
                    'tx-col-4' => 'grid-template-columns: repeat(4, 1fr);',
                    'tx-col-5' => 'grid-template-columns: repeat(5, 1fr);',
                    'tx-col-6' => 'grid-template-columns: repeat(6, 1fr);',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item' => '{{VALUE}};'
                ]
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_enable_caption',
            [
                'label' => esc_html__( 'Show Caption', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'avas-core' ),
                'label_off' => esc_html__( 'Hide', 'avas-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_enable_user_information',
            [
                'label' => esc_html__( 'Show User Information', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'avas-core' ),
                'label_off' => esc_html__( 'Hide', 'avas-core' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'tx_instagram_feed_user_information_position',
            [
                'label' => esc_html__( 'User Information Position', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'user-info-bottom',
                'options' => [
                    'user-info-top'  => esc_html__( 'Top', 'avas-core' ),
                    'user-info-bottom'  => esc_html__( 'Bottom', 'avas-core' ),
                ],
                'condition' => [
                    'tx_instagram_feed_enable_user_information' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tx_instagram_feed_enable_user_name',
            [
                'label' => esc_html__( 'Show User Name', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'avas-core' ),
                'label_off' => esc_html__( 'Hide', 'avas-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'tx_instagram_feed_enable_user_information' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_user_name',
            [
                'label' => esc_html__( 'User Name', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Avas Theme', 'avas-core' ),
                'condition' => [
                    'tx_instagram_feed_enable_user_information' => 'yes',
                    'tx_instagram_feed_enable_user_name' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_instagram_feed_enable_user_profile_image',
            [
                'label' => esc_html__( 'Show User Profile Image', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'avas-core' ),
                'label_off' => esc_html__( 'Hide', 'avas-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'tx_instagram_feed_enable_user_information' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_user_profile_image',
            [
                'label' => esc_html__( 'User Profile Image', 'avas-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
                'condition' => [
                    'tx_instagram_feed_enable_user_information' => 'yes',
                    'tx_instagram_feed_enable_user_profile_image' => 'yes'
                ]
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_enable_instagram_icon',
            [
                'label' => esc_html__( 'Show Instagram Icon', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'avas-core' ),
                'label_off' => esc_html__( 'Hide', 'avas-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'tx_instagram_feed_enable_user_information' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Instagram Feed Style Option
         */
        $this->start_controls_section(
            'tx_instagram_feed_style_section',
            [
                'label' => esc_html__('Container', 'avas-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tx_instagram_feed_container_background',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-instagram-feed',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_container_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tx_instagram_feed_container_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_container_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tx_instagram_feed_container_shadow',
                'label' => esc_html__( 'Box Shadow', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed',
            ]
        );

        $this->end_controls_section();

        /**
         * Instagram Feed Item Option
         */
        $this->start_controls_section(
            'tx_instagram_feed_item_section',
            [
                'label' => esc_html__('Item', 'avas-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tx_instagram_feed_item_gap',
            [
                'label' => esc_html__( 'Item Gap', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item' => 'grid-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tx_instagram_feed_item_background',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => '#fff',
                    ]
                ],
                'selector' => '{{WRAPPER}} .tx-instagram-feed-wrapper',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_item_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tx_instagram_feed_item_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed-wrapper',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tx_instagram_feed_item_shadow',
                'label' => esc_html__( 'Box Shadow', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed-wrapper',
            ]
        );

        $this->end_controls_section();

        /**
         * Instagram Feed Image Option
         */
        $this->start_controls_section(
            'tx_instagram_feed_image_section',
            [
                'label' => esc_html__('Image', 'avas-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tx_instagram_feed_image_height',
            [
                'label' => esc_html__( 'Image Height', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 340,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-feed-thumb' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tx_instagram_feed_image_animation',
            [
                'label' => esc_html__( 'Image Hover Animation', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'image-zoom-in',
                'options' => [
                    'image-default'  => esc_html__( 'None', 'avas-core' ),
                    'image-zoom-in'  => esc_html__( 'Zoom In', 'avas-core' ),
                    'image-zoom-out'  => esc_html__( 'Zoom Out', 'avas-core' ),
                ]
            ]
        );

        $this->add_control(
            'tx_instagram_feed_enable_overlay',
            [
                'label' => esc_html__( 'Background Overlay', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'avas-core' ),
                'label_off' => esc_html__( 'Hide', 'avas-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_image_overlay_color',
            [
                'label' => esc_html__( 'Overlay Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper a.tx-instagram-feed-thumb::before' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tx_instagram_feed_enable_overlay' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tx_instagram_feed_item_image_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper a.tx-instagram-feed-thumb',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_item_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper a.tx-instagram-feed-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper a.tx-instagram-feed-thumb::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Instagram Feed Caption Option
         */
        $this->start_controls_section(
            'tx_instagram_feed_caption_section',
            [
                'label' => esc_html__('Caption', 'avas-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tx_instagram_feed_enable_caption' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_instagram_feed_caption_alignment',
            [
                'label' => esc_html__( 'Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'avas-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper .tx-instagram-feed-caption' => 'text-align: {{VALUE}}',
                ],
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                    'tx_instagram_feed_caption_position!' => 'over-image'
                ]
            ]
        );

        $this->add_control(
            'tx_instagram_feed_caption_position',
            [
                'label' => esc_html__( 'Caption Position', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top-of-image',
                'options' => [
                    'top-of-image'  => esc_html__( 'Top of Image', 'avas-core' ),
                    'bottom-of-image'  => esc_html__( 'Bottom of Image', 'avas-core' ),
                    'over-image'  => esc_html__( 'Over Image', 'avas-core' ),
                ],
            ]
        );

        $this->add_control(
            'tx_instagram_feed_show_caption_on_hover',
            [
                'label' => esc_html__( 'Show Caption on Hover', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'avas-core' ),
                'label_off' => esc_html__( 'Hide', 'avas-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'tx_instagram_feed_caption_animation',
            [
                'label' => esc_html__( 'Caption Hover Animation', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'animate-default',
                'options' => [
                    'animate-default'  => esc_html__( 'Default', 'avas-core' ),
                    'animate-slide-with-image'  => esc_html__( 'Slide with Image', 'avas-core' ),
                    'animate-slide'  => esc_html__( 'Slide', 'avas-core' ),
                ],
                'condition' => [
                    'tx_instagram_feed_show_caption_on_hover' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tx_instagram_feed_caption_background',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-instagram-feed-caption',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tx_instagram_feed_caption_typography',
                'label' => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper .tx-instagram-feed-caption',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_caption_text_color',
            [
                'label' => esc_html__( 'Text Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper .tx-instagram-feed-caption' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'tx_instagram_feed_caption_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper .tx-instagram-feed-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tx_instagram_feed_caption_padding',
            [
                'label' => esc_html__( 'padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper .tx-instagram-feed-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Instagram Feed User Information Option
         */
        $this->start_controls_section(
            'tx_instagram_feed_user_section',
            [
                'label' => esc_html__('User Information', 'avas-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tx_instagram_feed_enable_user_information' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_instagram_feed_user_padding',
            [
                'label' => esc_html__( 'padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper .tx-instagram-feed-user-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tx_instagram_feed_user_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-item .tx-instagram-feed-wrapper .tx-instagram-feed-user-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tx_instagram_feed_user_profile_image_heading',
            [
                'label' => esc_html__( 'Profile Image', 'avas-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_user_profile_image_height',
            [
                'label' => esc_html__( 'Image Height', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tx_instagram_feed_user_profile_image_width',
            [
                'label' => esc_html__( 'Image Width', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tx_instagram_feed_user_profile_image_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile-image',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_user_profile_image_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '100',
                    'right' => '100',
                    'bottom' => '100',
                    'left' => '100',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tx_instagram_feed_user_profile_image_shadow',
                'label' => esc_html__( 'Box Shadow', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile-image',
            ]
        );
        
        $this->add_control(
            'tx_instagram_feed_user_name_heading',
            [
                'label' => esc_html__( 'User Name', 'avas-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tx_instagram_feed_user_name_typography',
                'label' => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile-name',
            ]
        );

        $this->add_control(
            'tx_instagram_feed_user_name_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tx_instagram_feed_user_name_tabs' );

            // normal state rating
            $this->start_controls_tab( 'tx_instagram_feed_user_name_normal', [ 'label' => esc_html__( 'Normal', 'avas-core' ) ] );
            
                $this->add_control(
                    'tx_instagram_feed_user_name_normal_text_color',
                    [
                        'label' => esc_html__( 'Text Color', 'avas-core' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#000000',
                        'selectors' => [
                            '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile-name' => 'color: {{VALUE}}',
                        ]
                    ]
                );

            $this->end_controls_tab();

            // hover state rating
            $this->start_controls_tab( 'tx_instagram_feed_user_name_hover', [ 'label' => esc_html__( 'Hover', 'avas-core' ) ] );
            
                $this->add_control(
                    'tx_instagram_feed_user_name_hover_text_color',
                    [
                        'label' => esc_html__( 'Text Color', 'avas-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-instagram-feed-wrapper .tx-instagram-user-profile:hover .tx-instagram-user-profile-name' => 'color: {{VALUE}}',
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'tx_instagram_feed_instagram_icon',
            [
                'label' => esc_html__( 'Instagram Icon', 'avas-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tx_instagram_feed_instagram_icon_size',
            [
                'label' => esc_html__( 'Instagram Icon Size', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tx_instagram_feed_instagram_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#e4405f',
                'selectors' => [
                    '{{WRAPPER}} .tx-instagram-feed-icon' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
    
    }
   
    protected function render() {
        $settings                  = $this->get_settings_for_display();
        $this->add_render_attribute( 'tx_instagram_feed_item', [
            'class' => [ 
                'tx-instagram-feed-item',
                $settings['tx_instagram_feed_column_number'],
                $settings['tx_instagram_feed_caption_position']
            ]
        ]);
        if('yes' === $settings['tx_instagram_feed_show_caption_on_hover']){
            $this->add_render_attribute( 'tx_instagram_feed_item', [
                'class' => [ 
                    'tx-insta-feed-show-caption-'.$settings['tx_instagram_feed_show_caption_on_hover'],
                    $settings['tx_instagram_feed_caption_animation']
                ]
            ]);
        }
        ?>
        <div class="tx-instagram-feed">
            <div <?php echo $this->get_render_attribute_string( 'tx_instagram_feed_item' ); ?>
                id='tx-instagram-feed-<?php echo( $this->get_id() ) ?>'
                data-access_token='<?php echo esc_attr( $settings['tx_instagram_feed_access_token'] ); ?>'
                data-target='tx-instagram-feed-<?php echo( $this->get_id() ) ?>'
                data-limit='<?php echo $settings['tx_instagram_feed_photos_number'] ?>'
                data-template='
                <div class="tx-instagram-feed-wrapper">
                    <?php if( 'yes' === $settings['tx_instagram_feed_enable_user_information'] ) { ?>
                        <?php if( 'user-info-top' === $settings['tx_instagram_feed_user_information_position'] ) { ?>
                            <div class="tx-instagram-feed-user-info">
                                <a href="{{link}}" target="_blank" class="tx-instagram-user-profile">
                                    <?php if( 'yes' === $settings['tx_instagram_feed_enable_user_profile_image'] ) { ?>
                                        <div class="tx-instagram-user-profile-image">
                                            <img src="<?php echo $settings['tx_instagram_feed_user_profile_image']['url']; ?>" alt="{{caption}}"/>
                                        </div>
                                    <?php } ?>
                                    <?php if( 'yes' === $settings['tx_instagram_feed_enable_user_name'] ) { ?>
                                        <p class="tx-instagram-user-profile-name"><?php echo esc_html($settings['tx_instagram_feed_user_name']); ?></p>
                                    <?php } ?>
                                </a>
                                <?php if( 'yes' === $settings['tx_instagram_feed_enable_instagram_icon'] ) { ?>
                                    <span class="tx-instagram-feed-icon"><i class="fa fa-instagram"></i></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if( 'top-of-image' === $settings['tx_instagram_feed_caption_position'] || 'over-image' === $settings['tx_instagram_feed_caption_position'] ) { ?>
                        <?php if( 'yes' === $settings['tx_instagram_feed_enable_caption'] ) { ?>
                            <p class="tx-instagram-feed-caption">{{caption}}</p>
                        <?php } ?>
                    <?php } ?>
                    <a class="tx-instagram-feed-thumb <?php echo $settings['tx_instagram_feed_image_animation'] ?>" href="{{link}}" target="_blank">
                        <img src="{{image}}" alt="{{caption}}"/>
                    </a>
                    <?php if( 'bottom-of-image' === $settings['tx_instagram_feed_caption_position']) { ?>
                        <?php if( 'yes' === $settings['tx_instagram_feed_enable_caption'] ) { ?>
                            <p class="tx-instagram-feed-caption">{{caption}}</p>
                        <?php } ?>
                    <?php } ?>
                    <?php if( 'yes' === $settings['tx_instagram_feed_enable_user_information'] ) { ?>
                        <?php if( 'user-info-bottom' === $settings['tx_instagram_feed_user_information_position'] ) { ?>
                            <div class="tx-instagram-feed-user-info">
                                <a href="{{link}}" target="_blank" class="tx-instagram-user-profile">
                                    <?php if( 'yes' === $settings['tx_instagram_feed_enable_user_profile_image'] ) { ?>
                                        <div class="tx-instagram-user-profile-image">
                                            <img src="<?php echo $settings['tx_instagram_feed_user_profile_image']['url']; ?>" alt="{{caption}}"/>
                                        </div>
                                    <?php } ?>
                                    <?php if( 'yes' === $settings['tx_instagram_feed_enable_user_name'] ) { ?>
                                        <p class="tx-instagram-user-profile-name"><?php echo esc_html($settings['tx_instagram_feed_user_name']); ?></p>
                                    <?php } ?>
                                </a>
                                <?php if( 'yes' === $settings['tx_instagram_feed_enable_instagram_icon'] ) { ?>
                                    <span class="tx-instagram-feed-icon"><i class="fa fa-instagram"></i></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>'
            >
            </div>
        </div>

        <?php
    }

    protected function content_template() {}

}

