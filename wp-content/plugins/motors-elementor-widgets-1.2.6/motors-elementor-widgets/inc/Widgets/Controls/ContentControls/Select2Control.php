<?php

namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait Select2Control {
	use Control;

	protected function stm_ew_add_select_2( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'type'        => Controls_Manager::SELECT2,
				'label'       => $config['label'],
				'description' => $config['description'],
				'show_label'  => $config['show_label'],
				'label_block' => $config['label_block'],
				'separator'   => $config['separator'],
				'options'     => $config['options'],
				'multiple'    => $config['multiple'],
				'default'     => $config['default'],
				'condition'   => $config['condition'],
			)
		);
	}
}
