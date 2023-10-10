<?php

namespace Motors_E_W\Widgets\SingleListing\Classified;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\WidgetBase;

class Price extends WidgetBase {

	use HeadingControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-classified-price';
	}

	public function get_icon() {
		return 'stmew-price-tag';
	}

	public function get_title() {
		return esc_html__( 'Price Classified', 'motors-elementor-widgets' );
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'price_section', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_heading(
			'price_heading',
			array(
				'label' => __( 'The listing price value can be edited in<br />the Listing Manager > Prices section<br />individually for each single listing.', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/single-listing/classified/price', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
