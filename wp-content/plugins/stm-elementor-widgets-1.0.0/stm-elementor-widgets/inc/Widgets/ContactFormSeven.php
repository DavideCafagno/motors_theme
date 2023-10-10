<?php

namespace STM_E_W\Widgets;

use STM_E_W\Helpers\Helper;
use STM_E_W\STMApp;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBoxShadowControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ContactFormSeven extends WidgetBase {

	use ColorControl;
	use SelectControl;
	use TextControl;
	use IconsControl;
	use GroupTypographyControl;
	use DimensionsControl;
	use GroupBoxShadowControl;
	use SliderControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
	}

	public function get_name() {
		return STMApp::STM_PREFIX . '-contact-form-seven';
	}

	public function get_title() {
		return esc_html__( 'Contact form 7', 'stm-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-mountain';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'title',
			array(
				'label' => esc_html__( 'Title', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select(
			'title_heading',
			array(
				'label'   => __( 'Title Heading', 'stm-elementor-widgets' ),
				'default' => 'h4',
				'options' => array(
					'h1' => __( 'Heading 1', 'stm-elementor-widgets' ),
					'h2' => __( 'Heading 2', 'stm-elementor-widgets' ),
					'h3' => __( 'Heading 3', 'stm-elementor-widgets' ),
					'h4' => __( 'Heading 4', 'stm-elementor-widgets' ),
					'h5' => __( 'Heading 5', 'stm-elementor-widgets' ),
					'h6' => __( 'Heading 6', 'stm-elementor-widgets' ),
				),
			)
		);

		$this->stm_ew_add_icons(
			'icon',
			array(
				'label' => esc_html__( 'Icon', 'stm-elementor-widgets' ),
				'skin'  => 'inline',
			)
		);

		$this->stm_ew_add_select(
			'form_id',
			array(
				'label'   => __( 'Contact Form', 'stm-elementor-widgets' ),
				'options' => Helper::stm_ew_get_cf7_select(),
			)
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_styles', __( 'Styles', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_group_box_shadow(
			'content_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'stm-elementor-widgets' ),
				'selector' => '{{WRAPPER}}',
			)
		);

		$this->stm_ew_add_slider(
			'svg_width',
			array(
				'label'      => __( 'Icon Size', 'stm-elementor-widgets' ),
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
					'{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'    => __( 'Title Text Style', 'stm-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title .title',
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_colors', __( 'Colors', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'stm-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title .title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/contact-form-seven', STM_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
