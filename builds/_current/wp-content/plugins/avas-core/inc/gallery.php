<?php
/**
 * 
 * @package tx
 * @author theme-x
 * @link https://x-theme.com/
 * ========================================
 *   Gallery for post and custom post types
 * ========================================
 */

  function tx_add_gallery_metabox($post_type) {
    $types = array('portfolio','post','lp_course');
    if (in_array($post_type, $types)) {
      add_meta_box(
        'gallery-metabox',
        'Gallery',
        'tx_gallery_meta_callback',
        $post_type,
        'side',
        'low'
      );
    }
  }

  add_action('add_meta_boxes', 'tx_add_gallery_metabox');
  function tx_gallery_meta_callback($post) {
    wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
    $ids = get_post_meta($post->ID, 'tx_gallery_id', true);
    ?>
    <table class="form-table">
      <tr><td>
        <a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)"><?php esc_html_e('Add image','avas-core'); ?></a>
        <ul id="gallery-metabox-list">
        <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
          <li>
            <input type="hidden" name="tx_gallery_id[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>">
            <?php if( !empty($image[0]) ) :?>
            <img class="image-preview" src="<?php echo esc_url($image[0]); ?>">
            <?php endif; ?>
            <a class="change-image button button-small" href="#" data-uploader-title="Change" data-uploader-button-text="Change"><?php esc_html_e('Change', 'avas-core'); ?></a><br>
            <small><a class="remove-image" href="#"><?php esc_html_e('Remove', 'avas-core'); ?></a></small>
          </li>
        <?php endforeach; endif; ?>
        </ul>
      </td></tr>
    </table>

  <script type="text/javascript">
  jQuery(function($) {
    var file_frame;
    $(document).on('click', '#gallery-metabox a.gallery-add', function(e) {
      e.preventDefault();
      if (file_frame) file_frame.close();
      file_frame = wp.media.frames.file_frame = wp.media({
        title: $(this).data('uploader-title'),
        button: {
          text: $(this).data('uploader-button-text'),
        },
        multiple: true
      });
      file_frame.on('select', function() {
        var listIndex = $('#gallery-metabox-list li').index($('#gallery-metabox-list li:last')),
            selection = file_frame.state().get('selection');
        selection.map(function(attachment, i) {
          attachment = attachment.toJSON(),
          index      = listIndex + (i + 1);
          $('#gallery-metabox-list').append('<li><input type="hidden" name="tx_gallery_id[' + index + ']" value="' + attachment.id + '"><img class="image-preview" src="' + attachment.url + '"><a class="change-image button button-small" href="#" data-uploader-title="Change" data-uploader-button-text="Change">Change</a><br><small><a class="remove-image" href="#">Remove</a></small></li>');
        });
      });
      makeSortable();
      file_frame.open();
    });
    $(document).on('click', '#gallery-metabox a.change-image', function(e) {
      e.preventDefault();
      var that = $(this);
      if (file_frame) file_frame.close();
      file_frame = wp.media.frames.file_frame = wp.media({
        title: $(this).data('uploader-title'),
        button: {
          text: $(this).data('uploader-button-text'),
        },
        multiple: false
      });
      file_frame.on( 'select', function() {
        attachment = file_frame.state().get('selection').first().toJSON();
        that.parent().find('input:hidden').attr('value', attachment.id);
        that.parent().find('img.image-preview').attr('src', attachment.url);
      });
      file_frame.open();
    });
    function resetIndex() {
      $('#gallery-metabox-list li').each(function(i) {
        $(this).find('input:hidden').attr('name', 'tx_gallery_id[' + i + ']');
      });
    }
    function makeSortable() {
      $('#gallery-metabox-list').sortable({
        opacity: 0.6,
        stop: function() {
          resetIndex();
        }
      });
    }
    $(document).on('click', '#gallery-metabox a.remove-image', function(e) {
      e.preventDefault();
      $(this).parents('li').animate({ opacity: 0 }, 200, function() {
        $(this).remove();
        resetIndex();
      });
    });
    makeSortable();
  });
  </script>

  <?php }

  add_action('save_post', 'gallery_meta_save');
  function gallery_meta_save($post_id) {
    if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(isset($_POST['tx_gallery_id'])) {
      update_post_meta($post_id, 'tx_gallery_id', $_POST['tx_gallery_id']);
    } else {
      delete_post_meta($post_id, 'tx_gallery_id');
    }
  }
  
  function tx_gallery_css() {
    echo '<style type="text/css">
    #gallery-metabox-list li {
    float: left;
    width: 26%;
    margin: 7px;
    cursor: move;
    }
    #gallery-metabox-list li img {
    max-width: 100%;
    }
    #gallery-metabox-list {content: "";display: table;clear: both;}
    </style>';
  }
  add_action('admin_head', 'tx_gallery_css');
/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 