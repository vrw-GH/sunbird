<?php
/**
 * 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
 */

    defined( 'ABSPATH' ) || exit;

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // Used to execept HTML tags in description arguments where esc_html would remove.
    $kses_exceptions = array(
        'a'      => array(
            'href' => array(),
        ),
        'strong' => array(),
        'br'     => array(),
        'code'   => array(),
    );

    /*
     * ---> BEGIN ARGUMENTS
     */

    /**
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://docs.redux.io/core/arguments/
     */
    // This is your option name where all the Redux data is stored.
    $opt_name = "tx";
    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'avas' ),
        'page_title'           => esc_html__( 'Theme Options', 'avas' ),
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        'disable_google_fonts_link' => false,  // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-menu',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 40,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'customizer'           => true,
        // Enable basic customizer support
        'open_expanded'     => false,                    // Allow you to start the panel in an expanded way initially.
        'disable_save_warn' => false,                    // Disable the save warning when a user changes a field
        // OPTIONAL -> Give you extra features
        'page_priority'        => 61,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            =>  TX_IMAGES.'icon.png',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.
        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'network_admin'             => true,
        'use_cdn'              => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
        // Set the theme of the option panel.  Use 'classic' to revert to the Redux 3 style.
        'admin_theme'               => 'wp',
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );
    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => esc_url('https://x-theme.net/avas/'),
        'title' => esc_html__('Visit Our Website', 'avas'),
        'icon'  => 'el el-globe-alt'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('https://x-theme.net/doc-avas/'),
        'title' => esc_html__('Check Our Documentation', 'avas'),
        'icon'  => 'el el-file'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('https://www.youtube.com/channel/UC1hlWYgndZw7PEHWeTbYvfA'),
        'title' => esc_html__('Watch Video Tutorials on Youtube', 'avas'),
        'icon'  => 'el el-youtube'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('https://www.facebook.com/avas.wordpress.theme/'),
        'title' => esc_html__('Like us on Facebook', 'avas'),
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => esc_url('https://twitter.com/AvasTheme'),
        'title' => esc_html__('Follow us on Twitter', 'avas'),
        'icon'  => 'el el-twitter'
    );
    Redux::setArgs( $opt_name, $args );
    /*
     * ---> END ARGUMENTS
     */
    /*
     *
     * ---> START SECTIONS
     *
     */
    /*
        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for
     */
    // Global Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Global', 'avas' ),
        'id'               => 'global',
        'customizer_width' => '400px',
        'icon'             => 'el el-home'
    ) );
    // General Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'avas' ),
        'id'               => 'general',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'title'    => esc_html__('Favicon', 'avas'),
                'id'       => 'favicon',
                'type'     => 'media',
                'complier' => true,
                'url'      => true,
                'desc'     => esc_html__( 'You can upload .png, .jpg, .gif and .ico image format for favicon.', 'avas' ),
                'default'  => array(
                    'url'      => TX_IMAGES.'icon.png'
                )
            ),
            array(
                'id'        => 'mob_version',
                'type'      => 'switch',
                'title'     => esc_html__('Mobile Version', 'avas'),
                'desc'     => esc_html__('If you would like to display desktop version in mobile device you can disable mobile version.', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable', 'avas'),
                'off'       => esc_html__('Disable', 'avas')
            ),
            array(
                'id'        => 'preloader',
                'type'      => 'switch',
                'title'     => esc_html__('Preloader', 'avas'),
                'default'   => 0,
                'on'        => esc_html__('Enable', 'avas'),
                'off'       => esc_html__('Disable', 'avas')
            ),
            array(
                'id'       => 'preloader-bg-color',
                'type'     => 'color',
                'output'   => array('background-color' => '.pre-loader'),
                'title'    => esc_html__( 'Prealoader Background Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required'  => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader-color',
                'type'     => 'color',
                'output'   => array('background-color' => '.sk-fading-circle .sk-circle:before'),
                'title'    => esc_html__( 'Prealoader animation Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required'  => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'selection-bg-color',
                'type'     => 'color',
                'output'   => array('background-color' => '::selection'),
                'title'    => esc_html__( 'Selection Background Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'selection-text-color',
                'type'     => 'color',
                'output'   => array('color' => '::selection'),
                'title'    => esc_html__( 'Selection Text Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'page-layout',
                'type'     => 'image_select',
                'title' => esc_html__('Layout', 'avas'),
                'options'  => array(
                    'full-width' => array('title' => 'Width', 'img' => TX_IMAGES .'body-full.png'),
                    'boxed'      => array('title' => 'Boxed', 'img' => TX_IMAGES .'body-boxed.png'),
                ),
                'default'  => 'full-width',
            ),
            array(
                'id'    => 'body-background',
                'title' => esc_html__( 'Body Background', 'avas' ),
                'type'  => 'background',
                'output'   => array('background' => 'body'),
                'transparent' => false,
                'default'  => array(
                    'background-color' => '',
                ),
            ),
            array(
                'id'    => 'wrap-background',
                'title' => esc_html__( 'Wrapper Background', 'avas' ),
                'type'  => 'background',
                'output'   => array('background' => '.tx-wrapper'),
                'transparent' => false,
                'default'  => array(
                    'background-color' => '',
                ),
                'required'  => array( 'page-layout', '=', 'boxed' ),
            ),
            array(
                'id'    => 'wrap-margin',
                'type'  => 'spacing',
                'output'         => array('.tx-wrapper'),
                'mode'           => 'margin',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Wrapper Margin', 'avas'),
                'desc'          => esc_html__('Plase enter Top and Bottom value only. Left and Right value default "auto". Do not enter Left or Right value otherwise it will break layout. ', 'avas'),
                'default'            => array(
                    'margin-top'     => '0', 
                    'margin-right'   => '', 
                    'margin-bottom'  => '0', 
                    'margin-left'    => '',
                    'units'          => 'px', 
                ),
                'required'  => array( 'page-layout', '=', 'boxed' ),
                ),
            array(
                'id'             => 'wrap-padding',
                'type'           => 'spacing',
                'output'         => array('.tx-wrapper'),
                'mode'           => 'padding',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Wrapper Padding', 'avas'),
                'default'            => array(
                    'padding-top'     => '', 
                    'padding-right'   => '', 
                    'padding-bottom'  => '', 
                    'padding-left'    => '',
                    'units'          => 'px', 
                ),
                'required'  => array( 'page-layout', '=', 'boxed' ),
            ),
            array(
                    'id'       => 'wrap-border-top',
                    'type'     => 'border',
                    'title'    => esc_html__('Wrapper Border', 'avas'),
                    'desc'     => esc_html__( 'Enter border width ex: 1, 2, 3 etc to enable border. 0 to disable.', 'avas' ),
                    'output'   => array('.tx-wrapper'),
                    'color'    => true,
                    'all'      => false,
                    'default'  => array(
                        'border-color'  => '', 
                        'border-style'  => 'solid', 
                        'border-top'    => '0',
                        'border-right'    => '0',
                        'border-bottom'    => '0',
                        'border-left'    => '0',
                        ),
                    'required'  => array( 'page-layout', '=', 'boxed' ),
                ),
            // General Color Options
            array(
                    'id'        => 'general-colors',
                    'type'      => 'info',
                    'title'     => esc_html__('Colors Options', 'avas'),
                    'style'     => 'success',
                ),
            array(
                'id'       => 'body',
                'type'     => 'color',
                'output'   => array('body'),
                'title'    => esc_html__( 'Body text color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'link-color',
                'type'     => 'color',
                'output'   => array('a'),
                'title'    => esc_html__( 'Link color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'link-hover-color',
                'type'     => 'color',
                'output'   => array('a:hover, a:focus'),
                'title'    => esc_html__( 'Link hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h1-color',
                'type'     => 'color',
                'output'   => array('h1'),
                'title'    => esc_html__( 'H1 color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h2-color',
                'type'     => 'color',
                'output'   => array('h2'),
                'title'    => esc_html__( 'H2 color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h3-color',
                'type'     => 'color',
                'output'   => array('h3'),
                'title'    => esc_html__( 'H3 color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h4-color',
                'type'     => 'color',
                'output'   => array('h4'),
                'title'    => esc_html__( 'H4 color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h5-color',
                'type'     => 'color',
                'output'   => array('h5'),
                'title'    => esc_html__( 'H5 color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h6-color',
                'type'     => 'color',
                'output'   => array('h6'),
                'title'    => esc_html__( 'H6 color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            // General Fonts Options
            array(
                    'id'        => 'general-fonts',
                    'type'      => 'info',
                    'title'     => esc_html__('Fonts Options', 'avas'),
                    'style'     => 'success',
                ),
            array(
                'id'       => 'typography-body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('body'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => false,
                'color'         => false,
                'text-align'    => false,
                'text-transform'=> true,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h1',
                'type'     => 'typography',
                'title'    => esc_html__( 'H1', 'avas' ),
                'subtitle' => esc_html__( 'Specify the H1 font properties.', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h1'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h2',
                'type'     => 'typography',
                'title'    => esc_html__( 'H2', 'avas' ),
                'subtitle' => esc_html__( 'Specify the H2 font properties.', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h2'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h3',
                'type'     => 'typography',
                'title'    => esc_html__( 'H3', 'avas' ),
                'subtitle' => esc_html__( 'Specify the H3 font properties.', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h3'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h4',
                'type'     => 'typography',
                'title'    => esc_html__( 'H4', 'avas' ),
                'subtitle' => esc_html__( 'Specify the H4 font properties.', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h4'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h5',
                'type'     => 'typography',
                'title'    => esc_html__( 'H5', 'avas' ),
                'subtitle' => esc_html__( 'Specify the H5 font properties.', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h5'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h6',
                'type'     => 'typography',
                'title'    => esc_html__( 'H6', 'avas' ),
                'subtitle' => esc_html__( 'Specify the H6 font properties.', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h6'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'color'         => false,
                'text-align'    => false,
                'text-transform'=> true,
                'subsets'       => true, 
            ),

        )
    ) );

    // Logo Options
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo', 'avas' ),
        'id'         => 'logo',
        'subsection' => true,
        'fields'     => array(
            array(
                'title'    => esc_html__('Logo', 'avas'),
                'id'       => 'tx_logo',
                'type'     => 'media',
                'complier' => true,
                'url'      => true,
                'desc'     => esc_html__( 'You can upload .png, .jpg, .gif image format.', 'avas' ),
                'default'  => array(
                    'url'=> TX_IMAGES . 'logo.png'
                )
            ),
            array(
                'id'       => 'logo_link_url',
                'type'     => 'text',
                'title'    => esc_html__('Logo Link URL','avas'),
                'desc'    => esc_html__('Enter your custom link URL. Default is home page URL','avas'),
                'default'  => '',
                ),
            array(
                'id'            => 'logo-resize',
                'type'          => 'slider',
                'title'         => esc_html__( 'Logo Resize for Desktop', 'avas' ),
                'min'           => 0,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text'
            ),
            array(
                'id'            => 'logo-resize-responsive',
                'type'          => 'slider',
                'title'         => esc_html__( 'Logo Resize for Responsive Device', 'avas' ),
                'min'           => 0,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text'
            ),
            array(
                'id'             => 'logo_space',
                'type'           => 'spacing',
                'output'         => array('.tx_logo'),
                'mode'           => 'padding',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Logo Padding', 'avas'),
                'default'            => array(
                    'units'          => 'px', 
                ),
            ),
            
        )
    ) );

    // Header Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'avas' ),
        'id'               => 'header',
        'customizer_width' => '400px',
        'icon'             => 'el el-website',
        'fields'           =>  array(
            array(
                'id'       => 'header-layout',
                'type'     => 'image_select',
                'title' => esc_html__('Layout', 'avas'),
                'options'  => array(
                    'boxed'      => array('title' => 'Boxed', 'img' => TX_IMAGES .'header-boxed.png'),
                    'width' => array('title' => 'Width', 'img' => TX_IMAGES .'header-width.png'),
                    ),
                'default'  => 'boxed',
                'required'  => array('page-layout', '=', 'full-width')
            ),
            array(
                'id'        => 'header_overlay',
                'type'      => 'switch',
                'title'     => esc_html__('Header Overlay', 'avas'),
                'desc'     => esc_html__('For Transparent Header for Home page.', 'avas'),
                'default'   => 0,
                'on'        => esc_html__('Yes','avas'),
                'off'       => esc_html__('No','avas'),
            ),
            array(
                'id'        => 'sticky_header',
                'type'      => 'switch',
                'title'     => esc_html__('Sticky Header', 'avas'),
                'default'   => 0,
                'on'        => 'On',
                'off'       => 'Off',
            ),
            array(
                'id'        => 'sticky_main_header',
                'type'      => 'switch',
                'title'     => esc_html__('Sticky Main Header', 'avas'),
                'default'   => 0,
                'on'        => 'On',
                'off'       => 'Off',
                'required'  => array(
                                array( 'sticky_header', '=', '1' ),
                                array( 'header-select', '!=', 'header3' ),
                                array( 'header-select', '!=', 'header5' ),
                                array( 'header-select', '!=', 'header9' ),
                            ),
            ),
            array(
                'id'            => 'sticky-scroll',
                'type'          => 'slider',
                'title'         => esc_html__( 'Sticky Header Start From', 'avas' ),
                'default'       => 300,
                'min'           => 0,
                'step'          => 1,
                'max'           => 1000,
                'display_value' => 'text',
                'required'  => array('sticky_header', '=', '1' ),
            ),
        )
    ));   
    // Main Header options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Main Header', 'avas' ),
        'id'               => 'main-header',
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'           =>  array(
                array(
                    'id'        => 'header_on_off',
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => 'Enable',
                    'off'       => 'Disable',
                ),
                array(
                    'id'             => 'main_header_margin_home',
                    'type'           => 'spacing',
                    'output'         => array('.home .main-header'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Margin for Home page only.', 'avas'),
                    'required'  => array( 'header_on_off', '=', '1' ),
                    'default'            => array(
                    'units'          => 'px', 
                    ),
                ), 
                array(
                    'id'             => 'main_header_padding',
                    'type'           => 'spacing',
                    'output'         => array('.main-header .container,.main-header .container-fluid'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Padding', 'avas'),
                    'required'  => array( 'header_on_off', '=', '1' )
                ),
                array(
                    'id'       => 'header-select',
                    'type'     => 'select',
                    'title' => esc_html__('Select Header Style', 'avas'),
                    'options'  => array(
                        'header1'  => esc_html__('Style 1','avas'),
                        'header2'  => esc_html__('Style 2','avas'),
                        'header3'  => esc_html__('Style 3','avas'),
                        'header4'  => esc_html__('Style 4','avas'),
                        'header5'  => esc_html__('Style 5','avas'),
                        'header6'  => esc_html__('Style 6','avas'),
                        'header7'  => esc_html__('Style 7','avas'),
                        'header8'  => esc_html__('Style 8','avas'),
                        'header9'  => esc_html__('Style 9','avas'),
                        'header10'  => esc_html__('Style 10','avas'),
                    ),
                    'default'  => 'header3',
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'header-style1',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 1', 'avas'),
                    'required'  => array( 'header-select', '=', 'header1' ),
                    'options'  => array(
                    'header-style1'  => array(
                      'alt' => 'Header Style 1',
                      'img' => TX_IMAGES .'h1.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style2',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 2', 'avas'),
                    'required'  => array( 'header-select', '=', 'header2' ),
                    'options'  => array(
                    'header-style2'  => array(
                      'alt' => 'Header Style 2',
                      'img' => TX_IMAGES .'h2.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style3',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 3', 'avas'),
                    'required'  => array( 'header-select', '=', 'header3' ),
                    'options'  => array(
                    'header-style3'  => array(
                      'alt' => 'Header Style 3',
                      'img' => TX_IMAGES .'h3.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style4',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 4', 'avas'),
                    'required'  => array( 'header-select', '=', 'header4' ),
                    'options'  => array(
                    'header-style4'  => array(
                      'alt' => 'Header Style 4',
                      'img' => TX_IMAGES .'h4.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style5',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 5', 'avas'),
                    'required'  => array( 'header-select', '=', 'header5' ),
                    'options'  => array(
                    'header-style5'  => array(
                      'alt' => 'Header Style 5',
                      'img' => TX_IMAGES .'h5.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style6',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 6', 'avas'),
                    'required'  => array( 'header-select', '=', 'header6' ),
                    'options'  => array(
                    'header-style6'  => array(
                      'alt' => 'Header Style 6',
                      'img' => TX_IMAGES .'h6.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style7',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 7', 'avas'),
                    'required'  => array( 'header-select', '=', 'header7' ),
                    'options'  => array(
                    'header-style7'  => array(
                      'alt' => 'Header Style 7',
                      'img' => TX_IMAGES .'h7.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style8',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 8', 'avas'),
                    'required'  => array( 'header-select', '=', 'header8' ),
                    'options'  => array(
                    'header-style8'  => array(
                      'alt' => 'Header Style 8',
                      'img' => TX_IMAGES .'h8.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style9',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 9', 'avas'),
                    'required'  => array( 'header-select', '=', 'header9' ),
                    'options'  => array(
                    'header-style9'  => array(
                      'alt' => 'Header Style 9',
                      'img' => TX_IMAGES .'h9.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style-10-position',
                    'type'     => 'select',
                    'title' => esc_html__('Header Style 10 Position', 'avas'),
                    'options'  => array(
                        'left'  => esc_html__('Left','avas'),
                        'right'  => esc_html__('Right','avas'),
                    ),
                    'default'  => 'left',
                    'required'  => array( 'header-select', '=', 'header10' ),
                ),
                array(
                    'id'       => 'header-style10-left',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 10 Left', 'avas'),
                    'required'  => array( 'header-style-10-position', '=', 'left' ),
                    'options'  => array(
                    'header-style10'  => array(
                      'alt' => 'Header Style 10 Left',
                      'img' => TX_IMAGES .'h10-l.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style10-right',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 10 Right', 'avas'),
                    'required'  => array( 'header-style-10-position', '=', 'right' ),
                    'options'  => array(
                    'header-style10'  => array(
                      'alt' => 'Header Style 10 Right',
                      'img' => TX_IMAGES .'h10-r.png'
                    ),
                    ),
                ),
                array(
                    'id'            => 'header-style10-width',
                    'type'          => 'slider',
                    'title'         => esc_html__( 'Header Style 10 Width', 'avas' ),
                    'default'       => 250,
                    'min'           => 0,
                    'step'          => 1,
                    'max'           => 2500,
                    'display_value' => 'text',
                    'required'  => array( 'header-select', '=', 'header10' ),
                ),
                array(
                    'id'       => 'banner-bussiness-switch',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Select', 'avas'),
                    'options' => array(
                        '1' => esc_html__('Banner', 'avas'),
                        '2' => esc_html__('Business Info', 'avas'),
                     ), 
                    'default' => '1',
                    'required'  => array( 'header-select', '=', array('header1','header5','header6','header7','header8') ),
                                
                ), 
                array(
                    'id'        => 'h_ads_switch',
                    'type'      => 'button_set',
                    'title'     => esc_html__('Change Ad Mode', 'avas'),
                    'options' => array(
                        '1' => esc_html__('Banner', 'avas'),
                        '2' => esc_html__('Adsense', 'avas'),
                     ), 
                    'default' => '1',
                    'required'  => array( 'banner-bussiness-switch', '=', '1' ),
                ),
                
                array(
                    'title'    => esc_html__('Ad Banner', 'avas'),
                    'id'       => 'head_ad_banner',
                    'subtitle' => esc_html__('Size 728x90','avas'),
                    'type'     => 'media',
                    'complier' => true,
                    'url'      => true,
                    'desc'     => esc_html__( 'You can upload png, jpg, gif image.', 'avas' ),
                    'default'  => array(
                      'url'=> TX_IMAGES . '728x90.jpg'
                    ),
                    'required'  => array(
                                   array( 'h_ads_switch', '=', '1' ),
                                   array( 'banner-bussiness-switch', '=', '1' ),
                                ),
                ),
                array(
                    'id'       => 'head_ad_banner_link',
                    'type'     => 'text',
                    'title'    => esc_html__('Banner link', 'avas'),
                    'required'  => array(
                                   array( 'h_ads_switch', '=', '1' ),
                                   array( 'banner-bussiness-switch', '=', '1' ),
                                ),
                ),
                array(
                    'id'       => 'head_ad_banner_link_new_window',
                    'type'     => 'checkbox',
                    'title'    => esc_html__('Open link in new window', 'avas'), 
                    'default'  => '0',
                    'required'  => array( 'h_ads_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'head_ad_js',
                    'title'    => esc_html__( 'Adsense codes here.', 'avas' ),
                    'subtitle' => esc_html__('Size 728x90','avas'),
                    'type'     => 'ace_editor',
                    'mode'     => 'text',
                    'theme'    => 'chrome',
                    'desc'      => esc_html__('Example: Google Adsense etc', 'avas'),
                    'required'  => array(
                                   array( 'h_ads_switch', '=', '2' ),
                                   array( 'banner-bussiness-switch', '=', '1' ),
                                ),
                ),
                array(
                    'id'             => 'head_ads_space',
                    'type'           => 'spacing',
                    'output'         => array('.head_ads'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Ad Space', 'avas'),
                    'desc'          => esc_html__('Default 10 0 10 0', 'avas'),
                    'required'  => array('banner-bussiness-switch', '=', '1' ),
                ),
                // business information from here
                array(
                    'id'          => 'bs-info',
                    'type'        => 'slides',
                    'title'       => esc_html__('Business information', 'avas'),
                    'subtitle'        => esc_html__('Maximum 3 items allowed. More than 3 items will break the layout.', 'avas'),
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                    'desc'        => esc_html__('Drag and drop sortings.', 'avas'),
                    'placeholder' => array(
                        'title'           => esc_html__('Title', 'avas'),
                        'description'     => esc_html__('Description', 'avas'),
                        'url'             => esc_html__('HTML tag allowed in above two fields.', 'avas'),
                    ),
                ),
                array(
                    'id'             => 'head_binfo_space',
                    'type'           => 'spacing',
                    'output'         => array('.bs-info-area'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Business Info Space', 'avas'),
                    'desc'          => esc_html__('Default 30 0 30 0', 'avas'),
                    'required'  => array('banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'bs-info-title-color',
                    'type'     => 'color',
                    'output'   => array('.info-box .c-box .title, .info-box .c-box .title a'),
                    'title'    => esc_html__( 'Business Info Title Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'bs-info-desc-color',
                    'type'     => 'color',
                    'output'   => array('.info-box .c-box .desc, .info-box .c-box .desc a'),
                    'title'    => esc_html__( 'Business Info Details Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'bs-info-sep-color',
                    'type'     => 'color',
                    'output'   => array('border-color' => '.bs-info-content'),
                    'title'    => esc_html__( 'Business Info Separator Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'typography-bs-info-title',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Business Info Title Font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.info-box .c-box .title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform' => true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'typography-bs-info-desc',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Business Info Details Font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.info-box .c-box .desc'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform' => true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                
                // Main header color options
                array(
                    'id'        => 'main-header-colors',
                    'type'      => 'info',
                    'title'     => esc_html__('Colors Options', 'avas'),
                    'style'     => 'success',
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                // background from here               
                array(
                    'title' => esc_html__( 'Main Header Background Image', 'avas' ),
                    'id'    => 'header-bg',
                    'type'  => 'background',
                    'output'   => array('background'=>'#h-style-1,#h-style-2,#h-style-3,#h-style-4,#h-style-5,#h-style-6,#h-style-7,#h-style-8,#h-style-9,#h-style-10'),
                    'background-color' => false,
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'header-bg-overlay',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.tx-header-overlay' ),
                    'title'    => esc_html__( 'Main Header Background Overlay Color', 'avas' ),
                    'required' => array('header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_bg_color_home',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.home #h-style-1, .home #h-style-2, .home #h-style-3, .home #h-style-4, .home #h-style-5, .home #h-style-6, .home #h-style-7, .home #h-style-8, .home #h-style-9, .home #h-style-10' ),
                    'title'    => esc_html__( 'Main header background color for Home Page only', 'avas' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'sticky_head_bg_color_home',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.home .sticky-header #h-style-1,.home .sticky-header #h-style-2,.home .sticky-header #h-style-3,.home .sticky-header #h-style-4,.home .sticky-header #h-style-5,.home .sticky-header #h-style-6,.home .sticky-header #h-style-7,.home .sticky-header #h-style-8,.home .sticky-header #h-style-9' ),
                    'title'    => esc_html__( 'Sticky header background color for Home Page only', 'avas' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_cont_bg_color_home',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.home .main-header .container' ),
                    'title'    => esc_html__( 'Main Header Content background color for Home Page only', 'avas' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_bg_color_inner',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '#h-style-1,#h-style-2,#h-style-3,#h-style-4,#h-style-5,#h-style-6,#h-style-7,#h-style-8,#h-style-9,#h-style-10' ),
                    'title'    => esc_html__( 'Main header background color for Inner Pages', 'avas' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'sticky_head_bg_color_inner',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.sticky-header #h-style-1,.sticky-header #h-style-2,.sticky-header #h-style-3,.sticky-header #h-style-4,.sticky-header #h-style-5,.sticky-header #h-style-6,.sticky-header #h-style-7,.sticky-header #h-style-8,.sticky-header #h-style-9' ),
                    'title'    => esc_html__( 'Sticky header background color for Inner Pages', 'avas' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_bg_color_container',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.main-header .container' ),
                    'title'    => esc_html__( 'Main header container background color', 'avas' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_border',
                    'type'     => 'border',
                    'title'    => esc_html__('Main header Bottom Border', 'avas'),
                    'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'avas' ),
                    'output'   => array('.main-header'),
                    'top' => false,
                    'right' => false,
                    'left' => false,
                    'color' => false,
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_border_color',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'border-color' => '.main-header',
                     ),
                    'title'    => esc_html__( 'Main header Border color', 'avas' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'sticky_head_border',
                    'type'     => 'border',
                    'title'    => esc_html__('Sticky Header Bottom Border', 'avas'),
                    'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'avas' ),
                    'output'   => array('.sticky-header .header-style-one, .sticky-header .header-style-two, .sticky-header #h-style-3.main-header, .sticky-header .header-style-four, .sticky-header .header-style-five, .sticky-header .header-style-six, .sticky-header .header-style-seven, .sticky-header .header-style-eight, .sticky-header #h-style-9.main-header'),
                    'top' => false,
                    'right' => false,
                    'left' => false,
                    'color' => false,
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'sticky_head_border_color',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'border-color' => '.sticky-header .header-style-one, .sticky-header .header-style-two, .sticky-header #h-style-3.main-header, .sticky-header .header-style-four, .sticky-header .header-style-five, .sticky-header .header-style-six, .sticky-header .header-style-seven, .sticky-header .header-style-eight, .sticky-header #h-style-9.main-header',
                     ),
                    'title'    => esc_html__( 'Sticky Header Border Color', 'avas' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                
    )      
        ) ); 
    // Top header options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Top Header', 'avas'),
        'id'               => 'top-header',
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'           => array(
                array(
                'id'        => 'top_head',
                'type'      => 'switch',
                'default'   => 1,
                'on'        => esc_html__('Enable', 'avas'),
                'off'       => esc_html__('Disable', 'avas'),
                'required'  => array( 'header-select', '!=', 'header10' ),
                ),
                array(
                    'id'             => 'top_head_space',
                    'type'           => 'spacing',
                    'output'         => array('#top_head'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Space', 'avas'),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                // welcome message
                array(
                'id'        => 'wm_switch',
                'type'      => 'switch',
                'title'    =>  esc_html__('Welcome Message', 'avas'),
                'default'   => 0,
                'on'        => esc_html__('On', 'avas'),
                'off'       => esc_html__('Off', 'avas'),
                'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'welcome_msg',
                    'type'     => 'textarea',
                    'default'  => esc_html__('Welcome to Avas WordPress Theme.','avas'),
                    'required'  => array( 'wm_switch', '=', '1' )
                ),
                array(
                    'id'       => 'welcome_msg_color',
                    'type'     => 'color',
                    'output'   => array( '.welcome_msg' ),
                    'title'    => esc_html__( 'Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'wm_switch', '=', '1' )
                ),
                array(
                    'id'       => 'typography-welcome-msg',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Welcome Message', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.welcome_msg'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'line-height'   => true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required'  => array( 'wm_switch', '=', '1' )
                ),
                // date options
                array(
                'id'        => 'tx-date',
                'title'     => esc_html__( 'Date', 'avas' ),
                'type'      => 'switch',
                'default'   => 0,
                'on'        => esc_html__('On', 'avas'),
                'off'       => esc_html__('Off', 'avas'),
                'required'  => array( 'top_head', '=', '1' )
                ),
                // date color
                array(
                    'id'       => 'date-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-date, .tx-date .fa-clock-o' ),
                    'title'    => esc_html__( 'Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-date', '=', '1' )
                ),
                //Phone options
                array(
                    'id'        => 'tx-phone',
                    'title'     => esc_html__( 'Phone', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => esc_html__('On', 'avas'),
                    'off'       => esc_html__('Off', 'avas'),
                    'required'  => array( 'top_head', '=', '1' )
                ), // phone number
                array( 
                    'title'     => esc_html__( 'Enter Phone Number', 'avas' ),
                    'id'        => 'phone-number',
                    'default'   => esc_html__('+1 229-226-7070', 'avas'),
                    'type'      => 'text',
                    'required'  => array( 'tx-phone', '=', '1' ),
                ),
                // phone color
                array(
                    'id'       => 'phone-color',
                    'type'     => 'color',
                    'output'   => array( '.phone-number' ),
                    'title'    => esc_html__( 'Phone Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-phone', '=', '1' )
                ),
                // Email options
                array(
                    'id'        => 'tx-email',
                    'title'     => esc_html__( 'Email', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => esc_html__('On', 'avas'),
                    'off'       => esc_html__('Off', 'avas'),
                    'required'  => array( 'top_head', '=', '1' )
                ), // email address
                array( 
                    'title'     => esc_html__( 'Enter Email Address', 'avas' ),
                    'id'        => 'email-address',
                    'default'   => esc_html__('info@website.com', 'avas'),
                    'type'      => 'text',
                    'required'  => array( 'tx-email', '=', '1' ),
                ),
                // email color
                array(
                    'id'       => 'email-color',
                    'type'     => 'color',
                    'output'   => array( '.email-address' ),
                    'title'    => esc_html__( 'Email Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-email', '=', '1' )
                ),
                // news ticker options
                array(
                    'id'        => 'news_ticker',
                    'type'      => 'switch',
                    'title'     => esc_html__('News Ticker', 'avas'),
                    'default'   => 0,
                    'on'        => 'On',
                    'off'       => 'Off',
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'news_ticker_categories',
                    'type'     => 'select',
                    'data'     => 'categories',
                    'multi'    => true,
                    'title'    => esc_html__( 'Select Categories', 'avas' ),
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                    'id'       => 'news_ticker_orderby',
                    'type'     => 'select',
                    'title' => esc_html__('Orderby', 'avas'),
                    'options'  => array(
                        'meta_value_num'  => esc_html__('Most Views','avas'),
                        'date'  => esc_html__('Date','avas'),
                        'rand'  => esc_html__('Random','avas'),
                        'title'  => esc_html__('Title','avas'),
                        'menu_order'  => esc_html__('Menu Order','avas'),
                        'modified'  => esc_html__('Modified Date','avas'),
                        'parent'  => esc_html__('Parent ID','avas'),
                        'comment_count'  => esc_html__('Comment Count','avas'),
                        'id'  => esc_html__('ID','avas'),
                        'name'  => esc_html__('Slug','avas'),
                        'none'  => esc_html__('None','avas'),
                    ),
                    'default'  => 'meta_value_num',
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                    'id'       => 'news_ticker_order',
                    'type'     => 'select',
                    'title' => esc_html__('Order', 'avas'),
                    'options'  => array(
                        'DESC'  => esc_html__('DESC','avas'),
                        'ASC'  => esc_html__('ASC','avas'),
                    ),
                    'default'  => 'DESC',
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                'id'            => 'newsticker-posts-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Count', 'avas' ),
                'default'       => 5,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text',
                'required'  => array('news_ticker', '=', '1' ),
                ),
                array( 
                'title'     => esc_html__( 'News Ticker Text', 'avas' ),
                'id'        => 'news_ticker_bar_text',
                'default'   => esc_html__('Trending', 'avas'),
                'type'      => 'text',
                'required'  => array('news_ticker', '=', '1' ),
                ),
                // News ticker color / Tending color options
                array(
                    'id'       => 'news-ticker-title-color',
                    'type'     => 'color',
                    'output'   => array( '.news-ticker-title a' ),
                    'title'    => esc_html__( 'Text color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                    'id'       => 'news-ticker-title-hover',
                    'type'     => 'color',
                    'output'   => array( '.news-ticker-title a:hover' ),
                    'title'    => esc_html__( 'Text hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                    'id'       => 'tx_news_ticker_bar',
                    'type'     => 'color',
                    'output'   => array( 'background-color'=>'.tx_news_ticker_bar' ),
                    'title'    => esc_html__( 'Label background color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                    'id'       => 'tx_news_ticker_bar_color',
                    'type'     => 'color',
                    'output'   => array( 'color'=>'.tx_news_ticker_bar' ),
                    'title'    => esc_html__( 'Label text color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_color',
                    'type'     => 'color',
                    'output'   => array( 'color'=>'.news-ticker-btns a' ),
                    'title'    => esc_html__( 'Nav text color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_border_color',
                    'type'     => 'color',
                    'output'   => array( 'border-color'=>'.news-ticker-btns a' ),
                    'title'    => esc_html__( 'Nav border color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'color'=>'.news-ticker-btns a:hover' ),
                    'title'    => esc_html__( 'Nav hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_background_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'background-color'=>'.news-ticker-btns a:hover' ),
                    'title'    => esc_html__( 'Nav background hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_border_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'border-color'=>'.news-ticker-btns a:hover' ),
                    'title'    => esc_html__( 'Nav border hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                // top menu
                array(
                    'id'        => 'top_menu',
                    'title'     => esc_html__( 'Top Menu', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 0,
                    'on'        => esc_html__('On', 'avas'),
                    'off'       => esc_html__('Off', 'avas'),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'top-menu-link-color',
                    'type'     => 'color',
                    'output'   => array( '.top_menu > li > a' ), 
                    'title'    => esc_html__( 'Top Menu link color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'top_menu', '=', '1' )
                ),
                array(
                    'id'       => 'top-menu-link-hover-color',
                    'type'     => 'color',
                    'output'   => array( '.top_menu > li > a:hover, .top_menu > li > a:focus' ),
                    'title'    => esc_html__( 'Top Menu link hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'top_menu', '=', '1' )
                ),
                // login register
                array(
                'id'        => 'login_reg',
                'title'     => esc_html__( 'Login', 'avas' ),
                'type'      => 'switch',
                'default'   => 0,
                'on'        => esc_html__('On', 'avas'),
                'off'       => esc_html__('Off', 'avas'),
                'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                'id'       => 'login-register',
                'type'     => 'text',
                'title'    => esc_html__('Enter text for Login','avas'),
                'default'  => 'Login',
                'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                'id'       => 'signup-text',
                'type'     => 'text',
                'title'    => esc_html__('Enter register page name','avas'),
                'default'  => 'my-account',
                'desc'     => esc_html__('Example: If you use WooCommerce plugin you can enter "http://your-website-name.com/my-account" or if you use Learnpress plugin then enter "http://your-website-name.com/profile".','avas'),
                'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                    'id'       => 'login-link-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.login_button' ),
                    'title'    => esc_html__( 'Login link color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                    'id'       => 'login-link-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.login_button:hover,.login_button:focus' ),
                    'title'    => esc_html__( 'Login link hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                    'id'       => 'login-form-btn-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.tx-login input.submit_button' ),
                    'title'    => esc_html__( 'Login Form Button color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                    'id'       => 'login-form-btn-hov-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.tx-login input.submit_button:hover' ),
                    'title'    => esc_html__( 'Login Form Button hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array( 'login_reg', '=', '1' ),
                ),
                // social icons top header
                array(
                    'id'        => 'social_buton_top',
                    'title'     => esc_html__( 'Social Icons', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => esc_html__('On', 'avas'),
                    'off'       => esc_html__('Off', 'avas'),
                    'required'  => array( 'top_head', '=', '1' )
                ),

                array(
                    'id'       => 'social-media-icon-header-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#header .top-header-right-area .social li a i' ),
                    'title'    => esc_html__( 'Social icon color on header', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'social_buton_top', '=', '1' )
                ),
                array(
                    'id'       => 'social-media-icon-header-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#header .social li a:hover i' ),
                    'title'    => esc_html__( 'Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'social_buton_top', '=', '1' )
                ),
                // Top header color options
                array(
                    'id'        => 'top-header-colors',
                    'type'      => 'info',
                    'title'     => esc_html__('Colors Options', 'avas'),
                    'style'     => 'success',
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'top_head_bg_color_home',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.home #top_head',
                     ),
                    'title'    => esc_html__( 'Top header background color for Home Page only', 'avas' ),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'top_head_bg_color_inner',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '#top_head, .home .sticky-header #top_head',
                     ),
                    'title'    => esc_html__( 'Top header background color for inner pages', 'avas' ),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array( 
                    'id'       => 'top_head_border',
                    'type'     => 'border',
                    'title'    => esc_html__('Bottom Border', 'avas'),
                    'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'avas' ),
                    'output'   => array('#top_head'),
                    'top' => false,
                    'right' => false,
                    'left' => false,
                    'color' => false,
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'top_head_border_color',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'border-color' => '#top_head',
                     ),
                    'title'    => esc_html__( 'Border color', 'avas' ),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                // Top header font options
                array(
                    'id'        => 'top-header-fonts',
                    'type'      => 'info',
                    'title'     => esc_html__('Fonts Options', 'avas'),
                    'style'     => 'success',
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'typography-top-header',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Top header', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#top_head'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'line-height' => true,
                    'word-spacing'  => true,
                    'text-transform'=> true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => false, 
                    'required'  => array( 'top_head', '=', '1' )
                ),

            )));    
    // Sub header options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Sub Header', 'avas'),
        'id'               => 'sub-header',
        'subsection'       => true,
        'desc'             => esc_html__( 'Sub header options','avas'),
        'customizer_width' => '400px',
        'fields'           => array(
                array(
                    'title'    => esc_html__( 'Enable / Disable','avas'),
                    'id'       => 'sub-header-switch',
                    'type'     => 'switch',
                    'on'       => esc_html__('Enable', 'avas'),
                    'off'      => esc_html__('Disable', 'avas'),
                    'default'  => 1,
                    ),
               
                array(
                    'title'    => esc_html__( 'Title','avas'),
                    'id'       => 'sub_h_title',
                    'type'     => 'switch',
                    'on'       => esc_html__('On', 'avas'),
                    'off'      => esc_html__('Off', 'avas'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'default'  => 1,
                ),
                array(
                    'id'       => 'sub_h_post_title',
                    'type'     => 'checkbox',
                    'required' => array('sub_h_title', '=', '1' ),
                    'options'  => array(
                        'page' => esc_html__('Page', 'avas'),
                        'post' => esc_html__('Post', 'avas'),
                        'service' => esc_html__('Services', 'avas'),
                        'portfolio' => esc_html__('Portfolios', 'avas'),
                        'team' => esc_html__('Team', 'avas'),
                        'lp_course' => esc_html__('LearnPress', 'avas'),
                        'product' => esc_html__('WooCommerce', 'avas')
                    ),
                    'default' => array(
                        'page'    => '1', 
                        'post'    => '1', 
                        'service' => '1',
                        'portfolio' => '1',
                        'team' => '1',
                        'lp_course' => '1',
                        'product' => '1',
                    )
                ),
                array(
                    'title'    => esc_html__( 'Breadcrumbs','avas'),
                    'id'       => 'breadcrumbs',
                    'type'     => 'switch',
                    'on'       => esc_html__('On', 'avas'),
                    'off'      => esc_html__('Off', 'avas'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'default'  => 1,
                ),
                array(
                    'id'       => 'sub_h_post_breadcrumbs',
                    'type'     => 'checkbox',
                    'required' => array('breadcrumbs', '=', '1' ),
                    'options'  => array(
                        'page' => esc_html__('Page', 'avas'),
                        'post' => esc_html__('Post', 'avas'),
                        'service' => esc_html__('Services', 'avas'),
                        'portfolio' => esc_html__('Portfolios', 'avas'),
                        'team' => esc_html__('Team', 'avas'),
                        'lp_course' => esc_html__('LearnPress', 'avas'),
                        'product' => esc_html__('WooCommerce', 'avas')
                    ),
                    'default' => array(
                        'page'    => '1',
                        'post'    => '1',
                        'service' => '1',
                        'portfolio' => '1',
                        'team' => '1',
                        'lp_course' => '1',
                        'product' => '1',
                    )
                ),
                array(
                    'id'             => 'sub_h_space',
                    'type'           => 'spacing',
                    'output'         => array('.sub-header, .sub-header-blog'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'required'  => array( 'sub-header-switch', '=', '1' ),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Space', 'avas'),
                    'default'            => array(
                    'padding-top'     => '', 
                    'padding-right'   => '', 
                    'padding-bottom'  => '', 
                    'padding-left'    => '',
                    'units'          => 'px', 
                    )
                ),
                array(
                    'title' => esc_html__( 'Title color', 'avas' ),
                    'id'    => 'sub-header-title-color',
                    'type'  => 'color',
                    'output'   => array('.sub-header-title'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Link color', 'avas' ),
                    'id'    => 'sub-header-link-color',
                    'type'  => 'color',
                    'output'   => array('.breadcrumbs span a'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Link hover color', 'avas' ),
                    'id'    => 'sub-header-link-hover-color',
                    'type'  => 'color',
                    'output'   => array('.breadcrumbs span a:hover'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Separate color', 'avas' ),
                    'id'    => 'sub-header-separate-color',
                    'type'  => 'color',
                    'output'   => array('.breadcrumbs .breadcrumbs__separator'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Active link color', 'avas' ),
                    'id'    => 'sub-header-active-link-color',
                    'type'  => 'color',
                    'output'   => array('.breadcrumbs .breadcrumbs__current'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Background', 'avas' ),
                    'id'    => 'sub-header-bg',
                    'type'  => 'background',
                    'output'   => array('background-color'=>'.sub-header'),
                    'required' => array('sub-header-switch', '=', '1' ),
                ),
                array(
                    'id'       => 'sub-header-bg-overlay',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.sub-header-overlay' ),
                    'title'    => esc_html__( 'Background Overlay Color', 'avas' ),
                    'required' => array('sub-header-switch', '=', '1' ),
                ),
                array(
                    'id'       => 'typography-sub-header',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Sub header Title', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.sub-header-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform' => true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('sub-header-switch', '=', '1' ),
                ),
                array(
                    'id'       => 'typography-breadcrumbs',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Breadcrumbs', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.breadcrumbs'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform' => true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('sub-header-switch', '=', '1' ),
                ),
            )
        ));
    // Menu options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Menu', 'avas'),
        'id'               => 'menu_opt',
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'           => array(
                array(
                    'id'       => 'menu-left-width',
                    'type'     => 'dimensions',
                    'output'   => 'nav.site-navigation.navigation',
                    'units'    => array('%'),
                    'desc'     => esc_html__('It has Menu Item only.','avas'),
                    'subtitle' => esc_html__('Default width 80%.','avas'),
                    'title'    => esc_html__('Menu Left Side Width', 'avas'),
                    'height'   => false,
                    'width'    => true,
                    'default'  => array(
                        'Width'   => '80', 
                    ),
                ),
                array(
                    'id'       => 'menu-right-width',
                    'type'     => 'dimensions',
                    'output'   => '.menu-area-right',
                    'desc'     => esc_html__('It has Menu button, Seach icon, Side Menu button.','avas'),
                    'subtitle' => esc_html__('Default width 20%.','avas'),
                    'units'    => array('%'),
                    'title'    => esc_html__('Menu Right Side Width', 'avas'),
                    'height'    => false,
                    'default'  => array(
                        'Width'   => '20', 
                    ),
                ),
                array(
                    'id'       => 'menu-alignment',
                    'type'     => 'select',
                    'title' => esc_html__('Menu Alignment', 'avas'),
                    'options'  => array(
                        'none'  => esc_html__('None','avas'),
                        'left'  => esc_html__('Left','avas'),
                        'right'  => esc_html__('Right','avas'),
                        'center'  => esc_html__('Center','avas'),
                    ),
                    'default'  => 'none',
                ),
                array(
                    'id'             => 'menu_bar_padding',
                    'type'           => 'spacing',
                    'output'         => array('.menu-bar'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'title'          => esc_html__('Main Menu Bar Padding', 'avas'),
                ),
                array(
                    'id'             => 'menu_padding',
                    'type'           => 'spacing',
                    'output'         => array('.main-menu>li>a,.header-style-eight .main-menu>li>a, .header-style-four .main-menu>li>a, .header-style-one .main-menu>li>a, .header-style-seven .main-menu>li>a, .header-style-six .main-menu>li>a, .header-style-two .main-menu>li>a, #h-style-10 .main-menu>li>a'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'title'          => esc_html__('Main Menu Item Padding', 'avas'),
                ),
               
                array(
                    'id'       => 'menu-border',
                    'type'     => 'border',
                    'title'    => esc_html__('Menu Bar Border', 'avas'),
                    'desc'     => esc_html__( 'Enter border width ex: 1, 2, 3 etc to enable border. 0 to disable.', 'avas' ),
                    'output'   => array('.menu-bar'),
                    'color'    => true,
                    'left'     => false,
                    'right'    => false,
                ),
                array(
                    'id'       => 'menu_bar_bg_color_home',
                    'title'    => esc_html__( 'Menu Bar background color for Home Page only', 'avas' ),
                    'type'     => 'color_rgba',
                    'mode'     => 'background',
                    'validate' => 'colorrgba',
                    'output'   => array( 'background-color' => '.home .menu-bar' ),
                ),
                array(
                    'id'       => 'menu_bar_bg_color_inner',
                    'title'    => esc_html__( 'Menu Bar background color for Inner Pages', 'avas' ),
                    'type'     => 'color_rgba',
                    'output'   => array( 
                        'background-color' => '.menu-bar, .home .sticky-header .menu-bar',
                    ),
                    
                ),
                array(
                    'id'       => 'menu-link-color',
                    'type'     => 'color',
                    'output'   => array( 'ul.main-menu>li>a,.navbar-collapse > ul > li > a,.navbar-collapse > ul > li > ul > li > a,.navbar-collapse > ul > li > ul > li > ul > li > a,.navbar-collapse > ul > li > span > i, .navbar-collapse > ul > li > ul > li > span > i,.mb-dropdown-icon:before,.tx-res-menu li a' ), 
                    'title'    => esc_html__( 'Main Menu link color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home ul.main-menu>li>a,.home .navbar-collapse > ul > li > a,.home .navbar-collapse > ul > li > ul > li > a,.home .navbar-collapse > ul > li > ul > li > ul > li > a,.home .navbar-collapse > ul > li > span > i,.home .navbar-collapse > ul > li > ul > li > span > i,.home .mb-dropdown-icon:before,.tx-res-menu li a' ), 
                    'title'    => esc_html__( 'Main Menu link color Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'ul.main-menu>li>a:hover, ul.main-menu>li>a:focus,ul.main-menu>li.menu-item-has-children a:hover,ul.main-menu>li.menu-item-has-children a:focus, .tx-mega-menu .mega-menu-item .depth0 li .depth1.standard.sub-menu li a:hover' ),
                    'title'    => esc_html__( 'Main Menu link hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-hover-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home ul.main-menu>li>a:hover,.home ul.main-menu>li>a:focus,ul.main-menu>li.menu-item-has-children a:hover,.home ul.main-menu>li.menu-item-has-children a:focus' ),
                    'title'    => esc_html__( 'Main Menu link hover color Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-active-link-color',
                    'type'     => 'color',
                    'output'   => array( 'ul.main-menu>li.current-menu-item > a,ul.main-menu>li.current-page-ancestor > a, ul.main-menu>li.current-menu-ancestor > a, ul.main-menu>li.current-menu-parent > a, ul.main-menu>li.current_page_ancestor > a, ul.main-menu.active>a:hover' ),
                    'title'    => esc_html__( 'Main Menu link active color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-active-link-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home ul.main-menu>li.current-menu-item > a,.home ul.main-menu>li.current-page-ancestor > a, .home ul.main-menu>li.current-menu-ancestor > a,.home ul.main-menu>li.current-menu-parent > a, .home ul.main-menu>li.current_page_ancestor > a, .home ul.main-menu.active>a:hover' ),
                    'title'    => esc_html__( 'Main Menu link active color Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-bg-hover-color',
                    'type'     => 'color',
                    'output'   => array('background-color' => 'ul.main-menu>li>a:hover, ul.main-menu>li>a:focus' ),
                    'title'    => esc_html__( 'Main Menu link background hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-bg-hover-color-home',
                    'type'     => 'color',
                    'output'   => array('background-color' => '.home ul.main-menu>li>a:hover, .home ul.main-menu>li>a:focus' ),
                    'title'    => esc_html__( 'Main Menu link background hover color Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-active-link-bg-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => 'ul.main-menu>li.current-menu-item > a,ul.main-menu>li.current-page-ancestor > a, ul.main-menu>li.current-menu-ancestor > a, ul.main-menu>li.current-menu-parent > a, ul.main-menu>li.current_page_ancestor > a, ul.main-menu.active>a:hover' ),
                    'title'    => esc_html__( 'Main Menu link active background color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-active-link-bg-color-home',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.home ul.main-menu>li.current-menu-item > a,.home ul.main-menu>li.current-page-ancestor > a, .home ul.main-menu>li.current-menu-ancestor > a, .home ul.main-menu>li.current-menu-parent > a, .home ul.main-menu>li.current_page_ancestor > a, .home ul.main-menu.active>a:hover' ),
                    'title'    => esc_html__( 'Main Menu link active background color Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                // sub menu color
                array(
                    'id'       => 'sub-menu-bg-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' =>'.main-menu li > ul' ), 
                    'title'    => esc_html__( 'Sub Menu background color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sub-menu-link-color',
                    'type'     => 'color',
                    'output'   => array( 'color' =>'.main-menu li ul li a,.tx-mega-menu .mega-menu-item .depth0 li .depth1.standard.sub-menu li a' ), 
                    'title'    => esc_html__( 'Sub Menu link color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sub-menu-link-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' =>'.tx-mega-menu .mega-menu-item .depth0 li .depth1.standard.sub-menu li a:hover,.tx-mega-menu .mega-menu-item .depth0 li .depth1.sub-menu li a:hover, .depth0.standard.sub-menu li a:hover' ), 
                    'title'    => esc_html__( 'Sub Menu link hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sub-menu-border-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' =>'.main-menu li ul li a' ), 
                    'title'    => esc_html__( 'Sub Menu border color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                // Mega menu color
                array(
                        'id'       => 'mega-menu-columns-border',
                        'type'     => 'border',
                        'title'    => esc_html__('Mega Menu Columns Separator', 'avas'),
                        'desc'     => esc_html__( 'Enter border width ex: 1, 2, 3 etc to enable border. 0 to disable.', 'avas' ),
                        'output'   => array('.tx-mega-menu .mega-menu-item .depth0.sub-menu> li'),
                        'color'    => true,
                        'top'      => false,
                        'left'     => false,
                        'bottom'   => false,
                    ),
                array(
                    'id'       => 'mega-menu-columns-title-color',
                    'type'     => 'color',
                    'output'   => array( 'color' =>'.tx-mega-menu .mega-menu-item .depth0 li .mega-menu-title' ), 
                    'title'    => esc_html__( 'Mega Menu Columns Title Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                
                // menu fonts
                array(
                    'id'       => 'menu-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Menu fonts', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.main-menu>li>a'),
                    'units'       =>'px',
                     'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                ),
                // Sub Menu fonts options
                array(
                    'id'       => 'sub-menu-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Sub Menu fonts', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.main-menu>li>ul>li>a,.main-menu>li>ul>li>ul>li>a,.main-menu>li>ul>li>ul>li>ul>li>a,.main-menu>li>ul>li>ul>li>ul>li>ul>li>a,.tx-mega-menu .mega-menu-item .depth0 li .depth1.standard.sub-menu li a,.tx-mega-menu .mega-menu-item .depth0 li .depth1 li a'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                ),
                array(
                    'id'        => 'menu-dropdown-icon',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Dropdown Icon', 'avas'),
                    'default'   => 0,
                    'on'        => esc_html__('On','avas'),
                    'off'       => esc_html__('Off','avas'),
                ),
                array(
                    'id'            => 'menu-dropdown-icon-valign',
                    'type'          => 'slider',
                    'title'         => esc_html__( 'Menu Dropdown Icon Vertical Align', 'avas' ),
                    'min'           => 0,
                    'step'          => 1,
                    'max'           => 100,
                    'display_value' => 'text',
                    'required'  => array( 'menu-dropdown-icon', '=', '1' ),
                ),
                array(
                    'id'        => 'menu_item_border',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Item Border on Hover', 'avas'),
                    'default'   => 0,
                    'on'        => esc_html__('On','avas'),
                    'off'       => esc_html__('Off','avas'),
                ),
                array(
                'id'       => 'menu_item_border_select',
                'type'     => 'select',
                'title'    => esc_html__('Select Position', 'avas'), 
                'options'  => array(
                    'menu_item_border_top' => 'Top',
                    'menu_item_border_bottom' => 'Bottom',
                    ),
                'default'  => 'menu_item_border_top',
                'required'  => array( 'menu_item_border', '=', '1' ),
                ),
                array(
                'id'       => 'menu-top-border-hover-color',
                'type'     => 'color',
                'output'   => array( '.main-menu>li:hover a:before' ),
                'title'    => esc_html__( 'Main Menu link top border hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required'  => array( 'menu_item_border', '=', '1' ),
                ),
                // menu item separator
                array(
                    'id'        => 'menu-item-seprator',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Item Separator', 'avas'),
                    'default'   => 0,
                    'on'        => esc_html__('On','avas'),
                    'off'       => esc_html__('Off','avas'),
                ),
                array(
                    'id'       => 'menu-item-seprator-border',
                    'type'     => 'border',
                    'title'    => esc_html__('Menu Item Separator Border', 'avas'),
                    'subtitle'    => esc_html__('It will show right border to separate.', 'avas'),
                    'desc'     => esc_html__( 'Enter border width ex: 1, 2, 3 etc to enable border. 0 to disable.', 'avas' ),
                    'output'   => array('.main-menu > li'),
                    'color'    => true,
                    'left'     => false,
                    'top'      => false,
                    'bottom'   => false,
                    'default'  => array(
                        'border-style'  => 'solid', 
                        'border-right' => '0px',
                        'border-top' => '0px',
                        'border-bottom' => '0px',
                    ),
                    'required'  => array( 'menu-item-seprator', '=', '1' ),
                ),
                // Menu Highlight Callouts Text Button
                array(
                    'id'        => 'menu-highlight-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Menu Highlight Callouts Text Button', 'avas'),
                    'style'     => 'success', //success warning
                ),
                array(
                    'id'          => 'menu-highlight-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.tx-menu-highlight'),
                    'title'       => esc_html__( 'Menu Highlight text color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                ),
                array(
                    'id'       => 'menu-highlight-bg-color',
                    'type'     => 'color_rgba',
                    'output'      => array('background-color' => '.tx-menu-highlight'),
                    'title'       => esc_html__( 'Menu Highlight background color', 'avas' ),
                ),
                array(
                    'id'             => 'menu-highlight-padding',
                    'type'           => 'spacing',
                    'output'         => array('.tx-menu-highlight'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Menu Highlight padding', 'avas'),
                ),
                array(
                    'id'       => 'menu-highlight-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Menu Highlight font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.tx-menu-highlight'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                ),
                array(
                    'id'        => 'menu-highlight-animation',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Highlight animation disable', 'avas'),
                    'default'   => 0,
                    'on'        => esc_html__('Yes','avas'),
                    'off'       => esc_html__('No','avas'),
                ),

                //Responsive menu / mobile menu
                array(
                'id'        => 'res-mob-menu-info',
                'type'      => 'info',
                'title'     => esc_html__('Responsive / Mobile Menu settings', 'avas'),
                'style'     => 'success', //success warning
                ),
                array(
                    'id'          => 'mobile-top-menu-icon-color',
                    'type'        => 'color',
                    'output'      => array('color' => '#responsive-menu-top .navbar-header .navbar-toggle i'),
                    'title'       => esc_html__( 'Responsive Top Menu icon color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'top_menu', '=', '1' )
                    ),
                array(
                    'id'          => 'mobile-top-menu-icon-color-home',
                    'type'        => 'color',
                    'output'      => array('color' => '.home #responsive-menu-top .navbar-header .navbar-toggle i'),
                    'title'       => esc_html__( 'Responsive Top Menu icon color for Home Page only', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'top_menu', '=', '1' )
                    ),
                array(
                    'id'          => 'mobile-menu-icon-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.navbar-header .navbar-toggle i'),
                    'title'       => esc_html__( 'Responsive Main Menu icon color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'          => 'mobile-menu-icon-bg-color',
                    'type'        => 'color',
                    'output'      => array('background-color' => '.navbar-header .navbar-toggle i'),
                    'title'       => esc_html__( 'Responsive Main Menu icon background color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'          => 'mobile-menu-icon-color-home',
                    'type'        => 'color',
                    'output'      => array('color' => '.home .navbar-header .navbar-toggle i'),
                    'title'       => esc_html__( 'Responsive Main Menu icon color for Home Page only', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'          => 'mobile-menu-icon-bg-color-home',
                    'type'        => 'color',
                    'output'      => array('background-color' => '.home .navbar-header .navbar-toggle i'),
                    'title'       => esc_html__( 'Responsive Main Menu icon background color for Home Page only', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'             => 'mobile-menu-icon-padding',
                    'type'           => 'spacing',
                    'output'         => array('.navbar-header .navbar-toggle i'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Responsive Main Menu icon padding', 'avas'),
                ),
                array(
                    'id'          => 'mobile-menu-item-color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Responsive Menu item color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'          => 'mobile-menu-bg-color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Responsive Menu background color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'          => 'mobile-menu-border-color',
                    'type'        => 'color',
                    'output'      => array('border-color' => '.navbar-collapse li'),
                    'title'       => esc_html__( 'Responsive Menu Dropdown border color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                // menu button options
                array(
                'id'        => 'menu-btn-info',
                'type'      => 'info',
                'title'     => esc_html__('Menu Button settings', 'avas'),
                'style'     => 'success', //success warning
                ),
                array(
                    'id'        => 'menu_btn_switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Button', 'avas'),
                    'default'   => 0,
                    'on'        => 'On',
                    'off'       => 'Off',
                ),
                array( 
                    'title'     => esc_html__( 'Button Text', 'avas' ),
                    'id'        => 'menu_btn_txt',
                    'default'   => esc_html__('Button', 'avas'),
                    'type'      => 'text',
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array( 
                    'title'     => esc_html__( 'Button URL', 'avas' ),
                    'id'        => 'menu_btn_url',
                    'default'   => esc_html__('#', 'avas'),
                    'type'      => 'text',
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu_btn_link_new_window',
                    'type'     => 'checkbox',
                    'title'    => esc_html__('Open link in new window', 'avas'), 
                    'default'  => 0,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'             => 'menu_btn_padding',
                    'type'           => 'spacing',
                    'output'         => array('.tx-menu-btn'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Menu Button Padding', 'avas'),
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'             => 'menu_btn_margin',
                    'type'           => 'spacing',
                    'output'         => array('.tx-menu-btn-wrap'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Menu Button Margin', 'avas'),
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                // Menu button colors
                array(
                    'id'       => 'menu-btn-bg-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.tx-menu-btn' ), 
                    'title'    => esc_html__( 'Menu Button Background Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-bg-hov-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.tx-menu-btn:hover,.tx-menu-btn:focus' ), 
                    'title'    => esc_html__( 'Menu Button Background Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-menu-btn' ), 
                    'title'    => esc_html__( 'Menu Button Text Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-hov-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-menu-btn:hover,.tx-menu-btn:focus' ), 
                    'title'    => esc_html__( 'Menu Button Text Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                   'id'       => 'menu-btn-border',
                    'type'     => 'border',
                    'title'    => esc_html__('Menu Button Border', 'avas'),
                    'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'avas' ),
                    'output'   => array('.tx-menu-btn'),
                    'color' => false,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                    ),
                array(
                    'id'            => 'menu-btn-border-radius',
                    'type'          => 'slider',
                    'title'         => esc_html__( 'Menu Button Border Radius', 'avas' ),
                    'min'           => 0,
                    'step'          => 1,
                    'max'           => 100,
                    'display_value' => 'text',
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-bord-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '.tx-menu-btn' ), 
                    'title'    => esc_html__( 'Menu Button Border Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-bord-hov-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '.tx-menu-btn:hover' ), 
                    'title'    => esc_html__( 'Menu Button Border Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),

                // menu button fonts options
                array(
                    'id'       => 'menu-btn-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Menu Button', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.tx-menu-btn'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                // cart icon options
                array(
                'id'        => 'cart-icon-info',
                'type'      => 'info',
                'title'     => esc_html__('Cart settings', 'avas'),
                'style'     => 'success', //success warning
                ),
                array(
                    'id'        => 'tx-cart',
                    'type'      => 'switch',
                    'title'     => esc_html__('Cart Icon', 'avas'),
                    'desc'     => esc_html__('Need to activate WooCommece plugin.', 'avas'),
                    'default'   => 0,
                    'on'        => 'On',
                    'off'       => 'Off',
                ),
                array(
                    'id'             => 'tx-cart_space',
                    'type'           => 'spacing',
                    'output'         => array('.tx-cart'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => false,
                    'title'          => esc_html__('Cart Space', 'avas'),
                    'required'  => array( 'tx-cart', '=', '1' ),
                ),
                array(
                    'id'       => 'tx-cart-icon-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-cart' ),
                    'title'    => esc_html__( 'Header Cart icon color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-cart', '=', '1' ),
                ),
                array(
                    'id'       => 'tx-cart-icon-hover-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-cart:hover' ),
                    'title'    => esc_html__( 'Header Cart icon hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-cart', '=', '1' ),
                ),
                array(
                    'id'       => 'tx-cart-icon-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home .tx-cart' ),
                    'title'    => esc_html__( 'Header Cart icon color on Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-cart', '=', '1' ),
                ),
                array(
                    'id'       => 'tx-cart-icon-hover-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home .tx-cart:hover' ),
                    'title'    => esc_html__( 'Header Cart icon hover color on Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-cart', '=', '1' ),
                ),
                array(
                'id'        => 'search-icon-info',
                'type'      => 'info',
                'title'     => esc_html__('Search Icon settings', 'avas'),
                'style'     => 'success', //success warning
                ),
                // search icon option
                array(
                    'id'        => 'search',
                    'type'      => 'switch',
                    'title'     => esc_html__('Search Icon', 'avas'),
                    'default'   => 1,
                    'on'        => 'On',
                    'off'       => 'Off',
                ),
                array(
                    'id'             => 'search_space',
                    'type'           => 'spacing',
                    'output'         => array('.search-icon'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Search Space', 'avas'),
                    'required'  => array( 'search', '=', '1' ),
                ),
                //search icon color
                array(
                    'id'       => 'search-icon-color',
                    'type'     => 'color',
                    'output'   => array( '.search-icon' ),
                    'title'    => esc_html__( 'Header Search icon color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                array(
                    'id'       => 'search-icon-hover-color',
                    'type'     => 'color',
                    'output'   => array( '.search-icon:hover' ),
                    'title'    => esc_html__( 'Search icon hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                array(
                    'id'       => 'search-icon-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home .search-icon' ),
                    'title'    => esc_html__( 'Header Search icon color on Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                array(
                    'id'       => 'search-icon-hover-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home .search-icon:hover' ),
                    'title'    => esc_html__( 'Search icon hover color on Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                array(
                    'id'       => 'search-icon-close-color',
                    'type'     => 'color',
                    'output'   => array( '.search-box > .search-close,.search-box > .search-close i' ),
                    'title'    => esc_html__( 'Search close icon color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                array(
                    'id'       => 'search-icon-close-hover-color',
                    'type'     => 'color',
                    'output'   => array( '.search-box > .search-close:hover,.search-close:hover i,.search-box > .search-close:hover i' ),
                    'title'    => esc_html__( 'Search close icon hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                // side menu options
                array(
                'id'        => 'side-menu-info',
                'type'      => 'info',
                'title'     => esc_html__('Side Menu settings', 'avas'),
                'style'     => 'success', //success warning
                ),
                array(
                    'id'        => 'side_menu',
                    'type'      => 'switch',
                    'title'     => esc_html__('Side Menu', 'avas'),
                    'default'   => 1,
                    'on'        => 'On',
                    'off'       => 'Off',
                ),
                 array(
                    'id'             => 'side_menu_margin',
                    'type'           => 'spacing',
                    'output'         => array('#side-menu-icon'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Side Menu Space', 'avas'),
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                // side menu colors
                array(
                    'id'       => 'side-menu-icon-color',
                    'type'     => 'color',
                    'output'   => array( '.side_menu_icon' ), 
                    'title'    => esc_html__( 'Side Menu Icon Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-icon-color-hover',
                    'type'     => 'color',
                    'output'   => array( '.side_menu_icon:hover' ), 
                    'title'    => esc_html__( 'Side Menu Icon Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-icon-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home .side_menu_icon' ), 
                    'title'    => esc_html__( 'Side Menu Icon Color on Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-icon-color-hover-home',
                    'type'     => 'color',
                    'output'   => array( '.home .side_menu_icon:hover' ), 
                    'title'    => esc_html__( 'Side Menu Icon Hover Color on Home Page', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-icon-close-color',
                    'type'     => 'color',
                    'output'   => array( '.side-menu .s-menu-icon-close' ), 
                    'title'    => esc_html__( 'Side Menu Icon Close Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-icon-close-color-hover',
                    'type'     => 'color',
                    'output'   => array( '.side-menu .s-menu-icon-close:hover' ), 
                    'title'    => esc_html__( 'Side Menu Icon Close Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-bg-color',
                    'type'     => 'color',
                    'output'   => array('background-color' => '#side-menu-wrapper' ), 
                    'title'    => esc_html__( 'Side Menu Background Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-text-color',
                    'type'     => 'color',
                    'output'   => array('#side-menu-wrapper' ), 
                    'title'    => esc_html__( 'Side Menu Text Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-link-color',
                    'type'     => 'color',
                    'output'   => array('.side-menu a' ), 
                    'title'    => esc_html__( 'Side Menu Link Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-link-hover-color',
                    'type'     => 'color',
                    'output'   => array('.side-menu a:hover' ), 
                    'title'    => esc_html__( 'Side Menu Link Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-widget-title-color',
                    'type'     => 'color',
                    'output'   => array('#side-menu-wrapper .widget-title' ), 
                    'title'    => esc_html__( 'Side Menu Widget Title Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                // side menu fonts options
                array(
                    'id'       => 'side-menu-icon-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Side Menu Icon', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#side-menu-icon'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => false,
                    'word-spacing'  => false,
                    'letter-spacing'=> false,
                    'color'         => false,
                    'text-transform' => false,
                    'text-align'    => false,
                    'subsets'       => false, 
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Side Menu', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.side-menus'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-text-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Side Menu Text', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#side-menu-wrapper p'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => false,
                    'acync_typography' => false,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-widget-title-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Side Menu Widget Title', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#side-menu-wrapper .widget-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
            )));
        // Post options / blog options
        Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Posts', 'avas' ),
        'id'         => 'blog-option',
        'icon'       => 'fa fa-thumb-tack',
        'fields'     => array(
            // Sidebar index, archive
                array(
                'id'       => 'sidebar-select',
                'type'     => 'select',
                'title'    => esc_html__('Select Sidebar', 'avas'), 
                'desc'     => esc_html__('For blog, archive, category, tag pages sidebar.', 'avas'),
                'options'  => array(
                    'sidebar-right' => 'Right Sidebar',
                    'sidebar-left' => 'Left Sidebar',
                    'sidebar-none' => 'None',
                    ),
                'default'  => 'sidebar-right',
                ),
                // sidebar single post
                array(
                'id'       => 'sidebar-single',
                'type'     => 'select',
                'title'    => esc_html__('Single Sidebar', 'avas'), 
                'desc'     => esc_html__('For Single Post Sidebar', 'avas'),
                'options'  => array(
                    'sidebar-right' => 'Right Sidebar',
                    'sidebar-left' => 'Left Sidebar',
                    'sidebar-none' => 'None',
                    ),
                'default'  => 'sidebar-none',
                ),
                array(
                    'id' => 'cat_temp_style',
                    'title' => esc_html__('Taxonomy Template Style', 'avas'),
                    'type' => 'image_select',
                    'options' => array (
                        'cat_style_1' => array('title' => 'Style 1', 'img' => TX_IMAGES . 'cat-style-1.png'),
                        'cat_style_2' => array('title' => 'Style 2', 'img' => TX_IMAGES . 'cat-style-2.png'),
                        'cat_style_3' => array('title' => 'Style 3', 'img' => TX_IMAGES . 'cat-style-3.png'),
                    ),
                    'default'  => 'cat_style_1',
                ),
            array(
                'id'            => 'title-length',
                'type'          => 'slider',
                'title'         => esc_html__( 'Title Length', 'avas' ),
                'desc'         => esc_html__( 'Title Limit', 'avas' ),
                'default'       => 85,
                'min'           => 1,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
                ),
            array(
                'id'            => 'excerpt-word-limit',
                'type'          => 'slider',
                'title'         => esc_html__( 'Excerpt Words', 'avas' ),
                'desc'         => esc_html__( 'Word limit for Excerpt in blog, archive, category, tag pages etc.', 'avas' ),
                'default'       => 35,
                'min'           => 1,
                'step'          => 1,
                'max'           => 55,
                'display_value' => 'text'
                ),
            array(
                'id'            => 'blog-posts-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Pagination', 'avas' ),
                'desc'         => esc_html__( 'Posts per page', 'avas' ),
                'default'       => 9,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text'
                ),
            array(
                'id'            => 'tag_limit',
                'type'          => 'slider',
                'title'         => esc_html__( 'Tag Cloud Widget', 'avas' ),
                'desc'         => esc_html__( 'Tag Limit', 'avas' ),
                'default'       => 15,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text'
                ),
            array(
                'id'        => 'read-more',
                'type'      => 'switch',
                'title'     => esc_html__('Read More Button', 'avas'),
                'default'   => 1,
                'on'        => 'On',
                'off'       => 'Off',
                ),
            array(
                'id'       => 'read-more-text',
                'type'     => 'text',
                'title'    => esc_html__('Change Text','avas'),
                'default'  => 'Read More',
                'required' => array( 'read-more', '=', '1' ),
                ),
            array(
                'id'        => 'post-meta-info',
                'type'      => 'info',
                'title'     => esc_html__('Post meta settings', 'avas'),
                'style'     => 'success', //success warning
                ),
            array(
                'id'        => 'post-time',
                'type'      => 'switch',
                'title'     => esc_html__('Time', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Show','avas'),
                'off'       => esc_html__('Hide','avas'),
                ),
            array(
                'id'        => 'post-author',
                'type'      => 'switch',
                'title'     => esc_html__('Author', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Show','avas'),
                'off'       => esc_html__('Hide','avas'),
                ),
            
            array(
                'id'        => 'post-comment',
                'type'      => 'switch',
                'title'     => esc_html__('Comments', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Show','avas'),
                'off'       => esc_html__('Hide','avas'),
                ),
            array(
                'id'        => 'post-views',
                'type'      => 'switch',
                'title'     => esc_html__('Views', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Show','avas'),
                'off'       => esc_html__('Hide','avas'),
                ),
            array(
                'id'        => 'social-share-header',
                'type'      => 'switch',
                'title'     => esc_html__('Social Share on Header', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Show','avas'),
                'off'       => esc_html__('Hide','avas'),
                ),
            
            
            // single post settings
            array(
                'id'        => 'comment-info',
                'type'      => 'info',
                'title'     => esc_html__('Single post settings', 'avas'),
                'style'     => 'success', //success warning
                ),
            
            array(
                'id'        => 'featured-image',
                'type'      => 'switch',
                'title'     => esc_html__('Featured Image', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            array(
                'id'        => 'posts-title',
                'type'      => 'switch',
                'title'     => esc_html__('Posts Title', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            array(
                'id'        => 'post-category',
                'type'      => 'switch',
                'title'     => esc_html__('Categories', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            array(
                'id'        => 'post-tag',
                'type'      => 'switch',
                'title'     => esc_html__('Tags', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            array(
                'id'        => 'social-share-footer',
                'type'      => 'switch',
                'title'     => esc_html__('Social Share on Footer', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            array(
                'id'        => 'related-posts',
                'type'      => 'switch',
                'title'     => esc_html__('Related posts', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            array(
                'id'        => 'prev-next-posts',
                'type'      => 'switch',
                'title'     => esc_html__('Prev / Next Posts', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            array(
                'id'        => 'author-bio-posts',
                'type'      => 'switch',
                'title'     => esc_html__('Author Bio', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            array(
                'id'        => 'comments-posts',
                'type'      => 'switch',
                'title'     => esc_html__('Comments', 'avas'),
                'default'   => 1,
                'on'        => esc_html__('Enable','avas'),
                'off'       => esc_html__('Disable','avas'),
                ),
            // Posts color
            array(
                'id'        => 'posts-colors',
                'type'      => 'info',
                'title'     => esc_html__('Posts Colors', 'avas'),
                'style'     => 'success', //success warning
                ),           
            array(
                'id'       => 'posts-title-color',
                'type'     => 'color',
                'output'   => array( '.details-box .post-title a,.entry-title a' ),
                'title'    => esc_html__( 'Posts title color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post-title-hover-color',
                'type'     => 'color',
                'output'   => array( 'h1.entry-title a:hover,.details-box .post-title a:hover,.tx-cat-style3-right .post-title a:hover' ),
                'title'    => esc_html__( 'Post title hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-text-color',
                'type'     => 'color',
                'output'   => array( '.details-box p' ),
                'title'    => esc_html__( 'Post excerpt color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_meta_icon_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.entry-meta i, .entry-footer i' ),
                'title'    => esc_html__( 'Post meta icon color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_meta_text_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.entry-meta, .entry-footer' ),
                'title'    => esc_html__( 'Post meta text color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_meta_text_hov_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.post .post-category a:hover, .post .comments-link a:hover, .post .post-tag a:hover,.nickname a:hover' ),
                'title'    => esc_html__( 'Post meta text hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-date-color',
                'type'     => 'color',
                'output'   => array( '.details-box .post-time' ),
                'title'    => esc_html__( 'Posts date color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-date-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.details-box .post-time' ),
                'title'    => esc_html__( 'Posts date background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-date-hov-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.blog-cols:hover .details-box .post-time' ),
                'title'    => esc_html__( 'Posts date hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-date-bg-hov-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.blog-cols:hover .details-box .post-time' ),
                'title'    => esc_html__( 'Posts date background hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-bottom-border-hov-color',
                'type'     => 'color',
                'output'   => array( 'border-color' => '.blog-cols:hover .details-box' ),
                'title'    => esc_html__( 'Posts bottom border hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-read-more-btn-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.tx-read-more, .tx-read-more a, .tx-read-more:after' ),
                'title'    => esc_html__( 'Posts read more button color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-read-more-btn-hov-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.tx-read-more a:focus, .tx-read-more:focus, tx-read-more a:hover, .tx-read-more:hover, .tx-read-more:hover a,.tx-read-more:hover:after' ),
                'title'    => esc_html__( 'Posts read more button hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-read-more-btn-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.tx-read-more' ),
                'title'    => esc_html__( 'Posts read more button background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-read-more-btn-bg-hov-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.tx-read-more a:focus, .tx-read-more:focus, tx-read-more a:hover, .tx-read-more:hover' ),
                'title'    => esc_html__( 'Posts read more button background hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            // single post color settings
            array(
                'id'        => 'single-posts-colors',
                'type'      => 'info',
                'title'     => esc_html__('Single Post Colors', 'avas'),
                'style'     => 'success', //success warning
                ),
            array(
                'id'       => 'single-posts-title-color',
                'type'     => 'color',
                'output'   => array( '.single-post .entry-title' ),
                'title'    => esc_html__( 'Single Posts Title color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'single-posts-text-color',
                'type'     => 'color',
                'output'   => array( '.single-post .entry-content p' ),
                'title'    => esc_html__( 'Single Post text color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'related-post-bar-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.related-posts-title' ),
                'title'    => esc_html__( 'Related Post Bar background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'related-post-bar-title-color',
                'type'     => 'color',
                'output'   => '.related-posts-title',
                'title'    => esc_html__( 'Related Post Bar Title color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'related-post-overlay-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.related-posts-item .overlay' ),
                'title'    => esc_html__( 'Related Post overlay color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'related-post-title-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.related-posts-item .overlay a' ),
                'title'    => esc_html__( 'Related Post title color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'next-prev-post-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.single .page-link, .single .page-link a' ),
                'title'    => esc_html__( 'Previous Post / Next Post color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'next-prev-post-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.single .page-link, .single .page-link a' ),
                'title'    => esc_html__( 'Previous Post / Next Post background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'next-prev-post-hov-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.single .page-link:hover, .single .page-link:hover a, .single .page-link a:hover' ),
                'title'    => esc_html__( 'Previous Post / Next Post hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'next-prev-post-bg-hov-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.single .page-link:hover, .single .page-link:hover a, .single .page-link a:hover' ),
                'title'    => esc_html__( 'Previous Post / Next Post background hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'author-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.author_bio_sec' ),
                'title'    => esc_html__( 'Author background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_comment_form_btn_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.form-submit input[type="submit"]' ),
                'title'    => esc_html__( 'Post comment form button text color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_comment_form_btn_hov_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.form-submit input[type="submit"]:hover' ),
                'title'    => esc_html__( 'Post comment form button text hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_comment_form_btn_bg_color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.form-submit input[type="submit"]' ),
                'title'    => esc_html__( 'Post comment form button background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_comment_form_btn_bg_hov_color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.form-submit input[type="submit"]:hover' ),
                'title'    => esc_html__( 'Post comment form button background hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            
            array(
                'id'       => 'form-control-focus',
                'type'     => 'color',
                'output'   => array( 'border-color' => '.form-control:focus' ),
                'title'    => esc_html__( 'Post comment form border focus color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            // Posts fonts
            array(
                'id'        => 'posts-fonts',
                'type'      => 'info',
                'title'     => esc_html__('Posts fonts', 'avas'),
                'style'     => 'success', //success warning
                ),
            array(
                'id'       => 'posts-title-font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Post Title', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h1.entry-title, h1.entry-title a'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'posts-paragraph-font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Post text', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('.entry-content p'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'posts-blockquote-font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Post blockquote', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('.entry-content blockquote p'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            )));
       
        // Widgets options
        Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Widgets', 'avas'),
        'id'               => 'sidebar-widgets',
        'icon'       => 'el el-pause',
        'fields'           => array(
                
                // sidebar color options
                array(
                    'id'       => 'sidebar-bg-color',
                    'type'     => 'color',
                    'output'   => array( 'background' => '#secondary .widget, #secondary_2 .widget' ),
                    'title'    => esc_html__( 'Sidebar background color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-border-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '#secondary .widget, #secondary_2 .widget' ),
                    'title'    => esc_html__( 'Sidebar border color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-title-color',
                    'type'     => 'color',
                    'output'   => array( '.elementor h2.widgettitle, .elementor h3.widgettitle, #secondary h2.widgettitle, #secondary h3.widget-title, #secondary_2 h3.widget-title' ),
                    'title'    => esc_html__( 'Sidebar title color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-title-border-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '.elementor h2.widgettitle,.elementor h3.widgettitle,#secondary h2.widgettitle, #secondary h3.widget-title, #secondary_2 h3.widget-title' ),
                    'title'    => esc_html__( 'Sidebar title border color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-title-border-after-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.elementor h2.widgettitle:after,.elementor h3.widgettitle:after,#secondary h2.widgettitle:after, #secondary h3.widget-title:after, #secondary_2 h3.widget-title:after' ),
                    'title'    => esc_html__( 'Sidebar title border after color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-search-icon-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.search-form i' ),
                    'title'    => esc_html__( 'Sidebar search icon color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-search-icon-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.search-form i:hover' ),
                    'title'    => esc_html__( 'Sidebar search icon hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-category-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#secondary li.cat-item a' ),
                    'title'    => esc_html__( 'Sidebar category color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-category-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#secondary li.cat-item a:hover' ),
                    'title'    => esc_html__( 'Sidebar category hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'tags_cloud_color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#footer-top .tagcloud a, .tagcloud a', 'border-color' => '.tagcloud a' ),
                    'title'    => esc_html__( 'Tag Cloud color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'tags_cloud_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#footer-top .tagcloud a:hover, .tagcloud a:hover', 'border-color' => '#footer-top .tagcloud a:hover, .tagcloud a:hover' ),
                    'title'    => esc_html__( 'Tag Cloud hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                // sidebar fonts
                array(
                    'id'       => 'sidebar-title-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Sidebar Title', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#secondary h2.widgettitle, #secondary h3.widget-title, #secondary_2 h3.widget-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                ),
                array(
                    'id'       => 'sidebar-recent-posts-title-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Avas | Recent Posts Widget Posts Title', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#side-menu-wrapper .widget-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                ),

        )));
        // Ads options
        Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Ads', 'avas' ),
        'id'         => 'ads-option',
        'icon'       => 'el el-bullhorn',
        'fields'     => array(
                
            // content post ads option from here         
                 array(
                    'id'        => 'post_ads',
                    'type'      => 'switch',
                    'title'     => esc_html__('Single Post Ads', 'avas'),
                    'default'   => 0,
                    'on'        => 'Enable',
                    'off'       => 'Disable',
                ),
                array(
                    'id'        => 's_ads_switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Content ad', 'avas'),
                    'subtitle' => esc_html__('Size 300x250','avas'),
                    'default'   => 1,
                    'on'        => 'Banner',
                    'off'       => 'Adsense',
                    'required' => array('post_ads','=','1'), 
                ),
                array(
                    'id'        => 's_ads_after_p',
                    'type'      => 'slider',
                    'title'     => esc_html__('After paragraph', 'avas'),
                    "default"   => 1,
                    "min"       => 1,
                    "step"      => 1,
                    "max"       => 10,
                    'display_value' => 'text',
                    'required' => array('post_ads','=','1'), 

                ),
                array(
                    'title'    => esc_html__('Ad Banner', 'avas'),
                    'id'       => 's_ad_banner',
                    'required'  => array( 's_ads_switch', '=', '1' ),
                    'type'     => 'media',
                    'complier' => true,
                    'url'      => true,
                    'desc'     => esc_html__( 'You can upload png, jpg, gif image.', 'avas' ),
                    'default'  => array(
                      'url'=> TX_IMAGES . '300x250.jpg'
                    ),
                    'required' => array( 
                                  array('post_ads','=','1'), 
                                  array('s_ads_switch','=','1'),
                    ),
                ),
                array(
                    'id'       => 's_ad_banner_link',
                    'type'     => 'text',
                    'title'    => esc_html__('Banner link', 'avas'),
                    'required' => array( 
                                  array('post_ads','=','1'), 
                                  array('s_ads_switch','=','1'),
                    ),
                ),
                array(
                'id'       => 's_ad_js',
                'title'    => esc_html__( 'Adsense codes here.', 'avas' ),
                'type'     => 'ace_editor',
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'desc'      => esc_html__('Example: Google Adsense etc', 'avas'),
                'required'  => array( 's_ads_switch', '=', '0' ),
                 ),

        )));
        // Services Options
        Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Services', 'avas' ),
        'id'         => 'service-option',
        'icon'       => 'el el-wrench',
        'fields'     => array(
            array(
                'id'      => 'service_post_type',
                'title'    => esc_html__('Service Post Type','avas'),
                'desc'    => esc_html__('After Save Changes please refresh the page.','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('Enable','avas'),
                'off'     => esc_html__('Disable','avas'),
                'default' => 1,
                ),
            array(
                    'id'        => 'service-slug-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Service button and slug text settings', 'avas'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'services_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Name', 'avas'),
                    'description' => esc_html__('Sevices menu and archive page title will be changed. After Save Changes please refresh the page.', 'avas'),
                    'default'   => 'Services',
                    'required'  => array( 'service_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'service-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Service slug / Permalink', 'avas'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'avas'),
                    'default'   => 'service',
                    'required'  => array( 'service_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'service-cat-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Service category slug / Permalink', 'avas'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'avas'),
                    'default'   => 'service-category',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'service-colors-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Services Colors Settings', 'avas'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-overlay-color',
                    'type'     => 'color_rgba',
                    'output'    => array('background-color' => '.tx-services-featured a:before, .tx-services-overlay-item:before'),
                    'title'    => esc_html__( 'Overlay Color', 'avas' ),
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-title-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-title a'),
                    'title'    => esc_html__( 'Title Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-title-hov-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-title:hover,.tx-services-overlay-item .tx-services-title:hover'),
                    'title'    => esc_html__( 'Title Hover Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-title-holder-bg-color',
                    'type'     => 'color_rgba',
                    'output'    => array('background-color' => '.tx-services-title-holder'),
                    'title'    => esc_html__( 'Title Holder Background Color', 'avas' ),
                    'desc'    => esc_html__( 'For Overlay style only', 'avas' ),
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-content-bg-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.tx-services-content'),
                    'title'    => esc_html__( 'Content Background Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-excerpt-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-excp'),
                    'title'    => esc_html__( 'Excerpt Color for Grid style only', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-excerpt-overlay-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-overlay-item .tx-services-excp'),
                    'title'    => esc_html__( 'Excerpt Color for Overlay style only', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-cat-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-serv-cat'),
                    'title'    => esc_html__( 'Category Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-cat-hov-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-serv-cat:hover'),
                    'title'    => esc_html__( 'Category Hover Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-overlay-icon-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-featured a:after, .tx-services-overlay-item i'),
                    'title'    => esc_html__( 'Overlay Icon Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-overlay-icon-hov-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-overlay-item i:hover'),
                    'title'    => esc_html__( 'Overlay Icon Hover Color', 'avas' ),
                    'desc'    => esc_html__( 'For Overlay style only.', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'service-single-colors-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Services Single Page Colors Settings', 'avas'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-download-btn-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.btn-brochure'),
                    'title'    => esc_html__( 'Download Button Text Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-download-btn-bg-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.btn-brochure'),
                    'title'    => esc_html__( 'Download Button Background Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-download-btn-txt-hov-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.btn-brochure:hover'),
                    'title'    => esc_html__( 'Download Button Text Hover Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'service-download-btn-bg-hov-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.btn-brochure:hover'),
                    'title'    => esc_html__( 'Download Button Background Hover Color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'service_post_type', '=', '1' ),
                ),
            )));

    // Portfolio options
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio', 'avas' ),
        'id'         => 'portfolio-option',
        'desc'       => esc_html__( 'Portfolio options', 'avas' ),
        'icon'       => 'el el-th-large',
        'fields'     => array(
            array(
                'id'      => 'portfolio_post_type',
                'title'    => esc_html__('Portfolio Post Type','avas'),
                'desc'    => esc_html__('After Save Changes please refresh the page.','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('Enable','avas'),
                'off'     => esc_html__('Disable','avas'),
                'default' => 1,
                ),
            array(
                    'id'        => 'portfolio-meta-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Single Portfolio Settings', 'avas'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'portfolio-time',
                    'type'      => 'switch',
                    'title'     => esc_html__('Date', 'avas'),
                    'default'   => 1,
                    'on'        => 'Show',
                    'off'       => 'Hide',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'portfolio-author',
                    'type'      => 'switch',
                    'title'     => esc_html__('Author', 'avas'),
                    'default'   => 1,
                    'on'        => 'Show',
                    'off'       => 'Hide',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'portfolio-meta-color-left',
                    'type'     => 'color',
                    'output'    => array('.portfolio-meta h5'),
                    'title'    => esc_html__( 'Meta Color Left', 'avas' ),
                    'desc'    => esc_html__( 'Created Date, Created By, Website', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'portfolio-meta-color-right',
                    'type'     => 'color',
                    'output'    => array('.portfolio-meta'),
                    'title'    => esc_html__( 'Meta Color Right', 'avas' ),
                    'desc'    => esc_html__( 'Date, Author', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'portfolio-meta-link-color',
                    'type'     => 'color',
                    'output'    => array('.portfolio-meta a'),
                    'title'    => esc_html__( 'Click to visit color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'portfolio-meta-link-hover-color',
                    'type'     => 'color',
                    'output'    => array('.portfolio-meta a:hover'),
                    'title'    => esc_html__( 'Click to visit hover color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'single-portfolio-button-bg-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.tx-single-portfolio-btn'),
                    'title'    => esc_html__( 'Button background color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'single-portfolio-button-bg-hov-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.tx-single-portfolio-btn:hover'),
                    'title'    => esc_html__( 'Button background hover color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'single-portfolio-button-color',
                    'type'     => 'color',
                    'output'    => array('.tx-single-portfolio-btn'),
                    'title'    => esc_html__( 'Button text color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'single-portfolio-button-hov-color',
                    'type'     => 'color',
                    'output'    => array('.tx-single-portfolio-btn:hover'),
                    'title'    => esc_html__( 'Button text hover color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'single-portfolio-button-typo',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Button Fonts', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.tx-single-portfolio-btn'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'             => 'single-portfolio-button-padding',
                    'type'           => 'spacing',
                    'output'         => array('.tx-single-portfolio-btn'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Button Padding', 'avas'),
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'             => 'single-portfolio-button-margin',
                    'type'           => 'spacing',
                    'output'         => array('.tx-single-portfolio-btn'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Button Margin', 'avas'),
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'portfolio-slug-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Slug text settings', 'avas'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'portfolio_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Name', 'avas'),
                    'description' => esc_html__('Portfolio menu and archive page title will be changed. After Save Changes please refresh the page.', 'avas'),
                    'default'   => 'Portfolio',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'portfolio-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Portfolio slug / Permalink', 'avas'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'avas'),
                    'default'   => 'portfolio',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'portfolio-cat-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Portfolio category slug / Permalink', 'avas'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'avas'),
                    'default'   => 'portfolio-category',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'portfolio-colors-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Colors', 'avas'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                    ),
            array(
                    'id'       => 'portfolio-project-details-bg-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.project-table tbody'),
                    'title'    => esc_html__( 'Project Details Table background color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'portfolio-project-details-br-color',
                    'type'     => 'color',
                    'output'    => array('border-color' => '.project-table tr td'),
                    'title'    => esc_html__( 'Project Details Table border color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'portfolio-project-completion-progressbar-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.single-portfolio .progress-bar'),
                    'title'    => esc_html__( 'Project Completion Progress Bar color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'portfolio-item-overlay-bg-color',
                    'type'     => 'color_rgba',
                    'output'    => array('background-color' => '.our-project .project-item .hover-valina'),
                    'title'    => esc_html__( 'Portfolio Item overlay background color', 'avas' ),
                    'required'  => array( 'portfolio_post_type', '=', '1' ),
                ),
            )));
    // Team options
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Team', 'avas' ),
        'id'         => 'team',
        'icon'       => 'fa fa-user',
        'fields'     => array(
            array(
                'id'      => 'team_post_type',
                'title'    => esc_html__('Team Post Type','avas'),
                'desc'    => esc_html__('After Save Changes please refresh the page.','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('Enable','avas'),
                'off'     => esc_html__('Disable','avas'),
                'default' => 1,
                ),
            array(
                'id'            => 'team-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Team per page', 'avas' ),
                'default'       => 12,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),          
            array(
                'id'          => 'team-profile-skill-bar-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.team-skills .progress-bar'),
                'title'       => esc_html__( 'Skill Bar color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'      => 'project_experience',
                'title'   => esc_html__('Project Experience','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('On','avas'),
                'off'     => esc_html__('Off','avas'),
                'default' => 1,
                'required'  => array( 'team_post_type', '=', '1' ),
                ),
            array(
                'id'        => 'project_experience_title',
                'type'      => 'text',
                'title'     => esc_html__('Title', 'avas'),
                'default'   => esc_html__('Project Experience','avas'),
                'required'  => array( 'project_experience', '=', '1' ),
                ),
            array(
                'id'            => 'project-exp-count',
                'type'          => 'slider',
                'title'         => esc_html__( 'Display', 'avas' ),
                'default'       => 8,
                'min'           => 4,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text',
                'required'  => array( 'project_experience', '=', '1' ),
            ),
            array(
                    'id'       => 'team-project-overlay-bg-color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Project Image Overlay Color', 'avas' ),
                    'output'   => array('background-color' => '.project-carousel figcaption'),
                    'transparent' => false,
                    'validate' => 'color',
                    'required'  => array( 'project_experience', '=', '1' ),
                ),
            array(
                'id'      => 'team_social_profile',
                'title'   => esc_html__('Social Profile','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('On','avas'),
                'off'     => esc_html__('Off','avas'),
                'default' => 1,
                'required'  => array( 'team_post_type', '=', '1' ),
                ),
            array(
               'id'       => 'team-profile-pic-border',
                'type'     => 'border',
                'title'    => esc_html__('Profile Picture Border', 'avas'),
                'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'avas' ),
                'output'   => array('.team-single-left img'),
                'color' => true,
                'default'  => array(
                    'border-color'  => '#dfdfdf', 
                    'border-style'  => 'solid', 
                    'border-top' => '0px',
                    'border-bottom' => '0px',
                    'border-left' => '0px',
                    'border-right' => '0px',
                ),
                'required'  => array( 'team_post_type', '=', '1' ),
                ),
            array(
               'id'       => 'team-hire-border',
                'type'     => 'border',
                'title'    => esc_html__('Button Border', 'avas'),
                'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'avas' ),
                'output'   => array('.single-team .hire_me'),
                'color' => true,
                'default'  => array(
                    'border-color'  => '#fff', 
                    'border-style'  => 'solid', 
                ),
                'required'  => array( 'team_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'team_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Name', 'avas'),
                    'description' => esc_html__('Team menu and archive page title will be changed. After Save Changes please refresh the page.', 'avas'),
                    'default'   => 'Team',
                    'required'  => array( 'team_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'team-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Team slug / Permalink', 'avas'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'avas'),
                    'default'   => 'team',
                    'required'  => array( 'team_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'team-cat-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Team category slug / Permalink', 'avas'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'avas'),
                    'default'   => 'team-category',
                    'required'  => array( 'team_post_type', '=', '1' ),
                ),
            array(
                'id'        => 'team-color-settings',
                'type'      => 'info',
                'title'     => esc_html__('Color Settings', 'avas'),
                'style'     => 'success',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                    'id'       => 'team-overlay-bg-color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Team Image Overlay Color', 'avas' ),
                    'output'   => array('background-color' => '.team figcaption'),
                    'transparent' => false,
                    'validate' => 'color',
                    'required'  => array( 'team_post_type', '=', '1' ),
                ),
            array(
                'id'          => 'team-name-color',
                'type'        => 'color',
                'output'      => array('color' => '.team figcaption h4 a'),
                'title'       => esc_html__( 'Name Color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-name-hov-color',
                'type'        => 'color',
                'output'      => array('color' => '.team figcaption h4 a:hover'),
                'title'       => esc_html__( 'Name Hover Color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-cat-color',
                'type'        => 'color',
                'output'      => array('color' => '.team .team-cat a'),
                'title'       => esc_html__( 'Position Color', 'avas' ),
                'desc'       => esc_html__( 'Formaly Category Color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-cat-hov-color',
                'type'        => 'color',
                'output'      => array('color' => '.team .team-cat a:hover, .team .team-cat a:focus'),
                'title'       => esc_html__( 'Position Hover Color', 'avas' ),
                'desc'       => esc_html__( 'Formaly Category Hover Color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-bio-color',
                'type'        => 'color',
                'output'      => array('color' => '.team .team-bio'),
                'title'       => esc_html__( 'Bio Color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-social-icon-color',
                'type'        => 'color',
                'output'      => array(
                    'color' => '.team-social i',
                    'border-color' => '.team-social li'
                ),
                'title'       => esc_html__( 'Social Icon Color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-social-icon-hov-color',
                'type'        => 'color',
                'output'      => array(
                    'color' => '.team-social li:hover i',
                    'border-color' => '.team-social li:hover'
                ),
                'title'       => esc_html__( 'Social Icon Hover Color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'        => 'team-single-color-settings',
                'type'      => 'info',
                'title'     => esc_html__('Single Profile Color Settings', 'avas'),
                'style'     => 'success',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-profile-pic-bg-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.team_profile'),
                'title'       => esc_html__( 'Picture underneath background color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-profile-button-color',
                'type'        => 'color',
                'output'      => array(
                    'color' => '.hire_me',
                    'border-color' => '.hire_me',
                ),
                'title'       => esc_html__( 'Button color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'team-profile-button-hov-color',
                'type'        => 'color',
                'output'      => array(
                    'color' => '.hire_me:hover',
                    'border-color' => '.hire_me:hover',
                ),
                'title'       => esc_html__( 'Button hover color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'team_post_type', '=', '1' ),
            ),

            )));
    
    if(class_exists('LearnPress')) :
    // -> START LearnPress options
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'LearnPress Courses','avas' ),
        'id'        => 'learnpress',
        'icon'      => 'fa fa-graduation-cap',
        'fields'    => array(
        // Courses page
            array(
                'id'        => 'courses_page_sec',
                'type'      => 'info',
                'title'     => esc_html__('Courses page', 'avas'),
                'style'     => 'success',
            ),
            array(
                'id'      => 'lp_search',
                'title'   => esc_html__('Search','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','avas'),
                'off'     => esc_html__('Hide','avas'),
                'default' => 1,

            ),
            array(
                'id'          => 'lp_search_color',
                'type'        => 'color',
                'output'      => array('background-color' => '.lp-button.button.search-course-button'),
                'title'       => esc_html__( 'Search Button color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'lp_search', '=', '1' ),
            ),
            array(
                'id'          => 'lp_search_hover_color',
                'type'        => 'color',
                'output'      => array('background-color' => '.lp-button.button.search-course-button:hover'),
                'title'       => esc_html__( 'Search Button hover color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'lp_search', '=', '1' ),
            ),           
            array(
                'id'          => 'lp-course-price',
                'type'        => 'color',
                'output'      => array('background-color' => '.lp-course-price'),
                'title'       => esc_html__( 'Course Price background color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-price-color',
                'type'        => 'color',
                'output'      => array('color' => '.lp-course-price'),
                'title'       => esc_html__( 'Course Price color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-reg-price-color',
                'type'        => 'color',
                'output'      => array('color' => '.lp-course-price .origin-price'),
                'title'       => esc_html__( 'Course Regular Price color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-title-color',
                'type'        => 'color',
                'output'      => array('color' => '.course-title a'),
                'title'       => esc_html__( 'Course Title color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-title-hover-color',
                'type'        => 'color',
                'output'      => array('color' => '.course-title a:hover'),
                'title'       => esc_html__( 'Course Title hover color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-cat-color',
                'type'        => 'color',
                'output'      => array('color' => '.course-cateogory a'),
                'title'       => esc_html__( 'Course Category color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-cat-hov-color',
                'type'        => 'color',
                'output'      => array('color' => '.type-lp_course:hover .course-cateogory a'),
                'title'       => esc_html__( 'Course Category hover color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-sep-color',
                'type'        => 'color',
                'output'      => array('border-color' => '.type-lp_course:hover .edu-course-footer'),
                'title'       => esc_html__( 'Course footer separator color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-btn-bg-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.single-lp_course form[name="purchase-course"] .button-purchase-course, .single-lp_course form[name="enroll-course"] .lp-button'),
                'title'       => esc_html__( 'Single Course Button BG color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-btn-bg-hov-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.single-lp_course form[name="purchase-course"] .button-purchase-course:hover, .single-lp_course form[name="enroll-course"] .lp-button:hover'),
                'title'       => esc_html__( 'Single Course Button BG hover color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-related-title-bg-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.edu-ralated-course .related-title'),
                'title'       => esc_html__( 'Single Course Related bar BG color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
        )
    ));
    endif;

    if(class_exists('WooCommerce')) :
    // -> START Woocommerce options
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'WooCommerce','avas' ),
        'id'        => 'woocommerce',
        'icon'      => 'el el-shopping-cart',
        'fields'    => array(
            array(
                'id'            => 'woo-product-per-row',
                'type'          => 'slider',
                'title'         => esc_html__( 'Product per row', 'avas' ),
                'default'       => 3,
                'min'           => 1,
                'step'          => 1,
                'max'           => 6,
                'display_value' => 'text'
            ),
            array(
                'id'             => 'woo_product_space',
                'type'           => 'spacing',
                'output'         => array('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product'),
                'mode'           => 'margin',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Product Space', 'avas'),
                'default'            => array(
                    'units'          => 'px', 
                ),
            ),
            array(
                'id'            => 'woo-product-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Product per page', 'avas' ),
                'default'       => 12,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'woo-sidebar-select',
                'type'     => 'select',
                'title'    => esc_html__('Shop Sidebar', 'avas'), 
                'options'  => array(
                    'woo-sidebar-right' => 'Right Sidebar',
                    'woo-sidebar-left' => 'Left Sidebar',
                    'woo-sidebar-none' => 'No Sidebar',
                ),
                'default'  => 'woo-sidebar-right',
            ),
            array(
                'id'       => 'woo-single-sidebar-select',
                'type'     => 'select',
                'title'    => esc_html__('Single Product Sidebar', 'avas'), 
                'options'  => array(
                    'woo-single-sidebar-right' => 'Right Sidebar',
                    'woo-single-sidebar-left' => 'Left Sidebar',
                    'woo-single-sidebar-none' => 'No Sidebar',
                ),
                'default'  => 'woo-single-sidebar-right',
            ),
            array(
                'id'      => 'woo_number_result',
                'title'   => esc_html__('Display Result Count','avas'),
                'desc'   => esc_html__('Number of result in shop page','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','avas'),
                'off'     => esc_html__('Hide','avas'),
                'default' => 0,
            ),
            array(
                'id'      => 'woo_default_sorting_dropdown',
                'title'   => esc_html__('Display Ordering','avas'),
                'desc'   => esc_html__('Default sorting dropdown in shop page','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','avas'),
                'off'     => esc_html__('Hide','avas'),
                'default' => 0,
            ),
            array(
                'id'      => 'woo-new-badge',
                'title'   => esc_html__('Display New Badge','avas'),
                'desc'   => esc_html__('Show New badge on product in shop page','avas'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','avas'),
                'off'     => esc_html__('Hide','avas'),
                'default' => 1,
            ),
            array(
                'id'            => 'woo-new-badge-days',
                'type'          => 'slider',
                'title'         => esc_html__( 'New badge display for days', 'avas' ),
                'default'       => 7,
                'min'           => 1,
                'step'          => 1,
                'max'           => 60,
                'display_value' => 'text',
                'required'  => array( 'woo-new-badge', '=', '1' ),
            ),
            array(
                'id'       => 'woo-new-badge-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.woocommerce ul.products li.product .itsnew.onsale' ),
                'title'    => esc_html__( 'New badge background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'woo-new-badge', '=', '1' ),
            ),
            array(
                'id'       => 'woo-new-badge-text-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .itsnew.onsale' ),
                'title'    => esc_html__( 'New badge text color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'woo-new-badge', '=', '1' ),
            ),
            array(
                    'id'       => 'woo-new-badge-fonts',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'New badge font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.woocommerce ul.products li.product .itsnew.onsale'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array( 'woo-new-badge', '=', '1' ),
                ),
            // sale badge
            array(
                'id'       => 'woo-sale-badge-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.woocommerce ul.products li.product .onsale' ),
                'title'    => esc_html__( 'Sale badge background color', 'avas' ),
                'validate' => 'color',
                'transparent' => true,
            ),
            array(
                'id'       => 'woo-sale-badge-text-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .onsale' ),
                'title'    => esc_html__( 'Sale badge text color', 'avas' ),
                'validate' => 'color',
                'transparent' => true,
            ),
            array(
                    'id'       => 'woo-sale-badge-fonts',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Sale badge font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.woocommerce ul.products li.product .onsale'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
            ),
            // Featured badge
            array(
                'id'       => 'woo-featured-badge-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.woocommerce ul.products li.product .featured.itsnew.onsale' ),
                'title'    => esc_html__( 'Featured badge background color', 'avas' ),
                'validate' => 'color',
                'transparent' => true,
            ),
            array(
                'id'       => 'woo-featured-badge-text-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .featured.itsnew.onsale' ),
                'title'    => esc_html__( 'Featured badge text color', 'avas' ),
                'validate' => 'color',
                'transparent' => true,
            ),
            array(
                'id'       => 'woo-featured-badge-fonts',
                'type'     => 'typography',
                'title'    => esc_html__( 'Featured badge font', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('.woocommerce ul.products li.product .featured.itsnew.onsale'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            // Product colors settings
            array(
                'id'        => 'woo_prodcutsion_color_settings',
                'type'      => 'info',
                'title'     => esc_html__('Product colors settings', 'avas'),
                'style'     => 'success',
                ),    
            array(
                'id'       => 'woo-prod-name-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce-loop-product__title' ),
                'title'    => esc_html__( 'Product name color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'woo-prod-name-fonts',
                'type'     => 'typography',
                'title'    => esc_html__( 'Product name font', 'avas' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('.woocommerce-loop-product__title'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'woo-prod-price-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .price' ),
                'title'    => esc_html__( 'Product price color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'woo-prod-reg-price-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .price del' ),
                'title'    => esc_html__( 'Product regular price color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
        )
        ));
    endif; // check woocommerce installed or not
    
    // Social Media  / social share         
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Social Media', 'avas' ),
        'desc'            => esc_html__( 'Use [avas-social-media] for shortcode', 'avas' ),
        'id'               => 'social_media',
        'customizer_width' => '400px',
        'icon'             => 'el el-twitter',
        'fields'           =>  array(            
            array(
                'id'        => 'social',
                'type'      => 'switch',
                'default'   => 1,
                'on'        => esc_html__('Enable', 'avas'),
                'off'       => esc_html__('Disable', 'avas'),
                ),
            array(
                'id'       => 'behance',
                'type'     => 'text',
                'title'    => esc_html__('Behance','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'facebook',
                'type'     => 'text',
                'title'    => esc_html__('Facebook','avas'),
                'default'  => 'https://www.facebook.com/avas.wordpress.theme/',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'flickr',
                'type'     => 'text',
                'title'    => esc_html__('Flickr','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'github',
                'type'     => 'text',
                'title'    => esc_html__('GitHub','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'instagram',
                'type'     => 'text',
                'title'    => esc_html__('Instagram','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'linkedin',
                'type'     => 'text',
                'title'    => esc_html__('LinkedIn','avas'),
                'default'  => '#',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'pinterest',
                'type'     => 'text',
                'title'    => esc_html__('Pinterest','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'qq',
                'type'     => 'text',
                'title'    => esc_html__('QQ','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'reddit',
                'type'     => 'text',
                'title'    => esc_html__('Reddit','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'skype',
                'type'     => 'text',
                'title'    => esc_html__('Skype','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'snapchat',
                'type'     => 'text',
                'title'    => esc_html__('Snapchat','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'soundcloud',
                'type'     => 'text',
                'title'    => esc_html__('SoundCloud','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'spotify',
                'type'     => 'text',
                'title'    => esc_html__('Spotify','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'stumbleupon',
                'type'     => 'text',
                'title'    => esc_html__('Stumbleupon','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'telegram',
                'type'     => 'text',
                'title'    => esc_html__('Telegram','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'tumblr',
                'type'     => 'text',
                'title'    => esc_html__('Tumblr','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'twitch',
                'type'     => 'text',
                'title'    => esc_html__('Twitch','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'twitter',
                'type'     => 'text',
                'title'    => esc_html__('Twitter','avas'),
                'default'  => 'https://twitter.com/AvasTheme',
                'required' => array( 'social', '=', '1' ),
                ),           
            array(
                'id'       => 'vimeo',
                'type'     => 'text',
                'title'    => esc_html__('Vimeo','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'vine',
                'type'     => 'text',
                'title'    => esc_html__('Vine','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
             array(
                'id'       => 'vk',
                'type'     => 'text',
                'title'    => esc_html__('VK','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'whatsapp',
                'type'     => 'text',
                'title'    => esc_html__('WhatsApp','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'wikipedia',
                'type'     => 'text',
                'title'    => esc_html__('Wikipedia','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'xing',
                'type'     => 'text',
                'title'    => esc_html__('Xing','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'yelp',
                'type'     => 'text',
                'title'    => esc_html__('Yelp','avas'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'youtube',
                'type'     => 'text',
                'title'    => esc_html__('Youtube','avas'),
                'default'  => 'https://www.youtube.com/channel/UC1hlWYgndZw7PEHWeTbYvfA',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'social-media-icon-shortcode-color',
                'type'     => 'color',
                'output'   => array( 'color' => '#header .social li a i' ),
                'title'    => esc_html__( 'Social icon color on shortcode', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
            array(
                'id'       => 'social-media-icon-shortcode-color-hover',
                'type'     => 'color',
                'output'   => array( 'color' => '#header .social li a:hover i' ),
                'title'    => esc_html__( 'Social icon hover color on shortcode', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
            array(
                'id'       => 'social_share_bg_clr',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.social-share' ),
                'title'    => esc_html__( 'Share on Background Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
            array(
                'id'       => 'social_share_border_clr',
                'type'     => 'color',
                'output'   => array( 'border-color' => '.social-share' ),
                'title'    => esc_html__( 'Share on Border Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
            array(
                'id'       => 'social-share-title-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.social-share h5' ),
                'title'    => esc_html__( 'Share on text color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
           
    ) 
    ) );
    // -> START Footer options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer', 'avas' ),
        'id'               => 'footer',
        'desc'             => esc_html__('Footer Options.', 'avas'),
        'customizer_width' => '400px',
        'icon'             => 'el el-photo',
        'fields'           =>  array(
                array(
                    'id'        => 'footer_top',
                    'title'     => esc_html__( 'Footer Top', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => esc_html__('Enable', 'avas'),
                    'off'       => esc_html__('Disable', 'avas'),
                ),
                array(
                    'title'    => esc_html__('Footer Top Background', 'avas'),
                    'id'       => 'footer_bg',
                    'type'     => 'background',
                    'output'   => array('background-color'=>'#footer-top'),
                    'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer_top_bg_overlay',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.footer-top-overlay' ),
                    'title'    => esc_html__( 'Footer Top  Background Overlay Color', 'avas' ),
                    'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-text-color',
                    'type'     => 'color',
                    'output'    => array('#footer-top'),
                    'title'    => esc_html__( 'Footer Top text color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-link-color',
                    'type'     => 'color',
                    'output'    => array('#footer-top a'),
                    'title'    => esc_html__( 'Footer Top link color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required' => array('footer_top', '=', '1' ),
                    ),
                array(
                    'id'       => 'footer-link-hover-color',
                    'type'     => 'color',
                    'output'    => array('#footer-top a:hover'),
                    'title'    => esc_html__( 'Footer Top link hover color', 'avas' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required' => array('footer_top', '=', '1' ),
                    ),
                array(
                    'id'          => 'footer-widget-title-color',
                    'type'        => 'color',
                    'output'      => array('#footer-top .widget-title'),
                    'title'       => esc_html__( 'Footer Top widget title color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required' => array('footer_top', '=', '1' ),
                    ),
                array(
                    'id'       => 'footer-top-fonts',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Footer Top font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#footer-top'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-widget',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Footer Top widget title font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.widget-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id' => 'footer_layout',
                    'title' => esc_html__('Footer Layout', 'avas'),
                    'type' => 'image_select',
                    'options' => array (
                        'boxed' => array('title' => 'Boxed', 'img' => TX_IMAGES . 'footer-boxed.png'),
                        'width' => array('title' => 'Wide', 'img' => TX_IMAGES . 'footer-width.png'),
                    ),
                    'default'  => 'boxed',
                    'required'  => array( 
                                    array('footer_top', '=', '1' ),
                                    array( 'page-layout', '=', 'full-width' )
                                )
                ),
                array(
                    'id'       => 'footer_cols',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Footer Top Columns', 'avas' ),
                    'required' => array('footer_top', '=', '1' ),
                    'options'  => array(
                        '12'   => 'Footer Column 1',
                         '6'   => 'Footer Column 2',
                         '4'   => 'Footer Column 3',
                         '3'   => 'Footer Column 4',
                        ),
                    'default'  => '3',
                ),
                array(
                    'id'             => 'footer_top_space',
                    'type'           => 'spacing',
                    'output'         => array('#footer-top'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Footer Padding', 'avas'),
                    'required'  => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-top-widget-alignment',
                    'type'     => 'select',
                    'title' => esc_html__('Footer Widgets Alignment', 'avas'),
                    'options'  => array(
                        'left'  => esc_html__('Left','avas'),
                        'center'  => esc_html__('Center','avas'),
                    ),
                     'default'  => 'left',
                    'required'  => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'             => 'footer_top_widget_margin',
                    'type'           => 'spacing',
                    'output'         => array('#footer-top aside'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Footer Widget Margin', 'avas'),
                    'required'  => array('footer_top', '=', '1' ),
                ),
                // Footer bottom options
                array(
                    'id'        => 'footer_bottom_sec',
                    'type'      => 'info',
                    'title'     => esc_html__('Footer Bottom Section', 'avas'),
                    'style'     => 'success',
                ),
                array(
                'id'        => 'footer_bottom',
                'title'     => esc_html__( 'Footer Bottom', 'avas' ),
                'type'      => 'switch',
                'default'   => 1,
                'on'        => esc_html__('Enable', 'avas'),
                'off'       => esc_html__('Disable', 'avas'),
                ),
                array(
                    'id'       => 'footer-select',
                    'type'     => 'select',
                    'title' => esc_html__('Select Footer Style', 'avas'),
                    'options'  => array(
                        'footer1'  => esc_html__('Style 1','avas'),
                        'footer2'  => esc_html__('Style 2','avas'),
                        'footer3'  => esc_html__('Style 3','avas'),
                    ),
                    'default'  => 'footer2',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-style1',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 1', 'avas'),
                    'required'  => array( 'footer-select', '=', 'footer1' ),
                    'options'  => array(
                    'header-style1'  => array(
                      'alt' => 'Footer Style 1',
                      'img' => TX_IMAGES .'f1.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'footer-style2',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 2', 'avas'),
                    'required'  => array( 'footer-select', '=', 'footer2' ),
                    'options'  => array(
                    'header-style1'  => array(
                      'alt' => 'Footer Style 2',
                      'img' => TX_IMAGES .'f2.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'footer-style3',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 3', 'avas'),
                    'required'  => array( 'footer-select', '=', 'footer3' ),
                    'options'  => array(
                    'header-style1'  => array(
                      'alt' => 'Footer Style 3',
                      'img' => TX_IMAGES .'f3.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'footer-bottom-layout1',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Footer Bottom Layout', 'avas' ),
                    'required'  => array('footer-select', '!=', 'footer2' ),
                    'options'  => array(
                        '12'   => esc_html__('Copyright Text only','avas'),
                         '6'   => esc_html__('Copyright Text with Footer Menu &amp; Social Icons','avas'),
                        ),
                    'default'  => '6',
                ),
                array(
                    'id'       => 'footer-bottom-layout2',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Footer Bottom Layout', 'avas' ),
                   'required'  => array( 'footer-select', '=', 'footer2' ),
                    'options'  => array(
                        '12'   => esc_html__('Copyright Text only','avas'),
                         '4'   => esc_html__('Copyright Text with Footer Menu &amp; Social Icons','avas'),
                        ),
                    'default'  => '4',
                ),
                array(
                    'id'          => 'footer-bottom-bg-color',
                    'type'        => 'color',
                    'output'      => array('background-color' => '#footer'),
                    'title'       => esc_html__( 'Footer Bottom background color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                    ),
                array(
                    'id'          => 'footer-border-color',
                    'type'        => 'color',
                    'output'      => array('border-color' => '#footer'),
                    'title'       => esc_html__( 'Footer Bottom border color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                    ),
                // Footer menu options
                array(
                    'id'        => 'footer-menu',
                    'title'     => esc_html__( 'Footer Menu', 'avas' ),
                    'desc'     => esc_html__( 'Please create and set Footer Menu first via Dashboard > Appearance > Menus > Menu Settings > Display location > Footer Menu.', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 0,
                    'on'        => esc_html__('On', 'avas'),
                    'off'       => esc_html__('Off', 'avas'),
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                // Footer Menu Color
                array(
                    'id'          => 'footer-menu-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.footer-menu li a'),
                    'title'       => esc_html__( 'Footer menu color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required' => array('footer-menu', '=', '1' ),
                    ),
                array(
                    'id'          => 'footer-menu-hover-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.footer-menu li a:hover'),
                    'title'       => esc_html__( 'Footer menu hover color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required' => array('footer-menu', '=', '1' ),
                    ),
                array(
                    'id'          => 'footer-menu-separator-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.footer-menu li:after'),
                    'title'       => esc_html__( 'Footer menu seperator color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required' => array('footer-menu', '=', '1' ),
                    ),
                // footer menu fonts
                array(
                    'id'       => 'footer-menu-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Footer menu font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.footer-menu li a'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'text-transform'=> true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('footer-menu', '=', '1' ),

                ),
                // social icon on footer
                array(
                    'id'        => 'social_icons_footer',
                    'title'     => esc_html__( 'Social Icons', 'avas' ),
                    'desc'     => esc_html__( 'Social Icons link optoins are located at Theme Optoins > Social Media.', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 0,
                    'on'        => esc_html__('On', 'avas'),
                    'off'       => esc_html__('Off', 'avas'),
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'       => 'social-media-icon-footer-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#footer .social li a' ),
                    'title'    => esc_html__( 'Social icon color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('social_icons_footer', '=', '1' ),
                ),
                array(
                    'id'       => 'social-media-icon-footer-color-hover',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#footer .social li a:hover' ),
                    'title'    => esc_html__( 'Social icon hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('social_icons_footer', '=', '1' ),
                ),
                // Scroll to top
                array(
                    'id'        => 'back_top',
                    'title'     => esc_html__( 'Scroll to Top', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => esc_html__('On', 'avas'),
                    'off'       => esc_html__('Off', 'avas'),
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                'id'       => 'back_top_bg',
                'type'     => 'color',
                'output'   => array( 'background-color' => '#back_top' ),
                'title'    => esc_html__( 'Scroll to Top background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_bg_hover',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '#back_top:hover,#back_top:focus' ),
                    'title'    => esc_html__( 'Scroll to Top background hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_border',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '#back_top' ),
                    'title'    => esc_html__( 'Scroll to Top border color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_border_hover',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '#back_top:hover,#back_top:focus' ),
                    'title'    => esc_html__( 'Scroll to Top border hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_icon',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#back_top i' ),
                    'title'    => esc_html__( 'Scroll to Top icon color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_icon_hover',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#back_top i:hover,#back_top i:focus, #back_top:hover i' ),
                    'title'    => esc_html__( 'Scroll to Top icon hover color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                
                // copryright
                array(
                'id'       => 'copyright',
                'title'    =>  esc_html__('Copyright', 'avas'),
                'type'     => 'textarea',
                'default'  => '2020 &copy; <a href="https://1.envato.market/mPA2X">Avas WordPress Theme</a> | All rights reserved.',
                'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                'id'          => 'footer-copyright-text-color',
                'type'        => 'color',
                'output'      => array('color' => '.copyright'),
                'title'       => esc_html__( 'Footer copyright text color', 'avas' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'          => 'footer-copyright-link-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.copyright a'),
                    'title'       => esc_html__( 'Footer copyright link color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'          => 'footer-copyright-link-hover-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.copyright a:hover'),
                    'title'       => esc_html__( 'Footer copyright link hover color', 'avas' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-copyright',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Copyright text', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.copyright'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true,
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
    ),
    ));

    // -> START Footer options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Cookie', 'avas' ),
        'id'               => 'tx_cookie',
        'desc'             => esc_html__('Cookie Options.', 'avas'),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-empire',
        'fields'           =>  array(
                array(
                    'id'        => 'cookie_notice',
                    'title'     => esc_html__( 'Cookie Notice', 'avas' ),
                    'type'      => 'switch',
                    'default'   => 0,
                    'on'        => esc_html__('Enable', 'avas'),
                    'off'       => esc_html__('Disable', 'avas'),
                ),
                array(
                    'id'       => 'cookie_notice_bg_color',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.cc-window' ),
                    'title'    => esc_html__( 'Notice Bar Background Color', 'avas' ),
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_text',
                    'title'    =>  esc_html__('Notice Text', 'avas'),
                    'type'     => 'textarea',
                    'default'  => 'This website uses cookies to ensure you get the best experience on our website.',
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_text_color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.cc-window' ),
                    'title'    => esc_html__( 'Notice Text Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_learnmore_text',
                    'title'    =>  esc_html__('Learn More Text', 'avas'),
                    'type'     => 'text',
                    'default'  => 'Learn More',
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_learnmore_link',
                    'title'    =>  esc_html__('Learn More Link URL', 'avas'),
                    'desc'    =>  esc_html__('https://example-website-name.com', 'avas'),
                    'type'     => 'text',
                    'default'  => '',
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_learnmore_link_color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.cc-link,.cc-link:active,.cc-link:visited' ),
                    'title'    => esc_html__( 'Learn More Link Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                 array(
                    'id'       => 'cookie_notice_learnmore_link_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.cc-link:hover' ),
                    'title'    => esc_html__( 'Learn More Link Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_accept',
                    'title'    =>  esc_html__('Cookie Allow Text', 'avas'),
                    'type'     => 'text',
                    'default'  => 'Got It!',
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_accept_color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.cc-highlight .cc-btn:first-child' ),
                    'title'    => esc_html__( 'Cookie Allow Text Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_accept_color_hover',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.cc-highlight .cc-btn:first-child:hover, .cc-highlight .cc-btn:first-child:focus' ),
                    'title'    => esc_html__( 'Cookie Allow Text Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_accept_bg_color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.cc-highlight .cc-btn:first-child' ),
                    'title'    => esc_html__( 'Cookie Allow Background Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_accept_bg_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.cc-highlight .cc-btn:first-child:hover, .cc-highlight .cc-btn:first-child:focus' ),
                    'title'    => esc_html__( 'Cookie Allow Background Hover Color', 'avas' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_notice_position',
                    'type'     => 'select',
                    'title' => esc_html__('Position', 'avas'),
                    'options'  => array(
                        'bottom'  => esc_html__('Bottom','avas'),
                        'cc-bottom cc-left cc-floating'  => esc_html__('Bottom Left','avas'),
                        'cc-bottom cc-right cc-floating'  => esc_html__('Bottom Right','avas'),
                        'top'  => esc_html__('Top','avas'),
                        'cc-top cc-left cc-floating'  => esc_html__('Top Left','avas'),
                        'cc-top cc-right cc-floating'  => esc_html__('Top Right','avas'),
                    ),
                    'default'  => 'bottom',
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_expiry',
                    'title'    =>  esc_html__('Cookie Expire Date', 'avas'),
                    'desc'    =>  esc_html__('Default expiry days 7, for no expiry please enter -1', 'avas'),
                    'type'     => 'text',
                    'default'  => '7',
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
                array(
                    'id'       => 'cookie_typography',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Font', 'avas' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.cc-banner .cc-message'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'text-align'    => false,
                    'subsets'       => true, 
                    'required'  => array( 'cookie_notice', '=', '1' ),
                ),
        )
    ));
if ( function_exists('wpcf7') ) {      
// -> Cotnact form 7 Forms options
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Forms', 'avas' ),
        'id'    => 'forms',
        'icon'  => 'el el-envelope',
        'fields'     => array(
            array(
                'id'       => 'contact_form_button_bg_color',
                'type'     => 'color',
                'output'   => array( 'background-color' => 'input.wpcf7-form-control.wpcf7-submit' ),
                'title'    => esc_html__( 'Contact Form Button Background', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_bg_hov_color',
                'type'     => 'color',
                'output'   => array( 'background-color' => 'input.wpcf7-form-control.wpcf7-submit:hover' ),
                'title'    => esc_html__( 'Contact Form Button Background Hover', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_border_color',
                'type'     => 'color',
                'output'   => array( 'border-color' => 'input.wpcf7-form-control.wpcf7-submit' ),
                'title'    => esc_html__( 'Contact Form Button Border', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_color',
                'type'     => 'color',
                'output'   => array( 'color' => 'input.wpcf7-form-control.wpcf7-submit,.footer input.wpcf7-form-control.wpcf7-submit' ),
                'title'    => esc_html__( 'Contact Form Button Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_hover_color',
                'type'     => 'color',
                'output'   => array( 'color' => 'input.wpcf7-form-control.wpcf7-submit:hover' ),
                'title'    => esc_html__( 'Contact Form Button Hover Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_border_color_hover',
                'type'     => 'color',
                'output'   => array( 'border-color' => 'input.wpcf7-form-control.wpcf7-submit:hover' ),
                'title'    => esc_html__( 'Contact Form Button Border Hover Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_fields_border_color',
                'type'     => 'color',
                'output'   => array( 'border-color' => '.footer input.wpcf7-form-control.wpcf7-text,.footer textarea.wpcf7-form-control.wpcf7-textarea' ),
                'title'    => esc_html__( 'Contact Form Footer Fields Border Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            
    )));
}
    // pagination options
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Pagination', 'avas' ),
        'id'    => 'pagination',
        'icon'  => 'el el-resize-horizontal',
        'fields'     => array(
            array(
                'id'             => 'pagination_space',
                'type'           => 'spacing',
                'output'         => array('.tx-pagination'),
                'mode'           => 'padding',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Pagination Space', 'avas'),
            ),
            array(
                'id'       => 'pagination_bg_color',
                'type'     => 'color',
                'output'   => array( 
                    'background-color' => '.tx-pagination a,.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a'
                ),
                'title'    => esc_html__( 'Background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_bg_hover_color',
                'type'     => 'color',
                'output'   => array( 
                    'background-color' => '.tx-pagination a:hover,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a:hover',
                    'border-color' => '.tx-pagination a:hover,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a:hover'
                     ),
                'title'    => esc_html__( 'Background hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_active_bg_color',
                'type'     => 'color',
                'output'   => array( 
                    'background-color' => '.tx-pagination span,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li span',
                    'border-color' => '.tx-pagination span,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li span' 
                ),
                'title'    => esc_html__( 'Current Page background color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_color',
                'type'     => 'color',
                'output'   => array( '.tx-pagination a,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a' ),
                'title'    => esc_html__( 'Number Color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_hover_color',
                'type'     => 'color',
                'output'   => array( '.tx-pagination a:hover,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a:hover' ),
                'title'    => esc_html__( 'Number Hover color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_active_color',
                'type'     => 'color',
                'output'   => array( 
                    'color' => '.tx-pagination span,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li span',
                    'border-color' => '.tx-pagination span',
                ),
                'title'    => esc_html__( 'Current Page Number color', 'avas' ),
                'validate' => 'color',
                'transparent' => false,
            ),
    )));
    
    // -> START custom css
    Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Custom CSS', 'avas' ),
            'id'         => 'css-code',
            'icon'  => 'el el-css',
            'fields'     => array(
                array(
                    'id'       => 'custom_css',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Additonal CSS', 'avas' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'desc'     =>  esc_html__('After add the css code please use "!important" to make the code working properly.', 'avas'),
                    
                ),
            ),
        ) );
    // -> START custom javascript
    Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Custom JS', 'avas' ),
            'id'         => 'js-code',
            'icon'  => 'fa fa-code',
            'fields'     => array(
                array(
                    'id'       => 'custom_js_head',
                    'title'    => esc_html__( 'JavaScript on Head', 'avas' ),
                    'type'     => 'ace_editor',
                    'mode'     => 'html',
                    'theme'    => 'monokai',
                    'desc'     => esc_html__( 'Script will be placed on before </head> tag', 'avas' ),
                ),
                array(
                    'id'       => 'custom_js_footer',
                    'title'    => esc_html__( 'JavaScript on Footer', 'avas' ),
                    'type'     => 'ace_editor',
                    'mode'     => 'html',
                    'theme'    => 'monokai',
                    'desc'     => esc_html__( 'Script will be placed on before </body> tag', 'avas' ),
                ),
            ),
        ) );

    /*
 * <--- END SECTIONS
 */

/*
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR OTHER CONFIGS MAY OVERRIDE YOUR CODE.
 */

/*
 * --> Action hook examples.
 */

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
// add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
//
// Change the arguments after they've been declared, but before the panel is created.
// add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
//
// Change the default value of a field after it's been set, but before it's been useds.
// add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
//
// Dynamically add a section. Can be also used to modify sections/fields.
// add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
// .
if ( ! function_exists( 'compiler_action' ) ) {
    /**
     *
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field's value has changed and compiler=>true is set.
     *
     * @param array  $options        Options values.
     * @param string $css            Compiler selector CSS values  compiler => array( CSS SELECTORS ).
     * @param array  $changed_values Values changed since last save.
     */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo '<pre>';
        // phpcs:ignore WordPress.PHP.DevelopmentFunctions
        print_r( $changed_values ); // Values that have changed since the last save.
        // echo '<br/>';
        // print_r($options); //Option values.
        // echo '<br/>';
        // print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS ).
        echo '</pre>';
    }
}

if ( ! function_exists( 'redux_validate_callback_function' ) ) {
    /**
     * Custom function for the callback validation referenced above
     *
     * @param array $field          Field array.
     * @param mixed $value          New value.
     * @param mixed $existing_value Existing value.
     *
     * @return mixed
     */
    function redux_validate_callback_function( $field, $value, $existing_value ) {
        $error   = false;
        $warning = false;

        // Do your validation.
        if ( 1 === $value ) {
            $error = true;
            $value = $existing_value;
        } elseif ( 2 === $value ) {
            $warning = true;
            $value   = $existing_value;
        }

        $return['value'] = $value;

        if ( true === $error ) {
            $field['msg']    = 'your custom error message';
            $return['error'] = $field;
        }

        if ( true === $warning ) {
            $field['msg']      = 'your custom warning message';
            $return['warning'] = $field;
        }

        return $return;
    }
}


if ( ! function_exists( 'dynamic_section' ) ) {
    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons.
     *
     * @param array $sections Section array.
     *
     * @return array
     */
    function dynamic_section( $sections ) {
        $sections[] = array(
            'title'  => esc_html__( 'Section via hook', 'avas' ),
            'desc'   => '<p class="description">' . esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'avas' ) . '</p>',
            'icon'   => 'el el-paper-clip',

            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array(),
        );

        return $sections;
    }
}

if ( ! function_exists( 'change_arguments' ) ) {
    /**
     * Filter hook for filtering the args.
     * Good for child themes to override or add to the args array. Can also be used in other functions.
     *
     * @param array $args Global arguments array.
     *
     * @return array
     */
    function change_arguments( $args ) {
        $args['dev_mode'] = true;

        return $args;
    }
}

if ( ! function_exists( 'change_defaults' ) ) {
    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     *
     * @param array $defaults Default value array.
     *
     * @return array
     */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'avas' );

        return $defaults;
    }
}

if ( ! function_exists( 'redux_custom_sanitize' ) ) {
    /**
     * Function to be used if the field santize argument.
     *
     * Return value MUST be the formatted or cleaned text to display.
     *
     * @param string $value Value to evaluate or clean.  Required.
     *
     * @return string
     */
    function redux_custom_sanitize( $value ) {
        $return = '';

        foreach ( explode( ' ', $value ) as $w ) {
            foreach ( str_split( $w ) as $k => $v ) {
                if ( ( $k + 1 ) % 2 !== 0 && ctype_alpha( $v ) ) {
                    $return .= mb_strtoupper( $v );
                } else {
                    $return .= $v;
                }
            }
            $return .= ' ';
        }

        return $return;
    }
}
    
    /* ---------------------------------------------------------
     Remove Redux Notice
    ------------------------------------------------------------ */
    if ( ! class_exists( 'reduxNewsflash' ) ):
        class reduxNewsflash {
            public function __construct( $parent, $params ) {}
        }
    endif;
    /* ---------------------------------------------------------
     Remove Redux Ads
    ------------------------------------------------------------ */
    add_filter( 'redux/tx/aURL_filter', '__return_empty_string' );
    /* ---------------------------------------------------------
    Remove Redux Framework menu from Tools
    ------------------------------------------------------------ */
    add_action('admin_menu', 'tx_remove_redux_menu', 12);
    function tx_remove_redux_menu() {
        remove_submenu_page('tools.php', 'redux-framework');

    }

    
/* ==============================================================================
          EOF
================================================================================ */