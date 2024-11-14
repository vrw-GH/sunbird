<?php
/*
 * Page Name: Settings
 */

use PopupBox\Admin\CreateFields;

defined( 'ABSPATH' ) || exit;

$page_opt = include( 'options/settings.php' );
$field    = new CreateFields( $options, $page_opt );
$id       = $options['id'] ?? '';

$item_order = ! empty( $options['item_order']['triggers'] ) ? 1 : 0;
$open       = ! empty( $item_order ) ? ' open' : '';
?>

    <details class="wpie-item"<?php echo esc_attr( $open ); ?>>
        <input type="hidden" name="param[item_order][triggers]" class="wpie-item__toggle"
               value="<?php echo absint( $item_order ); ?>">
        <summary class="wpie-item_heading">
            <span class="wpie-item_heading_icon"><span class="wpie-icon wpie_icon-crosshairs"></span></span>
            <span class="wpie-item_heading_label"><?php esc_html_e( 'Triggers', 'popup-box' ); ?></span>
            <span class="wpie-item_heading_type"></span>
            <span class="wpie-item_heading_toogle">
                <span class="wpie-icon wpie_icon-chevron-down"></span>
                <span class="wpie-icon wpie_icon-chevron-up "></span>
            </span>
        </summary>
        <div class="wpie-item_content">
            <div class="wpie-fieldset">
                <div class="wpie-fields">
					<?php $field->create( 'triggers' ); ?>
					<?php $field->create( 'delay' ); ?>
					<?php $field->create( 'distance' ); ?>
                </div>
                <div class="wpie-fields">
					<?php $field->create( 'cookie' ); ?>
                </div>
                <div class="wpie-fields is-column wpie-trigger-click">
                    <ul>
                        <li>
                            <b class="wpie-color-danger"><?php esc_html_e( 'You can open popup via adding to the element:', 'popup-box' ); ?></b>
                        </li>
                        <li><strong>Class</strong> - ds-open-popup-<?php echo absint( $id ); ?>, like <code>&lt;span
                                class="ds-open-popup-<?php echo absint( $id ); ?>"&gt;Open Popup&lt;/span&gt;</code>
                        </li>
                        <li><strong>URL</strong> - #ds-open-popup-<?php echo absint( $id ); ?>, like <code>&lt;a
                                href="#ds-open-popup-<?php echo absint( $id ); ?>">Open Popup&lt;/a&gt;</code></li>
                    </ul>
                </div>
            </div>

        </div>
    </details>

<?php
$item_order = ! empty( $options['item_order']['close_popup'] ) ? 1 : 0;
$open       = ! empty( $item_order ) ? ' open' : '';
?>
    <details class="wpie-item"<?php echo esc_attr( $open ); ?>>
        <input type="hidden" name="param[item_order][close_popup]" class="wpie-item__toggle"
               value="<?php echo absint( $item_order ); ?>">
        <summary class="wpie-item_heading">
            <span class="wpie-item_heading_icon"><span class="wpie-icon wpie_icon-square-minus"></span></span>
            <span class="wpie-item_heading_label"><?php esc_html_e( 'Closing Popup', 'popup-box' ); ?></span>
            <span class="wpie-item_heading_type"></span>
            <span class="wpie-item_heading_toogle">
                <span class="wpie-icon wpie_icon-chevron-down"></span>
                <span class="wpie-icon wpie_icon-chevron-up "></span>
            </span>
        </summary>
        <div class="wpie-item_content">
            <div class="wpie-fieldset">
                <div class="wpie-fields">
					<?php $field->create( 'close_overlay' ); ?>
					<?php $field->create( 'close_Esc' ); ?>
                </div>
                <div class="wpie-fields is-column">
                    <ul>
                        <li>
                            <b class="wpie-color-danger"><?php esc_html_e( 'You can сlose popup via adding to the element:', 'popup-box' ); ?></b>
                        </li>
                        <li><strong>Class</strong> - ds-close-popup, like <code>&lt;span
                                class="ds-close-popup"&gt;Close Popup&lt;/span&gt;</code></li>
                    </ul>
                </div>
            </div>

        </div>
    </details>
<?php
