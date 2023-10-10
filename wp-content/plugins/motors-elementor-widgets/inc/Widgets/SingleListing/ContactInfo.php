<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\TextAreaControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ContactInfo extends WidgetBase {

	use TextControl;
	use TextAreaControl;
	use SelectControl;
	use IconsControl;
	use GroupTypographyControl;
	use ColorControl;
	use HeadingControl;
	use DimensionsControl;
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
		return MotorsApp::STM_PREFIX . '-single-listing-contact-info';
	}

	public function get_title() {
		return esc_html__( 'Contact Info', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-contact-tabs';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'ci_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'ci_title',
			array(
				'label'   => __( 'Title', 'motors-elementor-widgets' ),
				'default' => __( 'Contact Information', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'ci_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'far fa-envelope',
				),
			)
		);

		$this->stm_ew_add_select(
			'ci_tag',
			array(
				'label'   => __( 'Title Tag', 'motors-elementor-widgets' ),
				'default' => 'h5',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'span' => 'span',
					'div'  => 'div',
				),
			)
		);

		$this->stm_ew_add_textarea(
			'ci_description',
			array(
				'label'   => __( 'Description', 'motors-elementor-widgets' ),
				'default' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'ci_item_icon',
			array(
				'label'       => esc_html__( 'Icon', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value' => 'stm-icon-phone',
				),
			)
		);

		$repeater->add_control(
			'ci_item_title',
			array(
				'label'       => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Phone', 'motors-elementor-widgets' ),
			)
		);

		$repeater->add_control(
			'ci_item_desc',
			array(
				'label'       => esc_html__( 'Value', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( '123-456-7890', 'motors-elementor-widgets' ),
			)
		);

		$this->add_control(
			'contact_info',
			array(
				'label'       => esc_html__( 'Contact Info', 'motors-elementor-widgets' ),
				'fields'      => $repeater->get_controls(),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ ci_item_title }}}',
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'ci_style', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'ci_typography',
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
							'size' => 16,
						),
					),
					'font_weight' => array(
						'default' => '700',
					),
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 22,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .contact-info-wrap .title_wrap .title',
			)
		);

		$this->stm_ew_add_slider(
			'icon_typography',
			array(
				'label'      => __( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 27,
				),
				'selectors'  => array(
					'{{WRAPPER}} .contact-info-wrap .title_wrap i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .contact-info-wrap .title_wrap svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'ci_icon_color',
			array(
				'label'     => __( 'Icon color', 'motors-elementor-widgets' ),
				'default'   => '#cc6118',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-wrap .title_wrap i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .contact-info-wrap .title_wrap svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'ci_desc_typography',
			array(
				'label'          => __( 'Description Typography', 'motors-elementor-widgets' ),
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
					'text_transform' => array(
						'default' => 'normal',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 18,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .contact-info-wrap .contact-desc',
			)
		);

		$this->stm_ew_add_color(
			'ci_desc_color',
			array(
				'label'     => __( 'Description color', 'motors-elementor-widgets' ),
				'default'   => '#888888',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-wrap .contact-desc' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'ci_desc_padding',
			array(
				'label'       => __( 'Description Content Padding', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '25',
					'right'    => '0',
					'bottom'   => '33',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors'   => array(
					'{{WRAPPER}} .contact-info-wrap .contact-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_heading(
			'item_heading',
			array(
				'label'     => __( 'Info', 'motors-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_color(
			'item_icon_color',
			array(
				'label'     => __( 'Icon color', 'motors-elementor-widgets' ),
				'default'   => '#cc6118',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-wrap .info-item i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .contact-info-wrap .info-item svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'item_icon_typography',
			array(
				'label'      => __( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .contact-info-wrap .info-item i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .contact-info-wrap .info-item svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'item_title_typography',
			array(
				'label'          => __( 'Title Typography', 'motors-elementor-widgets' ),
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
					'text_transform' => array(
						'default' => 'uppercase',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 18,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .contact-info-wrap .item-title',
			)
		);

		$this->stm_ew_add_color(
			'item_title_color',
			array(
				'label'     => __( 'Title color', 'motors-elementor-widgets' ),
				'default'   => '#888888',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-wrap .item-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'item_desc_typography',
			array(
				'label'          => __( 'Description Typography', 'motors-elementor-widgets' ),
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
					'text_transform' => array(
						'default' => 'normal',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 18,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .contact-info-wrap .item-value',
			)
		);

		$this->stm_ew_add_color(
			'item_desc_color',
			array(
				'label'     => __( 'Description color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .contact-info-wrap .item-value' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['ci_icon'] = $this->stm_ew_get_rendered_icon( 'ci_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/single-listing/contact-info', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
