<?php
/*
 * Page Name: List
 */

use PopupBox\Admin\ListTable;
use PopupBox\WOWP_Plugin;

defined( 'ABSPATH' ) || exit;

$list_table = new ListTable();
$list_table->prepare_items();
$table_page = WOWP_Plugin::SLUG;

$wp_plugins = [
	[
		'free'    => 'https://wordpress.org/plugins/counter-box/',
		'title'   => 'Counter Box',
		'content' => 'Quickly and easily create countdowns, counters, and timers with a live preview.'
	],
	[
		'free'    => 'https://wordpress.org/plugins/buttons/advanced/',
		'title'   => 'Buttons',
		'content' => 'Easily create beautiful, customizable standard, floating, and social sharing buttons. Increase click-through rates and enhance your user experience.'
	],
	[
		'free'    => 'https://wordpress.org/plugins/calculator-builder/',
		'title'   => 'Calculator Builder',
		'content' => 'A simple way to create an online calculator.'
	],

	[
		'free'    => 'https://wordpress.org/plugins/floating-button/',
		'title'   => 'Floating Button',
		'content' => 'WordPress plugin designed to generate and manage sticky Floating Buttons, capable of performing any defined actions on your website. '
	],
];
?>

    <div class="wpie-notification -success">
        <strong>Works Great With:</strong>
        <?php foreach ($wp_plugins as $plugin) {
           echo '<a href="' .esc_url($plugin['free']).'" target="_blank" class="has-tooltip on-bottom" data-tooltip="' .esc_attr($plugin['content']).'">'.esc_html($plugin['title']).'</a> <span class="wpie-separator">|</span> ';
        }?>
    </div>

    <form method="post" class="wpie-list">
		<?php
		$list_table->search_box( esc_attr__( 'Search', 'popup-box' ), WOWP_Plugin::PREFIX );
		$list_table->display();
		?>
        <input type="hidden" name="page" value="<?php echo esc_attr( $table_page ); ?>"/>
		<?php wp_nonce_field( WOWP_Plugin::PREFIX . '_nonce', WOWP_Plugin::PREFIX . '_list_action' ); ?>
    </form>
<?php
