<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\ChooseControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\WidgetBase;

class LoanCalculator extends WidgetBase {

	use ChooseControl;
	use TextControl;
	use GroupTypographyControl;
	use SelectControl;
	use SwitcherControl;
	use IconsControl;
	use SliderControl;
	use ColorControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-loan-calculator';
	}

	public function get_title() {
		return esc_html__( 'Loan Calculator', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-calculation';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'title_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'default_interest_rate',
			array(
				'label'   => __( 'Default Interest Rate', 'motors-elementor-widgets' ),
				'default' => 3,
			)
		);

		$this->stm_ew_add_text(
			'default_month_period',
			array(
				'label'   => __( 'Default Loan Term', 'motors-elementor-widgets' ),
				'default' => 24,
			)
		);

		$this->stm_ew_add_choose(
			'default_down_payment_type',
			array(
				'label'   => __( 'Default Down Payment Type', 'motors-elementor-widgets' ),
				'options' => array(
					'percent' => array(
						'title' => __( 'Percent', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-user-preferences',
					),
					'static'  => array(
						'title' => __( 'Amount', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-number-field',
					),
				),
				'default' => 'static',
			)
		);

		$this->stm_ew_add_text(
			'default_down_payment',
			array(
				'label' => __( 'Down Payment Amount', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'default_down_payment_percent',
			array(
				'label' => __( 'Down Payment Percent (%)', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'title',
			array(
				'label'     => __( 'Title', 'motors-elementor-widgets' ),
				'default'   => __( 'Loan Calculator', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_choose(
			'calculator_type',
			array(
				'label'   => __( 'View Type', 'motors-elementor-widgets' ),
				'options' => array(
					'vertical'   => array(
						'title' => __( 'Vertical', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-form-vertical',
					),
					'horizontal' => array(
						'title' => __( 'Horizontal', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-form-horizontal',
					),
				),
				'default' => 'horizontal',
			)
		);

		$this->stm_ew_add_select(
			'title_tag',
			array(
				'label'   => __( 'Heading Tag', 'motors-elementor-widgets' ),
				'default' => 'h1',
				'options' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
			)
		);

		$this->stm_ew_add_icons(
			'title_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-calculator',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'wide_version',
			array(
				'label'     => __( 'Wide version', 'motors-elementor-widgets' ),
				'wide_on'   => __( 'On', 'motors-elementor-widgets' ),
				'wide_off'  => __( 'Off', 'motors-elementor-widgets' ),
				'condition' => array( 'calculator_type' => 'horizontal' ),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'calculator_style', __( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_slider(
			'icon_size',
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
					'size' => 42,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm_auto_loan_calculator .title i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm_auto_loan_calculator .title svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'          => __( 'Title Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_transform',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'   => array(
						'default' => array(
							'unit' => 'px',
							'size' => 20,
						),
					),
					'font_weight' => array(
						'default' => '700',
					),
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 24,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm_auto_loan_calculator .title .heading-font',
			)
		);

		$this->stm_ew_add_group_typography(
			'labels_typography',
			array(
				'label'          => __( 'Label Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'   => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'font_weight' => array(
						'default' => '600',
					),
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 25,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm_auto_loan_calculator .form-group .labeled',
			)
		);

		$this->stm_ew_add_color(
			'labels_color',
			array(
				'label'     => __( 'Labels color', 'motors-elementor-widgets' ),
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .stm_auto_loan_calculator .form-group .labeled' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'labels_meta_color',
			array(
				'label'     => __( 'Labels meta color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm_auto_loan_calculator .form-group .labeled > span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['title_icon'] = $this->stm_ew_get_rendered_icon( 'title_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/calculator-' . $settings['calculator_type'], MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
