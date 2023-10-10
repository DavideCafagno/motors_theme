<?php

namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait CodeControl {
	use Control;

	protected function stm_ew_add_code( $id, $config ) {
		$def_config                = $this->stm_ew_get_preset_default_values();
		$def_config['label_block'] = true;

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'type'        => Controls_Manager::CODE,
				'label'       => $config['label'],
				'description' => $config['description'],
				'show_label'  => $config['show_label'],
				'label_block' => $config['label_block'],
				'separator'   => $config['separator'],
				'rows'        => $config['rows'],
				'language'    => $config['language'],
				'default'     => $config['default'],
			)
		);
	}
}
