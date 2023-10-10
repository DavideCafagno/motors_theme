<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require_once STM_MOTORS_CAR_RENTAL_PATH . '/inc/admin/butterbean_helpers.php';

require_once 'tabs/offices.php';
require_once 'tabs/cars.php';

add_action('butterbean_car_rental_register', 'stm_car_rental_register_manager_order', 10, 2);

function stm_car_rental_register_manager_order($butterbean, $post_type) {

	if($post_type == 'stm_office') {
		$butterbean->register_manager(
			'stm_office_details',
			array(
				'label' => esc_html__('STM View settings', 'motors_car_rental'),
				'post_type' => $post_type,
				'context' => 'normal',
				'priority' => 'high'
			)
		);

		$manager = $butterbean->get_manager('stm_office_details');
		register_car_rental_metabox($manager, 'stm_motors_review');
	}

	if($post_type == 'product') {
        $butterbean->register_manager(
            'stm_car_rent_info',
            array(
                'label' => esc_html__('Car rent Info', 'motors_car_rental'),
                'post_type' => $post_type,
                'context' => 'normal',
                'priority' => 'high'
            )
        );

        $manager = $butterbean->get_manager('stm_car_rent_info');
        register_car_rental_info_metabox($manager, 'stm_motors_review');
    }
}