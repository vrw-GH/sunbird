<?php
namespace AvasElements\Modules\ContactFormSeven\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ContactFormSeven extends Widget_Base {

    public function get_name() {
        return 'avas-contact-form-7';
    }

    public function get_title() {
        return esc_html__( 'Avas Contact Form 7', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {
        
        if (!function_exists('wpcf7')) {
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
                    'raw' => __('Please install / activate <strong>Contact Form 7</strong> plugin.', 'avas-core'),
                ]
            );

            $this->end_controls_section();
        } else {
		$this->start_controls_section(
            'tx_cf7_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
            'tx_cf7_list',
            [
                'label'                 => esc_html__( 'Select Form', 'avas-core' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => true,
                'options'               => TX_Helper::contact_form_seven(),
            ]
        );
  
        $this->end_controls_section();

		$this->start_controls_section(
            'tx_cf7_label',
            [
                'label' => esc_html__( 'Label', 'avas-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tx_cf7_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tx_cf7_label_typo',
                'label' => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .wpcf7-form label',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_cf7__input',
            [
                'label' => esc_html__( 'Input', 'avas-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tx_cf7_input_height',
            [
                'label' => esc_html__( 'Input Field Height', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select, {{WRAPPER}} input.wpcf7-form-control.wpcf7-date.wpcf7-validates-as-date, {{WRAPPER}} input.wpcf7-form-control.wpcf7-text, {{WRAPPER}} .wpcf7-form-control.wpcf7-quiz' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'tx_cf7_input_width',
            [
                'label' => esc_html__( 'Input Field Width', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,

                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                ],
                'default' => [
                        'unit' => '%'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select, {{WRAPPER}} input.wpcf7-form-control.wpcf7-date.wpcf7-validates-as-date, {{WRAPPER}} input.wpcf7-form-control.wpcf7-text, {{WRAPPER}} .wpcf7-form-control.wpcf7-quiz' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'tx_cf7_input_placeholder_color',
            [
                'label'     => esc_html__( 'Placeholder Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input::placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tx_cf7_placeholder_typography',
                'label' => esc_html__( 'Placeholder Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control::-webkit-input-placeholder',
            ]
        );
        $this->add_control(
            'tx_cf7_input_text_color',
            [
                'label'     => esc_html__( 'Input Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-textarea' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tx_cf7_others_text_color',
            [
                'label'     => esc_html__( 'Others Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap.select-state' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap.select-gender' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap.accept-this-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tx_cf7_input_text_background',
            [
                'label'     => esc_html__( 'Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-textarea' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-date' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tx_cf7_input_typography',
                'label' => esc_html__( 'Input Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .wpcf7-form-control.wpcf7-select, {{WRAPPER}} .wpcf7-form-control.wpcf7-date',
            ]
        );
        $this->add_responsive_control(
            'tx_cf7_textarea_height',
            [
                'label' => esc_html__( 'Textarea Height', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 200,
                ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}}; display: block;',
                ],
                'separator' => 'before',

            ]
        );

        $this->add_responsive_control(
            'tx_cf7_input_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-textarea, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tx_cf7_input_space',
            [
                'label' => esc_html__( 'Element Space', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 25,
                ],
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7-form' => 'margin-top: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'        => 'tx_cf7_input_border',
                'label'       => esc_html__( 'Border', 'avas-core' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea, {{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select',
            ]
        );

        $this->add_responsive_control(
            'tx_cf7_input_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control-wrap .wpcf7-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'tx_cf7_submit_button',
            [
                'label' => esc_html__( 'Submit Button', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tx_cf7_tabs_button_style' );

        $this->start_controls_tab(
            'tx_cf7_button_normal',
            [
                'label' => esc_html__( 'Normal', 'avas-core' ),
            ]
        );
        $this->add_responsive_control(
            'tx_cf7_submit_button_width',
            [
                'label' => esc_html__( 'Width', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_control(
            'tx_cf7_button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tx_cf7_button_background_color',
            [
                'label' => esc_html__( 'Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tx_cf7_button_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tx_cf7_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tx_cf7_button_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_responsive_control(
            'tx_cf7_button_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tx_cf7_button_typography',
                'label' => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tx_cf7_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'avas-core' ),
            ]
        );

        $this->add_control(
            'tx_cf7_tab_button_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tx_cf7_tab_button_background_hover_color',
            [
                'label' => esc_html__( 'Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tx_cf7_tab_button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

	}
}

	protected function render() {
        $settings = $this->get_settings();

        if ( function_exists( 'wpcf7' ) ) {
		
        ?>
        
        <?php if ( !empty( $settings['tx_cf7_list'] ) ) : ?>
        <div class="tx-contact-form-7">

           <?php echo do_shortcode( '[contact-form-7 id="' . $settings['tx_cf7_list'] . '" ]' ); ?>
       
        </div><!-- tx-contact-form-7 -->
        <?php endif; ?>

    <?php

        } else { ?>

            <h4><?php echo esc_html__('Please install / activate Contact Form 7 plugin.', 'avas-core'); ?></h4>

    <?php }



	} //function render()
} // class
