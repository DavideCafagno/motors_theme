<?php


namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\DividerControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBorderControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ListingSearchTabs extends WidgetBase {

	use HeadingControl;
	use TextControl;
	use ColorControl;
	use SwitcherControl;
	use IconsControl;
	use SelectControl;
	use Select2Control;
	use GroupTypographyControl;
	use GroupBorderControl;
	use SliderControl;
	use DividerControl;
	use DimensionsControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script(
			'stm-cascadingdropdown',
			get_template_directory_uri() . '/assets/js/jquery.cascadingdropdown.js',
			array( 'jquery' ),
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			'in_footer'
		);

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

		$this->stm_ew_enqueue(
			$this->get_name(),
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array(
				'elementor-frontend',
				'stmselect2',
				'app-select2',
				'stm-cascadingdropdown',
			)
		);

	}

	public function get_style_depends(): array {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'stmselect2';
		$widget_styles[] = 'app-select2';
		$widget_styles[] = 'stm-dynamic-listing-filter';
		$widget_styles[] = 'stm-dynamic-listing-filter-admin';

		return $widget_styles;
	}

	public function get_categories(): array {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name(): string {
		return MotorsApp::STM_PREFIX . '-listings-search-tabs';
	}

	public function get_title(): string {
		return esc_html__( 'Listings Search Tabs', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-listing-search-tabs';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'lst_fields_content', __( 'Form Fields', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'lst_amount',
			array(
				'label' => esc_html__( 'Listings Amount of Category', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'lst_taxonomy',
			array(
				'label'   => esc_html__( 'Category', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => Helper::stm_ew_get_car_filter_fields(),
			)
		);

		$repeater->add_control(
			'lst_label',
			array(
				'label' => esc_html__( 'Label', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'lst_placeholder',
			array(
				'label' => esc_html__( 'Placeholder', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_responsive_control(
			'lst_field_width',
			array(
				'label'           => esc_html__( 'Field width', 'motors-elementor-widgets' ),
				'type'            => \Elementor\Controls_Manager::SELECT,
				'options'         => array(
					'10'  => '10%',
					'15'  => '15%',
					'20'  => '20%',
					'25'  => '25%',
					'30'  => '30%',
					'33'  => '33%',
					'35'  => '35%',
					'40'  => '40%',
					'45'  => '45%',
					'50'  => '50%',
					'55'  => '55%',
					'60'  => '60%',
					'65'  => '65%',
					'70'  => '70%',
					'75'  => '75%',
					'80'  => '80%',
					'85'  => '85%',
					'90'  => '90%',
					'100' => '100%',
				),
				'desktop_default' => '25',
				'tablet_default'  => '50',
				'mobile_default'  => '100',
				'selectors'       => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}.stm-select-col' => 'width: {{VALUE}}%',
				),
			)
		);

		$this->add_control(
			'lst_taxonomies',
			array(
				'label'       => esc_html__( 'Fields', 'motors-elementor-widgets' ),
				'fields'      => $repeater->get_controls(),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ lst_label }}}',
			)
		);

		$this->stm_ew_add_switcher(
			'lst_advanced_search',
			array(
				'label'       => esc_html__( 'Use Advanced Search Mode', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'default'     => 'no',
				'description' => __( 'Hide optional fields and show it by clicking on special link', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'lst_advanced_search_label',
			array(
				'label'     => esc_html__( 'Advanced Search toggle label', 'motors-elementor-widgets' ),
				'default'   => esc_html__( 'Advanced Search', 'motors-elementor-widgets' ),
				'condition' => array(
					'lst_advanced_search' => 'yes',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_content_controls_section( 'lst_tabs_content', __( 'Search Tabs', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'lst_show_tabs',
			array(
				'label'   => esc_html__( 'Category Tabs', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_switcher(
			'lst_show_all_tab',
			array(
				'label'   => esc_html__( 'All Categories Tab', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_text(
			'lst_show_all_text',
			array(
				'label'   => esc_html__( 'All Categories Tab Title', 'motors-elementor-widgets' ),
				'default' => esc_html__( 'All', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select_2(
			'lst_condition_tabs',
			array(
				'label'    => esc_html__( 'Categories', 'motors-elementor-widgets' ),
				'options'  => Helper::stm_ew_get_listing_taxonomies( true ),
				'multiple' => true,
			)
		);

		$this->stm_ew_add_text(
			'tab_prefix',
			array(
				'label'       => __( 'Tab Prefix', 'motors-elementor-widgets' ),
				'description' => __( 'This will appear before category name', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'tab_suffix',
			array(
				'label'       => __( 'Tab Suffix', 'motors-elementor-widgets' ),
				'description' => __( 'This will appear after category name', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();

		if ( defined( 'STM_REVIEW' ) ) {

			$this->stm_start_content_controls_section( 'lst_section_reviews', esc_html__( 'Car Reviews Tab', 'motors-elementor-widgets' ) );

			$this->stm_ew_add_switcher(
				'lst_enable_reviews',
				array(
					'label'   => esc_html__( 'Show Car Reviews Tab', 'motors-elementor-widgets' ),
					'default' => 'yes',
				)
			);

			$reviews_repeater = new \Elementor\Repeater();

			$reviews_repeater->add_control(
				'lst_reviews_taxonomy',
				array(
					'label'   => esc_html__( 'Category', 'motors-elementor-widgets' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'options' => Helper::stm_ew_get_car_filter_fields(),
				)
			);

			$reviews_repeater->add_control(
				'lst_reviews_label',
				array(
					'label' => esc_html__( 'Label', 'motors-elementor-widgets' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$reviews_repeater->add_control(
				'lst_reviews_placeholder',
				array(
					'label' => esc_html__( 'Placeholder', 'motors-elementor-widgets' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$reviews_repeater->add_responsive_control(
				'lst_field_width',
				array(
					'label'           => esc_html__( 'Field width', 'motors-elementor-widgets' ),
					'type'            => \Elementor\Controls_Manager::SELECT,
					'options'         => array(
						'10'  => '10%',
						'15'  => '15%',
						'20'  => '20%',
						'25'  => '25%',
						'30'  => '30%',
						'33'  => '33%',
						'35'  => '35%',
						'40'  => '40%',
						'45'  => '45%',
						'50'  => '50%',
						'55'  => '55%',
						'60'  => '60%',
						'65'  => '65%',
						'70'  => '70%',
						'75'  => '75%',
						'80'  => '80%',
						'85'  => '85%',
						'90'  => '90%',
						'100' => '100%',
					),
					'desktop_default' => '25',
					'tablet_default'  => '50',
					'mobile_default'  => '100',
					'selectors'       => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}.stm-select-col' => 'width: {{VALUE}}%',
					),
				)
			);

			$this->add_control(
				'lst_reviews_taxonomies',
				array(
					'label'       => esc_html__( 'Fields', 'motors-elementor-widgets' ),
					'fields'      => $reviews_repeater->get_controls(),
					'type'        => \Elementor\Controls_Manager::REPEATER,
					'title_field' => '{{{ lst_reviews_label }}}',
				)
			);

			$this->stm_end_control_section();

		}

		if ( defined( 'STM_VALUE_MY_CAR' ) ) {

			$this->stm_start_content_controls_section( 'lst_section_value_my_car', esc_html__( 'Value My Car Tab', 'motors-elementor-widgets' ) );

			$this->stm_ew_add_switcher(
				'lst_enable_value_my_car',
				array(
					'label'   => esc_html__( 'Show Value My Car Tab', 'motors-elementor-widgets' ),
					'default' => 'yes',
				)
			);

			$this->stm_ew_add_select_2(
				'lst_value_my_car_fields',
				array(
					'label'       => esc_html__( 'Fields', 'motors-elementor-widgets' ),
					'options'     => Helper::stm_ew_get_value_my_car_options(),
					'multiple'    => true,
					'default'     => array( 'email', 'phone', 'make', 'model' ),
					'description' => esc_html__( 'Required fields: Email, Phone, Make and Model', 'motors-elementor-widgets' ),
				)
			);

			$this->stm_end_control_section();
		}

		$this->stm_start_content_controls_section( 'lst_btn_settings', esc_html__( 'Button', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'lst_btn_postfix',
			array(
				'label'   => esc_html__( 'Search button postfix', 'motors-elementor-widgets' ),
				'default' => esc_html__( 'Cars', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'lst_btn_icon',
			array(
				'label'            => esc_html__( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value'   => 'fas fa-search',
					'library' => 'fa-solid',
				),
			)
		);

		$this->stm_ew_add_slider(
			'lst_btn_icon_size',
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
					'lst_btn_icon[value]!' => '',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style_general', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .filter-listing .tab-content' => 'background: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);

		$this->stm_ew_add_border(
			'tab_border',
			array(
				'label'          => __( 'Tab Border', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '0',
							'right'    => '1',
							'bottom'   => '0',
							'left'     => '0',
							'isLinked' => false,
						),
					),
					'color'  => array(
						'default' => '#133340',
					),
				),
				'selector'       => '{{WRAPPER}} .stm_dynamic_listing_filter .stm_dynamic_listing_filter_nav li',
			)
		);

		$this->stm_ew_add_group_typography(
			'tab_typography',
			array(
				'label'          => esc_html__( 'Tab Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(),
				'selector'       => '{{WRAPPER}} .stm_dynamic_listing_filter_nav li a',
			)
		);

		$this->stm_start_ctrl_tabs( 'tab_style' );

		$this->stm_start_ctrl_tab(
			'tab_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'tab_background_color',
			array(
				'label'     => esc_html__( 'Tab Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_filter_nav li:not(.active)' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'tab_text_color',
			array(
				'label'     => esc_html__( 'Tab Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_filter_nav li a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'tab_active',
			array(
				'label' => __( 'Active', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'tab_background_color_active',
			array(
				'label'     => esc_html__( 'Tab Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_filter_nav li.active' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'tab_text_color_active',
			array(
				'label'     => esc_html__( 'Tab Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_dynamic_listing_filter_nav li.active a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_slider(
			'lst_advanced_search_label_font_size',
			array(
				'label'      => esc_html__( 'Advanced Search toggle font size', 'motors-elementor-widgets' ),
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
					'size' => 13,
				),
				'selectors'  => array(
					'{{WRAPPER}} .filter-listing.stm_dynamic_listing_filter .tab-content .stm-filter-tab-selects .stm-show-more .show-extra-fields'   => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'lst_advanced_search' => 'yes',
				),
			)
		);

		$this->stm_start_ctrl_tabs( 'lst_advanced_search_label_style' );

		$this->stm_start_ctrl_tab(
			'lst_advanced_search_label_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'lst_advanced_search_label_color',
			array(
				'label'     => esc_html__( 'Advanced Search toggle label color', 'motors-elementor-widgets' ),
				'default'   => '#888888',
				'selectors' => array(
					'{{WRAPPER}} .filter-listing.stm_dynamic_listing_filter .tab-content .stm-filter-tab-selects .stm-show-more .show-extra-fields' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'lst_advanced_search_label_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'lst_advanced_search_label_color_hover',
			array(
				'label'     => esc_html__( 'Advanced Search toggle label color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .filter-listing.stm_dynamic_listing_filter .tab-content .stm-filter-tab-selects .stm-show-more .show-extra-fields:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

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
					'{{WRAPPER}} .filter-listing .tab-content button[type=submit]' => 'background: {{VALUE}};box-shadow: 0 2px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper {{WRAPPER}} .filter-listing .tab-content button[type=submit]' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .filter-listing .tab-content form button[type=submit]:hover' => 'background: {{VALUE}};box-shadow: 0 2px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color_hover',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper {{WRAPPER}} .filter-listing .tab-content form button[type=submit]:hover' => 'color: {{VALUE}};',
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

		$this->stm_ew_add_color(
			'validation_issues_color',
			array(
				'label'     => esc_html__( 'Validation Issues Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'#wrapper {{WRAPPER}} .filter-listing.stm_dynamic_listing_filter .tab-content .stm-filter-tab-selects .vmc-file-wrap .file-wrap .error' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['__button_icon_html__'] = $this->stm_ew_get_rendered_icon( 'lst_btn_icon', $settings );

		wp_deregister_style( 'stm-dynamic-listing-filter-admin' );

		Helper::stm_ew_load_template( 'widgets/listings-search-tabs', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

}
