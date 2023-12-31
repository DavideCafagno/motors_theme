<?php
/**
 * Color control class.  This class uses the core WordPress color picker.  Expected
 * values are hex colors.  This class also attempts to strip `#` from the hex color.
 * By design, it's recommended to add the `#` on output.
 *
 * @package    ButterBean
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock
 * @link       https://github.com/justintadlock/butterbean
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Color control class.
 *
 * @since  1.0.0
 * @access public
 */
class ButterBean_CarRental_Control_CarRental_Datepicker extends ButterBean_CarRental_Control {

	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'car_rental-datepicker';

	/**
	 * Custom options to pass to the color picker.  Mostly, this is a wrapper for
	 * `iris()`, which is bundled with core WP.  However, if they change pickers
	 * in the future, it may correspond to a different script.
	 *
	 * @link   http://automattic.github.io/Iris/#options
	 * @link   https://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $options = array();

	/**
	 * Enqueue scripts/styles for the control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
        wp_enqueue_style('stm_admin_butterbean_datepicker',
            STM_MOTORS_CAR_RENTAL_URL . '/assets/css/jquery-ui.min.css',
            false,
            1,
            false);
	}

	/**
	 * Gets the attributes for the control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_attr() {
		$attr = parent::get_attr();

		$setting = $this->get_setting();

		$attr['class']              = 'butterbean-car_rental-datepicker';
		$attr['type']               = 'text';

		return $attr;
	}

	/**
	 * Get the value for the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $setting
	 * @return mixed
	 */
	public function get_value( $setting = 'default' ) {

		$value = parent::get_value( $setting );

		return $value;
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$value = $this->get_value();
		if(!empty($value)) {
			$value = date_i18n("d-m-Y", $value);
		}

		$this->json['value'] = $value;
		$this->json['options'] = $this->options;
	}
}
