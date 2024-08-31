<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Template Name: Left Side Image
* Template Post Type: service
*
*/
global $tx;

$brochure_title = get_post_meta(get_the_ID(), 'brochure_title', true);
$brochure_desc = get_post_meta(get_the_ID(), 'brochure_desc', true);
$brochure_img_id = get_post_meta(get_the_ID(), 'brochure_img', true);
$brochure_img_url = wp_get_attachment_image_src( $brochure_img_id, 'tx-ms-size' );
$brochure_img_name = basename( get_attached_file( $brochure_img_id ) );
$brochure_image = $brochure_img_url[0];
$brochure_file_id = get_post_meta(get_the_ID(), 'brochure_file', true);
$brochure_file = wp_get_attachment_url($brochure_file_id);
$form_shortcode = do_shortcode(get_post_meta(get_the_ID(), 'form_shortcode', true));

get_header(); 

?>
<div class="container space-content">
    <div class="row">	
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
		        
        <div class="col-lg-8 col-sm-8">
            <div class="service-image">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('tx-l-thumb'); ?>
            <?php endif; ?>
            </div>
            <div class="service-content">
                <?php the_content(); ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>
        <?php endif; ?><!-- End left part -->
        
		<div id="secondary" class="widget-area col-md-4 col-sm-12" role="complementary">
            <?php if(!empty($brochure_title) || !empty($brochure_desc) || !empty($brochure_image) || !empty($brochure_file) || !empty($form_shortcode) ) : ?>
            <div class="widget">
                <?php if ( !empty($brochure_title) ) : ?>
                <h3 class="widget-title"><?php echo esc_html($brochure_title); ?></h3>
                <?php endif; ?>
                <p class="service-brochure-desc"><?php echo esc_html($brochure_desc); ?></p>
               
                    <?php if(!empty($brochure_image)) : ?>
                    <div class="brochure-img">
                        <img src="<?php echo esc_attr($brochure_image); ?>" alt="<?php echo esc_attr($brochure_img_name); ?>" />
                    </div>
                    <?php endif; ?>

                    <?php
                    if (!empty($brochure_file)) : ?>
                    <div class="brochure-file">
                        <a class="btn-brochure" href="<?php echo esc_url($brochure_file); ?>" target="_blank"><i class="la la-file"></i> <?php esc_html_e('Download File', 'avas'); ?></a>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($form_shortcode)) : ?>
                    <div><?php echo wp_sprintf($form_shortcode); ?></div>
                    <?php endif; ?>
               
            </div><!-- widget end --> 
            <?php endif; ?>
            <?php
            if (is_active_sidebar('sidebar-services')) : 
                dynamic_sidebar('sidebar-services'); ?>
            <?php endif; ?>          
        </div> <!-- /#secondary -->

<?php get_footer(); ?>