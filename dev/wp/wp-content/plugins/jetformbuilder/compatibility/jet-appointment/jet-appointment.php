<?php


namespace JFB_Compatibility\Jet_Appointment;

use JFB_Components\Compatibility\Base_Compat_Dir_Trait;
use JFB_Components\Compatibility\Base_Compat_Handle_Trait;
use JFB_Components\Compatibility\Base_Compat_Url_Trait;
use JFB_Components\Module\Base_Module_Dir_It;
use JFB_Components\Module\Base_Module_It;
use JFB_Components\Module\Base_Module_Handle_It;
use JFB_Components\Module\Base_Module_Url_It;
use Jet_Form_Builder\Blocks\Module;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Appointment implements
	Base_Module_It,
	Base_Module_Handle_It,
	Base_Module_Url_It,
	Base_Module_Dir_It {

	use Base_Compat_Handle_Trait;
	use Base_Compat_Url_Trait;
	use Base_Compat_Dir_Trait;

	public function rep_item_id() {
		return 'jet-appointment';
	}

	public function condition(): bool {
		return function_exists( 'jet_apb' );
	}

	public function init_hooks() {
		add_action(
			'wp_enqueue_scripts',
			array( $this, 'register_scripts' )
		);

		add_filter(
			'render_block_jet-forms/appointment-date',
			array( $this, 'add_compatibility_script' ),
			10,
			3
		);
	}

	public function remove_hooks() {
		remove_action(
			'wp_enqueue_scripts',
			array( $this, 'register_scripts' )
		);

		remove_filter(
			'render_block_jet-forms/appointment-date',
			array( $this, 'add_compatibility_script' )
		);
	}

	public function register_scripts() {
		$script_asset = require_once $this->get_dir( 'assets/build/frontend.asset.php' );

		if ( true === $script_asset ) {
			return;
		}

		array_push(
			$script_asset['dependencies'],
			Module::MAIN_SCRIPT_HANDLE,
			Module::LISTING_OPTIONS_HANDLE
		);

		wp_register_script(
			$this->get_handle(),
			$this->get_url( 'assets/build/frontend.js' ),
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);
	}

	// phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
	public function add_compatibility_script( string $markup, array $parsed, $block ): string {
		wp_enqueue_script( $this->get_handle() );

		return $markup;
	}

}
