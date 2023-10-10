<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\WidgetBase;

class AddListing extends WidgetBase {

	use HeadingControl;
	use SelectControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name() );
	}

	public function get_script_depends() {
		return array(
			'load-image',
			'stm-cascadingdropdown',
			'uniform',
			'uniform-init',
			'jquery-ui-droppable',
			'stmselect2',
			'stm_gmap',
			'stm-google-places',
			'app-select2',
			'stm-theme-sell-a-car',
			$this->get_admin_name(),
		);
	}

	public function get_style_depends(): array {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'load-image';
		$widget_styles[] = 'stm-cascadingdropdown';
		$widget_styles[] = 'uniform';
		$widget_styles[] = 'uniform-init';
		$widget_styles[] = 'jquery-ui-droppable';
		$widget_styles[] = 'stm_gmap';
		$widget_styles[] = 'stm-google-places';
		$widget_styles[] = 'stmselect2';
		$widget_styles[] = 'app-select2';

		return $widget_styles;
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_CLASSIFIED );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-add-listing';
	}

	public function get_title() {
		return esc_html__( 'Add Listing', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-add-listing';
	}

	public function register_controls() {
		$this->stm_start_content_controls_section( 'general', __( 'General', 'motors-elementor-widgets' ) );

		if ( function_exists( 'stm_is_multilisting' ) && stm_is_multilisting() ) {

			$this->stm_ew_add_select(
				'post_type',
				array(
					'label'   => __( 'Listing Type', 'motors-elementor-widgets' ),
					'options' => Helper::stm_ew_multi_listing_types(),
					'default' => 'listings',
				),
			);

			$listing_types = Helper::stm_ew_multi_listing_types();

			if ( $listing_types ) {
				foreach ( $listing_types as $slug => $typename ) {
					if ( stm_listings_post_type() !== $slug ) {
						$this->stm_ew_add_heading(
							'add_listing_hint_' . $slug,
							array(
								'label'     => 'Move To <a href="' . admin_url( 'admin.php?page=stm_motors_listing_types#' . $slug ) . '" target="_blank">' . $typename . ' listing type Settings</a>',
								'condition' => array( 'post_type' => $slug ),
							)
						);
					} else {
						$this->stm_ew_add_heading(
							'add_listing_hint',
							array(
								'label'     => 'Move To <a href="' . admin_url( 'admin.php?page=wpcfto_motors_' . Helper::stm_ew_get_selected_layout() . '_settings#add_listing' ) . '" target="_blank">Add Listing Settings</a>',
								'condition' => array( 'post_type' => stm_listings_post_type() ),
							)
						);
					}
				}
			}
		} else {

			$this->stm_ew_add_heading(
				'add_listing_hint',
				array(
					'label' => 'Move To <a href="' . admin_url( 'admin.php?page=wpcfto_motors_' . Helper::stm_ew_get_selected_layout() . '_settings#add_listing' ) . '" target="_blank">Add Listing Settings</a>',
				)
			);

		}
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/add-listing/main', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}
}
