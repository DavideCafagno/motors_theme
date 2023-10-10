<?php


namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Group_Control_Box_Shadow;
use STM_E_W\Widgets\Controls\Control;

trait GroupBoxShadowControl {
	use Control;

	protected function stm_ew_add_group_box_shadow( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'           => $id,
				'label'          => $config['label'],
				'description'    => $config['description'],
				'show_label'     => $config['show_label'],
				'label_block'    => $config['label_block'],
				'separator'      => $config['separator'],
				'selector'       => $config['selector'],
				'exclude'        => $config['exclude'],
				'fields_options' => $config['fields_options'],
				'condition'      => $config['condition'],
			)
		);
	}
}
