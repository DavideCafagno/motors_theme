<?php

namespace STM_E_W\Widgets\Controls;

trait Control {

	abstract public function add_control( $id, array $args, $options = array() );

	abstract public function add_group_control( $group_name, array $args = array(), array $options = array() );

	abstract public function get_settings_for_display( $key = null );

	abstract public function add_responsive_control( $id, array $args, $options = array() );

	protected function stm_ew_get_preset_default_values() {
		$preset = array(
			'label'                  => '',
			'placeholder'            => '',
			'description'            => '',
			'show_label'             => true,
			'prevent_empty'          => true,
			'label_block'            => false,
			'separator'              => 'default',
			'input_type'             => '',
			'rows'                   => 10,
			'max'                    => '',
			'min'                    => '',
			'step'                   => '',
			'title'                  => '',
			'title_field'            => '',
			'classes'                => '',
			'fields'                 => array(),
			'default'                => '',
			'fa4compatibility'       => '',
			'recommended'            => '',
			'skin'                   => 'media',
			'exclude_inline_options' => '',
			'options'                => '',
			'alpha'                  => true,
			'label_on'               => 'On',
			'label_off'              => 'Off',
			'return_value'           => 'yes',
			'exclude'                => array(),
			'size_units'             => array( 'px' ),
			'selector'               => '',
			'selectors'              => array(),
			'condition'              => array(),
			'conditions'             => array(),
			'multiple'               => false,
			'media_types'            => array( 'image' ),
			'fields_options'         => array(),
			'range'                  => array(),
			'language'               => 'html',
			'isLinked'               => false,
			'tablet_default'         => array(),
			'mobile_default'         => array(),
			'devices'                => array(),
			'types'                  => array(),
		);

		return $preset;
	}
}
