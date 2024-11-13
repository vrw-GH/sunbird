<?php
/*
 * Page Name: Add New
 */

use PopupBox\Admin\CreateFields;
use PopupBox\Admin\Settings;
use PopupBox\WOWP_Plugin;

defined( 'ABSPATH' ) || exit;

$options = Settings::get_options();

$title = $options['title'] ?? '';
$id    = $options['id'] ?? '';

if ( ! isset( $options['live_preview'] ) ) {
	$builder_open = ' open';
} elseif ( ! empty( $options['live_preview'] ) ) {
	$builder_open = ' open';
} else {
	$builder_open = '';
}
?>
    <form action="" id="wpie-settings" class="wpie-settings__wrapper" method="post">

        <div class="wpie-settings__main">

            <div class="wpie-field title">
                <label class="wpie-field__label">
                <span class="screen-reader-text">
                    <?php esc_html_e( 'Enter title here', 'popup-box' ); ?></span>
                    <input type="text" name="title" size="30" value="<?php echo esc_attr( $title ); ?>" id="title"
                           placeholder="<?php esc_attr_e( 'Add title', 'popup-box' ); ?>">
                </label>
                <button class="button wpie-preview-button"><?php esc_html_e( 'Popup Preview', 'popup-box' ); ?></button>
            </div>

			<?php Settings::init(); ?>

        </div>

        <div class="wpie-settings__sidebar">
			<?php require_once WOWP_Plugin::dir() . 'admin/settings/sidebar.php'; ?>
        </div>

        <input type="hidden" name="tool_id" value="<?php echo absint( $id ); ?>" id="tool_id"/>
        <input type="hidden" name="item_time" value="<?php echo esc_attr( time() ); ?>"/>
		<?php wp_nonce_field( WOWP_Plugin::PREFIX . '_nonce', WOWP_Plugin::PREFIX . '_settings' ); ?>
    </form>

    <div class="ds-popup" id="ds-popup-preview">
        <div class="ds-popup-wrapper">
            <div class="ds-popup-content">
            </div>
        </div>
    </div>

<?php
