<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\ChooseControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class Features extends WidgetBase {

	use IconsControl;
	use Select2Control;
	use GroupTypographyControl;
	use ColorControl;
	use ChooseControl;
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
		return MotorsApp::STM_PREFIX . '-single-listing-features';
	}

	public function get_title() {
		return esc_html__( 'Features', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-star';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'title_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_choose(
			'features_type',
			array(
				'label'   => __( 'View Type', 'motors-elementor-widgets' ),
				'options' => array(
					'vertical'   => array(
						'title' => __( 'Vertical', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-ellipsis-v',
					),
					'horizontal' => array(
						'title' => __( 'Horizontal', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'default' => 'horizontal',
			)
		);

		$this->stm_ew_add_choose(
			'features_rows',
			array(
				'label'     => __( 'Rows', 'motors-elementor-widgets' ),
				'options'   => array(
					'2' => array(
						'title' => 2,
						'icon'  => 'eicon-gallery-grid',
					),
					'3' => array(
						'title' => 3,
						'icon'  => 'eicon-gallery-grid',
					),
					'4' => array(
						'title' => 4,
						'icon'  => 'eicon-gallery-grid',
					),
				),
				'default'   => '4',
				'condition' => array( 'features_type' => 'horizontal' ),
			)
		);

		$this->stm_ew_add_icons(
			'features_icon',
			array(
				'label'            => __( 'Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
			)
		);

		$this->stm_ew_add_select_2(
			'features_list',
			array(
				'label'    => __( 'Features', 'motors-elementor-widgets' ),
				'multiple' => true,
				'options'  => $this->motors_features_list(),

			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'features_style', __( 'General', 'motors-elementor-widgets' ) );

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
					'size' => 14,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-single-listing-car-features i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-single-listing-car-features svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'features_icon_color',
			array(
				'label'     => __( 'Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-single-listing-car-features ul li i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .stm-single-listing-car-features ul li svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'          => __( 'Text Typography', 'motors-elementor-widgets' ),
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
							'size' => 13,
						),
					),
					'font_weight' => array(
						'default' => '400',
					),
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 16,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-single-listing-car-features ul li span',
			)
		);

		$this->stm_ew_add_color(
			'feature_color',
			array(
				'label'     => __( 'Text Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-single-listing-car-features ul li span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['features_icon'] = $this->stm_ew_get_rendered_icon( 'features_icon', $settings );

		Helper::stm_ew_load_template( 'widgets/single-listing/features', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}

	private function motors_features_list() {
		$features = get_terms(
			array(
				'taxonomy'   => 'stm_additional_features',
				'hide_empty' => false,
			)
		);

		$for_select = array();

		foreach ( $features as $feature ) {
			$for_select[ $feature->name ] = $feature->name;
		}

		return $for_select;
	}
}
