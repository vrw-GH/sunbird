<?php
namespace AvasElements\Modules\Lottie\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Lottie extends Widget_Base {

    public function get_name() {
        return 'avas-lottie';
    }

    public function get_title() {
        return esc_html__( 'Avas Lottie', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-lottie';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() {
        return [ 'tx-lottie','lottie' ];
    }

	protected function register_controls() {


		$this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'avas-core' ),
            ]
        );

        $this->add_control(
            'source',
            [
                'label'   => esc_html__( 'Source', 'avas-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'json_file' => [
                        'title' => esc_html__( 'JSON file', 'avas-core' ),
                        'icon'  => 'eicon-document-file',
                    ],
                    'external_url' => [
                        'title' => esc_html__( 'External URL', 'avas-core' ),
                        'icon'  => 'eicon-link',
                    ],
                ],
                'default' => 'json_file',
                'toggle'  => false,
            ]
        );

        $this->add_control(
            'json_file',
            [
                'show_label'    => false,
                'description'   => sprintf(
                        esc_html__('Get %sLottie animations%s', 'avas-core'),
                        '<a href="https://lottiefiles.com/featured" target="_blank">',
                        '</a>'
                ),
                'type'       => Controls_Manager::MEDIA,
                'media_type' => 'application/json',
                'condition'  => [
                    'source' => 'json_file',
                ],
            ]
        );

        $this->add_control(
            'external_url',
            [
                'show_label'    => false,
                'description'   => sprintf(
                        esc_html__('Get %sLottie animations%s', 'avas-core'),
                        '<a href="https://lottiefiles.com/featured" target="_blank">',
                        '</a>'
                ),
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your URL', 'avas-core' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active'     => true,
                ],
                'condition'   => [
                    'source' => 'external_url',
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => esc_html__( 'Link', 'avas-core' ),
                'type'      => Controls_Manager::URL,
                'dynamic'   => [ 'active' => true ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'ltt_alignment',
            [
                'label' => esc_html__( 'Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .tx-lottie-wrap' => 'text-align: {{value}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' ),
            ]
        );

        $this->add_control(
            'renderer',
            [
                'label'   => esc_html__( 'Renderer', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'svg',
                'options' => [
                    'svg'    => 'SVG',
                    'canvas' => 'Canvas',
                ],
            ]
        );

        $this->add_control(
            'action_start',
            [
                'label'   => esc_html__( 'Play Action', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'autoplay',
                'options' => [
                    'autoplay'    => esc_html__( 'Autoplay', 'avas-core' ),
                    'on_hover'    => esc_html__( 'On Hover', 'avas-core' ),
                    'on_click'    => esc_html__( 'On Click', 'avas-core' ),
                    'on_scroll'   => esc_html__( 'Scroll', 'avas-core' ),
                    'on_viewport' => esc_html__( 'Viewport', 'avas-core' ),
                ],
            ]
        );

        $this->add_control(
            'delay',
            [
                'label'     => esc_html__( 'Autoplay Delay (ms)', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'step'      => 1,
                'condition' => [
                    'action_start' => 'autoplay',
                ],
            ]
        );

        $this->add_control(
            'on_hover_out',
            [
                'label'   => esc_html__( 'On Hover Out', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'No Action', 'avas-core' ),
                    'pause'   => esc_html__( 'Pause', 'avas-core' ),
                    'stop'    => esc_html__( 'Stop', 'avas-core' ),
                    'reverse' => esc_html__( 'Reverse', 'avas-core' ),
                ],
                'condition' => [
                    'action_start' => 'on_hover',
                ],
            ]
        );

        $this->add_control(
            'redirect_timeout',
            [
                'label'     => esc_html__( 'Redirect Timeout (ms)', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'step'      => 1,
                'condition' => [
                    'action_start' => 'on_click',
                    'link[url]!'   => '',
                ],
            ]
        );

        $this->add_control(
            'viewport',
            array(
                'label'   => esc_html__( 'Viewport', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'scales'  => 1,
                'handles' => 'range',
                'default' => [
                    'sizes' => [
                        'start' => 0,
                        'end'   => 100,
                    ],
                    'unit'  => '%',
                ],
                'labels'  => [
                    esc_html__( 'Bottom', 'avas-core' ),
                    esc_html__( 'Top', 'avas-core' ),
                ],
                'condition' => [
                    'action_start' => [ 'on_viewport', 'on_scroll' ],
                ],
            )
        );

        $this->add_control(
            'loop',
            [
                'label'     => esc_html__( 'Loop', 'avas-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'action_start!' => 'on_scroll',
                ],
            ]
        );

        $this->add_control(
            'reversed',
            [
                'label'     => esc_html__( 'Reversed', 'avas-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => '',
                'condition' => [
                    'action_start!' => 'on_scroll',
                ],
            ]
        );

        $this->add_control(
            'play_speed',
            [
                'label'       => esc_html__( 'Play Speed', 'avas-core' ),
                'description' => esc_html__( '1 is normal speed', 'avas-core' ),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 0,
                'step'        => 0.1,
                'default'     => 1,
                'condition'   => [
                    'action_start!' => 'on_scroll',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'lottie_width',
            [
                'label'      => esc_html__( 'Width', 'avas-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-lottie-elem' => 'width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'lottie_max_width',
            [
                'label'      => esc_html__( 'Max Width', 'avas-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-lottie-elem' => 'max-width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lottie_style',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'tabs_lottie' );

        $this->start_controls_tab(
            'tab_lottie_normal',
            [
                'label' => esc_html__( 'Normal', 'avas-core' ),
            ]
        );

        $this->add_control(
            'opacity',
            [
                'label' => esc_html__( 'Opacity', 'avas-core' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-lottie-elem' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters',
                'selector' => '{{WRAPPER}} .tx-lottie-elem',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_lottie_hover',
            [
                'label' => esc_html__( 'Hover', 'avas-core' ),
            ]
        );

        $this->add_control(
            'opacity_hover',
            [
                'label' => esc_html__( 'Opacity', 'avas-core' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-lottie-elem:hover' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters_hover',
                'selector' => '{{WRAPPER}} .tx-lottie-elem:hover',
            ]
        );

        $this->add_control(
            'hover_transition',
            [
                'label' => esc_html__( 'Transition Duration', 'avas-core' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-lottie-elem' => 'transition-duration: {{SIZE}}s;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'lottie_border',
                'selector'  => '{{WRAPPER}} .tx-lottie-elem',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'lottie_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-lottie-elem' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'    => 'lottie_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .tx-lottie-elem',
            )
        );

        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
        $source   = ! empty( $settings['source'] ) ? $settings['source'] : 'json_file';

        switch ( $source ) {
            case 'json_file';
                $path = esc_url( $settings['json_file']['url'] );
                break;

            case 'external_url';
                $path = esc_url( $settings['external_url'] );
                break;

            default:
                $path = '';
        };

        if ( empty( $path ) ) {
            $path = TX_PLUGIN_URL . '/assets/animation/lottie.json';
        }

        $viewport = !empty($settings['viewport']['sizes']) ? $settings['viewport']['sizes'] : null;

        $this->add_render_attribute( 'tx-lottie', 'class', 'tx-lottie-wrap' );
        $this->add_render_attribute(
            [
                'tx-lottie' => [
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            'path'             => $path,
                            'renderer'         => $settings['renderer'],
                            'action_start'     => $settings['action_start'],
                            'delay'            => $settings['delay'],
                            'on_hover_out'     => $settings['on_hover_out'],
                            'redirect_timeout' => $settings['redirect_timeout'],
                            'viewport'         => $viewport,
                            'loop'             => filter_var( $settings['loop'], FILTER_VALIDATE_BOOLEAN ),
                            'reversed'         => filter_var( $settings['reversed'], FILTER_VALIDATE_BOOLEAN ),
                            'play_speed'       => $settings['play_speed'],
                        ]))
                    ]
                ]
            ]
        );

        if ( ! empty( $settings['link']['url'] ) ) : 
            $this->add_link_attributes( 'link', $settings['link'] );
        ?>

        <a class="tx-lottie-link" <?php echo $this->get_render_attribute_string( 'link' ); ?>>
            <div <?php echo $this->get_render_attribute_string( 'tx-lottie' ); ?> >
                <div class="tx-lottie-elem"></div>
            </div>
        </a>

        <?php endif; ?>

        <div <?php echo $this->get_render_attribute_string( 'tx-lottie' ); ?> >
            <div class="tx-lottie-elem"></div>
        </div>


<?php        

    } // render()
} // class 
