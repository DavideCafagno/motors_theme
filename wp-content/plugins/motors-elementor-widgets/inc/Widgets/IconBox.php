<?php

namespace STM_E_W\Widgets;

use STM_E_W\Helpers\Helper;
use STM_E_W\STMApp;
use STM_E_W\Widgets\Controls\ContentControls\ChooseControl;
use STM_E_W\Widgets\Controls\ContentControls\WYSIWYGControl;
use STM_E_W\Widgets\Controls\StyleControls\AlignControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\UrlControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\WidgetBase;

class IconBox extends WidgetBase {

	use TextControl;
	use HeadingControl;
	use ColorControl;
	use IconsControl;
	use SwitcherControl;
	use UrlControl;
	use SelectControl;
	use GroupTypographyControl;
	use WYSIWYGControl;
	use DimensionsControl;
	use ChooseControl;
	use AlignControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}

	public function get_style_depends(): array {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = self::get_name() . '-rtl';

		return $widget_styles;
	}

	public function get_name() {
		return STMApp::STM_PREFIX . '-icon-box';
	}

	public function get_title() {
		return esc_html__( 'Icon Box', 'stm-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-icon-box';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'ib_title',
			array(
				'label'   => __( 'Title', 'stm-elementor-widgets' ),
				'default' => __( 'Title placeholder', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select(
			'heading_tag',
			array(
				'label'   => __( 'Heading Tag', 'stm-elementor-widgets' ),
				'default' => 'h3',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'span' => 'span',
					'p'    => 'p',
				),
			)
		);

		$this->stm_ew_add_icons(
			'ib_icon',
			array(
				'label'            => __( 'Icon', 'stm-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'fas fa-car',
				),
			)
		);

		$this->stm_ew_add_heading(
			'content_heading',
			array(
				'label' => __( 'Description', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_wysiwyg(
			'ib_content',
			array(
				'default' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
			)
		);

		$this->stm_ew_add_switcher(
			'show_button',
			array(
				'label' => __( 'Button', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_url(
			'ib_link',
			array(
				'label'     => __( 'Link', 'stm-elementor-widgets' ),
				'condition' => array( 'show_button' => 'yes' ),
			)
		);

		$this->stm_ew_add_text(
			'ib_btn_text',
			array(
				'label'     => __( 'Button text', 'stm-elementor-widgets' ),
				'condition' => array( 'show_button' => 'yes' ),
			)
		);

		$this->stm_ew_add_switcher(
			'bottom_triangle',
			array(
				'label' => __( 'Bottom Triangle', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_style', __( 'Styles', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'ib_title_color',
			array(
				'label'     => __( 'Title color', 'stm-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .icon-box .icon-text .title.heading-font' => 'color: {{VALUE}}',
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
				'selector'       => '{{WRAPPER}} .icon-box .icon-text .title',
			)
		);

		$this->stm_ew_add_align(
			'title_text_align',
			array(
				'{{WRAPPER}} .icon-box .icon-text .title.heading-font' => 'text-align: {{VALUE}};',
			),
			esc_html__( 'Title Alignment', 'stm-elementor-widgets' ),
		);

		$this->stm_ew_add_dimensions(
			'iconbox_title_margin',
			array(
				'label'       => __( 'Title Margin', 'stm-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'   => array(
					'{{WRAPPER}} .icon-box .icon-text .title.heading-font' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'ib_text_color',
			array(
				'label'     => __( 'Text color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .icon-box' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box .icon-text .content' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box .icon-text .content a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'iconbox_text_margin',
			array(
				'label'       => __( 'Text Margin', 'stm-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'   => array(
					'{{WRAPPER}} .icon-box .icon-text .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'ib_text_color_hover',
			array(
				'label'     => __( 'Text Color on Hover', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .icon-box:hover .icon-text .content span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-box:hover .icon-text .content p'    => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_heading(
			'icon_heading',
			array(
				'label' => __( 'Icon Style', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'ib_icon_size',
			array(
				'label'     => __( 'Icon Size', 'stm-elementor-widgets' ),
				'default'   => 54,
				'selectors' => array(
					'{{WRAPPER}} .icon-box .icon_element i' => 'font-size: {{VALUE}}px;',
					'{{WRAPPER}} .icon-box .icon_element svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'icon_element_padding',
			array(
				'label'       => __( 'Icon Wrapper Padding', 'stm-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'   => array(
					'{{WRAPPER}} .icon-box .icon_element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'icon_element_margin',
			array(
				'label'       => __( 'Icon Wrapper Margin', 'stm-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'   => array(
					'{{WRAPPER}} .icon-box .icon_element' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'ib_icon_bg',
			array(
				'label'     => __( 'Icon Background', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .icon_element' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'ib_icon_color',
			array(
				'label'     => __( 'Icon Color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .icon_element i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon_element svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_heading(
			'btn_heading',
			array(
				'label' => __( 'Button Style', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'ib_btn_color',
			array(
				'label'     => __( 'Button Color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .icon-box .icon-text .icon-box-link-btn.button' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'ib_btn_hover_color',
			array(
				'label'     => __( 'Button Hover Color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .icon-box .icon-text .icon-box-link-btn.button:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_heading(
			'text_heading',
			array(
				'label' => __( 'Box Description Style', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_group_typography(
			'content_typography',
			array(
				'label'    => __( 'Text Style', 'stm-elementor-widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'text_transform',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .icon-box .content',
			)
		);

		$this->stm_ew_add_align(
			'desc_text_align',
			array(
				'{{WRAPPER}} .icon-text .content p' => 'text-align: {{VALUE}};',
			),
			esc_html__( 'Alignment', 'stm-elementor-widgets' ),
		);

		$this->stm_ew_add_color(
			'ib_bg',
			array(
				'label'     => __( 'Triangle Background Color', 'stm-elementor-widgets' ),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .icon-box-bottom-triangle'       => 'border-right-color: {{VALUE}}',
					'{{WRAPPER}}:hover .icon-box-bottom-triangle' => 'border-right-color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['ib_link'] = $this->stm_ew_parse_url( 'ib_link', $settings );
		$settings['ib_icon'] = $this->stm_ew_get_rendered_icon( 'ib_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/icon-box', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
