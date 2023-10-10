<?php

namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait HeadingControl {

	use Control;

	protected function stm_ew_add_heading( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'type'        => Controls_Manager::HEADING,
				'label'       => $config['label'],
				'description' => $config['description'],
				'show_label'  => $config['show_label'],
				'label_block' => $config['label_block'],
				'separator'   => $config['separator'],
			)
		);
	}
}
