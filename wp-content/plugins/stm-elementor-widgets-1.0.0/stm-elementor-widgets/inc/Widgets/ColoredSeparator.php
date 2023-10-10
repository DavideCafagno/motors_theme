<?php

namespace STM_E_W\Widgets;

use STM_E_W\Helpers\Helper;
use STM_E_W\STMApp;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;

class ColoredSeparator extends WidgetBase {

	use ColorControl;
	use SelectControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
	}

	public function get_name() {
		return STMApp::STM_PREFIX . '-colored-separator';
	}

	public function get_title() {
		return esc_html__( 'Colored Separator', 'stm-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-color-drop';
	}

	protected function register_controls() {

		$this->stm_start_style_controls_section( 'section_style', __( 'Style', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'color',
			array(
				'label'      => __( 'Separator Color', 'stm-elementor-widgets' ),
				'default'    => '#cc6119',
				'separators' => array(
					'{{WRAPPER}} .first-long' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .last-short' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_select(
			'align',
			array(
				'label'   => __( 'Align', 'stm-elementor-widgets' ),
				'default' => 'center',
				'options' => array(
					'left'   => __( 'Left', 'motors' ),
					'center' => __( 'Center', 'motors' ),
					'right'  => __( 'Right', 'motors' ),
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/colored-separator', STM_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
		?>
		<div class="colored-separator" style="text-align: {{{ settings.align }}}">
			<div class="first-long stm-base-background-color"></div>
			<div class="last-short stm-base-background-color"></div>
		</div>
		<?php
	}
}
