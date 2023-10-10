<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\WYSIWYGControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class HeroBanner extends WidgetBase {

	use HeadingControl;
	use SelectControl;
	use GroupTypographyControl;
	use WYSIWYGControl;
	use IconsControl;
	use TextControl;
	use ColorControl;
	use DimensionsControl;
	use SliderControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name() );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_CLASSIFIED );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-hero-banner';
	}

	public function get_title() {
		return esc_html__( 'Hero Banner', 'motors-elementor-widgets' );
	}

	public function get_script_depends() {
		return array( 'elementor-frontend', $this->get_admin_name(), $this->get_name(), 'stmselect2', 'app-select2' );
	}

	public function get_style_depends() {
		return array( $this->get_admin_name(), $this->get_name(), 'stmselect2', $this->get_name() . '-rtl' );
	}

	public function get_icon() {
		return 'stmew-add-listing';
	}

	public function register_controls() {
		$this->stm_start_content_controls_section( 'general', __( 'General', 'motors-elementor-widgets' ) );

		$this->add_control(
			'background_image',
			array(
				'label'   => esc_html__( 'Choose Image', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->stm_ew_add_select(
			'info_block_style',
			array(
				'label'   => __( 'Info Block Style', 'motors-elementor-widgets' ),
				'default' => 'style_1',
				'options' => array(
					'style_2' => __( 'Default', 'motors-elementor-widgets' ),
					'style_1' => __( 'Rounded content', 'motors-elementor-widgets' ),
					'style_3' => __( 'Rectangle content', 'motors-elementor-widgets' ),
				),
			)
		);

		$this->stm_ew_add_select(
			'info_block_position',
			array(
				'label'   => __( 'Info Block Position', 'motors-elementor-widgets' ),
				'default' => 'left',
				'options' => array(
					'left'  => __( 'Left', 'motors-elementor-widgets' ),
					'right' => __( 'Right', 'motors-elementor-widgets' ),
				),
			)
		);

		$this->stm_ew_add_text(
			'title',
			array(
				'label' => __( 'Title', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'price',
			array(
				'label'      => __( 'Price', 'motors-elementor-widgets' ),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
			),
		);

		$this->stm_ew_add_text(
			'per_month',
			array(
				'label'      => __( 'Per Month Title', 'motors-elementor-widgets' ),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
			),
		);

		$this->stm_ew_add_text(
			'period',
			array(
				'label'      => __( 'Period', 'motors-elementor-widgets' ),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
			),
		);

		$this->stm_ew_add_wysiwyg(
			'hb_content',
			array(
				'label' => __( 'Description', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'btn_link',
			array(
				'label' => __( 'Button Link', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'btn_title',
			array(
				'label' => __( 'Button Title', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'btn_icon',
			array(
				'label'            => __( 'Add Button Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-add_car',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style', esc_html__( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'title_typography',
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
				'selector'       => '{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-title',
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-title' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'two_first_color',
			array(
				'label'     => esc_html__( 'Title Two First Words Color', 'motors-elementor-widgets' ),
				'default'   => '#cc6119',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-title .stm-white' => 'color: {{VALUE}} !important;fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'price_block_margin',
			array(
				'label'      => __( 'Price Block Margin', 'motors-elementor-widgets' ),
				'default'    => array(
					'top'      => '36',
					'right'    => '0',
					'bottom'   => '26',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .container .stm-info-wrap .stm-hb-round .stm-hb-price-unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
			),
		);

		$this->stm_ew_add_dimensions(
			'description_block_margin',
			array(
				'label'      => __( 'Description Margin', 'motors-elementor-widgets' ),
				'default'    => array(
					'top'      => '26',
					'right'    => '0',
					'bottom'   => '26',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .container .stm-info-wrap .stm-hb-round .stm-hb-round-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '===',
							'value'    => 'style_3',
						),
					),
				),
			),
		);

		$this->stm_ew_add_group_typography(
			'currency_typography',
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
				'conditions'     => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-currency',
			)
		);

		$this->stm_ew_add_group_typography(
			'price_typography',
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
				'conditions'     => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-price',
			)
		);

		$this->stm_ew_add_color(
			'price_color',
			array(
				'label'      => esc_html__( 'Price Color', 'motors-elementor-widgets' ),
				'default'    => '#cc6119',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-price-unit .stm-hb-currency' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-price-unit .stm-hb-price'    => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'delimiter_month_typography',
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
				'conditions'     => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-divider',
			)
		);

		$this->stm_ew_add_dimensions(
			'delimiter_margin',
			array(
				'label'      => __( 'Delimiter Margin', 'motors-elementor-widgets' ),
				'default'    => array(
					'top'      => '',
					'right'    => '5',
					'bottom'   => '',
					'left'     => '10',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'label_typography',
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
				'conditions'     => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-labels .stm-hb-time-label',
			)
		);

		$this->stm_ew_add_group_typography(
			'period_typography',
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
				'conditions'     => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-time-value',
			)
		);

		$this->stm_ew_add_color(
			'month_color',
			array(
				'label'      => esc_html__( 'Per Month Color', 'motors-elementor-widgets' ),
				'default'    => '#ffffff',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_3',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-price-unit .stm-hb-divider' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-labels .stm-hb-time-label'  => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-labels .stm-hb-time-value'  => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'description_typography',
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
				'selector'       => '{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-round-text',
			)
		);

		$this->stm_ew_add_color(
			'description_color',
			array(
				'label'     => esc_html__( 'Description Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .stm-hb-round-text' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'button_text_typography',
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
				'selector'       => '{{WRAPPER}} .stm-hero-banner-wrap .container .stm-info-wrap .stm-hb-round .stm-button',
			)
		);

		$this->stm_ew_add_color(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .container .stm-info-wrap .stm-hb-round .stm-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'btn_icon_color',
			array(
				'label'     => esc_html__( 'Button Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .stm-hero-banner-wrap .container .stm-info-wrap .stm-hb-round .stm-button i' => 'color: {{VALUE}}; fill: {{VALUE}}; stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'button_icon_size',
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
					'{{WRAPPER}} .stm-hero-banner-wrap .container .stm-info-wrap .stm-hb-round .stm-button i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-hero-banner-wrap .container .stm-info-wrap .stm-hb-round .stm-button svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'button_padding',
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
					'{{WRAPPER}} .stm-hero-banner-wrap .container .stm-info-wrap .stm-hb-round .stm-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'info_block_border_color',
			array(
				'label'      => esc_html__( 'Info Block Border Color', 'motors-elementor-widgets' ),
				'default'    => 'rgba(255, 255, 255, 0.12)',
				'selectors'  => array(
					'{{WRAPPER}} .stm-hero-banner-wrap.style_1 .stm-info-wrap:after' => 'background: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '===',
							'value'    => 'style_1',
						),
					),
				),
			)
		);

		$this->stm_ew_add_color(
			'info_block_bg',
			array(
				'label'      => esc_html__( 'Info Block Background', 'motors-elementor-widgets' ),
				'default'    => 'rgba(204, 97, 25, 0.901961)',
				'selectors'  => array(
					'{{WRAPPER}} .stm-hero-banner-wrap.style_1 .stm-info-wrap .stm-hb-round:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .stm-hero-banner-wrap.style_3 .container .stm-info-wrap:after'    => 'background: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'info_block_style',
							'operator' => '!==',
							'value'    => 'style_2',
						),
					),
				),
			)
		);

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
					'{{WRAPPER}} .stm-hero-banner-wrap' => 'min-height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();

		$settings['btn_icon']   = $this->stm_ew_get_rendered_icon( 'btn_icon', $settings );
		$settings['bg_img_url'] = $settings['background_image']['url'];
		$settings['bg_img_id']  = $settings['background_image']['id'];

		Helper::stm_ew_load_template( 'widgets/hero-banner', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}
}
