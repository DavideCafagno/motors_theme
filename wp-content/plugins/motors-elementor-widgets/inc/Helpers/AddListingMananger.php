<?php

namespace Motors_E_W\Helpers;

class AddListingMananger {
	public static function init() {
		add_filter( 'motors_get_all_wpcfto_config', array( self::class, 'motors_config_map_tab_add_listing' ), 41, 1 );
	}

	public static function motors_config_map_tab_add_listing( $global_conf ) {
		$conf = array(
			'name'   => esc_html__( 'Add Listing', 'motors-elementor-widgets' ),
			'fields' => apply_filters( 'motors_add_listing_config', self::motors_create_config() ),
		);

		$global_conf[ stm_me_modify_key( $conf['name'] ) ] = $conf;

		return $global_conf;
	}

	private static function motors_create_config() {

		$conf = array_merge(
			self::desc_slots_conf(),
			self::listing_title(),
			self::listing_details(),
			self::listing_features(),
			self::listing_gallery(),
			self::listing_videos(),
			self::listing_seller_note(),
			self::listing_plans(),
			self::listing_price(),
			self::listing_register_login(),
			self::sort_add_listing_steps_config()
		);

		return $conf;
	}

	private static function sort_add_listing_steps_config() {
		return array(
			'sorted_steps' => array(
				'type'        => 'sorter',
				'label'       => esc_html__( 'Sort Layouts', 'motors-elementor-widgets' ),
				'description' => '<i class="fa fa-exclamation-triangle"></i> The option is important and is not recommended to be disabled',
				'options'     => array(
					array(
						'id'      => 'enable_layouts',
						'name'    => esc_html__( 'Enable Layouts', 'motors-elementor-widgets' ),
						'options' => array(
							array(
								'id'    => 'item_details',
								'label' => esc_html__( 'Details', 'motors-elementor-widgets' ),
								'icon'  => 'fa fa-exclamation-triangle',
							),
							array(
								'id'    => 'item_features',
								'label' => esc_html__( 'Features', 'motors-elementor-widgets' ),
							),
							array(
								'id'    => 'item_gallery',
								'label' => esc_html__( 'Gallery', 'motors-elementor-widgets' ),
							),
							array(
								'id'    => 'item_videos',
								'label' => esc_html__( 'Videos', 'motors-elementor-widgets' ),
							),
							array(
								'id'    => 'item_seller_note',
								'label' => esc_html__( 'Seller Note', 'motors-elementor-widgets' ),
							),
							array(
								'id'    => 'item_price',
								'label' => esc_html__( 'Price', 'motors-elementor-widgets' ),
								'icon'  => 'fa fa-exclamation-triangle',
							),
							array(
								'id'    => 'item_plans',
								'label' => esc_html__( 'Plans', 'motors-elementor-widgets' ),
							),
						),
					),
					array(
						'id'      => 'disable_layouts',
						'name'    => esc_html__( 'Disable Layouts', 'motors-elementor-widgets' ),
						'options' => array(),
					),
				),
				'submenu'     => 'Layout Manager',
			),
		);
	}

	private static function desc_slots_conf() {
		return array(
			'addl_group_ds_title' => array(
				'type'             => 'group_title',
				'label'            => esc_html__( 'Description & Slots', 'motors-elementor-widgets' ),
				'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/desc_slots.png',
				'preview_position' => 'preview_bottom',
				'group'            => 'started',
			),
			'addl_title'          => array(
				'label'   => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'type'    => 'text',
				'value'   => esc_html__( 'Build Your Ad', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_description'    => array(
				'label'   => esc_html__( 'Description', 'motors-elementor-widgets' ),
				'type'    => 'editor',
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_show_slots'     => array(
				'label'   => esc_html__( 'Available Slots', 'motors-elementor-widgets' ),
				'type'    => 'checkbox',
				'value'   => true,
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_slots_title'    => array(
				'label'      => esc_html__( 'Label', 'motors-elementor-widgets' ),
				'type'       => 'text',
				'value'      => esc_html__( 'Slots available', 'motors-elementor-widgets' ),
				'submenu'    => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'      => 'ended',
				'dependency' => array(
					'key'   => 'addl_show_slots',
					'value' => 'not_empty',
				),
			),
		);
	}

	private static function listing_title() {
		return array(
			'addl_group_lt_title' => array(
				'type'             => 'group_title',
				'label'            => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/item_title.png',
				'preview_position' => 'preview_bottom',
				'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'            => 'started',
			),
			'addl_car_title'      => array(
				'label'       => esc_html__( 'Custom Title', 'motors-elementor-widgets' ),
				'description' => 'Enables input field for listing title. The generated title can be controlled in Inventory Settings > Grid/List Card > Display Generated Car Title as',
				'type'        => 'checkbox',
				'value'       => false,
				'submenu'     => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'       => 'ended',
			),
		);
	}

	private static function listing_details() {

		return array(
			'addl_group_details_title' => array(
				'type'             => 'group_title',
				'label'            => esc_html__( 'Details', 'motors-elementor-widgets' ),
				'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/item_details.png',
				'preview_position' => 'preview_bottom',
				'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'            => 'started',
			),
			'addl_required_fields'     => array(
				'label'       => esc_html__( 'Required Categories', 'motors-elementor-widgets' ),
				'description' => 'Add new <a href="' . admin_url( 'edit.php?post_type=listings&page=listing_categories' ) . '" target="_blank">category</a>',
				'type'        => 'multi_checkbox',
				'options'     => self::get_main_taxonomies_to_fill(),
				'submenu'     => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_number_as_input'     => array(
				'label'       => esc_html__( 'Transform numeric categories to input fields', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'Applies to Required Categories', 'motors-elementor-widgets' ),
				'type'        => 'checkbox',
				'value'       => true,
				'submenu'     => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_show_registered'     => array(
				'label'   => esc_html__( 'Registered Date', 'motors-elementor-widgets' ),
				'type'    => 'checkbox',
				'value'   => true,
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_show_vin'            => array(
				'label'   => esc_html__( 'VIN', 'motors-elementor-widgets' ),
				'type'    => 'checkbox',
				'value'   => true,
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_show_history'        => array(
				'label'   => esc_html__( 'History', 'motors-elementor-widgets' ),
				'type'    => 'checkbox',
				'value'   => true,
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_history_report'      => array(
				'label'       => esc_html__( 'Allowed Histories', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'Enter allowed histories, separated by a comma. Example - (Carfax, AutoCheck, Carfax 1 Owner, etc)', 'motors-elementor-widgets' ),
				'type'        => 'text',
				'value'       => 'Carfax, AutoCheck',
				'submenu'     => esc_html__( 'General', 'motors-elementor-widgets' ),
				'dependency'  => array(
					'key'   => 'addl_show_history',
					'value' => 'not_empty',
				),
			),
			'addl_details_location'    => array(
				'label'   => esc_html__( 'Location', 'motors-elementor-widgets' ),
				'type'    => 'checkbox',
				'value'   => true,
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'   => 'ended',
			),
		);
	}

	private static function listing_features() {
		return array(
			'addl_group_features_title' => array(
				'type'             => 'group_title',
				'label'            => esc_html__( 'Features', 'motors-elementor-widgets' ),
				'description'      => wp_kses_post( '<a href="' . get_site_url() . '/wp-admin/edit-tags.php?taxonomy=stm_additional_features&post_type=listings" target="_blank">All Features</a>' ),
				'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/item_features.png',
				'preview_position' => 'preview_bottom',
				'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'            => 'started',
			),
			'addl_user_features'        => array(
				'type'    => 'repeater',
				'label'   => esc_html__( 'Features', 'motors-elementor-widgets' ),
				'fields'  => array(
					'tab_title_single' => array(
						'type'  => 'text',
						'label' => esc_html__( 'Title', 'motors-elementor-widgets' ),
					),
					'tab_title_labels' => array(
						'type'        => 'text',
						'label'       => esc_html__( 'Features list', 'motors-elementor-widgets' ),
						'description' => esc_html__( 'Enter features, separated by comma without spaces. Example - (Bluetooth,DVD Player,etc)', 'motors-elementor-widgets' ),
					),
				),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'   => 'ended',
			),
		);
	}

	private static function listing_gallery() {
		return array(
			'addl_group_gallery_title' => array(
				'type'             => 'group_title',
				'label'            => esc_html__( 'Gallery', 'motors-elementor-widgets' ),
				'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/item_gallery.png',
				'preview_position' => 'preview_bottom',
				'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'            => 'started',
			),
			'addl_gallery_content'     => array(
				'type'    => 'editor',
				'label'   => esc_html__( 'Description', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'   => 'ended',
			),
		);
	}

	private static function listing_videos() {
		return array(
			'addl_group_video_title' => array(
				'type'             => 'group_title',
				'label'            => esc_html__( 'Videos', 'motors-elementor-widgets' ),
				'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/item_videos.png',
				'preview_position' => 'preview_bottom',
				'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'            => 'started',
			),
			'addl_video_content'     => array(
				'type'    => 'editor',
				'label'   => esc_html__( 'Description', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'   => 'ended',
			),
		);
	}

	private static function listing_seller_note() {
		return array(
			'addl_group_seller_note_title' => array(
				'type'             => 'group_title',
				'label'            => esc_html__( 'Seller Note', 'motors-elementor-widgets' ),
				'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/item_seller_note.png',
				'preview_position' => 'preview_bottom',
				'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'            => 'started',
			),
			'addl_seller_note_content'     => array(
				'type'        => 'editor',
				'label'       => esc_html__( 'Template Phrases', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'Enter phrases, separated by a comma. Example - (Excellent condition, Always garaged, etc)', 'motors-elementor_widgets' ),
				'submenu'     => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'       => 'ended',
			),
		);
	}

	private static function listing_price() {
		return array(
			'addl_group_price_title' => array(
				'type'             => 'group_title',
				'label'            => esc_html__( 'Price', 'motors-elementor-widgets' ),
				'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/item_price.png',
				'preview_position' => 'preview_bottom',
				'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'            => 'started',
			),
			'addl_price_title'       => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_price_label'       => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Label', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_price_desc'        => array(
				'type'    => 'editor',
				'label'   => esc_html__( 'Description', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'   => 'ended',
			),
		);
	}

	private static function listing_plans() {
		if ( class_exists( 'Subscriptio' ) || class_exists( 'RP_SUB' ) ) {
			return array(
				'addl_group_plans_title' => array(
					'type'             => 'group_title',
					'label'            => esc_html__( 'Subscription Plans', 'motors-elementor-widgets' ),
					'description'      => esc_html__( 'Displays in accordance with User/Dealer > Main > Enable Pricing Plans settings.', 'motors-elementor-widgets' ),
					'preview'          => MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/wpcfto/item_plan.png',
					'preview_position' => 'preview_bottom',
					'icon'             => 'fa fa-clock',
					'submenu'          => esc_html__( 'General', 'motors-elementor-widgets' ),
				),
			);
		}

		return array();
	}

	private static function listing_register_login() {
		return array(
			'addl_group_reg_login_title' => array(
				'type'    => 'group_title',
				'label'   => esc_html__( 'Register/Login', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
				'group'   => 'started',
			),
			'addl_reg_log_title'         => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_reg_log_desc'          => array(
				'type'    => 'textarea',
				'label'   => esc_html__( 'Description', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
			),
			'addl_reg_log_link'          => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Terms & Conditions', 'motors-elementor-widgets' ),
				'submenu' => esc_html__( 'General', 'motors-elementor-widgets' ),
				'options' => self::get_page_list(),
				'group'   => 'ended',
			),
		);
	}

	private static function get_page_list() {
		$pages = get_pages();

		$p_list = array();
		foreach ( $pages as $page ) {
			$p_list[ $page->ID ] = $page->post_title;
		}

		return $p_list;
	}

	private static function get_main_taxonomies_to_fill() {
		$filter_options = stm_get_single_car_listings();

		$taxonomies = array();

		if ( ! empty( stm_get_single_car_listings() ) ) {
			foreach ( $filter_options as $filter_option ) {
				$taxonomies[ $filter_option['slug'] ] = $filter_option['single_name'];
			}
		}

		return $taxonomies;
	}
}
