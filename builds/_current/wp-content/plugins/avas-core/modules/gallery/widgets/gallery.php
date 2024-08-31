<?php
namespace AvasElements\Modules\Gallery\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Gallery extends Widget_Base {

    public function get_name() {
        return 'avas-gallery';
    }

    public function get_title() {
        return esc_html__( 'Avas Gallery', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() {
        return [ 'tx-isotope', 'tx-magnific-popup', 'tx-imagesloaded','gallery' ];
    }

    public function get_style_depends() {
        return [ 'tx-magnific-popup' ];
    }

    public function get_keywords() {
        return [
            'gallery',
            'filter',
            'filterable',
            'image',
            'media',
            'photo',
            'picture',
            'portfolio',
            'grid',
            'masonry',
            'responsive',
            'isotope',
            'search'
        ];
    }

    protected function register_controls() {
        // gallery item
        $this->start_controls_section(
            'gallery_settings',
            [
                'label' => esc_html__('Gallery', 'avas-core'),
            ]
        );
              
        $repeater = new Repeater();
        
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'avas-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => TX_PLUGIN_URL . '/assets/img/before.jpg',
                ],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'tx-gall-grid-cols-3',
            ]
        );
        $repeater->add_control(
            'gall_img_name',
            [
                'label' => esc_html__('Image Name', 'avas-core'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => esc_html__('Image Name', 'avas-core'),
            ]
        );
        $repeater->add_control(
            'gall_img_link_url',
            [
                'label'       => esc_html__( 'Image Link URL', 'avas-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
            ]
        );
        $repeater->add_control(
            'gall_filter_name',
            [
                'label' => esc_html__('Filter Name', 'avas-core'),
                'description' => esc_html__('Add the filter name from "Filters" section', 'avas-core'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'gall_desc',
            [
                'label' => esc_html__('Description', 'avas-core'),
                'type' => Controls_Manager::WYSIWYG,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => '',
            ]
        );
        $this->add_control(
            'gall_items',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    [
                        'gall_img_name' => 'Alpha',
                        'gall_filter_name' => 'Mono',
                        'image' => ['url' => TX_PLUGIN_URL . '/assets/img/gallery/gall-1.jpg'],
                        'gall_img_link_url' => ['url' => '#'],
                    ],
                    [
                        'gall_img_name' => 'Beta',
                        'gall_filter_name' => 'Di',
                        'image' => ['url' => TX_PLUGIN_URL . '/assets/img/gallery/gall-2.jpg'],
                        'gall_img_link_url' => ['url' => '#'],
                    ],
                    [
                        'gall_img_name' => 'Gamma',
                        'gall_filter_name' => 'Tri',
                        'image' => ['url' => TX_PLUGIN_URL . '/assets/img/gallery/gall-3.jpg'],
                        'gall_img_link_url' => ['url' => '#'],
                    ],
                    [
                        'gall_img_name' => 'Delta',
                        'gall_filter_name' => 'Tetra',
                        'image' => ['url' => TX_PLUGIN_URL . '/assets/img/gallery/gall-4.jpg'],
                        'gall_img_link_url' => ['url' => '#'],
                    ],
                    [
                        'gall_img_name' => 'Epsilon',
                        'gall_filter_name' => 'Penta',
                        'image' => ['url' => TX_PLUGIN_URL . '/assets/img/gallery/gall-5.jpg'],
                        'gall_img_link_url' => ['url' => '#'],
                    ],
                    [
                        'gall_img_name' => 'Zeta',
                        'gall_filter_name' => 'Hexa',
                        'image' => ['url' => TX_PLUGIN_URL . '/assets/img/gallery/gall-6.jpg'],
                        'gall_img_link_url' => ['url' => '#'],
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{gall_img_name}}',
            ]
        );
        
        $this->end_controls_section();

        // Filter
        $this->start_controls_section(
            'eael_section_fg_control_settings',
            [
                'label' => esc_html__('Filters', 'avas-core'),
            ]
        );
        $this->add_control(
            'gall_filter_controls',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => 
                    [
                        ['gall_filter_item' => 'Mono'],
                        ['gall_filter_item' => 'Di'],
                        ['gall_filter_item' => 'Tri'],
                        ['gall_filter_item' => 'Tetra'],
                        ['gall_filter_item' => 'Penta'],
                        ['gall_filter_item' => 'Hexa'],
                    ],
                'fields' => [
                    [
                        'name' => 'gall_filter_item',
                        'label' => esc_html__('Filter Item', 'avas-core'),
                        'type' => Controls_Manager::TEXT,
                        'dynamic'   => ['active' => true],
                        'label_block' => false,
                        'default' => [],
                        'description' => esc_html__('Add the filter name here and set the same name on "Gallery" section', 'avas-core'),
                    ],
                ],
                'condition' => [
                    'gall_filter' => 'yes'
                ],
                'title_field' => '{{gall_filter_item}}',
            ]
        );
        
        $this->end_controls_section();

        // settings
        $this->start_controls_section(
            'gall_settings',
            [
                'label' => esc_html__('Settings', 'avas-core'),
            ]
        );
        $this->add_responsive_control(
            'gall_cols',
            [
                'label' => esc_html__( 'Columns', 'avas-core' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,             
                'desktop_default' => '33.333%',
                'tablet_default' => '50%',
                'mobile_default' => '100%',
                'options' => [
                    '100%' => esc_html__( '1 Column', 'avas-core' ),
                    '50%' => esc_html__( '2 Column', 'avas-core' ),
                    '33.333%' => esc_html__( '3 Columns', 'avas-core' ),
                    '25%' => esc_html__( '4 Columns', 'avas-core' ),
                    '20%' => esc_html__( '5 Columns', 'avas-core' ),
                    '16.666%' => esc_html__( '6 Columns', 'avas-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-item' => 'width: {{VALUE}};',
                ],
                'render_type' => 'template'
            ]
        );
        $this->add_control(
            'layoutMode',
            [
                'label' => esc_html__('Layout', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'fitRows',
                'options' => [
                    'fitRows' => esc_html__('Grid', 'avas-core'),
                    'masonry' => esc_html__('Masonry', 'avas-core'),
                ],
            ]
        );
        $this->add_control(
            'gall_img_style',
            [
                'label' => esc_html__('Style', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'tx-gallery-style-1',
                'options' => [
                    'tx-gallery-style-1' => esc_html__('Normal', 'avas-core'),
                    'tx-gallery-style-2' => esc_html__('Hover', 'avas-core'),
                    'tx-gallery-style-3' => esc_html__('Whole Image Clickable', 'avas-core'),
                ],
            ]
        );
        $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__( 'Image Hover Animation', 'avas-core' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'transitionDuration',
            [
                'label' => esc_html__( 'Filter Animation', 'avas-core' ),
                'description' => esc_html__( 'If hover animation conflicts with Filter animation then you can set it OFF', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'avas-core' ),
                'label_off' => esc_html__( 'Off', 'avas-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );  
        $this->add_control(
            'gall_filter',
            [
                'label' => esc_html__( 'Filters', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Enable', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'Disable', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'yes',
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'gall_all_label_text',
            [
                'label' => esc_html__('Filter All Label Text', 'avas-core'),
                'type' => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'default' => 'All',
                'condition' => [
                    'gall_filter' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'gall_search',
            [
                'label' => esc_html__( 'Search', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Enable', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'Disable', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'yes',
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'gall_search_position',
            [
                'label' => esc_html__('Layout', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'above',
                'options' => [
                    'above' => esc_html__('Above Filter', 'avas-core'),
                    'below' => esc_html__('Below Filter', 'avas-core'),
                ],
                'condition' => [
                    'gall_search' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'gall_search_text',
            [
                'label' => esc_html__('Search Text', 'avas-core'),
                'type' => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'default' => 'Search...',
                'condition' => [
                    'gall_search' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'gall_popup_switch',
            [
                'label' => esc_html__( 'Display Lightbox Icon', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show',
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'gall_link_switch',
            [
                'label' => esc_html__( 'Display Link Icon', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show',
            ]
        );
        $this->add_control(
            'gall_img_name_switch',
            [
                'label' => esc_html__( 'Display Image Name', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show',
            ]
        );
        $this->add_control(
            'gall_filter_switch',
            [
                'label' => esc_html__( 'Display Filter Name', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show',
            ]
        );
        $this->end_controls_section();
        
        // Styles
        $this->start_controls_section(
            'img_styles',
            [
              'label'   => esc_html__( 'Image', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'gall_img_spacing',
            [
                'label'   => esc_html__( 'Image Spacing', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 50,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-item'   => 'padding: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-gallery-overlay'   => 'margin: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'gall_img_border',
                'label' => esc_html__( 'Image Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-gallery-item img',
            ]
        );
        $this->add_responsive_control(
            'gall_img_border_radius',
            [
                'label'   => esc_html__( 'Image Border Radius', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-item img, {{WRAPPER}} .tx-gallery-overlay'   => 'border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-gallery-title-bar'   => 'border-bottom-left-radius: {{SIZE}}{{UNIT}};border-bottom-right-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'gall_img_box_shadow',
                'selector' => '{{WRAPPER}} .tx-gallery-item img',
            ]
        );
        $this->end_controls_section();
       
        $this->start_controls_section(
            'gall_name_desc_styles',
            [
              'label'   => esc_html__( 'Name & Description', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'img_name_bar_color',
            [
                'label'     => esc_html__( 'Image Name Bar Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-title-bar' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'gall_img_name_switch' => 'show'
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'img_name_bar_position',
            [
                'label'   => esc_html__( 'Image Name Bar Position', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => -100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-style-1 .tx-gallery-title-bar, {{WRAPPER}} .tx-gallery-style-2 .tx-gallery-title-bar'   => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-gallery-style-3 .tx-gallery-title-bar'   => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'gall_img_name_switch' => 'show'
                ],
            ]
        );
        $this->add_control(
            'img_name_color',
            [
                'label'     => esc_html__( 'Image Name Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-name, {{WRAPPER}} .tx-gallery-name a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gall_img_name_switch' => 'show'
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'img_name_color_hover',
            [
                'label'     => esc_html__( 'Image Name Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-name:hover, {{WRAPPER}} .tx-gallery-name a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gall_img_name_switch' => 'show'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'img_name_typography',
                   'label'     => esc_html__( 'Image Name Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-gallery-name, {{WRAPPER}} .tx-gallery-name a',
                   'condition' => [
                    'gall_img_name_switch' => 'show'
                ]
              ]
        );
        $this->add_responsive_control(
          'gall_name_alignment',
          [
            'label' => esc_html__( 'Image Name Alignment', 'avas-core' ),
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
              ]
            ],
            'selectors' => [
              '{{WRAPPER}} .tx-gallery-name' => 'text-align: {{VALUE}};',
            ],
            'condition' => [
                          'gall_filter_switch' => 'hide',
                        ],
          ]
        );
        $this->add_control(
            'img_filter_name_color',
            [
                'label'     => esc_html__( 'Image Filter Name Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-categoy' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gall_filter_switch' => 'show'
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'img_filter_name_typography',
                   'label'     => esc_html__( 'Image Filter Name Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-gallery-categoy',
                   'condition' => [
                        'gall_filter_switch' => 'show'
                    ]
              ]
        );
        $this->add_control(
            'img_desc_color',
            [
                'label'     => esc_html__( 'Image Description Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-desc > *' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'img_desc_typography',
                   'label'     => esc_html__( 'Image Description Typography', 'avas-core' ),
                   'selector'  => '{{WRAPPER}} .tx-gallery-desc > *',
              ]
        );
        $this->add_responsive_control(
          'gall_desc_alignment',
          [
            'label' => esc_html__( 'Image Description Alignment', 'avas-core' ),
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
              ]
            ],
            'selectors' => [
              '{{WRAPPER}} .tx-gallery-desc > *' => 'text-align: {{VALUE}};',
            ],
           
          ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'overlay_styles',
            [
              'label'   => esc_html__( 'Overlay', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'gall_overlay_color',
            [
                'label'     => esc_html__( 'Overlay Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0,0,0,.2)',
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-overlay' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'gall_overlay_margin',
            [
                'label' => esc_html__('Overlay Margin', 'avas-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'icons_styles',
            [
              'label'   => esc_html__( 'Icons', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'gall_icon_font_size',
            [
                'label'   => esc_html__( 'Icons Size', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-icons i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'gall_icons_position',
            [
                'label'   => esc_html__( 'Icon Position (Y)', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-icons'   => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_responsive_control(
            'gall_icons_spacing',
            [
                'label'   => esc_html__( 'Icon Spacing', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 50,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-popup'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-gallery-link'   => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
            'gall_lb_icon_color',
            [
                'label'     => esc_html__( 'Lightbox Icon Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-popup i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gall_popup_switch' => 'show'
                ]
            ]
        );
        $this->add_control(
            'gall_lb_icon_hov_color',
            [
                'label'     => esc_html__( 'Lightbox Icon Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-popup i:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gall_popup_switch' => 'show'
                ]
            ]
        );
        $this->add_control(
            'gall_link_icon_color',
            [
                'label'     => esc_html__( 'Link Icon Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-link i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gall_link_switch' => 'show'
                ]
            ]
        );
        $this->add_control(
            'gall_link_icon_hov_color',
            [
                'label'     => esc_html__( 'Link Icon Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-link i:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gall_link_switch' => 'show'
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'filter_styles',
            [
              'label'   => esc_html__( 'Filters', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
              'condition' => [
                            'gall_filter' => 'yes'
                        ],
            ]
        );
        $this->add_responsive_control(
          'gall_filter_alignment',
          [
            'label' => esc_html__( 'Filter Alignment', 'avas-core' ),
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
              ]
            ],
            'selectors' => [
              '{{WRAPPER}} .tx-gallery-filters' => 'text-align: {{VALUE}};',
            ],
       
          ]
        );
        $this->add_responsive_control(
            'gall_filter_margin',
            [
                'label' => esc_html__('Margin', 'avas-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-filters' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'gall_filter_border',
                        'label' => esc_html__( 'Filter Item Border', 'avas-core' ),
                        'selector' => '{{WRAPPER}} .tx-gallery-filter-item',
                        
                    ]
                );
                $this->add_responsive_control(
                    'gall_filter_item_radius',
                    [
                        'label' => esc_html__('Filter Item Border Radius', 'avas-core'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        
                    ]
                );
                $this->add_responsive_control(
                    'gall_filter_item_padding',
                    [
                        'label' => esc_html__('Filter Item Padding', 'avas-core'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        
                    ]
                );
                $this->add_responsive_control(
                    'gall_filter_item_margin',
                    [
                        'label' => esc_html__('Filter Item Margin', 'avas-core'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                      [
                           'name'    => 'gall_filter_item_typography',
                           'selector'  => '{{WRAPPER}} .tx-gallery-filter-item',
                      ]
                );
        $this->start_controls_tabs('style_filter_tabs');

            $this->start_controls_tab( 
                'style_filter_normal', 
                [ 
                    'label' => esc_html__( 'Normal', 'avas-core' ) 
                ] 
            );
                $this->add_control(
                    'gall_filter_item_color',
                    [
                        'label'     => esc_html__( 'Filter Item Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item' => 'color: {{VALUE}};',
                        ],
                        
                        'separator' => 'before'
                    ]
                );
                $this->add_control(
                    'gall_filter_item_bg_color',
                    [
                        'label'     => esc_html__( 'Filter Item Background Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item' => 'background-color: {{VALUE}};',
                        ],

                    ]
                );
                $this->add_control(
                    'gall_filter_item_border_color',
                    [
                        'label'     => esc_html__( 'Filter Item Border Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item' => 'border-color: {{VALUE}};',
                        ],

                    ]
                );
                
            $this->end_controls_tab();

            $this->start_controls_tab( 
                'style_filter_hover', 
                [ 
                    'label' => esc_html__( 'Hover', 'avas-core' ) 
                ] 
            );
                $this->add_control(
                    'gall_filter_item_hov_color',
                    [
                        'label'     => esc_html__( 'Filter Item Hover Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item:hover' => 'color: {{VALUE}};',
                        ],
                       
                    ]
                );
                $this->add_control(
                    'gall_filter_item_bg_hov_color',
                    [
                        'label'     => esc_html__( 'Filter Item Background Hover Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item:hover' => 'background-color: {{VALUE}};',
                        ],
                        
                    ]
                );
                $this->add_control(
                    'gall_filter_item_border_hov_color',
                    [
                        'label'     => esc_html__( 'Filter Item Border Hover Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item:hover' => 'border-color: {{VALUE}};',
                        ],
                        
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab( 
                'style_filter_active', 
                [ 
                    'label' => esc_html__( 'Active', 'avas-core' ) 
                ] 
            );
                $this->add_control(
                    'gall_filter_item_active_color',
                    [
                        'label'     => esc_html__( 'Filter Item Active Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item.active' => 'color: {{VALUE}};',
                        ],
                       
                    ]
                );
                $this->add_control(
                    'gall_filter_item_active_bg_color',
                    [
                        'label'     => esc_html__( 'Filter Item Active Background Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item.active' => 'background-color: {{VALUE}};',
                        ],
                        
                    ]
                );
                $this->add_control(
                    'gall_filter_item_active_border_color',
                    [
                        'label'     => esc_html__( 'Filter Item Active Border Color', 'avas-core' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tx-gallery-filter-item.active' => 'border-color: {{VALUE}};',
                        ],
                        
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'gall_search_styles',
            [
              'label'   => esc_html__( 'Search', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
              'condition' => [
                    'gall_search' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
          'gall_search_alignment',
          [
            'label' => esc_html__( 'Search Alignment', 'avas-core' ),
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
              ]
            ],
            'selectors' => [
              '{{WRAPPER}} .tx-gallery-search' => 'text-align: {{VALUE}};',
            ],
       
          ]
        );
        $this->add_responsive_control(
            'gall_search_width',
            [
                'label'   => esc_html__( 'Search Width', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px', 'em', ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'tablet_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                 'mobile_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-search-input'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'gall_search_height',
            [
                'label'   => esc_html__( 'Search Height', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', ],
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 300,
                        'min'  => 0,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'tablet_default' => [
                    // 'size' => 100,
                    'unit' => 'px',
                ],
                 'mobile_default' => [
                    // 'size' => 100,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-search-input'   => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'gall_search_radius',
            [
                'label'   => esc_html__( 'Search Border Radius', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-search-input'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'gall_search_box_shadow',
                'selector' => '{{WRAPPER}} .tx-gallery-search-input'
            ]
        );
        $this->add_control(
            'gall_search_color',
            [
                'label'     => esc_html__( 'Search Input Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-search-input' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'gall_search_bg_color',
            [
                'label'     => esc_html__( 'Search Input Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-search-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'gall_search_placeholder_color',
            [
                'label'     => esc_html__( 'Search Placeholder Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-search-input::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'gall_search_typography',
                   'selector'  => '{{WRAPPER}} .tx-gallery-search-input',
              ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'gall_search_border',
                'label' => esc_html__( 'Search Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-gallery-search-input',
            ]
        );
        $this->add_responsive_control(
            'gall_search_margin',
            [
                'label' => esc_html__('Margin', 'avas-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-search' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'gall_search_padding',
            [
                'label' => esc_html__('Padding', 'avas-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tx-gallery-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
          'gall_search_input_alignment',
          [
            'label' => esc_html__( 'Search Text Alignment', 'avas-core' ),
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
              ]
            ],
            'selectors' => [
              '{{WRAPPER}} .tx-gallery-search-input' => 'text-align: {{VALUE}};',
            ],
       
          ]
        );
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $this->add_render_attribute(
            [
                'tx-gallery' => [
                    'class' => [
                        'tx-gallery-wrap',
                        $settings['gall_img_style']
                    ],
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            'columnWidth' => $settings['gall_cols'],
                            'layoutMode'  => $settings['layoutMode'],
                            'transitionDuration' => $settings["transitionDuration"] ? 400:0,
                        ]))
                    ]
                ]
            ]
        );

    ?>
        
    <div <?php echo $this->get_render_attribute_string( 'tx-gallery' ); ?>>
        <?php if('above' === $settings['gall_search_position']): ?>
            <?php if( 'yes' === $settings['gall_search'] ) : ?>
            <div class="tx-gallery-search">
                <?php if(is_rtl()): ?>
                <input id="tx-gallery-search-<?php echo $id; ?>" class="tx-gallery-search-input" name="search" type="text"  placeholder="<?php echo esc_attr( $settings['gall_search_text'] ); ?> &#61442;" onfocus="this.placeholder = ''"
onblur="this.placeholder = '<?php echo esc_attr( $settings['gall_search_text'] ); ?> &#61442;'" >
                <?php else : ?>
                    <input id="tx-gallery-search-<?php echo $id; ?>" class="tx-gallery-search-input" name="search" type="text"  placeholder=" &#61442; <?php echo esc_attr( $settings['gall_search_text'] ); ?>" onfocus="this.placeholder = ''"
onblur="this.placeholder = ' &#61442; <?php echo esc_attr( $settings['gall_search_text'] ); ?>'"  >
                <?php endif; ?>
            </div><!-- tx-gallery-search -->
            <?php endif; ?>
        <?php endif; ?>
    
        <?php if( 'yes' === $settings['gall_filter'] ) : ?>
            <ul id="tx-gallery-filters-<?php echo $id; ?>" class="tx-gallery-filters">
                <li id="tx-gallery-filter-item-<?php echo $id; ?>" class="tx-gallery-filter-item" data-filter="*"><?php echo esc_attr( $settings['gall_all_label_text'] ); ?></li>
                <?php foreach ($settings['gall_filter_controls'] as $item ) :
                    $filter = $item['gall_filter_item'];
                            $sps = preg_replace('/\s+/', '', $filter);
                            $filt = strtolower($sps);
                if(!empty($item['gall_filter_item'])) :
                ?>
                <li id="tx-gallery-filter-item-<?php echo $id; ?>" class="tx-gallery-filter-item" data-filter=".<?php echo $filt; ?>"><?php echo $item['gall_filter_item']; ?></li>
                <?php
                endif; 
                endforeach; 
                ?>
            </ul><!-- tx-gallery-filter -->
        <?php endif; ?>
        <?php if('below' === $settings['gall_search_position']): ?>
        <?php if( 'yes' === $settings['gall_search'] ) : ?>
            <div class="tx-gallery-search">
                <?php if(is_rtl()): ?>
                <input id="tx-gallery-search-<?php echo $id; ?>" class="tx-gallery-search-input" name="search" type="text"  placeholder="<?php echo esc_attr( $settings['gall_search_text'] ); ?> &#61442;" onfocus="this.placeholder = ''"
onblur="this.placeholder = '<?php echo esc_attr( $settings['gall_search_text'] ); ?> &#61442;'" >
                <?php else : ?>
                    <input id="tx-gallery-search-<?php echo $id; ?>" class="tx-gallery-search-input" name="search" type="text"  placeholder=" &#61442; <?php echo esc_attr( $settings['gall_search_text'] ); ?>" onfocus="this.placeholder = ''"
onblur="this.placeholder = ' &#61442; <?php echo esc_attr( $settings['gall_search_text'] ); ?>'"  >
                <?php endif; ?>
            </div><!-- tx-gallery-search -->
        <?php endif; ?>
        <?php endif; ?>

            <div id="tx-gallery-grid-<?php echo $id; ?>" class="tx-gallery-grid">
                <?php 
                    foreach ($settings['gall_items'] as $item ) :

                        $cat = $item['gall_filter_name'];
                        $ns = preg_replace('/\s+/', '', $cat);
                        $fil = strtolower($ns);
                        $fill_expl = explode(',', $fil );
                        $fill_cat = implode(' ', $fill_expl);



                        $in = $item['gall_img_name'];
                        $rs = preg_replace('/\s+/', '', $in);
                        $data = strtolower($rs);

                        $target = $item['gall_img_link_url']['is_external'] ? '_blank' : '_self';
                        ?>
                    <?php if($settings['gall_img_style'] != 'tx-gallery-style-3') : ?>
                        <div id="tx-gallery-item-<?php echo $id; ?>" class="tx-gallery-item <?php echo esc_attr($fill_cat); ?> elementor-animation-<?php echo esc_attr($settings['hover_animation']); ?>" data-category="<?php echo esc_attr($fill_cat); ?>">
                           <?php echo Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
                            <?php if( 'yes' === $settings['gall_search'] ) : ?>
                            <span class="d-none"><?php echo esc_attr($item['gall_img_name']); ?></span>
                            <span class="d-none"><?php echo esc_attr($item['gall_filter_name']); ?></span>
                            <?php endif; ?>

                            <div class="tx-gallery-overlay">  

                                <div class="tx-gallery-icons">

                                    <?php if( 'show' === $settings['gall_popup_switch'] ) : ?>
                                    <a id="tx-gallery-popup-<?php echo $id; ?>" class="tx-gallery-popup" href="#<?php echo esc_attr($data); ?>" data-effect="mfp-zoom-in"><i class="bi bi-search"></i></a>
                                    <?php endif; ?>

                                    <?php if( !empty($item['gall_img_link_url']['url']) && 'show' === $settings['gall_link_switch'] ) : ?>
                                    <a class="tx-gallery-link" href="<?php echo esc_url($item['gall_img_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>"><i class="bi bi-link-45deg"></i></a>
                                    <?php endif; ?>


                                </div><!-- .tx-gallery-icons -->

                                <div class="tx-gallery-desc"><?php echo wp_kses_post( $item['gall_desc'] ); ?></div><!-- tx-gallery-desc -->
                                
                                <?php if( 'show' === $settings['gall_img_name_switch'] || 'show' === $settings['gall_filter_switch'] ) : ?>
                                <div class="tx-gallery-title-bar">
                                    
                                    <h5 class="tx-gallery-name">
                                    <?php if( !empty($item['gall_img_link_url']['url']) ) : ?>
                                    <a href="<?php echo esc_url($item['gall_img_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
                                    <?php endif; ?>
                                    <?php if( !empty($item['gall_img_name']) && 'show' === $settings['gall_img_name_switch'] ) : ?>
                                        <?php echo esc_attr($item['gall_img_name']); ?>
                                    <?php endif; ?>    
                                    <?php if(!empty($item['gall_img_link_url']['url']) || $settings['gall_link_switch']) : ?></a><?php endif; ?>
                                    </h5><!-- tx-gallery-name -->

                                    <?php if( !empty($item['gall_filter_name']) && 'show' === $settings['gall_filter_switch'] ) : ?>
                                    <h5 class="tx-gallery-categoy"><?php echo esc_html($item['gall_filter_name']); ?></h5>
                                    <?php endif; ?>

                                </div><!-- tx-gallery-title-bar -->
                                <?php endif; ?>
                            </div><!-- tx-gallery-overlay -->
                          
                                                     
                        </div><!-- tx-gallery-item -->


                        <div id="<?php echo esc_attr($data); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
                          <img src="<?php echo esc_attr($item['image']['url']); ?>">
                        </div><!-- /.tx-port-enlrg-content -->
                    <?php endif; ?>


                        <?php if($settings['gall_img_style'] == 'tx-gallery-style-3') : ?>
                            <div id="tx-gallery-item-<?php echo $id; ?>" class="tx-gallery-item <?php echo esc_attr($fill_cat); ?> elementor-animation-<?php echo esc_attr($settings['hover_animation']); ?>" data-category="<?php echo esc_attr($fill_cat); ?>">

                           <?php echo Group_Control_Image_Size::get_attachment_image_html( $item ); ?>

                            <?php if( 'yes' === $settings['gall_search'] ) : ?>
                            <span class="d-none"><?php echo esc_attr($item['gall_img_name']); ?></span>
                            <span class="d-none"><?php echo esc_attr($item['gall_filter_name']); ?></span>
                            <?php endif; ?>

                            <?php if( !empty($item['gall_img_link_url']['url']) ) : ?>
                            <a href="<?php echo esc_url($item['gall_img_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
                            <?php endif; ?>
                                <div class="tx-gallery-overlay"></div>
                            <?php if( !empty($item['gall_img_link_url']['url']) ) : ?></a><?php endif; ?>

                            <div class="tx-gallery-desc"><?php echo wp_kses_post( $item['gall_desc'] ); ?></div><!-- tx-gallery-desc -->
                            <?php if( 'show' === $settings['gall_img_name_switch'] && !empty($item['gall_img_name']) || 'show' === $settings['gall_filter_switch'] && !empty($item['gall_filter_name'])) : ?>
                                <div class="tx-gallery-title-bar">
                                    <h5 class="tx-gallery-name">
                                    <?php if( !empty($item['gall_img_link_url']['url']) ) : ?>
                                    <a href="<?php echo esc_url($item['gall_img_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
                                    <?php endif; ?>
                                    <?php if( !empty($item['gall_img_name']) && 'show' === $settings['gall_img_name_switch'] ) : ?>
                                        <?php echo esc_attr($item['gall_img_name']); ?>
                                    <?php endif; ?>    
                                    <?php if(!empty($item['gall_img_link_url']['url']) || $settings['gall_link_switch']) : ?></a><?php endif; ?>
                                    </h5><!-- tx-gallery-name -->

                                    <?php if( !empty($item['gall_filter_name']) && 'show' === $settings['gall_filter_switch'] ) : ?>
                                    <h5 class="tx-gallery-categoy"><?php echo esc_html($item['gall_filter_name']); ?></h5>
                                    <?php endif; ?>

                                </div><!-- tx-gallery-title-bar -->
                                <?php endif; ?>

                            <!-- </div> -->
                                                     
                            </div><!-- tx-gallery-item -->
                        <?php endif; ?>

                <?php endforeach; ?>
                
            </div><!-- tx-gallery-grid -->

    </div><!-- tx-gallery-wrap -->

<?php
    } // render end


} // class end

