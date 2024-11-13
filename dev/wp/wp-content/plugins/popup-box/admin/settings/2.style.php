<?php
/*
 * Page Name: Style
 */

use PopupBox\Admin\CreateFields;

defined( 'ABSPATH' ) || exit;

$page_opt = include( 'options/style.php' );
$field    = new CreateFields( $options, $page_opt );

$item_order = ! empty( $options['item_order']['popup'] ) ? 1 : 0;
$open       = ! empty( $item_order ) ? ' open' : '';
?>
<details class="wpie-item"<?php echo esc_attr( $open ); ?>>
    <input type="hidden" name="param[item_order][popup]" class="wpie-item__toggle"
           value="<?php echo absint( $item_order ); ?>">
    <summary class="wpie-item_heading">
        <span class="wpie-item_heading_icon"><span class="wpie-icon wpie_icon-paintbrush"></span></span>
        <span class="wpie-item_heading_label"><?php esc_html_e( 'Popup', 'popup-box' ); ?></span>
        <span class="wpie-item_heading_type"></span>
        <span class="wpie-item_heading_toogle">
        <span class="wpie-icon wpie_icon-chevron-down"></span>
        <span class="wpie-icon wpie_icon-chevron-up "></span>
    </span>
    </summary>
    <div class="wpie-item_content">

        <div class="wpie-fieldset">
            <div class="wpie-legend"><?php esc_html_e( 'Properties', 'popup-box' ); ?></div>
            <div class="wpie-fields">
				<?php $field->create( 'zindex' ); ?>
				<?php $field->create( 'popup_animation' ); ?>
				<?php $field->create( 'block_page' ); ?>
            </div>
        </div>
        <div class="wpie-fieldset">
            <div class="wpie-legend"><?php esc_html_e( 'Dimensions and Positioning', 'popup-box' ); ?></div>
            <div class="wpie-fields">
				<?php $field->create( 'width' ); ?>
				<?php $field->create( 'height' ); ?>
            </div>
            <div class="wpie-fields">
				<?php $field->create( 'location' ); ?>
				<?php $field->create( 'top' ); ?>
				<?php $field->create( 'bottom' ); ?>
				<?php $field->create( 'left' ); ?>
				<?php $field->create( 'right' ); ?>
            </div>
        </div>
        <div class="wpie-fieldset">
            <div class="wpie-legend"><?php esc_html_e( 'Visual Design', 'popup-box' ); ?></div>
            <div class="wpie-fields">
				<?php $field->create( 'radius' ); ?>
				<?php $field->create( 'padding' ); ?>
            </div>

            <div class="wpie-fields">
				<?php $field->create( 'shadow' ); ?>
				<?php $field->create( 'shadow_color' ); ?>
            </div>
            <div class="wpie-fields">
				<?php $field->create( 'background' ); ?>
				<?php $field->create( 'background_img' ); ?>
            </div>
        </div>
        <div class="wpie-fieldset">
            <div class="wpie-legend"><?php esc_html_e( 'Overlay', 'popup-box' ); ?></div>
            <div class="wpie-fields">
				<?php $field->create( 'overlay' ); ?>
				<?php $field->create( 'overlay_animation' ); ?>
            </div>
        </div>
    </div>
</details>

<?php
$item_order = ! empty( $options['item_order']['content'] ) ? 1 : 0;
$open       = ! empty( $item_order ) ? ' open' : '';
?>
<details class="wpie-item"<?php echo esc_attr( $open ); ?>>
    <input type="hidden" name="param[item_order][content]" class="wpie-item__toggle"
           value="<?php echo absint( $item_order ); ?>">
    <summary class="wpie-item_heading">
        <span class="wpie-item_heading_icon"><span class="wpie-icon wpie_icon-file-content"></span></span>
        <span class="wpie-item_heading_label"><?php esc_html_e( 'Content', 'popup-box' ); ?></span>
        <span class="wpie-item_heading_type"></span>
        <span class="wpie-item_heading_toogle">
        <span class="wpie-icon wpie_icon-chevron-down"></span>
        <span class="wpie-icon wpie_icon-chevron-up "></span>
    </span>
    </summary>
    <div class="wpie-item_content">
        <div class="wpie-fieldset">
            <div class="wpie-fields">
				<?php $field->create( 'content_font' ); ?>
				<?php $field->create( 'content_size' ); ?>
				<?php $field->create( 'content_padding' ); ?>
            </div>
            <div class="wpie-fields">
				<?php $field->create( 'border_style' ); ?>
				<?php $field->create( 'border_width' ); ?>
				<?php $field->create( 'border_radius' ); ?>
				<?php $field->create( 'border_color' ); ?>
            </div>
        </div>

    </div>
</details>

<?php
$item_order = ! empty( $options['item_order']['close_btn'] ) ? 1 : 0;
$open       = ! empty( $item_order ) ? ' open' : '';
?>
<details class="wpie-item"<?php echo esc_attr( $open ); ?>>
    <input type="hidden" name="param[item_order][close_btn]" class="wpie-item__toggle"
           value="<?php echo absint( $item_order ); ?>">
    <summary class="wpie-item_heading">
        <span class="wpie-item_heading_icon"><span class="wpie-icon wpie_icon-xmark"></span></span>
        <span class="wpie-item_heading_label"><?php esc_html_e( 'Close Button', 'popup-box' ); ?></span>
        <span class="wpie-item_heading_type"></span>
        <span class="wpie-item_heading_toogle">
        <span class="wpie-icon wpie_icon-chevron-down"></span>
        <span class="wpie-icon wpie_icon-chevron-up "></span>
    </span>
    </summary>
    <div class="wpie-item_content">
        <div class="wpie-fieldset">
            <div class="wpie-fields">
				<?php $field->create( 'close' ); ?>
				<?php $field->create( 'close_size' ); ?>
				<?php $field->create( 'close_text' ); ?>
            </div>
            <div class="wpie-fields">
				<?php $field->create( 'close_place' ); ?>
				<?php $field->create( 'close_location' ); ?>
            </div>
            <div class="wpie-fields">
				<?php $field->create( 'close_color' ); ?>
				<?php $field->create( 'close_background' ); ?>
            </div>
        </div>

    </div>
</details>

<?php
$item_order = ! empty( $options['item_order']['mobile_devices'] ) ? 1 : 0;
$open       = ! empty( $item_order ) ? ' open' : '';
?>
<details class="wpie-item"<?php echo esc_attr( $open ); ?>>
    <input type="hidden" name="param[item_order][mobile_devices]" class="wpie-item__toggle"
           value="<?php echo absint( $item_order ); ?>">
    <summary class="wpie-item_heading">
        <span class="wpie-item_heading_icon"><span class="wpie-icon wpie_icon-laptop-mobile"></span></span>
        <span class="wpie-item_heading_label"><?php esc_html_e( 'Mobile Devices', 'popup-box' ); ?></span>
        <span class="wpie-item_heading_type"></span>
        <span class="wpie-item_heading_toogle">
        <span class="wpie-icon wpie_icon-chevron-down"></span>
        <span class="wpie-icon wpie_icon-chevron-up "></span>
    </span>
    </summary>
    <div class="wpie-item_content">
        <div class="wpie-fieldset">
            <div class="wpie-fields">
				<?php $field->create( 'mobile' ); ?>
				<?php $field->create( 'mobile_width' ); ?>
            </div>
        </div>

    </div>
</details>

