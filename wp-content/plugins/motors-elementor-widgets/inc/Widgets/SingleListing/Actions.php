<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class Actions extends WidgetBase {

	use SwitcherControl;
	use IconsControl;
	use TextControl;
	use SliderControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}
	public function get_style_depends(): array {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = self::get_name() . '-rtl';

		return $widget_styles;
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-actions';
	}

	public function get_title() {
		return esc_html__( 'Actions', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-tab-list';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'actions_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'show_added_date',
			array(
				'label' => __( 'Published Date', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_print_btn',
			array(
				'label' => __( 'Print Button', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_stock',
			array(
				'label' => __( 'Stock', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_test_drive',
			array(
				'label' => __( 'Test Drive Schedule', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_compare',
			array(
				'label' => __( 'Comparison', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_share',
			array(
				'label' => __( 'Sharing', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_pdf',
			array(
				'label' => __( 'PDF Brochure', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/single-listing/actions', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
