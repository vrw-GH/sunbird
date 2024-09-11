<?php
namespace AvasElements\Modules\PageTitle\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Border;
use elementor\Group_Control_Typography;
use elementor\Icons_Manager;
use elementor\Utils;

use AvasElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PageTitle extends Widget_Base {

	public function get_name() {
		return 'avas-page-title';
	}

	public function get_title() {
		return esc_html__( 'Avas Page Title', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-archive-title';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'title', 'heading', 'name', 'page title', 'post title', 'archive title' ];
	}
	
	protected function register_controls() {
		$this->start_controls_section(
			'pt_settings',
			[
				'label' => esc_html__( 'Settings', 'avas-core' ),
			]
		);
		
		$this->add_control(
            'pt_html_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h1',
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
		
		$this->add_responsive_control(
            'pt_alignment',
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
					'{{WRAPPER}} .tx-page-title'   => 'text-align: {{VALUE}};',
				],

            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
            'pt_styles',
            [
                'label'                 => esc_html__( 'Style', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'pt_color',
            [
                'label'     => esc_html__( 'Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-page-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pt_typo',
                'selector'  => '{{WRAPPER}} .tx-page-title',
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	?>

		<<?php echo esc_attr($settings['pt_html_tag']); ?> class="tx-page-title">
		<?php 
            if( !is_front_page() && !is_archive() ) :
                echo get_the_title();

            elseif ( is_archive() && !is_post_type_archive('product') ) :
                echo post_type_archive_title();
                echo single_term_title();
                echo get_the_author_meta('nickname');             

            elseif( is_post_type_archive('product') ) :
                echo woocommerce_page_title();

            endif;
        ?>
		</<?php echo esc_attr($settings['pt_html_tag']); ?>>
		
		
<?php } // render()

} // class
