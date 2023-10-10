<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\UrlControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\WidgetBase;

class PlayVideo extends WidgetBase {

	use UrlControl;
	use ColorControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-play-video';
	}

	public function get_title() {
		return esc_html__( 'Play Video', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-play-video';
	}

	public function get_script_depends() {
		return array( 'motors-general-admin' );
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_url(
			'video_link',
			array(
				'label' => esc_html__( 'Link to Video', 'motors-elementor-widgets' ),
			),
		);

		$this->stm_ew_add_color(
			'play_video_btn_color',
			array(
				'label' => esc_html__( 'Button color', 'motors-elementor-widgets' ),
			),
		);

		$this->stm_end_control_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/play-video', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {

	}
}
