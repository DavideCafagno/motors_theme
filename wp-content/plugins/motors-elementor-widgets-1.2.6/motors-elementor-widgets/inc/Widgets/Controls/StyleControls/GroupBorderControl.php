<?php

namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Group_Control_Border;
use STM_E_W\Widgets\Controls\Control;

trait GroupBorderControl {
	use Control;

	protected function stm_ew_add_border( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => $id,
				'label'          => $config['label'],
				'description'    => $config['description'],
				'show_label'     => $config['show_label'],
				'label_block'    => $config['label_block'],
				'separator'      => $config['separator'],
				'selector'       => $config['selector'],
				'fields_options' => $config['fields_options'],
				'exclude'        => $config['exclude'],
				'condition'      => $config['condition'],
			)
		);
	}
}
