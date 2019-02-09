<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://akmal.web.id
 * @since             1.0.0
 * @package           Lazyimages
 *
 * @wordpress-plugin
 * Plugin Name:       LazyImages
 * Plugin URI:        https://github.com/magchuz/LazyImages
 * Description:       Plugin Wordpress untuk LazyLoad Gambar. Menggunakan Script dari Igniel
 * Version:           1.1.0
 * Author:            magchuz
 * Author URI:        https://akmal.web.id
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lazyimages
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lazyimages-activator.php
 */
function activate_lazyimages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lazyimages-activator.php';
	Lazyimages_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lazyimages-deactivator.php
 */
function deactivate_lazyimages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lazyimages-deactivator.php';
	Lazyimages_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lazyimages' );
register_deactivation_hook( __FILE__, 'deactivate_lazyimages' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lazyimages.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lazyimages() {

	$plugin = new Lazyimages();
	$plugin->run();

}
run_lazyimages();
