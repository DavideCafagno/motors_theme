<?php


namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait UrlControl {
	use Control;

	protected function stm_ew_add_url( $id, $config ) {

		$def_config            = $this->stm_ew_get_preset_default_values();
		$def_config['options'] = array();
		$def_config['default'] = array();

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'type'        => Controls_Manager::URL,
				'label'       => $config['label'],
				'description' => $config['description'],
				'show_label'  => $config['show_label'],
				'label_block' => $config['label_block'],
				'separator'   => $config['separator'],
				'placeholder' => $config['placeholder'],
				'options'     => $config['options'],
				'default'     => $config['default'],
				'condition'   => $config['condition'],
			)
		);
	}

	protected function stm_ew_parse_url( $id, $settings ) {
		if ( ! empty( $settings[ $id ] ) ) {
			$this->add_link_attributes( $id, $settings[ $id ] );

			return $this->get_render_attribute_string( $id );
		}

		return false;
	}
}
