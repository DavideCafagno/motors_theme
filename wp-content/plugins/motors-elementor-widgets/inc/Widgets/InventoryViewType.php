<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\WidgetBase;

class InventoryViewType extends WidgetBase {

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-inventory-view-type';
	}

	public function get_title() {
		return esc_html__( 'View Type', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-framed-eye';
	}

	public function get_script_depends() {
		return array( 'motors-general-admin' );
	}

	protected function register_controls() {}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/inventory-view-type', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {

	}
}
