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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <header class="entry-header">
            <?php if ( is_singular() ) : ?>
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <?php else: ?>
            <?php the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>'); ?>
            <?php endif; ?>
            <?php if ('post' == get_post_type()) : ?>
                <div class="entry-meta">
                    <?php tx_date(); ?>
                    <?php tx_author(); ?>
                    <?php tx_comments(); ?>
                    <?php echo tx_getPostViews(get_the_ID()); ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->
        <?php the_excerpt(); ?>
    </div><!-- .entry-content -->
    
    <?php if ( is_singular() ) : ?>
    <footer class="entry-footer">
        <?php tx_category(); ?>
        <?php tx_tags(); ?>
    </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-## -->