<?php

namespace Motors_E_W\Widgets;

use Elementor\Controls_Manager;
use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\ChooseControl;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\WYSIWYGControl;
use STM_E_W\Widgets\Controls\StyleControls\AlignControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBoxShadowControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class CarListingTabs extends WidgetBase {

	use TextControl;
	use SelectControl;
	use Select2Control;
	use SwitcherControl;
	use WYSIWYGControl;
	use HeadingControl;
	use SliderControl;
	use ColorControl;
	use IconsControl;
	use ChooseControl;
	use DimensionsControl;
	use GroupTypographyControl;
	use GroupBoxShadowControl;
	use AlignControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-car-listing-tabs';
	}

	public function get_icon() {
		return 'stmew-inventory-results';
	}

	public function get_script_depends() {
		return array( 'uniform', 'uniform-init', 'jquery-effects-slide', 'stmselect2', 'app-select2', $this->get_admin_name() );
	}

	public function get_style_depends() {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'motors-general-admin';
		$widget_styles[] = 'stmselect2';
		$widget_styles[] = 'app-select2';
		$widget_styles[] = 'uniform';
		$widget_styles[] = 'uniform-init';
		$widget_styles[] = self::get_name() . '-rtl';
		return $widget_styles;
	}

	public function get_title() {
		return esc_html__( 'Listing Tabs', 'motors-elementor-widgets' );
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_heading(
			'content_heading',
			array(
				'label' => esc_html__( 'Header Text', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_wysiwyg(
			'content',
			array()
		);

		$this->stm_ew_add_select_2(
			'selected_taxonomies',
			array(
				'label'       => esc_html__( 'Category', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'Type slug of the category (don\'t delete anything from autocompleted suggestions)', 'motors-elementor-widgets' ),
				'multiple'    => true,
				'options'     => Helper::stm_ew_get_listing_taxonomies(),
			)
		);

		$this->stm_ew_add_text(
			'tab_prefix',
			array(
				'label'       => esc_html__( 'Tab Prefix', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'This will appear before category name', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'tab_suffix',
			array(
				'label'       => esc_html__( 'Tab Suffix', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'This will appear after category name', 'motors-elementor-widgets' ),
				'default'     => esc_html__( 'cars', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'per_page',
			array(
				'label'       => esc_html__( 'Cars Per Load', 'motors-elementor-widgets' ),
				'description' => esc_html__( '-1 will show all cars from category', 'motors-elementor-widgets' ),
				'default'     => 8,
			)
		);

		$this->stm_ew_add_switcher(
			'enable_ajax_loading',
			array(
				'label'     => esc_html__( 'Ajax Loading', 'motors-elementor-widgets' ),
				'condition' => array(
					'selected_taxonomies!' => array(),
				),
			)
		);

		$this->stm_ew_add_switcher(
			'found_cars_show',
			array(
				'label'   => esc_html__( 'Show Found Cars block', 'motors-elementor-widgets' ),
				'default' => 'yes',
			),
		);

		$this->stm_ew_add_switcher(
			'found_cars_hide_mobile',
			array(
				'label'     => esc_html__( 'Hide Found Cars block on mobile', 'motors-elementor-widgets' ),
				'default'   => 'yes',
				'condition' => array( 'found_cars_show' => 'yes' ),
			),
		);

		$this->stm_ew_add_align_simple(
			'found_cars_align',
			array(),
			esc_html__( 'Found Cars Positioning', 'stm-elementor-widgets' ),
			array(
				'default'   => 'right',
				'condition' => array( 'found_cars_show' => 'yes' ),
			),
		);

		$this->stm_ew_add_icons(
			'found_cars_icon',
			array(
				'label'            => esc_html__( 'Found Cars Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-car',
				),
				'condition'        => array( 'found_cars_show' => 'yes' ),
			)
		);

		$this->stm_ew_add_text(
			'found_cars_prefix',
			array(
				'label'       => esc_html__( 'Found Cars Prefix', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'This will appear before found cars count', 'motors-elementor-widgets' ),
				'default'     => esc_html__( 'available', 'motors-elementor-widgets' ),
				'condition'   => array( 'found_cars_show' => 'yes' ),
			)
		);

		$this->stm_ew_add_text(
			'found_cars_suffix',
			array(
				'label'       => esc_html__( 'Found Cars Suffix', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'This will appear after found cars count', 'motors-elementor-widgets' ),
				'default'     => esc_html__( 'cars', 'motors-elementor-widgets' ),
				'condition'   => array( 'found_cars_show' => 'yes' ),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_content_controls_section( 'section_search', esc_html__( 'Search Tab', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'enable_search',
			array(
				'label'   => esc_html__( 'Search', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_text(
			'search_label',
			array(
				'label'   => esc_html__( 'Search Label', 'motors-elementor-widgets' ),
				'default' => esc_html__( 'Search', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'search_icon',
			array(
				'label'            => esc_html__( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-search',
				),
			)
		);

		$this->stm_ew_add_select(
			'filter_columns_number',
			array(
				'label'   => esc_html__( 'Number of Filter Columns', 'motors-elementor-widgets' ),
				'options' => array(
					'6' => '6',
					'4' => '4',
					'3' => '3',
					'2' => '2',
					'1' => '1',
				),
				'default' => '2',
			)
		);

		$this->stm_ew_add_select_2(
			'filter_selected',
			array(
				'label'    => esc_html__( 'Select Filter Options', 'motors-elementor-widgets' ),
				'multiple' => true,
				'options'  => Helper::stm_ew_get_car_filter_fields(),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_content_controls_section( 'section_cta', esc_html__( 'Call to action', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'enable_call_to_action',
			array(
				'label'   => esc_html__( 'Call-to-Action', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_text(
			'call_to_action_label',
			array(
				'label' => esc_html__( 'Label', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'call_to_action_icon',
			array(
				'label'            => esc_html__( 'Label Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-question',
				),
			)
		);

		$this->stm_ew_add_text(
			'call_to_action_label_right',
			array(
				'label' => esc_html__( 'Label Right', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'call_to_action_icon_right',
			array(
				'label'            => esc_html__( 'Label Icon Right', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-phone2',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_styles', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'top_part_bg',
			array(
				'label'     => esc_html__( 'Top Part Background Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .car-listing-top-part:before' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'available_num',
			array(
				'label'     => esc_html__( 'Found Cars Number Color', 'motors-elementor-widgets' ),
				'default'   => '#6c98e0',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .car-listing-top-part .found-cars .blue-lt' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'available_icon_color',
			array(
				'label'     => esc_html__( 'Found Cars Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#aaaaaa',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .found-cars i' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .car-listing-tabs-unit .found-cars svg path' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'available_icon_size',
			array(
				'label'      => esc_html__( 'Found Cars Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 12,
						'max'  => 60,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 23,
				),
				'selectors'  => array(
					'{{WRAPPER}} .car-listing-tabs-unit .found-cars i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .car-listing-tabs-unit .found-cars svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'available_icon_margin',
			array(
				'label'       => esc_html__( 'Found Cars Icon Margin', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '4',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'   => array(
					'{{WRAPPER}} .car-listing-tabs-unit .found-cars i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .car-listing-tabs-unit .found-cars svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_heading(
			'tabs_settings',
			array(
				'label'     => esc_html__( 'Tabs', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_start_ctrl_tabs( 'tabs_style' );

		$this->stm_start_ctrl_tab(
			'tabs_normal',
			array(
				'label' => esc_html__( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'tab_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'motors-elementor-widgets' ),
				'default'   => 'rgba(255, 255, 255, 0.1)',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .car-listing-top-part .stm-listing-tabs ul li:not(.active) a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'tab_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'motors-elementor-widgets' ),
				'default'   => '#aaaaaa',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .car-listing-top-part .stm-listing-tabs ul li a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'tabs_hover',
			array(
				'label' => esc_html__( 'Active', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'tab_active_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .car-listing-top-part .stm-listing-tabs ul li.active a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'tab_active_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .car-listing-top-part .stm-listing-tabs ul li.active a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_heading(
			'load_more_heading',
			array(
				'label'     => esc_html__( 'Button Colors', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_color(
			'btn_load_more_bg',
			array(
				'label'     => esc_html__( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#6c98e0',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .car-listing-main-part .row .load-more-btn' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'btn_load_more_text',
			array(
				'label'     => esc_html__( 'Text', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-tabs-unit .car-listing-main-part .row .load-more-btn' => 'color: {{VALUE}} !important',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'btn_load_more_box_shadow',
			array(
				'label'    => esc_html__( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .row .load-more-btn',
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_search_styles', esc_html__( 'Search Tab', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'search_label_color',
			array(
				'label'     => esc_html__( 'Search Label Color', 'motors-elementor-widgets' ),
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .tab-search-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_slider(
			'search_icon_size',
			array(
				'label'      => esc_html__( 'Search Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 12,
						'max'  => 60,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 34,
				),
				'selectors'  => array(
					'{{WRAPPER}} .car-listing-tabs-unit .tab-search-title i'   => 'font-size: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .car-listing-tabs-unit .tab-search-title svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'search_icon_margin',
			array(
				'label'       => esc_html__( 'Search Icon Margin', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '4',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'   => array(
					'{{WRAPPER}} .car-listing-tabs-unit .tab-search-title i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .car-listing-tabs-unit .tab-search-title svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'search_label_icon_color',
			array(
				'label'     => esc_html__( 'Search Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .tab-search-title i' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .tab-search-title svg path' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'btn_search_text',
			array(
				'label'     => esc_html__( 'Search Button Text', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .car-listing-main-part .button' => 'color: {{VALUE}} !important',
				),
			)
		);

		$this->stm_ew_add_color(
			'btn_search_bg',
			array(
				'label'     => esc_html__( 'Search Button Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .car-listing-main-part .button' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'btn_search_box_shadow',
			array(
				'label'    => esc_html__( 'Search Button Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .car-listing-main-part .button',
			)
		);

		$this->stm_ew_add_heading(
			'reset_btn_heading',
			array(
				'label' => esc_html__( 'Reset Button Color', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_start_ctrl_tabs(
			'reset_btn_tabs'
		);

		$this->stm_start_ctrl_tab(
			'reset_btn_general',
			array(
				'label' => esc_html__( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'btn_reset_color_normal',
			array(
				'label'     => esc_html__( 'Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .reset-all.reset-styled' => 'border-color: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'reset_btn_hover',
			array(
				'label' => esc_html__( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'btn_reset_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .reset-all.reset-styled:hover' => 'border-color: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_cta_styles', esc_html__( 'Call to Action', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_dimensions(
			'cta_padding',
			array(
				'label'     => esc_html__( 'Content Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'    => '23',
					'right'  => '46',
					'bottom' => '22',
					'left'   => '28',
				),
				'selectors' => array(
					'{{WRAPPER}} .filter .search-call-to-action .stm-call-to-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'call_to_action_bg_color',
			array(
				'label'     => esc_html__( 'Content Background Color', 'motors-elementor-widgets' ),
				'default'   => '#fab637',
				'selectors' => array(
					'{{WRAPPER}} .filter .search-call-to-action .stm-call-to-action' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'call_to_action_text_color',
			array(
				'label'     => esc_html__( 'Content Text Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .filter .search-call-to-action .stm-call-to-action .content' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_start_ctrl_tabs(
			'cta_settings'
		);

		$this->stm_start_ctrl_tab(
			'cta_left_styles',
			array(
				'label' => esc_html__( 'Left Part', 'motors-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'cta_left_icon_size',
			array(
				'label'          => esc_html__( 'Label Icon Size', 'motors-elementor-widgets' ),
				'default'        => 55,
				'tablet_default' => 40,
				'mobile_default' => 35,
				'selectors'      => array(
					'{{WRAPPER}} .car-listing-tabs-unit .stm-call-to-action .call-to-action-content i' => 'font-size: {{VALUE}}px;',
					'{{WRAPPER}} .car-listing-tabs-unit .stm-call-to-action .call-to-action-content svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'cta_label_icon_color',
			array(
				'label'     => esc_html__( 'Label Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .call-to-action-content i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .call-to-action-content svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'cta_left_content_typography',
			array(
				'label'    => esc_html__( 'Text Style', 'stm_elementor_widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'text_transform',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .call-to-action-content .content',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'cta_right_styles',
			array(
				'label' => esc_html__( 'Right Part', 'motors-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'cta_right_icon_size',
			array(
				'label'          => esc_html__( 'Label Icon Size', 'motors-elementor-widgets' ),
				'default'        => 38,
				'tablet_default' => 35,
				'mobile_default' => 20,
				'selectors'      => array(
					'{{WRAPPER}} .car-listing-tabs-unit .stm-call-to-action .call-to-action-right i' => 'font-size: {{VALUE}}px;',
					'{{WRAPPER}} .car-listing-tabs-unit .stm-call-to-action .call-to-action-right svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'sta_right_label_icon_color',
			array(
				'label'     => esc_html__( 'Label Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .call-to-action-right i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .call-to-action-right svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'cta_right_content_typography',
			array(
				'label'    => esc_html__( 'Text Style', 'stm_elementor_widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'text_transform',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .call-to-action-right .content',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$wrapperClass = $this->get_html_wrapper_class();

		$settings['search_icon']               = $this->stm_ew_get_rendered_icon( 'search_icon', $settings );
		$settings['found_cars_icon']           = $this->stm_ew_get_rendered_icon( 'found_cars_icon', $settings );
		$settings['call_to_action_icon']       = $this->stm_ew_get_rendered_icon( 'call_to_action_icon', $settings );
		$settings['call_to_action_icon_right'] = $this->stm_ew_get_rendered_icon( 'call_to_action_icon_right', $settings );

		Helper::stm_ew_load_template( 'widgets/car-listing-tabs', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() { }
}
