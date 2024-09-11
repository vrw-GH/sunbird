<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
*
* Author template
*/
global $tx;
get_header(); 

?>

<div class="container space-author profile">
    <div class="row">
        <div class="col-lg-4 col-sm-4 profile_left_sec">
        <?php 
        $authorImage = get_the_author_meta('image');
        if($authorImage){
        echo '<img src='.$authorImage . '>';
        }
        else {
            echo get_avatar(get_the_author_meta('user_email'), '330'); 
        }
        echo '<div class="profile_info">';

        echo '<div class="profile_name">';
        echo the_author_meta('display_name');
        echo '</div>';

        echo '<div class="profile_address">';
        echo the_author_meta('address');
        echo '</div>';

        echo '<div class="profile_url">';
        echo the_author_meta('url');
        echo '</div>';

        echo '<div class="profile_description">';
        echo the_author_meta('description');
        echo '</div>';

        echo '<div class="social_profile">';
        $fb = get_the_author_meta('facebook');
        if ($fb !='') {
        echo '<a href="'.$fb.'" target="_blank" class="profile_link_fb"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>';
        }
        $tw = get_the_author_meta('twitter');
        if ($tw !='') {
        echo '<a href="'.$tw.'" target="_blank" class="profile_link"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>';
        }
        $in = get_the_author_meta('linkedin');
        if ($in !='') {
        echo '<a href="'.$in.'" target="_blank" class="profile_link"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>';
        }
        $ig = get_the_author_meta('instagram');
        if ($ig !='') {
        echo '<a href="'.$ig.'" target="_blank" class="profile_link"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
        }
        echo '</div>';


        echo '</div>';
        ?>

    </div><!-- /.profile_left_sec -->

    <div id="primary" class="col-lg-8 col-sm-8 profile_right_sec right">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                
                <div class="zoom-thumb">
                    <?php if (has_post_thumbnail()) :  ?>
                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <?php the_post_thumbnail('tx-large-img'); ?>
                    </a>
                    <?php endif; ?>
                </div><!-- /.zoom-thumb -->
                <header class="entry-header mt20">
                <?php the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>'); ?>
                 <?php if ('post' == get_post_type()) : ?>
                <div class="entry-meta">
                    <?php tx_date(); ?>
                    <?php tx_author(); ?>
                    <?php tx_comments(); ?>
                </div><!-- .entry-meta -->
                <?php endif; ?>
                </header><!-- /.entry-header -->
                <div class="post-excerpts space-50"><?php echo tx_excerpt(35); ?></div>

            <div class="clearfix"></div>

                     
            </article>      
        <?php endwhile; ?><!-- end of the loop -->

        <?php else:  ?>
            <?php get_template_part('template-parts/content/content', 'none'); ?>
        <?php endif; ?>

    </div><!-- /.profile_right_sec -->
    
<div class="tx-clear"></div>

  <!-- pagination -->
  <?php tx_pagination_number(); ?>

<?php
get_footer(); 
