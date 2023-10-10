<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBorderControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBoxShadowControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class WhatsApp extends WidgetBase {

	use HeadingControl;
	use TextControl;
	use IconsControl;
	use GroupTypographyControl;
	use DimensionsControl;
	use ColorControl;
	use GroupBoxShadowControl;
	use GroupBorderControl;
	use SliderControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
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
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-whatsapp';
	}

	public function get_title() {
		return esc_html__( 'WhatsApp', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-whatsapp';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'wa_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'wa_label',
			array(
				'label'   => __( 'Label', 'motors-elementor-widgets' ),
				'default' => __( 'CHAT VIA WHATSAPP', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'wa_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-whatsapp',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'wa_styles', __( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_start_ctrl_tabs( 'wa_btn_bg_style' );

		$this->stm_start_ctrl_tab(
			'wa_bg_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'wa_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'wa_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#45c655',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .whatsapp-btn svg'      => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'wa_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'wa_border_color',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'wa_box_shadow',
			array(
				'label'          => __( 'Box shadow', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'box_shadow_type' => array(
						'default' => 'yes',
					),
					'box_shadow'      => array(
						'default' => array(
							'horizontal' => 0,
							'vertical'   => 0,
							'blur'       => 7,
							'spread'     => 1,
							'color'      => 'rgba(0, 0, 0, 0.09)',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .whats-button-wrap .whatsapp .whatsapp-btn',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'wa_bg_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'wa_btn_bg_hover',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#f8f8f8',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'wa_icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#45c655',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn:hover i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .whatsapp-btn:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'wa_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'wa_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'wa_box_shadow_hover',
			array(
				'label'          => __( 'Box shadow', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'box_shadow_type' => array(
						'default' => 'yes',
					),
					'box_shadow'      => array(
						'default' => array(
							'horizontal' => 0,
							'vertical'   => 0,
							'blur'       => 7,
							'spread'     => 1,
							'color'      => 'rgba(0, 0, 0, 0.09)',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .whats-button-wrap .whatsapp .whatsapp-btn:hover',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_heading(
			'wa_btn_bg_after',
			array(
				'separator' => 'after',
			)
		);

		$this->stm_ew_add_group_typography(
			'wa_typography',
			array(
				'label'          => __( 'Typography', 'motors-elementor-widgets' ),
				'separator'      => 'before',
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'font_weight'    => array(
						'default' => '400',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 22,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .whatsapp-btn',
			)
		);

		$this->stm_ew_add_heading(
			'border_before',
			array(
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_border(
			'wa_border',
			array(
				'label'          => __( 'Border', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						),
					),
				),
				'exclude'        => array( 'color' ),
				'selector'       => '{{WRAPPER}} .whatsapp-btn',
			)
		);

		$this->stm_ew_add_dimensions(
			'wa_btn_border_radius',
			array(
				'label'     => __( 'Border Radius', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '5',
					'right'    => '5',
					'bottom'   => '5',
					'left'     => '5',
					'isLinked' => true,
				),
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_heading(
			'border_after',
			array(
				'separator' => 'after',
			)
		);

		$this->stm_ew_add_dimensions(
			'wa_btn_padding',
			array(
				'label'     => __( 'Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '13',
					'right'    => '17',
					'bottom'   => '13',
					'left'     => '17',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_heading(
			'icon_styles',
			array(
				'label'     => __( 'Icon', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_slider(
			'wa_icon_size',
			array(
				'label'      => __( 'Icon Size', 'motors-elementor-widgets' ),
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
					'size' => 26,
				),
				'selectors'  => array(
					'{{WRAPPER}} .whatsapp-btn i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .whatsapp-btn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'wa_icon_margin',
			array(
				'label'     => __( 'Icon Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '',
					'right'    => '17',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['wa_icon'] = $this->stm_ew_get_rendered_icon( 'wa_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/single-listing/whatsapp', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
