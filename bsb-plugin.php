<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://devinvinson.com
 * @since             1.0.4
 * @package           Bsb_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Browser Scroll Bar
 * Plugin URI:        https://wordpress.org/plugins/browser-scroll-bar/
 * Description:       This is make you browser scrollbar customize. 
 * Version:           1.0.4
 * Author:            Apsara Aruna
 * Author URI:        https://profile.wordpress.org/apsaraaruna
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bsb-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bsb-plugin-activator.php
 */
function activate_bsb_plugin() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-bsb-plugin-activator.php';
	Bsb_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bsb-plugin-deactivator.php
 */
function deactivate_bsb_plugin() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-bsb-plugin-deactivator.php';
	Bsb_Plugin_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_bsb_plugin');
register_deactivation_hook(__FILE__, 'deactivate_bsb_plugin');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-bsb-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bsb_plugin() {

	$plugin = new Bsb_Plugin();
	$plugin->run();
}
run_bsb_plugin();
