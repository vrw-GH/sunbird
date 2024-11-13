<?php

/**
 * Class Settings_Helper
 *
 * This class contains helper methods for retrieving menu item types, share services,
 * and translation options.
 *
 * @package    PopupBox
 * @subpackage Admin
 * @author     Dmytro Lobov <dev@wow-company.com>, Wow-Company
 * @copyright  2024 Dmytro Lobov
 * @license    GPL-2.0+
 */

namespace PopupBox;

defined( 'ABSPATH' ) || exit;

class Settings_Helper {


	public static function animation(): array {
		return [
			'fadeIn'        => 'fadeIn',
		];
	}

}
