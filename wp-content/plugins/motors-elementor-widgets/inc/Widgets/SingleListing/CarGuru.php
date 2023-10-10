<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class CarGuru extends WidgetBase {

	use SelectControl;
	use TextControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-car-guru';
	}

	public function get_title() {
		return esc_html__( 'CarGurus', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-car-gurus';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'cg_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'carguru_default_height',
			array(
				'label'   => esc_html__( 'CarGurus Enter Height (in pixels)', 'stm_motors_extends' ),
				'default' => '42',
			)
		);

		$this->stm_ew_add_select(
			'carguru_style',
			array(
				'label'   => esc_html__( 'CarGurus Style', 'stm_motors_extends' ),
				'options' => $this->motors_get_cg_styles(),
				'default' => 'STYLE1',
			)
		);

		$this->stm_ew_add_select(
			'carguru_min_rating',
			array(
				'label'   => esc_html__( 'CarGurus Minimum Rating to Display', 'stm_motors_extends' ),
				'options' => $this->motors_get_cg_mrtd(),
				'default' => 'GREAT_PRICE',
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/single-listing/car-guru', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {

	}

	private function motors_get_cg_styles() {
		return array(
			'STYLE1'  => 'Style 1',
			'STYLE2'  => 'Style 2',
			'BANNER1' => 'Banner 1 - 900 x 60 pixels',
			'BANNER2' => 'Banner 2 - 900 x 42 pixels',
			'BANNER3' => 'Banner 3 - 748 x 42 pixels',
			'BANNER4' => 'Banner 4 - 550 x 42 pixels',
			'BANNER5' => 'Banner 5 - 374 x 42 pixels',
		);
	}

	private function motors_get_cg_mrtd() {
		return array(
			'GREAT_PRICE' => 'Great Price',
			'GOOD_PRICE'  => 'Good Price',
			'FAIR_PRICE'  => 'Fair Price',
		);
	}
}
