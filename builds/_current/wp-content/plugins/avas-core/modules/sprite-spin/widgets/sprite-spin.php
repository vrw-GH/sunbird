<?php
namespace AvasElements\Modules\SpriteSpin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SpriteSpin extends Widget_Base {

    public function get_name() {
        return 'avas-sprite-spin';
    }

    public function get_title() {
        return esc_html__( 'Avas SpriteSpin', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-undo';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() {
       return [ 'spritespin', 'spritespin-widget' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__( 'Layout', 'avas-core' ),
            ]
        );

        $this->add_control(
            'source_type',
            [
                'label'       => esc_html__( 'Source Type', 'avas-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'local',
                'label_block' => true,
                'options'     => [
                    'local' => esc_html__( 'Local Images', 'avas-core' ),
                    'remote' => esc_html__( 'Remote Images', 'avas-core' ),
                ],
            ]
        );

        $this->add_control(
            'images',
            [
                'label'   => esc_html__( 'Add Images', 'avas-core' ),
                'type'    => Controls_Manager::GALLERY,
                'dynamic' => [ 'active' => true ],
                'condition' => [
                    'source_type' => 'local'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'exclude'   => [ 'custom' ],
                'default'   => 'full',
                'condition' => [
                    'source_type' => 'local'
                ],
            ]
        );

        $this->add_control(
            'remote_images',
            [
                'type'          => Controls_Manager::URL,
                'label'         => esc_html__( 'Images Source', 'avas-core' ),
                'label_block'   => true,
                'description'   => esc_html__( 'You should named all files with same digit serial numeric number, e.g: image-01.jpg, image-35.jpg', 'avas-core' ),
                'show_external' => false,
                'placeholder'   => esc_html__( 'https://example.com/image-{frame}.jpg', 'avas-core' ),
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'source_type' => 'remote',
                ],
            ]
        );

        $this->add_control(
            'digit_number',
            [
                'label'       => esc_html__( 'File Name Digit Number', 'avas-core' ),
                'description' => esc_html__( 'Please select digit number of your file name. Such as if 001.jpg then you have to select 3', 'avas-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 2,
                'options'     => [
                    1  => '1',
                    2  => '2',
                    3  => '3',
                    4  => '4',
                    5  => '5',
                    6  => '6',
                ],
                'condition'     => [
                    'source_type' => 'remote',
                ],
            ]
        );

        $this->add_control(
            'start_frame',
            [
                'label' => esc_html__('Start Frame', 'avas-core'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'condition'     => [
                    'source_type' => 'remote',
                ],
            ]
        );

        $this->add_control(
            'end_frame',
            [
                'label' => esc_html__('End Frame', 'avas-core'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 8,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 12,
                ],
                'condition'     => [
                    'source_type' => 'remote',
                ],
            ]
        );

        $this->add_control(
            'width',
            [
                'label' => esc_html__('Width', 'avas-core'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 1280,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'size' => 480,
                ],
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => esc_html__('Height', 'avas-core'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'size' => 327,
                ],
            ]
        );

        $this->add_control(
            'full_screen_button',
            [
                'label'     => esc_html__( 'Fullscreen Button', 'avas-core' ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tx-spritespin-icon',
            [
                'label'   => esc_html__( 'Button Icon', 'avas-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
                    'arrows-angle-expand' => [
                        'title' => esc_html__( 'Expand', 'avas-core' ),
                        'icon'  => 'eicon-frame-expand',
                    ],
                    'plus-lg' => [
                        'title' => esc_html__( 'Plus', 'avas-core' ),
                        'icon'  => 'eicon-plus',
                    ],
                    'search' => [
                        'title' => esc_html__( 'Zoom', 'avas-core' ),
                        'icon'  => 'eicon-search',
                    ],
                ],
                'default'   => 'search',
                'condition' => [
                    'full_screen_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'tx-spritespin-icon-position',
            [
                'label'     => esc_html__( 'Icon Position', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => TX_Helper::tx__position(),
                'default'   => 'bottom-left',
                'condition' => [
                    'full_screen_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'tx-spritespin-icon_on_hover',
            [
                'label'        => esc_html__( 'Icon On Hover', 'avas-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'fb-icon-on-hover-',
                'condition'    => [
                    'full_screen_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_additional',
            [
                'label' => esc_html__( 'Additional', 'avas-core' ),
            ]
        );

        $this->add_control(
            'animate',
            [
                'label'       => esc_html__( 'Animate', 'avas-core' ),
                'default'     => 'yes',
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Starts the animation automatically on load', 'avas-core' ),
            ]
        );

        $this->add_control(
            'frame_time',
            [
                'label'       => esc_html__('Frame Time', 'avas-core'),
                'description' => esc_html__( 'Time in ms between updates. e.g. 40 is exactly 25 FPS', 'avas-core' ),
                'type'        => Controls_Manager::NUMBER,
                'condition' => [
                    'animate' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'   => esc_html__( 'Loop', 'avas-core' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'animate' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'stop_frame',
            [
                'label'       => esc_html__('Stop Frame', 'avas-core'),
                'description' => esc_html__( 'Stops the animation on that frame if `loop` is false', 'avas-core' ),
                'type'        => Controls_Manager::NUMBER,
                'condition' => [
                    'loop!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'reverse',
            [
                'label'       => esc_html__( 'Reverse', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Animation playback is reversed', 'avas-core' ),
                'condition' => [
                    'animate' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'retain_animate',
            [
                'label'       => esc_html__( 'Retain Animate', 'avas-core' ),
                'description' => esc_html__( 'Retains the animation after user iser interaction', 'avas-core' ),
                'default'     => 'yes',
                'type'        => Controls_Manager::SWITCHER,
                'separator'   => 'after',
                'condition' => [
                    'animate' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'mouse_option',
            [
                'label'       => esc_html__( 'Mouse Option', 'avas-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'drag',
                'options'     => [
                    ''      => esc_html__('None', 'avas-core'),
                    'drag'  => esc_html__('Drag', 'avas-core'),
                    'move'  => esc_html__('Move', 'avas-core'),
                    'wheel' => esc_html__('Wheel', 'avas-core'),
                ],
            ]
        );

        $this->add_control(
            'sense',
            [
                'label'       => esc_html__('Reverse', 'avas-core'),
                'description' => esc_html__( 'Sensitivity factor for user interaction', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'condition' => [
                    'mouse_option' => ['drag', 'move'],
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'ease',
            [
                'label' => esc_html__( 'Easing', 'avas-core' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'blur',
            [
                'label' => esc_html__( 'Blur', 'avas-core' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label'     => esc_html__( 'Icon Style', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'full_screen_button' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_icon_style' );

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__( 'Normal', 'avas-core' ),
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Size', 'avas-core' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-wig-icon i' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-wig-icon'    => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => esc_html__( 'Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-wig-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border',
                'label'       => esc_html__( 'Border', 'avas-core' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tx-wig-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-wig-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .tx-wig-icon',
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-wig-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__( 'Hover', 'avas-core' ),
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label'     => esc_html__( 'Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-wig-icon:hover'    => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background_hover_color',
            [
                'label'     => esc_html__( 'Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-wig-icon:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-wig-icon:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $image_urls   = [];
        $txwig_plugins = [];

        if ( 'local' == $settings['source_type'] ) {
            foreach ( $settings['images'] as $index => $item ) : ?>
                <?php $image_urls[] = Group_Control_Image_Size::get_attachment_image_src( $item['id'], 'thumbnail', $settings );    ?>
            <?php endforeach;
        } elseif ( 'remote' == $settings['source_type'] ) {
            $image_urls = $settings['remote_images']['url'];
        }

        if ( ! empty( $image_urls ) ) {

            $txwig_plugins[] = '360';
            $txwig_plugins[] = 'progress';

            if ($settings['mouse_option']) {
                $txwig_plugins[] = $settings['mouse_option'];
            }
            if ($settings['ease']) {
                $txwig_plugins[] = 'ease';
            }
            if ($settings['blur']) {
                $txwig_plugins[] = 'blur';
            }

            $this->add_render_attribute(
                [
                    'spritespin' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                "source_type"   => $settings["source_type"],
                                "frame_limit"   => ("remote" == $settings["source_type"]) ? [$settings["start_frame"]["size"], $settings["end_frame"]["size"]] : false,
                                "image_digits"  => ("remote" == $settings["source_type"]) ? $settings["digit_number"] : false,
                                "source"        => $image_urls,
                                "width"         => $settings["width"]["size"],
                                "height"        => $settings["height"]["size"],
                                "animate"       => $settings["animate"] ? true : false,
                                "frameTime"     => $settings["frame_time"],
                                "loop"          => $settings["loop"] ? true : false,
                                "retainAnimate" => $settings["retain_animate"] ? true : false,
                                "reverse"       => $settings["reverse"] ? true : false,
                                "sense"         => ($settings["sense"]) ? -1 : false,
                                "stopFrame"     => $settings["stop_frame"],
                                "responsive"    => true,
                                "plugins"       => $txwig_plugins,
                            ]))
                        ]
                    ]
                ]
            );

            $this->add_render_attribute( 'spritespin', 'class', 'tx-spritespin' );

            if ( $settings['full_screen_button'] ) {
                $this->add_render_attribute( 'tx-spritespin-icon', [
                    'href'     => '#',
                    'class'    => 'tx-spritespin-full-screen tx-wig-icon tx-position-' . $settings['tx-spritespin-icon-position'],
                ]);
            }

            ?>
            <div <?php echo $this->get_render_attribute_string( 'spritespin' ); ?>>

                <div class="tx-spritespin-wrap"></div>

                <?php if ($settings['full_screen_button']) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'tx-spritespin-icon' ); ?>><i class="bi bi-<?php echo $settings['tx-spritespin-icon']; ?>" aria-hidden="true"></i></a>
                <?php endif; ?>

            </div>
            <?php
        } else {
            ?>
           
                <p class="center"><?php printf(esc_html__( 'Please add set of images or set url.', 'avas-core' )); ?></p>
           
            <?php
        }
    }
}
