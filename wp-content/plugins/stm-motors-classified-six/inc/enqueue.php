<?php
function stm_c_six_admin_scripts_styles () {
	wp_enqueue_style( 'stm-all-icon', STM_MOTORS_C_SIX_URL . '/assets/css/stm-all-icon.css' );
	wp_enqueue_style( 'stm-c-six-admin', STM_MOTORS_C_SIX_URL . '/assets/css/admin.css' );

	wp_enqueue_script('stm-c-six-admin', STM_MOTORS_C_SIX_URL . '/assets/js/admin.js', array('jquery'), null, true);
}

add_action( 'admin_enqueue_scripts', 'stm_c_six_admin_scripts_styles' );

function stm_c_six_ss() {
	$vars = array(
		'stm_ajax_get_c_six_user_phone' => wp_create_nonce( 'stm_ajax_get_c_six_user_phone' ),
	);

	wp_localize_script( 'jquery', 'classified_six_vars', $vars );

	wp_enqueue_style( 'stm-all-icon', STM_MOTORS_C_SIX_URL . '/assets/css/stm-all-icon.css' );
	wp_enqueue_style( 'stm-linear-icon', STM_MOTORS_C_SIX_URL . '/assets/css/linear-icons.css' );
	//wp_enqueue_style( 'stm-car-rental-styles', STM_MOTORS_C_SIX_URL . '/assets/css/style.css', null, STM_MOTORS_C_SIX_SS_V, 'all' );

	wp_enqueue_script('jquery-withinviewport', STM_MOTORS_C_SIX_URL . '/assets/js/jquery.withinviewport.min.js', array('jquery'), STM_MOTORS_C_SIX_SS_V, true);
	wp_enqueue_script('withinviewport', STM_MOTORS_C_SIX_URL . '/assets/js/withinviewport.min.js', array('jquery'), STM_MOTORS_C_SIX_SS_V, true);
	wp_enqueue_script('stm-c-six-scripts', STM_MOTORS_C_SIX_URL . '/assets/js/classified-six-scripts.js', array('jquery'), STM_MOTORS_C_SIX_SS_V, true);

}

if ( !is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'stm_c_six_ss', 20 );
}

if ( !function_exists( 'stm_c_six_module_enqueue_scripts_styles' ) ) {
	function stm_c_six_module_enqueue_scripts_styles( $fileName )
	{
		if ( stm_me_get_wpcfto_mod( 'site_style', 'site_style_default' ) == 'site_style_default' ) {
			if ( file_exists( STM_MOTORS_C_SIX_PATH . '/assets/css/vc_ss/' . $fileName . '.css' ) ) {
				wp_enqueue_style( $fileName, STM_MOTORS_C_SIX_URL . '/assets/css/vc_ss/' . $fileName . '.css', null, STM_MOTORS_C_SIX_SS_V, 'all' );
			}
		}

		if ( file_exists( STM_MOTORS_C_SIX_PATH . '/assets/js/vc_ss/' . $fileName . '.js' ) ) {
			wp_enqueue_script( $fileName, STM_MOTORS_C_SIX_URL . '/assets/js/vc_ss/' . $fileName . '.js', 'jquery', STM_MOTORS_C_SIX_SS_V, true );
		}
	}
}