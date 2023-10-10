<?php
/**
 * Plugin Name: Motors - Rent A Car
 * Plugin URI: https://stylemixthemes.com/
 * Description: Rent A Car
 * Author: StylemixThemes
 * Author URI: https://stylemixthemes.com/
 * License: GNU General Public License v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: stm_motors_car_rental
 * Version: 1.6.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'STM_MOTORS_CAR_RENTAL_PATH', dirname( __FILE__ ) );
define( 'STM_MOTORS_CAR_RENTAL_INC_PATH', dirname( __FILE__ ) . '/inc/' );
define( 'STM_MOTORS_CAR_RENTAL_URL', plugins_url( '', __FILE__ ) );
define( 'STM_MOTORS_CAR_RENTAL', 'stm_motors_car_rental' );
define( 'STM_MOTORS_CAR_RENTAL_SS_V', '1.1' );

define( 'STM_MOTORS_CAR_RENTAL_IMAGES', STM_MOTORS_CAR_RENTAL_URL . '/inc/admin/butterbean/images/' );

require_once STM_MOTORS_CAR_RENTAL_INC_PATH . 'enqueue.php';
require_once STM_MOTORS_CAR_RENTAL_INC_PATH . 'helpers.php';
require_once STM_MOTORS_CAR_RENTAL_INC_PATH . 'woocommerce_customize.php';
require_once STM_MOTORS_CAR_RENTAL_INC_PATH . 'templates.php';
require_once STM_MOTORS_CAR_RENTAL_INC_PATH . 'actions_filters.php';
require_once STM_MOTORS_CAR_RENTAL_INC_PATH . 'visual_composer.php';

if ( is_admin() ) {
	require_once STM_MOTORS_CAR_RENTAL_INC_PATH . 'admin/enqueue.php';
	require_once STM_MOTORS_CAR_RENTAL_INC_PATH . 'admin/butterbean_metaboxes.php';
}

if ( ! is_textdomain_loaded( 'stm_motors_car_rental' ) ) {
	load_plugin_textdomain( 'stm_motors_car_rental', false, 'stm-motors-car-rental/languages' );
}
