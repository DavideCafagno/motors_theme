<?php

namespace STM_E_W\Widgets\Controls\StyleControls;


use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait SliderControl {
	use Control;

	protected function stm_ew_add_slider( $id, $config ) {

		$def_config                = $this->stm_ew_get_preset_default_values();
		$def_config['default']     = array();
		$def_config['label_block'] = true;

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'label'       => $config['label'],
				'type'        => Controls_Manager::SLIDER,
				'description' => $config['description'],
				'show_label'  => $config['show_label'],
				'label_block' => $config['label_block'],
				'separator'   => $config['separator'],
				'size_units'  => $config['size_units'],
				'range'       => $config['range'],
				'default'     => $config['default'],
				'selectors'   => $config['selectors'],
			)
		);
	}
}
