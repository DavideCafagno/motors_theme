<?php
/**
 * Plugin Name: uListing - Compare
 * Plugin URI: https://ulisting.stylemixthemes.com/
 * Description: uListing Compare - Listing Compare Plugin.
 * Author: StylemixThemes
 * Author URI: https://stylemixthemes.com/
 * Text Domain: ulisting-compare
 * Version: 1.1.6
 * @fs_premium_only /includes/classes/, /assets/
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ULISTING_LISTING_COMPARE_FILE', __FILE__ );
define( 'ULISTING_LISTING_COMPARE_PATH', dirname( ULISTING_LISTING_COMPARE_FILE ) );
define( 'ULISTING_LISTING_COMPARE_URL', plugins_url( '', ULISTING_LISTING_COMPARE_FILE ) );

if ( ! function_exists( 'ulc_fs' ) && file_exists( ULISTING_LISTING_COMPARE_PATH . '/freemius/start.php' ) ) {
    function ulc_fs() {
        global $ulc_fs;

        if ( ! isset( $ulc_fs ) ) {
            require_once dirname(__FILE__) . '/freemius/start.php';

            $ulc_fs = fs_dynamic_init( array(
                'id'                  => '3487',
                'slug'                => 'ulisting-compare',
                'type'                => 'plugin',
                'public_key'          => 'pk_75cfe7f7569ae4cb4368c295a39a1',
                'is_premium'          => true,
                'is_premium_only'     => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'first-path'     => 'plugins.php',
                    'support'        => false,
                ),
            ) );
        }

        return $ulc_fs;
    }

    ulc_fs();
    do_action( 'ulc_fs_loaded' );
}

function ulc_fs_check() {
	if ( function_exists( 'ulc_fs' ) ) {
		return ( ulc_fs()->is__premium_only() && ulc_fs()->can_use_premium_code() );
	}

	return true;
}

if ( ulc_fs_check() ) {
    update_option('uListing_compare_loaded', 1);
	define( 'ULISTING_LISTING_COMPARE_VERSION', '1.1.6' );
}

require_once __DIR__ . '/includes/autoload.php';
register_activation_hook( __FILE__,  'uListing_listing_compare_plugin_activation');
register_deactivation_hook( __FILE__, 'uListing_listing_compare_plugin_deactivation');
register_uninstall_hook( __FILE__, 'uListing_listing-compare_plugin_uninstall');
