<?php

namespace Motors_E_W\Widgets\MegaMenu;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\WidgetBase;

class TopCategories extends WidgetBase {

	use Select2Control;
	use TextControl;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( 'stm_mm_top_categories' );
	}

	public function get_style_depends() {
		return array( 'stm_mm_top_categories' );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_MEGAMENU );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-top-categories';
	}

	public function get_title() {
		return esc_html__( 'Top Categories', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-tab-list';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'title',
			array(
				'label' => esc_html__( 'Title', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select_2(
			'categories',
			array(
				'label'    => esc_html__( 'Select Categories', 'motors-elementor-widgets' ),
				'options'  => Helper::get_listing_options(),
				'multiple' => true,
			)
		);

		$this->stm_end_control_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/megamenu/top-categories', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );

	}

}
