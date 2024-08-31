<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Welcome Screen
*
*/

if( !class_exists('tx_Welcome_Screen') ) {
  class tx_Welcome_Screen {
    public $is_activated;
    function __construct() {
      $this->tx_init();
    }

    public function tx_init() {
      $this->is_activated = get_option('is_valid');
      add_action('admin_menu', array($this, 'tx_welcome_menu'));
      add_action('admin_init', array($this, 'tx_theme_redirect'));
    }

    public function tx_welcome_menu() {
      call_user_func('add_'. 'menu' .'_page', 'Welcome Menu', 'Avas', 'edit_posts', 'Welcome', array($this, 'tx_welcome_msg'), null, 60);
    }

    public function tx_welcome_msg() { 
      $theme = wp_get_theme();
    ?>

      <div class="tx-wel-wrap">
        <h1><?php esc_html_e( 'Welcome to Avas', 'avas'); ?><span class="tx-avas-ver"><?php echo esc_html__('v','avas'); ?><?php echo wp_sprintf( $theme->get( 'Version' ) ); ?></span></h1>
        
        <div class="tx-wel-txt">
          <?php echo '<p>'.wp_kses_post('Thanks for choosing Avas theme. This theme requires the following plugins installed: <strong>Avas Core, Elementor.</strong>','avas').'</p>'; ?>
          <h3><a class="button-primary" href="<?php echo esc_url(admin_url('themes.php?page=avas-install-plugins')); ?>"><?php esc_html_e('Manage Plugins','avas'); ?></a></h3>
          
      	  <?php echo '<p>'.wp_kses_post('After install and activate required plugins please go to <a href="'.esc_url(admin_url('admin.php?page=avas')).'">Theme Options</a> > License > Register license to unlcok all demo.','avas').'</p>'; ?>	
         
          <?php echo '<p>'.wp_kses_post('For more information about how to install theme and import demo please check our documentation <a href="'.esc_url('https://x-theme.net/doc-avas/').'" target="_blank">here.</a>','avas').'</p>'; ?>

          <?php echo '<p>'.wp_kses_post('For any issue please contact us via our support section <a href="'.esc_url('https://theme-x.org/support-desk/').'" target="_blank">here.</a>','avas').'<br><span style="font-style:italic;font-size:82%">'.esc_html__('Please note: Our support does not include any customization.', 'avas'). '</span></p>'; ?>

          <?php echo '<p style="border-bottom:1px solid #e6e6e6;margin-top: 30px; margin-bottom: 35px;"></p>'; ?>
          <?php echo '<p>There are few recommended plugins but those are not requried and some are for specific demo only:</p>
          <p>
          <strong>Slider Revolution</strong> - This plugin for Home page slider. <br>
          <strong>Contact Form 7</strong> - This plugin for Contact Form. <br>
          <strong>LearnPress</strong> - This for Education demo only.<br>
          <strong>Give</strong> - This for Charity demo only.<br>
          <strong>WooCommerce</strong> - This for eCommerce shop only.<br>
          <strong>WPBakery</strong> - This is additional page builder if you don\'t want to use Elementor then you can use it.(Please note all our demos are built with <strong>Elementor</strong>.)<br>
          </p>'; 
          
          ?>
        </div>
      </div>
    <?php
        }
  
    public function tx_theme_redirect() {
      global $pagenow;
      if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {
        wp_redirect(admin_url('admin.php?page=Welcome')); 
      }
    }

  }

  new tx_Welcome_Screen();
}

