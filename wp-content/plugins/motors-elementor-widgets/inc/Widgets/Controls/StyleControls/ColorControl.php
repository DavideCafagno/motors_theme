<?php


namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait ColorControl {
	use Control;

	protected function stm_ew_add_color( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$control_config = array(
			'type'        => Controls_Manager::COLOR,
			'label'       => $config['label'],
			'description' => $config['description'],
			'show_label'  => $config['show_label'],
			'label_block' => $config['label_block'],
			'separator'   => $config['separator'],
			'alpha'       => $config['alpha'],
			'default'     => $config['default'],
			'selectors'   => $config['selectors'],
			'condition'   => $config['condition'],
			'conditions'  => $config['conditions'],
		);

		if ( isset( $config['global'] ) ) {
			$control_config['global'] = $config['global'];
		}

		$this->add_responsive_control(
			$id,
			$control_config
		);
	}
}
