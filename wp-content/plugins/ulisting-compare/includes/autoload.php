<?php
if ( ! defined( 'ABSPATH' ) ) exit;

foreach (scandir(ULISTING_LISTING_COMPARE_PATH.'/includes/classes/') as $key => $value) {
	if ( strpos($value, '.php') )
		$files_listing_compare[] = 'includes/classes/'.$value;
}

$files_listing_compare[] = 'includes/init.php';
$files_listing_compare[] = 'includes/install.php';
$files_listing_compare[] = 'includes/route.php';

foreach ( $files_listing_compare as $file ) {
	if(file_exists(ULISTING_LISTING_COMPARE_PATH."/{$file}")){
		require_once ULISTING_LISTING_COMPARE_PATH."/{$file}";
	}
}

