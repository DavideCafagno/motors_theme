<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function stm_motors_car_rental_admin_enqueue($hook)
{
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');

    wp_enqueue_style('stm-listings-datetimepicker', STM_MOTORS_CAR_RENTAL_URL . '/assets/css/jquery.stmdatetimepicker.css', null, null, 'all');
    wp_enqueue_script('stm-listings-datetimepicker', STM_MOTORS_CAR_RENTAL_URL . '/assets/js/jquery.stmdatetimepicker.js', array('jquery'), null, true);

	wp_enqueue_script('jquery-ui-datepicker');

    wp_enqueue_style('stm-listings-timepicker', STM_MOTORS_CAR_RENTAL_URL . '/inc/admin/butterbean/css/jquery.timepicker.css', null, null, 'all');
    wp_enqueue_script('stm-listings-timepicker', STM_MOTORS_CAR_RENTAL_URL . '/inc/admin/butterbean/js/jquery.timepicker.js', array('jquery'), null, true);

    wp_enqueue_script('stm-theme-multiselect', STM_MOTORS_CAR_RENTAL_URL . '/assets/js/jquery.multi-select.js', array('jquery'));

    wp_enqueue_media();
}

add_action('admin_enqueue_scripts', 'stm_motors_car_rental_admin_enqueue');