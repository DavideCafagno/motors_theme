<?php

namespace STM_E_W\Widgets\WidgetManager;

use STM_E_W\Widgets\ColoredSeparator;
use STM_E_W\Widgets\IconBox;
use STM_E_W\Widgets\IconCounter;
use STM_E_W\Widgets\TeamMember;
use STM_E_W\Widgets\Accordion;
use STM_E_W\Widgets\ContactFormSeven;
use STM_E_W\Widgets\GoogleMap;


class WidgetsManager {

	private static $instance = array();

	protected function __construct() { }

	protected function __clone() { }

	public static function getInstance() {
		$cls = static::class;
		if ( ! isset( self::$instance[ $cls ] ) ) {
			self::$instance[ $cls ] = new static();
		}

		return self::$instance[ $cls ];
	}

	public function stm_ew_get_all_registered_widgets() {
		$widgets = array(
			IconBox::class,
			ColoredSeparator::class,
			TeamMember::class,
			Accordion::class,
			ContactFormSeven::class,
			GoogleMap::class,
			IconCounter::class,
		);

		return $widgets;
	}
}
