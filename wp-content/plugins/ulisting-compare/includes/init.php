<?php

function ulisting_listing_compare_scripts_styles() {
	if(!defined("ULISTING_LISTING_COMPARE_VERSION"))
		return;
	$v = ULISTING_LISTING_COMPARE_VERSION;
	wp_enqueue_script('jquery');
	wp_enqueue_script('ulisting-listing-compare', ULISTING_LISTING_COMPARE_URL . '/assets/js/frontend/ulisting-listing-compare.js', [], $v);
	wp_add_inline_script("ulisting-listing-compare", ' var ulisting_compare_url ="'.site_url().'";', "before" );
}
add_action('wp_enqueue_scripts', 'ulisting_listing_compare_scripts_styles');
add_action('init', function (){
	if(defined("ULISTING_VERSION"))
		\uListing\ListingCompare\Classes\UlistingListingCompare::init();
});


