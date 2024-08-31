<?php
/**
* 
* header style 8
*
*/
global $tx;
?>

<?php if ($tx['header_on_off']) : ?>
<div class="header-style-eight">
    <div class="menu-bar"> <!-- menu bar -->
        <div class="container<?php echo tx_header_layout(); ?>">
            <div class="row">
                <!-- Main Menu -->  
                <?php get_template_part( 'template-parts/header/menu/main', 'menu' ); ?>
                <div class="menu-area-right">
                    <!-- Side menu -->
                    <?php get_template_part( 'template-parts/header/menu/side', 'menu' ); ?>
                    <!-- Search icon -->
                    <?php do_action('tx_search_icon'); ?>
                    <!-- Cart icon -->
                    <?php do_action('tx_cart_icon'); ?>
                    <!-- Menu Button -->
                    <?php do_action('tx_menu_btn'); ?>
                </div><!-- /.menu-area-righ -->
            </div> <!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.menu-bar -->    
    <div id="h-style-8" class="main-header">
        <div class="tx-header-overlay"></div><!-- overlay color -->
        <div class="container<?php echo tx_header_layout(); ?>">
        	<div class="row">
                <div class="col-lg-8 col-sm-12"><!-- ads -->
                    <div class="row">
                    <?php if($tx['banner-bussiness-switch'] == '1') : ?>
                    <?php tx_head_ads(); ?>
                    <?php endif; ?>
                    <?php if($tx['banner-bussiness-switch'] == '2') : ?>
                    <?php get_template_part( 'template-parts/header/business', 'info' ); ?>
                    <?php endif; ?>
                    </div>
                </div> <!-- ad end -->
                <!-- logo -->
                <div class="col-lg-4 col-sm-12">
                    <div class="row tx-float-right">
                        <?php do_action('tx_logo'); ?>
                    </div>
                </div><!-- logo end -->
        	</div> <!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /#h-style-8 -->
</div><!-- header-style-eight -->
<?php endif; ?>