<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\WidgetBase;

class OfferPriceButton extends WidgetBase {

	use TextControl;
	use IconsControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		add_filter(
			'mew_include_offer_price_modal',
			function () {
				return true;
			}
		);

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-offer-price';
	}

	public function get_title() {
		return esc_html__( 'Offer Price Button', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-currency-usd';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'opb_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'opb_btn_label',
			array(
				'label'   => __( 'Label', 'motors-elementor-widgets' ),
				'default' => __( 'Make an Offer Price', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/single-listing/offer-price', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}

	public function motors_add_modal() {
		get_template_part( 'partials/modals/trade-offer' );
	}
}
