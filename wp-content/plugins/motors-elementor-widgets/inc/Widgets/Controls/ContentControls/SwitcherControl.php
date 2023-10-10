<?php


namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait SwitcherControl {
	use Control;

	protected function stm_ew_add_switcher( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => $config['label'],
				'description'  => $config['description'],
				'show_label'   => $config['show_label'],
				'label_block'  => $config['label_block'],
				'separator'    => $config['separator'],
				'label_on'     => $config['label_on'],
				'label_off'    => $config['label_off'],
				'return_value' => $config['return_value'],
				'default'      => $config['default'],
				'condition'    => $config['condition'],
				'conditions'   => $config['conditions'],
			)
		);
	}
}
