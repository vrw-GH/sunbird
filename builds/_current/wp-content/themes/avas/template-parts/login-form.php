<?php
/**
* 
* @package tx
* @author theme-x
*
*  Login Form
*/
global $tx;
?>

					<form id="login" class="tx-login" action="login" method="post">
                        <h2><?php esc_html_e( 'Login', 'avas' ); ?></h2>
                        <p class="status"></p>
                        <div>
                            <div class="space-20">
                            <input id="username" type="text" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div>
                            <div class="space-20">
                        <input id="password" type="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <a class="lost tx-lost-pass" href="<?php echo wp_lostpassword_url(); ?>"><?php esc_html_e( 'Lost your password?', 'avas' ); ?></a>
                        <input class="submit_button" type="submit" value="Login" name="submit">
                        <a class="tx-close" ><i class="la la-close"></i></a>
                        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                        <div class="clearfix"></div>
                        <div class="no_acc">
                            <?php esc_html_e('Don\'t have an account?','avas'); ?>
                        <a href="<?php echo wp_kses_post($tx['signup-text']); ?>"><?php esc_html_e('Sign Up','avas'); ?></a>
                        </div>
                    </form>   