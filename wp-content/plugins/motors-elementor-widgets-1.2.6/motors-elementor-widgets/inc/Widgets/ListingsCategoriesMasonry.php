<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\MediaControl;
use STM_E_W\Widgets\Controls\StyleControls\AlignControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ListingsCategoriesMasonry extends WidgetBase {

	use Select2Control;
	use SwitcherControl;
	use NumberControl;
	use SliderControl;
	use AlignControl;
	use TextControl;
	use NumberControl;
	use ColorControl;
	use MediaControl;
	use GroupTypographyControl;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue(
			$this->get_name(),
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array(
				'swiper',
				'elementor-frontend',
			)
		);

		/**
		 * this script contains both slider and ordinary logic
		 * it is needed for the edit page
		 */
		$this->stm_ew_admin_register_ss(
			$this->get_name() . '-admin',
			$this->get_name() . '-admin',
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array(
				'swiper',
				'elementor-frontend',
			)
		);

	}


	public function get_style_depends(): array {
		return array( $this->get_name() );
	}

	public function get_script_depends() {
		return array(
			$this->get_name(),
			$this->get_name() . '-admin',
		);
	}

	public function get_categories(): array {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name(): string {
		return MotorsApp::STM_PREFIX . '-listings-categories-masonry';
	}

	public function get_title(): string {
		return esc_html__( 'Listing Categories Masonry', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-grid-view';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$listing_categories = stm_listings_attributes();

		if ( ! empty( $listing_categories ) ) {
			$listing_categories_arr = array();
			foreach ( $listing_categories as $category ) {
				if ( ! $category['numeric'] ) {
					array_push( $listing_categories_arr, $category );
				}
			}
			$listing_categories = array_column( $listing_categories_arr, 'single_name', 'slug' );
		}

		$this->stm_ew_add_text(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Browse by Type' ),
				'default'     => __( 'Browse by <span class="stm-secondary-color">Category</span>' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'taxonomy_type',
			array(
				'label'   => esc_html__( 'Select Parameter', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'options' => $listing_categories,
			)
		);

		foreach ( $listing_categories as $item => $value ) {
			$repeater->add_control(
				'item_' . $item,
				array(
					'label'     => esc_html( $value ),
					'type'      => \Elementor\Controls_Manager::SELECT2,
					'options'   => Helper::stm_ew_get_listing_taxonomy_terms( $item ),
					'condition' => array(
						'taxonomy_type' => $item,
					),
				)
			);
		}

		$repeater->add_control(
			'image',
			array(
				'label' => esc_html__( 'Image', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'items',
			array(
				'label'  => esc_html__( 'Items', 'motors-elementor-widgets' ),
				'fields' => $repeater->get_controls(),
				'type'   => \Elementor\Controls_Manager::REPEATER,
			)
		);

		$this->stm_ew_add_switcher(
			'show_as_carousel',
			array(
				'label'   => esc_html__( 'Carousel', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_switcher(
			'loop',
			array(
				'label'     => __( 'Infinite Loop', 'motors-elementor-widgets' ),
				'condition' => array(
					'show_as_carousel' => 'yes',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'click_drag',
			array(
				'label'       => __( 'Click & Drag', 'motors-elementor-widgets' ),
				'description' => __( 'Accept mouse events like touch events (click and drag to change slides)', 'motors-elementor-widgets' ),
				'condition'   => array(
					'show_as_carousel' => 'yes',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'navigation',
			array(
				'label'     => __( 'Navigation', 'motors-elementor-widgets' ),
				'condition' => array(
					'show_as_carousel' => 'yes',
				),
				'default'   => 'yes',
			)
		);

		$this->stm_ew_add_switcher(
			'autoplay',
			array(
				'label'     => __( 'Autoplay', 'motors-elementor-widgets' ),
				'condition' => array(
					'show_as_carousel' => 'yes',
				),
			)
		);

		$this->stm_ew_add_number(
			'transition_speed',
			array(
				'label'       => __( 'Animation Speed', 'motors-elementor-widgets' ),
				'min'         => 100,
				'step'        => 100,
				'default'     => 300,
				'description' => __( 'Speed of slide animation in milliseconds', 'motors-elementor-widgets' ),
				'condition'   => array(
					'show_as_carousel' => 'yes',
					'autoplay'         => 'yes',
				),
			)
		);

		$this->stm_ew_add_number(
			'delay',
			array(
				'label'       => __( 'Slide Duration', 'motors-elementor-widgets' ),
				'min'         => 100,
				'step'        => 100,
				'default'     => 3000,
				'condition'   => array(
					'autoplay'         => 'yes',
					'show_as_carousel' => 'yes',
				),
				'description' => __( 'Delay between transitions in milliseconds', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'pause_on_mouseover',
			array(
				'label'       => __( 'Pause on Mouseover', 'motors-elementor-widgets' ),
				'condition'   => array(
					'autoplay'         => 'yes',
					'show_as_carousel' => 'yes',
				),
				'description' => __( 'When enabled autoplay will be paused on mouse enter over carousel container', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'reverse',
			array(
				'label'       => __( 'Reverse Direction', 'motors-elementor-widgets' ),
				'condition'   => array(
					'autoplay'         => 'yes',
					'show_as_carousel' => 'yes',
				),
				'description' => __( 'Enables autoplay in reverse direction', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_color', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'          => esc_html__( 'Title Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_transform',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units'     => array(
							'px',
							'em',
						),
						'default'        => array(
							'unit' => 'px',
							'size' => 26,
						),
						'tablet_default' => array(
							'unit' => 'px',
							'size' => 20,
						),
						'mobile_default' => array(
							'unit' => 'px',
							'size' => 16,
						),
					),
					'line_height'    => array(
						'size_units'     => array(
							'px',
							'em',
						),
						'default'        => array(
							'unit' => 'px',
							'size' => 32,
						),
						'tablet_default' => array(
							'unit' => 'px',
							'size' => 22,
						),
						'mobile_default' => array(
							'unit' => 'px',
							'size' => 18,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
				),
				'selector'       => '#wrapper {{WRAPPER}} .stm-image-filter-wrap .title h2',
			)
		);

		$this->stm_ew_add_group_typography(
			'item_title_typography',
			array(
				'label'    => esc_html__( 'Item Title Typography', 'motors-elementor-widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .stm-image-filter-wrap .carousel-container .img-filter-item .body-type-data .bt-title',
			)
		);

		$this->stm_ew_add_group_typography(
			'item_count_typography',
			array(
				'label'    => esc_html__( 'Item Count Typography', 'motors-elementor-widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .stm-image-filter-wrap .carousel-container .img-filter-item .body-type-data .bt-count',
			)
		);

		$this->stm_ew_add_color(
			'item_color',
			array(
				'label'     => esc_html__( 'Item Font Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-image-filter-wrap .stm-img-4 .carousel-container .img-filter-item .body-type-data .bt-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stm-image-filter-wrap .stm-img-4 .carousel-container .img-filter-item .body-type-data .bt-count' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'item_color_hover',
			array(
				'label'     => esc_html__( 'Item Font Color on Hover', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-image-filter-wrap .stm-img-4 .carousel-container .img-filter-item:hover .body-type-data .bt-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stm-image-filter-wrap .stm-img-4 .carousel-container .img-filter-item:hover .body-type-data .bt-count' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'navigation_background_color',
			array(
				'label'     => esc_html__( 'Navigation Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .carousel-nav-prev' => 'background: {{VALUE}}',
					'{{WRAPPER}} .carousel-nav-next' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'navigation' => 'yes',
				),
			)
		);

		$this->stm_ew_add_color(
			'navigation_background_color_hover',
			array(
				'label'     => esc_html__( 'Navigation Background Color On Hover', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .carousel-nav-prev:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .carousel-nav-next:hover' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'navigation' => 'yes',
				),
			)
		);

		$this->stm_ew_add_color(
			'navigation_icon_color',
			array(
				'label'     => esc_html__( 'Navigation Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .carousel-nav-prev:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .carousel-nav-next:before' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'navigation' => 'yes',
				),
			)
		);

		$this->stm_ew_add_color(
			'navigation_icon_color_hover',
			array(
				'label'     => esc_html__( 'Navigation Icon Color On Hover', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .carousel-nav-prev:hover:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .carousel-nav-next:hover:before' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'navigation' => 'yes',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$is_edit = Helper::is_elementor_edit_mode();

		if ( ! $is_edit ) {
			wp_deregister_script( 'motors-listings-categories-masonry-admin' );
			wp_dequeue_script( 'motors-listings-categories-masonry-admin' );
			wp_enqueue_script( 'motors-listings-categories-masonry' );
		}
		Helper::stm_ew_load_template( 'widgets/listings-categories-masonry', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

}
