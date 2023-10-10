<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\MediaControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\WYSIWYGControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\StyleControls\AlignControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\StyleControls\VerticalAlignControl;
use STM_E_W\Widgets\WidgetBase;

class ArrowBanner extends WidgetBase {

	use SelectControl;
	use SwitcherControl;
	use WYSIWYGControl;
	use MediaControl;
	use SliderControl;
	use NumberControl;
	use AlignControl;
	use VerticalAlignControl;
	use ColorControl;
	use TextControl;
	use GroupTypographyControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script(
			'vivus',
			MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/js/lib/vivus.min.js',
			'',
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			true
		);

		$this->stm_ew_enqueue(
			self::get_name(),
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array(
				'jquery',
				'vivus',
			)
		);
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-arrow-banner';
	}

	public function get_title() {
		return esc_html__( 'Arrow Banner', 'motors-elementor-widgets' );
	}

	public function get_style_depends() {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'jquery';
		$widget_styles[] = 'vivus';
		return $widget_styles;
	}

	public function get_icon(): string {
		return 'stmew-arrow-banner';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'Content', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_vertical_align_flex(
			'vertical_align',
			array(
				'{{WRAPPER}} .centered-banner-content-listing' => 'align-items: {{VALUE}};',
			),
			esc_html__( 'Vertical Align', 'motors-elementor-widgets' ),
			array(
				'default' => 'center',
			)
		);

		$this->stm_ew_add_align_simple_flex(
			'horizontal_align',
			array(
				'{{WRAPPER}} .centered-banner-content-listing' => 'justify-content: {{VALUE}};',
			),
			esc_html__( 'Horizontal Align', 'motors-elementor-widgets' ),
		);

		$this->stm_ew_add_text(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'default' => '15 000+',
			)
		);

		$this->stm_ew_add_text(
			'subtitle',
			array(
				'label'   => esc_html__( 'Subtitle', 'motors-elementor-widgets' ),
				'default' => esc_html__( 'Vehicle Available', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_arrow',
			array(
				'label'   => esc_html__( 'Animated Arrow', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style', esc_html__( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_slider(
			'height',
			array(
				'label'      => esc_html__( 'Height', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 200,
						'max'  => 600,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 410,
				),
				'selectors'  => array(
					'{{WRAPPER}} .motors-elementor-banner-image-filter.image' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .stm-content-arrow-wrap' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .centered-banner-content-listing' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => 'Title Color',
				'default'   => '#f0bb3a',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-arrow-banner .stm-content-arrow-wrap .centered-banner-content-listing .inner h1' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'subtitle_color',
			array(
				'label'     => 'Subtitle Color',
				'default'   => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-arrow-banner .stm-content-arrow-wrap .centered-banner-content-listing .inner h3' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'subtitle!' => '',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'          => esc_html__( 'Title Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
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
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
					),
				),
				'condition'      => array(
					'title!' => '',
				),
				'selector'       => '{{WRAPPER}} .motors-elementor-arrow-banner .stm-content-arrow-wrap .centered-banner-content-listing .inner h1',
			)
		);

		$this->stm_ew_add_group_typography(
			'subtitle_typography',
			array(
				'label'          => esc_html__( 'Subtitle Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
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
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
					),
				),
				'condition'      => array(
					'subtitle!' => '',
				),
				'selector'       => '{{WRAPPER}} .motors-elementor-arrow-banner .stm-content-arrow-wrap .centered-banner-content-listing .inner h3',
			)
		);

		$this->stm_ew_add_color(
			'arrow_color',
			array(
				'label'     => 'Arrow Color',
				'default'   => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-arrow-banner .stm-content-arrow-wrap .centered-banner-content-listing .inner .stm-vivus-arrow svg' => 'stroke: {{VALUE}};',
				),
				'condition' => array(
					'show_arrow' => 'yes',
				),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_switcher(
			'flip_arrow',
			array(
				'label'     => esc_html__( 'Flip Arrow', 'motors-elementor-widgets' ),
				'default'   => 'no',
				'condition' => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->stm_ew_add_slider(
			'arrow_degree',
			array(
				'label'      => esc_html__( 'Arrow Direction', 'motors-elementor-widgets' ),
				'size_units' => array(
					'deg',
				),
				'range'      => array(
					'deg' => array(
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'deg',
					'size' => 0,
				),
				'condition'  => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'arrow_top_offset',
			array(
				'label'     => esc_html__( 'Arrow Top Offset', 'motors-elementor-widgets' ),
				'default'   => 'yes',
				'condition' => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->stm_ew_add_number(
			'arrow_top',
			array(
				'label'     => esc_html__( 'Arrow Top In Pixels', 'motors-elementor-widgets' ),
				'default'   => 35,
				'condition' => array(
					'arrow_top_offset' => 'yes',
					'show_arrow'       => 'yes',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'arrow_right_offset',
			array(
				'label'     => esc_html__( 'Arrow Right Offset', 'motors-elementor-widgets' ),
				'condition' => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->stm_ew_add_number(
			'arrow_right',
			array(
				'label'     => esc_html__( 'Arrow Right In Pixels', 'motors-elementor-widgets' ),
				'default'   => 0,
				'condition' => array(
					'arrow_right_offset' => 'yes',
					'show_arrow'         => 'yes',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'arrow_bottom_offset',
			array(
				'label'     => esc_html__( 'Arrow Bottom Offset', 'motors-elementor-widgets' ),
				'condition' => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->stm_ew_add_number(
			'arrow_bottom',
			array(
				'label'     => esc_html__( 'Arrow Bottom In Pixels', 'motors-elementor-widgets' ),
				'default'   => 0,
				'condition' => array(
					'arrow_bottom_offset' => 'yes',
					'show_arrow'          => 'yes',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'arrow_left_offset',
			array(
				'label'     => esc_html__( 'Arrow Left Offset', 'motors-elementor-widgets' ),
				'default'   => 'yes',
				'condition' => array(
					'show_arrow' => 'yes',
				),
			)
		);

		$this->stm_ew_add_number(
			'arrow_left',
			array(
				'label'     => esc_html__( 'Arrow Left In Pixels', 'motors-elementor-widgets' ),
				'default'   => - 45,
				'condition' => array(
					'arrow_left_offset' => 'yes',
					'show_arrow'        => 'yes',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( 'yes' === $settings['show_arrow'] && ! is_admin() ) {
			wp_enqueue_script( self::get_name() );
		}

		Helper::stm_ew_load_template( 'widgets/arrow-banner', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

}
