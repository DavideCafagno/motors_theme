<?php

namespace STM_E_W\Widgets\Controls\ContentControls;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use STM_E_W\Widgets\Controls\Control;

trait IconsControl {
	use Control;

	protected function stm_ew_add_icons( $id, $config ) {

		$def_config                           = $this->stm_ew_get_preset_default_values();
		$def_config['default']                = array();
		$def_config['recommended']            = array();
		$def_config['exclude_inline_options'] = array();

		$config = array_merge( $def_config, $config );

		$this->add_control(
			$id,
			array(
				'type'                   => Controls_Manager::ICONS,
				'label'                  => $config['label'],
				'description'            => $config['description'],
				'show_label'             => $config['show_label'],
				'label_block'            => $config['label_block'],
				'separator'              => $config['separator'],
				'default'                => $config['default'],
				'fa4compatibility'       => $config['fa4compatibility'],
				'recommended'            => $config['recommended'],
				'skin'                   => $config['skin'],
				'exclude_inline_options' => $config['exclude_inline_options'],
				'condition'				 => $config['condition'],
			)
		);
	}

	protected function stm_ew_get_rendered_icon( $id, $settings ) {

		if ( empty( $settings[ $id ]['value'] ) ) {
			return;
		}

		switch ( $settings[ $id ]['library'] ) {
			case 'svg':
				return '<img src="' . $settings[ $id ]['value']['url'] . '" />';
			default:
				return Icons_Manager::render_font_icon( $settings[ $id ], array( 'aria-hidden' => 'true' ) );
		}
	}
}
