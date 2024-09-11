<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
*=====================================
* 
*/

/* ---------------------------------------------------------
    bbPress Login Widget
------------------------------------------------------------ */
/**
 * bbPress Login Widget
 *
 * Adds a widget which displays the login form
 *
 * @since 2.0.0 bbPress (r2827)
 */
add_action( 'bbp_widgets_init', array( 'tx_BBP_Login_Widget',   'register_widget' ), 10 );
class tx_BBP_Login_Widget extends WP_Widget {

    /**
     * bbPress Login Widget
     *
     * Registers the login widget
     *
     * @since 2.0.0 bbPress (r2827)
     */
    public function __construct() {
        $widget_ops = apply_filters( 'bbp_login_widget_options', array(
            'classname'                   => 'bbp_widget_login',
            'description'                 => esc_html__( 'A simple login form with optional links to sign-up and lost password pages.', 'avas-core' ),
            'customize_selective_refresh' => true
        ) );

        parent::__construct( false, esc_html__( 'Avas(bbPress) Login Widget', 'avas-core' ), $widget_ops );
    }

    /**
     * Register the widget
     *
     * @since 2.0.0 bbPress (r3389)
     */
    public static function register_widget() {
        register_widget( 'tx_BBP_Login_Widget' );
    }

    /**
     * Displays the output, the login form
     *
     * @since 2.0.0 bbPress (r2827)
     *
     * @param array $args Arguments
     * @param array $instance Instance
     */
    public function widget( $args = array(), $instance = array() ) {

        // Get widget settings
        $settings = $this->parse_settings( $instance );

        // Typical WordPress filter
        $settings['title'] = apply_filters( 'widget_title', $settings['title'], $instance, $this->id_base );

        // bbPress filters
        $settings['title']    = apply_filters( 'bbp_login_widget_title',    $settings['title'],    $instance, $this->id_base );
        $settings['register'] = apply_filters( 'bbp_login_widget_register', $settings['register'], $instance, $this->id_base );
        $settings['lostpass'] = apply_filters( 'bbp_login_widget_lostpass', $settings['lostpass'], $instance, $this->id_base );

        echo $args['before_widget'];

        if ( ! empty( $settings['title'] ) ) {
            echo $args['before_title'] . $settings['title'] . $args['after_title'];
        }

        if ( ! is_user_logged_in() ) : ?>

            <form method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
                <fieldset class="bbp-form">
                    <legend><?php esc_html_e( 'Log In', 'avas-core' ); ?></legend>

                    <div class="bbp-username">
                        <label for="user_login"><?php esc_html_e( 'Username', 'avas-core' ); ?>: </label>
                        <input type="text" name="log" value="<?php bbp_sanitize_val( 'user_login', 'text' ); ?>" size="20" maxlength="100" id="user_login" autocomplete="off" />
                    </div>

                    <div class="bbp-password">
                        <label for="user_pass"><?php esc_html_e( 'Password', 'avas-core' ); ?>: </label>
                        <input type="password" name="pwd" value="<?php bbp_sanitize_val( 'user_pass', 'password' ); ?>" size="20" id="user_pass" autocomplete="off" />
                    </div>

                    <div class="bbp-remember-me">
                        <input type="checkbox" name="rememberme" value="forever" <?php checked( bbp_get_sanitize_val( 'rememberme', 'checkbox' ) ); ?> id="rememberme" />
                        <label for="rememberme"><?php esc_html_e( 'Keep me signed in', 'avas-core' ); ?></label>
                    </div>
                   
                    <?php do_action( 'login_form' ); ?>

                    <div class="bbp-submit-wrapper">

                        <button type="submit" name="user-submit" id="user-submit" class="button submit user-submit"><?php esc_html_e( 'Log In', 'avas-core' ); ?></button>

                        <?php bbp_user_login_fields(); ?>

                    </div>

                    <?php if ( ! empty( $settings['register'] ) || ! empty( $settings['lostpass'] ) ) : ?>

                        <div class="bbp-login-links">

                            <?php if ( ! empty( $settings['register'] ) ) : ?>

                                <a href="<?php echo esc_url( $settings['register'] ); ?>" title="<?php esc_attr_e( 'Register', 'avas-core' ); ?>" class="bbp-register-link"><?php esc_html_e( 'Register', 'avas-core' ); ?></a>

                            <?php endif; ?>

                            <?php if ( ! empty( $settings['lostpass'] ) ) : ?>

                                <a href="<?php echo esc_url( $settings['lostpass'] ); ?>" title="<?php esc_attr_e( 'Lost Password', 'avas-core' ); ?>" class="bbp-lostpass-link"><?php esc_html_e( 'Lost Password', 'avas-core' ); ?></a>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                </fieldset>
            </form>

        <?php else : ?>

            <div class="bbp-logged-in">
                <a href="<?php bbp_user_profile_url( bbp_get_current_user_id() ); ?>" class="submit user-submit">

                    <?php //echo get_avatar( bbp_get_current_user_id(), '40' ); ?>
                    <?php
                        $authorImage = get_user_meta( bbp_get_current_user_id(), 'image', true );
                        if($authorImage){
                            echo '<img src='.$authorImage . '>';
                        } else {
                            echo get_avatar( bbp_get_current_user_id(), '50' ); 
                        }

                    ?>
                        
                    </a>
                <h4><?php bbp_user_profile_link( bbp_get_current_user_id() ); ?></h4>

                <?php bbp_logout_link(); ?>
            </div>

        <?php endif;

        echo $args['after_widget'];
    }

    /**
     * Update the login widget options
     *
     * @since 2.0.0 bbPress (r2827)
     *
     * @param array $new_instance The new instance options
     * @param array $old_instance The old instance options
     */
    public function update( $new_instance, $old_instance ) {
        $instance             = $old_instance;
        $instance['title']    = strip_tags( $new_instance['title'] );
        $instance['register'] = esc_url_raw( $new_instance['register'] );
        $instance['lostpass'] = esc_url_raw( $new_instance['lostpass'] );

        return $instance;
    }

    /**
     * Output the login widget options form
     *
     * @since 2.0.0 bbPress (r2827)
     *
     * @param $instance Instance
     */
    public function form( $instance = array() ) {

        // Get widget settings
        $settings = $this->parse_settings( $instance ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'avas-core' ); ?>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $settings['title'] ); ?>" /></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'register' ); ?>"><?php esc_html_e( 'Register URI:', 'avas-core' ); ?>
            <input class="widefat" id="<?php echo $this->get_field_id( 'register' ); ?>" name="<?php echo $this->get_field_name( 'register' ); ?>" type="text" value="<?php echo esc_url( $settings['register'] ); ?>" /></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'lostpass' ); ?>"><?php esc_html_e( 'Lost Password URI:', 'avas-core' ); ?>
            <input class="widefat" id="<?php echo $this->get_field_id( 'lostpass' ); ?>" name="<?php echo $this->get_field_name( 'lostpass' ); ?>" type="text" value="<?php echo esc_url( $settings['lostpass'] ); ?>" /></label>
        </p>

        <?php
    }

    /**
     * Merge the widget settings into defaults array.
     *
     * @since 2.3.0 bbPress (r4802)
     *
     * @param $instance Instance
     */
    public function parse_settings( $instance = array() ) {
        return bbp_parse_args( $instance, array(
            'title'    => '',
            'register' => '',
            'lostpass' => ''
        ), 'login_widget_settings' );
    }
}