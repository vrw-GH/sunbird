<?php

/*
Plugin Name: Koko Analytics
Plugin URI: https://www.kokoanalytics.com/#utm_source=wp-plugin&utm_medium=koko-analytics&utm_campaign=plugins-page
Version: 1.3.14
Description: Privacy-friendly analytics for your WordPress site.
Author: ibericode
Author URI: https://www.ibericode.com/
Author Email: support@kokoanalytics.com
Text Domain: koko-analytics
License: GPL-3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.txt

Koko Analytics - website analytics plugin for WordPress

Copyright (C) 2019 - 2024, Danny van Kooten, hi@dannyvankooten.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

phpcs:disable PSR1.Files.SideEffects
*/

namespace KokoAnalytics;

\define('KOKO_ANALYTICS_VERSION', '1.3.14');
\define('KOKO_ANALYTICS_PLUGIN_FILE', __FILE__);
\define('KOKO_ANALYTICS_PLUGIN_DIR', __DIR__);

// Load the Koko Analytics autoloader
require __DIR__ . '/autoload.php';

if (\defined('DOING_AJAX') && DOING_AJAX) {
    maybe_collect_request();
} elseif (is_admin()) {
    new Admin();
    new Dashboard_Widget();
} else {
    new Script_Loader();
    add_action('admin_bar_menu', 'KokoAnalytics\admin_bar_menu', 40, 1);
}

new Dashboard();
$aggregator = new Aggregator();
new Plugin($aggregator);
new Rest();
new Shortcode_Most_Viewed_Posts();
new ShortCode_Site_Counter();
new Pruner();

if (\class_exists('WP_CLI')) {
    \WP_CLI::add_command('koko-analytics', 'KokoAnalytics\Command');
}

add_action('widgets_init', 'KokoAnalytics\widgets_init');
add_action('koko_analytics_test_custom_endpoint', 'KokoAnalytics\test_custom_endpoint');
