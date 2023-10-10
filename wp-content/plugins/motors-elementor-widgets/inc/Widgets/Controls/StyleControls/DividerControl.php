<?php


namespace STM_E_W\Widgets\Controls\StyleControls;

use STM_E_W\Widgets\Controls\Control;

trait DividerControl {
	use Control;

	protected function stm_ew_add_divider( $id ) {
		$this->add_control(
			$id,
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);
	}
}
