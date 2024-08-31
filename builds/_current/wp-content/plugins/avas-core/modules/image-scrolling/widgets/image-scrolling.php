<?php
namespace AvasElements\Modules\ImageScrolling\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Group_Control_Box_Shadow;
use elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageScrolling extends Widget_Base {

	public function get_name() {
		return 'avas-image-scrolling';
	}

	public function get_title() {
		return esc_html__( 'Avas Image Scrolling', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'image', 'scrolling', 'scroll' ];
	}
	protected function register_controls() {
		$this->start_controls_section(
			'is_settings',
			[
				'label' => esc_html__( 'Settings', 'avas-core' ),
			]
		);
		$this->add_control(
			'is_image',
			[
				'label' => esc_html__( 'Image', 'avas-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
            'alt_tag',
            [
                'label' => esc_html__( 'Image ALT Tag', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter alter tag for the image', 'avas-core' ),
                'dynamic'     => [ 'active' => true ],
                'label_block' => true,
            ]
        );
		$this->add_responsive_control(
            'is_img_size',
            [
                'label'   => esc_html__( 'Image Height', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 400,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'max'  => 1200,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-is-container, {{WRAPPER}} .tx-is-wrap .tx-is-container img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'is_img_speed',
            [
                'label'   => esc_html__( 'Srolling Speed(in seconds)', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                ],
                'range' => [
                    'px' => [
                        'max'  => 20,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-is-wrap .tx-is-container img' => '-webkit-transition: {{SIZE}}s all linear;transition: {{SIZE}}s all linear;',
                ],
            ]
        );
		$this->add_control(
			'is_link_url',
			[
				'label'       => esc_html__( 'Link URL', 'avas-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'https://your-link.com',

			]
		);
		$this->add_control(
			'caption',
			[
				'label' => esc_html__( 'Caption', 'avas-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Enter Image caption', 'avas-core' ),
				'dynamic'     => [ 'active' => true ],
				'label_block' => true,
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
                'default' => 'center',
                'toggle' => false,
                'selectors'         => [
                    '{{WRAPPER}} .tx-is-caption'   => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
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
		$this->start_controls_tabs( 'btn_tabs' );

		$this->start_controls_tab(
			'btn_tab_normal',
			[
				'label' => esc_html__( 'Normal', 'avas-core' ),
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'is_border',
                'selector'    =>    '{{WRAPPER}} .tx-is-wrap'
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
                    '{{WRAPPER}} .tx-is-wrap, {{WRAPPER}} .tx-is-wrap img'   => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'is_box_shadow',
                'selector' => '{{WRAPPER}} .tx-is-wrap',
                'separator' => '',
            ]
        );
        $this->add_control(
            'caption_color',
            [
                'label'     => esc_html__( 'Caption Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-is-caption' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'caption_color_hover',
            [
                'label'     => esc_html__( 'Caption Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-is-container:hover .tx-is-caption' => 'color: {{VALUE}};',
                ],
            ]
        );
         $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .tx-is-caption',
			]
		);
        $this->add_responsive_control(
            'caption_padding',
            [
                'label'         => esc_html__( 'Caption Padding', 'avas-core' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .tx-is-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector'    =>    '{{WRAPPER}} .tx-is-wrap:hover'
            ]
        );
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'is_hov_box_shadow',
                'selector' => '{{WRAPPER}} .tx-is-wrap:hover',
                'separator' => '',
            ]
        );
		$this->end_controls_tab();
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$link = $settings['is_link_url']['url'];
		$target = $settings['is_link_url']['is_external'] ? '_blank' : '_self';
		$this->add_render_attribute( 'link', 'href', esc_url($link) );
		?>

		<div class="tx-is-wrap">
			<div class="tx-is-container">
				<?php if ( ''!== $link ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'link' ); ?> target="<?php echo esc_attr($target); ?>">
						<img src="<?php echo esc_attr($settings['is_image']['url']); ?>" alt="<?php echo esc_html( $settings['alt_tag'] ); ?>">
						<div class="tx-is-caption"><?php echo esc_html( $settings['caption'] ); ?></div>
					</a>
				<?php else: ?>
					<img src="<?php echo esc_attr($settings['is_image']['url']); ?>" alt="<?php echo esc_html( $settings['alt_tag'] ); ?>">
					<div class="tx-is-caption"><?php echo esc_html( $settings['caption'] ); ?></div>
				<?php endif; ?>
			</div><!-- tx-is-container -->
		</div><!-- tx-is-wrap -->
		
<?php }

}
