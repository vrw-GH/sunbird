<?php
namespace AvasElements\Modules\Cart\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cart extends Widget_Base {

    public function get_name() {
        return 'avas-cart';
    }

    public function get_title() {
        return esc_html__( 'Avas Cart', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-cart';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }
    
	protected function register_controls() {
    if ( class_exists( 'WooCommerce' ) ) :
        $this->start_controls_section(
            'settings_sec',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
            'cart_icon_switch',
            [
                'label' => esc_html__( 'Cart Icon Library', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Enable', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'Disable', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'no',

            ]
        );
        $this->add_control(
            'cart_icon',
            [
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-shopping-cart',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'cart_icon_switch' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
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
                    '{{WRAPPER}} .tx-cart' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_settings',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'cart_icon_color',
            [
                'label' => esc_html__( 'Cart Icon Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cart' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'cart_icon_hov_color',
            [
                'label' => esc_html__( 'Cart Icon Hover Color', 'avas-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-cart:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'cart_icon_size',
                [
                    'label' => esc_html__( 'Cart Icon Size', 'avas-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 300,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-cart i' => 'font-size: {{SIZE}}px;',
                    ],
                ]
        );
        $this->add_control(
            'cart_count_size',
                [
                    'label' => esc_html__( 'Cart Item Count Size', 'avas-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 300,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-cart span' => 'font-size: {{SIZE}}px;',
                    ],
                ]
        );
        $this->add_control(
            'cart_count_position_y',
                [
                    'label' => esc_html__( 'Cart Item Count Position (Y)', 'avas-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-cart span' => 'top: {{SIZE}}px;',
                    ],
                ]
        );
        $this->add_control(
            'cart_count_position_x',
                [
                    'label' => esc_html__( 'Cart Item Count Position (X)', 'avas-core' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-cart span' => 'left: {{SIZE}}px;',
                    ],
                ]
        );

        $this->end_controls_section();
    endif;
    }

	protected function render( ) {
       if ( class_exists( 'WooCommerce' ) ) :
        $settings = $this->get_settings();

        global $woocommerce;
        if( 'yes'=== $settings['cart_icon_switch'] ) :

    ?>
    <a class="tx-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
        <?php Icons_Manager::render_icon( $settings['cart_icon'], [ 'aria-hidden' => 'true' ] ); ?> <span><?php echo esc_attr( $woocommerce->cart->cart_contents_count ); ?></span>
        
    </a>

    <?php else: ?>
    <a class="tx-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
        <i class="bi bi-bag"></i> <span><?php echo esc_attr( $woocommerce->cart->cart_contents_count ); ?></span>
    </a>

           
<?php    
endif;
else: 
        echo '<h4 class="text-align-center">' . esc_html__( 'Please install and activate WooCoommerce plugin', 'avas-core' ) . '</h4>';
        endif; // class WooCommerce
    } // render()
}
