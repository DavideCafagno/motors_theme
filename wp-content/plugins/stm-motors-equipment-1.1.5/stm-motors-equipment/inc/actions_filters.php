<?php
add_filter('stm_equip_single', 'stm_equip_single');

add_action('stm_equip_single_template', 'stm_equip_single_template');


if(!function_exists('stm_equip_single')) {
	function stm_equip_single () {
		return true;
	}
}

if(!function_exists('stm_equip_single_template')) {
	function stm_equip_single_template () {
		stm_equipment_load_template('parts/single-car/main');
	}
}