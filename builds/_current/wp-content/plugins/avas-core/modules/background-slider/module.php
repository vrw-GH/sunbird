<?php
namespace AvasElements\Modules\BackgroundSlider;

use AvasElements\Base\Module_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function __construct() {

		add_action( 'elementor/element/after_section_end',[ $this, 'tx_register_bs_controls'],10,3 );
        add_action( 'elementor/frontend/element/before_render', [ $this, 'tx_before_bs_render'],10,1 );
		add_action( 'elementor/frontend/column/before_render', [ $this, 'tx_before_bs_render'],10,1 );
		add_action( 'elementor/frontend/section/before_render', [$this, 'tx_before_bs_render'], 10, 1 );
		add_action( 'elementor/element/print_template', [ $this, 'tx_content_template'],10,2 );
		add_action( 'elementor/section/print_template', [ $this, 'tx_content_template'],10,2 );
		add_action( 'elementor/column/print_template', [ $this, 'tx_content_template'],10,2 );
       
	}

	public function get_name() {
		return 'avas-bg-slider';
	}

	// public function get_script_depends() {
 //        return [ 'background-slider' ];
 //    }

	public function tx_register_bs_controls( $element, $section_id, $args ) {
		if ( ('section' === $element->get_name() && 'section_background' === $section_id) || ('column' === $element->get_name() && 'section_style' === $section_id)) {

			$element->start_controls_section(
				'bs_section',
				[
					'label' => esc_html__( 'Avas Background Slider', 'avas-core' ),
					'tab'   => Controls_Manager::TAB_STYLE
				]
			);

        	$element->add_control(
				'bs_images',
				[
					'label'     => esc_html__( 'Add Images', 'avas-core' ),
					'type'      => Controls_Manager::GALLERY,
					'default'   => [],
				]
			);
        	$element->add_control(
				'bs_bg_size',
					[
					'label'     => esc_html__( 'Background Size', 'avas-core' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => [
						'cover'   => esc_html__( 'Cover', 'avas-core' ),
						'contain'   => esc_html__( 'Contain', 'avas-core' ),
						'auto'   => esc_html__( 'Auto', 'avas-core' ),
						'length'   => esc_html__( 'Length', 'avas-core' ),
						'initial'   => esc_html__( 'Initial', 'avas-core' ),
						'inherit'   => esc_html__( 'Inherit', 'avas-core' ),
					],
					'selectors' => [
						'{{WRAPPER}} .tx-bg-slider .vegas-slide-inner' => 'background-size: {{VALUE}} !important;',
					],
					'default'   => 'cover',
					'separator'	=> 'after'
				]
			);
        	$element->add_control(
				'bs_transition',
				[
					'label'   => esc_html__( 'Transition', 'avas-core' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'fade'        => esc_html__( 'Fade', 'avas-core' ),
						'fade2'       => esc_html__( 'Fade2', 'avas-core' ),
						'slideLeft'   => esc_html__( 'slide Left', 'avas-core' ),
						'slideLeft2'  => esc_html__( 'Slide Left 2', 'avas-core' ),
						'slideRight'  => esc_html__( 'Slide Right', 'avas-core' ),
						'slideRight2' => esc_html__( 'Slide Right 2', 'avas-core' ),
						'slideUp'     => esc_html__( 'Slide Up', 'avas-core' ),
						'slideUp2'    => esc_html__( 'Slide Up 2', 'avas-core' ),
						'slideDown'   => esc_html__( 'Slide Down', 'avas-core' ),
						'slideDown2'  => esc_html__( 'Slide Down 2', 'avas-core' ),
						'zoomIn'      => esc_html__( 'Zoom In', 'avas-core' ),
						'zoomIn2'     => esc_html__( 'Zoom In 2', 'avas-core' ),
						'zoomOut'     => esc_html__( 'Zoom Out', 'avas-core' ),
						'zoomOut2'    => esc_html__( 'Zoom Out 2', 'avas-core' ),
						'swirlLeft'   => esc_html__( 'Swirl Left', 'avas-core' ),
						'swirlLeft2'  => esc_html__( 'Swirl Left 2', 'avas-core' ),
						'swirlRight'  => esc_html__( 'Swirl Right', 'avas-core' ),
						'swirlRight2' => esc_html__( 'Swirl Right 2', 'avas-core' ),
						'burn'        => esc_html__( 'Burn', 'avas-core' ),
						'burn2'       => esc_html__( 'Burn 2', 'avas-core' ),
						'blur'        => esc_html__( 'Blur', 'avas-core' ),
						'blur2'       => esc_html__( 'Blur 2', 'avas-core' ),
						'flash'       => esc_html__( 'Flash', 'avas-core' ),
						'flash2'      => esc_html__( 'Flash 2', 'avas-core' ),
						'random'      => esc_html__( 'Random', 'avas-core' )
					],
					'default' => 'fade',
				]
			);
			$element->add_control(
				'bs_first_transition',
				[
					'label'   => esc_html__( 'First Slide Transition', 'avas-core' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'fade'        => esc_html__( 'Fade', 'avas-core' ),
						'fade2'       => esc_html__( 'Fade2', 'avas-core' ),
						'slideLeft'   => esc_html__( 'slide Left', 'avas-core' ),
						'slideLeft2'  => esc_html__( 'Slide Left 2', 'avas-core' ),
						'slideRight'  => esc_html__( 'Slide Right', 'avas-core' ),
						'slideRight2' => esc_html__( 'Slide Right 2', 'avas-core' ),
						'slideUp'     => esc_html__( 'Slide Up', 'avas-core' ),
						'slideUp2'    => esc_html__( 'Slide Up 2', 'avas-core' ),
						'slideDown'   => esc_html__( 'Slide Down', 'avas-core' ),
						'slideDown2'  => esc_html__( 'Slide Down 2', 'avas-core' ),
						'zoomIn'      => esc_html__( 'Zoom In', 'avas-core' ),
						'zoomIn2'     => esc_html__( 'Zoom In 2', 'avas-core' ),
						'zoomOut'     => esc_html__( 'Zoom Out', 'avas-core' ),
						'zoomOut2'    => esc_html__( 'Zoom Out 2', 'avas-core' ),
						'swirlLeft'   => esc_html__( 'Swirl Left', 'avas-core' ),
						'swirlLeft2'  => esc_html__( 'Swirl Left 2', 'avas-core' ),
						'swirlRight'  => esc_html__( 'Swirl Right', 'avas-core' ),
						'swirlRight2' => esc_html__( 'Swirl Right 2', 'avas-core' ),
						'burn'        => esc_html__( 'Burn', 'avas-core' ),
						'burn2'       => esc_html__( 'Burn 2', 'avas-core' ),
						'blur'        => esc_html__( 'Blur', 'avas-core' ),
						'blur2'       => esc_html__( 'Blur 2', 'avas-core' ),
						'flash'       => esc_html__( 'Flash', 'avas-core' ),
						'flash2'      => esc_html__( 'Flash 2', 'avas-core' ),
						'random'      => esc_html__( 'Random', 'avas-core' )
					],
					'default' => 'fade',
				]
			);
			$element->add_control(
				'bs_animation',
				[
					'label'   => esc_html__( 'Animation', 'avas-core' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'kenburns'          => esc_html__( 'Kenburns', 'avas-core' ),
						'kenburnsUp'        => esc_html__( 'Kenburns Up', 'avas-core' ),
						'kenburnsDown'      => esc_html__( 'Kenburns Down', 'avas-core' ),
						'kenburnsRight'     => esc_html__( 'Kenburns Right', 'avas-core' ),
						'kenburnsLeft'      => esc_html__( 'Kenburns Left', 'avas-core' ),
						'kenburnsUpLeft'    => esc_html__( 'Kenburns Up Left', 'avas-core' ),
						'kenburnsUpRight'   => esc_html__( 'Kenburns Up Right', 'avas-core' ),
						'kenburnsDownLeft'  => esc_html__( 'Kenburns Down Left', 'avas-core' ),
						'kenburnsDownRight' => esc_html__( 'Kenburns Down Right', 'avas-core' ),
						'random'            => esc_html__( 'Random', 'avas-core' ),
						''                  => esc_html__( 'None', 'avas-core' )
					],
					'default' => 'kenburns',
				]
			);

			$element->add_control(
	            'bs_delay',
	            [
	                'label' => esc_html__('Delay', 'avas-core'),
	                'type' => Controls_Manager::NUMBER,
	                'default' => 5000,
	                'step'	=> 500,
	            ]
	        );

	        $element->add_control(
	            'bs_transition_duration',
	            [
	                'label' => esc_html__('Transition Duration', 'avas-core'),
	                'type' 	=> Controls_Manager::NUMBER,
	                'default' => 2500,
	                'step'	=> 50,
	            ]
	        );

	        $element->add_control(
				'bs_overlay',
				[
					'label'     => esc_html__( 'Overlay', 'avas-core' ),
					'description' => esc_html__( 'This will display on live page.', 'avas-core' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => [
						'00'   => esc_html__( 'None', 'avas-core' ),
						'01'   => esc_html__( 'Style 1', 'avas-core' ),
						'02'   => esc_html__( 'Style 2', 'avas-core' ),
						'03'   => esc_html__( 'Style 3', 'avas-core' ),
						'04'   => esc_html__( 'Style 4', 'avas-core' ),
						'05'   => esc_html__( 'Style 5', 'avas-core' ),
						'06'   => esc_html__( 'Style 6', 'avas-core' ),
						'07'   => esc_html__( 'Style 7', 'avas-core' ),
						'08'   => esc_html__( 'Style 8', 'avas-core' ),
						'09'   => esc_html__( 'Style 9', 'avas-core' )
					],
					'default'   => '00',
					'separator'	=> 'before'
				]
			);

			$element->add_control(
	            'overlay_color',
	            [
	                'label' => esc_html__('Overlay Color', 'avas-core'),
	                'description' => esc_html__( 'This will display on live page.', 'avas-core' ),
	                'type' => Controls_Manager::COLOR,
	               'selectors' => [
                    '{{WRAPPER}} .tx-bg-slider .vegas-overlay' => 'background-color: {{VALUE}};',
                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'bs_timer',
	            [
	                'label' => esc_html__( 'Timer', 'avas-core' ),
	                'type' 	=> Controls_Manager::CHOOSE,
	                'options' => [
	                    'true' => [
	                        'title' => esc_html__( 'Enable', 'avas-core' ),
	                        'icon' 	=> 'eicon-check',
	                    ],
	                    'false' => [
	                        'title' => esc_html__( 'Disable', 'avas-core' ),
	                        'icon' 	=> 'eicon-ban',
	                    ]
	                ],
	                'default' => 'true',
	                'toggle' => false,
	                'separator'	=> 'before'
	            ]
	        );

	        $element->add_responsive_control(
	            'timer_color',
	            [
	                'label' => esc_html__('Timer Color', 'avas-core'),
	                'type' => Controls_Manager::COLOR,
	               	'selectors' => [
                    '{{WRAPPER}} .tx-bg-slider .vegas-timer-running .vegas-timer-progress' => 'background-color: {{VALUE}};',
                	],
                	'condition' => [
                		'bs_timer' => 'true'
                	]
	            ]
	        );

	        $element->add_responsive_control(
				'timer_height',
				[
					'label' => esc_html__( 'Timer Height', 'avas-core' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tx-bg-slider .vegas-timer' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
	                	'bs_timer' => 'true'
	                ]
				]
			);

			$element->end_controls_section();
		}}
	
        public function tx_before_bs_render( $element ) {
        	if ( $element->get_name() != 'section' && $element->get_name() != 'column' ) {
				return;
			}

            $settings = $element->get_settings(); 

			$slides = [];

            if( empty($settings['bs_images']) ) {
            	return;
            }

            if( !empty($settings['bs_images']) ) {
            	wp_enqueue_style( 'vegas' );
            	wp_enqueue_script( 'vegas' );
            	// wp_enqueue_script( 'background-slider' );

            }


			foreach ( $settings['bs_images'] as $image ) {
				$image_url = $image['url'];
				$slides[]  = [ 'src' => $image_url ];
			}

			if ( empty( $slides ) ) {
				return;
			}

            ?>
    		
     		<script type="text/javascript">
	        jQuery( document ).ready( function($) {
	        	'use strict';

	            $(".elementor-element-<?php echo $element->get_id(); ?>").prepend('<div ' +
                    'class="tx-bg-slider-wrap"><div' +
                    ' class="tx-bg-slider"></div></div>');

	            	if ('<?php echo $settings["bs_overlay"]; ?>') {
                        var overlay = '<?php echo TX_PLUGIN_URL . "/assets/img/" . $settings["bs_overlay"] . ".png"; ?>';
                    }

	            $(".elementor-element-<?php echo $element->get_id(); ?>").children('.tx-bg-slider-wrap').children
                ('' +
                    '.tx-bg-slider').vegas({
	                overlay: overlay,
	                slides: <?php echo json_encode( $slides ) ?>,
	                transitionDuration: '<?php echo esc_attr( $settings['bs_transition_duration'] ); ?>',
	                delay: '<?php echo esc_attr( $settings['bs_delay'] ); ?>',
	                firstTransition: '<?php echo esc_attr( $settings['bs_first_transition'] ); ?>',
	                transition: '<?php echo esc_attr( $settings['bs_transition'] ); ?>',
	                animation: '<?php echo esc_attr( $settings['bs_animation'] ); ?>',
	                timer: <?php echo esc_attr( $settings['bs_timer'] ); ?>
	            });

	        });
        	</script>
                
<?php            
        }

    public function tx_content_template( $template, $widget ) {
		if ( $widget->get_name() != 'section' && $widget->get_name() != 'column' ) {
			return $template;
		}

		ob_start();
		?>
        <#

        var rand_id = Math.random().toString(36).substring(7);
        var slides_path_string = '';
        var transition = settings.bs_transition;
        var firstTransition = settings.bs_first_transition;
        var animation = settings.bs_animation;
        var delay = settings.bs_delay;
        var transitionDuration = settings.bs_transition_duration;
        var timer = settings.bs_timer;

        if(!_.isUndefined(settings.bs_images) && settings.bs_images.length){
        var slider_data = [];
        slides = settings.bs_images;
        for(var i in slides){
        slider_data[i]  = slides[i].url;
        }
        slides_path_string = slider_data.join();
        }

        #>

        <div class="tx-bg-slider-wrap">
            <div class="tx-bg-slider"
                 data-tx-bg-slider="{{ slides_path_string }}"
                 data-tx-bg-slider-transition="{{ transition }}"
                 data-tx-bg-slider-first-transition="{{ firstTransition }}"
                 data-tx-bg-slider-animation="{{ animation }}"
                 data-tx-bg-slider-delay="{{ delay }}"
                 data-tx-bg-slider-transition-duration="{{ transitionDuration }}"
                 data-tx-bg-slider-timer="{{ timer }}"
            ></div>
        </div>

		<?php
		$content = ob_get_contents();
		ob_end_clean();
		$template = $content . $template;

		return $template;
	}
        
 }

