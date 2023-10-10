<?php

namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Group_Control_Background;
use STM_E_W\Widgets\Controls\Control;

trait GroupBackgroundControl {
	use Control;

	protected function stm_ew_add_background( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'           => $id,
				'label'          => $config['label'],
				'description'    => $config['description'],
				'show_label'     => $config['show_label'],
				'label_block'    => $config['label_block'],
				'separator'      => $config['separator'],
				'types'          => $config['types'],
				'selector'       => $config['selector'],
				'fields_options' => $config['fields_options'],
				'exclude'        => $config['exclude'],
			)
		);
	}
}
