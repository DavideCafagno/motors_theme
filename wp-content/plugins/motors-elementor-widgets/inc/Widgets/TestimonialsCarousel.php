<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\GalleryControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class TestimonialsCarousel extends WidgetBase {

	use ColorControl;
	use TextControl;
	use SwitcherControl;
	use GalleryControl;
	use SelectControl;
	use GroupTypographyControl;
	use NumberControl;
	use SliderControl;

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
		return MotorsApp::STM_PREFIX . '-testimonials-carousel';
	}

	public function get_title() {
		return esc_html__( 'Testimonials Carousel', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-testimonials';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', __( 'Genral', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_select(
			'view_style',
			array(
				'label'       => __( 'View Style', 'motors-elementor-widgets' ),
				'default'     => 'style_1',
				'label_block' => true,
				'options'     => array(
					'style_1' => __( 'Style 1', 'motors-elementor-widgets' ),
					'style_2' => __( 'Style 2', 'motors-elementor-widgets' ),
				),
			)
		);

		$this->stm_ew_add_select(
			'desktop_items',
			array(
				'label'       => __( 'Number of Items on Desktop', 'motors-elementor-widgets' ),
				'description' => __( 'Minimum width: 1024px.', 'motors-elementor-widgets' ),
				'default'     => 1,
				'label_block' => true,
				'options'     => array(
					3 => __( '3 items', 'motors-elementor-widgets' ),
					2 => __( '2 items', 'motors-elementor-widgets' ),
					1 => __( '1 item', 'motors-elementor-widgets' ),
				),
			)
		);

		$this->stm_ew_add_select(
			'tablet_items',
			array(
				'label'       => __( 'Number of Items on Tablet', 'motors-elementor-widgets' ),
				'description' => __( 'Minimum width: 768px.', 'motors-elementor-widgets' ),
				'default'     => 1,
				'label_block' => true,
				'options'     => array(
					3 => __( '3 items', 'motors-elementor-widgets' ),
					2 => __( '2 items', 'motors-elementor-widgets' ),
					1 => __( '1 item', 'motors-elementor-widgets' ),
				),
			)
		);

		$this->stm_ew_add_text(
			'image_size',
			array(
				'label'       => __( 'Image Size', 'motors-elementor-widgets' ),
				'placeholder' => __( '213x142', 'motors-elementor-widgets' ),
				'default'     => '213x142',
				'label_block' => true,
				'condition'   => array( 'view_style' => 'style_1' ),
				'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'loop',
			array(
				'label' => __( 'Infinite Loop', 'motors-elementor-widgets' ),
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
				'label'   => __( 'Autoplay', 'motors-elementor-widgets' ),
				'default' => 'yes',
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
			'navigation',
			array(
				'label'   => __( 'Navigation', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_select(
			'title_heading',
			array(
				'label'   => __( 'Title Heading', 'motors-elementor-widgets' ),
				'default' => 'h4',
				'options' => array(
					'h1' => __( 'Heading 1', 'motors-elementor-widgets' ),
					'h2' => __( 'Heading 2', 'motors-elementor-widgets' ),
					'h3' => __( 'Heading 3', 'motors-elementor-widgets' ),
					'h4' => __( 'Heading 4', 'motors-elementor-widgets' ),
					'h5' => __( 'Heading 5', 'motors-elementor-widgets' ),
					'h6' => __( 'Heading 6', 'motors-elementor-widgets' ),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			array(
				'label' => esc_html__( 'Image', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Vestibulum laoreet eu lorem vel tempor',
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label'      => esc_html__( 'Content', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'show_label' => false,
				'default'    => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros. Fusce non orci vitae eros porta consequat non at ante. Etiam et ligula quam. In condimentum ex nec sapien luctus pulvinar. Curabitur quis leo quis ex aliquam interdum.</p>',
			)
		);

		$repeater->add_control(
			'author_name',
			array(
				'label'   => esc_html__( 'Author name', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'John Doe',
			)
		);

		$repeater->add_control(
			'author_position',
			array(
				'label'   => esc_html__( 'Author Position', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Driver',
			)
		);

		$repeater->add_control(
			'vehicle_model',
			array(
				'label'   => esc_html__( 'Author Vehicle Model', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Tesla',
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'Vehicle Icon', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'skin'    => 'inline',
				'default' => array(
					'value'   => 'fas fa-rocket',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'testimonials',
			array(
				'label'       => esc_html__( 'Testimonials', 'motors-elementor-widgets' ),
				'fields'      => $repeater->get_controls(),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'           => 'Vestibulum laoreet eu lorem vel tempor',
						'content'         => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros. Fusce non orci vitae eros porta consequat non at ante. Etiam et ligula quam. In condimentum ex nec sapien luctus pulvinar. Curabitur quis leo quis ex aliquam interdum.</p>',
						'author_name'     => 'John Doe',
						'author_position' => 'Driver',
						'vehicle_model'   => 'Toyota',
						'icon'            => array(
							'value'   => 'fas fa-layer-group',
							'library' => 'fa-solid',
						),
					),
					array(
						'title'           => 'Pellentesque non turpis ut est',
						'content'         => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros. Fusce non orci vitae eros porta consequat non at ante. Etiam et ligula quam. In condimentum ex nec sapien luctus pulvinar. Curabitur quis leo quis ex aliquam interdum.</p>',
						'author_name'     => 'Alice Smart',
						'author_position' => 'Manager',
						'vehicle_model'   => 'BMW',
						'icon'            => array(
							'value'   => 'fas fa-gift',
							'library' => 'fa-solid',
						),
					),
					array(
						'title'           => 'Nam condimentum pellentesque augue',
						'content'         => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros. Fusce non orci vitae eros porta consequat non at ante. Etiam et ligula quam. In condimentum ex nec sapien luctus pulvinar. Curabitur quis leo quis ex aliquam interdum.</p>',
						'author_name'     => 'Robert Frost',
						'author_position' => 'Teacher',
						'vehicle_model'   => 'Chevrolet',
						'icon'            => array(
							'value'   => 'fas fa-rocket',
							'library' => 'fa-solid',
						),
					),
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_styles', __( 'Styles', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_slider(
			'border_top_size',
			array(
				'label'      => __( 'Top border size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-testimonials-carousel-wrapper' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'border_top_color',
			array(
				'label'     => __( 'Top border color', 'motors-elementor-widgets' ),
				'default'   => '#ddd',
				'selectors' => array(
					'{{WRAPPER}} .stm-testimonials-carousel-wrapper' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'border_bottom_size',
			array(
				'label'      => __( 'Bottom border size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-testimonials-carousel-wrapper' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'border_bottom_color',
			array(
				'label'     => __( 'Bottom border color', 'motors-elementor-widgets' ),
				'default'   => '#ddd',
				'selectors' => array(
					'{{WRAPPER}} .stm-testimonials-carousel-wrapper' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'testimonials_title_color',
			array(
				'label'     => __( 'Title Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .content .title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'testimonials_content_color',
			array(
				'label'     => __( 'Content Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'testimonials_author_color',
			array(
				'label'     => __( 'Author Name Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .author_name,
					{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .testimonial-meta .author' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'testimonials_author_position_color',
			array(
				'label'     => __( 'Author Position Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .author_position' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'testimonials_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit i.stm-testimonial-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'testimonials_navigation_color',
			array(
				'label'     => __( 'Navigation Color', 'stm_elementor_widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-testimonials-carousel-wrapper .stm-swiper-controls .stm-swiper-next,
					{{WRAPPER}} .stm-testimonials-carousel-wrapper .stm-swiper-controls .stm-swiper-prev' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'testimonials_navigation_hover_color',
			array(
				'label'     => __( 'Navigation Hover Color', 'stm_elementor_widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-testimonials-carousel-wrapper .stm-swiper-controls .stm-swiper-next:hover,
					{{WRAPPER}} .stm-testimonials-carousel-wrapper .stm-swiper-controls .stm-swiper-prev:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_typography', __( 'Typography', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'testimonials_title_typography',
			array(
				'label'    => __( 'Title Text Style', 'motors-elementor-widgets' ),
				'exclude'  => array(
					'font_style',
					'text_decoration',
				),
				'selector' => '{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .content .title',
			)
		);

		$this->stm_ew_add_group_typography(
			'testimonials_content_typography',
			array(
				'label'    => __( 'Content Text Style', 'motors-elementor-widgets' ),
				'exclude'  => array(
					'font_style',
					'text_decoration',
				),
				'selector' => '{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .content',
			)
		);

		$this->stm_ew_add_group_typography(
			'testimonials_author_typography',
			array(
				'label'    => __( 'Author Name Text Style', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .author_name,
				{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .testimonial-meta .author',
			)
		);

		$this->stm_ew_add_group_typography(
			'testimonials_author_position_typography',
			array(
				'label'    => __( 'Author Position Text Style', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .elementor-testimonials-carousel .testimonial-unit .author_position',
			)
		);

		$this->stm_ew_add_group_typography(
			'testimonials_author_vehicle_typography',
			array(
				'label'    => __( 'Author Vehicle Model Text Style', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .elementor-testimonials-carousel .author-car > span',
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/testimonials-carousel', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
