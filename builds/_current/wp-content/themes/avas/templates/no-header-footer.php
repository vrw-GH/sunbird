<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
 *
 * Template Name: No Header Footer
 */
global $tx;
get_header();
?>
<div class="container">
    <div class="row">
        <?php tx_content_page(); ?>
    </div>
</div>   
<?php get_footer(); 