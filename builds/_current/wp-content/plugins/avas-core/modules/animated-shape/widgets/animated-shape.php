<?php
namespace AvasElements\Modules\AnimatedShape\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnimatedShape extends Widget_Base {

    public function get_name() {
        return 'avas-animated-shape';
    }

    public function get_title() {
        return esc_html__( 'Avas Animated Shape', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-shape';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }
    
    public function get_keywords() {
        return [ 'animated', 'shape', 'animation' ];
    }

	protected function register_controls() {
        
        /**
        * animated shape Content Section
        */
        $this->start_controls_section(
            'tx_animated_shape_content',
            [
                'label' => esc_html__( 'Content', 'avas-core' )
            ]
        );

        $this->add_control(
            'tx_animated_shape_image',
            [
                'label'     => esc_html__( 'Image', 'avas-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'animated_shape_thumbnail',
                'default'   => 'large'
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
                    '{{WRAPPER}} .tx-animated-shape-image'   => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_animated_shape_style',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_control(
            'tx_animation_style',
            [
                'label' => esc_html__( 'Animation Style', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1'  => esc_html__( 'Style 1', 'avas-core' ),
                    'style_2' => esc_html__( 'Style 2', 'avas-core' ),
                    'style_3' => esc_html__( 'Style 3', 'avas-core' ),
                    'style_4' => esc_html__( 'Style 4', 'avas-core' ),
                    'style_5' => esc_html__( 'Style 5', 'avas-core' ),
                    'style_6' => esc_html__( 'Style 6', 'avas-core' ),
                    'style_7' => esc_html__( 'Style 7', 'avas-core' ),
                    'style_8' => esc_html__( 'Style 8', 'avas-core' ),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'tx_image_css_filter',
                'selector' => '{{WRAPPER}} .tx-animated-shape-image img',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
    ?>
    <div class="tx-animated-shape">
        <div class="tx-animated-shape-image <?php echo $settings['tx_animation_style']; ?>">
            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'animated_shape_thumbnail', 'tx_animated_shape_image' ); ?>
        </div>
    </div>
    <?php    
    }

}