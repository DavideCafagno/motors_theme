<?php

namespace Motors_E_W\Widgets\SingleListing\Classified;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class Title extends WidgetBase {

	use HeadingControl;
	use SelectControl;
	use GroupTypographyControl;
	use ColorControl;
	use SwitcherControl;
	use IconsControl;
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
		return MotorsApp::STM_PREFIX . '-single-listing-classified-title';
	}

	public function get_title() {
		return esc_html__( 'Title Classified', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-letter-t';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'title_content', __( 'General', 'motors-elementor-widgets' ) );

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

		$this->stm_ew_add_switcher(
			'added_date',
			array(
				'label'   => __( 'Added Date', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_icons(
			'date_added_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'far fa-clock',
				),
				'condition'        => array( 'added_date' => 'yes' ),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'title_style', __( 'Style', 'motors-elementor-widgets' ) );

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
							'size' => 36,
						),
					),
					'font_weight' => array(
						'default' => '700',
					),
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 42,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .title',
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'label_typography',
			array(
				'label'          => __( 'Label Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'font_weight',
					'text_transform',
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
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 15,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .title .labels',
			)
		);

		$this->stm_ew_add_group_typography(
			'date_added_typography',
			array(
				'label'          => __( 'Added Date Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'font_weight',
					'text_transform',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'   => array(
						'default' => array(
							'unit' => 'px',
							'size' => 11,
						),
					),
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .normal_font',
				'condition'      => array( 'added_date' => 'yes' ),
			)
		);

		$this->stm_ew_add_slider(
			'added_date_icon_size',
			array(
				'label'      => __( 'Added Date Icon Size', 'motors-elementor-widgets' ),
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
					'size' => 13,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-single-title-wrap .normal_font i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-single-title-wrap .normal_font svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'added_date' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'added_date_icon_color',
			array(
				'label'     => __( 'Added Date Icon Color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-single-title-wrap .normal_font i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stm-single-title-wrap .normal_font svg' => 'fill: {{VALUE}}',
				),
				'condition' => array( 'added_date' => 'yes' ),
			)
		);

		$this->stm_ew_add_color(
			'added_date_color',
			array(
				'label'     => __( 'Added Date Text Color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-single-title-wrap .normal_font' => 'color: {{VALUE}}',
				),
				'condition' => array( 'added_date' => 'yes' ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['date_added_icon'] = $this->stm_ew_get_rendered_icon( 'date_added_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/single-listing/classified/title', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
