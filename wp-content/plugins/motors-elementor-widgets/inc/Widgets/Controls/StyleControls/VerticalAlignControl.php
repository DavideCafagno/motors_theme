<?php


namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait VerticalAlignControl {
	use Control;

	protected function stm_ew_add_vertical_align_flex( $id, $selectors, $label = 'Vertical Alignment', $config = array() ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$input = $config;

		$config = array_merge( $def_config, $config );

		$default = 'flex-start';
		if ( isset( $input['default'] ) ) {
			$default = $input['default'];
		}

		$this->add_responsive_control(
			$id,
			array(
				'type'      => Controls_Manager::CHOOSE,
				'label'     => $label,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Top', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Bottom', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'   => $default,
				'toggle'    => true,
				'selectors' => $selectors,
				'condition' => $config['condition'],
			)
		);
	}

	protected function stm_ew_add_vertical_align( $id, $selectors, $label = 'Vertical Alignment', $config = array() ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$input = $config;

		$config = array_merge( $def_config, $config );

		$default = 'top';
		if ( isset( $input['default'] ) ) {
			$default = $input['default'];
		}

		$this->add_responsive_control(
			$id,
			array(
				'type'      => Controls_Manager::CHOOSE,
				'label'     => $label,
				'options'   => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'   => $default,
				'toggle'    => true,
				'selectors' => $selectors,
				'condition' => $config['condition'],
			)
		);
	}
}
