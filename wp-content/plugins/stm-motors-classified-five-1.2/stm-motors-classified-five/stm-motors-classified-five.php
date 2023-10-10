<?php
/**
* Plugin Name: STM Motors - Classified Five
* Plugin URI: http://stylemixthemes.com/
* Description: Classified Five layout
* Author: StylemixThemes
* Author URI: http://stylemixthemes.com/
* License: GNU General Public License v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: stm_motors_classified_five
* Version: 1.2
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'STM_MOTORS_CLASSIFIED_FIVE', 'STM_MOTORS_CLASSIFIED_FIVE' );
define( 'STM_MOTORS_C_F_PATH', dirname( __FILE__ ) );
define( 'STM_MOTORS_C_F_INC_PATH', dirname( __FILE__ ) . '/inc/');
define( 'STM_MOTORS_C_F_URL', plugins_url( '', __FILE__ ) );
define( 'STM_MOTORS_C_F', 'stm_motors_classified_five' );
define( 'STM_MOTORS_C_F_SS_V', '1.0' );

if ( ! is_textdomain_loaded( 'stm_motors_classified_five' ) ) {
	load_plugin_textdomain( 'stm_motors_classified_five', false, 'stm-motors-classified-five/languages' );
}

require_once STM_MOTORS_C_F_INC_PATH . 'setup.php';
require_once STM_MOTORS_C_F_INC_PATH . 'actions_filters.php';
require_once STM_MOTORS_C_F_INC_PATH . 'enqueue.php';
require_once STM_MOTORS_C_F_INC_PATH . 'helpers.php';
require_once STM_MOTORS_C_F_INC_PATH . 'templates.php';
require_once STM_MOTORS_C_F_INC_PATH . 'visual_composer.php';

if ( is_admin() ) {
	require_once STM_MOTORS_C_F_INC_PATH . 'category-image.php';
	//require_once STM_MOTORS_C_F_INC_PATH . 'admin/enqueue.php';
}