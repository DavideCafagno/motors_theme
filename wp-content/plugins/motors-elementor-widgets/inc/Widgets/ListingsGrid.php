<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ListingsGrid extends WidgetBase {

	use ColorControl;
	use TextControl;
	use SelectControl;
	use SwitcherControl;
	use Select2Control;
	use IconsControl;
	use NumberControl;
	use SliderControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-listings-grid';
	}

	public function get_title() {
		return esc_html__( 'Listings Grid', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-grid-view';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'grid_title',
			array(
				'label'       => __( 'Title', 'motors-elementor-widgets' ),
				'placeholder' => __( 'Grid title', 'motors-elementor-widgets' ),
			)
		);

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
			'show_all_link',
			array(
				'label' => __( 'Redirect Link to Search Results', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'link_icon',
			array(
				'label'            => __( 'Link Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
			)
		);

		$this->stm_ew_add_text(
			'link_text',
			array(
				'label'       => __( 'Search Results Link Label', 'motors-elementor-widgets' ),
				'placeholder' => __( 'Link label', 'motors-elementor-widgets' ),
				'default'     => __( 'View all', 'motors-elementor-widgets' ),
				'condition'   => array( 'show_all_link' => 'yes' ),
			)
		);

		$this->stm_ew_add_text(
			'search_results_link',
			array(
				'label'       => __( 'Search Results Link', 'motors-elementor-widgets' ),
				'placeholder' => __( 'Link URL', 'motors-elementor-widgets' ),
				'condition'   => array( 'show_all_link' => 'yes' ),
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

		$this->stm_ew_add_select(
			'view_style',
			array(
				'label'   => __( 'View Style', 'motors-elementor-widgets' ),
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 1', 'motors-elementor-widgets' ),
					'style_2' => __( 'Style 2', 'motors-elementor-widgets' ),
					'style_3' => __( 'Style 3', 'motors-elementor-widgets' ),
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_styles', __( 'Styles', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_slider(
			'svg_width',
			array(
				'label'      => __( 'Link Icon Size', 'motors-elementor-widgets' ),
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
					'size' => 27,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .all-listings i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-elementor_listings_grid .all-listings svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'slc_title_color',
			array(
				'label'     => __( 'Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'slc_title_line_color',
			array(
				'label'     => __( 'Title Line Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .colored-separator div' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'all_listings_link_text_color',
			array(
				'label'     => __( 'Redirect Link Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid a.all-listings > span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'all_listings_link_icon_color',
			array(
				'label'     => __( 'Redirect Link Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid a.all-listings > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .stm-elementor_listings_grid a.all-listings > svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_meta_bg',
			array(
				'label'     => __( 'Listing Meta Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .listing-car-item-meta' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_meta_line',
			array(
				'label'     => __( 'Listing Meta Line Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .listing-car-item-meta .car-meta-top' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_price_bg',
			array(
				'label'     => __( 'Listing Price Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .price, {{WRAPPER}} .stm-elementor_listings_grid .price:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_normal_price_text',
			array(
				'label'     => __( 'Listing Normal Price Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .price .sale-price, {{WRAPPER}} .stm-elementor_listings_grid .price .normal-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_regular_price_text',
			array(
				'label'     => __( 'Listing Regular Price Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .price.discounted-price .regular-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_listing_title',
			array(
				'label'     => __( 'Listing Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .car-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_title_label',
			array(
				'label'     => __( 'Listing Title Label Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .listing-car-item-meta .car-subtitle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_categorie_icons',
			array(
				'label'     => __( 'Listing Category Icons Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .listing-car-item-meta .car-meta-bottom i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .stm-elementor_listings_grid .listing-car-item-meta .car-meta-bottom svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_categorie_name',
			array(
				'label'     => __( 'Listing Category Name Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_grid .listing-car-item-meta .car-meta-bottom li > span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/listings-grid', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
