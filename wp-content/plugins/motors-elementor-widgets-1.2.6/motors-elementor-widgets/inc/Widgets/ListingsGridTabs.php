<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBorderControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class ListingsGridTabs extends WidgetBase {

	use TextControl;
	use SelectControl;
	use SwitcherControl;
	use Select2Control;
	use IconsControl;
	use NumberControl;
	use ColorControl;
	use GroupTypographyControl;
	use GroupBorderControl;
	use DimensionsControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( $this->get_name() );

	}

	public function get_style_depends(): array {
		return array( $this->get_name() );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-listings-grid-tabs';
	}

	public function get_title() {
		return esc_html__( 'Listings Grid Tabs', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-grid-view';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'Content', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'grid_title',
			array(
				'label'       => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Grid Title', 'motors-elementor-widgets' ),
				'default'     => esc_html__( 'New/Used Cars', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select_2(
			'listing_types',
			array(
				'label'    => esc_html__( 'Listing Types', 'motors-elementor-widgets' ),
				'default'  => 'listings',
				'multiple' => true,
				'options'  => Helper::stm_ew_get_multilisting_types( true ),
			)
		);

		$this->stm_ew_add_number(
			'listings_number',
			array(
				'label'       => esc_html__( 'Number Of Listings Per Tab', 'motors-elementor-widgets' ),
				'min'         => 1,
				'step'        => 1,
				'default'     => 8,
				'description' => esc_html__( 'Leave empty to show default number of listings', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_number(
			'listings_number_per_row',
			array(
				'label'       => esc_html__( 'Number Of Listings Per Row', 'motors-elementor-widgets' ),
				'min'         => 3,
				'max'         => 4,
				'step'        => 1,
				'default'     => 4,
				'description' => esc_html__( 'Leave empty to show default number of listings', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_all_link',
			array(
				'label'     => esc_html__( '"Show All" Button', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'Yes', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'No', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'show_all_link_text',
			array(
				'label'     => esc_html__( '"Show All" Button Text', 'motors-elementor-widgets' ),
				'default'   => esc_html__( 'Show All', 'motors-elementor-widgets' ),
				'condition' => array( 'show_all_link' => 'yes' ),
			)
		);

		$this->stm_ew_add_switcher(
			'include_popular',
			array(
				'label'     => esc_html__( 'Include Popular Listings', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'Yes', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'No', 'motors-elementor-widgets' ),
				'default'   => 'yes',
			)
		);

		$this->stm_ew_add_text(
			'popular_label',
			array(
				'label'     => esc_html__( 'Popular Tab Label', 'motors-elementor-widgets' ),
				'default'   => esc_html__( 'Popular items', 'motors-elementor-widgets' ),
				'condition' => array( 'include_popular' => 'yes' ),
			)
		);

		$this->stm_ew_add_switcher(
			'include_recent',
			array(
				'label'     => esc_html__( 'Include Recent Listings', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'Yes', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'No', 'motors-elementor-widgets' ),
				'default'   => 'yes',
			)
		);

		$this->stm_ew_add_text(
			'recent_label',
			array(
				'label'     => esc_html__( 'Recent Tab Label', 'motors-elementor-widgets' ),
				'default'   => esc_html__( 'Recent items', 'motors-elementor-widgets' ),
				'condition' => array( 'include_recent' => 'yes' ),
			)
		);

		$this->stm_ew_add_switcher(
			'include_featured',
			array(
				'label'     => esc_html__( 'Include Featured Listings', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'Yes', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'No', 'motors-elementor-widgets' ),
				'default'   => 'yes',
			)
		);

		$this->stm_ew_add_text(
			'featured_label',
			array(
				'label'     => esc_html__( 'Featured Tab Label', 'motors-elementor-widgets' ),
				'default'   => esc_html__( 'Featured items', 'motors-elementor-widgets' ),
				'condition' => array( 'include_featured' => 'yes' ),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'style_general', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'    => esc_html__( 'Title Typography', 'motors-elementor-widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap h3',
			)
		);

		$this->stm_ew_add_group_typography(
			'tab_typography',
			array(
				'label'    => esc_html__( 'Tab Typography', 'motors-elementor-widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li a',
			)
		);

		$this->stm_ew_add_dimensions(
			'tab_margin',
			array(
				'label'     => __( 'Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '7',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'tab_border',
			array(
				'label'          => esc_html__( 'Tab Border', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'dashed',
					),
					'width'  => array(
						'default' => array(
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '1',
							'left'     => '0',
							'isLinked' => false,
						),
					),
					'color'  => array(
						'default' => '#153e4d',
					),
				),
				'selector'       => '{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li:not(.active) a span',
			)
		);

		$this->stm_ew_add_dimensions(
			'border_padding',
			array(
				'label'     => __( 'Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li a span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'tab_border_border!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap h3' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_color(
			'border_top_color',
			array(
				'label'     => esc_html__( 'Border Top Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper {{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->stm_start_ctrl_tabs( 'tabs_style' );

		$this->stm_start_ctrl_tab(
			'tabs_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'tab_text_color',
			array(
				'label'     => esc_html__( 'Tab Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li:not(.active) a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'tab_background_color',
			array(
				'label'     => esc_html__( 'Tab Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li:not(.active) a' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'tabs_active',
			array(
				'label' => __( 'Active', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'tab_text_color_active',
			array(
				'label'     => esc_html__( 'Tab Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li.active a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'tab_background_color_active',
			array(
				'label'     => esc_html__( 'Tab Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li.active a'       => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .stm_elementor_listings_grid_tabs_wrap .stm_listing_nav_list li.active a:after' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_start_ctrl_tabs(
			'button_style',
			array(
				'condition' => array(
					'show_all_link' => 'yes',
				),
			)
		);

		$this->stm_start_ctrl_tab(
			'button_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .load-more-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_background_color',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .load-more-btn' => 'background-color: {{VALUE}};box-shadow: 0 2px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'button_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color_hover',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .load-more-btn:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_background_color_hover',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .load-more-btn:hover' => 'background-color: {{VALUE}};box-shadow: 0 2px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_end_control_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/listings-grid-tabs', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

}
