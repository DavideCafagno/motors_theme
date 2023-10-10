<?php


namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait AlignControl {
	use Control;

	protected function stm_ew_add_align( $id, $selectors, $label = 'Alignment', $config = array() ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$input = $config;

		$config = array_merge( $def_config, $config );

		$default = 'left';
		if ( isset( $input['default'] ) ) {
			$default = $input['default'];
		}

		$options = array(
			'left'   => array(
				'title' => esc_html__( 'Left', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-left',
			),
			'center' => array(
				'title' => esc_html__( 'Center', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-center',
			),
			'right'  => array(
				'title' => esc_html__( 'Right', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-right',
			),
		);

		if ( isset( $input['options'] ) ) {
			$options = $input['options'];
		}

		$this->add_responsive_control(
			$id,
			array(
				'type'      => Controls_Manager::CHOOSE,
				'label'     => $label,
				'options'   => $options,
				'default'   => $default,
				'toggle'    => true,
				'selectors' => $selectors,
				'condition' => $config['condition'],
			)
		);
	}

	protected function stm_ew_add_align_simple( $id, $selectors, $label = 'Alignment', $config = array() ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$input = $config;

		$config = array_merge( $def_config, $config );

		$default = 'left';
		if ( isset( $input['default'] ) ) {
			$default = $input['default'];
		}

		$options = array(
			'left'   => array(
				'title' => esc_html__( 'Left', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-left',
			),
			'center' => array(
				'title' => esc_html__( 'Center', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-center',
			),
			'right'  => array(
				'title' => esc_html__( 'Right', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-right',
			),
		);

		if ( isset( $input['options'] ) ) {
			$options = $input['options'];
		}

		$this->add_control(
			$id,
			array(
				'type'      => Controls_Manager::CHOOSE,
				'label'     => $label,
				'options'   => $options,
				'default'   => $default,
				'toggle'    => true,
				'selectors' => $selectors,
				'condition' => $config['condition'],
			)
		);
	}

	protected function stm_ew_add_align_flex( $id, $selectors, $label = 'Alignment', $config = array() ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$input = $config;

		$config = array_merge( $def_config, $config );

		$default = 'flex-start';
		if ( isset( $input['default'] ) ) {
			$default = $input['default'];
		}

		$options = array(
			'flex-start' => array(
				'title' => esc_html__( 'Left', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-left',
			),
			'center'     => array(
				'title' => esc_html__( 'Center', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-center',
			),
			'flex-end'   => array(
				'title' => esc_html__( 'Right', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-right',
			),
		);

		if ( isset( $input['options'] ) ) {
			$options = $input['options'];
		}

		$this->add_responsive_control(
			$id,
			array(
				'type'      => Controls_Manager::CHOOSE,
				'label'     => $label,
				'options'   => $options,
				'default'   => $default,
				'toggle'    => true,
				'selectors' => $selectors,
				'condition' => $config['condition'],
			)
		);
	}

	protected function stm_ew_add_align_simple_flex( $id, $selectors, $label = 'Alignment', $config = array() ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$input = $config;

		$config = array_merge( $def_config, $config );

		$default = 'flex-start';
		if ( isset( $input['default'] ) ) {
			$default = $input['default'];
		}

		$options = array(
			'flex-start' => array(
				'title' => esc_html__( 'Left', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-left',
			),
			'center'     => array(
				'title' => esc_html__( 'Center', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-center',
			),
			'flex-end'   => array(
				'title' => esc_html__( 'Right', 'motors-elementor-widgets' ),
				'icon'  => 'eicon-text-align-right',
			),
		);

		if ( isset( $input['options'] ) ) {
			$options = $input['options'];
		}

		$this->add_control(
			$id,
			array(
				'type'      => Controls_Manager::CHOOSE,
				'label'     => $label,
				'options'   => $options,
				'default'   => $default,
				'toggle'    => true,
				'selectors' => $selectors,
				'condition' => $config['condition'],
			)
		);
	}
}
