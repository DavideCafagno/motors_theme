<?php

namespace Motors_E_W\Widgets\SingleListing\Classified;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class UserDataSimple extends WidgetBase {

	use ColorControl;
	use GroupTypographyControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-user-data-simple';
	}

	public function get_title() {
		return esc_html__( 'User Data Simple', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-user-info';
	}

	protected function register_controls() {
		$this->get_general_settings();
	}

	private function get_general_settings() {
		$this->stm_start_style_controls_section( 'uds_general_styles', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'uds_general_user_name_color',
			array(
				'label'     => __( 'User Name Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-listing-car-dealer-info-simple .title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'uds_general_user_name_typography',
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
				'selector'       => '{{WRAPPER}} .stm-listing-car-dealer-info-simple .title',
			)
		);

		$this->stm_ew_add_color(
			'uds_general_user_role_color',
			array(
				'label'       => __( 'User Role Color', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'Only for User Role Subscriber', 'motors-elementor-widgets' ),
				'default'     => '#888888',
				'selectors'   => array(
					'{{WRAPPER}} .stm-listing-car-dealer-info-simple .stm-user-main-info-c .stm-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'uds_general_user_role_typography',
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
				'selector'       => '{{WRAPPER}} .stm-listing-car-dealer-info-simple .stm-user-main-info-c .stm-label',
			)
		);

		$this->stm_ew_add_color(
			'uds_review_amount_color',
			array(
				'label'       => __( 'Review Amount Color', 'motors-elementor-widgets' ),
				'description' => esc_html__( 'Only for User Role Dealer', 'motors-elementor-widgets' ),
				'default'     => '#888888',
				'selectors'   => array(
					'{{WRAPPER}} .stm-listing-car-dealer-info-simple .dealer-rating .stm-rate-sum' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/single-listing/classified/user-data-simple', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
