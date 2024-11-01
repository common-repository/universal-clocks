<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.presstigers.com
 * @since             1.0.0
 * @package           Universal_Clocks
 *
 * @wordpress-plugin
 * Plugin Name:       Universal Clocks
 * Plugin URI:        https://wordpress.org/plugins/universal-clocks
 * Description:       A plugin to show multiple clocks with different time zones
 * Version:           1.2.0
 * Author:            PressTigers
 * Author URI:        http://www.presstigers.com
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       universal-clocks
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC'))
{
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('universal_clocks_VERSION', '1.1.0');
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-universal-clocks.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_universal_clocks()
{

    $plugin = new Universal_Clocks();
    $plugin->run();

}
run_universal_clocks();
