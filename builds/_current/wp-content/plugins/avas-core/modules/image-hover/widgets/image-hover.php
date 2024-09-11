<?php
namespace AvasElements\Modules\ImageHover\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Group_Control_Background;
use elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageHover extends Widget_Base {

	public function get_name() {
		return 'avas-image-hover';
	}

	public function get_title() {
		return esc_html__( 'Avas Image Hover', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'image', 'hover' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'ih_settings',
			[
				'label' => esc_html__( 'Settings', 'avas-core' ),
			]
		);
		$this->add_control(
			'ih_image',
			[
				'label' => esc_html__( 'Image', 'avas-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_responsive_control(
            'ih_img_size',
            [
                'label'   => esc_html__( 'Image Size', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 1200,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-wrap, {{WRAPPER}} .tx-ih-wrap img'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'ih_effect',
			[
				'label' => esc_html__( 'Effects', 'avas-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'effect-1'  => esc_html__( 'Effect 1', 'avas-core' ),
					'effect-2'  => esc_html__( 'Effect 2', 'avas-core' ),
					'effect-3'  => esc_html__( 'Effect 3', 'avas-core' ),
					'effect-4'  => esc_html__( 'Effect 4', 'avas-core' ),
					'effect-5'  => esc_html__( 'Effect 5', 'avas-core' ),
					'effect-6'  => esc_html__( 'Effect 6', 'avas-core' ),
					'effect-7'  => esc_html__( 'Effect 7', 'avas-core' ),
					'effect-8'  => esc_html__( 'Effect 8', 'avas-core' ),
					'effect-9'  => esc_html__( 'Effect 9', 'avas-core' ),
					'effect-10' => esc_html__( 'Effect 10', 'avas-core' ),
					'effect-11' => esc_html__( 'Effect 11', 'avas-core' ),
					'effect-12' => esc_html__( 'Effect 12', 'avas-core' ),
					'effect-13' => esc_html__( 'Effect 13', 'avas-core' ),
					'effect-14' => esc_html__( 'Effect 14', 'avas-core' ),
					'effect-15' => esc_html__( 'Effect 15', 'avas-core' ),
					'effect-16' => esc_html__( 'Effect 16', 'avas-core' ),
					'effect-17' => esc_html__( 'Effect 17', 'avas-core' ),
					'effect-18' => esc_html__( 'Effect 18', 'avas-core' ),
					'effect-19' => esc_html__( 'Effect 19', 'avas-core' ),
					'effect-20' => esc_html__( 'Effect 20', 'avas-core' ),
					'effect-21' => esc_html__( 'Effect 21', 'avas-core' ),
					'effect-22' => esc_html__( 'Effect 22', 'avas-core' ),
					'effect-23' => esc_html__( 'Effect 23', 'avas-core' ),
					'effect-24' => esc_html__( 'Effect 24', 'avas-core' ),
					'effect-25' => esc_html__( 'Effect 25', 'avas-core' ),
					'effect-26' => esc_html__( 'Effect 26', 'avas-core' ),
					'effect-27' => esc_html__( 'Effect 27', 'avas-core' ),
					'effect-28' => esc_html__( 'Effect 28', 'avas-core' ),
					'effect-29' => esc_html__( 'Effect 29', 'avas-core' ),
					'effect-30' => esc_html__( 'Effect 30', 'avas-core' ),
					'effect-31' => esc_html__( 'Effect 31', 'avas-core' ),
					'effect-32' => esc_html__( 'Effect 32', 'avas-core' ),
				],
				'default' => 'effect-1',
			]
		);
		$this->add_control(
			'ih_title',
			[
				'label'   => esc_html__( 'Title', 'avas-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'This is the title', 'avas-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
            'ih_html_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h4',
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
			'ih_link',
			[
				'label'        => esc_html__( 'Title Link', 'avas-core' ),
				'type'         => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'ih_link_url',
			[
				'label'       => esc_html__( 'Title Link URL', 'avas-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'condition'   => [
				 'ih_link' => 'yes'
				]
			]
		);
		$this->add_control(
			'ih_desc',
			[
				'label'   => esc_html__( 'Description', 'avas-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'Suspendisse potenti Phasellus euismod libero in neque molestie et mentum libero maximus. Etiam in enim vestibulum suscipit sem quis.', 'avas-core' ),
				'placeholder' => esc_html__( 'Enter your description', 'avas-core' ),
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'ih_styles',
            [
                'label'                 => esc_html__( 'Style', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ih_background',
				'label' => esc_html__( 'Background', 'avas-core' ),
				'selector' => '{{WRAPPER}} .tx-ih-wrap.effect-1:before, {{WRAPPER}} .tx-ih-wrap.effect-2:before, {{WRAPPER}} .tx-ih-wrap.effect-3:hover:before, {{WRAPPER}} .tx-ih-wrap.effect-4:hover, {{WRAPPER}} .tx-ih-wrap.effect-5:before, {{WRAPPER}} .tx-ih-wrap.effect-5:after, {{WRAPPER}} .tx-ih-wrap.effect-5 .tx-ih-content:before, {{WRAPPER}} .tx-ih-wrap.effect-5 .tx-ih-content:after, {{WRAPPER}} .tx-ih-wrap.effect-6:before, {{WRAPPER}} .tx-ih-wrap.effect-7:before, {{WRAPPER}} .tx-ih-wrap.effect-8:before, {{WRAPPER}} .tx-ih-wrap.effect-8, {{WRAPPER}} .tx-ih-wrap.effect-9 .tx-ih-content, {{WRAPPER}} .tx-ih-wrap.effect-10:before, {{WRAPPER}} .tx-ih-wrap.effect-10:after, {{WRAPPER}} .tx-ih-wrap.effect-10 .tx-ih-content:before, {{WRAPPER}} .tx-ih-wrap.effect-10 .tx-ih-content:after, {{WRAPPER}} .tx-ih-wrap.effect-11:before, {{WRAPPER}} .tx-ih-wrap.effect-11:after,{{WRAPPER}} .tx-ih-wrap.effect-12:hover .tx-ih-content,{{WRAPPER}} .tx-ih-wrap.effect-15,{{WRAPPER}} .tx-ih-wrap.effect-21,{{WRAPPER}} .tx-ih-wrap.effect-23,{{WRAPPER}} .tx-ih-wrap.effect-25,{{WRAPPER}} .tx-ih-wrap.effect-26,{{WRAPPER}} .tx-ih-wrap.effect-27,{{WRAPPER}} .tx-ih-wrap.effect-28,{{WRAPPER}} .tx-ih-wrap.effect-29,{{WRAPPER}} .tx-ih-wrap.effect-30 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-31,{{WRAPPER}} .tx-ih-wrap.effect-32',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'ih_img_border',
                'selector'    =>    '{{WRAPPER}} .tx-ih-wrap'
            ]
        );
        $this->add_responsive_control(
            'ih_img_border_radius',
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
                    '{{WRAPPER}} .tx-ih-wrap'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ih_line_color',
            [
                'label'     => esc_html__( 'Line / Border Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-wrap.effect-3 .tx-ih-title:after,{{WRAPPER}} .tx-ih-wrap.effect-4:before,{{WRAPPER}} .tx-ih-wrap.effect-4:after,{{WRAPPER}} .tx-ih-wrap.effect-4 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-4 .tx-ih-content:after,{{WRAPPER}} .tx-ih-wrap.effect-16 .tx-ih-title:after,{{WRAPPER}} .tx-ih-wrap.effect-20 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-20 .tx-ih-content:after,{{WRAPPER}} .tx-ih-wrap.effect-28 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-28 .tx-ih-desc' => 'background: {{VALUE}};',

                    '{{WRAPPER}} .tx-ih-wrap.effect-11:hover .tx-ih-content:before, {{WRAPPER}} .tx-ih-wrap.effect-11:hover .tx-ih-content:after, {{WRAPPER}} .tx-ih-wrap.effect-12:hover .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-14 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-14 .tx-ih-content:after,{{WRAPPER}} .tx-ih-wrap.effect-15 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-17 .tx-ih-desc,{{WRAPPER}} .tx-ih-wrap.effect-18 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-19 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-19 .tx-ih-content:after,{{WRAPPER}} .tx-ih-wrap.effect-21 .tx-ih-content:after,{{WRAPPER}} .tx-ih-wrap.effect-22 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-23 .tx-ih-desc,{{WRAPPER}} .tx-ih-wrap.effect-27 .tx-ih-desc,{{WRAPPER}} .tx-ih-wrap.effect-29 .tx-ih-content:after,{{WRAPPER}} .tx-ih-wrap.effect-30 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-31 .tx-ih-content:before,{{WRAPPER}} .tx-ih-wrap.effect-32 .tx-ih-desc' => 'border-color: {{VALUE}};',
                ],
			    'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-3'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-4'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-11'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-12'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-14'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-15'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-16'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-17'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-18'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-19'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-20'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-21'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-22'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-23'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-27'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-28'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-29'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-30'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-31'],
							]
						],
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-32'],
							]
						],
					]
				],

            ]
        );
		$this->add_control(
            'ih_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ih_title_hov_color',
            [
                'label'     => esc_html__( 'Title Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ih_title_bg_color',
            [
                'label'     => esc_html__( 'Title Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ih_title_typo',
                'selector'  => '{{WRAPPER}} .tx-ih-title',
            ]
        );
        $this->add_responsive_control(
            'ih_title_padding',
            [
                'label'         => esc_html__( 'Title Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-ih-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ih_desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-desc' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'ih_desc_bg_color',
            [
                'label'     => esc_html__( 'Description Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ih-desc' => 'background: {{VALUE}};',
                ],
                'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'terms' => [
								['name' => 'ih_effect', 'operator' => '===', 'value' => 'effect-24'],
							]
						],
					]
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ih_desc_typo',
                'selector'  => '{{WRAPPER}} .tx-ih-desc>*',
            ]
        );
        $this->add_responsive_control(
            'ih_desc_padding',
            [
                'label'         => esc_html__( 'Description Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-ih-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		if ( empty( $settings['ih_image']['url'] ) ) {
			return;
		}
		$this->add_render_attribute( 'image', 'src', $settings['ih_image']['url'] );
		$target = $settings['ih_link_url']['is_external'] ? '_blank' : '_self';


		?>	
		<div class="tx-ih-wrap <?php echo esc_attr( $settings['ih_effect'] ); ?>">
			
            <img <?php echo $this->get_render_attribute_string( 'image' ); ?>>
			
            <div class="tx-ih-content">
            	<div class="tx-ih-inner-content">
		            <div class="tx-ih-title-wrap">
			            <?php if($settings['ih_link'] == 'yes') : ?>
			            <a class="tx-ih-title-link" href="<?php echo esc_url($settings['ih_link_url']['url']); ?>" target="<?php echo esc_attr($target); ?>">
						<<?php echo esc_attr( $settings['ih_html_tag'] ); ?> class="tx-ih-title"><?php echo esc_html( $settings['ih_title'] ); ?></<?php echo esc_attr( $settings['ih_html_tag'] ); ?>>
						</a>
						<?php else : ?>
						<<?php echo esc_attr( $settings['ih_html_tag'] ); ?> class="tx-ih-title"><?php echo esc_html( $settings['ih_title'] ); ?></<?php echo esc_attr( $settings['ih_html_tag'] ); ?>>
						<?php endif; ?>
					</div><!-- tx-ih-title-wrap -->
					<div class="tx-ih-desc">
						<?php echo wp_kses_post( $settings['ih_desc'] ); ?>
					</div>
				</div><!-- tx-ih-inner-content -->
			</div><!-- tx-ih-content-wrap -->
			
		</div><!-- tx-ih-wrap -->
		
<?php }

}
