<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*/
global $tx;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">
        <?php 
        $images = get_post_meta($post->ID, 'tx_gallery_id', true); 
        if(function_exists('tx_add_gallery_metabox') && $images) { ?>
            <div class="gallery-slider"><!-- slider start -->         
                <ul class="posts-gallery-slider cS-hidden">
                <?php         
                $images = get_post_meta($post->ID, 'tx_gallery_id', true);  
                if($images) :
                foreach ($images as $image) {

                $image_thumb_url = wp_get_attachment_image_src($image, 'tx-s-thumb'); 
                $thumbs = $image_thumb_url[0];
                $gallery = wp_get_attachment_image($image, 'full');

                    echo '<li data-thumb = "'.$thumbs.'">';                
                    echo  wp_kses_post($gallery);
                    echo '</li>';  
                }
                  endif;
                ?>
                </ul>
            </div><!-- slider end --> 
        <?php }else{?> 
        <?php if (has_post_thumbnail()) : ?>
            <div class="zoom-thumb featured-thumb">
                <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail('full'); ?>
                </a>
            </div>
        <?php endif; } ?>
        <div class="content-top-20">
        <header class="entry-header">
                <?php 
                    if ( is_home () || is_category() || is_archive() || is_page_template( 'templates/blog.php' ) ) :
                        the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>');
                    else :
                        if($tx['posts-title']) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        endif;
                    endif;
                ?>
                <?php if ('post' == get_post_type()) : ?>
                    <div class="entry-meta">
                        <?php tx_date(); ?>
                        <?php tx_author(); ?>
                        <?php tx_comments(); ?>
                        <?php echo tx_getPostViews(get_the_ID()); ?>
                        <?php do_action('tx_social_share_header'); ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>

            </header><!-- .entry-header -->
        <?php
            if ( is_home () || is_category() || is_archive() || is_page_template( 'templates/blog.php' ) ) {
                the_excerpt();
            } else {
            /* translators: %s: Name of current post */
            the_content(sprintf(
                            esc_attr__('Read more %s &rarr;', 'avas'), the_title('<span class="screen-reader-text">"', '"</span>', false)
            ));
            }
            ?>
            <?php
                if ( !is_archive() && !is_paged('blog') ) {
                    wp_link_pages(array(
                    'before' => '<div class="page-link">' . esc_html__('Pages:', 'avas'),
                    'after' => '</div>',
                ));
                }
            ?>
        </div><!-- content-top-20 -->
    </div><!-- .entry-content -->
    <div class="clearfix"></div>
    <?php
        if ( is_home () || is_category() || is_archive() || is_page_template( 'templates/blog.php' ) ) :
        else :
    ?>
    <footer class="entry-footer">
        <?php tx_category(); ?>
        <?php do_action('tx_tags'); ?>
    </footer><!-- .entry-footer -->
    <?php endif; ?>
    <?php
        if ( is_home () || is_category() || is_archive() || is_page_template( 'templates/blog.php' ) ) {
        } else {
        do_action('tx_social_share'); 
        } 
    ?>
</article><!-- #post-## -->