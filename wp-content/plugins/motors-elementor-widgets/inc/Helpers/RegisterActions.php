<?php

namespace Motors_E_W\Helpers;

class RegisterActions {
	public static function init() {
		add_action( 'init', array( self::class, 'motors_remove_post_type_supports' ) );
		add_action( 'wp_loaded', array( self::class, 'motors_create_nonce' ) );
		add_action( 'elementor/editor/after_save', array( self::class, 'motors_elementor_after_save' ), 100, 2 );

		add_filter( 'me_car_settings_conf', array( self::class, 'motors_remove_car_settings_conf' ) );
		add_filter( 'motors_merge_wpcfto_config', array( self::class, 'motors_remove_inventory_settings_conf' ) );
		add_filter(
			'stm_is_elementor_demo',
			function () {
				return true;
			}
		);

		add_filter( 'stm_ew_modify_post_type_objects', array( self::class, 'motors_modify_post_type_objects' ) );

		add_filter( 'stm_ew_kses_svg', array( self::class, 'stm_ew_kses_svg' ) );
	}

	public static function motors_create_nonce() {
		$tm_nonce        = wp_create_nonce( 'motors_create_template' );
		$tm_delete_nonce = wp_create_nonce( 'motors_delete_template' );

		wp_localize_script(
			'jquery',
			'mew_nonces',
			array(
				'ajaxurl'         => admin_url( 'admin-ajax.php' ),
				'tm_nonce'        => $tm_nonce,
				'tm_delete_nonce' => $tm_delete_nonce,
			)
		);
	}

	public static function motors_remove_post_type_supports() {
	}

	public static function motors_remove_car_settings_conf( $settings ) {
		return array();
	}

	public static function motors_remove_inventory_settings_conf( $settings ) {

		unset( $settings['listing_sidebar'] );
		unset( $settings['listing_filter_position'] );

		return $settings;
	}

	public static function array_value_recursive( $post_id, $key, array $arr ) {
		array_walk_recursive(
			$arr,
			function ( $v, $k ) use ( $post_id, $key, &$val ) {
				$keys_for_save = array(
					'ppp_on_list',
					'ppp_on_grid',
					'quant_grid_items',
					'show_test_drive',
				);

				if ( in_array( $k, $keys_for_save, true ) ) {
					update_post_meta( $post_id, $k, $v );
				}
			}
		);
	}

	public static function motors_elementor_after_save( $post_id, $editor_data ) {
		self::array_value_recursive( $post_id, 'ppp_on_grid', $editor_data );
	}

	public static function motors_modify_post_type_objects( $post_types_objects ) {

		unset( $post_types_objects['listings'] );

		return $post_types_objects;
	}

	public static function stm_ew_kses_svg() {
		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true,
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);

		return array_merge( $kses_defaults, $svg );
	}
}
