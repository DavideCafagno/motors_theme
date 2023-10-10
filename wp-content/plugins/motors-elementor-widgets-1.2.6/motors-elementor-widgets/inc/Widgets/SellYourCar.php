<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\WidgetBase;

class SellYourCar extends WidgetBase {

	use ColorControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );

		$this->stm_ew_enqueue( 'sell-a-car-form' );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-sell-your-car';
	}

	public function get_title() {
		return esc_html__( 'Sell Your Car', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-currency-usd';
	}

	protected function register_controls() {
		$this->stm_start_style_controls_section( 'sell-your-car_style', __( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'accent_color',
			array(
				'label'     => __( 'Accent Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-sell-a-car-form .form-navigation .form-navigation-unit .number'        => 'color: {{VALUE}};border-color: {{VALUE}}',
					'{{WRAPPER}} .stm-sell-a-car-form .form-navigation .form-navigation-unit.active .number' => 'background-color: {{VALUE}};color: #ffffff;',
					'{{WRAPPER}} .stm-sell-a-car-form .form-navigation .form-navigation-unit.active'         => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$is_edit = Helper::is_elementor_edit_mode();

		if ( ! $is_edit ) {
			wp_enqueue_script( 'sell-a-car-form' );
		}

		Helper::stm_ew_load_template( 'widgets/sell-your-car', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {

	}

}
