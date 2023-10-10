<?php

namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Group_Control_Image_Size;
use STM_E_W\Widgets\Controls\Control;

trait ImageSizeControl {
	use Control;

	protected function stm_ew_add_image_size( $id, $config = array() ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$def_config['default'] = array();

		$config = array_merge( $def_config, $config );

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => $id,
				'default'   => $config['default'],
				'separator' => $config['separator'],
				'condition' => $config['condition'],
			)
		);

	}
}
