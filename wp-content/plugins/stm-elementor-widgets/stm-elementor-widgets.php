<?php
/**
 * Plugin Name: STM Elementor Widgets
 * Plugin URI: https://stylemixthemes.com/
 * Description: STM Elementor Widgets
 * Author: StylemixThemes
 * Author URI: https://stylemixthemes.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: stm-elementor-widgets
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'STM_ELEMENTOR_WIDGETS_PLUGIN_VERSION', '1.0.0' );
define( 'STM_ELEMENTOR_WIDGETS_DB_VERSION', '1.0' );
define( 'STM_ELEMENTOR_WIDGETS_ROOT_FILE', __FILE__ );
define( 'STM_ELEMENTOR_WIDGETS_PATH', dirname( __FILE__ ) );
define( 'STM_ELEMENTOR_WIDGETS_DIR_BASENAME', basename( __DIR__ ) );
define( 'STM_ELEMENTOR_WIDGETS_INC_PATH', dirname( __FILE__ ) . '/inc/' );
define( 'STM_ELEMENTOR_WIDGETS_URL', plugins_url( '', __FILE__ ) );

if ( ! is_textdomain_loaded( 'stm-elementor-widgets' ) ) {
	load_plugin_textdomain( 'stm-elementor-widgets', false, STM_ELEMENTOR_WIDGETS_DIR_BASENAME . '/languages/' );
}

if ( ! class_exists( \Elementor\Plugin::class ) ) {
	return;
}

spl_autoload_register(
	function ( $class_name ) {

		$class_path = str_replace( '\\', '/', $class_name );
		$class_path = str_replace( 'STM_E_W', 'inc', $class_path );

		if ( file_exists( STM_ELEMENTOR_WIDGETS_PATH . '/' . $class_path . '.php' ) ) {
			include STM_ELEMENTOR_WIDGETS_PATH . '/' . $class_path . '.php';
		}
	}
);

use STM_E_W\STMApp;
new STMApp();

register_activation_hook( STM_ELEMENTOR_WIDGETS_ROOT_FILE, array( 'STM_E_W\STMApp', 'stm_ew_plugin_activation' ) );
register_deactivation_hook( STM_ELEMENTOR_WIDGETS_ROOT_FILE, array( 'STM_E_W\STMApp', 'stm_ew_plugin_deactivation' ) );
register_uninstall_hook( STM_ELEMENTOR_WIDGETS_ROOT_FILE, array( 'STM_E_W\STMApp', 'stm_ew_plugin_uninstall' ) );
