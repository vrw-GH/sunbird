<?php
namespace AvasElements\Modules\Menu\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Menu extends Widget_Base {

    public function get_name() {
        return 'avas-menu';
    }

    public function get_title() {
        return esc_html__( 'Avas Menu', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_script_depends() {
        return [ 'menu' ];
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    private function get_available_menus() {
        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
    }

	protected function register_controls() {

        $this->start_controls_section(
            'settings_tab',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
            $this->add_control(
                'menu',
                [
                    'label'       => esc_html__( 'Menu', 'avas-core' ),
                    'type'        => Controls_Manager::SELECT,
                    'options'     => $menus,
                    'default'     => array_keys( $menus )[0],
                    'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'avas-core' ), admin_url( 'nav-menus.php' ) ),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'avas-core' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator'       => 'after',
                ]
            );
        }
        $this->add_control(
            'align',
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
                    'selectors' => [
                        '{{WRAPPER}} .navbar-responsive-collapse' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
        $this->add_control( 
            'res_menu_txt',
            [
                'label' => esc_html__( 'Responsive Menu Text', 'avas-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'MENU', 'avas-core' ),
                'description' =>  __( '<img src="'.TX_PLUGIN_URL . '/assets/img/mob.gif"><br>Select "Mobile" device to see the responsive menu. ', 'avas-core' ),
                'separator' => 'before'
            ]
        );
        $this->end_controls_section();      

        $this->start_controls_section(
            'style_tab',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'style_tabs' );

            $this->start_controls_tab( 
                'style_normal', 
                [ 
                    'label' => esc_html__( 'Main Menu', 'avas-core' ) 
                ] 
            );

            $this->add_control(
                'menu_item_color',
                [
                    'label' => esc_html__( 'Menu item color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .main-menu>li>a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'menu_item_hov_color',
                [
                    'label' => esc_html__( 'Menu item hover color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .main-menu>li>a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'menu_item_bg_hov_color',
                [
                    'label' => esc_html__( 'Menu item background hover color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .main-menu>li>a:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'menu_item_active_color',
                [
                    'label' => esc_html__( 'Menu item active color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ul.main-menu>li.current-menu-item>a, {{WRAPPER}} ul.main-menu>li.current-menu-parent>a, {{WRAPPER}} ul.main-menu>li.current-page-ancestor>a, {{WRAPPER}} ul.main-menu>li.current_page_ancestor>a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'menu_item_active_bg_color',
                [
                    'label' => esc_html__( 'Menu item active background color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ul.main-menu>li.current-menu-item>a, {{WRAPPER}} ul.main-menu>li.current-menu-parent>a, {{WRAPPER}} ul.main-menu>li.current-page-ancestor>a, {{WRAPPER}} ul.main-menu>li.current_page_ancestor>a' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'menu_item_typo',
                    'selector'  => '{{WRAPPER}} .main-menu>li>a',
                ]
            );
            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name'      => 'menu_item_text_shadow',
                    'label'     => esc_html__( 'Text Shadow', 'avas-core' ),
                    'selector'  => '{{WRAPPER}} .main-menu>li>a',
                ]
            );
            $this->add_responsive_control(
                'menu_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'avas-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .main-menu>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'menu_item_margin',
                [
                    'label' => esc_html__( 'Margin', 'avas-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .main-menu>li>a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'menu_item_border',
                    'label' => esc_html__( 'Border', 'avas-core' ),
                    'selector' => '{{WRAPPER}} .main-menu>li>a',
                ]
            );
            
            $this->end_controls_tab();

            $this->start_controls_tab( 
                'style_sub_menu', 
                [ 
                    'label' => esc_html__( 'Sub Menu', 'avas-core' ) 
                ] 
            );
            $this->add_control(
                'menu_sub_item_color',
                [
                    'label' => esc_html__( 'Sub menu item color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .main-menu li ul li a' => 'color: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'menu_sub_bg_color',
                [
                    'label' => esc_html__( 'Sub menu background color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .main-menu li > ul' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'menu_sub_border_color',
                [
                    'label' => esc_html__( 'Sub menu border color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .main-menu li ul li a' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'menu_sub_item_hov_color',
                [
                    'label' => esc_html__( 'Sub menu item hover color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .main-menu li ul li a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'menu_sub_item_typo',
                    'selector'  => '{{WRAPPER}} .main-menu li ul li a',
                ]
            );
            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name'      => 'menu_sub_item_text_shadow',
                    'label'     => esc_html__( 'Text Shadow', 'avas-core' ),
                    'selector'  => '{{WRAPPER}} .main-menu li ul li a',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'menu_sub_box_shadow',
                    'selector' => '{{WRAPPER}} .main-menu li>ul',
                ]
            );
            $this->end_controls_tab();

            $this->start_controls_tab( 
                'style_mega_menu', 
                [ 
                    'label' => esc_html__( 'Mega Menu', 'avas-core' ) 
                ] 
            );
            $this->add_control(
                'menu_mega_item_color',
                [
                    'label' => esc_html__( 'Mega menu item color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .tx-mega-menu .mega-menu-item .depth0 li .mega-menu-title' => 'color: {{VALUE}};',
                    ],
                ]
            ); 
            $this->add_control(
                'menu_mega_item_hov_color',
                [
                    'label' => esc_html__( 'Mega menu item hover color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .tx-mega-menu .mega-menu-item .depth0 li .depth1.standard.sub-menu li a:hover, {{WRAPPER}} .tx-mega-menu .mega-menu-item .depth0 li .depth1.sub-menu li a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            ); 
            $this->add_control(
                'menu_mega_separator_color',
                [
                    'label' => esc_html__( 'Mega menu separator color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .tx-mega-menu .mega-menu-item .depth0.sub-menu>li' => 'border-color: {{VALUE}};',
                    ],
                ]
            ); 
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'menu_mega_item_typo',
                    'selector'  => '{{WRAPPER}} .tx-mega-menu .mega-menu-item .depth0 li .mega-menu-title',
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'style_res_tab',
            [
                'label' => esc_html__( 'Resposive Style', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                
            ]
        );
        $this->add_control(
                'res_menu_info',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __( '<img src="'.TX_PLUGIN_URL . '/assets/img/mob.gif"><br><br>Select "Mobile" device to see the responsive menu. The responsive menu will show correctly on live page.', 'avas' ),
                    'separator'       => 'after',
                ]
            );
        $this->add_responsive_control(
            'menu_res_icon_color',
                [
                    'label' => esc_html__( 'Responsive menu hamburger icon color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                //    'devices' => [ 'mobile', 'tablet' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'selectors' => [
                        '{{WRAPPER}} .navbar-header .navbar-toggle i, {{WRAPPER}} .tx-res-menu-txt' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
            'menu_res_item_color',
                [
                    'label' => esc_html__( 'Responsive menu item color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                //    'devices' => [ 'mobile', 'tablet' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'selectors' => [
                        '{{WRAPPER}} .navbar-collapse>ul>li>a' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
            'menu_res_item_border_color',
                [
                    'label' => esc_html__( 'Responsive menu item border color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                //    'devices' => [ 'mobile', 'tablet' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'selectors' => [
                        '{{WRAPPER}} .navbar-collapse li' => 'border-color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
            'menu_res_sub_item_color',
                [
                    'label' => esc_html__( 'Responsive sub menu item color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                //    'devices' => [ 'mobile', 'tablet' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'selectors' => [
                        '{{WRAPPER}} .navbar-collapse>ul>li>ul>li>a, {{WRAPPER}} .navbar-collapse>ul>li>ul>li>ul>li>a, {{WRAPPER}} .navbar-collapse>ul>li>ul>li>ul>li>ul>li>a, {{WRAPPER}} .navbar-collapse>ul>li>ul>li>ul>li>ul>li>ul>li>a' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
            'menu_res_bg_color',
                [
                    'label' => esc_html__( 'Responsive menu background color', 'avas-core' ),
                    'type' => Controls_Manager::COLOR,
                //    'devices' => [ 'mobile', 'tablet' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'selectors' => [
                        '{{WRAPPER}} .navbar-nav' => 'background-color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'      => 'menu_res_item_typo',
                    'label'     => esc_html__( 'Responsive menu item typography', 'avas-core' ),
                    'selector'  => '{{WRAPPER}} .navbar-collapse>ul>li>a',
                ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'      => 'menu_res_sub_item_typo',
                    'label'     => esc_html__( 'Responsive sub menu item typography', 'avas-core' ),
                    'selector'  => '{{WRAPPER}} .navbar-collapse>ul>li>ul>li>a, {{WRAPPER}} .navbar-collapse>ul>li>ul>li>ul>li>a, {{WRAPPER}} .navbar-collapse>ul>li>ul>li>ul>li>ul>li>a, {{WRAPPER}} .navbar-collapse>ul>li>ul>li>ul>li>ul>li>ul>li>a',
                ]
        );
        $this->end_controls_section();
    }

	protected function render( ) {

        $available_menus = $this->get_available_menus();

        if ( ! $available_menus ) {
            return;
        }

        $settings = $this->get_settings();

        $des = array(
            'echo'                => false,
            'menu'                => $settings['menu'],
            'container_class'     => 'navbar-responsive-collapse',
            'menu_class'          => 'nav navbar-nav main-menu tx-mega-menu',
            'fallback_cb'         => '',
            'depth'               => 5,
            'menu_id'             => 'main-menu-' . $this->get_id(),
        );

        $res = array(
            'echo'                => false,
            'menu'                => $settings['menu'],
            'container'           => false,
            'menu_class'          => 'nav navbar-nav tx-res-menu',
            'fallback_cb'         => '',
            'depth'               => 5,
            'menu_id'             => 'main-menu-' . $this->get_id(),
        );

        $desktop_menu       = wp_nav_menu( $des );
        $responsive_menu    = wp_nav_menu( $res );

        if ( empty( $desktop_menu || $responsive_menu ) ) {
            return;
        }

        ?>

        <nav class="site-navigation">
            <div class="d-none d-sm-none d-md-block">
                <div class="site-nav-inner">
                    <?php echo sprintf( $desktop_menu ); ?>
                </div>
            </div>

            <div id="responsive-menu" class="d-md-none d-lg-none">
                <div class="navbar-header">
                    <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#avas-menu">
                      <span class="x"><i class="bi bi-list"></i></span> <span class="tx-res-menu-txt"><?php echo esc_html( $settings['res_menu_txt'] ); ?></span>
                    </button>
                </div><!-- /.navbar-header -->
                <div class="collapse navbar-collapse" id="avas-menu">
                    <?php echo sprintf( $responsive_menu); ?>
                </div>
            </div>
        </nav>



<?php    
    } // render()
}
