<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class CarMPG extends WidgetBase {

	use IconsControl;
	use SliderControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-mpg';
	}

	public function get_title() {
		return esc_html__( 'Car MPG', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-gas-station';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'title_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_icons(
			'car_mpg_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-fuel',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'mpg_styles', __( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_slider(
			'icon_typography',
			array(
				'label'      => __( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 26,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm_single_car_mpg .mpg-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm_single_car_mpg .mpg-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['car_mpg_icon'] = $this->stm_ew_get_rendered_icon( 'car_mpg_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/single-listing/car-mpg', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
