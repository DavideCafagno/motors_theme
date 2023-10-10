<?php


namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait DimensionsControl {
	use Control;

	protected function stm_ew_add_dimensions( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$this->add_responsive_control(
			$id,
			array(
				'type'        => Controls_Manager::DIMENSIONS,
				'label'       => $config['label'],
				'description' => $config['description'],
				'show_label'  => $config['show_label'],
				'label_block' => $config['label_block'],
				'separator'   => $config['separator'],
				'size_units'  => $config['size_units'],
				'default'     => $config['default'],
				'selectors'   => $config['selectors'],
				'condition'   => $config['condition'],
				'conditions'   => $config['conditions'],
			)
		);
	}
}
