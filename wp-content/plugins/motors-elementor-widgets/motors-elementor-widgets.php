<?php
/**
 * Plugin Name: Motors Elementor Widgets
 * Plugin URI: https://stylemixthemes.com/
 * Description: Motors Elementor Widgets
 * Author: StylemixThemes
 * Author URI: https://stylemixthemes.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: motors-elementor-widgets
 * Version: 1.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION', '1.2.6' );
define( 'MOTORS_ELEMENTOR_WIDGETS_DB_VERSION', '1.0.0' );
define( 'MOTORS_ELEMENTOR_WIDGETS_ROOT_FILE', __FILE__ );
define( 'MOTORS_ELEMENTOR_WIDGETS_PATH', dirname( __FILE__ ) );
define( 'MOTORS_ELEMENTOR_WIDGETS_DIR_BASENAME', basename( __DIR__ ) );
define( 'MOTORS_ELEMENTOR_WIDGETS_INC_PATH', dirname( __FILE__ ) . '/inc/' );
define( 'MOTORS_ELEMENTOR_WIDGETS_URL', plugins_url( '', __FILE__ ) );

if ( ! is_textdomain_loaded( 'motors-elementor-widgets' ) ) {
	load_plugin_textdomain( 'motors-elementor-widgets', false, MOTORS_ELEMENTOR_WIDGETS_DIR_BASENAME . '/languages/' );
}

if ( ! class_exists( \Elementor\Plugin::class ) || ! in_array( 'stm_vehicles_listing/stm_vehicles_listing.php', (array) get_option( 'active_plugins', array() ), true ) ) {
	return;
}

spl_autoload_register(
	function ( $class_name ) {

		$class_path = str_replace( '\\', '/', $class_name );

		if ( 'STM_E_W' === substr( $class_name, 0, 7 ) ) {
			$class_path = str_replace( 'STM_E_W', 'inc', $class_path );
		} else {
			$class_path = str_replace( 'Motors_E_W', 'inc', $class_path );
		}

		if ( file_exists( MOTORS_ELEMENTOR_WIDGETS_PATH . '/' . $class_path . '.php' ) ) {
			include MOTORS_ELEMENTOR_WIDGETS_PATH . '/' . $class_path . '.php';
		}
	}
);

use STM_E_W\STMApp;
use Motors_E_W\MotorsApp;

new STMApp();
new MotorsApp();


register_activation_hook( MOTORS_ELEMENTOR_WIDGETS_ROOT_FILE, array( 'Motors_E_W\MotorsApp', 'motors_ew_plugin_activation' ) );
register_deactivation_hook( MOTORS_ELEMENTOR_WIDGETS_ROOT_FILE, array( 'Motors_E_W\MotorsApp', 'motors_ew_plugin_deactivation' ) );
register_uninstall_hook( MOTORS_ELEMENTOR_WIDGETS_ROOT_FILE, array( 'Motors_E_W\MotorsApp', 'motors_ew_plugin_uninstall' ) );
