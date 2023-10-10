<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\AlignControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBackgroundControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBoxShadowControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBorderControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControlSimple;
use STM_E_W\Widgets\Controls\StyleControls\DividerControl;
use STM_E_W\Widgets\WidgetBase;

class InventorySearchFilter extends WidgetBase {

	use IconsControl;
	use TextControl;
	use SliderControl;
	use ColorControl;
	use DimensionsControl;
	use HeadingControl;
	use GroupTypographyControl;
	use SwitcherControl;
	use AlignControl;
	use GroupBoxShadowControl;
	use GroupBackgroundControl;
	use SelectControl;
	use GroupBorderControl;
	use ColorControlSimple;
	use DividerControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery', 'elementor-frontend' ) );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}

	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-inventory-search-filter';
	}

	public function get_title() {
		return esc_html__( 'Search Filter', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-inventory-filter';
	}

	public function get_script_depends() {
		return array( 'uniform', 'uniform-init', 'jquery-effects-slide', 'stmselect2', 'app-select2', 'stm_gmap', 'stm-google-places', $this->get_admin_name(), $this->get_name() );
	}

	public function get_style_depends() {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'motors-general-admin';
		$widget_styles[] = self::get_name() . '-rtl';
		$widget_styles[] = 'uniform';
		$widget_styles[] = 'uniform-init';
		$widget_styles[] = 'jquery-effects-slide';
		$widget_styles[] = 'stmselect2';
		$widget_styles[] = 'app-select2';
		return $widget_styles;
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'isf_content', __( 'General', 'motors-elementor-widgets' ) );

		if ( function_exists( 'stm_is_multilisting' ) && stm_is_multilisting() ) {

			$this->stm_ew_add_select(
				'post_type',
				array(
					'label'   => __( 'Listing Type', 'motors-elementor-widgets' ),
					'options' => Helper::stm_ew_multi_listing_types(),
					'default' => 'listings',
				),
			);

		}
		if ( ! stm_is_multilisting() ) {

			$this->stm_ew_add_heading(
				'sb_heading',
				array(
					'label' => $this->motors_selected_filters(),
				)
			);

		} else {
			$listing_types = Helper::stm_ew_multi_listing_types();

			if ( $listing_types ) {
				foreach ( $listing_types as $slug => $typename ) {

					$this->stm_ew_add_heading(
						'sb_heading_' . $slug,
						array(
							'label'     => $this->motors_selected_filters( $slug ),
							'condition' => array( 'post_type' => $slug ),
						)
					);

				}
			}
		}

		$this->stm_ew_add_icons(
			'search_options_icon',
			array(
				'label'            => __( 'Title Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-car_search',
				),
			)
		);

		$this->stm_ew_add_text(
			'isf_title',
			array(
				'label'   => __( 'Title', 'motors-elementor-widgets' ),
				'default' => __( 'Search Options', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select(
			'isf_icon_position',
			array(
				'label'   => esc_html__( 'Icon Position', 'motors-elementor-widgets' ),
				'options' => array(
					'left'  => 'Left',
					'right' => 'Right',
				),
				'default' => 'left',
			)
		);

		$this->stm_ew_add_switcher(
			'isf_price_single',
			array(
				'label'     => __( 'Price As Single Block', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'On', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'Off', 'motors-elementor-widgets' ),
				'default'   => '',
			)
		);

		$this->stm_ew_add_heading(
			'reset_btn_heading',
			array(
				'label' => __( 'Reset Button', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'reset_btn_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-reset',
				),
			)
		);

		$this->stm_ew_add_text(
			'reset_btn_label',
			array(
				'label'   => __( 'Label', 'motors-elementor-widgets' ),
				'default' => __( 'Reset All', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_heading(
			'isf_mobile_btn_results_text_heading',
			array(
				'label' => __( 'Mobile Result Button', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'isf_mobile_results_btn_text',
			array(
				'label'       => esc_html__( 'Button text', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Show' ) . ' {{total}}',
				'default'     => __( 'Show' ) . ' {{total}}' . __( ' Cars' ),
				'description' => __( 'Available replacement:' ) . ' {{total}}',
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'isf_general_section', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'isf_slider_range-color',
			array(
				'label'     => esc_html__( 'Range Slider Control Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row .ui-slider .ui-slider-range'        => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classic-filter-row .ui-slider .ui-slider-handle:after' => 'background-color: {{VALUE}};',
					'.classic-filter-row.mobile-filter-row .ui-slider .ui-slider-range'        => 'background-color: {{VALUE}};',
					'.classic-filter-row.mobile-filter-row .ui-slider .ui-slider-handle:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'isf_main_section', __( 'Main', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_heading(
			'isf_general_block',
			array(
				'label' => __( 'General', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_general_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > .filter-sidebar',
			)
		);

		$this->stm_ew_add_background(
			'isf_general_bg',
			array(
				'label'    => __( 'Background', 'motors-elementor-widgets' ),
				'types'    => array( 'classic', 'gradient', 'image' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar',
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_main_box_padding',
			array(
				'label'     => __( 'Box Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors' => array(
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar'                       => 'padding: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .row-pad-top-24'       => 'padding-top: {{TOP}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-entry-header' => 'margin-right: -{{RIGHT}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_heading(
			'isf_select_heading',
			array(
				'label'     => __( 'Field', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_start_ctrl_tabs(
			'isf_fields_style',
		);

		$this->stm_start_ctrl_tab(
			'isf_field_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_general_select_color',
			array(
				'label'     => esc_html__( 'Background color', 'motors-elementor-settings' ),
				'default'   => '#eceff3',
				'selectors' => array(
					'{{WRAPPER}} .filter-sidebar select' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .filter-sidebar input'  => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .filter-sidebar .select2-container--default .select2-selection--multiple' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_select_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b'  => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default .select2-selection--multiple'                            => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar select'                                                                              => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=text]'                                                                    => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=number]'                                                                  => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=search]'                                                                  => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar h5.pull-left'                                                                        => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_slider_text_color',
			array(
				'label'     => __( 'Field Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .stm-slider-filter-type-unit h5.pull-left'                                                                        => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .search-filter-form .filter-sidebar .stm-multiple-select.stm_additional_features h5'                                                                        => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_field_border',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered, #wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default .select2-selection--multiple, #wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar select, #wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=text]',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_field_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'   => array(
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default'                                                         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default .select2-selection--single'                              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default .select2-selection--multiple'                            => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar select'                                                                              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=text]'                                                                    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=number]'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=search]'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'isf_field_active',
			array(
				'label' => __( 'Active', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_general_select_color_active',
			array(
				'label'     => esc_html__( 'Background color', 'motors-elementor-settings' ),
				'default'   => '#eceff3',
				'selectors' => array(
					'{{WRAPPER}} .filter-sidebar select:focus' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .filter-sidebar input:focus'  => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .filter-sidebar .select2-container--default.select2-container--focus .select2-selection--single .select2-selection__rendered' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .filter-sidebar .select2-container--default.select2-container--focus .select2-selection--multiple'                            => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_select_text_color_active',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default.select2-container--focus .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .select2-container--default.select2-container--focus .select2-selection--multiple'                            => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar select:focus'                                                                                                 => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=text]:focus'                                                                                       => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=number]:focus'                                                                                     => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar input[type=search]:focus'                                                                                     => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_field_border_active',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .stm-pricing-plan__button:hover',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_field_border_radius_active',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'   => array(
					'{{WRAPPER}} .stm-pricing-plan__button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'   => 'after',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_heading(
			'isf_title_block',
			array(
				'label'     => __( 'Title Block', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_box_padding',
			array(
				'label'     => __( 'Box Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'    => '26',
					'right'  => '22',
					'bottom' => '21',
					'left'   => '22',
				),
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row .sidebar-entry-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row .sidebar-entry-header'                          => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classic-filter-row .stm-accordion-single-unit > a:not(.collapsed)' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .stm-filter-links .stm-accordion-single-unit > a:not(.collapsed)'   => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'isf_icon_size',
			array(
				'label'      => __( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 29,
				),
				'selectors'  => array(
					'{{WRAPPER}} .classic-filter-row .sidebar-entry-header i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classic-filter-row .sidebar-entry-header svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row .sidebar-entry-header i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classic-filter-row .sidebar-entry-header svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_title_text_color',
			array(
				'label'     => __( 'Title Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row .sidebar-entry-header .h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classic-filter-row .sidebar-entry-header-mobile .h4' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'isf_title_typography',
			array(
				'label'    => __( 'Title Text Style', 'stm_elementor_widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'text_transform',
					'text_decoration',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .classic-filter-row .sidebar-entry-header .h4',
			)
		);

		$this->stm_ew_add_heading(
			'isf_btn_heading',
			array(
				'label'     => __( 'Reset Button', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_btn_tabs' );

		$this->stm_start_ctrl_tab(
			'isf_btn_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_border(
			'isf_btn_border',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_btn_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '3',
					'right'    => '3',
					'bottom'   => '3',
					'left'     => '3',
					'isLinked' => true,
				),
				'selectors'   => array(
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#6c98e1',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_btn_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button',
			)
		);

		$this->stm_ew_add_color(
			'isf_btn_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'isf_btn_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_border(
			'isf_btn_border_hover',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button:hover',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_btn_border_radius_hover',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '3',
					'right'    => '3',
					'bottom'   => '3',
					'left'     => '3',
					'isLinked' => true,
				),
				'selectors'   => array(
					'#wrapper #main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_btn_bg_hover',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#6c98e1',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_btn_box_shadow_hover',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button:hover',
			)
		);

		$this->stm_ew_add_color(
			'isf_btn_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#main {{WRAPPER}} .classic-filter-row.motors-elementor-widget .filter-sidebar .sidebar-action-units a.button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_slider(
			'isf_reset_icon_size',
			array(
				'label'      => __( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 30,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 17,
				),
				'selectors'  => array(
					'{{WRAPPER}} .sidebar-action-units .button i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sidebar-action-units .button svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_reset_icon_margin',
			array(
				'label'     => __( 'Icon Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '0',
					'right'    => '6',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .sidebar-action-units .button i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .sidebar-action-units .button svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'isf_btn_typography',
			array(
				'label'          => __( 'Text Style', 'stm_elementor_widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .sidebar-action-units .button span',
			)
		);

		$this->stm_ew_add_align_flex(
			'text_align',
			array(
				'{{WRAPPER}} .sidebar-action-units .button' => 'justify-content: {{VALUE}};',
			),
			esc_html__( 'Text Alignment', 'motors-elementor-widgets' ),
			array(
				'default' => 'center',
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_button_padding',
			array(
				'label'     => __( 'Box Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'    => '17',
					'right'  => '28',
					'bottom' => '15',
					'left'   => '28',
				),
				'selectors' => array(
					'{{WRAPPER}} .sidebar-action-units .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();
		//secondary

		$this->stm_start_style_controls_section( 'isf_secondary_block_style', __( 'Secondary', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_box_shadow(
			'isf_secondary_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .stm-accordion-single-unit',
			)
		);

		$this->stm_ew_add_color(
			'isf_second_filter_border_color',
			array(
				'label'     => __( 'Top Border Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) a.title' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .stm-filter-links .stm-accordion-single-unit a.title'                                => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_second_label_color',
			array(
				'label'     => __( 'Label Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) a.title h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .stm-filter-links .stm-accordion-single-unit a.title h5'                                => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_second_label_bg_color',
			array(
				'label'     => __( 'Label Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) a.title' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stm-filter-links .stm-accordion-single-unit a.title'                                => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_heading(
			'isf_collapse_heading',
			array(
				'label'     => __( 'Collapse Indicatior Color', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_collapse_indicator' );

		$this->stm_start_ctrl_tab(
			'isf_collapse_indicator_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_collapse_indicator_bg',
			array(
				'label'     => __( 'Color', 'motors-elementor-widgets' ),
				'default'   => '#cccccc',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) a.title span'       => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) a.title span:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stm-filter-links .stm-accordion-single-unit a.title span'                                      => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stm-filter-links .stm-accordion-single-unit a.title span:after'                                => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'isf_collapse_indicator_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_collapse_indicator_hover_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#6c98e1',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) a.title:hover span'       => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) a.title:hover span:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stm-filter-links .stm-accordion-single-unit a.title:hover span'                                      => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stm-filter-links .stm-accordion-single-unit a.title:hover span:after'                                => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_color(
			'isf_checkbox_label_color',
			array(
				'label'       => __( 'Checkbox Label Color', 'motors-elementor-widgets' ),
				'description' => 'Used only if checked option in listing category (Use on listing archive as checkboxes)',
				'default'     => '#232628',
				'separator'   => 'before',
				'selectors'   => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-option-label span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_second_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar)',
			)
		);

		$this->stm_ew_add_background(
			'isf_second_bg',
			array(
				'label'    => __( 'Background', 'motors-elementor-widgets' ),
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar), {{WRAPPER}} .classic-filter-row.motors-elementor-widget .stm-filter-links .stm-accordion-single-unit .stm-accordion-content',
			)
		);

		$this->stm_ew_add_heading(
			'isf_pal_heading',
			array(
				'label'     => __( 'Params as Links', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_pal' );

		$this->stm_start_ctrl_tab(
			'isf_pal_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_pal_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .stm-filter-links .stm-accordion-content .list-style-3 li:before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_pal_link_color',
			array(
				'label'     => __( 'Link Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-filter-links .stm-accordion-content .list-style-3 li a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_pal_amount_color',
			array(
				'label'     => __( 'Amount Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-filter-links .stm-accordion-content .list-style-3 li a span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'isf_pal_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_pal_icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .stm-filter-links .stm-accordion-content .list-style-3 li:hover:before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_pal_link_color_hover',
			array(
				'label'     => __( 'Link Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-filter-links .stm-accordion-content .list-style-3 li a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_pal_amount_color_hover',
			array(
				'label'     => __( 'Amount Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-filter-links .stm-accordion-content .list-style-3 li a:hover span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_heading(
			'isf_secondary_field_heading',
			array(
				'label'     => __( 'Field', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_start_ctrl_tabs(
			'isf_secondary_field_style',
		);

		$this->stm_start_ctrl_tab(
			'isf_secondary_field_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_secondary_field_color',
			array(
				'label'     => esc_html__( 'Background color', 'motors-elementor-settings' ),
				'default'   => '#eceff3',
				'selectors' => array(
					'{{WRAPPER}} .stm-accordion-single-unit select' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stm-accordion-single-unit input'  => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_secondary_field_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit select'                                                                              => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=text]'                                                                    => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=number]'                                                                  => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=search]'                                                                  => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_secondary_field_border',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '#wrapper #main {{WRAPPER}} .stm-accordion-single-unit select, #wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=text]',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_secondary_field_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'   => array(
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit select'                                                                              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=text]'                                                                    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=number]'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=search]'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'isf_secondary_field_active',
			array(
				'label' => __( 'Active', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_secondary_field_color_active',
			array(
				'label'     => esc_html__( 'Background color', 'motors-elementor-settings' ),
				'default'   => '#eceff3',
				'selectors' => array(
					'{{WRAPPER}} .stm-accordion-single-unit select:focus' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stm-accordion-single-unit input:focus'  => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->stm_ew_add_color(
			'isf_secondary_field_text_color_active',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit select:focus'                                                                                                 => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=text]:focus'                                                                                       => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=number]:focus'                                                                                     => 'color: {{VALUE}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=search]:focus'                                                                                     => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_secondary_field_border_active',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '#wrapper #main {{WRAPPER}} .stm-accordion-single-unit select:focus, #wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=text]:focus',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_secondary_field_border_radius_active',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => true,
				),
				'selectors'   => array(
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit select:focus'                                                                              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=text]:focus'                                                                    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=number]:focus'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#wrapper #main {{WRAPPER}} .stm-accordion-single-unit input[type=search]:focus'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'   => 'after',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->second_apply_btn_settings();

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'isf_mobile_filter', __( 'Mobile Settings', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_divider(
			'isf_mobile_search_tbn_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_btn',
			array(
				'label' => __( 'Search Button', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_mobile_btn_tabs' );

		$this->add_control(
			'isf_mobile_btn_bg',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .mobile-filter .mobile-search-btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_mobile_btn_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .mobile-filter .mobile-search-btn',
			)
		);

		$this->add_control(
			'isf_mobile_btn_text_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#main {{WRAPPER}} .mobile-filter .mobile-search-btn .mobile-search-btn-text' => 'color: {{VALUE}};',
					'#main {{WRAPPER}} .mobile-filter .mobile-search-btn i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_select(
			'isf_mobile_btn_icon_position',
			array(
				'label'   => esc_html__( 'Icon Position', 'motors-elementor-widgets' ),
				'options' => array(
					'left'  => 'Left',
					'right' => 'Right',
				),
				'default' => 'left',
			)
		);

		$this->add_control(
			'isf_mobile_btn_icon_size',
			array(
				'label'      => __( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 30,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 17,
				),
				'selectors'  => array(
					'{{WRAPPER}} .mobile-filter .mobile-search-btn i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mobile-filter .mobile-search-btn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'isf_mobile_btn_typography',
			array(
				'label'          => __( 'Text Style', 'stm_elementor_widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .mobile-filter .mobile-search-btn .mobile-search-btn-text',
			)
		);

		$this->add_control(
			'isf_mobile_btn_padding',
			array(
				'label'     => __( 'Box Padding', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'default'   => array(
					'top'    => '17',
					'right'  => '28',
					'bottom' => '15',
					'left'   => '28',
				),
				'selectors' => array(
					'{{WRAPPER}} .mobile-filter .mobile-search-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_divider(
			'isf_mobile_search_filter_header_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_filter_heading',
			array(
				'label' => __( 'Search Filter Header', 'motors-elementor-widgets' ),
			)
		);
		$this->add_control(
			'isf_mobile_filter_heading_text_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => __( 'Search Heading Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .sidebar-entry-header-mobile .h4' => 'color: {{VALUE}};',
				),
				'default'   => '#232628',
			)
		);
		$this->add_control(
			'isf_mobile_filter_close_btn',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => __( 'Close Button Color', 'motors-elementor-widgets' ),
				'default'   => '#6c98e1',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .sidebar-entry-header-mobile .close-btn span.close-btn-item' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_divider(
			'isf_mobile_search_filter_header_bgr_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_bgr',
			array(
				'label' => __( 'Filter Background', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color_simple(
			'isf_mobile_filter_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#fffff',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter.filter-sidebar' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar), {{WRAPPER}} .mobile .stm-filter-links .stm-accordion-single-unit .stm-accordion-content' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .stm-filter-listing-directory-price .stm-accordion-single-unit.price' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .stm-filter-links .stm-accordion-single-unit' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .stm-filter-links .stm-accordion-single-unit .stm-accordion-content' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_divider(
			'isf_mobile_field_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_select_heading',
			array(
				'label'     => __( 'Fields settings', 'motors-elementor-widgets' ),
				'separator' => 'after',
			)
		);
		$this->stm_start_ctrl_tabs(
			'isf_mobile_fields_style',
		);

		$this->stm_start_ctrl_tab(
			'isf_mobile_field_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->add_control(
			'isf_mobile_general_select_color',
			array(
				'label'     => esc_html__( 'Background color', 'motors-elementor-settings' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar select' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar input'  => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar .select2-container--default .select2-selection--multiple' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_select_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__arrow b'  => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar .select2-container--default .select2-selection--multiple'                            => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar select'                                                                              => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar input[type=text]'                                                                    => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar input[type=number]'                                                                  => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar input[type=search]'                                                                  => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar h5.pull-left'                                                                        => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_slider_text_color',
			array(
				'label'     => __( 'Field Title Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar .stm-slider-filter-type-unit h5.pull-left'                                                                        => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .filter-sidebar .stm-multiple-select.stm_additional_features h5'                                                                        => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);

		$this->stm_ew_add_border(
			'isf_mobile_field_border',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered, .classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter-sidebar .select2-container--default .select2-selection--multiple, .classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter-sidebar select, .classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter-sidebar input[type=text]',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->add_control(
			'isf_mobile_field_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'   => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter.filter-sidebar .select2-container--default'                                                         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter.filter-sidebar .select2-container--default .select2-selection--single'                              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter.filter-sidebar .select2-container--default .select2-selection--single .select2-selection__rendered' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter.filter-sidebar .select2-container--default .select2-selection--multiple'                            => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter.filter-sidebar select'                                                                              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter.filter-sidebar input[type=text]'                                                                    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter.filter-sidebar input[type=number]'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile .filter.filter-sidebar input[type=search]'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'isf_mobile_field_active',
			array(
				'label' => __( 'Active', 'motors-elementor-widgets' ),
			)
		);

		$this->add_control(
			'isf_mobile_general_select_color_active',
			array(
				'label'     => esc_html__( 'Background color', 'motors-elementor-settings' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#eceff3',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile.mobile .filter-sidebar select:focus' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile.mobile .filter-sidebar input:focus'  => 'background-color: {{VALUE}} !important;',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile.mobile .filter-sidebar .select2-container--default.select2-container--focus .select2-selection--single .select2-selection__rendered' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.search-filter-form.mobile.mobile .filter-sidebar .select2-container--default.select2-container--focus .select2-selection--multiple'                            => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_select_text_color_active',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .filter-sidebar .select2-container--default.select2-container--focus .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .filter-sidebar .select2-container--default.select2-container--focus .select2-selection--multiple'                            => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .filter-sidebar select:focus'                                                                                                 => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .filter-sidebar input[type=text]:focus'                                                                                       => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .filter-sidebar input[type=number]:focus'                                                                                     => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .filter-sidebar input[type=search]:focus'                                                                                     => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_divider(
			'isf_mobile_reset_btn_divider',
		);

		$this->stm_ew_add_divider(
			'isf_mobile_secondary_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_secondary_heading',
			array(
				'label' => __( 'Secondary Block Settings', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color_simple(
			'isf_mobile_secondary_filter_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#fffff',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .search-filter-form.mobile .stm-accordion-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_second_filter_border_color',
			array(
				'label'     => __( 'Top Border Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#232628',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) a.title' => 'border-top-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-filter-links .stm-accordion-single-unit a.title'                                => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_second_label_color',
			array(
				'label'     => __( 'Label Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) a.title h5' => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-filter-links .stm-accordion-single-unit a.title h5'                                => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_second_label_bg_color',
			array(
				'label'     => __( 'Label Background Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) a.title' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-filter-links .stm-accordion-single-unit a.title'                                => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_divider(
			'isf_mobile_collapse_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_collapse_heading',
			array(
				'label' => __( 'Collapse Indicator', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_mobile_collapse_indicator' );

		$this->add_control(
			'isf_mobile_collapse_indicator_bg',
			array(
				'label'     => __( 'Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#cccccc',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) a.title span'       => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) a.title span:after' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-filter-links .stm-accordion-single-unit a.title span'                                      => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-filter-links .stm-accordion-single-unit a.title span:after'                                => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_divider(
			'isf_mobile_checkbox_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_checkbox_label_heading',
			array(
				'label' => __( 'Checkbox Label', 'motors-elementor-widgets' ),
			)
		);

		$this->add_control(
			'isf_mobile_checkbox_label_color',
			array(
				'label'       => __( 'Color', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'description' => 'Used only if checked option in listing category (Use on listing archive as checkboxes)',
				'default'     => '#232628',
				'selectors'   => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) .stm-accordion-content .stm-option-label span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_divider(
			'isf_mobile_pal_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_pal_heading',
			array(
				'label' => __( 'Params as Links', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_mobile_pal' );

		$this->add_control(
			'isf_mobile_pal_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#cc6119',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-filter-links .stm-accordion-content .list-style-3 li:before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_pal_link_color',
			array(
				'label'     => __( 'Link Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#232628',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-filter-links .stm-accordion-content .list-style-3 li a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_pal_amount_color',
			array(
				'label'     => __( 'Amount Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#232628',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-filter-links .stm-accordion-content .list-style-3 li a span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_divider(
			'isf_mobile_secondary_field_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_secondary_field_heading',
			array(
				'label' => __( 'Fields Settings', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_start_ctrl_tabs(
			'isf_mobile_secondary_field_style',
		);

		$this->stm_start_ctrl_tab(
			'isf_mobile_secondary_field_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->add_control(
			'isf_mobile_secondary_field_color',
			array(
				'label'     => esc_html__( 'Background color', 'motors-elementor-settings' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#eceff3',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit select' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input'  => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'isf_mobile_secondary_field_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit select'                                                                              => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=text]'                                                                    => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=number]'                                                                  => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=search]'                                                                  => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_mobile_secondary_field_border',
			array(
				'label'     => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector'  => '.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit select, .classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=text]',
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'isf_mobile_secondary_field_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'   => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit select'                                                                              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=text]'                                                                    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=number]'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=search]'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'isf_mobile_secondary_field_active',
			array(
				'label' => __( 'Active', 'motors-elementor-widgets' ),
			)
		);

		$this->add_control(
			'isf_mobile_secondary_field_color_active',
			array(
				'label'     => esc_html__( 'Background color', 'motors-elementor-settings' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#eceff3',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit select:focus' => 'background-color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .stm-accordion-single-unit input:focus'  => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'isf_mobile_secondary_field_text_color_active',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit select:focus'                                                                                                 => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=text]:focus'                                                                                       => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=number]:focus'                                                                                     => 'color: {{VALUE}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=search]:focus'                                                                                     => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_mobile_secondary_field_border_active',
			array(
				'label'     => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector'  => '.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit select:focus, .classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=text]:focus',
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'isf_mobile_secondary_field_border_radius_active',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'default'     => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'isLin
					ked'     => true,
				),
				'selectors'   => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit select:focus'                                                                              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=text]:focus'                                                                    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=number]:focus'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .stm-accordion-single-unit input[type=search]:focus'                                                                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_divider(
			'isf_mobile_apply_tbn_divider',
		);

		$this->stm_ew_add_heading(
			'isf_mobile_second_btn_heading',
			array(
				'label' => __( 'Apply Button', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_mobile_second_btn_tabs' );

		$this->add_control(
			'isf_mobile_second_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#6c98e1',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_mobile_second_btn_border',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->add_control(
			'isf_mobile_second_btn_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'selectors'   => array(
					'.classic-filter-row.motors-elementor-widget .search-filter-form .stm-accordion-single-unit.stm-listing-directory-checkboxes .stm-accordion-content .stm-accordion-content-wrapper .stm-accordion-inner .stm-checkbox-submit a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_mobile_second_btn_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button',
			)
		);

		$this->add_control(
			'isf_mobile_second_btn_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_group_typography(
			'isf_mobile_second_btn_typography',
			array(
				'label'          => __( 'Text Style', 'stm_elementor_widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button',
			)
		);

		$this->add_control(
			'isf_mobile_second_button_padding',
			array(
				'label'     => __( 'Box Padding', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'default'   => array(
					'top'    => '17',
					'right'  => '28',
					'bottom' => '15',
					'left'   => '28',
				),
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row form.mobile > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_divider( 'isf_mobile_sticky_panel' );
		$this->stm_ew_add_heading(
			'isf_mobile_sticky_panel_heading',
			array(
				'label' => __( 'Result buttons', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_mobile_sticky_panel_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#fffff',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget .search-filter-form.mobile .sticky-filter-actions' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_divider( 'isf_mobile_show_cars_btn' );
		$this->stm_ew_add_heading(
			'isf_mobile_show_cars_btn_heading',
			array(
				'label' => __( 'Show Results Button', 'motors-elementor-widgets' ),
			)
		);

		$this->add_control(
			'isf_mobile_show_cars_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#fffff',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .filter-show-cars .show-car-btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_mobile_show_cars_btn_border',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .filter-show-cars .show-car-btn',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->add_control(
			'isf_mobile_show_cars_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'selectors'   => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .filter-show-cars .show-car-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_show_cars_btn_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .filter-show-cars .show-car-btn',
			)
		);

		$this->stm_ew_add_group_typography(
			'isf_show_cars_typography',
			array(
				'label'          => __( 'Text Style', 'stm_elementor_widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .filter-show-cars .show-car-btn',
			)
		);

		$this->stm_ew_add_color(
			'isf_show_cars_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .filter-show-cars .show-car-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_show_cars_button_padding',
			array(
				'label'     => __( 'Box Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'    => '13',
					'right'  => '28',
					'bottom' => '13',
					'left'   => '28',
				),
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .filter-show-cars .show-car-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_divider( 'isf_mobile_reset_btn' );
		$this->stm_ew_add_heading(
			'isf_mobile_reset_btn_heading',
			array(
				'label'     => __( 'Reset Button', 'motors-elementor-widgets' ),
				'separator' => 'after',
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_mobile_reset_btn_tabs' );

		$this->stm_ew_add_border(
			'isf_mobile_reset_btn_border',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .reset-btn-mobile a.button',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->add_control(
			'isf_mobile_reset_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'default'     => array(
					'top'      => '3',
					'right'    => '3',
					'bottom'   => '3',
					'left'     => '3',
					'isLinked' => true,
				),
				'selectors'   => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .reset-btn-mobile a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'   => 'after',
			)
		);

		$this->add_control(
			'isf_mobile_reset_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#fffff',
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .reset-btn-mobile a.button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_mobile_reset_btn_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .reset-btn-mobile a.button',
			)
		);

		$this->add_control(
			'isf_mobile_reset_btn_text_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .mobile .sticky-filter-actions .reset-btn-mobile a.button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->add_control(
			'isf_mobile_reset_icon_size',
			array(
				'label'      => __( 'Icon Size', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 30,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 17,
				),
				'selectors'  => array(
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .sticky-filter-actions .reset-btn-mobile .button i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'.classic-filter-row.motors-elementor-widget.mobile-filter-row .sticky-filter-actions .reset-btn-mobile .button svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_end_control_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['search_options_icon'] = $this->stm_ew_get_rendered_icon( 'search_options_icon', $settings );
		$settings['reset_btn_icon']      = $this->stm_ew_get_rendered_icon( 'reset_btn_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/inventory-search-filter', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {

	}

	private function second_apply_btn_settings() {
		$this->stm_ew_add_heading(
			'isf_second_btn_heading',
			array(
				'label'     => __( 'Apply Button', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_start_ctrl_tabs( 'isf_second_btn_tabs' );

		$this->stm_start_ctrl_tab(
			'isf_second_btn_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_second_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#6c98e1',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_second_btn__border',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->add_control(
			'isf_second_btn_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'selectors'   => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_second_btn_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button',
			)
		);

		$this->stm_ew_add_color(
			'isf_second_btn_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'isf_second_btn_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'isf_second_btn_bg_hover',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#6c98e1',
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'isf_second_btn_border_hover',
			array(
				'label'    => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button:hover',
				'default'  => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
			)
		);

		$this->add_control(
			'isf_second_btn_border_radius_hover',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'selectors'   => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'isf_second_btn_box_shadow_hover',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button:hover',
			)
		);

		$this->stm_ew_add_color(
			'isf_second_btn_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_group_typography(
			'isf_second_btn_typography',
			array(
				'label'          => __( 'Text Style', 'stm_elementor_widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button',
			)
		);

		$this->stm_ew_add_dimensions(
			'isf_second_button_padding',
			array(
				'label'     => __( 'Box Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'    => '17',
					'right'  => '28',
					'bottom' => '15',
					'left'   => '28',
				),
				'selectors' => array(
					'{{WRAPPER}} .classic-filter-row.motors-elementor-widget form > div:not(.filter-sidebar) .stm-accordion-content .stm-accordion-inner a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
	}

	private function motors_selected_filters( $listing_type = null ) {

		$filter_fields = 'Fields for filter:';
		$filter_fields .= '<br /><br />';
		$filter_fields .= '<ul style="font-weight: 400;">';

		if ( is_null( $listing_type ) || 'listings' == $listing_type ) {

			$filters = stm_listings_attributes(
				array(
					'where'  => array( 'use_on_car_filter' => true ),
					'key_by' => 'slug',
				)
			);

			foreach ( $filters as $filter ) {
				$filter_fields .= '<li>&nbsp;- ' . $filter['single_name'] . '</li>';
			}
			$filter_fields .= '</ul>';

			$filter_fields .= '<br /><a href="' . admin_url( 'edit.php?post_type=listings&page=listing_categories' ) . '" target="_blank">' . esc_html__( 'Edit Listing Categories', 'motors-elementor-widgets' ) . '</a>';

		} else {

			$filters = Helper::stm_ew_multi_listing_search_filter_fields( $listing_type );

			foreach ( $filters as $key => $filter ) {
				$filter_fields .= '<li>&nbsp;- ' . $filter . '</li>';
			}
			$filter_fields .= '</ul>';

			$filter_fields .= '<br /><a href="' . admin_url( 'edit.php?post_type=' . $listing_type . '&page=' . $listing_type . '_categories' ) . '" target="_blank">' . esc_html__( 'Edit Listing Categories', 'motors-elementor-widgets' ) . '</a>';
		}

		return $filter_fields;
	}
}
