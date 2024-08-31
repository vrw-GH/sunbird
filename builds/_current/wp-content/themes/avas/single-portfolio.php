<?php
/**
 * 
 * @package tx
 * @author theme-x
 * @link https://theme-x.org/
 *
 * ====================================
 *         Single Portfolio
 * ====================================
 */
global $tx;
$project_completion_title = get_post_meta($post->ID, 'project_completion_title', true);
$completion = get_post_meta($post->ID, 'completion', true);
$project_title = get_post_meta($post->ID, 'project_title', true);
$project_fields = get_post_meta($post->ID, 'project_fields', true);
$web_url = get_post_meta($post->ID, 'web_url', true);
$btn_txt = get_post_meta($post->ID, 'btn_txt', true);
$btn_url = get_post_meta($post->ID, 'btn_url', true);
get_header(); 

if (have_posts()): while (have_posts()): the_post(); ?>
<div class="container space-content">
  	<div class="row">
		<div class="col-lg-8 col-md-12">
            <?php 
            $images = get_post_meta($post->ID, 'tx_gallery_id', true); 
            if(function_exists('tx_add_gallery_metabox') && $images) { ?>
			
            <div class="item"><!-- slider start -->         
                <ul id="portfolio-gallery" class="gallery list-unstyled cS-hidden">
                <?php         
              //  $images = get_post_meta($post->ID, 'tx_gallery_id', true);  
                if($images) :
                foreach ($images as $image) {

                $image_thumb_url = wp_get_attachment_image_src($image, 'tx-s-thumb'); 
                $thumbs = $image_thumb_url[0];
                $gallery = wp_get_attachment_image($image, 'tx-l-thumb');

                    echo '<li data-thumb = "'.$thumbs.'">';                
                    echo  wp_kses_post($gallery);
                    echo '</li>';  
                }
                  endif;
                ?>
                </ul>
            </div><!-- slider end -->

            <?php } else { ?>
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('tx-l-thumb'); ?>
            <?php endif; ?>
            <?php } ?>
            
            <div class="portfolio_content">
            	<?php the_content(); ?>
            </div>
		</div><!-- /.col-lg-8 col-sm-12 -->
<?php 
endwhile;	
endif;
?>

        <div id="secondary" class="widget-area col-lg-4 col-md-6 col-sm-12" role="complementary">
            <?php 
            if ( !empty($project_title) || !empty($project_fields) ) : ?>
                <div class="widget">
                    <?php 
                    if ( !empty($project_title) ) : ?>
                         <h3 class="widget-title"><?php echo esc_html($project_title ); ?></h3>
                    <?php endif; ?>
                    <?php     
                    if ( $project_fields ) : ?>
                        <table class="project-table">
                            <tbody>
                            <?php foreach ( $project_fields as $field ) : ?>
                                    <tr><?php if($field['name'] != '') echo '<td>'. esc_attr( $field['name'] ) . '</td>'; ?>
                                    <?php if($field['value'] != '') echo '<td>'. esc_attr( $field['value'] ) . '</td>'; ?></tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( !empty($project_completion_title) || !empty($completion) ) : ?>
            <div class="widget">
                <?php if ( !empty($project_completion_title) ) : ?>
                    <h3 class="widget-title"><?php printf(esc_html__('%s', 'avas'), $project_completion_title ); ?></h3>
                <?php endif; ?>
                <?php if ( !empty($completion) ) : ?>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr($completion); ?>%;" aria-valuenow="<?php echo esc_attr($completion); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo esc_attr($completion); ?>%</div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if ( !empty($web_url) || !empty($btn_txt) || !empty($btn_url) || $tx['portfolio-time'] == '1' || $tx['portfolio-author'] == '1'  ): ?>
            <div class="widget">
                <?php tx_portfolio_meta(); ?>
            </div>
            <?php endif; ?>


        <?php
        if (is_active_sidebar('sidebar-portfolio')) : 
            dynamic_sidebar('sidebar-portfolio'); ?>
        <?php endif; ?>
        </div><!-- /#secondary -->

<?php get_footer(); ?>