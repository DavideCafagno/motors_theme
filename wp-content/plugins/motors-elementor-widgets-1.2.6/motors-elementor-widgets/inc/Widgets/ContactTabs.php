<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ContactTabs extends WidgetBase {

	use ColorControl;
	use GroupTypographyControl;
	use SliderControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

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
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-contact-tabs';
	}

	public function get_title() {
		return esc_html__( 'Contact tabs', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-contact-tabs';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => esc_html__( 'Tab Title', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Laoreet',
			)
		);

		$repeater->add_control(
			'title_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$repeater->add_control(
			'first_icon',
			array(
				'label'   => esc_html__( 'Address Icon', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'skin'    => 'inline',
				'default' => array(
					'value'   => 'fas fa-layer-group',
					'library' => 'fa-solid',
				),
			)
		);

		$repeater->add_control(
			'first_title',
			array(
				'label'       => esc_html__( 'Address Title', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Vel tempor vestibulum laoreet eu lorem',
			)
		);

		$repeater->add_control(
			'first_content',
			array(
				'label'      => esc_html__( 'Address Content', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'show_label' => false,
				'default'    => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
			)
		);

		$repeater->add_control(
			'first_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$repeater->add_control(
			'second_icon',
			array(
				'label'   => esc_html__( 'Sales Phone Icon', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'skin'    => 'inline',
				'default' => array(
					'value'   => 'fas fa-gift',
					'library' => 'fa-solid',
				),
			)
		);

		$repeater->add_control(
			'second_title',
			array(
				'label'       => esc_html__( 'Sales Phone Title', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Pellentesque non turpis ut est',
			)
		);

		$repeater->add_control(
			'second_content',
			array(
				'label'      => esc_html__( 'Sales Phone Content', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'show_label' => false,
				'default'    => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
			)
		);

		$repeater->add_control(
			'second_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$repeater->add_control(
			'third_icon',
			array(
				'label'   => esc_html__( 'Sales Hours Icon', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'skin'    => 'inline',
				'default' => array(
					'value'   => 'fas fa-rocket',
					'library' => 'fa-solid',
				),
			)
		);

		$repeater->add_control(
			'third_title',
			array(
				'label'       => esc_html__( 'Sales Hours Title', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Nam condimentum pellentesque augue',
			)
		);

		$repeater->add_control(
			'third_content',
			array(
				'label'      => esc_html__( 'Sales Hours Content', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'show_label' => false,
				'default'    => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
			)
		);

		$this->add_control(
			'tab_panels',
			array(
				'label'       => esc_html__( 'Contact Tabs', 'motors-elementor-widgets' ),
				'fields'      => $repeater->get_controls(),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ tab_title }}}',
				'default'     => array(
					array(
						'tab_title'      => 'Laoreet',
						'first_title'    => 'Vel tempor vestibulum laoreet eu lorem',
						'first_content'  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'first_icon'     => array(
							'value'   => 'fas fa-layer-group',
							'library' => 'fa-solid',
						),
						'second_title'   => 'Pellentesque non turpis ut est',
						'second_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'second_icon'    => array(
							'value'   => 'fas fa-gift',
							'library' => 'fa-solid',
						),
						'third_title'    => 'Nam condimentum pellentesque augue',
						'third_content'  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'third_icon'     => array(
							'value'   => 'fas fa-rocket',
							'library' => 'fa-solid',
						),
					),
					array(
						'tab_title'      => 'Turpis',
						'first_title'    => 'Pellentesque non turpis ut est',
						'first_content'  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'first_icon'     => array(
							'value'   => 'fas fa-book',
							'library' => 'fa-solid',
						),
						'second_title'   => 'Vestibulum laoreet eu lorem vel tempor',
						'second_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'second_icon'    => array(
							'value'   => 'fas fa-grin',
							'library' => 'fa-solid',
						),
						'third_title'    => 'Pellentesque nam condimentum augue',
						'third_content'  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'third_icon'     => array(
							'value'   => 'fas fa-shield-alt',
							'library' => 'fa-solid',
						),
					),
					array(
						'tab_title'      => 'Adipis',
						'first_title'    => 'Nam condimentum pellentesque augue',
						'first_content'  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'first_icon'     => array(
							'value'   => 'fas fa-dragon',
							'library' => 'fa-solid',
						),
						'second_title'   => 'Ut est pellentesque non',
						'second_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'second_icon'    => array(
							'value'   => 'fas fa-bicycle',
							'library' => 'fa-solid',
						),
						'third_title'    => 'Vestibulum laoreet eu lorem vel tempor',
						'third_content'  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros.</p>',
						'third_icon'     => array(
							'value'   => 'fas fa-leaf',
							'library' => 'fa-solid',
						),
					),
				),
			)
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_styles', __( 'Styles', 'motors-elementor-widgets' ) );

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
					'{{WRAPPER}} .contact-tabs-containers-wrap .tab-unit .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .contact-tabs-containers-wrap .tab-unit .icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_colors', __( 'Colors', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'tabs_bg',
			array(
				'label'     => __( 'Tabs Background Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-tabs-container ul.elementor-contact-tabs-list' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'active_tab_line',
			array(
				'label'     => __( 'Active Tab Line Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-tabs-container ul.elementor-contact-tabs-list .elementor-contact-tab:before' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'active_tab_bg',
			array(
				'label'     => __( 'Active Tab Background Color', 'motors-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-tabs-container ul.elementor-contact-tabs-list .elementor-contact-tab.active .tab-item' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'active_tab_text',
			array(
				'label'     => __( 'Active Tab Text Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-tabs-container ul.elementor-contact-tabs-list .elementor-contact-tab.active .tab-item span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'inactive_tab_bg',
			array(
				'label'     => __( 'Inactive Tabs Background Color', 'motors-elementor-widgets' ),
				'default'   => '#121e24',
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-tabs-container ul.elementor-contact-tabs-list .elementor-contact-tab:not(.active) .tab-item' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'inactive_tab_text',
			array(
				'label'     => __( 'Inactive Tabs Text Color', 'motors-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-tabs-container ul.elementor-contact-tabs-list .elementor-contact-tab:not(.active) .tab-item span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'container_bg',
			array(
				'label'     => __( 'Container Background Color', 'motors-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor-contact-tabs .contact-tabs-containers-wrap' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-panels-container .tab-unit .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-contact-panels-container .tab-unit .icon svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-panels-container .tab-unit .text .title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'content_color',
			array(
				'label'     => __( 'Content Color', 'motors-elementor-widgets' ),
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .elementor-contact-panels-container .tab-unit .text .content' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_typography', __( 'Typography', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'tab_text',
			array(
				'label'    => __( 'Tab Heading Text Style', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .elementor-contact-tabs .elementor-contact-tabs-container .elementor-contact-tabs-list .elementor-contact-tab span.tab-item .elementor-contact-title-text',
			)
		);

		$this->stm_ew_add_group_typography(
			'title',
			array(
				'label'    => __( 'Title Text Style', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .contact-tabs-containers-wrap .tab-unit .text .title',
			)
		);

		$this->stm_ew_add_group_typography(
			'content',
			array(
				'label'    => __( 'Content Text Style', 'motors-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .contact-tabs-containers-wrap .tab-unit .text .content',
				'exclude'  => array(
					'font_style',
					'text_decoration',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/contact-tabs', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
