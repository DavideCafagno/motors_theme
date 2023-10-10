<?php

function stm_equipment_admin_scripts_styles () {
    //wp_enqueue_style( 'stm-theme-etm-style', STM_MOTORS_EQUIPMENT_URL . '/assets/css/admin-style.css' );
}

add_action( 'admin_enqueue_scripts', 'stm_equipment_admin_scripts_styles' );

function stm_equipment_ss() {
	//wp_enqueue_style( 'stm-car-rental-styles', STM_MOTORS_EQUIPMENT_URL . '/assets/css/style.css', null, STM_MOTORS_EQUIPMENT_SS_V, 'all' );

    //wp_enqueue_script('stm-car-rental-scripts', STM_MOTORS_EQUIPMENT_URL . '/assets/js/scripts.js', array('jquery'), STM_MOTORS_EQUIPMENT_SS_V, true);
}

if ( !is_admin() ) {
    add_action( 'wp_enqueue_scripts', 'stm_equipment_ss', 20 );
}

if ( !function_exists( 'stm_equipment_module_enqueue_scripts_styles' ) ) {
    function stm_equipment_module_enqueue_scripts_styles( $fileName )
    {
		if ( stm_me_get_wpcfto_mod( 'site_style', 'site_style_default' ) == 'site_style_default' ) {
			if ( file_exists( STM_MOTORS_EQUIPMENT_PATH . '/assets/css/vc_ss/' . $fileName . '.css' ) ) {
				wp_enqueue_style( $fileName, STM_MOTORS_EQUIPMENT_URL . '/assets/css/vc_ss/' . $fileName . '.css', null, STM_MOTORS_EQUIPMENT_SS_V, 'all' );
			}
		}

        if ( file_exists( STM_MOTORS_EQUIPMENT_PATH . '/assets/js/vc_ss/' . $fileName . '.js' ) ) {
            wp_enqueue_script( $fileName, STM_MOTORS_EQUIPMENT_URL . '/assets/js/vc_ss/' . $fileName . '.js', 'jquery', STM_MOTORS_EQUIPMENT_SS_V, true );
        }
    }
}