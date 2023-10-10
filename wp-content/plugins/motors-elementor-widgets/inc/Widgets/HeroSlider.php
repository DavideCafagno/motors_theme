<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\ContentControls\WYSIWYGControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;


class HeroSlider extends WidgetBase {

	use HeadingControl;
	use SelectControl;
	use GroupTypographyControl;
	use WYSIWYGControl;
	use IconsControl;
	use TextControl;
	use ColorControl;
	use DimensionsControl;
	use SliderControl;
	use SwitcherControl;
	use NumberControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue(
			self::get_name(),
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array(
				'swiper',
				'elementor-frontend',
			)
		);
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_CLASSIFIED );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-hero-slider';
	}

	public function get_title() {
		return esc_html__( 'Hero Slider', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-listings-carousel';
	}

	public function register_controls() {

		$this->stm_start_content_controls_section( 'general', __( 'General', 'motors-elementor-widgets' ) );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slide_style',
			array(
				'label'   => __( 'Slide Style', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_2' => __( 'Default', 'motors-elementor-widgets' ),
					'style_1' => __( 'Rounded content', 'motors-elementor-widgets' ),
					'style_3' => __( 'Rectangle content', 'motors-elementor-widgets' ),
				),
			)
		);

		$repeater->add_control(
			'background_image',
			array(
				'label'   => esc_html__( 'Choose Image', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'info_block_position',
			array(
				'label'   => __( 'Info Block Position', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'   => __( 'Left', 'motors-elementor-widgets' ),
					'center' => __( 'Center', 'motors-elementor-widgets' ),
					'right'  => __( 'Right', 'motors-elementor-widgets' ),
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label' => __( 'Title', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'price',
			array(
				'label'      => __( 'Price', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'slide_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
			),
		);

		$repeater->add_control(
			'per_month',
			array(
				'label'      => __( 'Per Month Title', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'slide_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
			),
		);

		$repeater->add_control(
			'period',
			array(
				'label'      => __( 'Period', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'slide_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
			),
		);

		$repeater->add_control(
			'hb_content',
			array(
				'label' => __( 'Description', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			)
		);

		$repeater->add_control(
			'btn_link',
			array(
				'label' => __( 'Button Link', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'btn_title',
			array(
				'label' => __( 'Button Title', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'btn_icon',
			array(
				'label'            => __( 'Add Button Icon', 'motors-elementor-widgets' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
			)
		);

		$this->add_control(
			'slides',
			array(
				'label'       => esc_html__( 'Slides', 'motors-elementor-widgets' ),
				'fields'      => $repeater->get_controls(),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
			),
		);

		$this->stm_ew_add_switcher(
			'navigation',
			array(
				'label'   => __( 'Previous/Next Buttons', 'motors-elementor-widgets' ),
				'default' => 'yes',
			),
		);

		$this->stm_ew_add_switcher(
			'loop',
			array(
				'label'   => __( 'Infinite Loop', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_number(
			'transition_speed',
			array(
				'label'       => __( 'Animation Speed', 'motors-elementor-widgets' ),
				'min'         => 100,
				'step'        => 100,
				'default'     => 400,
				'description' => __( 'Speed of slide animation in milliseconds', 'motors-elementor-widgets' ),
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
			'delay',
			array(
				'label'       => __( 'Slide Duration', 'motors-elementor-widgets' ),
				'min'         => 100,
				'step'        => 100,
				'default'     => 3000,
				'condition'   => array(
					'autoplay' => 'yes',
				),
				'description' => __( 'Delay between transitions in milliseconds', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'pause_on_mouseover',
			array(
				'label'       => __( 'Pause on Mouseover', 'motors-elementor-widgets' ),
				'condition'   => array(
					'autoplay' => 'yes',
				),
				'description' => __( 'When enabled autoplay will be paused on mouse enter over carousel container', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style_common', esc_html__( 'Common', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_slider(
			'slider_height',
			array(
				'label'      => esc_html__( 'Slider Height', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 200,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'desktop_default'    => array(
					'unit' => 'px',
					'size' => 600,
				),
				'mobile_default' => array(
					'unit' => 'px',
					'size' => 400,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-hero-slider-wrap' => 'min-height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style_2', esc_html__( 'Default style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'style_2_title_typography',
			array(
				'label'          => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 20,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-title',
			)
		);

		$this->stm_ew_add_color(
			'style_2_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-title' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_2_two_first_color',
			array(
				'label'     => esc_html__( 'Title Two First Words Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-title .stm-white' => 'color: {{VALUE}} !important;fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'style_2_price_block_margin',
			array(
				'label'     => __( 'Price Block Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '36',
					'right'    => '0',
					'bottom'   => '26',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .container .stm-info-wrap .stm-hb-round .stm-hb-price-unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			),
		);

		$this->stm_ew_add_group_typography(
			'style_2_currency_typography',
			array(
				'label'          => esc_html__( 'Currency', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 50,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-currency',
			)
		);

		$this->stm_ew_add_group_typography(
			'style_2_price_typography',
			array(
				'label'          => esc_html__( 'Price', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'text_transform',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 106,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => - 6,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-price',
			)
		);

		$this->stm_ew_add_color(
			'style_2_price_color',
			array(
				'label'     => esc_html__( 'Price Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-price-unit .stm-hb-currency' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-price-unit .stm-hb-price'    => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_2_delimiter_month_typography',
			array(
				'label'          => esc_html__( 'Delimiter Month', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'text_transform',
					'word_spacing',
					'line_height',
					'letter_spacing',
				),
				'fields_options' => array(
					'font_size' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 50,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-divider',
			)
		);

		$this->stm_ew_add_dimensions(
			'style_2_delimiter_margin',
			array(
				'label'     => __( 'Delimiter Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '',
					'right'    => '5',
					'bottom'   => '',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_2_label_typography',
			array(
				'label'          => esc_html__( 'Month', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 50,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-labels .stm-hb-time-label',
			)
		);

		$this->stm_ew_add_group_typography(
			'style_2_period_typography',
			array(
				'label'          => esc_html__( 'Period', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 16,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-time-value',
			)
		);

		$this->stm_ew_add_color(
			'style_2_month_color',
			array(
				'label'     => esc_html__( 'Per Month Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-price-unit .stm-hb-divider' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-labels .stm-hb-time-label'  => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-labels .stm-hb-time-value'  => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_2_description_typography',
			array(
				'label'          => esc_html__( 'Description', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 11,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-round-text',
			)
		);

		$this->stm_ew_add_color(
			'style_2_description_color',
			array(
				'label'     => esc_html__( 'Description Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .stm-hb-round-text' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_2_button_text_typography',
			array(
				'label'          => esc_html__( 'Button Text', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'letter_spacing',
				),
				'fields_options' => array(
					'font_size'   => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'line_height' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_2 .container .stm-info-wrap .stm-hb-round .stm-button',
			)
		);

		$this->stm_ew_add_color(
			'style_2_btn_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .container .stm-info-wrap .stm-hb-round .stm-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_2_btn_icon_color',
			array(
				'label'     => esc_html__( 'Button Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .container .stm-info-wrap .stm-hb-round .stm-button i' => 'color: {{VALUE}}; fill: {{VALUE}}; stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'style_2_button_icon_size',
			array(
				'label'      => esc_html__( 'Button Icon Size', 'motors-elementor-widgets' ),
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
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .container .stm-info-wrap .stm-hb-round .stm-button i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .container .stm-info-wrap .stm-hb-round .stm-button svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'style_2_button_padding',
			array(
				'label'     => __( 'Button Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '17',
					'right'    => '28',
					'bottom'   => '15',
					'left'     => '28',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_2 .container .stm-info-wrap .stm-hb-round .stm-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style_1', esc_html__( 'Rounded content', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'style_1_title_typography',
			array(
				'label'          => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 20,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap .stm-hb-title',
			)
		);

		$this->stm_ew_add_color(
			'style_1_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-title' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_1_two_first_color',
			array(
				'label'     => esc_html__( 'Title Two First Words Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-title .stm-white' => 'color: {{VALUE}} !important;fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'style_1_price_block_margin',
			array(
				'label'     => __( 'Price Block Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '36',
					'right'    => '0',
					'bottom'   => '26',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .container .stm-info-wrap .stm-hb-round .stm-hb-price-unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			),
		);

		$this->stm_ew_add_group_typography(
			'style_1_currency_typography',
			array(
				'label'          => esc_html__( 'Currency', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 50,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-currency',
			)
		);

		$this->stm_ew_add_group_typography(
			'style_1_price_typography',
			array(
				'label'          => esc_html__( 'Price', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'text_transform',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 106,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => - 6,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-price',
			)
		);

		$this->stm_ew_add_color(
			'style_1_price_color',
			array(
				'label'     => esc_html__( 'Price Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-price-unit .stm-hb-currency' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-price-unit .stm-hb-price'    => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_1_delimiter_month_typography',
			array(
				'label'          => esc_html__( 'Delimiter Month', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'text_transform',
					'word_spacing',
					'line_height',
					'letter_spacing',
				),
				'fields_options' => array(
					'font_size' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 50,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-divider',
			)
		);

		$this->stm_ew_add_dimensions(
			'style_1_delimiter_margin',
			array(
				'label'     => __( 'Delimiter Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '',
					'right'    => '5',
					'bottom'   => '',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_1_label_typography',
			array(
				'label'          => esc_html__( 'Month', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 50,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-labels .stm-hb-time-label',
			)
		);

		$this->stm_ew_add_group_typography(
			'style_1_period_typography',
			array(
				'label'          => esc_html__( 'Period', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 16,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-time-value',
			)
		);

		$this->stm_ew_add_color(
			'style_1_month_color',
			array(
				'label'     => esc_html__( 'Per Month Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-price-unit .stm-hb-divider' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-labels .stm-hb-time-label'  => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-labels .stm-hb-time-value'  => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_1_description_typography',
			array(
				'label'          => esc_html__( 'Description', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 11,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-round-text',
			)
		);

		$this->stm_ew_add_color(
			'style_1_description_color',
			array(
				'label'     => esc_html__( 'Description Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-hb-round-text' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_1_button_text_typography',
			array(
				'label'          => esc_html__( 'Button Text', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'letter_spacing',
				),
				'fields_options' => array(
					'font_size'   => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'line_height' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_1 .container .stm-info-wrap .stm-hb-round .stm-button',
			)
		);

		$this->stm_ew_add_color(
			'style_1_btn_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .container .stm-info-wrap .stm-hb-round .stm-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_1_btn_icon_color',
			array(
				'label'     => esc_html__( 'Button Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .container .stm-info-wrap .stm-hb-round .stm-button i' => 'color: {{VALUE}}; fill: {{VALUE}}; stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'style_1_button_icon_size',
			array(
				'label'      => esc_html__( 'Button Icon Size', 'motors-elementor-widgets' ),
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
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .container .stm-info-wrap .stm-hb-round .stm-button i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .container .stm-info-wrap .stm-hb-round .stm-button svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'style_1_button_padding',
			array(
				'label'     => __( 'Button Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '17',
					'right'    => '28',
					'bottom'   => '15',
					'left'     => '28',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .container .stm-info-wrap .stm-hb-round .stm-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_1_info_block_border_color',
			array(
				'label'     => esc_html__( 'Info Block Border Color', 'motors-elementor-widgets' ),
				'default'   => 'rgba(255, 255, 255, 0.12)',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-info-wrap:after' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_1_info_block_bg',
			array(
				'label'     => esc_html__( 'Info Block Background', 'motors-elementor-widgets' ),
				'default'   => 'rgba(204, 97, 25, 0.901961)',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_1 .stm-info-wrap .stm-hb-round:after' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style_3', esc_html__( 'Rectangle content', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'style_3_title_typography',
			array(
				'label'          => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 20,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_3 .stm-hb-title',
			)
		);

		$this->stm_ew_add_color(
			'style_3_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .stm-hb-title' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_3_two_first_color',
			array(
				'label'     => esc_html__( 'Title Two First Words Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .stm-hb-title .stm-white' => 'color: {{VALUE}} !important;fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'style_3_description_block_margin',
			array(
				'label'     => __( 'Description Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '26',
					'right'    => '0',
					'bottom'   => '26',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .container .stm-info-wrap .stm-hb-round .stm-hb-round-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			),
		);

		$this->stm_ew_add_group_typography(
			'style_3_description_typography',
			array(
				'label'          => esc_html__( 'Description', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 11,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
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
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_3 .stm-hb-round-text',
			)
		);

		$this->stm_ew_add_color(
			'style_3_description_color',
			array(
				'label'     => esc_html__( 'Description Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .stm-hb-round-text' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'style_3_button_text_typography',
			array(
				'label'          => esc_html__( 'Button Text', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
					'letter_spacing',
				),
				'fields_options' => array(
					'font_size'   => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'line_height' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-slider-wrap.style_3 .container .stm-info-wrap .stm-hb-round .stm-button',
			)
		);

		$this->stm_ew_add_color(
			'style_3_btn_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .container .stm-info-wrap .stm-hb-round .stm-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_3_btn_icon_color',
			array(
				'label'     => esc_html__( 'Button Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .container .stm-info-wrap .stm-hb-round .stm-button i' => 'color: {{VALUE}}; fill: {{VALUE}}; stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'style_3_button_icon_size',
			array(
				'label'      => esc_html__( 'Button Icon Size', 'motors-elementor-widgets' ),
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
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .container .stm-info-wrap .stm-hb-round .stm-button i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .container .stm-info-wrap .stm-hb-round .stm-button svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'style_3_button_padding',
			array(
				'label'     => __( 'Button Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '17',
					'right'    => '28',
					'bottom'   => '15',
					'left'     => '28',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .container .stm-info-wrap .stm-hb-round .stm-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'style_3_info_block_bg',
			array(
				'label'     => esc_html__( 'Info Block Background', 'motors-elementor-widgets' ),
				'default'   => 'rgba(204, 97, 25, 0.901961)',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-slider-wrap.style_3 .container .stm-info-wrap:after'    => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/hero-slider', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}
}
