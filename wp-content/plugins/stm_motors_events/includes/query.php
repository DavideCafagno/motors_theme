<?php
function getAllEvents() {
	$args = array(
		'post_type' => 'stm_events',
		'post_per_page' => -1,
		'post_status'	=> 'publish'
	);

	return new WP_Query( $args );
}

function getEvents($args) {
	$query_params = array(
		'post_type' => 'stm_events',
		'post_per_page' => -1,
		'post_status'	=> 'publish'
	);

	if($args != null) array_merge($query_params, $args);

	return new WP_Query( $query_params );
}