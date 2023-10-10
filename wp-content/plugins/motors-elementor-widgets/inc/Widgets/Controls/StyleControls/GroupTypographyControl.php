<?php


namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Group_Control_Typography;
use STM_E_W\Widgets\Controls\Control;

trait GroupTypographyControl {
	use Control;

	private $def_props = array(
		'font_size',
		'font_size_tablet',
		'font_size_mobile',
		'font_family',
		'font_style',
		'font_weight',
		'text_transform',
		'text_decoration',
		'letter_spacing',
		'word_spacing',
		'line_height',
	);

	protected function stm_ew_add_group_typography( $id, $config ) {

		$def_config = $this->stm_ew_get_preset_default_values();

		$config = array_merge( $def_config, $config );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => $id,
				'label'          => $config['label'],
				'description'    => $config['description'],
				'show_label'     => $config['show_label'],
				'label_block'    => $config['label_block'],
				'fields_options' => $config['fields_options'],
				'separator'      => $config['separator'],
				'selector'       => $config['selector'],
				'exclude'        => $config['exclude'],
				'condition'      => $config['condition'],
				'conditions'      => $config['conditions'],
			)
		);
	}
}
