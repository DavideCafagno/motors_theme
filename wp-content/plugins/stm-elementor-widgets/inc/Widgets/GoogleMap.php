<?php

namespace STM_E_W\Widgets;

use STM_E_W\Helpers\Helper;
use STM_E_W\STMApp;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\ContentControls\MediaControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\ContentControls\TextAreaControl;
use STM_E_W\Widgets\Controls\ContentControls\CodeControl;

class GoogleMap extends WidgetBase {

	use SliderControl;
	use MediaControl;
	use SwitcherControl;
	use NumberControl;
	use TextAreaControl;
	use TextAreaControl;
	use CodeControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
	}

	public function get_name() {
		return STMApp::STM_PREFIX . '-google-map';
	}

	public function get_title() {
		return esc_html__( 'Google Map', 'stm-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-google-map';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_number(
			'lat',
			array(
				'label'       => __( 'Latitude', 'stm-elementor-widgets' ),
				'default'     => 51.503399,
				'step'        => 'any',
				'description' => __( '<a href="https://www.latlong.net" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_number(
			'lng',
			array(
				'label'       => __( 'Longitude', 'stm-elementor-widgets' ),
				'default'     => -0.119519,
				'step'        => 'any',
				'description' => __( '<a href="https://www.latlong.net" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_number(
			'default_zoom',
			array(
				'label'   => __( 'Default zoom', 'stm-elementor-widgets' ),
				'default' => 18,
				'step'    => 1,
				'min'     => 1,
			)
		);

		$this->stm_ew_add_media(
			'pin',
			array(
				'label'       => __( 'Pin image', 'stm-elementor-widgets' ),
				'label_block' => true,
				'description' => __( 'Leave empty to use default pin icon from Google', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_switcher(
			'mouse_wheel',
			array(
				'label'     => __( 'Zoom Using Mouse Wheel', 'stm-elementor-widgets' ),
				'label_on'  => __( 'On', 'stm-elementor-widgets' ),
				'label_off' => __( 'Off', 'stm-elementor-widgets' ),
				'default'   => 'yes',
			)
		);

		$this->stm_ew_add_switcher(
			'control_tools',
			array(
				'label'     => __( 'Show Control Tools', 'stm-elementor-widgets' ),
				'label_on'  => __( 'On', 'stm-elementor-widgets' ),
				'label_off' => __( 'Off', 'stm-elementor-widgets' ),
				'default'   => 'yes',
			)
		);

		$this->stm_ew_add_textarea(
			'infowindow_text',
			array(
				'label'   => __( 'Info window text', 'stm-elementor-widgets' ),
				'rows'    => 8,
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla consectetur, lorem non pellentesque condimentum, nibh lacus dictum augue, sed interdum nisi mauris at leo.',
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style', __( 'Style', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_slider(
			'map_width',
			array(
				'label'      => __( 'Map Width', 'stm-elementor-widgets' ),
				'size_units' => array(
					'px',
					'%',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 1200,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-elementor-google-map' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'map_height',
			array(
				'label'      => __( 'Map Height', 'stm-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 1200,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 400,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-elementor-google-map' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_textarea(
			'gmap_style',
			array(
				'label'       => __( 'Map Style', 'stm-elementor-widgets' ),
				'rows'        => 8,
				'description' => __( '<a href="https://snazzymaps.com" target="_blank">SnazzyMaps</a> is a free tool for you to create and explore map styles', 'stm-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/google-map', STM_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
