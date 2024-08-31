<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*
* Business informatin for header
*
**/
global $tx;
?>

<div class="bs-info-area">
  <?php
    
    foreach($tx['bs-info'] as $bs_info) : 
      $img   = $bs_info['image'];
      $title = $bs_info['title'];
      $desc  = $bs_info['description']; ?>
      <div class="bs-info-content">
        <div class="info-box">
          <?php if ($img) : ?>
         
            <span><?php echo '<img src="' . esc_url($img) . '" alt="'. esc_html($title) .'" >'; ?></span>
          
          <?php endif; ?>
          <div class="c-box">
            <h6 class="title"><?php echo wp_sprintf($title);?></h6>
            <p class="desc"><?php echo wp_sprintf($desc); ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php //} ?>
    <?php //endif; ?>
</div>