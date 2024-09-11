<?php
namespace AvasElements\Modules\Popup\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;

use AvasElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Popup extends Widget_Base {

    public function get_name() {
        return 'avas-popup';
    }

    public function get_title() {
        return esc_html__( 'Avas Popup', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-lightbox';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_keywords() {
        return [ 'popup', 'modal', 'lightbox', 'window' ];
    }
    public function get_script_depends() {
        return [ 'lity' ];
    }
    protected function register_controls() {
        $this->start_controls_section(
            'sec_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' ),
            ]
        );
        $this->add_control(
            'popup_type',
            [
                'label' => esc_html__( 'Popup Type', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'type_image'  => esc_html__( 'Image', 'avas-core' ),
                    'type_content'  => esc_html__( 'Content', 'avas-core' ),
                    'type_url'  => esc_html__( 'External URL', 'avas-core' ),
                ],
                'default' => 'type_image',
            ]
        );
        $this->add_control(
            'popup_type_image',
            [
                'label' => esc_html__( 'Choose Image', 'avas-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'popup_type' => 'type_image',
                ],
            ]
        );
        $this->add_control(
          'popup_type_content',
          [
             'label'   => esc_html__( 'Add Content', 'avas-core' ),
             'type'    => Controls_Manager::WYSIWYG,
             'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'avas-core' ),
             'condition' => [
                'popup_type' => 'type_content',
             ],
          ]
        );
        $this->add_control(
            'popup_type_url',
            [
                'label' => esc_html__( 'Add website, video, map etc url', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'https://x-theme.net/avas-travel',
                'condition' => [
                    'popup_type' => 'type_url',
                ],
            ]
        );
        $this->add_control(
            'popup_btn_txt',
            [
                'label' => esc_html__( 'Button Text', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'CLICK TO OPEN', 'avas-core' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'popup_btn_icon',
            [
                'label' => esc_html__( 'Button Icon', 'avas-core' ),
                'type' => Controls_Manager::ICONS,
            ]
        );
        $this->add_control(
            'popup_btn_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__( 'Before', 'avas-core' ),
                    'after' => esc_html__( 'After', 'avas-core' ),
                ],
            ]
        );
        $this->add_control(
            'popup_btn_icon_indent',
            [
                'label' => esc_html__( 'Icon Spacing', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-btn-icon-before' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .tx-popup-btn-icon-after' => 'margin-left: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_control(
            'popup_btn_border_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'popup_btn_alignment',
            [
                'label' => esc_html__( 'Button Alignment', 'avas-core' ),
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
                    '{{WRAPPER}} .tx-popup-wrap' => 'text-align: {{VALUE}}',
                ],
                'toggle' => false
            ]
        );
        $this->add_responsive_control(
            'popup_btn_padding',
            [
                'label' => esc_html__( 'Button Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // $this->start_controls_section(
        //     'sec_styles',
        //     [
        //         'label'                 => esc_html__( 'Style', 'avas-core' ),
        //         'tab'                   => Controls_Manager::TAB_STYLE,
        //     ]
        // );
        // $this->add_control(
        //     'popup_container_bg_color',
        //     [
        //         'label' => esc_html__( 'Container Background Color', 'avas-core' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .lity-container' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );
        // $this->add_responsive_control(
        //     'popup_container_padding',
        //     [
        //         'label' => esc_html__( 'Container Padding', 'avas-core' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px' ],
        //         'selectors' => [
        //             '{{WRAPPER}} .lity-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );
        // $this->end_controls_section();

        $this->start_controls_section(
            'popup_btn_styles',
            [
                'label' => esc_html__( 'Button', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs( 'popup_btn_tabs' );

        $this->start_controls_tab( 
            'popup_btn_tab_normal', 
            [ 
                'label' => esc_html__( 'Normal', 'avas-core' ), 
            ] 
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
             'name' => 'popup_btn_typography',
                'selector' => '{{WRAPPER}} .tx-popup-button',
            ]
        );
        $this->add_control(
            'popup_btn_text_color',
            [
                'label' => esc_html__( 'Text Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'popup_btn_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'popup_btn_border',
                'selector' => '{{WRAPPER}} .tx-popup-button',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'popup_btn_tab_hover', 
            [ 
                'label' => esc_html__( 'Hover', 'avas-core' ), 
            ] 
        );
        $this->add_control(
            'popup_btn_text_hov_color',
            [
                'label' => esc_html__( 'Text Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'popup_btn_bg_hov_color',
            [
                'label' => esc_html__( 'Background Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'popup_btn_border_hov_color',
            [
                'label' => esc_html__( 'Border Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-popup-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $id = $this->get_id();

        $this->add_render_attribute( 'popup-content', 'id', 'tx-popup-content-' . $id );
        $this->add_render_attribute( 'popup-content', 'class', 'lity-hide' );
        ?>

        <div class="tx-popup-wrap">
            <?php if($settings['popup_type'] == 'type_image') : ?>
                <a href="<?php echo esc_attr($settings['popup_type_image']['url']); ?>" id="<?php echo esc_attr('tx-popup-image-'.$id); ?>" class="tx-popup-button" data-lity>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='before'  ) : ?>
                            <span class="tx-popup-btn-icon-before"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($settings['popup_btn_txt']); ?>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='after'  ) : ?>
                            <span class="tx-popup-btn-icon-after"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            <?php if($settings['popup_type'] == 'type_content') : ?>
                <a href="#tx-popup-content-<?php echo esc_attr($id); ?>" class="tx-popup-button" data-lity>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='before'  ) : ?>
                            <span class="tx-popup-btn-icon-before"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($settings['popup_btn_txt']); ?>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='after'  ) : ?>
                            <span class="tx-popup-btn-icon-after"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            <?php if($settings['popup_type'] == 'type_url') : ?>
                <a href="<?php echo esc_attr($settings['popup_type_url']); ?>" id="<?php echo esc_attr('tx-popup-url-'.$id); ?>" class="tx-popup-button" data-lity>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='before'  ) : ?>
                            <span class="tx-popup-btn-icon-before"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($settings['popup_btn_txt']); ?>
                    <?php if( $settings['popup_btn_icon'] !='' && $settings['popup_btn_icon_position'] =='after'  ) : ?>
                            <span class="tx-popup-btn-icon-after"><?php Icons_Manager::render_icon( $settings['popup_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            <div <?php echo $this->get_render_attribute_string( 'popup-content' ); ?>>
                <?php echo wp_kses_post( $settings['popup_type_content'] ); ?>
            </div>
        </div><!-- tx-popup-wrap -->
        
        
        
<?php } // render()

} // class
