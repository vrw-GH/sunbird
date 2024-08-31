<?php
namespace AvasElements\Modules\Portfolio\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;

use AvasElements\TX_Load;
use AvasElements\TX_Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Portfolio extends Widget_Base {

    public function get_name() {
        return 'avas-portfolio';
    }

    public function get_title() {
        return esc_html__( 'Avas Portfolio', 'avas-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'avas-elements' ];
    }

    public function get_script_depends() {
        return [ 'tx-isotope', 'tx-magnific-popup', 'tx-imagesloaded' ];
    }

    public function get_style_depends() {
        return [ 'tx-magnific-popup' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            'settings',
            [
                'label' => esc_html__( 'Settings', 'avas-core' )
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Post Types', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__('If you could not see any Portfolio item then please add Portfolio via WordPress Dashboard > Portfolio > Add New Portfolio','avas-core'),
                'default' => 'portfolio',
                'options' => TX_Helper::get_all_post_types(),
            ]
        );
        $this->add_control(
            'portfolio_filter',
            [
                'label' => esc_html__( 'Category Filter', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'yes' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'portfolio_filter_all_text',
            [
                'label'   => esc_html__( 'Filter "All" text', 'avas-core' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => esc_html__( 'All', 'avas-core' ),
                'label_block' => true,
                'condition' => [
                       'portfolio_filter' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'tax_query',
            [
                'label' => esc_html__( 'Categories', 'avas-core' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => TX_Helper::get_all_categories(),
                'condition' => [
                       'portfolio_filter' => 'no'
                ]
            ]
        );
        $this->add_control(
            'display',
            [
                'label'     => esc_html__( 'Style', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid-h',
                'options'   => [
                        'masonry'    => esc_html__('Masonry','avas-core'),
                        'grid-h'    => esc_html__('Grid Horizontal','avas-core'),
                        'grid-v'    => esc_html__('Grid Vertical','avas-core'),
                        'card-h'    => esc_html__('Card Horizontal','avas-core'),
                        'card-v'    => esc_html__('Card Vertical','avas-core'),
                    ],
            ]
        );
        
        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
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
                'default' => '4',
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
            'effects',
            [
                'label' => esc_html__( 'Hover Effects', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'effects-1',
                'options' => [
                    'effects-0' => esc_html__( 'No Effect', 'avas-core' ),
                    'effects-1' => esc_html__( 'Effect 1', 'avas-core' ),
                    'effects-2' => esc_html__( 'Effect 2', 'avas-core' ),
                    'effects-3' => esc_html__( 'Effect 3', 'avas-core' ),
                    'effects-4' => esc_html__( 'Effect 4', 'avas-core' ),
                    
                ],
            ]
        );
        $this->add_responsive_control(
            'gap',
            [
                'label'     => esc_html__( 'Gap', 'avas-core' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units'  => [ 'px', 'em', '%' ],
                'selectors'   => [
                    '{{WRAPPER}} .tx-portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'ASC' => esc_html__('Ascending', 'avas-core'),
                    'DESC' => esc_html__('Descending', 'avas-core'),
                ),
                'default' => 'DESC',
            ]
        );
        $this->add_control(
            'post_sortby',
            [
                'label'     => esc_html__( 'Post sort by', 'avas-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'latestpost',
                'options'   => [
                        'latestpost'      => esc_html__( 'Latest posts', 'avas-core' ),
                        'popularposts'    => esc_html__( 'Popular posts', 'avas-core' ),
                        'mostdiscussed'    => esc_html__( 'Most discussed', 'avas-core' ),
                    ],
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'avas-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'none' => esc_html__('No order', 'avas-core'),
                    'ID' => esc_html__('Post ID', 'avas-core'),
                    'author' => esc_html__('Author', 'avas-core'),
                    'title' => esc_html__('Title', 'avas-core'),
                    'date' => esc_html__('Published date', 'avas-core'),
                    'modified' => esc_html__('Modified date', 'avas-core'),
                    'parent' => esc_html__('By parent', 'avas-core'),
                    'rand' => esc_html__('Random order', 'avas-core'),
                    'comment_count' => esc_html__('Comment count', 'avas-core'),
                    'menu_order' => esc_html__('Menu order', 'avas-core'),
                ),
                'default' => 'date',
                'condition' => [
                    'post_sortby' => ['latestpost'],
                ],
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => esc_html__( 'Number of Posts', 'avas-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
               
            ]
        );
        $this->add_control(
            'offset',
            [
              'label'         => esc_html__( 'Offset', 'avas-core' ),
              'type'          => Controls_Manager::NUMBER,
            ]
        );
        $this->add_control(
            'pagination',
            [
                'label' => esc_html__( 'Pagination', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'hide',
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show'
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__( 'Description', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show'
            ]
        );
        $this->add_control(
            'port_category',
            [
                'label' => esc_html__( 'Category', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show',
                
            ]
        );
        $this->add_control(
            'enlarge',
            [
                'label' => esc_html__( 'Popup Icon', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show',
                
            ]
        );
        $this->add_control(
            'popup',
            [
                'label' => esc_html__( 'Popup', 'avas-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no-content',
                'options' => [
                    'no-content' => esc_html__( 'Image Only', 'avas-core' ),
                    'content' => esc_html__( 'With Content',   'avas-core' ),
                ],
                 'condition' => [
                    'enlarge' => 'show',
                    
                ]
            ]
        );
        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link Icon', 'avas-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'show' => [
                        'title' => esc_html__( 'Yes', 'avas-core' ),
                        'icon' => 'eicon-check',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'No', 'avas-core' ),
                        'icon' => 'eicon-ban',
                    ]
                ],
                'default' => 'show',
               
            ]
        );
 
      $this->end_controls_section();

      // style section started
  		$this->start_controls_section(
  			'styles',
  			[
  				'label' 	=> esc_html__( 'Styles', 'avas-core' ),
  				'tab' 		=> Controls_Manager::TAB_STYLE,
  			]
  		);
      $this->add_control(
            'category_filter_color',
            [
                'label'     => esc_html__( 'Filter Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filters li' => 'color: {{VALUE}};',
                ],
                'condition' => [
                  'portfolio_filter' => 'yes'
                ]

            ]
      );
      $this->add_control(
            'category_filter_hover_color',
            [
                'label'     => esc_html__( 'Filter Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filters li:hover, {{WRAPPER}} .portfolio-filters li.active' => 'color: {{VALUE}};',
                ],
                'condition' => [
                  'portfolio_filter' => 'yes'
                ]

            ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'category_filter_typography',
                   'selector'  => '{{WRAPPER}} .portfolio-filters li',
                   'condition' => [
                      'portfolio_filter' => 'yes',
                    ],
              ]
      );
      $this->add_responsive_control(
      'category_filter_alignment',
      [
        'label' => esc_html__( 'Filter Alignment', 'avas-core' ),
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
          ]
        ],
        'selectors' => [
          '{{WRAPPER}} .portfolio-filter-wrap' => 'text-align: {{VALUE}};',
        ],
        'condition' => [
                      'portfolio_filter' => 'yes',
                    ],
      ]
    );
      $this->add_control(
            'overlay_bg_color',
            [
                'label'     => esc_html__( 'Overlay Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-overlay-content' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
                
            ]
      );
      $this->add_control(
            'overlay_border_color',
            [
                'label'     => esc_html__( 'Overlay Border Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-overlay:before, {{WRAPPER}} .tx-port-overlay:after' => 'border-color: {{VALUE}};',
                ],

            ]
      );
      $this->add_control(
            'card_bg_color',
            [
                'label'     => esc_html__( 'Card Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-card-content' => 'background-color: {{VALUE}};',
                ],

                'separator' => 'before',
            ]
      );
      $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__( 'Title Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-title a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title' => 'show',
                ],
            ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'title_typography',
                   'selector'  => '{{WRAPPER}} .tx-port-title',
                   'condition' => [
                      'title' => 'show',
                    ],
              ]
      );
      $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-excp' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'desc' => 'show',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'desc_typography',
                   'selector'  => '{{WRAPPER}} .tx-port-excp',
                   'separator' => 'after',
                   'condition' => [
                      'desc' => 'show',
                    ],
              ]
      );
        $this->add_control(
            'cat_color',
            [
                'label'     => esc_html__( 'Category Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-cat a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'port_category' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'cat_color_hover',
            [
                'label'     => esc_html__( 'Category Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-cat a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'port_category' => 'show',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'cat_typography',
                   'selector'  => '{{WRAPPER}} .tx-port-cat a',
                   'condition' => [
                      'port_category' => 'show',
                    ],
              ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'cat_border',
                'selector'    =>    '{{WRAPPER}} .tx-port-cat a',
                'condition' => [
                      'port_category' => 'show',
                    ],
            ]
        );
        $this->add_control(
            'enlarge_icon_color',
            [
                'label'     => esc_html__( 'Popup Icon Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-enlarge' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'enlarge' => 'show',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'enlarge_icon_c_color',
            [
                'label'     => esc_html__( 'Popup Icon Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-enlarge i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'enlarge' => 'show',
                ],

            ]
        );
        $this->add_control(
            'enlarge_icon_c_hov_color',
            [
                'label'     => esc_html__( 'Popup Icon Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-enlarge:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'enlarge' => 'show',
                ],

            ]
        );
        $this->add_control(
            'link_icon_color',
            [
                'label'     => esc_html__( 'Link Icon Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-link' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'link' => 'show',
                ],
                
            ]
        );
        $this->add_control(
            'link_icon_c_color',
            [
                'label'     => esc_html__( 'Link Icon Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-link i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'link' => 'show',
                ],
                
            ]
        );
        $this->add_control(
            'link_icon_c_hov_color',
            [
                'label'     => esc_html__( 'Link Icon Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-port-link:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'link' => 'show',
                ],
                
            ]
        );
      
      $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__( 'Pagination Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
                'separator' => 'before',
            ]
      );
      $this->add_control(
            'pagination_hover_color',
            [
                'label'     => esc_html__( 'Pagination Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_control(
            'pagination_current_color',
            [
                'label'     => esc_html__( 'Pagination Active Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li .current' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_control(
            'pagination_border_color',
            [
                'label'     => esc_html__( 'Pagination Border Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      
      $this->add_control(
            'pagination_hover_border_color',
            [
                'label'     => esc_html__( 'Pagination Hover Border Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_control(
            'pagination_bg_color',
            [
                'label'     => esc_html__( 'Pagination Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_control(
            'pagination_hover_bg_color',
            [
                'label'     => esc_html__( 'Pagination Hover Background Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets ul li:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'show',
                ],
            ]
      );
      $this->add_group_control(
            Group_Control_Typography::get_type(),
              [
                   'name'    => 'pagination_typography',
                   'selector'  => '{{WRAPPER}} .tx-pagination-widgets ul li',
                   'condition' => [
                      'pagination' => 'show',
                    ],
              ]
      );
       $this->add_responsive_control(
            'pagination_align',
            [
                'label' => esc_html__( 'Pagination Align', 'avas-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                      'pagination' => 'show',
                    ],
            ]
        );
        $this->add_responsive_control(
          'pagination_alignment',
          [
            'label' => esc_html__( 'Pagination Alignment', 'avas-core' ),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'center',
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
              ]
            ],
            'selectors' => [
              '{{WRAPPER}} .tx-pagination-widgets' => 'text-align: {{VALUE}};',
            ],
            'condition' => [
                          'pagination' => 'show',
                        ],
          ]
        );
      $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => esc_html__( 'Pagination Padding', 'avas-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-pagination-widgets' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                          'pagination' => 'show',
                        ],
            ]
        );
      
      $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
        $display = $settings['display'];
        $title = $settings['title'];
        $desc = $settings['desc'];
        $port_category = $settings['port_category'];
        $link = $settings['link'];
        $pagination = $settings['pagination'];
        $columns = $settings['columns'];
        $portfolio_filter = $settings['portfolio_filter'];
        $enlarge = $settings['enlarge'];
        $link = $settings['link'];
        $popup = $settings['popup'];
        $showposts = '';
		$post_types = $settings['post_type']; 
        $tax_queries = $settings['tax_query'];
        $offset = $settings['offset'];
        $number_of_posts = $settings['number_of_posts'];

        if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;
        
        $query_args = TX_Helper::setup_query_args($settings, $showposts);
        $queryd = new \WP_Query( $query_args );
        
?>

    <div class="tx-row">
    <?php if($portfolio_filter == 'yes') : ?>
    <div class="portfolio-filter-wrap">
        <ul class="portfolio-filters">
        <?php

        $taxonomies = get_object_taxonomies( $post_types, 'objects' );

        foreach( $taxonomies as $taxonomy ) {
           
            $terms = get_terms(array(
                'taxonomy' => $taxonomy->name,
                'hide_empty' => false,
            ));
        ?>
            <li class="active" data-filter="*"><?php echo esc_attr__($settings['portfolio_filter_all_text']); ?></li>
        <?php
            foreach( $terms as $term ) {
                $term_name = strtolower($term->name);
                $term_name = str_replace(' ', '-', $term_name);
                echo '<li  data-filter=".'.esc_attr($term_name).'">'.esc_attr($term->name).'</li>';

            }
        }
        ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="tx-portfolio">
    <?php
      if ($queryd->have_posts()) : while ($queryd->have_posts()) : $queryd->the_post();

        global $post;
        $taxonomies = get_object_taxonomies( $post_types, 'objects' );

        foreach( $taxonomies as $taxonomy ) {
   
        $terms = get_the_terms( $post->ID, $taxonomy->name );
        if ( $terms && ! is_wp_error( $terms ) ) :
          $taxonomy = array();
          foreach ( $terms as $term ) :
            $taxonomy[] = $term->name;
          endforeach;
          $cat_name = join( " ", str_replace(' ', '-', $taxonomy));
          $cat_link = get_term_link( $term );
          $cat = strtolower($cat_name);
        else :
          $cat = '';
        endif;

        }

       // if ( has_post_thumbnail() ) :
    ?>

    <div class="col-lg-<?php echo esc_attr($columns); ?> col-sm-<?php echo esc_attr( $settings['columns_tablet'] ); ?> <?php echo esc_attr( $settings['effects'] ); ?> tx-portfolio-item <?php echo esc_attr($cat); ?> <?php echo esc_attr($display); ?>">
        <div class="tx-port-overlay"> 
            <div class="tx-port-img">
              <?php
                $img_url = get_the_post_thumbnail_url(get_the_ID(), '');
                $img_h_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-h-thumb');
                $img_v_grid = get_the_post_thumbnail_url(get_the_ID(), 'tx-port-grid-v-thumb');
              ?>
              <?php if($display == 'masonry') : ?>
                <img src="<?php echo esc_attr($img_url); ?>" alt="<?php the_title(); ?>" >
              <?php endif; ?>
                
              <?php if('grid-h' === $display || 'card-h' === $display) : ?>
                <img src="<?php echo esc_attr($img_h_grid); ?>" alt="<?php the_title(); ?>" >
              <?php endif; ?>
              
              <?php if('grid-v' === $display || 'card-v' === $display ) : ?>
                <img src="<?php echo esc_attr($img_v_grid); ?>" alt="<?php the_title(); ?>" >
              <?php endif; ?>
                
            </div><!-- /.tx-port-img -->
            
            <div class="tx-port-overlay-content">
                <div class="tx-port-overlay-content-wrap">

                <?php if('masonry' === $display || 'grid-v' === $display || 'grid-h' === $display): ?>
                    <?php if( !empty($cat) && 'show' === $port_category ) : ?>
                      <div class="tx-port-cat">
                        <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_attr($cat); ?></a>
                      </div><!-- /.tx-port-cat -->
                    <?php endif; ?>  

                <?php if('show' === $title ) : ?>
                  <h4 class="tx-port-title"><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
                <?php endif; ?>
                
                <?php if('show' === $desc) : ?>
                  <p class="tx-port-excp"><?php echo esc_html(tx_excerpt_limit(5)); ?></p>  
                <?php endif; ?>
                <?php endif; ?>
                <div class="tx-port-enlrg-link">
                  <?php if('show' === $enlarge) : ?>
                    <a class="tx-port-enlarge" href="#item-<?php echo get_the_id(); ?>" data-effect="mfp-zoom-in"><i class="bi bi-search"></i></a>
                  <?php endif; ?>

                  <?php if('show' === $link) : ?>
                    <a class="tx-port-link" href="<?php echo get_the_permalink(); ?>"><i class="bi bi-link-45deg"></i></a>
                  <?php endif; ?>                
                </div><!-- ./tx-port-enlrg-link -->

                </div><!-- tx-port-overlay-content-wrap -->

            </div><!-- /.tx-port-overlay-content -->

        </div><!-- ./tx-port-overlay -->

            <?php $img_enlarge = get_the_post_thumbnail(get_the_ID(), 'full'); ?>

            <?php if($popup == 'no-content') : ?>
                <div id="item-<?php echo get_the_id(); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
                  <?php echo wp_sprintf($img_enlarge); ?>
                </div><!-- /.tx-port-enlrg-content -->
            <?php endif; ?>      

            <?php if($popup == 'content') : ?>  
                <div id="item-<?php echo get_the_id(); ?>" class="tx-port-enlrg-content mfp-hide mfp-with-anim">
                  <div class="tx-port-enlrg-content-left">
                    <?php echo wp_sprintf($img_enlarge); ?>
                  </div><!-- /.tx-port-enlrg-content-left -->

                  <div class="tx-port-enlrg-content-right">
                    <h3 class="tx-port-enlrg-content-title"><?php echo esc_html(the_title());?></h3>
                    <p><?php echo wp_sprintf(tx_content(75)); ?></p>
                  </div><!-- /.tx-port-enlrg-content-right -->
                </div><!-- /.tx-port-enlrg-content -->
            <?php endif; ?>
            <?php if('card-h' === $display || 'card-v' === $display): ?>
            <div class="tx-port-card-content">
                <?php if( !empty($cat) && 'show' === $port_category ) : ?>
                      <div class="tx-port-cat">
                        <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_attr($cat); ?></a>
                      </div><!-- /.tx-port-cat -->
                    <?php endif; ?>
                <?php if('show' === $title ) : ?>
                  <h4 class="tx-port-title"><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
                <?php endif; ?>
                
                <?php if('show' === $desc) : ?>
                  <p class="tx-port-excp"><?php echo esc_html(tx_excerpt_limit(5)); ?></p>  
                <?php endif; ?>
            </div><!-- tx-port-card-content -->
            <?php endif; ?>
        </div><!-- /.tx-portfolio-item -->

        <?php
         //   endif;
          endwhile;
        ?>
        
        <?php
          else:  
          get_template_part('template-parts/content/content', 'none');
          endif;
        ?>
        </div><!-- /.tx-portfolio -->
    <?php
      if($pagination == 'show') :
    ?>  
            <div class="tx-pagination-widgets">
            <?php
            $page_tot = ceil(($queryd->found_posts - (int)$offset) / (int)$number_of_posts);
            if ( $page_tot > 1 ) {
            $big = 999999999;
            echo paginate_links( array(
                  'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ),
                  'format'    => '?paged=%#%',
                  'current'   => max( 1, $paged ),
                  'total'     => ceil(($queryd->found_posts - (int)$offset) / (int)$number_of_posts),
                  'prev_next' => true,
                    'prev_text'    => esc_html__( 'Prev', 'avas-core' ),
                    'next_text'    => esc_html__( 'Next', 'avas-core' ),
                  'end_size'  => 1,
                  'mid_size'  => 2,
                  'type'      => 'list'
                    )
                );
            }
            ?>
            </div><!-- /.tx-pagination-widgets -->
    <?php endif; ?>
  <?php
    wp_reset_postdata();
  ?>

    <div class="clearfix"></div>
</div> <!-- ./tx-row -->


<?php

	} // function render()
} // class Portfolio
