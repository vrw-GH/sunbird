<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
*
*
*/
global $tx;
/* ---------------------------------------------------------
  Social media
------------------------------------------------------------ */
if (!function_exists('tx_social_media')) :
add_action( 'tx_social_media', 'tx_social_media' );
add_shortcode( 'avas-social-media', 'tx_social_media' );

function tx_social_media() { 
    global $tx; 
    ob_start();
    ?>
    <ul class="social d-md-flex align-items-center">
        <?php if ($tx['behance']) : ?>
        <li><a href="<?php echo esc_html($tx['behance']); ?>" title="Behance" target="_blank"><i class="fab fa-behance"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['delicious']) : ?>
        <li><a href="<?php echo esc_html($tx['delicious']); ?>" title="Delicious" target="_blank"><i class="fab fa-delicious"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['deviantart']) : ?>
        <li><a href="<?php echo esc_html($tx['deviantart']); ?>" title="DeviantArt" target="_blank"><i class="fab fa-deviantart"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['discord']) : ?>
        <li><a href="<?php echo esc_html($tx['discord']); ?>" title="Discord" target="_blank"><i class="fab fa-discord"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['dribbble']) : ?>
        <li><a href="<?php echo esc_html($tx['dribbble']); ?>" title="Dribbble" target="_blank"><i class="fab fa-dribbble"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['ello']) : ?>
        <li><a href="<?php echo esc_html($tx['ello']); ?>" title="Ello" target="_blank"><i class="fab fa-ello"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['facebook']) : ?>
        <li><a href="<?php echo esc_html($tx['facebook']); ?>" title="Facebook" target="_blank"><i class="fab fa-facebook"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['flickr']) : ?>
        <li><a href="<?php echo esc_html($tx['flickr']); ?>" title="Flickr" target="_blank"><i class="fab fa-flickr"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['foursquare']) : ?>
        <li><a href="<?php echo esc_html($tx['foursquare']); ?>" title="Foursquare" target="_blank"><i class="fab fa-foursquare"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['github']) : ?>
        <li><a href="<?php echo esc_html($tx['github']); ?>" title="Github" target="_blank"><i class="fab fa-github"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['goodreads']) : ?>
        <li><a href="<?php echo esc_html($tx['goodreads']); ?>" title="Goodreads" target="_blank"><i class="fab fa-goodreads"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['instagram']) : ?>
        <li><a href="<?php echo esc_html($tx['instagram']); ?>" title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['line']) : ?>
        <li><a href="<?php echo esc_html($tx['line']); ?>" title="Line" target="_blank"><i class="fab fa-line"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['linkedin']) : ?>
        <li><a href="<?php echo esc_html($tx['linkedin']); ?>" title="LinkedIn" target="_blank"><i class="fab fa-linkedin"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['medium']) : ?>
        <li><a href="<?php echo esc_html($tx['medium']); ?>" title="Medium" target="_blank"><i class="fab fa-medium"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['meetup']) : ?>
        <li><a href="<?php echo esc_html($tx['meetup']); ?>" title="Meetup" target="_blank"><i class="fab fa-meetup"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['mix']) : ?>
        <li><a href="<?php echo esc_html($tx['mix']); ?>" title="Mix" target="_blank"><i class="fab fa-mix"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['pinterest']) : ?>
        <li><a href="<?php echo esc_html($tx['pinterest']); ?>" title="Pinterest" target="_blank"><i class="fab fa-pinterest"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['quora']) : ?>
        <li><a href="<?php echo esc_html($tx['quora']); ?>" title="Quora" target="_blank"><i class="fab fa-quora"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['qq']) : ?>
        <li><a href="<?php echo esc_html($tx['qq']); ?>" title="QQ" target="_blank"><i class="fab fa-qq"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['ravelry']) : ?>
        <li><a href="<?php echo esc_html($tx['ravelry']); ?>" title="Ravelry" target="_blank"><i class="fab fa-ravelry"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['reddit']) : ?>
        <li><a href="<?php echo esc_html($tx['reddit']); ?>" title="Reddit" target="_blank"><i class="fab fa-reddit"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['skype']) : ?>
        <li><a href="<?php echo esc_html($tx['skype']); ?>" title="Skype" target="_blank"><i class="fab fa-skype"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['snapchat']) : ?>
        <li><a href="<?php echo esc_html($tx['snapchat']); ?>" title="Snapchat" target="_blank"><i class="fab fa-snapchat"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['soundcloud']) : ?>
        <li><a href="<?php echo esc_html($tx['soundcloud']); ?>" title="Soundcloud" target="_blank"><i class="fab fa-soundcloud"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['spotify']) : ?>
        <li><a href="<?php echo esc_html($tx['spotify']); ?>" title="Spotify" target="_blank"><i class="fab fa-spotify"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['stumbleupon']) : ?>
        <li><a href="<?php echo esc_html($tx['stumbleupon']); ?>" title="StumbleUpon" target="_blank"><i class="fab fa-stumbleupon"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['telegram']) : ?>
        <li><a href="<?php echo esc_html($tx['telegram']); ?>" title="Telegram" target="_blank"><i class="fab fa-telegram"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['tiktok']) : ?>
        <li><a href="<?php echo esc_html($tx['telegram']); ?>" title="Tiktok" target="_blank"><i class="fab fa-tiktok"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['tumblr']) : ?>
        <li><a href="<?php echo esc_html($tx['tumblr']); ?>" title="Tumblr" target="_blank"><i class="fab fa-tumblr"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['twitch']) : ?>
        <li><a href="<?php echo esc_html($tx['twitch']); ?>" title="Twitch" target="_blank"><i class="fab fa-twitch"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['twitter']) : ?>
        <li><a href="<?php echo esc_html($tx['twitter']); ?>" title="Twitter" target="_blank"><i class="fab fa-twitter"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['vimeo']) : ?>
        <li><a href="<?php echo esc_html($tx['vimeo']); ?>" title="Vimeo" target="_blank"><i class="fab fa-vimeo"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['viber']) : ?>
        <li><a href="<?php echo esc_html($tx['vimeo']); ?>" title="Viber" target="_blank"><i class="fab fa-viber"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['vine']) : ?>
        <li><a href="<?php echo esc_html($tx['vine']); ?>" title="Vine" target="_blank"><i class="fab fa-vine"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['vk']) : ?>
        <li><a href="<?php echo esc_html($tx['vk']); ?>" title="VK" target="_blank"><i class="fab fa-vk"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['wechat']) : ?>
        <li><a href="<?php echo esc_html($tx['whatsapp']); ?>" title="WeChat" target="_blank"><i class="fab fa-weixin"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['whatsapp']) : ?>
        <li><a href="<?php echo esc_html($tx['whatsapp']); ?>" title="WhatsApp" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['wikipedia']) : ?>
        <li><a href="<?php echo esc_html($tx['wikipedia']); ?>" title="Wikipedia" target="_blank"><i class="fab fa-wikipedia-w"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['xing']) : ?>
        <li><a href="<?php echo esc_html($tx['xing']); ?>" title="Xing" target="_blank"><i class="fab fa-xing"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['yelp']) : ?>
        <li><a href="<?php echo esc_html($tx['yelp']); ?>" title="Yelp" target="_blank"><i class="fab fa-yelp"></i></a></li>
        <?php endif; ?>
        <?php if ($tx['youtube']) : ?>
        <li><a href="<?php echo esc_html($tx['youtube']); ?>" title="Youtube" target="_blank"><i class="fab fa-youtube"></i></a></li>
        <?php endif; ?>
        
    </ul> 
    <?php
    return ob_get_clean();
} 
endif;
/* ---------------------------------------------------------
    Social Share
------------------------------------------------------------ */

if (!function_exists('tx_social_share_header')) :
add_action( 'tx_social_share_header', 'tx_social_share_header' );
function tx_social_share_header() {
global $tx;
  if($tx['social-share-header']) {
  global $post;

    // Get current page URL 
    $SSURL = urlencode(get_permalink());
 
    // Get current page title
    $SSTitle = str_replace( ' ', '%20', get_the_title());
    
    // Get Post Thumbnail
    $SSThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$SSURL;
    $twitterURL = 'https://twitter.com/intent/tweet?text='.$SSTitle.'&amp;url='.$SSURL;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$SSURL.'&amp;title='.$SSTitle;
    if ( is_array( $SSThumb ) ) {
    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$SSURL.'&amp;media='.$SSThumb[0].'&amp;description='.$SSTitle;
    }

    $html = '';
    $html .= '<span class="social-share-header">';
    $html .= '<span class="share-on">'.esc_html__( 'Share on','avas-core' ).'</span>';
    $html .= '<a class="ss-fb" href="'.$facebookURL.'" target="_blank"><i class="fab fa-facebook"></i></a>';
    $html .= '<a class="ss-tw" href="'. $twitterURL .'" target="_blank"><i class="fab fa-twitter"></i></a>';
    $html .= '<a class="ss-ln" href="'.$linkedInURL.'" target="_blank"><i class="fab fa-linkedin"></i></a>';
    if ( is_array( $SSThumb ) ) {
    $html .= '<a class="ss-pin" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><i class="fab fa-pinterest-p"></i></a>';
    }
    $html .= '</span>';

    return print $html;
 
  } 
}
endif;


// social share on footer of post

if (!function_exists('tx_social_share')) :
add_action( 'tx_social_share', 'tx_social_share' );
function tx_social_share() {
  global $tx;
  if($tx['social-share-footer']) {
  global $post;

    // Get current page URL 
    $SSURL = urlencode(get_permalink());
 
    // Get current page title
    $SSTitle = str_replace( ' ', '%20', get_the_title());
    
    // Get Post Thumbnail
    $SSThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$SSURL;
    $twitterURL = 'https://twitter.com/intent/tweet?text='.$SSTitle.'&amp;url='.$SSURL;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$SSURL.'&amp;title='.$SSTitle;
    if ( is_array( $SSThumb ) ) {
    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$SSURL.'&amp;media='.$SSThumb[0].'&amp;description='.$SSTitle;
    }
    
    $html = '';
    $html .= '<div class="social-share">';
    $html .= '<div class="share-on-title">';
    $html .= '<h5>'.esc_html__( 'Share on','avas-core' ).'</h5>';
    $html .= '</div>';
    $html .= '<a class="ss-fb" href="'.$facebookURL.'" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>';
    $html .= '<a class="ss-tw" href="'. $twitterURL .'" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>';
    $html .= '<a class="ss-ln" href="'.$linkedInURL.'" target="_blank"><i class="fab fa-linkedin"></i> Linkedin</a>';
    if ( is_array( $SSThumb ) ) {
    $html .= '<a class="ss-pin" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><i class="fab fa-pinterest-p"></i> Pinterest</a>';
    }
    $html .= '</div>';

    return print $html;
    }
 
}
endif;

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 