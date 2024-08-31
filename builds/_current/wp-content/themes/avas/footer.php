<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* ============================
*         Footer
* ============================
*/
global $tx;
?>
</div>
</div> <!-- /.row -->
</div> <!-- /.content -->
<div class="row">
<div class="footer">
<?php
$footer_cols = $tx['footer_cols'];

if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') || is_active_sidebar('footer-5') || is_active_sidebar('footer-6') ) {
?>  
    <?php 
    if ( class_exists( 'ReduxFramework' ) ) {
    if($tx['footer_top']): ?>
    <div id="footer-top" class="footer_bg">
        <div class="footer-top-overlay"></div>
        <div class="container<?php echo tx_footer_width(); ?>"> 
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <?php dynamic_sidebar('footer-5'); ?>
                </div>
                <div class="col-lg-<?php echo esc_attr($footer_cols); ?> col-sm-6">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
                <div class="col-lg-<?php echo esc_attr($footer_cols); ?> col-sm-6">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
                <div class="col-lg-<?php echo esc_attr($footer_cols); ?> col-sm-6">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
                <div class="col-lg-<?php echo esc_attr($footer_cols); ?> col-sm-6">
                    <?php dynamic_sidebar('footer-4'); ?>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <?php dynamic_sidebar('footer-6'); ?>
                </div>
            </div><!-- end of .row -->
        </div><!-- .container end-->
    </div>
<?php endif; ?>
<?php } else { ?>
    <div id="footer-top" class="footer_bg">
        <div class="container<?php echo tx_footer_width(); ?>"> 
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
                <div class="col-md-3 col-sm-6">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
                <div class="col-md-3 col-sm-6">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
                <div class="col-md-3 col-sm-6">
                    <?php dynamic_sidebar('footer-4'); ?>
                </div>
            </div><!-- end of .row -->
        </div><!-- .container end-->
    </div>
<?php } ?>
<?php } ?>

<?php 
    if ( class_exists( 'ReduxFramework' ) ) {
    if($tx['footer_bottom']): ?>
    <div id="footer">
        <?php do_action('footer-style'); ?>
    </div><!-- /#footer -->
    <?php if($tx['back_top']) : ?>
        <div id="back_top" class="back_top"><i class="la la-arrow-up"></i></div>
    <?php endif; ?><!-- back to top -->             
    <?php endif; ?>

<?php } else { ?>
    <div id="footer">
        <div class="container footer-style-1">
            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <div class="copyright">
                        <p>Copryright &copy; <?php echo date("Y"); ?>, By <a href="https://1.envato.market/mPA2X">Avas WordPress Theme</a> | All rights reserved.</p>
                    </div>
                </div><!-- col-md-5 col-xs-12 -->
                <div class="col-md-7 col-xs-12">
                    <?php 
                        if($tx['footer-menu'])  : 
                            if ( has_nav_menu( 'footer_menu' ) ) {
                                wp_nav_menu( array(
                                    'theme_location' => 'footer_menu',
                                    'menu_class'     => 'footer-menu',
                                    'depth'          => 1,
                                    ) );
                            }
                        endif; 
                    ?><!-- footer menu end -->
                </div><!-- col-md-7 col-xs-12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- /#footer -->    
<?php } ?>

</div><!-- /.footer -->
</div><!-- /.row -->
</div><!-- /#page -->
<?php wp_footer(); ?>   
</body>
</html>