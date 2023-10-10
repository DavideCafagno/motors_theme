<?php

namespace Motors_E_W\Widgets\SingleListing\Classified;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBorderControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBoxShadowControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class UserDataAdvanced extends WidgetBase {

	use TextControl;
	use IconsControl;
	use SwitcherControl;
	use ColorControl;
	use HeadingControl;
	use GroupTypographyControl;
	use GroupBoxShadowControl;
	use GroupBorderControl;
	use DimensionsControl;
	use SliderControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-user-data-advanced';
	}

	public function get_title() {
		return esc_html__( 'User Data Advanced', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-user-info';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'ud_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'ud_show_phone',
			array(
				'label'     => __( 'Phone', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'On', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'Off', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'ud_dpn_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-service-icon-sales_phone',
				),
				'condition'        => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_text(
			'ud_dpn_show_number',
			array(
				'label'     => __( 'Show Number Label', 'motors-elementor-widgets' ),
				'default'   => __( 'Show Number', 'motors-elementor-widgets' ),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_switcher(
			'ud_show_full_phone',
			array(
				'label'     => __( 'Full Phone', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'On', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'Off', 'motors-elementor-widgets' ),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_switcher(
			'ud_show_email',
			array(
				'label'     => __( 'Email', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'On', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'Off', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'ud_de_label',
			array(
				'label'     => __( 'Label', 'motors-elementor-widgets' ),
				'default'   => __( 'Message To Dealer', 'motors-elementor-widgets' ),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_icons(
			'ud_de_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'fas fa-envelope',
				),
				'condition'        => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_switcher(
			'ud_show_whatsapp',
			array(
				'label'     => __( 'WhatsApp', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'On', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'Off', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'ud_wa_label',
			array(
				'label'     => __( 'Label', 'motors-elementor-widgets' ),
				'default'   => __( 'CHAT VIA WHATSAPP', 'motors-elementor-widgets' ),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_icons(
			'ud_wa_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-whatsapp',
				),
				'condition'        => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_switcher(
			'ud_show_location',
			array(
				'label'     => __( 'Location', 'motors-elementor-widgets' ),
				'label_on'  => esc_html__( 'On', 'motors-elementor-widgets' ),
				'label_off' => esc_html__( 'Off', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'ud_location_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-service-icon-pin_2',
				),
				'condition'        => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_end_control_section();

		$this->get_general_settings();

		$this->get_phone_settings();

		$this->get_whatsapp_settings();

		$this->get_email_settings();

		$this->get_location_settings();
	}

	private function get_general_settings() {
		$this->stm_start_style_controls_section( 'ud_general_styles', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'ud_general_user_name_color',
			array(
				'label'     => __( 'User Name Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-listing-car-dealer-info .title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'ud_general_user_name_typography',
			array(
				'label'          => __( 'User Name Typography', 'motors-elementor-widgets' ),
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
							'size' => 16,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 32,
						),
					),
					'text_transform' => array(
						'default' => 'capitalize',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-listing-car-dealer-info .title',
			)
		);

		$this->stm_ew_add_color(
			'ud_general_user_role_color',
			array(
				'label'       => __( 'User Role Color', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'Only for User Role Subscriber', 'motors-elementor-widgets' ),
				'default'     => '#888888',
				'selectors'   => array(
					'{{WRAPPER}} .stm-listing-car-dealer-info .stm-user-main-info-c .stm-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'ud_general_user_role_typography',
			array(
				'label'          => __( 'User Role Typography', 'motors-elementor-widgets' ),
				'description'    => esc_html__( 'Only for User Role Subscriber', 'motors-elementor-widgets' ),
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
							'size' => 13,
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
						'default' => 'capitalize',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-listing-car-dealer-info .stm-user-main-info-c .stm-label',
			)
		);

		$this->stm_ew_add_color(
			'ud_review_amount_color',
			array(
				'label'       => __( 'Review Amount Color', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'Only for User Role Dealer', 'motors-elementor-widgets' ),
				'default'     => '#888888',
				'selectors'   => array(
					'{{WRAPPER}} .stm-listing-car-dealer-info .dealer-rating .stm-rate-sum' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'ud_general_divider_color',
			array(
				'label'     => __( 'Divider Color', 'motors-elementor-widgets' ),
				'default'   => '#888888',
				'selectors' => array(
					'{{WRAPPER}} .stm-listing-car-dealer-info .dealer-contacts' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	private function get_whatsapp_settings() {
		$this->stm_start_style_controls_section( 'ud_wa_styles', __( 'WhatsApp', 'motors-elementor-widgets' ) );

		$this->stm_start_ctrl_tabs( 'ud_wa_btn_bg_style' );

		$this->stm_start_ctrl_tab(
			'ud_wa_bg_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_wa_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_wa_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#153e4d',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_wa_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#45c655',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .whatsapp-btn svg'      => 'fill: {{VALUE}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_wa_border_color',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn' => 'border-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'ud_wa_box_shadow',
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
				'selector'       => '{{WRAPPER}} .whatsapp-btn',
				'condition'      => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'ud_wa_bg_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_wa_btn_bg_hover',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#f8f8f8',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_wa_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#153e4d',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn:hover' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_wa_icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#45c655',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn:hover i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .whatsapp-btn:hover svg'      => 'fill: {{VALUE}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_wa_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'ud_wa_box_shadow_hover',
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
				'selector'       => '{{WRAPPER}} .whatsapp-btn:hover',
				'condition'      => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_heading(
			'ud_wa_btn_bg_after',
			array(
				'separator' => 'after',
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_typography(
			'ud_wa_typography',
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
							'size' => 18,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .whatsapp-btn',
				'condition'      => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_wa_border_before',
			array(
				'separator' => 'before',
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_border(
			'ud_wa_border',
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
					'color'  => array(
						'default' => '#e0e3e7',
					),
				),
				'exclude'        => array( 'color' ),
				'selector'       => '{{WRAPPER}} .whatsapp-btn',
				'condition'      => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_wa_btn_border_radius',
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
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_wa_border_after',
			array(
				'separator' => 'after',
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_wa_btn_padding',
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
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_wa_icon_styles',
			array(
				'label'     => __( 'Icon', 'motors-elementor-widgets' ),
				'separator' => 'before',
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_slider(
			'ud_wa_icon_size',
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
				'condition'  => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_wa_icon_margin',
			array(
				'label'     => __( 'Icon Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '',
					'right'    => '17',
					'bottom'   => '',
					'left'     => '',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .whatsapp-btn i'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .whatsapp-btn svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_whatsapp' => 'yes' ),
			)
		);

		$this->stm_end_control_section();
	}

	private function get_email_settings() {
		$this->stm_start_style_controls_section( 'de_styles', __( 'Email', 'motors-elementor-widgets' ) );

		$this->stm_start_ctrl_tabs( 'de_btn_bg_style' );

		$this->stm_start_ctrl_tab(
			'ud_de_bg_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_de_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .email-btn' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_de_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .email-btn' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_de_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .email-btn i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .email-btn svg'      => 'fill: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_de_border_color',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .email-btn' => 'border-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'ud_de_box_shadow',
			array(
				'label'          => __( 'Box Shadow', 'motors-elementor-widgets' ),
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
				'selector'       => '{{WRAPPER}} .email-btn',
				'condition'      => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'ud_de_bg_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_de_btn_bg_hover',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'default'   => '#f8f8f8',
				'selectors' => array(
					'{{WRAPPER}} .email-btn:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_de_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .email-btn:hover' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_de_icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .email-btn:hover i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .email-btn:hover svg'      => 'fill: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_de_border_color:hover',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .email-btn:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'ud_de_box_shadow_hover',
			array(
				'label'          => __( 'Box Shadow', 'motors-elementor-widgets' ),
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
				'selector'       => '{{WRAPPER}} .email-btn:hover',
				'condition'      => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_heading(
			'ud_de_btn_bg_after',
			array(
				'separator' => 'after',
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_typography(
			'ud_de_typography',
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
				'selector'       => '{{WRAPPER}} .email-btn',
				'condition'      => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_de_border_before',
			array(
				'separator' => 'before',
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_border(
			'ud_de_border',
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
					'color'  => array(
						'default' => '#e0e3e7',
					),
				),
				'exclude'        => array( 'color' ),
				'selector'       => '{{WRAPPER}} .email-btn',
				'condition'      => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_de_btn_border_radius',
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
					'{{WRAPPER}} .email-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_de_border_after',
			array(
				'separator' => 'after',
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_de_btn_padding',
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
					'{{WRAPPER}} .email-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_de_icon_styles',
			array(
				'label'     => __( 'Icon', 'motors-elementor-widgets' ),
				'separator' => 'before',
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_slider(
			'ud_de_icon_size',
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
					'{{WRAPPER}} .email-btn i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .email-btn svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_de_icon_margin',
			array(
				'label'     => __( 'Icon Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '',
					'right'    => '17',
					'bottom'   => '',
					'left'     => '',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .email-btn i'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .email-btn svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_end_control_section();
	}

	private function get_phone_settings() {
		$this->stm_start_style_controls_section( 'ud_dpn_styles', __( 'Phone', 'motors-elementor-widgets' ) );

		$this->stm_start_ctrl_tabs( 'ud_dpn_btn_bg_style' );

		$this->stm_start_ctrl_tab(
			'ud_dpn_bg_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#45c655',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dealer-contact-unit.phone svg'      => 'fill: {{VALUE}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_label_color',
			array(
				'label'     => __( 'Phone Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone .phone' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_text_color',
			array(
				'label'     => __( 'Show Number Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone .stm-show-number' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_border_color',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone' => 'border-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'ud_dpn_box_shadow',
			array(
				'label'          => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'box_shadow_type' => array(
						'default' => 'no',
					),
					'box_shadow'      => array(
						'default' => array(
							'horizontal' => 0,
							'vertical'   => 0,
							'blur'       => 0,
							'spread'     => 0,
							'color'      => 'rgba(0, 0, 0, 0.09)',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.phone',
				'condition'      => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'ud_dpn_bg_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_btn_bg_hover',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#45c655',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone:hover i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dealer-contact-unit.phone:hover svg'      => 'fill: {{VALUE}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_label_color_hover',
			array(
				'label'     => __( 'Phone Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone:hover .phone' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_text_color_hover',
			array(
				'label'     => __( 'Show Number Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone:hover .stm-show-number' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_dpn_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'ud_dpn_box_shadow_hover',
			array(
				'label'          => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'box_shadow_type' => array(
						'default' => 'no',
					),
					'box_shadow'      => array(
						'default' => array(
							'horizontal' => 0,
							'vertical'   => 0,
							'blur'       => 0,
							'spread'     => 0,
							'color'      => 'rgba(0, 0, 0, 0.09)',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.phone:hover',
				'condition'      => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_heading(
			'ud_dpn_btn_bg_after',
			array(
				'separator' => 'after',
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_typography(
			'ud_dpn_typography_phone',
			array(
				'label'          => __( 'Number Typography', 'motors-elementor-widgets' ),
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
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.phone .phone',
				'condition'      => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_typography(
			'ud_dpn_typography_show_number',
			array(
				'label'          => __( 'Show Number Typography', 'motors-elementor-widgets' ),
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
							'size' => 10,
						),
					),
					'font_weight'    => array(
						'default' => '400',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 18,
						),
					),
					'text_transform' => array(
						'default' => 'capitalize',
					),
				),
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.phone .stm-show-number',
				'condition'      => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_dpn_border_before',
			array(
				'separator' => 'before',
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_border(
			'ud_dpn_border',
			array(
				'label'          => __( 'Border', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'none',
					),
					'width'  => array(
						'default' => array(
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '0',
							'left'     => '0',
							'isLinked' => true,
						),
					),
					'color'  => array(
						'default' => '#e0e3e7',
					),
				),
				'exclude'        => array( 'color' ),
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.phone',
				'condition'      => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_dpn_btn_border_radius',
			array(
				'label'     => __( 'Border Radius', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_dpn_border_after',
			array(
				'separator' => 'after',
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_dpn_btn_padding',
			array(
				'label'     => __( 'Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_dph_icon_styles',
			array(
				'label'     => __( 'Icon', 'motors-elementor-widgets' ),
				'separator' => 'before',
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_slider(
			'ud_dpn_icon_size',
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
					'{{WRAPPER}} .dealer-contact-unit.phone i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dealer-contact-unit.phone svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_dpn_icon_margin',
			array(
				'label'     => __( 'Icon Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '',
					'right'    => '17',
					'bottom'   => '',
					'left'     => '',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.phone i'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .dealer-contact-unit.phone svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_phone' => 'yes' ),
			)
		);

		$this->stm_end_control_section();
	}

	private function get_location_settings() {
		$this->stm_start_style_controls_section( 'ud_location_styles', __( 'Location', 'motors-elementor-widgets' ) );

		$this->stm_start_ctrl_tabs( 'ud_location_btn_bg_style' );

		$this->stm_start_ctrl_tab(
			'ud_location_bg_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_location_btn_bg',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_location_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#1bc744',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dealer-contact-unit.address svg'      => 'fill: {{VALUE}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_location_text_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address .address' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_location_border_color',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address' => 'border-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'ud_location_box_shadow',
			array(
				'label'          => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'box_shadow_type' => array(
						'default' => 'no',
					),
					'box_shadow'      => array(
						'default' => array(
							'horizontal' => 0,
							'vertical'   => 0,
							'blur'       => 0,
							'spread'     => 0,
							'color'      => 'rgba(0, 0, 0, 0.09)',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.address',
				'condition'      => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'ud_location_bg_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_location_btn_bg_hover',
			array(
				'label'     => __( 'Background', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_location_icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#1bc744',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address:hover i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dealer-contact-unit.address:hover svg'      => 'fill: {{VALUE}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_location_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address:hover .address' => 'color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'ud_location_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#e0e3e7',
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array( 'ud_show_email' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_box_shadow(
			'ud_location_box_shadow_hover',
			array(
				'label'          => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'box_shadow_type' => array(
						'default' => 'no',
					),
					'box_shadow'      => array(
						'default' => array(
							'horizontal' => 0,
							'vertical'   => 0,
							'blur'       => 0,
							'spread'     => 0,
							'color'      => 'rgba(0, 0, 0, 0.09)',
						),
					),
				),
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.address:hover',
				'condition'      => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_heading(
			'ud_location_btn_bg_after',
			array(
				'separator' => 'after',
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_group_typography(
			'ud_location_typography',
			array(
				'label'          => __( 'Text Typography', 'motors-elementor-widgets' ),
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
							'size' => 10,
						),
					),
					'font_weight'    => array(
						'default' => '400',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 18,
						),
					),
					'text_transform' => array(
						'default' => 'capitalize',
					),
				),
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.address .address',
				'condition'      => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_location_border_before',
			array(
				'separator' => 'before',
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_border(
			'ud_location_border',
			array(
				'label'          => __( 'Border', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'none',
					),
					'width'  => array(
						'default' => array(
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '0',
							'left'     => '0',
							'isLinked' => true,
						),
					),
					'color'  => array(
						'default' => '#e0e3e7',
					),
				),
				'exclude'        => array( 'color' ),
				'selector'       => '{{WRAPPER}} .dealer-contact-unit.address',
				'condition'      => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_location_btn_border_radius',
			array(
				'label'     => __( 'Border Radius', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_location_border_after',
			array(
				'separator' => 'after',
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_location_btn_padding',
			array(
				'label'     => __( 'Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_heading(
			'ud_location_icon_styles',
			array(
				'label'     => __( 'Icon', 'motors-elementor-widgets' ),
				'separator' => 'before',
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_slider(
			'ud_location_icon_size',
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
					'size' => 14,
				),
				'selectors'  => array(
					'{{WRAPPER}} .dealer-contact-unit.address i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dealer-contact-unit.address svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_ew_add_dimensions(
			'ud_location_icon_margin',
			array(
				'label'     => __( 'Icon Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '',
					'right'    => '17',
					'bottom'   => '',
					'left'     => '',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .dealer-contact-unit.address i'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .dealer-contact-unit.address svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array( 'ud_show_location' => 'yes' ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['ud_wa_icon']       = $this->stm_ew_get_rendered_icon( 'ud_wa_icon', $settings );
		$settings['ud_de_icon']       = $this->stm_ew_get_rendered_icon( 'ud_de_icon', $settings );
		$settings['ud_dpn_icon']      = $this->stm_ew_get_rendered_icon( 'ud_dpn_icon', $settings );
		$settings['ud_location_icon'] = $this->stm_ew_get_rendered_icon( 'ud_location_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/single-listing/classified/user-data-advanced', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
