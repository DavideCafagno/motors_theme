<?php

namespace Motors_E_W\Widgets\MegaMenu;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\WidgetBase;

class TopMakesTabs extends WidgetBase {

	use Select2Control;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( 'stm_mm_top_makes_tab' );
	}

	public function get_style_depends() {
		return array( 'stm_mm_top_makes_tab' );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_MEGAMENU );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-top-makes-tabs';
	}

	public function get_title() {
		return esc_html__( 'Top Makes Tabs', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-inventory-results';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$makes = array(
			'all_makes' => esc_html__( 'All', 'motors-elementor-widgets' ),
		);

		$make_terms = get_terms( array( 'taxonomy' => 'make' ) );

		if ( ! empty( $make_terms ) ) {
			foreach ( $make_terms as $make_term ) {
				$makes[ $make_term->slug ] = $make_term->name;
			}
		}

		$this->stm_ew_add_select_2(
			'makes',
			array(
				'label'    => esc_html__( 'Select Categories', 'motors-elementor-widgets' ),
				'options'  => $makes,
				'multiple' => true,
			)
		);

		$this->stm_end_control_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/megamenu/top-makes-tabs', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );

	}

}
