<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\WidgetBase;

class Gallery extends WidgetBase {

	use SwitcherControl;

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
		return MotorsApp::STM_PREFIX . '-single-listing-gallery';
	}

	public function get_title() {
		return esc_html__( 'Gallery', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-photo-gallery';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'Action buttons', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'show_print',
			array(
				'label'   => esc_html__( 'Print', 'motors-elementor-widgets' ),
				'default' => '',
			)
		);

		$this->stm_ew_add_switcher(
			'show_compare',
			array(
				'label'   => esc_html__( 'Compare', 'motors-elementor-widgets' ),
				'default' => '',
			)
		);

		$this->stm_ew_add_switcher(
			'show_share',
			array(
				'label'   => esc_html__( 'Share', 'motors-elementor-widgets' ),
				'default' => '',
			)
		);

		if ( is_listing() ) {
			$this->stm_ew_add_switcher(
				'show_featured',
				array(
					'label'   => esc_html__( 'Featured', 'motors-elementor-widgets' ),
					'default' => '',
				)
			);
		}

		$this->stm_ew_add_switcher(
			'show_test_drive',
			array(
				'label'   => esc_html__( 'Test Drive', 'motors-elementor-widgets' ),
				'default' => '',
			)
		);

		$this->stm_ew_add_switcher(
			'show_pdf',
			array(
				'label'   => esc_html__( 'PDF', 'motors-elementor-widgets' ),
				'default' => '',
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/single-listing/gallery', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
