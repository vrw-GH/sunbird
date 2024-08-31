<?php
namespace AvasElements\Modules\ImageSlide\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageSlide extends Widget_Base {

	public function get_name() {
		return 'avas-image-slide';
	}

	public function get_title() {
		return esc_html__( 'Avas Image Slide', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-carousel';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'image', 'scrolling', 'scroll', 'gallery', 'slide', 'infinite', 'scroller', 'carousel' ];
	}
    public function get_script_depends() {
        return [ 'infiniteslidev2','image-slide' ];
    }
	protected function register_controls() {
		$this->start_controls_section(
			'is_settings',
			[
				'label' => esc_html__( 'Settings', 'avas-core' ),
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
            'is_image',
            [
                'library' => 'image',
                'label_block' => true,
                'label' => esc_html__('Image.', 'avas-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => TX_PLUGIN_URL . '/assets/img/image-slide.jpg',
                ],
            ]

        );
        $repeater->add_control(
            'is_title', 
            [
                'label' => esc_html__('Caption', 'avas-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
            ]
        );
        $repeater->add_control(
            'is_title_link',
            [
                'label' => esc_html__('Link URL', 'avas-core'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-site.com',
            ]
        );

        $this->add_control(
            'is_images',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                    [
                        'is_title' => '',
                    ],
                ],

                'title_field' => '{{{is_title}}}',
            ]
        );
		$this->add_responsive_control(
            'is_img_width',
            [
                'label'   => esc_html__( 'Image Width', 'avas-core' ),
                'description'   => esc_html__( 'If you do not have same width for all images then adjust width and set the height empty.', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 2000,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-image-slide-container img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'is_img_height',
            [
                'label'   => esc_html__( 'Image Height', 'avas-core' ),
                'description'   => esc_html__( 'If you do not have same height for all images then adjust height and set the width empty.', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                   'size' => 220,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 1200,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-image-slide-container img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'is_img_margin',
            [
                'label'         => esc_html__( 'Image Margin', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-image-slide-container img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'direction',
            [
                'label' => esc_html__( 'Direction', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__( 'Left', 'avas-core' ),
                    'right' => esc_html__( 'Right',   'avas-core' ),
                    'up' => esc_html__( 'Up',   'avas-core' ),
                    'down' => esc_html__( 'Down',   'avas-core' ),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Speed', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 100,
                'step'    => 50,
            ]
        );
        $this->add_control(
            'clone',
            [
                'label' => esc_html__('Clone', 'avas-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );
        $this->add_control(
            'pauseonhover',
            [
                'label' => esc_html__( 'Pause on hover', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'yes',
                'toggle' => false,
             ]
        );
    

		$this->end_controls_section();

		$this->start_controls_section(
            'is_styles',
            [
                'label'                 => esc_html__( 'Style', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->start_controls_tabs( 'btn_tabs' );

  		$this->start_controls_tab(
  			'btn_tab_normal',
  			[
  				'label' => esc_html__( 'Normal', 'avas-core' ),
  			]
  		);
      $this->add_control(
            'is_img_overlay',
            [
                'label'     => esc_html__( 'Overlay Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-image-slide-overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'is_border',
                'selector'    =>    '{{WRAPPER}} .tx-image-slide-container'
            ]
        );
        $this->add_responsive_control(
            'is_border_radius',
            [
                'label'   => esc_html__( 'Border Radius', 'avas-core' ),
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
                    '{{WRAPPER}} .tx-image-slide-container, {{WRAPPER}} .tx-image-slide-container img'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'is_box_shadow',
                'selector' => '{{WRAPPER}} .tx-image-slide-container',
                'separator' => '',
            ]
        );
        $this->add_control(
            'caption_bg_color',
            [
                'label'     => esc_html__( 'Caption Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-image-slide-title' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'caption_color',
            [
                'label'     => esc_html__( 'Caption Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-image-slide-title' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        
        $this->add_control(
            'caption_color_hover',
            [
                'label'     => esc_html__( 'Caption Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-image-slide-container:hover .tx-image-slide-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
    			Group_Control_Typography::get_type(),
    			[
                 'name' => 'caption_typography',
    				'selector' => '{{WRAPPER}} .tx-image-slide-title',
    			]
    		);
        $this->add_responsive_control(
            'caption_padding',
            [
                'label'         => esc_html__( 'Caption Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-image-slide-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    		$this->end_controls_tab();

            $this->start_controls_tab(
    			'btn_tab_hover',
    			[
    				'label' => esc_html__( 'Hover', 'avas-core' ),
    			]
    		);
    		$this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'        => 'is_hov_border',
                    'selector'    =>    '{{WRAPPER}} .tx-image-slide-container:hover'
                ]
            );
    		$this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'is_hov_box_shadow',
                    'selector' => '{{WRAPPER}} .tx-image-slide-container:hover',
                    'separator' => '',
                ]
            );
		    $this->end_controls_tab();
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'tx-image-slide', 'class', 'tx-image-slide-wrap' );
            $this->add_render_attribute(
                [
                    'tx-image-slide' => [
                        'data-settings' => [
                            wp_json_encode(array_filter([
                                'direction' => ($settings['direction']),
                                'speed' => absint($settings['speed']),
                                'clone' => absint($settings['clone']),
                                'pauseonhover' => ( "yes" == $settings["pauseonhover"] ),
                            ]))
                        ]
                    ]
                ]
            );

		?>

		<div <?php echo $this->get_render_attribute_string( 'tx-image-slide' ); ?>>
            <?php foreach ($settings['is_images'] as $slide): 
                $target = $slide['is_title_link']['is_external'] ? '_blank' : '_self';
            ?>

			<div class="tx-image-slide-container">
                        <?php if (!empty($slide['is_title_link']['url'])) : ?>
                              <a href="<?php echo esc_url( $slide['is_title_link']['url'] ); ?>" target="<?php echo esc_attr($target); ?>">
                                <img src="<?php echo esc_attr($slide['is_image']['url']); ?>" alt="<?php echo esc_html($slide['is_title']); ?>">
                                <span class="tx-image-slide-overlay"></span>
                                <h3 class="tx-image-slide-title"><?php echo esc_html($slide['is_title']); ?></h3>
                              </a>
                        <?php else : ?>
                              <img src="<?php echo esc_attr($slide['is_image']['url']); ?>" alt="<?php echo esc_html($slide['is_title']); ?>">
                              <span class="tx-image-slide-overlay"></span>
                              <h3 class="tx-image-slide-title"><?php echo esc_html($slide['is_title']); ?></h3>
                        <?php endif; ?>
				
			</div><!-- tx-image-slide-container -->

            <?php endforeach; ?>
		</div><!-- tx-image-slide-wrap -->
		
<?php }

}
