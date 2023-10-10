<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

stm_car_rental_module_enqueue_scripts_styles('stm_rental_two_car_form');

$workHr = '';
if ( !empty( $office_working_hours ) ) {
	$workHr = explode( '-', $office_working_hours );
}

stm_car_rental_load_template('parts/booking-form', array('title' => $title, 'workHr' => $workHr, 'css' => $css));