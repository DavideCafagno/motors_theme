<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function stm_listings_enqueue_scripts_styles() {
	wp_enqueue_style( 'owl.carousel', STM_LISTINGS_URL . '/assets/css/frontend/owl.carousel.css', array(), STM_LISTINGS_V, 'all' );
	wp_enqueue_style( 'listings-frontend', STM_LISTINGS_URL . '/assets/css/frontend/frontend_styles.css', array(), STM_LISTINGS_V, 'all' );
	wp_enqueue_style( 'listings-add-car', STM_LISTINGS_URL . '/assets/css/frontend/add_a_car.css', array(), STM_LISTINGS_V, 'all' );
	wp_enqueue_style( 'light-gallery', STM_LISTINGS_URL . '/assets/css/frontend/lightgallery.min.css', array(), STM_LISTINGS_V, 'all' );

	wp_enqueue_script( 'jquery-cookie', STM_LISTINGS_URL . '/assets/js/frontend/jquery.cookie.js', array( 'jquery' ), STM_LISTINGS_V, true );
	wp_enqueue_script( 'owl.carousel', STM_LISTINGS_URL . '/assets/js/frontend/owl.carousel.js', array( 'jquery' ), STM_LISTINGS_V, true );
	wp_enqueue_script( 'light-gallery', STM_LISTINGS_URL . '/assets/js/frontend/lightgallery-all.js', array( 'jquery' ), STM_LISTINGS_V, true );
	wp_enqueue_script( 'listings-add-car', STM_LISTINGS_URL . '/assets/js/frontend/add_a_car.js', array( 'jquery', 'jquery-ui-droppable' ), STM_LISTINGS_V, true );
	wp_enqueue_script( 'listings-init', STM_LISTINGS_URL . '/assets/js/frontend/init.js', array( 'jquery', 'jquery-ui-slider' ), STM_LISTINGS_V, true );
	wp_enqueue_script( 'listings-filter', STM_LISTINGS_URL . '/assets/js/frontend/filter.js', array( 'listings-init' ), STM_LISTINGS_V, true );
}

add_action( 'wp_enqueue_scripts', 'stm_listings_enqueue_scripts_styles' );
