<?php
namespace AvasElements\Modules\ImageComparison\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageComparison extends Widget_Base {

	public function get_name() {
		return 'avas-image-comparison';
	}

	public function get_title() {
		return esc_html__( 'Avas Image Comparison', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-image-before-after';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'image', 'comparison', 'compare', 'before', 'after', 'difference' ];
	}

    public function get_script_depends() {
        return [ 'tx-image-comparison','image-comparison' ];
    }

    public function get_style_depends() {
        return [ 'image-comparison' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'ic_image',
			[
				'label' => esc_html__( 'Image', 'avas-core' ),
			]
		);
		$this->add_control(
            'before_image',
            [
                'label'   => esc_html__( 'Before Image', 'avas-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => TX_PLUGIN_URL . '/assets/img/before.jpg',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );
        $this->add_control(
            'before_alt_tag',
            [
                'label' => esc_html__( 'Before Image ALT Tag', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter alter tag for the before image', 'avas-core' ),
                'dynamic'     => [ 'active' => true ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'after_image',
            [
                'label'   => esc_html__( 'After Image', 'avas-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => TX_PLUGIN_URL . '/assets/img/after.jpg',
                ],
                'dynamic' => [ 'active' => true ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'after_alt_tag',
            [
                'label' => esc_html__( 'After Image ALT Tag', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter alter tag for the after image', 'avas-core' ),
                'dynamic'     => [ 'active' => true ],
                'label_block' => true,
            ]
        );
         $this->end_controls_section();

        $this->start_controls_section(
            'ic_labels',
            [
                'label' => esc_html__( 'Labels', 'avas-core' ),
            ]
        );
        $this->add_control(
            'show_labels',
            [
                'label'       => esc_html__( 'Show Labels', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );
        $this->add_control(
            'on_hover',
            [
                'label'       => esc_html__( 'On Hover', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'condition'   => [
                    'show_labels' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'before_label',
            [
                'label'       => esc_html__( 'Before Label', 'avas-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Before Label', 'avas-core' ),
                'default'     => esc_html__( 'Before', 'avas-core' ),
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
                'condition'   => [
                    'show_labels' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'after_label',
            [
                'label'       => esc_html__( 'After Label', 'avas-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'After Label', 'avas-core' ),
                'default'     => esc_html__( 'After', 'avas-core' ),
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
                'condition'   => [
                    'show_labels' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ic_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' ),
            ]
        );
        $this->add_control(
            'orientation',
            [
                'label'   => esc_html__( 'Orientation', 'avas-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__( 'Horizontal', 'avas-core' ),
                    'vertical'   => esc_html__( 'Vertical', 'avas-core' ),
                ],
            ]
        );
        $this->add_control(
            'starting_point',
            [
                'label'   => esc_html__( 'Control Line Start (%)', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'max'  => 100,
                        'min'  => 0,
                    ],
                ],
            ]
        );
        
        $this->add_control(
            'move_slider_on_hover',
            [
                'label'       => esc_html__( 'Slide on Hover', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'add_circle',
            [
                'label'       => esc_html__( 'Control Line Circle', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'add_circle_blur',
            [
                'label'       => esc_html__( 'Circle Blur', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'condition'   => [
                    'add_circle' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'add_circle_shadow',
            [
                'label'       => esc_html__( 'Circle Shadow', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'condition'   => [
                    'add_circle' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'smoothing',
            [
                'label'       => esc_html__( 'Smoothing', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'smoothing_amount',
            [
                'label'   => esc_html__( 'Smoothing Amount', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 400,
                ],
                'range' => [
                    'px' => [
                        'max'  => 1000,
                        'min'  => 100,
                        'step' => 10,
                    ],
                ],
                
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
		$this->add_control(
            'control_line',
            [
                'label'     => esc_html__( 'Control Line Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
            ]
        );
        $this->add_control(
            'labels_bg_color',
            [
                'label'     => esc_html__( 'Label Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ic-wrap .icv__label.icv__label-before, {{WRAPPER}} .tx-ic-wrap .icv__label.icv__label-after' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'labels_color',
            [
                'label'     => esc_html__( 'Label Text Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-ic-wrap .icv__label.icv__label-before, {{WRAPPER}} .tx-ic-wrap .icv__label.icv__label-after' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'labels_typography',
                'label'     => esc_html__( 'Label Typography', 'avas-core' ),
                'selector'  => '{{WRAPPER}} .tx-ic-wrap .icv__label',
            ]
        );
        $this->add_responsive_control(
            'labels_padding',
            [
                'label'      => esc_html__( 'Label Padding', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-ic-wrap .icv__label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'labels_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-ic-wrap .icv__label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        if ($settings['starting_point']['size'] < 1) :
            $settings['starting_point']['size'] = $settings['starting_point']['size'] * 100;
        endif;

        $this->add_render_attribute(
            [
                'tx-ic-content' => [
                    'id'        => 'tx-ic-content-' . $this->get_id(),
                    'class'     => [ 'tx-ic-content' ],
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            'id'                    => 'tx-ic-content-' . $this->get_id(),
                            'starting_point'       => $settings['starting_point']['size'],
                            'orientation'           => ($settings['orientation'] == 'horizontal') ? false : true,
                            'before_label'          => $settings['before_label'],
                            'after_label'           => $settings['after_label'],
                            'show_labels'            => ('yes' == $settings['show_labels']) ? true : false, 
                            'on_hover'              => ('yes' == $settings['on_hover']) ? true : false, 
                            'move_slider_on_hover'  => ('yes' == $settings['move_slider_on_hover']) ? true : false,
                            'add_circle'            => ('yes' == $settings['add_circle']) ? true : false,
                            'add_circle_blur'       => ('yes' == $settings['add_circle_blur']) ? true : false,
                            'add_circle_shadow'     => ('yes' == $settings['add_circle_shadow']) ? true : false,
                            'smoothing'             => ('yes' == $settings['smoothing']) ? true : false,
                            'smoothing_amount'      => $settings['smoothing_amount']['size'],
                            'control_line'          => $settings['control_line'],
                            ])
                        ),
                    ],
                ],
            ]
        );

		?>

		<div class="tx-ic-wrap">
			<div <?php echo $this->get_render_attribute_string( 'tx-ic-content' ); ?>>
                <img src="<?php echo esc_attr($settings['before_image']['url']); ?>" alt="<?php echo esc_html( $settings['before_alt_tag'] ); ?>">
                <img src="<?php echo esc_attr($settings['after_image']['url']); ?>" alt="<?php echo esc_html( $settings['after_alt_tag'] ); ?>">
            </div><!-- tx-is-content -->
		</div><!-- tx-is-wrap -->
		
<?php }

}
