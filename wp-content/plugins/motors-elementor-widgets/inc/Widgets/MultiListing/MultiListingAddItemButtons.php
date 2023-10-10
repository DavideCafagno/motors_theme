<?php
namespace Motors_E_W\Widgets\MultiListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\WidgetBase;

class MultiListingAddItemButtons extends WidgetBase {

	use TextControl;
	use Select2Control;
	use SelectControl;
	use ColorControl;
	use IconsControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue(
			$this->get_name(),
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array(
				'elementor-frontend',
				'stmselect2',
				'app-select2',
			)
		);
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_MULTILISTING );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-multilisting-add-item-buttons';
	}

	public function get_title() {
		return esc_html__( 'MLT Add Item Buttons', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-add-listing';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'default_lt_label',
			array(
				'label'   => esc_html__( 'Default listing type label', 'motors-elementor-widgets' ),
				'default' => 'Cars',
			),
		);

		$this->stm_ew_add_icons(
			'default_lt_icon',
			array(
				'label'            => __( 'Default listing type Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
			)
		);

		$this->stm_end_control_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/multi-listing/multi-listing-add-item-buttons', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}
}
