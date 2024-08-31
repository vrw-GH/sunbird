<?php
namespace AvasElements\Modules\ImageMagnifier\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageMagnifier extends Widget_Base {

	public function get_name() {
		return 'avas-image-magnifier';
	}

	public function get_title() {
		return esc_html__( 'Avas Image Magnifier', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-zoom-in';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'image', 'magnifier', 'zoom', 'magnify' ];
	}

    public function get_script_depends() {
        return [ 'tx-lightzoom' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
      'tx_image_magnifier_sec',
        [
            'label' => esc_html__( 'Contents', 'avas-core' )
        ]
    );

    $this->add_control(
        'tx_magnify_image',
        [
            'label'   => esc_html__( 'Image', 'avas-core' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src()
            ],
            'dynamic' => [
                'active' => true,
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name'    => 'magnify_image_size',
            'default' => 'full'
        ]
    );

    $this->add_group_control(
        Group_Control_Css_Filter::get_type(),
        [
            'name' => 'magnify_image_css_filter',
            'selector' => '{{WRAPPER}} .tx-image-magnify',
        ]
    );

    $this->end_controls_section();

        $this->start_controls_section(
            'tx_section_image_magnefic_container',
            [
                'label' => esc_html__( 'Settings', 'avas-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'tx_image_magnefic_container_image_width',
            [
                'label'       => __( 'Width', 'avas-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px', '%' ],
                'range'       => [
                    'px'      => [
                        'min' => 0,
                        'max' => 1000
                    ],
                    '%'       => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default'     => [
                    'unit'    => 'px',
                    // 'size'    => 100
                ],
                'selectors'   => [
                    '{{WRAPPER}} .tx-image-magnify' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'zoomPower',
            [
                'label' => esc_html__( 'Zoom Power', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_responsive_control(
            'glassSize',
            [
                'label' => esc_html__( 'Glass Size', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 150,
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
       ?>
          
            <div class="tx-image-magnify">
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'magnify_image_size', 'tx_magnify_image' ); ?>
            </div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('.tx-image-magnify img').lightzoom({
                    zoomPower : <?php echo esc_attr($settings['zoomPower']); ?>,
                    glassSize : <?php echo esc_attr($settings['glassSize']); ?>
                });
            });
        </script>
        
    <?php
    }

   

}
