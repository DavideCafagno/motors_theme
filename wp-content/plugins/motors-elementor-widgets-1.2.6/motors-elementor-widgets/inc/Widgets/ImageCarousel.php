<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\GalleryControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\WidgetBase;

class ImageCarousel extends WidgetBase {

	use ColorControl;
	use TextControl;
	use SwitcherControl;
	use GalleryControl;
	use SelectControl;
	use NumberControl;

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
		return MotorsApp::STM_PREFIX . '-image-carousel';
	}

	public function get_title() {
		return esc_html__( 'Image Carousel', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-image-carousel';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_gallery(
			'images',
			array(
				'label'       => __( 'Carousel Images', 'motors-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$this->stm_ew_add_text(
			'image_size',
			array(
				'label'       => __( 'Image Size', 'motors-elementor-widgets' ),
				'placeholder' => __( '270x180', 'motors-elementor-widgets' ),
				'default'     => '270x180',
				'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select(
			'items_per_slide',
			array(
				'label'   => __( 'Number of Visible Items', 'motors-elementor-widgets' ),
				'default' => 4,
				'options' => array(
					6 => '6',
					5 => '5',
					4 => '4',
					3 => '3',
					2 => '2',
					1 => '1',
				),
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
			'lightbox',
			array(
				'label' => __( 'Lightbox', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'loop',
			array(
				'label' => __( 'Infinite Loop', 'motors-elementor-widgets' ),
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

		$this->stm_ew_add_number(
			'transition_speed',
			array(
				'label'       => __( 'Animation Speed', 'motors-elementor-widgets' ),
				'min'         => 100,
				'step'        => 100,
				'default'     => 300,
				'condition'   => array( 'autoplay' => 'yes' ),
				'description' => __( 'Speed of slide animation in milliseconds', 'motors-elementor-widgets' ),
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
				'description' => __( 'Delay between transitions in milliseconds', 'motors-elementor-widgets' ),
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

		$this->stm_start_style_controls_section( 'section_style', __( 'Styles', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'imgc_navigation_color',
			array(
				'label'     => __( 'Navigation Color', 'stm_elementor_widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_image_carousel .stm-swiper-controls .stm-swiper-next,
					{{WRAPPER}} .stm_image_carousel .stm-swiper-controls .stm-swiper-prev' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'imgc_navigation_hover_color',
			array(
				'label'     => __( 'Navigation Hover Color', 'stm_elementor_widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_image_carousel .stm-swiper-controls .stm-swiper-next:hover,
					{{WRAPPER}} .stm_image_carousel .stm-swiper-controls .stm-swiper-prev:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'imgc_pagination_color',
			array(
				'label'     => __( 'Pagination Bullets Color', 'stm_elementor_widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_image_carousel .stm-swiper-controls .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'imgc_pagination_active_color',
			array(
				'label'     => __( 'Pagination Active Bullet Color', 'stm_elementor_widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_image_carousel .stm-swiper-controls .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/image-carousel', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
