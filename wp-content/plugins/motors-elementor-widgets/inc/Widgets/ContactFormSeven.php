<?php

namespace STM_E_W\Widgets;

use STM_E_W\Helpers\Helper;
use STM_E_W\STMApp;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
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
	use SwitcherControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}

	public function get_name() {
		return STMApp::STM_PREFIX . '-contact-form-seven';
	}

	public function get_title() {
		return esc_html__( 'Contact form 7', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-mountain';
	}

	public function get_script_depends() {
		return array( 'uniform', 'uniform-init', $this->get_admin_name() );
	}

	public function get_style_depends() {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'uniform';
		$widget_styles[] = 'uniform-init';
		$widget_styles[] = self::get_name() . '-rtl';
		return $widget_styles;
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'title',
			array(
				'label' => esc_html__( 'Title', 'motors-elementor-widgets' ),
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

		$this->stm_ew_add_icons(
			'icon',
			array(
				'label' => esc_html__( 'Icon', 'motors-elementor-widgets' ),
				'skin'  => 'inline',
			)
		);

		$this->stm_ew_add_select(
			'form_id',
			array(
				'label'   => __( 'Contact Form', 'motors-elementor-widgets' ),
				'options' => Helper::stm_ew_get_cf7_select(),
			)
		);

		$this->stm_ew_add_switcher(
			'form_wide',
			array(
				'label'   => esc_html__( 'Wide', 'motors-elementor-widgets' ),
				'default' => '',
			)
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_styles', __( 'Styles', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_box_shadow(
			'content_box_shadow',
			array(
				'label'    => __( 'Box Shadow', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}}',
			)
		);

		$this->stm_ew_add_slider(
			'svg_width',
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
					'size' => 27,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'    => __( 'Title Text Style', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title .title',
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_colors', __( 'Colors', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stm-elementor-contact-form-seven .icon-title svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'motors-elementor-widgets' ),
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
		Helper::stm_ew_load_template( 'widgets/contact-form-seven', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
