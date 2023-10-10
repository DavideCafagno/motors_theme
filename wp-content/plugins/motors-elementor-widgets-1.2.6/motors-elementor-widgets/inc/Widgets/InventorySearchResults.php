<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\WidgetBase;

class InventorySearchResults extends WidgetBase {

	use HeadingControl;
	use TextControl;
	use SelectControl;
	use ColorControl;

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
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-inventory-search-results';
	}

	public function get_title() {
		return esc_html__( 'Search Result', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-inventory-search';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'isr_content', __( 'General', 'motors-elementor-widgets' ) );

		if ( stm_is_multilisting() ) {

			$this->stm_ew_add_select(
				'post_type',
				array(
					'label'   => __( 'Listing Type', 'motors-elementor-widgets' ),
					'options' => Helper::stm_ew_multi_listing_types(),
					'default' => 'listings',
				),
			);

		}

		$this->stm_ew_add_text(
			'ppp_on_list',
			array(
				'label'   => __( 'Posts Per Page on List View', 'motors-elementor-widgets' ),
				'default' => '10',
			)
		);

		$this->stm_ew_add_text(
			'ppp_on_grid',
			array(
				'label'   => __( 'Posts Per Page on Grid View', 'motors-elementor-widgets' ),
				'default' => '9',
			)
		);

		$this->stm_ew_add_select(
			'quant_grid_items',
			array(
				'label'       => __( 'Quantity of Listing Per Row on Grid View', 'motors-elementor-widgets' ),
				'description' => __( 'Reload the page to apply the settings.', 'motors-elementor-widgets' ),
				'options'     => array(
					'2' => '2',
					'3' => '3',
				),
				'default'     => '3',
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'isr_styles', __( 'Styles', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_heading(
			'isr_pagination_styles',
			array(
				'label'     => __( 'Pagination', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_start_ctrl_tabs( 'pagination_style' );

		$this->stm_start_ctrl_tab(
			'pagination_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isr_pagination_item_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-inventory-search-results#listings-result ul.page-numbers li > a' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'pagination_active',
			array(
				'label' => __( 'Active', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isr_pagination_active_item_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-inventory-search-results#listings-result ul.page-numbers li .current' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/inventory-search-results', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {

	}
}
