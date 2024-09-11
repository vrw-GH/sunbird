<?php
namespace AvasElements\Modules\Profile\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Profile extends Widget_Base {

    public function get_name() {
        return 'avas-profile';
    }

    public function get_title() {
        return esc_html__( 'Avas Profile', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

	protected function register_controls() {
       
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Content', 'avas-core' )
            ]
        );
        $this->add_control(
            'prof_style',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1' => esc_html__( 'Style 1', 'avas-core' ),
                    'style-2' => esc_html__( 'Style 2',   'avas-core' ),
                ],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'user_name', 
            [
                'label' => esc_html__('Name', 'avas-core'),
                'default' => 'John Doe',
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'link_url', 
            [
                'label' => esc_html__('Link URL', 'avas-core'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'placeholder' => 'http://your-link.com',
            ]
        );
        $repeater->add_control(
            'position', 
            [
                'label' => esc_html__('Position', 'avas-core'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'user_image', 
            [
                'label' => esc_html__('Image', 'avas-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'profile_details', 
            [
                'label' => esc_html__('Details', 'avas-core'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt.', 'avas-core' ),
            ]
        );
        $repeater->add_control(
            'social_profile', 
            [
                'label' => esc_html__('Social Profile', 'avas'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $repeater->add_control(
            'phone', 
            [
                'label' => esc_html__('Phone', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'email', 
            [
                'label' => esc_html__('Email', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'facebook', 
            [
                'label' => esc_html__('Facebook', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'twitter', 
            [
                'label' => esc_html__('Twitter', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'linkedin', 
            [
                'label' => esc_html__('LinkedIn', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'instagram', 
            [
                'label' => esc_html__('Instagram', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'behance', 
            [
                'label' => esc_html__('Behance', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'dribbble', 
            [
                'label' => esc_html__('Dribbble', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'pinterest', 
            [
                'label' => esc_html__('Pinterest', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'youtube', 
            [
                'label' => esc_html__('Youtube', 'avas'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'profiles',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [

                    [
                        'user_name' => esc_html__('John Doe', 'avas-core'),
                        'position' => esc_html__('Web Developer', 'avas-core'),
                        'profile_details' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt.', 'avas-core'),
                    ],
                    [
                        'user_name' => esc_html__('Sharon Brinson', 'avas-core'),
                        'position' => esc_html__('Graphics Designer', 'avas-core'),
                        'profile_details' => esc_html__('Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'avas-core'),
                    ],
                    [
                        'user_name' => esc_html__('Felix Mercer', 'avas-core'),
                        'position' => esc_html__('Marketing Expert', 'avas-core'),
                        'profile_details' => esc_html__('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.', 'avas-core'),
                    ],
                    [
                        'user_name' => esc_html__('Carla Houston', 'avas-core'),
                        'position' => esc_html__('Finance Manager', 'avas-core'),
                        'profile_details' => esc_html__('Cras hendrerit suscipit ligula id ultrices. Maecenas dolor libero fringilla.', 'avas-core'),
                    ],
                ],
                
                'title_field' => '{{{ user_name }}}',
            ]
        );
        $this->add_responsive_control(
            'img_width',
            [
                'label' => esc_html__( 'Image Size', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 250,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '12' => esc_html__( 'One Column', 'avas-core' ),
                    '6' => esc_html__( 'Two Columns',   'avas-core' ),
                    '4' => esc_html__( 'Three Columns', 'avas-core' ),
                    '3' => esc_html__( 'Four Columns',  'avas-core' ),
                    '2' => esc_html__( 'Six Columns',   'avas-core' ),                   
                    
                ],
            ]
        );
        $this->add_control(
            'columns_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '6',
                'options' => [
                    '12' => esc_html__( 'One Column', 'avas-core' ),
                    '6' => esc_html__( 'Two Columns',   'avas-core' ),
                    '4' => esc_html__( 'Three Columns', 'avas-core' ),
                    '3' => esc_html__( 'Four Columns',  'avas-core' ),
                    '2' => esc_html__( 'Six Columns',   'avas-core' ),                   
                    
                ],
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
                    '{{WRAPPER}} .tx-profile-container'   => 'text-align: {{VALUE}};',
                ],
                

            ]
        );

        $this->end_controls_section();

        // Style section started
        $this->start_controls_section(
            'styles',
            [
              'label'   => esc_html__( 'Styles', 'avas-core' ),
              'tab'     => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'avas-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tx-profile-container',
            ]
        );
        $this->add_control(
            'cont_min_height',
            [
                'label' => esc_html__( 'Minimum Height', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_unit' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    // '%' => [
                    //     'min' => 0,
                    //     'max' => 100,
                    // ],
                ],
                // 'default' => [
                //     'unit' => '%',
                //     'size' => 0,
                // ],
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-container' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cont_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-profile-container',
            ]
        );
        $this->add_responsive_control(
            'cont_border_radius',
            [
                'label'      => esc_html__( 'Content Border Radius', 'avas-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tx-profile-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .tx-profile-container'
            ]
        );
        $this->add_control(
            'content_bg_color',
            [
                'label'     => esc_html__( 'Content Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-content' => 'background-color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'cont_pad',
            [
                'label' => esc_html__( 'Content Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Name Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-name' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'name_hov_color',
            [
                'label'     => esc_html__( 'Name Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-name:hover' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'name_typography',
                   'selector'  => '{{WRAPPER}} .tx-profile-name',
                   
              ]
        );
        $this->add_control(
            'position_color',
            [
                'label'     => esc_html__( 'Position Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-position' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'position_typography',
                   'selector'  => '{{WRAPPER}} .tx-profile-position',
                   
              ]
        );
        $this->add_control(
            'profile_details_color',
            [
                'label'     => esc_html__( 'Profile Details Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-profile-details' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'profile_details_typography',
                   'selector'  => '{{WRAPPER}} .tx-profile-details',
                   
              ]
        );
        $this->add_control(
            'sp_color',
            [
                'label'     => esc_html__( 'Social Profile Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a i' => 'color: {{VALUE}};',
                ],
                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'sp_hov_color',
            [
                'label'     => esc_html__( 'Social Profile Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tx-social-profile a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'sp_typography',
                   'selector'  => '{{WRAPPER}} .tx-social-profile a i',
                   
              ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sp_border',
                'label' => esc_html__( 'Border', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-social-profile a',
            ]
        );
        $this->add_control(
            'sp_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sp_padding',
            [
                'label' => esc_html__( 'Social Profile Icon Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sp_margin',
            [
                'label' => esc_html__( 'Social Profile Icon Margin', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-social-profile a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings();
    ?>
  
    <div class="tx-profile-wrap <?php echo esc_attr( $settings['prof_style'] ); ?>">
        <div class="row">
               <?php foreach ( $settings['profiles'] as $profile ) : ?>
                    <div class="col-lg-<?php echo esc_attr($settings['columns']); ?> col-sm-<?php echo esc_attr( $settings['columns_tablet'] ); ?>">
                        <div class="tx-profile-container">
                            <?php if(!empty($profile['user_image']['url'])) : ?>
                            <div class="tx-profile-image">
                                <?php if ( $profile['link_url']['is_external'] &&  !empty($profile['link_url']['url']) ) : ?>
                                    <a href="<?php echo $profile['link_url']['url']; ?>" target="_blank">
                                        <img src="<?php echo esc_attr($profile['user_image']['url']);?>" alt="<?php echo esc_attr( $profile['user_name'] ); ?>">
                                    </a>
                                <?php elseif (!empty($profile['link_url']['url'])) : ?>
                                    <a href="<?php echo $profile['link_url']['url']; ?>">
                                        <img src="<?php echo esc_attr($profile['user_image']['url']);?>" alt="<?php echo esc_attr( $profile['user_name'] ); ?>">
                                    </a>
                                <?php else : ?>
                                    <img src="<?php echo esc_attr($profile['user_image']['url']);?>" alt="<?php echo esc_attr( $profile['user_name'] ); ?>">
                                <?php endif; ?>
                            </div><!-- tx-profile-image -->
                            <?php endif; ?>

                            <div class="tx-profile-content">
                                <?php if ( $profile['link_url']['is_external'] &&  !empty($profile['link_url']['url']) ) : ?>
                                <a href="<?php echo $profile['link_url']['url']; ?>" target="_blank"><h4 class="tx-profile-name"><?php echo esc_html( $profile['user_name'] ); ?></h4></a>
                                <?php elseif (!empty($profile['link_url']['url'])) : ?>
                                   <a href="<?php echo $profile['link_url']['url']; ?>"><h4 class="tx-profile-name"><?php echo esc_html( $profile['user_name'] ); ?></h4></a>
                                
                                <?php else : ?>
                                <h4 class="tx-profile-name"><?php echo esc_html( $profile['user_name'] ); ?></h4>    
                                <?php endif; ?>
                                <div class="tx-profile-position"><?php echo esc_html( $profile['position'] ); ?></div>
                                <div class="tx-profile-details"><?php echo wp_kses_post( $profile['profile_details'] ); ?></div>
                                <?php TX_Helper::social_profile($profile); ?> 
                            </div><!-- tx-profile-content -->
                        </div><!-- tx-profile-container -->
                    </div><!-- col-md -->
               <?php endforeach; ?>    
        </div><!-- row -->
    </div><!-- tx-profile-wrap -->

<?php

    } // function render()

} // class Portfolio

