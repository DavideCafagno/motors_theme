<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\WidgetBase;

class ListingsCarousel extends WidgetBase {

	use ColorControl;
	use TextControl;
	use NumberControl;
	use SelectControl;
	use Select2Control;
	use SwitcherControl;
	use IconsControl;
	use SliderControl;
	use DimensionsControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

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
		return MotorsApp::STM_PREFIX . '-listings-carousel';
	}

	public function get_title() {
		return esc_html__( 'Listings Carousel', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-listings-carousel';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'carousel_title',
			array(
				'label'       => __( 'Title', 'motors-elementor-widgets' ),
				'placeholder' => __( 'Carousel title', 'motors-elementor-widgets' ),
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
				),
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
				'condition'        => array( 'show_all_link' => 'yes' ),
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

		$this->stm_ew_add_number(
			'items_per_view',
			array(
				'label'   => __( 'Listings Per View', 'motors-elementor-widgets' ),
				'min'     => 3,
				'max'     => 4,
				'step'    => 1,
				'default' => 3,
			)
		);

		$this->stm_ew_add_number(
			'slides_per_transition',
			array(
				'label'       => __( 'Slides Per Transition', 'motors-elementor-widgets' ),
				'min'         => 1,
				'step'        => 1,
				'default'     => 1,
				'description' => __( 'Set numbers of slides to define and enable group sliding', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'click_drag',
			array(
				'label'       => __( 'Click & Drag', 'motors-elementor-widgets' ),
				'description' => __( 'Accept mouse events like touch events (click and drag to change slides)', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'autoplay',
			array(
				'label' => __( 'Autoplay', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'loop',
			array(
				'label'     => __( 'Infinite Loop', 'motors-elementor-widgets' ),
				'condition' => array( 'autoplay' => 'yes' ),
			)
		);

		$this->stm_ew_add_number(
			'transition_speed',
			array(
				'label'       => __( 'Transition Speed', 'motors-elementor-widgets' ),
				'min'         => 100,
				'step'        => 100,
				'default'     => 300,
				'condition'   => array( 'autoplay' => 'yes' ),
				'description' => __( 'Duration of transition between slides (in ms)', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_number(
			'delay',
			array(
				'label'       => __( 'Slide Duration', 'motors-elementor-widgets' ),
				'min'         => 100,
				'step'        => 100,
				'default'     => 3000,
				'condition'   => array( 'autoplay' => 'yes' ),
				'description' => __( 'Delay between transitions (in ms)', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'pause',
			array(
				'label'       => __( 'Pause on Mouseover', 'motors-elementor-widgets' ),
				'condition'   => array( 'autoplay' => 'yes' ),
				'description' => __( 'When enabled autoplay will be paused on mouse enter over carousel container', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'reverse',
			array(
				'label'       => __( 'Reverse Direction', 'motors-elementor-widgets' ),
				'condition'   => array( 'autoplay' => 'yes' ),
				'description' => __( 'Enables autoplay in reverse direction', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'pagination',
			array(
				'label' => __( 'Pagination', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'navigation',
			array(
				'label' => __( 'Navigation', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_styles', __( 'General', 'motors-elementor-widgets' ) );

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
					'{{WRAPPER}} .stm-elementor_listings_carousel .all-listings i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-elementor_listings_carousel .all-listings svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'slc_title_color',
			array(
				'label'     => __( 'Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .stm-elementor_listings_carousel a.all-listings > span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'all_listings_link_icon_color',
			array(
				'label'     => __( 'Redirect Link Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel a.all-listings > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stm-elementor_listings_carousel a.all-listings > svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style_card', __( 'Listing Card', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'listing_listing_title',
			array(
				'label'     => __( 'Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .car-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_title_label',
			array(
				'label'     => __( 'Title Label Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .listing-car-item-meta .car-subtitle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_price_bg',
			array(
				'label'     => __( 'Price Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .swiper-slide .price, {{WRAPPER}} .stm-elementor_listings_carousel .swiper-slide .price:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'listing_price_box_padding',
			array(
				'label'       => __( 'Price Box Padding', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'   => array(
					'{{WRAPPER}} .listing-car-items .listing-car-item .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			),
		);

		$this->stm_ew_add_color(
			'listing_normal_price_text',
			array(
				'label'     => __( 'Normal Price Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .swiper-slide .price .sale-price, {{WRAPPER}} .stm-elementor_listings_carousel .swiper-slide .price .normal-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_regular_price_text',
			array(
				'label'     => __( 'Regular Price Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .swiper-slide .price.discounted-price .regular-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_meta_bg',
			array(
				'label'     => __( 'Meta Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .listing-car-item-meta' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_meta_line',
			array(
				'label'     => __( 'Meta Line Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .listing-car-item-meta .car-meta-top' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'listing_meta_box_padding',
			array(
				'label'       => __( 'Meta Box Padding', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'   => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .listing-car-items .listing-car-item .listing-car-item-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			),
		);

		$this->stm_ew_add_dimensions(
			'listing_meta_item_margin',
			array(
				'label'       => __( 'Category Margins', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'   => array(
					'{{WRAPPER}} .listing-car-items .listing-car-item .listing-car-item-meta .car-meta-bottom ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			),
		);

		$this->stm_ew_add_color(
			'listing_categorie_icons',
			array(
				'label'     => __( 'Category Icons Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .listing-car-item-meta .car-meta-bottom i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .stm-elementor_listings_carousel .listing-car-item-meta .car-meta-bottom svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_select(
			'listing_meta_icon_position',
			array(
				'label'   => __( 'Category Icons Position', 'motors-elementor-widgets' ),
				'default' => 'left',
				'options' => array(
					'left'  => __( 'Left', 'motors-elementor-widgets' ),
					'right' => __( 'Right', 'motors-elementor-widgets' ),
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_categorie_name',
			array(
				'label'     => __( 'Category Name Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .listing-car-item-meta .car-meta-bottom li > span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'listing_meta_label_font',
			array(
				'label'      => __( 'Category Name Font Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 40,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 14,
				),
				'selectors'  => array(
					'{{WRAPPER}} .listing-car-items .listing-car-item .listing-car-item-meta .car-meta-bottom ul li span' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_styles_nav', __( 'Navigation', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'slc_navigation_color',
			array(
				'label'     => __( 'Navigation Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .stm-swiper-controls .stm-swiper-next,
					{{WRAPPER}} .stm-elementor_listings_carousel .stm-swiper-controls .stm-swiper-prev' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'slc_navigation_hover_color',
			array(
				'label'     => __( 'Navigation Hover Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .stm-swiper-controls .stm-swiper-next:hover,
					{{WRAPPER}} .stm-elementor_listings_carousel .stm-swiper-controls .stm-swiper-prev:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'slc_pagination_color',
			array(
				'label'     => __( 'Pagination Bullets Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .stm-swiper-controls .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'slc_pagination_active_color',
			array(
				'label'     => __( 'Pagination Active Bullet Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor_listings_carousel .stm-swiper-controls .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/listings-carousel', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
