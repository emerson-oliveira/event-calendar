<?php

/**
 * Plugin Name:       Event Calendar Final
 * Description:       Simple plug-in to record events.
 * Version:           1.0.0
 * Requires at least: 5.4
 * Requires PHP:      7.2
 * Author:            Emerson Oliveira
 * Author URI:        https://github.com/emerson-oliveira
 * Text Domain:       pl-event-calendar
 * Domain Path:       /languages/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Make sure we don't expose any info if called directly
 */
if (!function_exists('add_action')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

/**
 * Load autoload
 */
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Constants
 */

define('TEXT_DOMAIN', "pl-event-calendar");
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PLUGIN_FILE', plugin_basename(__FILE__));
define('FILED_PREFIX', "plec-");

/**
 * Initialize all the core classes of the plugin
 */
if (class_exists('Includes\\Init')) {
	Includes\Init::register_services();
}

function activate()
{
	Includes\Init::register_services();
	Includes\Base\Settings::register_post_type();
	Includes\Base\Settings::register_taxonomies();
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'activate');


function deactivate()
{
	flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'deactivate');
