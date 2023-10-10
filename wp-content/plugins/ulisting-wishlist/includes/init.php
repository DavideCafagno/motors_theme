<?php

function ulisting_wishlist_scripts_styles() {
	if(!defined("ULISTING_WISHLIST_VERSION"))
		return;
	$v = ULISTING_WISHLIST_VERSION;
	wp_enqueue_script('ulisting-wishlist', ULISTING_WISHLIST_URL . '/assets/js/frontend/ulisting-wishlist.js', [], $v, true);
	wp_add_inline_script("ulisting-wishlist", ' var ulisting_wishlist_url ="'.site_url().'";', "before" );
}

add_action('wp_enqueue_scripts', 'ulisting_wishlist_scripts_styles');

add_action('init', function (){
	if ( defined("ULISTING_VERSION") ) {
		\uListing\UlistingWishlist\Classes\UlistingWishlist::init();
	}
}, -1);


