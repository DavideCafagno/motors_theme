<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\WidgetBase;

class InventorySortBy extends WidgetBase {

	use HeadingControl;

	protected $wpcfto_settings = '';

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->wpcfto_settings = admin_url( '?page=wpcfto_motors_' . Helper::stm_ew_get_selected_layout() . '_settings#inventory_settings' );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-inventory-sort-by';
	}

	public function get_title() {
		return esc_html__( 'Sort By', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-inventory-sort';
	}

	public function get_style_depends() {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'motors-general-admin';
		$widget_styles[] = self::get_name() . '-rtl';
		return $widget_styles;
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'sb_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_heading(
			'sb_heading',
			array(
				'label' => sprintf( '<a href="' . $this->wpcfto_settings . '" target="_blank">%s</a>', __( 'Themes Options Link', 'motors-elementor-widgets' ) ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/inventory-sort-by', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {

	}
}
