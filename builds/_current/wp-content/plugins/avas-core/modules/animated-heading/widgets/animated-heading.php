<?php
namespace AvasElements\Modules\AnimatedHeading\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnimatedHeading extends Widget_Base {

    public function get_name() {
        return 'avas-animated-heading';
    }

    public function get_title() {
        return esc_html__( 'Avas Animated Heading', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-animation-text';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_style_depends() {
        return ['animation'];
    }
    public function get_script_depends() {
        return [ 'animated-heading', 'typed', 'morphext' ];
    }
    public function get_keywords() {
        return [ 'animated', 'heading', 'headline', 'vivid', 'title', 'text', 'animation', 'typing' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content', 'avas-core' )
            ]
        );
        $this->add_control(
            'txt_style',
            [
                'label'   => esc_html__( 'Style', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'typed' => esc_html__( 'Typed', 'avas-core' ),
                    'animated'    => esc_html__( 'Animated', 'avas-core' ),
                ],
                'default' => 'typed',
            ]
        );
        $this->add_control(
            'type_speed',
            [
                'label'     => esc_html__( 'Type Speed', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 70,
                'condition' => [
                    'txt_style' => 'typed',
                ],
            ]
        );
        $this->add_control(
            'start_delay',
            [
                'label'     => esc_html__( 'Start Delay', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 500,
                'step'      => 100,
                'condition' => [
                    'txt_style' => 'typed',
                ],
            ]
        );

        $this->add_control(
            'back_speed',
            [
                'label'     => esc_html__( 'Back Speed', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 40,
                'condition' => [
                    'txt_style' => 'typed',
                ],
            ]
        );

        $this->add_control(
            'back_delay',
            [
                'label'     => esc_html__( 'Back Delay', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 500,
                'step'      => 50,
                'condition' => [
                    'txt_style' => 'typed',
                ],
            ]
        );
        $this->add_control(
            'txt_animation',
            [
                'label'   => esc_html__( 'Animation', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'avas-core' ),
                    'fadeIn' => esc_html__( 'Fade In', 'avas-core' ),
                    'fadeInUp' => esc_html__( 'Fade In Up', 'avas-core' ),
                    'fadeInDown' => esc_html__( 'Fade In Down', 'avas-core' ),
                    'fadeInLeft' => esc_html__( 'Fade In Left', 'avas-core' ),
                    'fadeInRight' => esc_html__( 'Fade In Right', 'avas-core' ),
                    'zoomIn'    => esc_html__( 'Zoom In', 'avas-core' ),
                    'zoomInUp'    => esc_html__( 'Zoom In Up', 'avas-core' ),
                    'zoomInDown'    => esc_html__( 'Zoom In Down', 'avas-core' ),
                    'zoomInLeft'    => esc_html__( 'Zoom In Left', 'avas-core' ),
                    'zoomInRight'    => esc_html__( 'Zoom In Right', 'avas-core' ),
                    'bounceIn'    => esc_html__( 'Bounce In', 'avas-core' ),
                    'bounceInUp'    => esc_html__( 'Bounce In Up', 'avas-core' ),
                    'bounceInDown'    => esc_html__( 'Bounce In Down', 'avas-core' ),
                    'bounceInLeft'    => esc_html__( 'Bounce In Left', 'avas-core' ),
                    'bounceInRight'    => esc_html__( 'Bounce In Right', 'avas-core' ),
                    'slideIn'    => esc_html__( 'Slide In', 'avas-core' ),
                    'slideInUp'    => esc_html__( 'Slide In Up', 'avas-core' ),
                    'slideInDown'    => esc_html__( 'Slide In Down', 'avas-core' ),
                    'slideInLeft'    => esc_html__( 'Slide In Left', 'avas-core' ),
                    'slideInRight'    => esc_html__( 'Slide In Right', 'avas-core' ),
                    'rotateIn'    => esc_html__( 'Rotate In', 'avas-core' ),
                    'rotateInUpLeft'    => esc_html__( 'Rotate In Up Left', 'avas-core' ),
                    'rotateInUpRight'    => esc_html__( 'Rotate In Up Right', 'avas-core' ),
                    'rotateInDownLeft'    => esc_html__( 'Rotate In Down Left', 'avas-core' ),
                    'rotateInDownRight'    => esc_html__( 'Rotate In Down Right', 'avas-core' ),
                    'bounce'    => esc_html__( 'Bounce', 'avas-core' ),
                    'flash'    => esc_html__( 'Flash', 'avas-core' ),
                    'pulse'    => esc_html__( 'Pulse', 'avas-core' ),
                    'rubberBand'    => esc_html__( 'Rubber Band', 'avas-core' ),
                    'shake'    => esc_html__( 'Shake', 'avas-core' ),
                    'headShake'    => esc_html__( 'Head Shake', 'avas-core' ),
                    'swing'    => esc_html__( 'Swing', 'avas-core' ),
                    'tada'    => esc_html__( 'Tada', 'avas-core' ),
                    'wobble'    => esc_html__( 'Wobble', 'avas-core' ),
                    'jello'    => esc_html__( 'Jello', 'avas-core' ),
                    'lightSpeedIn'    => esc_html__( 'Light Speed In', 'avas-core' ),
                    'rollIn'    => esc_html__( 'Roll In', 'avas-core' ),
                ],
                'default' => 'fadeIn',
                'condition' => [
                    'txt_style' => 'animated',
                ]
            ]
        );
        $this->add_control(
            'speed',
            [
                'label'     => esc_html__( 'Delay', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 2500,
                'step'      => 100,
                'condition' => [
                   'txt_style' => 'animated',
                ],
            ]
        );
        $this->add_control(
            'before_txt',
            [
                'label' => esc_html__( 'Before Text', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'This is', 'avas-core' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'animated_txt',
            [
                'label' => esc_html__( 'Animated Text', 'avas-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Animated, Typing, Dynamic', 'avas-core' ),
            ]
        );
        $this->add_control(
            'after_txt',
            [
                'label' => esc_html__( 'After Text', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Heading', 'avas-core' ),
            ]
        );
        $this->add_control(
            'html_tag',
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
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'link_url',
            [
                'label'       => esc_html__( 'Link URL', 'avas-core' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'https://your-link.com',
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
                    '{{WRAPPER}} .tx-animated-heading'   => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_help_docs',
                [
                    'label' => esc_html__( 'Help Docs', 'avas-core' ),
                ]
        );
        $this->add_control(
            'help_doc_title',
                [
                    'type'  => Controls_Manager::RAW_HTML,
                    'raw'   => sprintf( '<a href="https://bit.ly/3lopuWG" target="_blank">View Example <i class="fas fa-external-link-alt"></i></a>', 'avas-core' ),
                ]
            );
        $this->end_controls_section();
        
		$this->start_controls_section(
			'tx_styles',
			[
				'label' 	=> esc_html__( 'Default Styles', 'avas-core' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'ah_txt_color',
            [
                'label'     => esc_html__( 'Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_txt_hov_color',
            [
                'label'     => esc_html__( 'Text Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading:hover span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_txt_bg_color',
            [
                'label'     => esc_html__( 'Text Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ah_txt_typo',
                'selector'  => '{{WRAPPER}} .tx-animated-heading',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'ah_txt_shadow',
                'selector' => '{{WRAPPER}} .tx-animated-heading'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ah_border',
                'selector'    =>    '{{WRAPPER}} .tx-animated-heading'
            ]
        );
        $this->add_responsive_control(
            'ah_padding',
            [
                'label'         => esc_html__( 'Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ah_margin',
            [
                'label'         => esc_html__( 'Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tx_before_style',
            [
                'label'     => esc_html__( 'Before Text', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ah_before_txt_color',
            [
                'label'     => esc_html__( 'Before Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading-before-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_before_txt_bg_color',
            [
                'label'     => esc_html__( 'Before Text Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading-before-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ah_before_txt_typo',
                'selector'  => '{{WRAPPER}} .tx-animated-heading-before-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'ah_before_txt_shadow',
                'selector' => '{{WRAPPER}} .tx-animated-heading-before-text'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ah_before_txt_border',
                'selector'    =>    '{{WRAPPER}} .tx-animated-heading-before-text'
            ]
        );
        $this->add_responsive_control(
            'ah_before_txt_padding',
            [
                'label'         => esc_html__( 'Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading-before-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ah_before_txt_margin',
            [
                'label'         => esc_html__( 'Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading-before-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tx_animated_style',
            [
                'label'     => esc_html__( 'Animated Text', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ah_animated_txt_color',
            [
                'label'     => esc_html__( 'Animated Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-txt' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_animated_txt_bg_color',
            [
                'label'     => esc_html__( 'Animated Text Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-txt' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ah_animated_txt_typo',
                'selector'  => '{{WRAPPER}} .tx-animated-txt',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'ah_animated_txt_shadow',
                'selector' => '{{WRAPPER}} .tx-animated-txt'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ah_animated_txt_border',
                'selector'    =>    '{{WRAPPER}} .tx-animated-txt'
            ]
        );
        $this->add_responsive_control(
            'ah_animated_txt_padding',
            [
                'label'         => esc_html__( 'Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ah_animated_txt_margin',
            [
                'label'         => esc_html__( 'Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tx_after_style',
            [
                'label'     => esc_html__( 'After Text', 'avas-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ah_after_txt_color',
            [
                'label'     => esc_html__( 'After Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading-after-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ah_after_txt_bg_color',
            [
                'label'     => esc_html__( 'After Text Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-animated-heading-after-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ah_after_txt_typo',
                'selector'  => '{{WRAPPER}} .tx-animated-heading-after-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'ah_after_txt_shadow',
                'selector' => '{{WRAPPER}} .tx-animated-heading-after-text'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ah_after_txt_border',
                'selector'    =>    '{{WRAPPER}} .tx-animated-txt'
            ]
        );
        $this->add_responsive_control(
            'ah_after_txt_padding',
            [
                'label'         => esc_html__( 'Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading-after-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ah_after_txt_margin',
            [
                'label'         => esc_html__( 'Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-animated-heading-after-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();
        $target = $settings['link_url']['is_external'] ? '_blank' : '_self';
        $id = $this->get_id();
        $animated_txt = explode(",", esc_html($settings['animated_txt']) );

        $this->add_render_attribute( 'animated-txt', 'id', 'tx-ah-' . $id );
        $this->add_render_attribute( 'animated-txt', 'class', 'tx-animated-txt' );

        if($settings['txt_style'] == 'typed') :
            $this->add_render_attribute(
                [
                    'animated-heading' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                'styles'     => $settings['txt_style'],
                                'strings'    => $animated_txt,
                                'typeSpeed'  => $settings['type_speed'],
                                'startDelay' => $settings['start_delay'],
                                'backSpeed'  => $settings['back_speed'],
                                'backDelay'  => $settings['back_delay'],
                                'loop'       => true,
                                'loopCount'  => 'infinity',
                            ]))
                        ]
                    ]
                ]
            );
        elseif($settings['txt_style'] == 'animated') :
            $this->add_render_attribute(
                [
                    'animated-heading' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                'styles'    => $settings['txt_style'],
                                'animation' => $settings['txt_animation'],
                                'speed'     => $settings['speed'],
                            ]))
                        ]
                    ]
                ]
            );
        endif;
        ?>

    <div class="tx-animated-heading-wrap" <?php echo $this->get_render_attribute_string( 'animated-heading' ); ?> >

        <?php if( !empty($settings['link_url']['url']) ) : ?>

            <a class="tx-ah-title-link" href="<?php echo esc_url($settings['link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
            <<?php echo esc_attr($settings['html_tag']); ?> class="tx-animated-heading">
                <span class="tx-animated-heading-before-text"><?php echo esc_html( $settings['before_txt']); ?></span>
                <?php if($settings['txt_style'] == 'animated') : ?>
                <span <?php echo $this->get_render_attribute_string( 'animated-txt' ); ?>><?php echo esc_html($settings['animated_txt']); ?></span>
                <?php elseif($settings['txt_style'] == 'typed') : ?>
                <span <?php echo $this->get_render_attribute_string( 'animated-txt' ); ?>></span>
                <?php endif; ?>
                <span class="tx-animated-heading-after-text"><?php echo esc_html( $settings['after_txt'] ); ?></span>
            </<?php echo esc_attr($settings['html_tag']); ?>>
            </a>

            <?php else: ?>

            <<?php echo esc_attr($settings['html_tag']); ?> class="tx-animated-heading">
                <span class="tx-animated-heading-before-text"><?php echo esc_html( $settings['before_txt']); ?></span>
                <?php if($settings['txt_style'] == 'animated') : ?>
                <span <?php echo $this->get_render_attribute_string( 'animated-txt' ); ?>><?php echo esc_html($settings['animated_txt']); ?></span>
                <?php elseif($settings['txt_style'] == 'typed') : ?>
                <span <?php echo $this->get_render_attribute_string( 'animated-txt' ); ?>></span>
                <?php endif; ?>
                <span class="tx-animated-heading-after-text"><?php echo esc_html( $settings['after_txt'] ); ?></span>
            </<?php echo esc_attr($settings['html_tag']); ?>>

        <?php endif; ?>

    </div>



<?php
	} //render()
} // class
