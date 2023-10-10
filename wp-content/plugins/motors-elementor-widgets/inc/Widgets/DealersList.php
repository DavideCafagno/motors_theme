<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\TextAreaControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\DividerControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class DealersList extends WidgetBase {

	use Select2Control;
	use TextAreaControl;
	use ColorControl;
	use TextControl;
	use IconsControl;
	use SliderControl;
	use GroupTypographyControl;
	use DividerControl;
	use DimensionsControl;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		//common admin style
		$this->stm_ew_admin_register_ss(
			'stm-dynamic-listing-filter-admin',
			'stm-dynamic-listing-filter-admin'
		);

		//common style
		$this->stm_ew_admin_register_ss(
			'stm-dynamic-listing-filter',
			'stm-dynamic-listing-filter'
		);

		//widgets style/script
		$this->stm_ew_enqueue( $this->get_name() );
	}

	public function get_script_depends(): array {
		return array( 'stmselect2', 'app-select2', $this->get_admin_name() );
	}

	public function get_style_depends(): array {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'stm-dynamic-listing-filter';
		$widget_styles[] = 'stm-dynamic-listing-filter-admin';
		$widget_styles[] = 'stmselect2';
		$widget_styles[] = 'app-select2';

		return $widget_styles;
	}

	public function get_categories(): array {
		return array( MotorsApp::WIDGET_CATEGORY_CLASSIFIED );
	}

	public function get_name(): string {
		return MotorsApp::STM_PREFIX . '-dealers-list';
	}

	public function get_title(): string {
		return esc_html__( 'Dealers List', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-dealer-list';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', __( 'Content', 'motors-elementor-widgets' ) );

		$listing_categories = stm_listings_attributes();

		if ( ! empty( $listing_categories ) ) {
			$listing_categories = array_column( $listing_categories, 'single_name', 'slug' );
		}

		if ( ! in_array( 'location', $listing_categories, true ) ) {
			$listing_categories['location'] = esc_html__( 'Location', 'motors-elementor-widgets' );
		}

		$listing_categories['keyword'] = esc_html__( 'Keyword', 'motors-elementor-widgets' );

		$this->stm_ew_add_select_2(
			'filter_categories',
			array(
				'label'    => esc_html__( 'Select Categories', 'motors-elementor-widgets' ),
				'options'  => $listing_categories,
				'multiple' => true,
			)
		);

		$this->stm_ew_add_select_2(
			'dealer_category_fields',
			array(
				'label'    => esc_html__( 'Dealer Fields', 'motors-elementor-widgets' ),
				'options'  => Helper::get_listing_options(),
				'multiple' => true,
			)
		);

		$this->stm_ew_add_text(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'motors-elementor-widgets' ),
				'placeholder' => __( 'Enter Button Text', 'motors-elementor-widgets' ),
				'default'     => __( 'Find Dealer ', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'button_icon',
			array(
				'label'   => esc_html__( 'Button Icon', 'motors-elementor-widgets' ),
				'skin'    => 'inline',
				'default' => array(
					'value'   => 'fas fa-search',
					'library' => 'fa-solid',
				),
			)
		);

		$this->stm_ew_add_slider(
			'button_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} form button[type="submit"] > i'   => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} form button[type="submit"] > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_icon[value]!' => '',
				),
			)
		);

		$this->end_controls_section();

		$this->stm_start_style_controls_section( 'section_style_general', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_dealer_filter .tab-content' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_start_ctrl_tabs( 'button_style' );

		$this->stm_start_ctrl_tab(
			'btn_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'button_background_color',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_dealer_filter .tab-content button[type=submit]' => 'background: {{VALUE}};box-shadow: 0 2px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_dealer_filter .tab-content button[type=submit]' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'btn_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'button_background_color_hover',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_dealer_filter .tab-content form button[type=submit]:hover' => 'background: {{VALUE}};box-shadow: 0 2px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color_hover',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_dealer_filter .tab-content form button[type=submit]:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_divider( 'buttons_style_sep' );

		$this->stm_ew_add_group_typography(
			'button_typography',
			array(
				'label'          => esc_html__( 'Button Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(),
				'selector'       => '{{WRAPPER}} form button[type=submit]',
			)
		);

		$this->stm_ew_add_dimensions(
			'button_icon_margin',
			array(
				'label'     => __( 'Button Icon Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '0',
					'right'    => '6',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} form button[type=submit] i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} form button[type=submit] svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['button_icon_html'] = $this->stm_ew_get_rendered_icon( 'button_icon', $settings );

		wp_deregister_style( 'stm-dynamic-listing-filter-admin' );

		Helper::stm_ew_load_template( 'widgets/dealers-list', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}
}
