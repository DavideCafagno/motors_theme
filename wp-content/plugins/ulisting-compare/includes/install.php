<?php

function uListing_listing_compare_plugin_activation() {
	add_option("ulisting_listing_compare_active", 1);
}

function uListing_listing_compare_plugin_deactivation (){
	delete_option("ulisting_listing_compare_active");
	delete_option("uListing_compare_loaded");
}

function uListing_listing_compare_plugin_uninstall(){
	delete_option("ulisting_subscription_active");
	delete_option("uListing_compare_loaded");
}
