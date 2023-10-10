<?php
/**
Plugin Name: uListing - Wishlist
Plugin URI: https://stylemixthemes.com
Description: uListing Wishlist WordPress Plugin.
Version: 1.1.3
Author: Stylemix Themes
Author URI: https://stylemixthemes.com
*/
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ULISTING_WISHLIST_FILE', __FILE__ );
define( 'ULISTING_WISHLIST_PATH', dirname( ULISTING_WISHLIST_FILE ) );
define( 'ULISTING_WISHLIST_URL', plugins_url( '', ULISTING_WISHLIST_FILE ) );

if ( ! function_exists( 'uw_fs' ) && file_exists( ULISTING_WISHLIST_PATH . '/freemius/start.php' ) ) {
    function uw_fs() {
        global $uw_fs;

        if ( ! isset( $uw_fs ) ) {
            require_once dirname(__FILE__) . '/freemius/start.php';

            $uw_fs = fs_dynamic_init( array(
                'id'                  => '3702',
                'slug'                => 'ulisting-wishlist',
                'type'                => 'plugin',
                'public_key'          => 'pk_b50b67ad604f0618a08938c9a9cd6',
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

        return $uw_fs;
    }

    uw_fs();
    do_action( 'uw_fs_loaded' );
}

function uw_fs_check() {
	if ( function_exists( 'uw_fs' ) ) {
		return ( uw_fs()->is__premium_only() && uw_fs()->can_use_premium_code() );
	}

	return true;
}

if ( uw_fs_check() ) {
    update_option('uListing_wishlist_loaded', 1);
	define( 'ULISTING_WISHLIST_VERSION', '1.1.3' );
}

require_once __DIR__ . '/includes/autoload.php';
register_activation_hook( __FILE__,  'uListing_wishlist_plugin_activation');
register_deactivation_hook( __FILE__, 'uListing_wishlist_plugin_deactivation');
register_uninstall_hook( __FILE__, 'uListing_wishlist_plugin_uninstall');