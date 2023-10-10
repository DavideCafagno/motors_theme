<?php


namespace STM_E_W\Widgets\Controls\StyleControls;

use Elementor\Controls_Manager;
use STM_E_W\Widgets\Controls\Control;

trait AlignControl {
	use Control;

	protected function stm_ew_add_align( $id, $label = 'Alignment', $selectors ) {
		$this->add_responsive_control(
			$id,
			array(
				'type' => Controls_Manager::CHOOSE,
				'label' => $label,
				'options' => array(
					'left' => array(
						'title' => esc_html__( 'Left', 'stm-elementor-widgets' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'stm-elementor-widgets' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'stm-elementor-widgets' ),
						'icon' => 'eicon-text-align-right',
					),
				),
				'default' => 'left',
				'toggle' => true,
				'selectors'  => $selectors,
			)
		);
	}
}