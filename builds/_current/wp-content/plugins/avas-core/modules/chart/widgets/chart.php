<?php
namespace AvasElements\Modules\Chart\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\REPEATER;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Chart extends Widget_Base {

    public function get_name() {
        return 'avas-chart';
    }

    public function get_title() {
        return esc_html__( 'Avas Chart', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-text-align-left';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_keywords() {
        return [
            'chart',
            'bar',
            'graph',
            'pie',
            'area',
            'line',
        ];
    }
    
	public function get_script_depends() {
        return [ 'tx-chart','chart' ];
    }

    protected function register_controls() {
       
        $this->start_controls_section(
            'tx_chart_settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );

        $this->add_control(
            'tx_chart_type',
            [
                'label'             => esc_html__( 'Type', 'avas-core' ),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'bar',
                'options'           => [
                    'bar'           => esc_html__( 'Vertical Bar', 'avas-core' ),
                    'horizontalBar' => esc_html__( 'Horozontal Bar', 'avas-core' ),
                    'pie'           => esc_html__( 'Pie', 'avas-core' ),
                    'line'          => esc_html__( 'Line', 'avas-core' ),
                    'radar'         => esc_html__( 'Radar', 'avas-core' ),
                ]
            ]
        );

        $this->add_control(
            'tx_chart_enable_grid_lines',
            [
                'label'   => esc_html__( 'Enable Grid Lines', 'avas-core' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'tx_chart_enable_labels',
            [
                'label'   => esc_html__( 'Enable Labels', 'avas-core' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'tx_chart_enable_legend',
            [
                'label'   => esc_html__( 'Enable Legends', 'avas-core' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'tx_chart_enable_tooltip',
            [
                'label'   => esc_html__( 'Enable Tooltip', 'avas-core' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_chart_heading',
            [
                'label' => esc_html__( 'Labels', 'avas-core' )
            ]
        );

        $chart_label_repeater = new Repeater();

        $chart_label_repeater->add_control(
            'tx_chart_label_name', 
            [
                'label'       => esc_html__( 'Label Name', 'avas-core' ),
                'default'     => 2000,
                'type'        => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $this->add_control(
            'tx_chart_labels',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'    => $chart_label_repeater->get_controls(),
                'default' => [
                    [ 'tx_chart_label_name' => '2017' ],
                    [ 'tx_chart_label_name' => '2018' ],
                    [ 'tx_chart_label_name' => '2019' ],
                    [ 'tx_chart_label_name' => '2020' ],
                    [ 'tx_chart_label_name' => '2021' ],
                ],
                'title_field' => '{{tx_chart_label_name}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_datasets_content',
            [
                'label'     => esc_html__( 'Datasets', 'avas-core' ),
                'condition' => [
                    'tx_chart_type!' => [ 'pie' ]
                ]
            ]
        );

        $chart_repeater = new Repeater();

        $chart_repeater->add_control(
            'label', 
            [
                'label'       => esc_html__( 'Label', 'avas-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Dataset Label', 'avas-core' ),
                'label_block' => true
            ]
        );

        $chart_repeater->add_control(
            'data', 
            [
                'label'       => esc_html__( 'Data', 'avas-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( '2; 4; 8; 16; 32', 'avas-core' ),
                'description' => esc_html__( 'Enter data values by semicolon separated(;). Example: 2; 4; 8; 16; 32 etc', 'avas-core' )
            ]
        );

        $chart_repeater->add_control(
            'advanced_bg_color', 
            [
                'label'       => esc_html__( 'Advanced Background Color', 'avas-core' ),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'no'
            ]
        );

        $chart_repeater->add_control(
            'bg_color', 
            [
                'label'       => esc_html__( 'Background Color', 'avas-core' ),
                'label_block' => true,
                'default'     => 'rgba(122,86,255,0.5)',
                'type'        => Controls_Manager::COLOR,
                'condition'   => [
                    'advanced_bg_color!' => 'yes'
                ]
            ]
        );

        $chart_repeater->add_control(
            'tx_chart_individual_bg_colors', 
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Background Colors', 'avas-core' ),
                'label_block' => true,
                'description' => esc_html__( 'Write multiple color values by semicolon separated(;). Example: #000000; #ffffff; #cccccc; etc. N.B: it will not work for line, radar charts', 'avas-core' ),
                'condition'   => [
                    'advanced_bg_color' => 'yes'
                ]
            ]
        );

        $chart_repeater->add_control(
            'advanced_border_color', 
            [
                'label'       => esc_html__( 'Advanced Border Color', 'avas-core' ),
                'separator'   => 'before',
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'no'
            ]
        );

        $chart_repeater->add_control(
            'border_color', 
            [
                'label'       => esc_html__( 'Border Color', 'avas-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::COLOR,
                'condition'   => [
                    'advanced_border_color!' => 'yes'
                ]
            ]
        );

        $chart_repeater->add_control(
            'border_colors', 
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Border Colors', 'avas-core' ),
                'label_block' => true,
                'description' => esc_html__( 'Write multiple color values by semicolon separated(;). Example: #000000; #ffffff; #cccccc; etc. N.B: it will not work for line, radar charts', 'avas-core' ),
                'condition'   => [
                    'advanced_border_color' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_chart_datasets',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'    => $chart_repeater->get_controls(),
                'default' => [
                    [
                        'label'     => esc_html__( 'Dataset Label #1', 'avas-core' ),
                        'data'      => esc_html__( '2; 4; 6; 8; 10', 'avas-core' ),
                        'bg_color'  => 'rgba(122,86,255,0.5)',
                        'tx_chart_individual_bg_colors' => 'rgba(122,86,255,0.5); rgba(0,216,216,0.50); rgba(205,0,234,0.50); rgba(142,36,170,0.5); rgba(63,81,181,0.5)'
                    ],
                    [
                        'label'     => esc_html__( 'Dataset Label #2', 'avas-core' ),
                        'data'      => esc_html__( '4; 8; 12; 16; 20', 'avas-core' ),
                        'bg_color'  => 'rgba(0,216,216,0.50)',
                        'tx_chart_individual_bg_colors' => 'rgba(63,81,181,0.5); rgba(142,36,170,0.5); rgba(205,0,234,0.50); rgba(0,216,216,0.50); rgba(122,86,255,0.5)'
                    ],
                    [
                        'label'     => esc_html__( 'Dataset Label #3', 'avas-core' ),
                        'data'      => esc_html__( '23; 18; 13; 8; 3', 'avas-core' ),
                        'bg_color'  => 'rgba(142,36,170,0.5)',
                        'tx_chart_individual_bg_colors' => 'rgba(122,86,255,0.5); rgba(0,216,216,0.50); rgba(205,0,234,0.50); rgba(142,36,170,0.5); rgba(63,81,181,0.5)'
                    ],
                    [
                        'label'     => esc_html__( 'Dataset Label #4', 'avas-core' ),
                        'data'      => esc_html__( '10; 15; 20; 5; 10', 'avas-core' ),
                        'bg_color'  => 'rgba(205,0,234,0.50)',
                        'tx_chart_individual_bg_colors' => 'rgba(63,81,181,0.5); rgba(142,36,170,0.5); rgba(205,0,234,0.50); rgba(0,216,216,0.50); rgba(122,86,255,0.5)'
                    ],
                    [
                        'label'     => esc_html__( 'Dataset Label #5', 'avas-core' ),
                        'data'      => esc_html__( '5; 15; 25; 10; 20', 'avas-core' ),
                        'bg_color'  => 'rgba(63,81,181,0.5)',
                        'tx_chart_individual_bg_colors' => 'rgba(122,86,255,0.5); rgba(0,216,216,0.50); rgba(205,0,234,0.50); rgba(142,36,170,0.5); rgba(63,81,181,0.5)'
                    ]
                ],
                'title_field' => '{{{ label }}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_data_chart_for_and_pie',
            [
                'label'     => esc_html__( 'Datasets', 'avas-core' ),
                'condition' => [
                    'tx_chart_type' => ['pie']
                ]
            ]
        );

        $this->add_control(
            'single_label',
            [
                'label'       => esc_html__( 'Label', 'avas-core' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'default'     => esc_html__( 'Polar Dataset Label', 'avas-core' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'single_datasets',
            [
                'label'       => esc_html__( 'Data', 'avas-core' ),
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
                'type'        => Controls_Manager::TEXT,
                'default'     => '5; 10; 15; 20; 30',
                'description' => esc_html__( 'Enter data values by semicolon separated(;). Example: 10; 20; 30; 40; 50 etc', 'avas-core' )
            ]
        );

        $this->add_control(
            'single_bg_colors',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Background Colors', 'avas-core' ),
                'label_block' => true,
                'default'     => 'rgba(122,86,255,0.5); rgba(0,216,216,0.50); rgba(205,0,234,0.50); rgba(142,36,170,0.5); rgba(63,81,181,0.5)',
                'description' => esc_html__( 'Write multiple color values by semicolon separated(;). Example: #000000; #ffffff; #cccccc; etc. N.B: it will not work for line, radar charts', 'avas-core' )
            ]
        );

        $this->add_control(
            'single_border_colors',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Border Colors', 'avas-core' ),
                'label_block' => true,
                'description' => esc_html__( 'Write multiple color values by semicolon separated(;). Example: #000000; #ffffff; #cccccc; etc. N.B: it will not work for line, radar charts.', 'avas-core' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tx_chart_style_section',
            [
                'label' => esc_html__( 'Style', 'avas-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );


        $this->add_responsive_control(
            'tx_chart_legend_align',
            [
                'label'         => esc_html__( 'Alignment', 'avas-core' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon'  => 'eicon-arrow-left'
                    ],
                    'top'       => [
                        'title' => esc_html__( 'Top', 'avas-core' ),
                        'icon'  => 'eicon-arrow-up'
                    ],
                    'bottom'    => [
                        'title' => esc_html__( 'Bottom', 'avas-core' ),
                        'icon'  => 'eicon-arrow-down'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon'  => 'eicon-arrow-right'
                    ],
                ],
                'condition'     => [
                    'tx_chart_enable_legend' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_chart_border_width',
            [
                'label'    => esc_html__( 'Border Width', 'avas-core' ),
                'type'     => Controls_Manager::SLIDER,
                'default'  => [
                    'size' => 0
                ]
            ]
        );

        $this->add_control(
            'tx_chart_grid_color',
            [
                'label'     => esc_html__( 'Grid Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0,0,0,0.05)',
                'condition' => [
                    'tx_chart_enable_grid_lines' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tx_chart_tooltip_background_color',
            [
                'label'     => esc_html__( 'Tooltip Background Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'tx_chart_enable_tooltip' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings          = $this->get_settings_for_display();
        $labels            = array_column( $settings['tx_chart_labels'], 'tx_chart_label_name' );
        $tx_all_datasets = $tx_chart_datasets = $tx_chart_settings_options = [];

        if ( 'pie' === $settings['tx_chart_type'] ) :
            $single_data = array_map( 'intval', explode( ';', $settings['single_datasets'] ) );

            $tx_all_datasets[] = [ 'data' => $single_data, 'backgroundColor' => explode( ';', $settings['single_bg_colors'] ) ];

            if ( $settings['single_border_colors'] ) :
                $tx_all_datasets[] = [ 'data' => $single_data, 'borderColor' => explode( ';', $settings['single_border_colors'] ) ];
            endif;
            $tx_all_datasets[] = [ 'data' => $single_data, 'borderWidth' => $settings['tx_chart_border_width']['size'] ];

        else :
            foreach ( $settings['tx_chart_datasets'] as $dataset ) :

                $tx_chart_datasets['label'] = $dataset['label'];
                $tx_chart_datasets['data']  =  array_map( 'intval', explode(';', $dataset['data'] ) );                

                if ( 'yes' === $dataset['advanced_bg_color'] && '' !== $dataset['tx_chart_individual_bg_colors'] ) :
                    $tx_chart_datasets['backgroundColor'] = explode( '; ', $dataset['tx_chart_individual_bg_colors'] );
                else :
                    $tx_chart_datasets['backgroundColor'] = $dataset['bg_color'];
                endif;

                if ( 'yes' === $dataset['advanced_border_color'] && '' !== $dataset['border_colors'] ) :
                    $tx_chart_datasets['borderColor'] = explode( ';', $dataset['border_colors'] );
                else :
                    $tx_chart_datasets['borderColor'] = $dataset['border_color'];
                endif;

                $tx_chart_datasets['borderWidth'] = $settings['tx_chart_border_width']['size'];             
                $tx_all_datasets[] = $tx_chart_datasets;

            endforeach;
        endif;

        if ( $settings['tx_chart_enable_tooltip'] ) :
            if ( $settings['tx_chart_tooltip_background_color'] ) :
                $tx_chart_settings_options['tooltips']  = [ 
                    'backgroundColor' => $settings['tx_chart_tooltip_background_color'],
                ];
            endif;
        else :
            $tx_chart_settings_options['tooltips'] = [ 'enabled' => false ];
        endif;

        if ( $settings['tx_chart_enable_legend'] ) :
            if ( $settings['tx_chart_legend_align'] ) :
                $tx_chart_settings_options['legend'] = [ 'position' => $settings['tx_chart_legend_align'] ];
            endif;
        else :
            $tx_chart_settings_options['legend'] = [ 'display' => false ];
        endif;

        if ( 'pie' !== $settings['tx_chart_type'] ) :
            if ( $settings['tx_chart_enable_grid_lines'] ) :
                $tx_chart_settings_options['scales'] = [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'display' => ( $settings['tx_chart_enable_labels'] ) ? true : false
                        ],
                            'gridLines' => [
                                'drawBorder' => false,
                                'color' => $settings['tx_chart_grid_color']
                            ]
                        ]
                    ],
                    'xAxes' => [
                        [
                            'ticks' => [
                                'display' => ( $settings['tx_chart_enable_labels'] ) ? true : false
                            ],
                            'gridLines' => [
                                'drawBorder' => false,
                                'color' => $settings['tx_chart_grid_color']
                            ]
                        ]
                    ]
                ];
            else :
                $tx_chart_settings_options['scales'] = [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'display' => ( $settings['tx_chart_enable_labels'] ) ? true : false
                            ],
                            'gridLines' => [
                                'display' => false
                            ]
                        ]
                    ],
                    'xAxes' => [
                        [
                            'ticks' => [
                                'display' => ( $settings['tx_chart_enable_labels'] ) ? true : false
                            ],
                            'gridLines' => [
                                'display' => false
                            ]
                        ]
                    ]
                ];
            endif;
        endif;

        $this->add_render_attribute( 
            'tx_chart_wrapper', 
            [ 
                'class'                => 'tx-chart-wrapper',
                'data-settings'        => [
                    wp_json_encode( array_filter( [
                        'type'         => $settings['tx_chart_type'],
                        'data'         => [
                            'labels'   => $labels,
                            'datasets' => $tx_all_datasets
                        ],
                        'options'      => $tx_chart_settings_options
                    ] ) )                           
                ]
            ]
        );

        $this->add_render_attribute( 
            'tx_chart_canvas', 
            [ 
                'class' => 'tx-chart-widget',
                'id'    => 'tx-chart-' . $this->get_id()
            ]
        );
        ?>

        <div <?php echo $this->get_render_attribute_string( 'tx_chart_wrapper' ); ?>>
            <canvas <?php echo $this->get_render_attribute_string( 'tx_chart_canvas' ); ?>></canvas>
        </div>
        
    <?php
    }
}