<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\WidgetBase;

class ListingData extends WidgetBase {

	use SwitcherControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-listing-data';
	}

	public function get_title() {
		return esc_html__( 'Data', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-stack';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'ld_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'show_vin',
			array(
				'label'     => __( 'VIN Number', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_certified_logo_1',
			array(
				'label'     => __( 'Certified Logo 1', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_certified_logo_2',
			array(
				'label'     => __( 'Certified Logo 2', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/single-listing/listing-data', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
