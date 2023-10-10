<?php

namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait TextControl {

	use Control;

	protected function stm_ew_add_text( $id, $config ) {

		$def_config               = $this->stm_ew_get_preset_default_values();
		$def_config['input_type'] = 'text';

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => $config['label'],
				'placeholder' => $config['placeholder'],
				'description' => $config['description'],
				'show_label'  => $config['show_label'],
				'label_block' => $config['label_block'],
				'separator'   => $config['separator'],
				'input_type'  => $config['input_type'],
				'classes'     => $config['classes'],
				'default'     => $config['default'],
				'selectors'   => $config['selectors'],
				'condition'   => $config['condition'],
				'conditions'  => $config['conditions'],
			)
		);
	}
}
