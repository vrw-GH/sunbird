<?php
namespace AvasElements;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TX_Helper {

	// get all post types
	static function get_all_post_types() {

    $tx_post_types = get_post_types( array( 'public'   => true, 'show_in_nav_menus' => true ) );
    $tx_exclude_post_types = array( 'elementor_library', 'attachment', 'product', 'lp_course', 'lp_lesson', 'lp_quiz', 'give_forms' );

    foreach ( $tx_exclude_post_types as $exclude_cpt ) {
        unset($tx_post_types[$exclude_cpt]);
    }

    $post_types = array_merge($tx_post_types);
    return $post_types;

	}

    // Get all Posts
    static function get_all_posts() {

        $post_list = get_posts( array(
            'post_type'         => 'post',
            'orderby'           => 'date',
            'order'             => 'DESC',
            'posts_per_page'    => -1,
        ) );

        $posts = array();

        if ( ! empty( $post_list ) && ! is_wp_error( $post_list ) ) {
            foreach ( $post_list as $post ) {
               $posts[ $post->ID ] = $post->post_title;
            }
        }

        return $posts;
    }

    // Get Post Formats
    static function get_post_format() {
        $terms = get_terms( array( 
            'taxonomy' => 'post_format',
            'hide_empty' => true,
        ));
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $options[ $term->term_id ] = $term->name;
        }
        }
        return $options;
    }

    // Get all Authors
    static function get_all_auhtors() {

            $options = array();

            $users = get_users();

            foreach ( $users as $user ) {
                $options[ $user->ID ] = $user->display_name;
            }

            return $options;
    }

    // Get all user roles
    static function user_roles()
    {
        global $wp_roles;

        $all = $wp_roles->roles;
        $all_roles = array();

        if (!empty($all)) {
            foreach ($all as $key => $value) {
                $all_roles[$key] = $all[$key]['name'];
            }
        }

        return $all_roles;
    }

    // Get all Tags
    static function get_all_tags() {

        $options = array();

        $tags = get_tags();

        foreach ( $tags as $tag ) {
            $options[ $tag->term_id ] = $tag->name;
        }

        return $options;
    }

    // get all registered taxonomies
    static function get_all_taxonomies() {
        $map = array();
        $taxonomies = get_taxonomies();
        foreach ($taxonomies as $taxonomy) {
            $map [$taxonomy] = $taxonomy;
        }
        return $map;
    }

    // get categories from taxonomies
    static function get_post_type_categories($catarg) {

        $categories = get_terms( $catarg );

        $options = [];
        foreach ( $categories as $category ) {
            $options[ $category->slug ] = $category->name;
        }

        return $options;
    }  

	// get all taxonomies
	static function get_all_categories() {

    global $wpdb;

    $results = array();
    foreach ($wpdb->get_results("
        SELECT terms.slug AS 'slug', terms.name AS 'label', termtaxonomy.taxonomy AS 'type'
        FROM $wpdb->terms AS terms
        JOIN $wpdb->term_taxonomy AS termtaxonomy ON terms.term_id = termtaxonomy.term_id
        LIMIT 999
    ") as $result) {
        $results[$result->type . ':' . $result->slug] = $result->type . ':' . $result->label;
    }

    return $results;
	}

    // query arguements setup
	static function setup_query_args($settings, $showposts) {

        if ( get_query_var('paged') ) :
            $paged = get_query_var('paged');
        elseif ( get_query_var('page') ) :
            $paged = get_query_var('page');
        else :
            $paged = 1;
        endif;
        
        if ( $settings['post_sortby'] == 'popularposts' ) {
            $query_args = [
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts'   => $showposts,
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                'posts_per_page' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'paged'       => $paged,
            ];
        } elseif ( $settings['post_sortby'] == 'mostdiscussed' ) {
            $query_args = [
                'orderby' => 'comment_count',
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts'   => $showposts,
                'posts_per_page' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'paged'       => $paged,
            ];
        } else {
            $query_args = [
                'orderby' => $settings['orderby'],
                'order' => $settings['order'],
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
                'showposts'   => $showposts,
                'posts_per_page' => $settings['number_of_posts'],
                'offset' => $settings['offset'],
                'paged'       => $paged,
            ];
        }

            if (!empty($settings['post_type'])) {
                $query_args['post_type'] = $settings['post_type'];
            }
            if (!empty($settings['tax_query'])) {
                $tax_queries = $settings['tax_query'];
                $query_args['tax_query'] = array();
                $query_args['tax_query']['relation'] = 'OR';
                foreach ($tax_queries as $taxquery) {
                    list($tax, $term) = explode(':', $taxquery);
                    if (empty($tax) || empty($term))
                        continue;
                    $query_args['tax_query'][] = array(
                        'taxonomy' => $tax,
                        'field' => 'slug',
                        'terms' => $term
                    );
                }
            }
        return $query_args;
    }

    // Post Title Lenth
    static function title_lenth($charlength) {

        $title = get_the_title();
        $charlength++;

        if ( mb_strlen( $title ) > $charlength ) {
            $subex = mb_substr( $title, 0, $charlength - 0 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                return mb_substr( $subex, 0, $excut );
            } else {
                return $subex;
            }

        } else {
            return $title;
        }
    }

    // Post excerpt limit
    static function excerpt_limit($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).' ';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
      return $excerpt;
    }

    // woocommerce product gallery first image hover on product
    static function woo_image_hover() {
        global $product;

        $attachment_ids = $product->get_gallery_image_ids();
        $count = 0;
        foreach( $attachment_ids as $attachment_id ) { 
            $count++;
            
            if($count <= 1) {
            ?>
            <div class="tx-woo-hover-image">
                <img src="<?php echo wp_get_attachment_image_src( $attachment_id, 'woocommerce_thumbnail' )[0]; ?>" alt="<?php echo esc_attr( get_the_title( $attachment_id ) ); ?>">
            </div>
            <?php 
            }
        }
    }

    // social profile 
    static function social_profile($link) {

        $phone = $link['phone'];
        $email = $link['email'];
        $facebook = $link['facebook'];
        $twitter = $link['twitter'];
        $linkedin = $link['linkedin'];
        $instagram = $link['instagram'];
        $behance = $link['behance'];
        $dribbble = $link['dribbble'];
        $pinterest = $link['pinterest'];
        $youtube = $link['youtube'];
        ?>

        <div class="tx-social-profile">
            <?php if ( !empty($phone) ) : ?>
                <a href="tel:<?php echo esc_attr( $phone ); ?>"><i class="bi bi-telephone" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($email) ) : ?>
                <a href="mailto:<?php echo esc_attr( $email ); ?>"><i class="bi bi-envelope" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($facebook) ) : ?>
                <a href="<?php echo esc_url( $facebook ); ?>"><i class="fab fa-facebook" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($twitter) ) : ?>
                <a href="<?php echo esc_url( $twitter ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($linkedin) ) : ?>
                <a href="<?php echo esc_url( $linkedin ); ?>"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($instagram) ) : ?>
                <a href="<?php echo esc_url( $instagram ); ?>"><i class="fab fa-instagram" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($behance) ) : ?>
                <a href="<?php echo esc_url( $behance ); ?>"><i class="fab fa-behance" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($dribbble) ) : ?>
                <a href="<?php echo esc_url( $dribbble ); ?>"><i class="fab fa-dribbble" aria-hidden="true"></i></a>
            <?php endif; ?>          
            <?php if ( !empty($pinterest) ) : ?>
                <a href="<?php echo esc_url( $pinterest ); ?>"><i class="fab fa-pinterest" aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if ( !empty($youtube) ) : ?>
                <a href="<?php echo esc_url( $youtube ); ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a>
            <?php endif; ?>
        </div><!-- tx-social-profile -->

    <?php
    }

    // Instagram Feed
    static function instagram_feed() {

    global $tx;
    $access_token = $tx['instagram_api'];

        if (!empty($access_token)) {

            $api_url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $access_token;
            $json_data = wp_remote_fopen( $api_url );
            $data  = json_decode( $json_data, true );
            $meta = [];

                if ( ! empty( $data['data'] ) ) {

                    foreach ( $data['data'] as $feed ) {

                        array_push( $meta, 
                            array(
                                'image' => [
                                    'small'  => $feed['images']['thumbnail']['url'],
                                    'medium' => $feed['images']['low_resolution']['url'],
                                    'large'  => $feed['images']['standard_resolution']['url'],
                                ],
                                'link'      => $feed['link'],
                                'like'      => $feed['likes']['count'],
                                'comment'   => [
                                    'count' => $feed['comments']['count']
                                ],
                            ) 
                        );

                    }

                    return $meta;
                }

        } 

    } 

    // Contact Form 7
    static function contact_form_seven() {
        $wpcf7_form_list = get_posts(array(
            'post_type' => 'wpcf7_contact_form',
            'showposts' => -1,
        ));
        $options = array();
        $options[0] = esc_html__( 'Select a Contact Form', 'avas-core' );
        if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ) {
            foreach ( $wpcf7_form_list as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        } else {
            $options[0] = esc_html__( 'Create a Form First', 'avas-core' );
        }
        return $options;
    }

    // Gravity Form
    public static function gravity_form() {
        $options = array();

        if (class_exists('GFCommon')) {
            $gravity_forms = \RGFormsModel::get_forms(null, 'title');

            if (!empty($gravity_forms) && !is_wp_error($gravity_forms)) {

                $options[0] = esc_html__('Select Gravity Form', 'avas-core');
                foreach ($gravity_forms as $form) {
                    $options[$form->id] = $form->title;
                }

            } else {
                $options[0] = esc_html__('Create a Form First', 'avas-core');
            }
        }

        return $options;
    }

    // Get all image shapes for image mask
    public static function get_image_shapes() {
        $path       = TX_PLUGIN_URL . '/assets/img/mask/';
        $shape_name = 'shape';
        $extension  = '.svg';
        $list       = [ 0 => esc_html__( 'Select Mask', 'avas-core' ) ];
        
        for ( $i = 1; $i <= 81; $i ++ ) {
            $list[ $path . $shape_name . '-' . $i . $extension ] = ucwords( $shape_name . ' ' . $i );
        }
        
        return $list;
    }


    // Position for navigation, icons, arrow, etc
    public static function tx__position() {
        $position_options = [
            ''              => esc_html__('Default', 'avas-core'),
            'top-left'      => esc_html__('Top Left', 'avas-core'),
            'top-center'    => esc_html__('Top Center', 'avas-core'),
            'top-right'     => esc_html__('Top Right', 'avas-core'),
            'center'        => esc_html__('Center', 'avas-core'),
            'center-left'   => esc_html__('Center Left', 'avas-core'),
            'center-right'  => esc_html__('Center Right', 'avas-core'),
            'bottom-left'   => esc_html__('Bottom Left', 'avas-core'),
            'bottom-center' => esc_html__('Bottom Center', 'avas-core'),
            'bottom-right'  => esc_html__('Bottom Right', 'avas-core'),
        ];

        return $position_options;
    }

    public static function title_html_tags() {

        $tags = [
            'h1'    => 'H1',
            'h2'    => 'H2',
            'h3'    => 'H3',
            'h4'    => 'H4',
            'h5'    => 'H5',
            'h6'    => 'H6',
            'div'   => 'div',
            'span'  => 'Span',
            'p'     => 'P'
        ];

        return $tags;

    }

    
} //class TX_Helper



