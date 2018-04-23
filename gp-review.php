<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://getphound.com
 * @since             1.0.0
 * @package           GetPhound Review Funnel
 *
 * @wordpress-plugin
 * Plugin Name:       GetPhound Review Funnel
 * Plugin URI:        https://getphound.com
 * Description:       Plugin used to setup a review funnel on websites.
 * Version:           1.0.0
 * Author:            GetPhound
 * Author URI:        https://getphound.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gp-review-funnel
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gp-review-activator.php
 */
function activate_gp_review() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gp-review-activator.php';
	gp_review_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gp-review-deactivator.php
 */
function deactivate_gp_review() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gp-review-deactivator.php';
	gp_review_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gp_review' );
register_deactivation_hook( __FILE__, 'deactivate_gp_review' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gp-review.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gp_review() {

	$plugin = new gp_review();
	$plugin->run();

}
run_gp_review();
