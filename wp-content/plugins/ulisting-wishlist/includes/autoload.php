<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once ABSPATH . 'wp-admin/includes/plugin.php';

foreach (scandir(ULISTING_WISHLIST_PATH.'/includes/classes/') as $key => $value) {
	if ( strpos($value, '.php') )
		$ulisting_files_wishlist[] = 'includes/classes/'.$value;
}

$ulisting_files_wishlist[] = 'includes/init.php';
$ulisting_files_wishlist[] = 'includes/install.php';

foreach ( $ulisting_files_wishlist as $file ) {
	if(file_exists(ULISTING_WISHLIST_PATH."/{$file}")){
		require_once ULISTING_WISHLIST_PATH."/{$file}";
	}
}

