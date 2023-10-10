<?php

namespace Motors_E_W\Widgets\SingleListing\Classified;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ListingData extends WidgetBase {

	use SwitcherControl;
	use SelectControl;
	use SliderControl;
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
		return MotorsApp::STM_PREFIX . '-single-listing-classified-listing-data';
	}

	public function get_title() {
		return esc_html__( 'Data Classified', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-stack';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'cld_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'show_vin',
			array(
				'label'     => __( 'VIN Number', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_stock',
			array(
				'label'     => __( 'Stock Number', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_registered',
			array(
				'label'     => __( 'Registered Date', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'show_history',
			array(
				'label'     => __( 'History', 'motors-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'data_columns',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Columns', 'stm-elementor-widgets' ),
				'default' => '3',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'style_listing_data', esc_html__( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_slider(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 18,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-single-car-listing-data .item-label > i'   => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .stm-single-car-listing-data .item-label > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-single-car-listing-data .item-label > i'   => 'color: {{VALUE}};fill: {{VALUE}};',
					'{{WRAPPER}} .stm-single-car-listing-data .item-label > svg' => 'color: {{VALUE}};fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'icon_line_height',
			array(
				'label'          => esc_html__( 'Icon&Label Wrapper Line Height', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'font_size',
					'font_weight',
					'text_decoration',
					'text_transform',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'line_height' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 22,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-single-car-listing-data .item-label',
			)
		);

		$this->stm_ew_add_group_typography(
			'label_typography',
			array(
				'label'          => esc_html__( 'Label Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'   => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 13,
						),
					),
					'font_weight' => array(
						'default' => '400',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-single-car-listing-data .item-label',
			)
		);

		$this->stm_ew_add_color(
			'label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'motors-elementor-widgets' ),
				'default'   => '#888888',
				'selectors' => array(
					'{{WRAPPER}} .stm-single-car-listing-data .item-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'value_typography',
			array(
				'label'          => esc_html__( 'Value Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'   => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'line_height' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 22,
						),
					),
					'font_weight' => array(
						'default' => '700',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-single-car-listing-data .heading-font',
			)
		);

		$this->stm_ew_add_color(
			'value_color',
			array(
				'label'     => esc_html__( 'Value Color', 'motors-elementor-widgets' ),
				'default'   => '#222222',
				'selectors' => array(
					'{{WRAPPER}} .stm-single-car-listing-data .heading-font' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'motors-elementor-widgets' ),
				'default'   => '#d5d9e0',
				'selectors' => array(
					'{{WRAPPER}} .stm-single-car-listing-data .data-list-item:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/single-listing/classified/listing-data', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
