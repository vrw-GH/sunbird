<?php
namespace AvasElements\Modules\GravityForm\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class GravityForm extends Widget_Base {

    public function get_name() {
        return 'avas-gravity-form';
    }

    public function get_title() {
        return esc_html__( 'Avas Gravity Form', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {
        
        if (!class_exists('GFCommon')) {
            $this->start_controls_section(
                'tx_notice',
                [
                    'label' => esc_html__('Notice', 'avas-core'),
                ]
            );

            $this->add_control(
                'tx_notice_text',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => esc_html__('Please install / activate <strong>Gravity Form</strong> plugin.', 'avas-core'),
                ]
            );

            $this->end_controls_section();
        } else {
    		$this->start_controls_section(
                'tx_gvf_settings',
                [
                    'label' => esc_html__( 'Settings', 'avas-core' )
                ]
            );
            $this->add_control(
                'tx_gvf_list',
                [
                    'label'                 => esc_html__( 'Select Form', 'avas-core' ),
                    'type'                  => Controls_Manager::SELECT,
                    'label_block'           => true,
                    'options'               => TX_Helper::gravity_form(),
                    'default'               => 1,
                ]
            );
            $this->add_control(
                'tx_gvf_title',
                [
                    'label'                 => esc_html__( 'Title', 'avas-core'),
                    'type'                  => Controls_Manager::SWITCHER,
                    'default'               => 'yes',
                    'label_on'              => esc_html__( 'Show', 'avas-core'),
                    'label_off'             => esc_html__( 'Hide', 'avas-core'),
                    'return_value'          => 'yes',

                ]
            );
            
            $this->add_control(
                'tx_gvf_description',
                [
                    'label'                 => esc_html__( 'Description', 'avas-core'),
                    'type'                  => Controls_Manager::SWITCHER,
                    'default'               => 'yes',
                    'label_on'              => esc_html__( 'Show', 'avas-core'),
                    'label_off'             => esc_html__( 'Hide', 'avas-core'),
                    'return_value'          => 'yes',
                ]
            );
            
            $this->add_control(
                'tx_gvf_label',
                [
                    'label'                 => esc_html__( 'Label', 'avas-core'),
                    'type'                  => Controls_Manager::SWITCHER,
                    'default'               => 'yes',
                    'label_on'              => esc_html__( 'Show', 'avas-core'),
                    'label_off'             => esc_html__( 'Hide', 'avas-core'),
                    'return_value'          => 'yes',
                ]
            );
            
            $this->add_control(
                'tx_gvf_ajax',
                [
                    'label'                 => esc_html__( 'Ajax', 'avas-core'),
                    'type'                  => Controls_Manager::SWITCHER,
                    'description'           => esc_html__( 'Use ajax to submit the form', 'avas-core'),
                    'label_on'              => esc_html__( 'Yes', 'avas-core'),
                    'label_off'             => esc_html__( 'No', 'avas-core'),
                    'return_value'          => 'yes',
                ]
            );
  
        $this->end_controls_section();
        $this->start_controls_section(
            'title_desc_style',
            [
                'label' => esc_html__( 'Title & Description', 'avas-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
          'title_desc_alignment',
          [
            'label' => esc_html__( 'Title & Description Alignment', 'avas-core' ),
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
              '{{WRAPPER}} .gform_wrapper .gform_heading' => 'text-align: {{VALUE}};',
            ],
            
          ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gform_wrapper h3.gform_title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Title Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .gform_wrapper h3.gform_title',
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gform_wrapper span.gform_description' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__( 'Description Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .gform_wrapper span.gform_description',
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
            'label_style',
            [
                'label' => esc_html__( 'Label', 'avas-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => esc_html__( 'Label Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gform_wrapper label.gfield_label, {{WRAPPER}} .gform_wrapper legend.gfield_label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typo',
                'label' => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .gform_wrapper label.gfield_label, {{WRAPPER}} .gform_wrapper legend.gfield_label',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'input_textarea_style',
            [
                'label'                 => esc_html__( 'Input & Textarea', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'input_alignment',
            [
                'label'                 => esc_html__( 'Input Alignment', 'avas-core'),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'avas-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'avas-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'avas-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield textarea' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_fields_style' );

        $this->start_controls_tab(
            'tab_fields_normal',
            [
                'label'                 => esc_html__( 'Normal', 'avas-core'),
            ]
        );

        $this->add_control(
            'field_bg_color',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield input[type="tel"], {{WRAPPER}} .gfield input[type="url"], {{WRAPPER}} .gfield input[type="email"], {{WRAPPER}} .gfield textarea, {{WRAPPER}} .gfield select' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield input[type="tel"], {{WRAPPER}} .gfield input[type="url"], {{WRAPPER}} .gfield input[type="email"], {{WRAPPER}} .gfield textarea, {{WRAPPER}} .gfield select' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'field_spacing',
            [
                'label'                 => esc_html__( 'Spacing', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_spacing_right',
            [
                'label'                 => esc_html__( 'Spacing Right', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield.gf_left_half' => 'padding-right: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gfield textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'text_indent',
            [
                'label'                 => esc_html__( 'Text Indent', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 60,
                        'step'  => 1,
                    ],
                    '%'         => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield input[type="tel"], {{WRAPPER}} .gfield input[type="url"], {{WRAPPER}} .gfield input[type="email"], {{WRAPPER}} .gfield textarea, {{WRAPPER}} .gfield select' => 'text-indent: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'input_width',
            [
                'label'                 => esc_html__( 'Input Width', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield input[type="tel"], {{WRAPPER}} .gfield input[type="url"], {{WRAPPER}} .gfield input[type="email"], {{WRAPPER}} .gfield select' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'input_height',
            [
                'label'                 => esc_html__( 'Input Height', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 80,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield input[type="tel"], {{WRAPPER}} .gfield input[type="url"], {{WRAPPER}} .gfield input[type="email"], {{WRAPPER}} .gfield select' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'textarea_width',
            [
                'label'                 => esc_html__( 'Textarea Width', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield textarea' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'textarea_height',
            [
                'label'                 => esc_html__( 'Textarea Height', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 400,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield textarea' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'field_border',
                'label'                 => esc_html__( 'Border', 'avas-core'),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield input[type="tel"], {{WRAPPER}} .gfield input[type="url"], {{WRAPPER}} .gfield input[type="email"], {{WRAPPER}} .gfield textarea, {{WRAPPER}} .gfield select',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'field_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield input[type="tel"], {{WRAPPER}} .gfield input[type="url"], {{WRAPPER}} .gfield input[type="email"], {{WRAPPER}} .gfield textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'field_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gfield .ginput_complex.ginput_container input[type="text"], {{WRAPPER}} .gfield .ginput_container_date input[type="text"], {{WRAPPER}} .gfield .ginput_container_phone input[type="text"], {{WRAPPER}} .gfield .ginput_container_email input[type="text"], {{WRAPPER}} .gfield .ginput_container_text input[type="text"], {{WRAPPER}} .gfield textarea, {{WRAPPER}} .gfield select',
                'separator'             => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'field_box_shadow',
                'selector'              => '{{WRAPPER}} .gfield input[type="text"], {{WRAPPER}} .gfield input[type="tel"], {{WRAPPER}} .gfield input[type="url"], {{WRAPPER}} .gfield input[type="email"],{{WRAPPER}} .gfield textarea, {{WRAPPER}} .gfield select',
                'separator'             => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_fields_focus',
            [
                'label'                 => esc_html__( 'Focus', 'avas-core'),
            ]
        );

        $this->add_control(
            'field_bg_color_focus',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield input:focus, {{WRAPPER}} .gfield textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'focus_input_border',
                'label'                 => esc_html__( 'Border', 'avas-core'),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .gfield input:focus, {{WRAPPER}} .gfield textarea:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'focus_box_shadow',
                'selector'              => '{{WRAPPER}} .gfield input:focus, {{WRAPPER}} .gfield textarea:focus',
                'separator'             => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Field Description
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_field_description_style',
            [
                'label'                 => esc_html__( 'Field Description', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'field_description_text_color',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .gfield .gfield_description' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'field_description_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gfield .gfield_description',
            ]
        );
        
        $this->add_responsive_control(
            'field_description_spacing',
            [
                'label'                 => esc_html__( 'Spacing', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield .gfield_description' => 'padding-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Section Field
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_field_style',
            [
                'label'                 => esc_html__( 'Section Field', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_field_text_color',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield.gsection .gsection_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'section_field_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gfield.gsection .gsection_title',
                'separator'             => 'before',
            ]
        );
        
        $this->add_control(
            'section_field_border_type',
            [
                'label'                 => esc_html__( 'Border Type', 'avas-core'),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'solid',
                'options'               => [
                    'none'      => esc_html__( 'None', 'avas-core'),
                    'solid'     => esc_html__( 'Solid', 'avas-core'),
                    'double'    => esc_html__( 'Double', 'avas-core'),
                    'dotted'    => esc_html__( 'Dotted', 'avas-core'),
                    'dashed'    => esc_html__( 'Dashed', 'avas-core'),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield.gsection' => 'border-bottom-style: {{VALUE}}',
                ],
                'separator'             => 'before',
            ]
        );
        
        $this->add_responsive_control(
            'section_field_border_height',
            [
                'label'                 => esc_html__( 'Border Height', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'  => 1,
                ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 20,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield.gsection' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'section_field_border_type!'   => 'none',
                ],
            ]
        );

        $this->add_control(
            'section_field_border_color',
            [
                'label'                 => esc_html__( 'Border Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield.gsection' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition'             => [
                    'section_field_border_type!'   => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_field_margin',
            [
                'label'                 => esc_html__( 'Margin', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gfield.gsection' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'             => 'before',
            ]
        );
        
        $this->end_controls_section();

        // Price
        $this->start_controls_section(
            'section_price_style',
            [
                'label'                 => esc_html__( 'Price', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_label_color',
            [
                'label'                 => esc_html__( 'Price Label Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .ginput_product_price_label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'price_text_color',
            [
                'label'                 => esc_html__( 'Price Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .ginput_product_price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'price_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gform_wrapper .ginput_product_price, {{WRAPPER}} .gform_wrapper .ginput_product_price_label',
            ]
        );
        $this->end_controls_section();

        // Total Price
        $this->start_controls_section(
            'section_total_price_style',
            [
                'label'                 => esc_html__( 'Total Price', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'total_price_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gform_wrapper .ginput_container_total .ginput_total',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'total_price_text_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .ginput_container_total .ginput_total' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        // Shipping Price
        $this->start_controls_section(
            'shipping_price_style',
            [
                'label'                 => esc_html__( 'Shipping Price', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'shipping_price_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gform_wrapper .ginput_shipping_price',
            ]
        );

        $this->add_control(
            'shipping_price_text_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .ginput_shipping_price' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

        // Placeholder
        $this->start_controls_section(
            'section_placeholder_style',
            [
                'label'                 => esc_html__( 'Placeholder', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color_placeholder',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .gfield input::-webkit-input-placeholder, {{WRAPPER}} .gfield textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'placeholder_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gfield input::-webkit-input-placeholder, {{WRAPPER}} .gfield textarea::-webkit-input-placeholder',
            ]
        );
        
        $this->end_controls_section();
        
        // Checkbox
        $this->start_controls_section(
            'section_checkbox_style',
            [
                'label'                 => esc_html__( 'Checkbox', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_checkbox_style' );

        $this->start_controls_tab(
            'checkbox_normal',
            [
                'label'                 => esc_html__( 'Normal', 'avas-core'),
            ]
        );
        $this->add_responsive_control(
            'checkbox_size',
            [
                'label'                 => esc_html__( 'Size', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '15',
                    'unit'      => 'px'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 80,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gfield_checkbox li input, {{WRAPPER}} .gform_wrapper .gfield_checkbox li input[type=checkbox]' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
                
            ]
        );
        $this->add_control(
            'checkbox_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gfield_checkbox li input, {{WRAPPER}} .gform_wrapper .gfield_checkbox li input[type=checkbox]' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'checkbox_border_width',
            [
                'label'                 => esc_html__( 'Border Width', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 15,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gfield_checkbox li input, {{WRAPPER}} .gform_wrapper .gfield_checkbox li input[type=checkbox]' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'checkbox_border_color',
            [
                'label'                 => esc_html__( 'Border Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gfield_checkbox li input, {{WRAPPER}} .gform_wrapper .gfield_checkbox li input[type=checkbox]' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'checkbox_border_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gfield_checkbox li input, {{WRAPPER}} .gform_wrapper .gfield_checkbox li input[type=checkbox]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'checkbox_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .gform_wrapper .gfield_checkbox li input, {{WRAPPER}} .gform_wrapper .gfield_checkbox li input[type=checkbox]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'checkbox_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gfield_checkbox li input, {{WRAPPER}} .gform_wrapper .gfield_checkbox li input[type=checkbox]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'checkbox_checked',
            [
                'label'                 => esc_html__( 'Checked', 'avas-core'),
            ]
        );

        $this->add_control(
            'checkbox_color_checked',
            [
                'label'                 => esc_html__( 'Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gfield_checkbox li input[type=checkbox]:checked:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Radio
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_radio_style',
            [
                'label'                 => esc_html__( 'Radio', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'custom_radio_style',
            [
                'label'                 => esc_html__( 'Custom Styles', 'avas-core'),
                'type'                  => Controls_Manager::SWITCHER,
                'label_on'              => esc_html__( 'Yes', 'avas-core'),
                'label_off'             => esc_html__( 'No', 'avas-core'),
                'return_value'          => 'yes',
            ]
        );

        $this->add_responsive_control(
            'radio_size',
            [
                'label'                 => esc_html__( 'Size', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '15',
                    'unit'      => 'px'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 80,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-gravity-form input[type="radio"]' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_radio_style' );

        $this->start_controls_tab(
            'radio_normal',
            [
                'label'                 => esc_html__( 'Normal', 'avas-core'),
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-gravity-form input[type="radio"]' => 'background: {{VALUE}}',
                ],
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'radio_border_width',
            [
                'label'                 => esc_html__( 'Border Width', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 15,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-gravity-form input[type="radio"]' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_border_color',
            [
                'label'                 => esc_html__( 'Border Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-gravity-form input[type="radio"]' => 'border-color: {{VALUE}}',
                ],
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'radio_heading',
            [
                'label'                 => esc_html__( 'Radio Buttons', 'avas-core'),
                'type'                  => Controls_Manager::HEADING,
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_border_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-gravity-form input[type="radio"], {{WRAPPER}} .tx-gravity-form input[type="radio"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'radio_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-gravity-form input[type="radio"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'radio_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .tx-gravity-form input[type="radio"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'radio_checked',
            [
                'label'                 => esc_html__( 'Checked', 'avas-core'),
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'radio_color_checked',
            [
                'label'                 => esc_html__( 'Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .tx-gravity-form input[type="radio"]:checked:before' => 'background: {{VALUE}}',
                ],
                'condition'             => [
                    'custom_radio_style' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        /**
         * Style Tab: Scrolling Text
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'scrolling_text_style',
            [
                'label' => esc_html__( 'Scrolling Text', 'avas-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'scrolling_text_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gform_wrapper .gf_scroll_text .gsection_description',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'scrolling_text_color',
            [
                'label'                 => esc_html__( 'Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gf_scroll_text .gsection_description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'scrolling_text_bg_color',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gf_scroll_text .gsection_description' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'scrolling_text_width',
            [
                'label'                 => esc_html__( 'Width', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '100',
                    'unit'      => '%'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gf_scroll_text' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'scrolling_text_border',
                'label'                 => esc_html__( 'Border', 'avas-core'),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .gform_wrapper .gf_scroll_text',
            ]
        );
        
        $this->add_control(
            'scrolling_text_border_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gf_scroll_text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'scrolling_text_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .gf_scroll_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .gform_wrapper .gf_scroll_text .gsection_description' => 'margin: 0;',
                    '{{WRAPPER}} .gform_wrapper .gf_scroll_text::-webkit-scrollbar' => 'border:2px solid #009900;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'scrolling_text_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .gform_wrapper .gf_scroll_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Submit Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_submit_button_style',
            [
                'label'                 => esc_html__( 'Submit Button', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'button_align',
            [
                'label'                 => esc_html__( 'Alignment', 'avas-core'),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'left'        => [
                        'title'   => esc_html__( 'Left', 'avas-core'),
                        'icon'    => 'eicon-h-align-left',
                    ],
                    'center'      => [
                        'title'   => esc_html__( 'Center', 'avas-core'),
                        'icon'    => 'eicon-h-align-center',
                    ],
                    'right'       => [
                        'title'   => esc_html__( 'Right', 'avas-core'),
                        'icon'    => 'eicon-h-align-right',
                    ],
                ],
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer'   => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .gform_footer input[type="submit"]' => 'display:inline-block;'
                ],
                'condition'             => [
                    'button_width_type' => 'custom',
                ],
            ]
        );
        
        $this->add_control(
            'button_width_type',
            [
                'label'                 => esc_html__( 'Width', 'avas-core'),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'custom',
                'options'               => [
                    'full-width'    => esc_html__( 'Full Width', 'avas-core'),
                    'custom'        => esc_html__( 'Custom', 'avas-core'),
                ],
                'prefix_class'          => 'tx-gravity-form-button-',
            ]
        );
        
        $this->add_responsive_control(
            'button_width',
            [
                'label'                 => esc_html__( 'Width', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '100',
                    'unit'      => 'px'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'button_width_type' => 'custom',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'                 => esc_html__( 'Normal', 'avas-core'),
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'button_border_normal',
                'label'                 => esc_html__( 'Border', 'avas-core'),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .gform_footer input[type="submit"], {{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_margin',
            [
                'label'                 => esc_html__( 'Margin Top', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => esc_html__( 'Hover', 'avas-core'),
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => esc_html__( 'Border Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_footer input[type="submit"]:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gform_footer input[type="submit"], {{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]',
                'separator'             => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'button_box_shadow',
                'selector'              => '{{WRAPPER}} .gform_footer input[type="submit"], {{WRAPPER}} .gform_body .gform_page_footer input[type="submit"]',
                'separator'             => 'before',
            ]
        );
        
        $this->end_controls_section();


        /**
         * Style Tab: Next Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'gf_section_next_button_style',
            [
                'label'                 => esc_html__( 'Next/Previous Button', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'gf_next_button_align',
            [
                'label'                 => esc_html__( 'Alignment', 'avas-core'),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'left'        => [
                        'title'   => esc_html__( 'Left', 'avas-core'),
                        'icon'    => 'eicon-h-align-left',
                    ],
                    'center'      => [
                        'title'   => esc_html__( 'Center', 'avas-core'),
                        'icon'    => 'eicon-h-align-center',
                    ],
                    'right'       => [
                        'title'   => esc_html__( 'Right', 'avas-core'),
                        'icon'    => 'eicon-h-align-right',
                    ],
                ],
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer'   => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]' => 'display:inline-block;'
                ],
            ]
        );

        $this->add_responsive_control(
            'gf_next_button_width',
            [
                'label'                 => esc_html__( 'Width', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '100',
                    'unit'      => 'px'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'gf_tabs_next_button_style' );

        $this->start_controls_tab(
            'gf_tab_next_button_normal',
            [
                'label'                 => esc_html__( 'Normal', 'avas-core'),
            ]
        );

        $this->add_control(
            'gf_next_button_bg_color_normal',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'gf_next_button_text_color_normal',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'gf_next_button_border_normal',
                'label'                 => esc_html__( 'Border', 'avas-core'),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]',
            ]
        );

        $this->add_control(
            'gf_next_button_border_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gf_next_button_padding',
            [
                'label'                 => esc_html__( 'Padding', 'avas-core'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'gf_next_button_margin',
            [
                'label'                 => esc_html__( 'Margin Top', 'avas-core'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'gf_tab_next_button_hover',
            [
                'label'                 => esc_html__( 'Hover', 'avas-core'),
            ]
        );

        $this->add_control(
            'gf_next_button_bg_color_hover',
            [
                'label'                 => esc_html__( 'Background Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'gf_next_button_text_color_hover',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'gf_next_button_border_color_hover',
            [
                'label'                 => esc_html__( 'Border Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'gf_next_button_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]',
                'separator'             => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'gf_next_button_box_shadow',
                'selector'              => '{{WRAPPER}} .gform_body .gform_page_footer input[type="button"]',
                'separator'             => 'before',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Style Tab: Errors
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_error_style',
            [
                'label'                 => esc_html__( 'Errors', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'error_messages_heading',
            [
                'label'                 => esc_html__( 'Error Messages', 'avas-core'),
                'type'                  => Controls_Manager::HEADING,
                'condition'             => [
                    'error_messages' => 'show',
                ],
            ]
        );

        $this->add_control(
            'error_message_text_color',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield .validation_message' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'error_messages' => 'show',
                ],
            ]
        );
        
        $this->add_control(
            'validation_errors_heading',
            [
                'label'                 => esc_html__( 'Validation Errors', 'avas-core'),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_control(
            'validation_error_description_color',
            [
                'label'                 => esc_html__( 'Error Description Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .validation_error' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_control(
            'validation_error_border_color',
            [
                'label'                 => esc_html__( 'Error Border Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper .validation_error' => 'border-top-color: {{VALUE}}; border-bottom-color: {{VALUE}}',
                    '{{WRAPPER}} .gfield_error' => 'border-top-color: {{VALUE}}; border-bottom-color: {{VALUE}}',
                ],
                'condition'             => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_control(
            'validation_errors_bg_color',
            [
                'label'                 => esc_html__( 'Error Field Background Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield_error' => 'background: {{VALUE}}',
                ],
                'condition'             => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_control(
            'validation_error_field_label_color',
            [
                'label'                 => esc_html__( 'Error Field Label Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gfield_error .gfield_label' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_control(
            'validation_error_field_input_border_color',
            [
                'label'                 => esc_html__( 'Error Field Input Border Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper li.gfield_error input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gform_wrapper li.gfield_error textarea' => 'border-color: {{VALUE}}',
                ],
                'condition'             => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_control(
            'validation_error_field_input_border_width',
            [
                'label'                 => esc_html__( 'Error Field Input Border Width', 'avas-core'),
                'type'                  => Controls_Manager::NUMBER,
                'default'               => 1,
                'min'                   => 1,
                'max'                   => 10,
                'step'                  => 1,
                'selectors'             => [
                    '{{WRAPPER}} .gform_wrapper li.gfield_error input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gform_wrapper li.gfield_error textarea' => 'border-width: {{VALUE}}px',
                ],
                'condition'             => [
                    'validation_errors' => 'show',
                ],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Thank You Message
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_ty_style',
            [
                'label'                 => esc_html__( 'Thank You Message', 'avas-core'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ty_message_text_color',
            [
                'label'                 => esc_html__( 'Text Color', 'avas-core'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message' => 'color: {{VALUE}}!important',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'thankyou_message_typography',
                'label'                 => esc_html__( 'Typography', 'avas-core'),
                'selector'              => '{{WRAPPER}} .gform_confirmation_wrapper .gform_confirmation_message',
                'separator'             => 'before',
            ]
        );
        
        $this->end_controls_section();

	}
}

	protected function render() {
        $settings = $this->get_settings();

        if (class_exists('GFCommon')) {
            $this->add_render_attribute( 'tx-gravity-form', 'class', 'tx-gravity-form' );
            if ( $settings['tx_gvf_label'] != 'yes' ) {
                $this->add_render_attribute( 'tx-gravity-form', 'class', 'tx-label-hide' );
            }      
		
        ?>
        
        <?php if ( !empty( $settings['tx_gvf_list'] ) ) : ?>
        <div <?php echo $this->get_render_attribute_string( 'tx-gravity-form' ); ?>>

           <?php 
                $id = $settings['tx_gvf_list'];
                $title = $settings['tx_gvf_title'];
                $description = $settings['tx_gvf_description'];
                $ajax = $settings['tx_gvf_ajax'];
                gravity_form( $id, $title, $description, $display_inactive = false, $field_values = null, $ajax , '', $echo = true ); 
           ?>
       
        </div><!-- tx-gravity-form -->
        <?php endif; ?>

    <?php

        } else { ?>

            <h4><?php echo esc_html__('Please install / activate Gravity Form plugin.', 'avas-core'); ?></h4>

    <?php }



	} //function render()
} // class
