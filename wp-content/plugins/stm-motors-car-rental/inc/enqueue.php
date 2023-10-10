<?php

function stm_car_rental_admin_scripts_styles () {
    wp_enqueue_style( 'stm-theme-etm-style', STM_MOTORS_CAR_RENTAL_URL . '/assets/css/admin-style.css' );
}

add_action( 'admin_enqueue_scripts', 'stm_car_rental_admin_scripts_styles' );

function stm_car_rental_ss() {
	wp_dequeue_style('stm-datetimepicker');
	wp_deregister_style('stm-datetimepicker');

	wp_dequeue_script('stm-datetimepicker-js');
	wp_deregister_script('stm-datetimepicker-js');

    wp_enqueue_style( 'owl-carousel', STM_MOTORS_CAR_RENTAL_URL . '/assets/css/owl.carousel.min.css', null, STM_MOTORS_CAR_RENTAL_SS_V, 'all' );
    wp_enqueue_style( 'light-gallery', STM_MOTORS_CAR_RENTAL_URL . '/assets/css/lightgallery.min.css', null, STM_MOTORS_CAR_RENTAL_SS_V, 'all' );
	wp_enqueue_style( 'daterangepicker', STM_MOTORS_CAR_RENTAL_URL . '/assets/css/daterangepicker.css', null, STM_MOTORS_CAR_RENTAL_SS_V, 'all' );
	wp_enqueue_style( 'stm-daterangepicker', STM_MOTORS_CAR_RENTAL_URL . '/assets/css/stm-custom-daterangepicker-style.css', null, STM_MOTORS_CAR_RENTAL_SS_V, 'all' );
	wp_enqueue_style( 'stm-car-rental-icons', STM_MOTORS_CAR_RENTAL_URL . '/assets/css/style.css', null, STM_MOTORS_CAR_RENTAL_SS_V, 'all' );


    wp_enqueue_script('jquery_cookie', STM_MOTORS_CAR_RENTAL_URL . '/assets/js/jquery.cookie.js', array('jquery'), STM_MOTORS_CAR_RENTAL_SS_V, true);

    wp_localize_script('jquery_cookie', 'datepickervars',
		array(
			'apply' => __('Apply', 'stm_motors_car_rental' ),
			'cancel' => __('Cancel', 'stm_motors_car_rental')
		));

    wp_enqueue_script('owl-carousel-rc-js', STM_MOTORS_CAR_RENTAL_URL . '/assets/js/owl.carousel.min.js', array('jquery'), STM_MOTORS_CAR_RENTAL_SS_V, true);
    wp_enqueue_script('light-gallery', STM_MOTORS_CAR_RENTAL_URL . '/assets/js/lightgallery.min.js', array('jquery'), STM_MOTORS_CAR_RENTAL_SS_V, true);
    wp_enqueue_script('daterangepicker', STM_MOTORS_CAR_RENTAL_URL . '/assets/js/daterangepicker.js', array('jquery'), STM_MOTORS_CAR_RENTAL_SS_V, true);
    wp_enqueue_script('stm-car-rental-scripts', STM_MOTORS_CAR_RENTAL_URL . '/assets/js/scripts.js', array('jquery'), STM_MOTORS_CAR_RENTAL_SS_V, true);
}

if ( !is_admin() ) {
    add_action( 'wp_enqueue_scripts', 'stm_car_rental_ss', 20 );
}

if ( !function_exists( 'stm_car_rental_module_enqueue_scripts_styles' ) ) {
    function stm_car_rental_module_enqueue_scripts_styles( $fileName )
    {
		if ( stm_me_get_wpcfto_mod( 'site_style', 'site_style_default' ) == 'site_style_default' ) {
			if ( file_exists( STM_MOTORS_CAR_RENTAL_PATH . '/assets/css/vc_ss/' . $fileName . '.css' ) ) {
				wp_enqueue_style( $fileName, STM_MOTORS_CAR_RENTAL_URL . '/assets/css/vc_ss/' . $fileName . '.css', null, STM_MOTORS_CAR_RENTAL_SS_V, 'all' );
			}
		}

        if ( file_exists( STM_MOTORS_CAR_RENTAL_PATH . '/assets/js/vc_ss/' . $fileName . '.js' ) ) {
            wp_enqueue_script( $fileName, STM_MOTORS_CAR_RENTAL_URL . '/assets/js/vc_ss/' . $fileName . '.js', 'jquery', STM_MOTORS_CAR_RENTAL_SS_V, true );
        }
    }
}