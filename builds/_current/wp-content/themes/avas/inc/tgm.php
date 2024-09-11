<?php
/**
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Restore Fully Functional Petition Theme for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'tx_register_required_plugins' );

function tx_register_required_plugins() {
    
    $plugins = array(
        
        // Avas Core
        array(
            'name'               => esc_html__( 'Avas Core', 'avas' ), // The plugin name.
            'slug'               => 'avas-core', // The plugin slug (typically the folder name).
            'source'             => 'https://x-theme.net/x-doc/avas-core.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        // Slider Revolution
        array(
            'name'               => esc_html__( 'Slider Revolution', 'avas' ), // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => 'https://x-theme.net/x-doc/revslider.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        // Elementor Page Builder
        array(
            'name'               => esc_html__( 'Elementor', 'avas' ), // The plugin name.
            'slug'               => 'elementor', // The plugin slug (typically the folder name).
            'source'             => 'https://x-theme.net/x-doc/elementor.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        // Contact Form 7
        array(
            'name'               => esc_html__( 'Contact Form 7', 'avas' ), // The plugin name.
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),

        // Woocommerce
        array(
            'name'               => esc_html__( 'Woocommerce', 'avas' ), // The plugin name.
            'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        
        // Give - Donation Plugin
        array(
            'name'               => esc_html__( 'Give - For Charity demo only', 'avas' ), // The plugin name.
            'slug'               => 'give', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        // LearnPress - Education 
        array(
            'name'               => esc_html__( 'LearnPress - For Education demo only', 'avas' ), // The plugin name.
            'slug'               => 'learnpress', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        // LearnPress - Course Review 
        array(
            'name'               => esc_html__( 'LearnPress Course Review', 'avas' ), // The plugin name.
            'slug'               => 'learnpress-course-review', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
        // WPBakery Visual Composer
        array(
            'name'               => esc_html__( 'WPBakery', 'avas' ), // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => 'https://x-theme.net/x-doc/js_composer.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),

    );

    $config = array(
        'id'           => 'avas',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'avas-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',//esc_html__( 'Autoptimize plugin will increase page load time. Install WPBakery if you will not use Elementor.', 'avas' ), // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );
}

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */