<?php
namespace AvasElements\Modules\CallToAction\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CallToAction extends Widget_Base {

    public function get_name() {
        return 'avas-call-to-action';
    }

    public function get_title() {
        return esc_html__( 'Avas Call To Action', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'tx_cta_content_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );

        $this->add_control(
          'tx_cta_type',
            [
            'label'         => esc_html__( 'Layout', 'avas-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'cta-icon-flex',
                'label_block'   => false,
                'options'       => [
                    'cta-basic'         => esc_html__( 'Basic', 'avas-core' ),
                    'cta-flex'          => esc_html__( 'Flex Grid', 'avas-core' ),
                    'cta-icon-flex'     => esc_html__( 'Flex Grid with Icon', 'avas-core' ),
                ],
            ]
        );
        $this->add_control(
            'tx_cta_fltx_grid_icon',
            [
                'label' => esc_html__( 'Icon', 'avas-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'tx_selected_icon',
                'skin'             => 'inline',
                'label_block'      => false,
                'condition' => [
                    'tx_cta_type' => 'cta-icon-flex'
                ]
            ]
        );
        $this->add_control(
          'tx_cta_content_type',
            [
            'label'         => esc_html__( 'Position', 'avas-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'cta-default',
                'label_block'   => false,
                'options'       => [
                    'cta-default'   => esc_html__( 'Left', 'avas-core' ),
                    'cta-center'        => esc_html__( 'Center', 'avas-core' ),
                    'cta-right'         => esc_html__( 'Right', 'avas-core' ),
                ],
                'condition'    => [
                    'tx_cta_type' => 'cta-basic'
                ]
            ]
        );

        $this->add_control(
          'tx_cta_color_type',
            [
            'label'         => esc_html__( 'Background Style', 'avas-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'cta-bg-color',
                'label_block'   => false,
                'options'       => [
                    'cta-bg-color'          => esc_html__( 'Background Color', 'avas-core' ),
                    'cta-bg-img'            => esc_html__( 'Background Image', 'avas-core' ),
                    'cta-bg-img-fixed'  => esc_html__( 'Background Fixed Image', 'avas-core' ),
                ],
            ]
        );

        
        $this->add_control(
            'tx_cta_bg_image',
            [
                'label' => esc_html__( 'Background Image', 'avas-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                '{{WRAPPER}} .tx-call-to-action.bg-img' => 'background-image: url({{URL}});',
                '{{WRAPPER}} .tx-call-to-action.bg-img-fixed' => 'background-image: url({{URL}});',
                ],
                'condition' => [
                    'tx_cta_color_type' => [ 'cta-bg-img', 'cta-bg-img-fixed' ],
                ]
            ]
        );
        $this->add_control( 
            'tx_cta_title',
            [
                'label' => esc_html__( 'Title', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'CALL TO ACTION', 'avas-core' )
            ]
        );
        $this->add_control( 
            'tx_cta_content',
            [
                'label' => esc_html__( 'Description', 'avas-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => esc_html__( 'Suspendisse potenti Phasellus euismod libero in neque molestie et mentum libero maximus.', 'avas-core' ),
                'separator' => 'after'
            ]
        );

        $this->add_control( 
            'tx_cta_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'View More', 'avas-core' )
            ]
        );

        $this->add_control( 
            'tx_cta_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'avas-core' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_section_cta_style_settings',
            [
                'label' => esc_html__( 'Call to Action Style', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'tx_cta_container_width',
            [
                'label' => esc_html__( 'Set max width for the container?', 'avas-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'yes', 'avas-core' ),
                'label_off' => esc_html__( 'no', 'avas-core' ),
                'default' => 'no',
            ]
        );

        $this->add_responsive_control(
            'tx_cta_container_width_value',
            [
                'label' => esc_html__( 'Container Max Width (% or px)', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1140,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-call-to-action' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tx_cta_container_width' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'tx_cta_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FED135',
                'selectors' => [
                    '{{WRAPPER}} .tx-call-to-action' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tx_cta_container_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tx_cta_container_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tx_cta_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-call-to-action',
            ]
        );

        $this->add_control(
            'tx_cta_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-call-to-action' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tx_cta_shadow',
                'selector' => '{{WRAPPER}} .tx-call-to-action',
            ]
        );
        $this->add_responsive_control(
            'tx_cta_content_padding',
            [
                'label' => esc_html__( 'Content Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_section_cta_title_style_settings',
            [
                'label' => esc_html__( 'Color &amp; Typography ', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'tx_cta_title_heading',
            [
                'label' => esc_html__( 'Title Style', 'avas-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_control(
            'tx_cta_title_color',
            [
                'label' => esc_html__( 'Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .tx-call-to-action .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'tx_cta_title_typography',
                'selector' => '{{WRAPPER}} .tx-call-to-action .title',
            ]
        );

        $this->add_control(
            'tx_cta_content_heading',
            [
                'label' => esc_html__( 'Content Style', 'avas-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'tx_cta_content_color',
            [
                'label' => esc_html__( 'Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#222',
                'selectors' => [
                    '{{WRAPPER}} .tx-call-to-action p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'tx_cta_content_typography',
                'selector' => '{{WRAPPER}} .tx-call-to-action p',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_section_cta_btn_style_settings',
            [
                'label' => esc_html__( 'Button Style', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
          'tx_cta_btn_effect_type',
            [
            'label'         => esc_html__( 'Effect', 'avas-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'default',
                'label_block'   => false,
                'options'       => [
                    'default'           => esc_html__( 'Default', 'avas-core' ),
                    'top-to-bottom'     => esc_html__( 'Top to Bottom', 'avas-core' ),
                    'left-to-right'     => esc_html__( 'Left to Right', 'avas-core' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'tx_cta_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .cta-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tx_cta_btn_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .cta-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'tx_cta_btn_typography',
                'selector' => '{{WRAPPER}} .tx-call-to-action .cta-button',
            ]
        );

        $this->start_controls_tabs( 'tx_cta_button_tabs' );

            $this->start_controls_tab( 'tx_cta_btn_normal', [ 'label' => esc_html__( 'Normal', 'avas-core' ) ] );

            $this->add_control(
                'tx_cta_btn_normal_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#222',
                    'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .cta-button' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'tx_cta_btn_normal_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .cta-button' => 'background: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'tx_cat_btn_normal_border',
                    'label' => esc_html__( 'Border', 'avas-core' ),
                    'selector' => '{{WRAPPER}} .tx-call-to-action .cta-button',
                ]
            );

            $this->add_control(
                'tx_cta_btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'avas-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .cta-button' => 'border-radius: {{SIZE}}px;',
                    ],
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'tx_cta_btn_hover', [ 'label' => esc_html__( 'Hover', 'avas-core' ) ] );

            $this->add_control(
                'tx_cta_btn_hover_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .cta-button:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'tx_cta_btn_hover_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#23a455',
                    'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .cta-button:after' => 'background: {{VALUE}};',
                        '{{WRAPPER}} .tx-call-to-action .cta-button:hover' => 'background: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'tx_cta_btn_hover_border_color',
                [
                    'label' => esc_html__( 'Border Color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .tx-call-to-action .cta-button:hover' => 'border-color: {{VALUE}};',
                    ],
                ]

            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tx_cta_button_shadow',
                'selector' => '{{WRAPPER}} .tx-call-to-action .cta-button',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_section_cta_icon_style_settings',
            [
                'label' => esc_html__( 'Icon Style', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tx_cta_type' => 'cta-icon-flex'
                ]
            ]
        );

        $this->add_control(
            'tx_section_cta_icon_size',
            [
                'label' => esc_html__( 'Font Size', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 75
                ],
                'range' => [
                    'px' => [
                        'max' => 160,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-call-to-action.cta-icon-flex .icon' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .tx-call-to-action.cta-icon-flex .icon svg' => 'width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'tx_section_cta_icon_color',
            [
                'label' => esc_html__( 'Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#23a455',
                'selectors' => [
                    '{{WRAPPER}} .tx-call-to-action.cta-icon-flex .icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-call-to-action.cta-icon-flex .icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render( ) {
        
        $settings = $this->get_settings_for_display(); 
        $target = $settings['tx_cta_btn_link']['is_external'] ? 'target="_blank"' : 'target="_self"';
        $nofollow = $settings['tx_cta_btn_link']['nofollow'] ? 'rel="nofollow"' : '';
        if( 'cta-bg-color' == $settings['tx_cta_color_type'] ) {
            $cta_class = 'bg-lite';
        }else if( 'cta-bg-img' == $settings['tx_cta_color_type'] ) {
            $cta_class = 'bg-img';
        }else if( 'cta-bg-img-fixed' == $settings['tx_cta_color_type'] ) {
            $cta_class = 'bg-img bg-fixed';
        }else {
            $cta_class = '';
        }
     
        if( 'cta-center' === $settings['tx_cta_content_type'] ) {
            $cta_alignment = 'cta-center';
        }elseif( 'cta-right' === $settings['tx_cta_content_type'] ) {
            $cta_alignment = 'cta-right';
        }else {
            $cta_alignment = 'cta-left';
        }
        
        if( 'left-to-right' == $settings['tx_cta_btn_effect_type'] ) {
            $cta_btn_effect = 'effect-2';
        }elseif( 'top-to-bottom' == $settings['tx_cta_btn_effect_type'] ) {
            $cta_btn_effect = 'effect-1';
        }else {
            $cta_btn_effect = '';
        }

        if ( ! isset( $settings['tx_selected_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // add old default
            $settings['tx_selected_icon'] = 'fas fa-bullhorn';
        }
        $migrated  = isset( $settings['__fa4_migrated']['tx_cta_fltx_grid_icon'] );
        $is_new    = empty( $settings['tx_selected_icon'] ) && Icons_Manager::is_migration_allowed();
    
    ?>
    <?php if( 'cta-basic' == $settings['tx_cta_type'] ) : ?>
    <div class="tx-call-to-action <?php echo esc_attr( $cta_class ); ?> <?php echo esc_attr( $cta_alignment ); ?>">
        <h2 class="title"><?php echo esc_html( $settings['tx_cta_title'] ); ?></h2>
        <p><?php echo wp_kses_post( $settings['tx_cta_content'] ); ?></p>
        <?php if($settings['tx_cta_btn_text'] != '') : ?>
        <a href="<?php echo esc_url( $settings['tx_cta_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="cta-button <?php echo esc_attr( $cta_btn_effect ); ?>"><?php echo esc_html( $settings['tx_cta_btn_text'] ); ?></a>
        <?php endif; ?>
    </div>      
    <?php endif; ?>
    <?php if( 'cta-flex' == $settings['tx_cta_type'] ) : ?>
    <div class="tx-call-to-action cta-flex <?php echo esc_attr( $cta_class ); ?>">
        <div class="content">
            <h2 class="title"><?php echo $settings['tx_cta_title']; ?></h2>
            <p><?php echo wp_kses_post($settings['tx_cta_content']); ?></p>
        </div>
        <?php if($settings['tx_cta_btn_text'] != '') : ?>
        <div class="action">
            <a href="<?php echo esc_url( $settings['tx_cta_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="cta-button <?php echo esc_attr( $cta_btn_effect ); ?>"><?php echo esc_html( $settings['tx_cta_btn_text'] ); ?></a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php if( 'cta-icon-flex' == $settings['tx_cta_type'] ) : ?>
    <div class="tx-call-to-action cta-icon-flex <?php echo esc_attr( $cta_class ); ?>">
        <div class="icon">
           
            <?php if ( ! empty( $settings['tx_cta_fltx_grid_icon']['value'] ) ) :
                if ( $is_new || $migrated ) :
                    Icons_Manager::render_icon( $settings['tx_cta_fltx_grid_icon'], [ 'aria-hidden' => 'true'] );
                else :
             ?>
                <i class="<?php echo esc_attr($settings['tx_selected_icon']); ?>" aria-hidden="true"></i>
            <?php endif; ?>
            <?php endif; ?>
            
        </div>
        <div class="content">
            <h2 class="title"><?php echo $settings['tx_cta_title']; ?></h2>
            <p><?php echo wp_kses_post($settings['tx_cta_content']); ?></p>
        </div>
        <?php if($settings['tx_cta_btn_text'] != '') : ?>
        <div class="action">
           <a href="<?php echo esc_url( $settings['tx_cta_btn_link']['url'] ); ?>" <?php echo $target; ?> class="cta-button <?php echo esc_attr( $cta_btn_effect ); ?>"><?php esc_html_e( $settings['tx_cta_btn_text'], 'avas-core' ); ?></a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php
    }
}
