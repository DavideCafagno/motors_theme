<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ListingsList extends WidgetBase {

	use ColorControl;
	use TextControl;
	use SelectControl;
	use SwitcherControl;
	use Select2Control;
	use IconsControl;
	use NumberControl;
	use SliderControl;
	use HeadingControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-listings-list';
	}

	public function get_title() {
		return esc_html__( 'Listings List', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-grid-view';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_select_2(
			'listing_types',
			array(
				'label'    => __( 'Listing Types', 'motors-elementor-widgets' ),
				'default'  => 'listings',
				'multiple' => true,
				'options'  => Helper::stm_ew_get_multilisting_types( true ),
			)
		);

		$this->stm_ew_add_number(
			'listings_number',
			array(
				'label'       => __( 'Overall Number of Listings', 'motors-elementor-widgets' ),
				'min'         => 1,
				'step'        => 1,
				'default'     => 9,
				'description' => __( 'Leave empty or input "-1" to show infinite number of listings', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'only_featured',
			array(
				'label' => __( 'Only Featured Listings', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'include_sold',
			array(
				'label' => __( 'Include Sold Listings', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'enable_pagination',
			array(
				'label' => __( 'Enable pagination', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_styles', __( 'Styles', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_heading(
			'isr_pagination_styles',
			array(
				'label'     => __( 'Pagination', 'motors-elementor-widgets' ),
				'separator' => 'before',
				'condition' => array(
					'enable_pagination' => 'yes',
				),
			)
		);

		$this->stm_start_ctrl_tabs( 'pagination_style' );

		$this->stm_start_ctrl_tab(
			'pagination_normal',
			array(
				'label'     => __( 'Normal', 'motors-elementor-widgets' ),
				'condition' => array(
					'enable_pagination' => 'yes',
				),
			)
		);

		$this->stm_ew_add_color(
			'isr_pagination_item_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_list .stm-blog-pagination ul.page-numbers li > a' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'enable_pagination' => 'yes',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'pagination_active',
			array(
				'label'     => __( 'Active', 'motors-elementor-widgets' ),
				'condition' => array(
					'enable_pagination' => 'yes',
				),
			)
		);

		$this->stm_ew_add_color(
			'isr_pagination_active_item_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_list .stm-blog-pagination ul.page-numbers li .current' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'enable_pagination' => 'yes',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/listings-list', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
