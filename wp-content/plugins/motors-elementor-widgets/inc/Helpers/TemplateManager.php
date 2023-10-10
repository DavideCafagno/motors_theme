<?php

namespace Motors_E_W\Helpers;

use Elementor\Plugin;

class TemplateManager {

	private static $post_type    = 'listing_template';
	private static $plural       = 'Listing Templates';
	private static $single       = 'Listing Template';
	private static $setting_name = 'single_listing_template';
	private static $data_for_select;

	public static $selected_template_id;

	public static function init() {

		self::motors_get_templates_list();

		add_action( 'init', array( self::class, 'motors_register_post_type' ) );

		add_action( 'wp_ajax_motors_wpcfto_create_template', array( self::class, 'motors_create_template' ) );
		add_action( 'wp_ajax_motors_wpcfto_delete_template', array( self::class, 'motors_delete_template' ) );

		add_filter( 'single_template', array( self::class, 'motors_override_single_template' ) );
		add_filter( 'me_car_settings_conf', array( self::class, 'motors_car_settings_conf' ) );
		add_filter( 'wpcfto_field_mew-repeater-radio', array( self::class, 'motors_register_wpcfto_repeater_radio' ) );
	}

	public static function motors_register_post_type() {

		self::$selected_template_id = stm_me_get_wpcfto_mod( self::$setting_name, null );

		if ( null === self::$selected_template_id ) {
			self::$selected_template_id = array_key_first( self::$data_for_select );
		}

		// @codingStandardsIgnoreStart
		$labels = array(
			'name'               => __( self::$plural, 'motors-elementor-widgets' ),
			'singular_name'      => __( self::$single, 'motors-elementor-widgets' ),
			'add_new'            => __( 'Add New', 'motors-elementor-widgets' ),
			'add_new_item'       => __( 'Add New ' . self::$single, 'motors-elementor-widgets' ),
			'edit_item'          => __( 'Edit ' . self::$single, 'motors-elementor-widgets' ),
			'new_item'           => __( 'New ' . self::$single, 'motors-elementor-widgets' ),
			'all_items'          => __( 'All ' . self::$plural, 'motors-elementor-widgets' ),
			'view_item'          => __( 'View ' . self::$single, 'motors-elementor-widgets' ),
			'search_items'       => __( 'Search ' . self::$plural, 'motors-elementor-widgets' ),
			'not_found'          => __( 'No ' . self::$plural . ' found', 'motors-elementor-widgets' ),
			'not_found_in_trash' => __( 'No ' . self::$plural . '  found in Trash', 'motors-elementor-widgets' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( self::$plural, 'motors-elementor-widgets' ),
		);
		// @codingStandardsIgnoreEnd

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => null,
			'supports'           => array( 'title', 'editor' ),
		);

		register_post_type( self::$post_type, $args );
	}

	public static function motors_override_single_template( $single_template ) {
		global $post;

		$file = MOTORS_ELEMENTOR_WIDGETS_PATH . '/templates/single-' . $post->post_type . '.php';

		if ( file_exists( $file ) ) {
			$single_template = $file;
		}

		return $single_template;
	}

	public static function motors_car_settings_conf( $conf ) {
		$conf[ self::$setting_name ] = array(
			'label'       => esc_html__( 'Listing Page Template', 'motors-elementor-widgets' ),
			'type'        => 'mew-repeater-radio',
			'description' => __( 'Select listing page template', 'motors-elementor-widgets' ),
			'fields'      => self::$data_for_select,
			'value'       => array_key_first( self::$data_for_select ),
			'submenu'     => esc_html__( 'Listing Template', 'motors-elementor-widgets' ),
		);

		return $conf;
	}

	public static function motors_get_templates_list() {
		$args = array(
			'post_type'      => self::$post_type,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
		);

		$posts = new \WP_Query( $args );

		$for_select = array();

		foreach ( $posts->posts as $post ) {
			$for_select[] = array(
				'post_id'   => $post->ID,
				'title'     => $post->post_title,
				'edit_link' => get_admin_url( null, 'post.php?post=' . $post->ID . '&action=elementor' ),
				'view_link' => get_the_permalink( $post->ID ),
			);
		}

		self::$data_for_select = $for_select;

		wp_reset_postdata();
	}

	public static function motors_register_wpcfto_repeater_radio() {
		return MOTORS_ELEMENTOR_WIDGETS_PATH . '/inc/wpcfto/mew-repeater-radio.php';
	}

	public static function motors_create_template() {
		check_ajax_referer( 'motors_create_template', 'security' );

		$found_posts = new \WP_Query(
			array(
				'post_type'   => self::$post_type,
				'post_status' => 'publish',
			)
		);

		$post_title = 'Listing Template #' . ( $found_posts->found_posts + 1 );

		$post_data = array(
			'post_title'  => $post_title,
			'post_status' => 'publish',
			'post_type'   => self::$post_type,
		);

		wp_reset_postdata();

		$id = wp_insert_post( $post_data );

		if ( $id ) {
			update_post_meta( $id, '_elementor_edit_mode', 'builder' );

			$new_template = array(
				'post_id'   => $id,
				'title'     => get_the_title( $id ),
				'edit_link' => get_admin_url( null, 'post.php?post=' . $id . '&action=elementor' ),
				'view_link' => get_the_permalink( $id ),
			);

			wp_send_json(
				array(
					'msg'     => $new_template,
					'post_id' => $id,
					'code'    => 200,
				)
			);
		}
	}

	public static function motors_delete_template() {
		check_ajax_referer( 'motors_delete_template', 'security' );

		$data = array(
			'error' => true,
		);

		if ( ! empty( $_REQUEST['post_id'] ) && wp_delete_post( sanitize_text_field( $_REQUEST['post_id'] ) ) ) {
			$data['error']  = '';
			$data['status'] = 200;
		}

		wp_send_json( $data );
	}

	public static function motors_display_template() {
		$template_listing = get_post( self::$selected_template_id );
		setup_postdata( $template_listing );
		//phpcs:ignore
		echo Plugin::instance()->frontend->get_builder_content_for_display( $template_listing->ID );
		wp_reset_postdata();
	}
}
