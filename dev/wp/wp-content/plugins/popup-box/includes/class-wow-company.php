<?php
/**
 * Class Wow_Company
 *
 * The Wow_Company class represents a company in the WordPress admin menu that provides Wow Plugins.
 *
 * @package    WowPlugin
 * @subpackage General
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */


defined( 'ABSPATH' ) || exit;

final class Wow_Company {
	public function __construct() {

		add_action( 'admin_menu', [ $this, 'add_menu' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_style' ] );

	}

	public function add_menu(): void {
		$icon       = self::icon();
		$page_title = __( 'WordPress plugins from Wow-Company', 'popup-box' );
		$menu_title = __( 'Wow Plugins', 'popup-box' );
		$capability = 'manage_options';
		$slug       = 'wow-company';

		add_menu_page( $page_title, $menu_title, $capability, $slug, [ $this, 'welcome_page' ], $icon );
		add_submenu_page( $slug, $page_title, '👋 Hey', $capability, $slug );
	}

	public function welcome_page(): void {
		require_once plugin_dir_path( __FILE__ ) . 'page-welcome.php';
		wp_enqueue_style( 'admin-wpie-page', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', null, '1.0' );
	}

	public function admin_style(): void {
		wp_enqueue_style( 'wow-plugins', plugin_dir_url( __FILE__ ) . 'assets/css/admin.css', null, '1.0' );
	}


	private static function icon(): string {
		return 'data:image/svg+xml;base64, PHN2ZyB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPHRpdGxlPldvdy1Mb2dvIDIgQ29weTwvdGl0bGU+CiAgICA8ZGVmcz4KICAgICAgICA8bGluZWFyR3JhZGllbnQgeDE9IjUwJSIgeTE9IjAlIiB4Mj0iNDYuMTQwMDUxMSUiIHkyPSIxNDYuNTcwOTk5JSIgaWQ9ImxpbmVhckdyYWRpZW50LTEiPgogICAgICAgICAgICA8c3RvcCBzdG9wLWNvbG9yPSIjMUIwOTRGIiBvZmZzZXQ9IjAlIj48L3N0b3A+CiAgICAgICAgICAgIDxzdG9wIHN0b3AtY29sb3I9IiNFODZFMkMiIG9mZnNldD0iMTAwJSI+PC9zdG9wPgogICAgICAgIDwvbGluZWFyR3JhZGllbnQ+CiAgICAgICAgPGxpbmVhckdyYWRpZW50IHgxPSI2LjQ0NTUzMzYzJSIgeTE9Ijg0LjEzODE4ODElIiB4Mj0iMTAwJSIgeTI9IjE4LjIzNTM0MjIlIiBpZD0ibGluZWFyR3JhZGllbnQtMiI+CiAgICAgICAgICAgIDxzdG9wIHN0b3AtY29sb3I9IiMxQjA5NEYiIG9mZnNldD0iMCUiPjwvc3RvcD4KICAgICAgICAgICAgPHN0b3Agc3RvcC1jb2xvcj0iI0U4NkUyQyIgb2Zmc2V0PSIxMDAlIj48L3N0b3A+CiAgICAgICAgPC9saW5lYXJHcmFkaWVudD4KICAgIDwvZGVmcz4KICAgIDxnIGlkPSJXb3ctTG9nby0yLUNvcHkiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CiAgICAgICAgPHBhdGggZD0iTTI1Niw0ODEgQzM4MC4yNjQwNjksNDgxIDQ4MSwzODAuMjY0MDY5IDQ4MSwyNTYgQzQ4MSwxMzEuNzM1OTMxIDM4MC4yNjQwNjksMzEgMjU2LDMxIEMxMzEuNzM1OTMxLDMxIDMxLDEzMS43MzU5MzEgMzEsMjU2IEMzMSwzODAuMjY0MDY5IDEzMS43MzU5MzEsNDgxIDI1Niw0ODEgWiIgaWQ9Ik92YWwiIHN0cm9rZT0idXJsKCNsaW5lYXJHcmFkaWVudC0xKSIgc3Ryb2tlLXdpZHRoPSIyOCIgZmlsbD0iI0YwRjZGQyIgc3Ryb2tlLWRhc2hhcnJheT0iMTI3NS43NSw5OTk5OSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjU2LjAwMDAwMCwgMjU2LjAwMDAwMCkgcm90YXRlKC0xMzcuMDAwMDAwKSB0cmFuc2xhdGUoLTI1Ni4wMDAwMDAsIC0yNTYuMDAwMDAwKSAiPjwvcGF0aD4KICAgICAgICA8ZyBpZD0iR3JvdXAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDEwNS40NTUwODYsIDgzLjg0OTQ1MikiIHN0cm9rZT0idXJsKCNsaW5lYXJHcmFkaWVudC0yKSIgc3Ryb2tlLXdpZHRoPSIzOCI+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik0wLjQzMzAxMjcwMiwxMjguNTE0MTU3IEwxMDAuNDMzMDEzLDMwMS43MTkyMzggTTEwMC40MzMwMTMsMTI4LjUxNDE1NyBMMjAwLjQzMzAxMywzMDEuNzE5MjM4IE0zNzcuNTQ0OTE0LDAuMTUwNTQ3NTAzIEwyMDIuMjU1NzA3LDMwMS43ODA0ODkiIGlkPSJDb21iaW5lZC1TaGFwZSI+PC9wYXRoPgogICAgICAgIDwvZz4KICAgIDwvZz4KPC9zdmc+';



	}

}

new Wow_Company;