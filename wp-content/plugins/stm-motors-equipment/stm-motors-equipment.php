<?php
/*
Plugin Name: Motors - Equipment
Plugin URI: https://stylemixthemes.com/
Description: Equipment layout
Author: StylemixThemes
Author URI: https://stylemixthemes.com/
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: stm_motors_equipment
Version: 1.1.5
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'STM_MOTORS_EQUIPMENT_PATH', dirname( __FILE__ ) );
define( 'STM_MOTORS_EQUIPMENT_INC_PATH', dirname( __FILE__ ) . '/inc/' );
define( 'STM_MOTORS_EQUIPMENT_URL', plugins_url( '', __FILE__ ) );
define( 'STM_MOTORS_EQUIPMENT', 'stm_motors_equipment' );
define( 'STM_MOTORS_EQUIPMENT_SS_V', '1.1.1' );
define( 'STM_MOTORS_EQUIPMENT_IMAGES', STM_MOTORS_EQUIPMENT_URL . '/inc/admin/butterbean/images/' );

if ( ! is_textdomain_loaded( 'stm_motors_equipment' ) ) {
	load_plugin_textdomain( 'stm_motors_equipment', false, 'stm-motors-equipment/languages' );
}

require_once STM_MOTORS_EQUIPMENT_INC_PATH . 'actions_filters.php';
require_once STM_MOTORS_EQUIPMENT_INC_PATH . 'enqueue.php';
require_once STM_MOTORS_EQUIPMENT_INC_PATH . 'helpers.php';
require_once STM_MOTORS_EQUIPMENT_INC_PATH . 'templates.php';
require_once STM_MOTORS_EQUIPMENT_INC_PATH . 'visual_composer.php';
