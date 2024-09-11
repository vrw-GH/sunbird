<?php
namespace AvasElements\Modules\FlipBox\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FlipBox extends Widget_Base {

    public function get_name() {
        return 'avas-flip-box';
    }

    public function get_title() {
        return esc_html__( 'Avas Flip Box', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-flip-box';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'fb_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
          'fb_flip_style',
            [
            'label'         => esc_html__( 'Flip Style', 'avas-core' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'flip-up',
                'label_block'   => false,
                'options'       => [
                    'flip-left'         => esc_html__( 'Left', 'avas-core' ),
                    'flip-right'        => esc_html__( 'Right', 'avas-core' ),
                    'flip-up'           => esc_html__( 'Up', 'avas-core' ),
                    'flip-down'         => esc_html__( 'Down', 'avas-core' ),
                    'flip-zoom-in'      => esc_html__( 'Zoom In', 'avas-core' ),
                    'flip-zoom-out'     => esc_html__( 'Zoom Out', 'avas-core' ),
                ],
                
            ]
        );
        $this->add_control(
            'fb_animation_speed',
            [
                'label'     => esc_html__( 'Animatin Speed(ms)', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 700,
                'step'      => 50,
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-container' => 'transition-duration: {{value}}ms;',
                ],
                
            ]
        );
        $this->add_control(
            'ib_select',
            [
                'label' => esc_html__( 'Select Icon or Image', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'avas-core' ),
                        'icon' => 'fa fa-snowflake-o',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'avas-core' ),
                        'icon' => 'fa fa-picture-o',
                    ]
                ],
                'default' => 'icon',
            ]
        );
        $this->add_control(
            'ib_icon',
            [
                'label' => esc_html__( 'Icon', 'avas-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-snowflake',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'ib_select' => 'icon'
                ]
            ]
        );
        $this->add_control(
            'ib_image',
            [
                'label' => esc_html__( 'Image', 'avas-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ib_select' => 'image'
                ]
            ]
        );   
        $this->add_control(
            'fb_front_back',
            [
                'label' => esc_html__( 'Front / Back', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'front' => [
                        'title' => esc_html__( 'Front Content', 'avas-core' ),
                        'icon' => 'fa fa-reply',
                    ],
                    'back' => [
                        'title' => esc_html__( 'Back Content', 'avas-core' ),
                        'icon' => 'fa fa-share',
                    ],
                ],
                'default' => 'front',
                'separator' => 'before',
            ]
        );
        $this->add_control( 
            'fb_front_title',
            [
                'label' => esc_html__( 'Front Title', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Ut enim ad minim veniam quis', 'avas-core' ),
                'condition' => [
                    'fb_front_back' => 'front'
                ]
            ]
        );
        $this->add_control( 
            'fb_front_desc',
            [
                'label' => esc_html__( 'Front Description', 'avas-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'avas-core' ),
                'condition' => [
                    'fb_front_back' => 'front'
                ]
            ]
        );
        $this->add_control(
            'fb_back_icon',
            [
                'label' => esc_html__( 'Display Icon', 'avas-core' ),
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
                'default' => 'hide',
                'condition' => [
                    'fb_front_back' => 'back'

                ]
            ]
        );
        $this->add_control( 
            'fb_back_title',
            
            [
                'label' => esc_html__( 'Back Title', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Exercitation ullamco laboris', 'avas-core' ),
                'condition' => [
                    'fb_front_back' => 'back'
                ]
            ]
        );
        $this->add_control( 
            'fb_back_title_link',
            [
                'name'  => 'flip_title_link',
                'label' => esc_html__( 'Title Link', 'avas-core' ),
                'type'  => Controls_Manager::URL,
                'placeholder' => 'Example: https://your-site.com',
                'default'     => [
                        'url' => '',
                    ],
                'condition' => [
                    'fb_front_back' => 'back'

                ]    
            ]
        );
        $this->add_control( 
            'fb_back_desc',
            [
                'label' => esc_html__( 'Back Description', 'avas-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => esc_html__( 'Suspendisse potenti Phasellus euismod libero in neque molestie et elementum libero maximus. Etiam in enim vestibulum suscipit sem quis molestie nibh. Donec ac lacus nec diam gravida pellentesque.', 'avas-core' ),
                'condition' => [
                    'fb_front_back' => 'back'
                ]
            ]
        );
        $this->add_control(
            'fb_alignment',
            [
                'label' => esc_html__( 'Alignment', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
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
                'default' => 'center',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-front-wrap, {{WRAPPER}} .tx-flip-box-back-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'fb_styles',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'fb_height',
            [
                'label' => esc_html__( 'Box Height', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-wrapper' => 'height: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_control(
            'fb_front_bg_color',
            [
                'label' => esc_html__( 'Front Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-front-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fb_back_bg_color',
            [
                'label' => esc_html__( 'Back Background Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-back-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name' => 'fb_border',
                    'label' => esc_html__( 'Border', 'avas-core' ),
                    'selectors' => [
                        '{{WRAPPER}} .tx-flip-box-front-wrap, {{WRAPPER}} .tx-flip-box-back-wrap'
                    ],
                ]
        );
        $this->add_control(
            'fb_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-front-wrap, {{WRAPPER}} .tx-flip-box-back-wrap' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fb_shadow',
                'selector' => '{{WRAPPER}} .tx-flip-box-front-wrap, {{WRAPPER}} .tx-flip-box-back-wrap',
            ]
        );
        $this->add_responsive_control(
            'fb_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-flip-box-front-wrap, {{WRAPPER}} .tx-flip-box-back-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       $this->add_responsive_control(
            'fb_icon_size',
            [
                'label'   => esc_html__( 'Icon / Image Size', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'separator' => 'before',
                'default' => [
                    'size' => 32,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 300,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-image i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-flip-box-image img'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'fb_icon_color',
            [
                'label' => esc_html__('Icon Color', 'avas'),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-image i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'fb_icon_bg_color',
            [
                'label' => esc_html__('Icon Background Color', 'avas'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-image' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'fb_icon_border',
                'selector'    =>    '{{WRAPPER}} .tx-flip-box-image'
            ]
        );
        $this->add_responsive_control(
            'fb_icon_border_radius',
            [
                'label'   => esc_html__( 'Icon Border Radius', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-image'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'fb_icon_padding',
            [
                'label' => esc_html__( 'Icon Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-flip-box-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'fb_icon_margin',
            [
                'label' => esc_html__( 'Icon Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                        '{{WRAPPER}} .tx-flip-box-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'fb_front_title_color',
            [
                'label' => esc_html__( 'Front Title Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-front-wrap .tx-flip-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_front_title_typography',
                'selector' => '{{WRAPPER}} .tx-flip-box-front-wrap .tx-flip-box-title',
            ]
        );
        $this->add_control(
            'fb_back_title_color',
            [
                'label' => esc_html__( 'Back Title Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-back-wrap .tx-flip-box-title' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
            'fb_back_title_hov_color',
            [
                'label' => esc_html__( 'Back Title Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-back-wrap .tx-flip-box-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_back_title_typography',
                'selector' => '{{WRAPPER}} .tx-flip-box-back-wrap .tx-flip-box-title',

            ]
        );
        $this->add_control(
            'fb_front_desc_color',
            [
                'label' => esc_html__( 'Front Description Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-front-wrap .tx-flip-box-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_front_desc_typography',
                'selector' => '{{WRAPPER}} .tx-flip-box-front-wrap .tx-flip-box-desc',
            ]
        );
        $this->add_control(
            'fb_back_desc_color',
            [
                'label' => esc_html__( 'Back Description Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-flip-box-back-wrap .tx-flip-box-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fb_back_desc_typography',
                'selector' => '{{WRAPPER}} .tx-flip-box-back-wrap .tx-flip-box-desc',
            ]
        );
        
        $this->end_controls_section();

	}

	protected function render( ) {
        $settings = $this->get_settings();
        $target = $settings['fb_back_title_link']['is_external'] ? '_blank' : '_self';
    ?>
    
    <div class="tx-flip-box-wrapper tx-flip-box-<?php echo esc_attr( $settings['fb_flip_style'] ); ?>">
        <div class="tx-flip-box-container">
            <div class="tx-flip-box-front-wrap">
                <div class="tx-flip-box-content">
                    <div class="tx-flip-box-image">
                        <?php 
                            if ($settings['ib_select'] == 'icon') : 
                                Icons_Manager::render_icon( $settings['ib_icon'], [ 'aria-hidden' => 'true' ] );
                            endif;
                            if ($settings['ib_select'] == 'image') : ?>
                                <img src="<?php echo esc_attr($settings['ib_image']['url']); ?>" alt="<?php echo esc_html( $settings['fb_front_title'] ); ?>">
                        <?php endif; ?>
                    </div><!-- tx-flip-box-image -->
                    <h3 class="tx-flip-box-title"><?php echo esc_html( $settings['fb_front_title'] ); ?></h3>
                    <div class="tx-flip-box-desc"><?php echo wp_kses_post( $settings['fb_front_desc'] ); ?></div>
                </div><!-- tx-flip-box-content -->
            </div><!-- tx-flip-box-front-wrap -->
            
            <div class="tx-flip-box-back-wrap">
                <div class="tx-flip-box-content">
                    <?php if ($settings['fb_back_icon'] == 'show' ) : ?>
                    <div class="tx-flip-box-image">
                        <?php 
                            if ($settings['ib_select'] == 'icon') : 
                                Icons_Manager::render_icon( $settings['ib_icon'], [ 'aria-hidden' => 'true' ] );
                            endif;
                            if ($settings['ib_select'] == 'image') : ?>
                                <img src="<?php echo esc_attr($settings['ib_image']['url']); ?>" alt="<?php echo esc_html( $settings['fb_front_title'] ); ?>">
                        <?php endif; ?>
                    </div><!-- tx-flip-box-image -->
                    <?php endif; ?>
                    <?php if(!empty($settings['fb_back_title_link']['url'])) : ?>    
                        <a class="ex-title" href="<?php echo $settings['fb_back_title_link']['url']; ?>" target="<?php echo esc_attr($target); ?>">
                            <h3 class="tx-flip-box-title"><?php echo esc_html( $settings['fb_back_title'] ); ?></h3>
                        </a>
                    <?php else :  ?>
                        <h3 class="tx-flip-box-title"><?php echo esc_html( $settings['fb_back_title'] ); ?></h3>
                    <?php endif; ?>
                    <div class="tx-flip-box-desc"><?php echo wp_kses_post( $settings['fb_back_desc'] ); ?></div>
                </div><!-- tx-flip-box-content -->
            </div><!-- tx-flip-box-back-wrap -->
        </div><!-- tx-flip-box-container -->
    </div><!-- tx-flip-box-wrapper -->


<?php
	} // render
} // class
