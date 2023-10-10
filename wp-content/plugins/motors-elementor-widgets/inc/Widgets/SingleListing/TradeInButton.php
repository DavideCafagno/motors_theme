<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\WidgetBase;

class TradeInButton extends WidgetBase {

	use TextControl;
	use IconsControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );

		$this->stm_ew_enqueue( 'sell-a-car-form' );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-trade-in';
	}

	public function get_title() {
		return esc_html__( 'Trade In Button', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-cycle';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'tif_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'tif_btn_label',
			array(
				'label'   => __( 'Label', 'motors-elementor-widgets' ),
				'default' => __( 'Trade In Form', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		add_filter(
			'mew_include_trade_in_modal',
			function () {
				return true;
			}
		);

		$settings = $this->get_settings_for_display();

		$is_edit = Helper::is_elementor_edit_mode();

		if ( ! $is_edit ) {
			wp_enqueue_script( 'sell-a-car-form' );
		}

		Helper::stm_ew_load_template( 'widgets/single-listing/trade-in', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}

	public function motors_add_modal() {
		Helper::stm_ew_load_template( 'modals/trade-in-default', MOTORS_ELEMENTOR_WIDGETS_PATH, array() );
	}
}
