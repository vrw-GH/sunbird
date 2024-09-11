<?php
namespace AvasElements\Modules\Breadcrumbs\Widgets;

use elementor\Widget_Base;
use elementor\Controls_Manager;
use elementor\Group_Control_Typography;
use elementor\Icons_Manager;
use elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Breadcrumbs extends Widget_Base {

	public function get_name() {
		return 'avas-breadcrumbs';
	}

	public function get_title() {
		return esc_html__( 'Avas Breadcrumbs', 'avas-core' );
	}

	public function get_icon() {
		return 'eicon-product-breadcrumbs';
	}

	public function get_categories() {
		return [ 'avas-elements' ];
	}

	public function get_keywords() {
		return [ 'breadcrumbs' ];
	}
	
	protected function register_controls() {
		$this->start_controls_section(
			'brc_settings',
			[
				'label' => esc_html__( 'Settings', 'avas-core' ),
			]
		);
        $this->add_control(
            'home_text',
            [
                'label'     => esc_html__( 'Home Text', 'avas-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Home', 'avas-core' ),
                'dynamic'   => [
                    'active'     => true,
                ],
            ]
        );

        $this->add_control(
            'select_home_icon',
            [
                'label'            => esc_html__( 'Home Icon', 'avas-core' ),
                'type'             => Controls_Manager::ICONS,
                'label_block'      => false,
                'skin'             => 'inline',
                'default'          => [
                    'value'   => 'fas fa-home',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'blog_text',
            [
                'label'     => esc_html__( 'Blog Text', 'avas-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Blog', 'avas-core' ),
                'dynamic'   => [
                    'active'     => true,
                ],

            ]
        );
        $this->add_control(
            'separator_type',
            array(
                'label'     => __( 'Separator Type', 'powerpack' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'icon',
                'options'   => array(
                    'text' => __( 'Text', 'powerpack' ),
                    'icon' => __( 'Icon', 'powerpack' ),
                ),
                'condition' => array(
                    'breadcrumbs_type' => 'powerpack',
                ),
            )
        );
        $this->add_control(
            'separator_text',
            array(
                'label'     => __( 'Separator', 'powerpack' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( '>', 'powerpack' ),
                'condition' => array(
                    'breadcrumbs_type' => 'powerpack',
                    'separator_type'   => 'text',
                ),
            )
        );
        $this->add_control(
            'select_separator_icon',
            [
                'label'            => esc_html__( 'Separator', 'avas-core' ),
                'type'             => Controls_Manager::ICONS,
                'label_block'      => false,
                'skin'             => 'inline',
                'default'          => [
                    'value'   => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'recommended'      => [
                    'fa-regular' => [
                        'circle',
                        'square',
                        'window-minimize',
                    ],
                    'fa-solid'   => [
                        'angle-right',
                        'angle-double-right',
                        'caret-right',
                        'chevron-right',
                        'bullseye',
                        'circle',
                        'dot-circle',
                        'genderless',
                        'greater-than',
                        'grip-lines',
                        'grip-lines-vertical',
                        'minus',
                    ],
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label'                => esc_html__( 'Alignment', 'avas-core' ),
                'type'                 => Controls_Manager::CHOOSE,
                'default'              => 'center',
                'options'              => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'avas-core' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'avas-core' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'avas-core' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors_dictionary' => [
                    'left'   => 'flex-start',
                    'center' => 'center',
                    'right'  => 'flex-end',
                ],
                
                'selectors'            => [
                    '{{WRAPPER}} .tx-breadcrumbs' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            'brc_styles',
            [
                'label'                 => esc_html__( 'Style', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'tabs_breadcrumbs_style' );

        $this->start_controls_tab(
            'brc_tab_normal',
            [
                'label' => esc_html__( 'Normal', 'avas-core' ),
            ]
        );

        $this->add_control(
            'brc_item_color',
            [
                'label'     => esc_html__( 'Item Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tx-breadcrumbs-item, {{WRAPPER}} .tx-breadcrumbs-item a, {{WRAPPER}} .tx-breadcrumbs-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tx-breadcrumbs-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'brc_item_typography',
                'label'    => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-breadcrumbs-item, {{WRAPPER}} .tx-breadcrumbs-separator-icon',
            ]
        );
        $this->add_control(
            'brc_item_svg_size',
            [
                'label'     => esc_html__( 'SVG Icon Size', 'avas-core' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '',
                ],
                'range'     => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-breadcrumbs-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'brc_tab_hover',
            [
                'label' => esc_html__( 'Hover', 'avas-core' ),
            ]
        );
        $this->add_control(
            'brc_item_hov_color',
            [
                'label'     => esc_html__( 'Item Hover Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tx-breadcrumbs-item:hover a, {{WRAPPER}} .tx-breadcrumbs-item:hover span, {{WRAPPER}} .tx-breadcrumbs-item:hover .tx-breadcrumbs-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tx-breadcrumbs-item:hover .tx-breadcrumbs-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'brc_tab_current',
            [
                'label' => esc_html__( 'Current', 'avas-core' ),
            ]
        );
        $this->add_control(
            'brc_current_item_color',
            [
                'label'     => esc_html__( 'Current Item Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tx-breadcrumbs-item-current' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'brc_current_item_typography',
                'label'    => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-breadcrumbs-item-current',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'brc_separators',
            [
                'label'                 => esc_html__( 'Separator', 'avas-core' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'brc_item_gap',
            [
                'label'     => esc_html__( 'Separator Gap', 'avas-core' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '',
                ],
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-breadcrumbs-separator' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'brc_separator_icon_color',
            [
                'label'     => esc_html__( 'Separator Color', 'avas-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tx-breadcrumbs-separator-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tx-breadcrumbs-separator-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'brc_separator_typography',
                'label'    => esc_html__( 'Typography', 'avas-core' ),
                'selector' => '{{WRAPPER}} .tx-breadcrumbs-separator',
            ]
        );
        $this->add_control(
            'brc_separator_svg_size',
            [
                'label'     => esc_html__( 'SVG Icon Size', 'avas-core' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '',
                ],
                'range'     => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tx-breadcrumbs-separator-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tx-breadcrumbs-separator-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
	}

        protected function render_breadcrumbs( $query = false ) {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'breadcrumbs', 'class', array( 'tx-breadcrumbs', 'tx-breadcrumbs-powerpack' ) );
        $this->add_render_attribute( 'breadcrumbs-item', 'class', 'tx-breadcrumbs-item' );

        // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
        $custom_taxonomy = 'product_cat';

        // Get the query & post information
        global $post, $wp_query;

        if ( false === $query ) {
            // Reset post data to parent query
            $wp_query->reset_postdata();

            // Set active query to native query
            $query = $wp_query;
        }

        // Do not display on the homepage
        if ( ! $query->is_front_page() ) {

            // Build the breadcrums
            echo '<ul ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs' ) ) . '>';

            // Home page
          if( !empty($settings['home_text']) ) :
                $this->render_home_link();
            endif;

            if ( $query->is_archive() && ! $query->is_tax() && ! $query->is_category() && ! $query->is_tag() ) {

                $this->add_render_attribute(
                    'breadcrumbs-item-archive',
                    'class',
                    array(
                        'tx-breadcrumbs-item',
                        'tx-breadcrumbs-item-current',
                        'tx-breadcrumbs-item-archive',
                    )
                );

                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-archive' ) ) . '><strong class="bread-current bread-archive">' . post_type_archive_title( '', false ) . '</strong></li>';

            } elseif ( $query->is_archive() && $query->is_tax() && ! $query->is_category() && ! $query->is_tag() ) {

                // If post is a custom post type
                $post_type = get_post_type();

                // If it is a custom post type display name and link
                if ( 'post' !== $post_type ) {

                    $post_type_object  = get_post_type_object( $post_type );
                    $post_type_archive = get_post_type_archive_link( $post_type );

                    $this->add_render_attribute(
                        array(
                            'breadcrumbs-item-cpt'       => array(
                                'class' => array(
                                    'tx-breadcrumbs-item',
                                    'tx-breadcrumbs-item-cat',
                                    'tx-breadcrumbs-item-custom-post-type-' . $post_type,
                                ),
                            ),
                            'breadcrumbs-item-cpt-crumb' => array(
                                'class' => array(
                                    'tx-breadcrumbs-crumb',
                                    'tx-breadcrumbs-crumb-link',
                                    'tx-breadcrumbs-crumb-cat',
                                    'tx-breadcrumbs-crumb-custom-post-type-' . $post_type,
                                ),
                                'href'  => $post_type_archive,
                                'title' => $post_type_object->labels->name,
                            ),
                        )
                    );

                    echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-cpt' ) ) . '><a ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-cpt-crumb' ) ) . '>' . esc_attr( $post_type_object->labels->name ) . '</a></li>';

                    $this->render_separator();

                }

                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-tax'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                                'tx-breadcrumbs-item-archive',
                            ),
                        ),
                        'breadcrumbs-item-tax-crumb' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-current',
                            ),
                        ),
                    )
                );

                $custom_tax_name = get_queried_object()->name;

                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-tax' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-tax-crumb' ) ) . '>' . esc_attr( $custom_tax_name ) . '</strong></li>';

            } elseif ( $query->is_single() ) {

                // If post is a custom post type
                $post_type = get_post_type();

                // If it is a custom post type display name and link
                if ( 'post' !== $post_type ) {

                    $post_type_object  = get_post_type_object( $post_type );
                    $post_type_archive = get_post_type_archive_link( $post_type );

                    $this->add_render_attribute(
                        array(
                            'breadcrumbs-item-cpt'       => array(
                                'class' => array(
                                    'tx-breadcrumbs-item',
                                    'tx-breadcrumbs-item-cat',
                                    'tx-breadcrumbs-item-custom-post-type-' . $post_type,
                                ),
                            ),
                            'breadcrumbs-item-cpt-crumb' => array(
                                'class' => array(
                                    'tx-breadcrumbs-crumb',
                                    'tx-breadcrumbs-crumb-link',
                                    'tx-breadcrumbs-crumb-cat',
                                    'tx-breadcrumbs-crumb-custom-post-type-' . $post_type,
                                ),
                                'href'  => $post_type_archive,
                                'title' => $post_type_object->labels->name,
                            ),
                        )
                    );

                    echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-cpt' ) ) . '><a ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-cpt-crumb' ) ) . '>' . esc_attr( $post_type_object->labels->name ) . '</a></li>';

                    $this->render_separator();

                }

                // Get post category info
                $category = get_the_category();

                if ( ! empty( $category ) ) {

                    // Get last category post is in
                    $values = array_values( $category );

                    $last_category = reset( $values );

                    $categories      = array();
                    $get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
                    $cat_parents     = explode( ',', $get_cat_parents );
                    foreach ( $cat_parents as $parent ) {
                        $categories[] = get_term_by( 'name', $parent, 'category' );
                    }

                    // Loop through parent categories and store in variable $cat_display
                    $cat_display = '';

                    foreach ( $categories as $parent ) {
                        if ( ! is_wp_error( get_term_link( $parent ) ) ) {
                            $cat_display .= '<li class="tx-breadcrumbs-item tx-breadcrumbs-item-cat"><a class="tx-breadcrumbs-crumb tx-breadcrumbs-crumb-link tx-breadcrumbs-crumb-cat" href="' . get_term_link( $parent ) . '">' . $parent->name . '</a></li>';
                            $cat_display .= $this->render_separator( false );
                        }
                    }
                }

                // If it's a custom post type within a custom taxonomy
                $taxonomy_exists = taxonomy_exists( $custom_taxonomy );
                $taxonomy_terms = array();

                if ( empty( $last_category ) && ! empty( $custom_taxonomy ) && $taxonomy_exists ) {
                    $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                }

                // Check if the post is in a category
                if ( ! empty( $last_category ) ) {
                    echo wp_kses_post( $cat_display );

                    $this->add_render_attribute(
                        array(
                            'breadcrumbs-item-post-cat' => array(
                                'class' => array(
                                    'tx-breadcrumbs-item',
                                    'tx-breadcrumbs-item-current',
                                    'tx-breadcrumbs-item-' . $post->ID,
                                ),
                            ),
                            'breadcrumbs-item-post-cat-bread' => array(
                                'class' => array(
                                    'tx-breadcrumbs-crumb',
                                    'tx-breadcrumbs-crumb-current',
                                    'tx-breadcrumbs-crumb-' . $post->ID,
                                ),
                                'title' => get_the_title(),
                            ),
                        )
                    );

                    echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-post-cat' ) ) . '"><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-post-cat-bread' ) ) . '">' . wp_kses_post( get_the_title() ) . '</strong></li>';

                    // Else if post is in a custom taxonomy
                } elseif ( ! empty( $taxonomy_terms ) ) {

                    foreach ( $taxonomy_terms as $index => $taxonomy ) {
                        $cat_id       = $taxonomy->term_id;
                        $cat_nicename = $taxonomy->slug;
                        $cat_link     = get_term_link( $taxonomy->term_id, $custom_taxonomy );
                        $cat_name     = $taxonomy->name;

                        $this->add_render_attribute(
                            array(
                                'breadcrumbs-item-post-cpt-' . $index => array(
                                    'class' => array(
                                        'tx-breadcrumbs-item',
                                        'tx-breadcrumbs-item-cat',
                                        'tx-breadcrumbs-item-cat-' . $cat_id,
                                        'tx-breadcrumbs-item-cat-' . $cat_nicename,
                                    ),
                                ),
                                'breadcrumbs-item-post-cpt-crumb-' . $index => array(
                                    'class' => array(
                                        'tx-breadcrumbs-crumb',
                                        'tx-breadcrumbs-crumb-link',
                                        'tx-breadcrumbs-crumb-cat',
                                        'tx-breadcrumbs-crumb-cat-' . $cat_id,
                                        'tx-breadcrumbs-crumb-cat-' . $cat_nicename,
                                    ),
                                    'href'  => $cat_link,
                                    'title' => $cat_name,
                                ),
                            )
                        );

                        echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-post-cpt-' . $index ) ) . '"><a ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-post-cpt-crumb-' . $index ) ) . '>' . esc_attr( $cat_name ) . '</a></li>';

                        $this->render_separator();
                    }

                    $this->add_render_attribute(
                        array(
                            'breadcrumbs-item-post'       => array(
                                'class' => array(
                                    'tx-breadcrumbs-item',
                                    'tx-breadcrumbs-item-current',
                                    'tx-breadcrumbs-item-' . $post->ID,
                                ),
                            ),
                            'breadcrumbs-item-post-crumb' => array(
                                'class' => array(
                                    'tx-breadcrumbs-crumb',
                                    'tx-breadcrumbs-crumb-current',
                                    'tx-breadcrumbs-crumb-' . $post->ID,
                                ),
                                'title' => get_the_title(),
                            ),
                        )
                    );

                    echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-post' ) ) . '"><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-post-crumb' ) ) . '">' . wp_kses_post( get_the_title() ) . '</strong></li>';

                } else {

                    $this->add_render_attribute(
                        array(
                            'breadcrumbs-item-post'       => array(
                                'class' => array(
                                    'tx-breadcrumbs-item',
                                    'tx-breadcrumbs-item-current',
                                    'tx-breadcrumbs-item-' . $post->ID,
                                ),
                            ),
                            'breadcrumbs-item-post-crumb' => array(
                                'class' => array(
                                    'tx-breadcrumbs-crumb',
                                    'tx-breadcrumbs-crumb-current',
                                    'tx-breadcrumbs-crumb-' . $post->ID,
                                ),
                                'title' => get_the_title(),
                            ),
                        )
                    );

                    echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-post' ) ) . '"><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-post-crumb' ) ) . '">' . wp_kses_post( get_the_title() ) . '</strong></li>';

                }
            } elseif ( $query->is_category() ) {

                    $this->add_render_attribute(
                        array(
                            'breadcrumbs-item-cat'       => array(
                                'class' => array(
                                    'tx-breadcrumbs-item',
                                    'tx-breadcrumbs-item-current',
                                    'tx-breadcrumbs-item-cat',
                                ),
                            ),
                            'breadcrumbs-item-cat-bread' => array(
                                'class' => array(
                                    'tx-breadcrumbs-crumb',
                                    'tx-breadcrumbs-crumb-current',
                                    'tx-breadcrumbs-crumb-cat',
                                ),
                            ),
                        )
                    );

                // Category page
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-cat' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-cat-bread' ) ) . '>' . single_cat_title( '', false ) . '</strong></li>';

            } elseif ( $query->is_page() ) {

                // Standard page
                if ( $post->post_parent ) {

                    // If child page, get parents
                    $anc = get_post_ancestors( $post->ID );

                    // Get parents in the right order
                    $anc = array_reverse( $anc );

                    // Parent page loop
                    if ( ! isset( $parents ) ) {
                        $parents = null;
                    }
                    foreach ( $anc as $ancestor ) {
                        $parents .= '<li class="tx-breadcrumbs-item tx-breadcrumbs-item-parent tx-breadcrumbs-item-parent-' . $ancestor . '"><a class="tx-breadcrumbs-crumb tx-breadcrumbs-crumb-link tx-breadcrumbs-crumb-parent tx-breadcrumbs-crumb-parent-' . $ancestor . '" href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';

                        $parents .= $this->render_separator( false );
                    }

                    // Display parent pages
                    echo wp_kses_post( $parents );

                }

                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-page'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                                'tx-breadcrumbs-item-' . $post->ID,
                            ),
                        ),
                        'breadcrumbs-item-page-crumb' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-current',
                                'tx-breadcrumbs-crumb-' . $post->ID,
                            ),
                            'title' => get_the_title(),
                        ),
                    )
                );

                // Just display current page if not parents
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-page' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-page-crumb' ) ) . '>' . wp_kses_post( get_the_title() ) . '</strong></li>';

            } elseif ( $query->is_tag() ) {

                // Tag page

                // Get tag information
                $term_id       = get_query_var( 'tag_id' );
                $taxonomy      = 'post_tag';
                $args          = 'include=' . $term_id;
                $terms         = get_terms( $taxonomy, $args );
                $get_term_id   = $terms[0]->term_id;
                $get_term_slug = $terms[0]->slug;
                $get_term_name = $terms[0]->name;

                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-tag'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                                'tx-breadcrumbs-item-tag-' . $get_term_id,
                                'tx-breadcrumbs-item-tag-' . $get_term_slug,
                            ),
                        ),
                        'breadcrumbs-item-tag-bread' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-current',
                                'tx-breadcrumbs-crumb-tag-' . $get_term_id,
                                'tx-breadcrumbs-crumb-tag-' . $get_term_slug,
                            ),
                            'title' => get_the_title(),
                        ),
                    )
                );

                // Display the tag name
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-tag' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-tag-bread' ) ) . '>' . wp_kses_post( $get_term_name ) . '</strong></li>';

            } elseif ( $query->is_day() ) {

                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-year'        => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-year',
                                'tx-breadcrumbs-item-year-' . get_the_time( 'Y' ),
                            ),
                        ),
                        'breadcrumbs-item-year-crumb'  => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-link',
                                'tx-breadcrumbs-crumb-year',
                                'tx-breadcrumbs-crumb-year-' . get_the_time( 'Y' ),
                            ),
                            'href'  => get_year_link( get_the_time( 'Y' ) ),
                            'title' => get_the_time( 'Y' ),
                        ),
                        'breadcrumbs-item-month'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-month',
                                'tx-breadcrumbs-item-month-' . get_the_time( 'm' ),
                            ),
                        ),
                        'breadcrumbs-item-month-crumb' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-link',
                                'tx-breadcrumbs-crumb-month',
                                'tx-breadcrumbs-crumb-month-' . get_the_time( 'm' ),
                            ),
                            'href'  => get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
                            'title' => get_the_time( 'M' ),
                        ),
                        'breadcrumbs-item-day'         => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                                'tx-breadcrumbs-item-' . get_the_time( 'j' ),
                            ),
                        ),
                        'breadcrumbs-item-day-crumb'   => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-current',
                                'tx-breadcrumbs-crumb-' . get_the_time( 'j' ),
                            ),
                        ),
                    )
                );

                // Year link
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-year' ) ) . '><a ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-year-crumb' ) ) . '>' . wp_kses_post( get_the_time( 'Y' ) ) . ' ' . esc_attr__( 'Archives', 'powerpack' ) . '</a></li>';

                $this->render_separator();

                // Month link
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-month' ) ) . '><a ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-month-crumb' ) ) . '>' . wp_kses_post( get_the_time( 'M' ) ) . ' ' . esc_attr__( 'Archives', 'powerpack' ) . '</a></li>';

                $this->render_separator();

                // Day display
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-day' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-day-crumb' ) ) . '> ' . wp_kses_post( get_the_time( 'jS' ) ) . ' ' . wp_kses_post( get_the_time( 'M' ) ) . ' ' . esc_attr__( 'Archives', 'powerpack' ) . '</strong></li>';

            } elseif ( $query->is_month() ) {

                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-year'        => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-year',
                                'tx-breadcrumbs-item-year-' . get_the_time( 'Y' ),
                            ),
                        ),
                        'breadcrumbs-item-year-crumb'  => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-year',
                                'tx-breadcrumbs-crumb-year-' . get_the_time( 'Y' ),
                            ),
                            'href'  => get_year_link( get_the_time( 'Y' ) ),
                            'title' => get_the_time( 'Y' ),
                        ),
                        'breadcrumbs-item-month'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-month',
                                'tx-breadcrumbs-item-month-' . get_the_time( 'm' ),
                            ),
                        ),
                        'breadcrumbs-item-month-crumb' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-month',
                                'tx-breadcrumbs-crumb-month-' . get_the_time( 'm' ),
                            ),
                            'title' => get_the_time( 'M' ),
                        ),
                    )
                );

                // Year link
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-year' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-year-crumb' ) ) . '>' . wp_kses_post( get_the_time( 'Y' ) ) . ' ' . esc_attr__( 'Archives', 'powerpack' ) . '</strong></li>';

                $this->render_separator();

                // Month display
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-month' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-month-crumb' ) ) . '>' . wp_kses_post( get_the_time( 'M' ) ) . ' ' . esc_attr__( 'Archives', 'powerpack' ) . '</strong></li>';

            } elseif ( $query->is_year() ) {

                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-year'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                                'tx-breadcrumbs-item-current-' . get_the_time( 'Y' ),
                            ),
                        ),
                        'breadcrumbs-item-year-crumb' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-current',
                                'tx-breadcrumbs-crumb-current-' . get_the_time( 'Y' ),
                            ),
                            'title' => get_the_time( 'Y' ),
                        ),
                    )
                );

                // Display year archive
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-year' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-year-crumb' ) ) . '>' . wp_kses_post( get_the_time( 'Y' ) ) . ' ' . esc_attr__( 'Archives', 'powerpack' ) . '</strong></li>';

            } elseif ( $query->is_author() ) {

                // Get the author information
                global $author;
                $userdata = get_userdata( $author );

                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-author'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                                'tx-breadcrumbs-item-current-' . $userdata->user_nicename,
                            ),
                        ),
                        'breadcrumbs-item-author-bread' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-current',
                                'tx-breadcrumbs-crumb-current-' . $userdata->user_nicename,
                            ),
                            'title' => $userdata->display_name,
                        ),
                    )
                );

                // Display author name
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-author' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-author-bread' ) ) . '>' . esc_attr__( 'Author:', 'powerpack' ) . ' ' . esc_attr( $userdata->display_name ) . '</strong></li>';

            } elseif ( get_query_var( 'paged' ) ) {

                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-paged'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                                'tx-breadcrumbs-item-current-' . get_query_var( 'paged' ),
                            ),
                        ),
                        'breadcrumbs-item-paged-bread' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-current',
                                'tx-breadcrumbs-crumb-current-' . get_query_var( 'paged' ),
                            ),
                            'title' => __( 'Page', 'powerpack' ) . ' ' . get_query_var( 'paged' ),
                        ),
                    )
                );

                // Paginated archives
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-paged' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-paged-bread' ) ) . '>' . esc_attr__( 'Page', 'powerpack' ) . ' ' . wp_kses_post( get_query_var( 'paged' ) ) . '</strong></li>';

            } elseif ( $query->is_search() ) {

                // Search results page
                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-search'       => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                                'tx-breadcrumbs-item-current-' . get_search_query(),
                            ),
                        ),
                        'breadcrumbs-item-search-crumb' => array(
                            'class' => array(
                                'tx-breadcrumbs-crumb',
                                'tx-breadcrumbs-crumb-current',
                                'tx-breadcrumbs-crumb-current-' . get_search_query(),
                            ),
                            'title' => __( 'Search results for:', 'powerpack' ) . ' ' . get_search_query(),
                        ),
                    )
                );

                // Search results page
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-search' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-search-crumb' ) ) . '>' . esc_attr__( 'Search results for:', 'powerpack' ) . ' ' . get_search_query() . '</strong></li>';

            } elseif ( $query->is_home() ) {

                $blog_label = $settings['blog_text'];

                if ( $blog_label ) {
                    $this->add_render_attribute(
                        array(
                            'breadcrumbs-item-blog'       => array(
                                'class' => array(
                                    'tx-breadcrumbs-item',
                                    'tx-breadcrumbs-item-current',
                                ),
                            ),
                            'breadcrumbs-item-blog-crumb' => array(
                                'class' => array(
                                    'tx-breadcrumbs-crumb',
                                    'tx-breadcrumbs-crumb-current',
                                ),
                                'title' => $blog_label,
                            ),
                        )
                    );

                    // Just display current page if not parents
                    echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-blog' ) ) . '><strong ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-blog-crumb' ) ) . '>' . esc_attr( $blog_label ) . '</strong></li>';
                }
            } elseif ( $query->is_404() ) {
                $this->add_render_attribute(
                    array(
                        'breadcrumbs-item-error' => array(
                            'class' => array(
                                'tx-breadcrumbs-item',
                                'tx-breadcrumbs-item-current',
                            ),
                        ),
                    )
                );

                // 404 page
                echo '<li ' . wp_kses_post( $this->get_render_attribute_string( 'breadcrumbs-item-error' ) ) . '>' . esc_attr__( 'Error 404', 'powerpack' ) . '</li>';
            }

            echo '</ul>';

        }

    }

    protected function get_separator() {
        $settings = $this->get_settings_for_display();

        ob_start(); ?>
        <li class="tx-breadcrumbs-separator">
            <span class='tx-breadcrumbs-separator-icon'>
                <?php Icons_Manager::render_icon( $settings['select_separator_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
        </li>
        <?php
        $separator = ob_get_contents();
        ob_end_clean();

        return $separator;
    }

    protected function render_home_link() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            array(
                'home_item' => array(
                    'class' => array(
                        'tx-breadcrumbs-item',
                        'tx-breadcrumbs-item-home',
                    ),
                ),
                'home_link' => array(
                    'class' => array(
                        'tx-breadcrumbs-crumb',
                        'tx-breadcrumbs-crumb-link',
                        'tx-breadcrumbs-crumb-home',
                    ),
                    'href'  => get_home_url(),
                    'title' => $settings['home_text'],
                ),
                'home_text' => array(
                    'class' => array(
                        'tx-breadcrumbs-text',
                    ),
                ),
            )
        );

        if ( ! isset( $settings['home_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // add old default
            $settings['home_icon'] = 'fa fa-home';
        }

        $has_home_icon = ! empty( $settings['home_icon'] );

        if ( $has_home_icon ) {
            $this->add_render_attribute( 'i', 'class', $settings['home_icon'] );
            $this->add_render_attribute( 'i', 'aria-hidden', 'true' );
        }

        if ( ! $has_home_icon && ! empty( $settings['select_home_icon']['value'] ) ) {
            $has_home_icon = true;
        }
        $migrated_home_icon = isset( $settings['__fa4_migrated']['select_home_icon'] );
        $is_new_home_icon   = ! isset( $settings['home_icon'] ) && Icons_Manager::is_migration_allowed();
        ?>
        <li <?php echo wp_kses_post( $this->get_render_attribute_string( 'home_item' ) ); ?>>
            <a <?php echo wp_kses_post( $this->get_render_attribute_string( 'home_link' ) ); ?>>
                <span <?php echo wp_kses_post( $this->get_render_attribute_string( 'home_text' ) ); ?>>
                    <?php if ( ! empty( $settings['home_icon'] ) || ( ! empty( $settings['select_home_icon']['value'] ) && $is_new_home_icon ) ) { ?>
                        <span class="tx-icon">
                            <?php
                            if ( $is_new_home_icon || $migrated_home_icon ) {
                                Icons_Manager::render_icon( $settings['select_home_icon'], array( 'aria-hidden' => 'true' ) );
                            } elseif ( ! empty( $settings['home_icon'] ) ) {
                                ?>
                                <i <?php echo wp_kses_post( $this->get_render_attribute_string( 'i' ) ); ?>></i>
                                <?php
                            }
                            ?>
                        </span>
                    <?php } ?>
                    <?php echo esc_attr( $settings['home_text'] ); ?>
                </span>
            </a>
        </li>
        <?php

        $this->render_separator();
    }

    protected function render_separator( $output = true ) {
        $settings = $this->get_settings_for_display();

        $html  = '<li class="tx-breadcrumbs-separator">';
        $html .= $this->get_separator();
        $html .= '</li>';

        if ( true === $output ) {
            \Elementor\Utils::print_unescaped_internal_string( $html );
            return;
        }

        return $html;
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
        $this->render_breadcrumbs();
    ?>	
		
<?php } // render()

} // class
