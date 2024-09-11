<?php
namespace AvasElements\Modules\BackgroundClipText\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BackgroundClipText extends Widget_Base {

    public function get_name() {
        return 'avas-background-clip-text';
    }

    public function get_title() {
        return esc_html__( 'Avas Background Clip Text', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-t-letter-bold';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'bct_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
            'bct_text',
            [
                'label' => esc_html__( 'Text', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Background Clip Text', 'avas-core' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bct_img',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'selector' => '{{WRAPPER}} .tx-bct-wrap',
            ]
        );
        $this->add_control(
            'tx_animation_duration',
            [
                'label' => esc_html__( 'Speed', 'avas-core' ),
                'description' => esc_html__( 'Set 0 to stop animation', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 0,
                'selectors' => [
                '{{WRAPPER}} .tx-bct-wrap' => 'animation-duration: {{VALUE}}s;',
                ],
            ]
        );
        $this->add_control(
            'tx_animation_direction',
            [
                'label'                 => esc_html__( 'Direction', 'avas-core' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'normal',
                'options'               => [
                   'normal'           => esc_html__( 'Normal', 'avas-core' ),
                   'reverse'       => esc_html__( 'Reverse', 'avas-core' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-bct-wrap' => 'animation-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bct_html_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h2',
                'options'   => [
                        'h1'    => 'H1',
                        'h2'    => 'H2',
                        'h3'    => 'H3',
                        'h4'    => 'H4',
                        'h5'    => 'H5',
                        'h6'    => 'H6',
                        'div'   => 'div',
                        'span'  => 'Span',
                        'p'     => 'P'
                    ],
            ]
        );
        $this->add_control(
            'hd_link',
            [
                'label'        => esc_html__( 'Link', 'avas-core' ),
                'type'         => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'bct_link_url',
            [
                'label'       => esc_html__( 'Link URL', 'avas-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
                'condition' => [
                    'hd_link' => 'yes'
                ]
                
            ]
        );
        $this->add_responsive_control(
            'alignment',
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
                'toggle' => false,
                'selectors'         => [
                    '{{WRAPPER}} .tx-bct-wrap'   => 'text-align: {{VALUE}};',
                ],
                

            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'tx_bct_style',
			[
				'label' 	=> esc_html__( 'Style', 'avas-core' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'tx_bct_typo',
                'label'     => esc_html__( 'Typography', 'avas-core' ),
                'selector'  => '{{WRAPPER}} .tx-bct-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'tx_bct_text_shadow',
                'label'     => esc_html__( 'Text Shadow', 'avas-core' ),
                'selector'  => '{{WRAPPER}} .tx-bct-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'tx_bct_border',
                'selector'    =>    '{{WRAPPER}} .tx-bct-text'
            ]
        );
        $this->add_responsive_control(
            'hd_main_first_padding',
            [
                'label'         => esc_html__( 'Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-bct-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'hd_main_first_margin',
            [
                'label'         => esc_html__( 'Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-bct-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        
        $this->end_controls_section();

	}

	protected function render( ) {
		$settings = $this->get_settings();
        $target = $settings['bct_link_url']['is_external'] ? '_blank' : '_self';
        ?>

        <div class="tx-bct-wrap">

            <?php if($settings['hd_link'] == 'yes') : ?>

            <a class="tx-bct-text-link" href="<?php echo esc_url($settings['bct_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
            <<?php echo esc_attr($settings['bct_html_tag']); ?> class="tx-bct-text">
                <?php echo esc_attr( $settings['bct_text']); ?>
            </<?php echo esc_attr($settings['bct_html_tag']); ?>>
            </a>

            <?php else: ?>
            <<?php echo esc_attr($settings['bct_html_tag']); ?> class="tx-bct-text">
                <?php echo esc_attr( $settings['bct_text'] ); ?>
            </<?php echo esc_attr($settings['bct_html_tag']); ?>>
            <?php endif; ?>
       
        </div><!-- tx-bct-wrap -->

<?php

	}
}
