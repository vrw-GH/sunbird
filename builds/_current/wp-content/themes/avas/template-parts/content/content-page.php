<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'avas'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
</div><!-- #post-## -->