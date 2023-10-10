<?php

namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait MediaControl {
	use Control;

	protected function stm_ew_add_media( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$def_config['default'] = array();

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'type'        => Controls_Manager::MEDIA,
				'label'       => $config['label'],
				'description' => $config['description'],
				'show_label'  => $config['show_label'],
				'label_block' => $config['label_block'],
				'separator'   => $config['separator'],
				'media_types' => $config['media_types'],
				'condition'   => $config['condition'],
				'default'     => $config['default'],
			)
		);
	}
}
