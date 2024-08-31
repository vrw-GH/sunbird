<?php
namespace AvasElements\Modules\Mailchimp\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Mailchimp extends Widget_Base {

    public function get_name() {
        return 'avas-mailchimp';
    }

    public function get_title() {
        return esc_html__( 'Avas Mailchimp', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_style_depends() {
        return [ 'tx-mailchimp'];
    }

	protected function register_controls() {

        if (!function_exists('_mc4wp_load_plugin')) {
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
                    'raw' => __('Please install/activate <strong>MC4WP: Mailchimp for WordPress</strong> plugin.', 'avas-core'),
                ]
            );

            $this->end_controls_section();
        } else {

        $this->start_controls_section(
            'tx_mailchimp',
            [
                'label' => esc_html__( 'Mailchimp', 'avas-core' ),
            ]
        );
        
            $this->add_control(
                'tx_mailchimp_form_style',
                [
                    'label' => esc_html__( 'Style', 'avas-core' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => esc_html__( 'Style One', 'avas-core' ),
                        '2'   => esc_html__( 'Style Two', 'avas-core' ),
                        '3'   => esc_html__( 'Style Three', 'avas-core' ),
                        '4'   => esc_html__( 'Style Four', 'avas-core' ),
                        '5'   => esc_html__( 'Style Five', 'avas-core' ),
                    ],
                ]
            );

            $this->add_control(
                'tx_mailchimp_id',
                [
                    'label'       => esc_html__( 'Mailchimp Form ID', 'avas-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( '987', 'avas-core' ),
                    'description' => __( 'To see the ID <a href="admin.php?page=mailchimp-for-wp-forms" target="_blank"> please click here </a>', 'avas-core' ),
                    'label_block' => true,
                    'separator'   => 'before',
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'tx_mailchimp_section_style',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'tx_mailchimp_section_padding',
                [
                    'label' => esc_html__( 'Padding', 'avas-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-input-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'tx_mailchimp_section_margin',
                [
                    'label' => esc_html__( 'Margin', 'avas-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-input-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'tx_mailchimp_section_background',
                    'label' => esc_html__( 'Background', 'avas-core' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .tx-input-box',
                ]
            );

            $this->add_responsive_control(
                'tx_mailchimp_section_align',
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
                        'justify' => [
                            'title' => esc_html__( 'Justified', 'avas-core' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-input-box' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        // Input Box style tab start
        $this->start_controls_section(
            'tx_mailchimp_input_style',
            [
                'label'     => esc_html__( 'Input Box', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'tx_input_box_height',
                [
                    'label' => esc_html__( 'Height', 'avas-core' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 40,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tx_input_box_typography',
                    'selector' => '{{WRAPPER}} .mc4wp-form input[type*="email"]',
                ]
            );

            $this->add_control(
                'tx_input_box_background',
                [
                    'label'     => esc_html__( 'Background Color', 'avas-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]'         => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]'        => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form select[name*="_mc4wp_lists"]' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'tx_input_box_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'avas-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'tx_input_box_placeholder_color',
                [
                    'label'     => esc_html__( 'Placeholder Color', 'avas-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]::-moz-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]:-ms-input-placeholder'  => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]::-moz-placeholder' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]:-ms-input-placeholder' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .mc4wp-form select[name*="_mc4wp_lists"]'      => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'tx_input_box_border',
                    'label' => esc_html__( 'Border', 'avas-core' ),
                    'selector' => '{{WRAPPER}} .mc4wp-form input[type*="email"]',
                ]
            );

            $this->add_responsive_control(
                'tx_input_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'avas-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'tx_input_box_padding',
                [
                    'label' => esc_html__( 'Padding', 'avas-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'tx_input_box_margin',
                [
                    'label' => esc_html__( 'Margin', 'avas-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form input[type*="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
           
        $this->end_controls_section(); // Input box style tab end

        // Input submit button style tab start
        $this->start_controls_section(
            'tx_mailchimp_inputsubmit_style',
            [
                'label'     => esc_html__( 'Button', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('tx_submit_style_tabs');

                // Button Normal tab start
                $this->start_controls_tab(
                    'tx_submit_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'avas-core' ),
                    ]
                );

                    $this->add_responsive_control(
                        'tx_input_submit_height',
                        [
                            'label' => esc_html__( 'Height', 'avas-core' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 40,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'tx_input_submit_width',
                        [
                            'label' => esc_html__( 'Width', 'avas-core' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'tx_input_submit_position',
                        [
                            'label' => esc_html__( 'Position', 'avas-core' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .tx-mailchimp-style-4 .tx-input-box::before' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'tx_mailchimp_form_style' =>'4',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'tx_input_submit_typography',
                            'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
                        ]
                    );

                    $this->add_control(
                        'tx_input_submit_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'avas-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'tx_input_submit_background_color',
                        [
                            'label'     => esc_html__( 'Background Color', 'avas-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]'  => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'tx_input_submit_padding',
                        [
                            'label' => esc_html__( 'Padding', 'avas-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'tx_input_submit_margin',
                        [
                            'label' => esc_html__( 'Margin', 'avas-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'tx_input_submit_border',
                            'label' => esc_html__( 'Border', 'avas-core' ),
                            'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
                        ]
                    );

                    $this->add_responsive_control(
                        'tx_input_submit_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'avas-core' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'tx_input_submit_box_shadow',
                            'label' => esc_html__( 'Box Shadow', 'avas-core' ),
                            'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
                        ]
                    );

                $this->end_controls_tab(); // Button Normal tab end

                // Button Hover tab start
                $this->start_controls_tab(
                    'tx_submit_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'avas-core' ),
                    ]
                );

                    $this->add_control(
                        'tx_input_submithover_text_color',
                        [
                            'label'     => esc_html__( 'Text Color', 'avas-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover'  => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'tx_input_submithover_background_color',
                        [
                            'label'     => esc_html__( 'Background Color', 'avas-core' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover'  => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'tx_input_submithover_border',
                            'label' => esc_html__( 'Border', 'avas-core' ),
                            'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Input submit button style tab end

    }
}

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        if ( function_exists( '_mc4wp_load_plugin' ) ) {

        $this->add_render_attribute( 'mailchimp_area_attr', 'class', 'tx-mailchimp' );
        $this->add_render_attribute( 'mailchimp_area_attr', 'class', 'tx-mailchimp-style-'.$settings['tx_mailchimp_form_style'] );
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'mailchimp_area_attr' ); ?> >
                <div class="tx-input-box">
                    <?php echo do_shortcode( '[mc4wp_form  id="'.$settings['tx_mailchimp_id'].'"]' ); ?>
                </div>
            </div>
        <?php
        } else { ?>
            <p><?php echo __('Please install/activate <strong>MC4WP: Mailchimp for WordPress</strong> plugin.', 'avas-core'); ?></p>
        <?php }
    }

}
