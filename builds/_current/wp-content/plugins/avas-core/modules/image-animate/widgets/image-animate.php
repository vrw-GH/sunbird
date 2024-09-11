<?php
namespace AvasElements\Modules\ImageAnimate\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageAnimate extends Widget_Base {

    public function get_name() {
        return 'avas-image-animate';
    }

    public function get_title() {
        return esc_html__( 'Avas Image Animate', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() {
        return [ 'typed', 'morphext' ];
    }
    public function get_keywords() {
        return [ 'animated', 'animate', 'animation', 'image', 'swing', 'moving', 'move', 'up', 'down', 'left', 'right' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'ib_settings',
            [
                'label' => esc_html__( 'Image', 'avas-core' ),
            ]
        );
        $this->add_control(
            'ia_image',
            [
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
            'ia_img_size',
            [
                'label'   => esc_html__( 'Image Size', 'avas-core' ),
                'type'    => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max'  => 3500,
                        'min'  => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-image-animate-wrap img'   => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ia_animate',
            [
                'label' => esc_html__( 'Animate', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__( 'Up Down', 'avas-core' ),
                    'left' => esc_html__( 'Left Right', 'avas-core' ),
                ],
                'default' => 'top',
            ]
        );
        $this->add_control(
            'ia_moving',
            [
                'label'     => esc_html__( 'Moving Area', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 25,
            ]
        );
        $this->add_control(
            'ia_speed',
            [
                'label'     => esc_html__( 'Speed', 'avas-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 2500,
                'step'      => 50,
            ]
        );
        
        $this->add_control(
            'ia_link_url',
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
                'selectors'         => [
                    '{{WRAPPER}} .tx-image-animate-wrap'   => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
        $link = $settings['ia_link_url']['url'];
        $target = $settings['ia_link_url']['is_external'] ? '_blank' : '_self';
        $id = $this->get_id();
        $this->add_render_attribute( 'image-animate', 'id', 'tx-ia-' . $id );
        $this->add_render_attribute( 'image-animate', 'class', 'tx-image-animate-wrap' );
        $this->add_render_attribute( 'link', 'href', esc_url($link) );
        ?>

    <div <?php echo $this->get_render_attribute_string( 'image-animate' ); ?> >
        <?php if ( ''!== $link ) : ?>
            <a <?php echo $this->get_render_attribute_string( 'link' ); ?> target="<?php echo esc_attr($target); ?>">
                <img src="<?php echo esc_attr($settings['ia_image']['url']); ?>" alt="<?php echo esc_html( $settings['alt_tag'] ); ?>">
            </a>
        <?php else: ?>
            <img src="<?php echo esc_attr($settings['ia_image']['url']); ?>" alt="<?php echo esc_html( $settings['alt_tag'] ); ?>">
        <?php endif; ?>
    </div><!-- tx-image-animate-wrap -->

    <script>
    jQuery(document).ready(function($){'use strict';
       
        function moveDown() {
        $("#<?php echo esc_attr( 'tx-ia-' . $id ); ?>").animate(
            { "<?php echo esc_attr( $settings['ia_animate'] ); ?>": "-=<?php echo esc_attr( $settings['ia_moving'] ); ?>" }, 
            <?php echo esc_attr( $settings['ia_speed'] ); ?>, 
            "swing", 
            moveUp
            );
        }
        
        function moveUp() {
        $("#<?php echo esc_attr( 'tx-ia-' . $id ); ?>").animate(
            {"<?php echo esc_attr( $settings['ia_animate'] ); ?>": "+=<?php echo esc_attr( $settings['ia_moving'] ); ?>"}, 
            <?php echo esc_attr( $settings['ia_speed'] ); ?>, 
            "swing", 
            moveDown
            );
        }
    
        moveUp();

    });
    </script>


<?php
	} //render()
} // class
