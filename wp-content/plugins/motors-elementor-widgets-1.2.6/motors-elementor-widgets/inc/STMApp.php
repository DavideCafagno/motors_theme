<?php

namespace STM_E_W;

use Elementor\Plugin;
use STM_E_W\Helpers\IconManager;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\WidgetManager\WidgetsManager;

class STMApp {

	const WIDGET_CATEGORY       = 'stylemixthemes';
	const WIDGET_CATEGORY_TITLE = 'StylemixThemes';
	const STM_PREFIX            = 'stm';

	private static $widgets = array();

	public function __construct() {
		new IconManager();

		self::$widgets = WidgetsManager::getInstance()->stm_ew_get_all_registered_widgets();

		add_action( 'elementor/widgets/register', array( self::class, 'stm_ew_register_elementor_widgets' ) );

		add_action( 'elementor/elements/categories_registered', array( self::class, 'stm_ew_register_elementor_widget_categories' ) );

		add_action( 'elementor/editor/before_enqueue_scripts', array( self::class, 'stm_ew_editor_enqueue_scripts' ) );

		add_filter( 'elementor/settings/controls/checkbox_list_cpt/post_type_objects', array( self::class, 'stm_ew_post_type_objects' ) );

		add_action( 'wp_enqueue_scripts', array( self::class, 'stm_ew_enqueue_scripts' ) );
	}

	public static function stm_ew_enqueue_scripts() {
		// TODO: check for all widgets in use and if there's one using SwiperJS load swiper conditionally.
		if ( ! wp_script_is( 'swiper', 'registered' ) ) {
			wp_enqueue_script( 'swiper', ELEMENTOR_ASSETS_URL . 'lib/swiper/swiper.min.js', array(), MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, true );
		}
	}

	public static function stm_ew_post_type_objects( $post_types_objects ) {
		return apply_filters( 'stm_ew_modify_post_type_objects', $post_types_objects );
	}

	public static function stm_ew_editor_enqueue_scripts() {
		wp_enqueue_style( 'stm-elementor-icons', MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/icons/style.css', array(), MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		wp_enqueue_style( 'stm-elementor-editor', MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/css/editor.css', array(), MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
	}

	public static function stm_ew_register_elementor_widget_categories() {
		Plugin::instance()->elements_manager->add_category(
			self::WIDGET_CATEGORY,
			array(
				'title' => self::WIDGET_CATEGORY_TITLE,
				'icon'  => '',
			)
		);
	}

	public static function stm_ew_register_elementor_widgets() {

		if ( count( self::$widgets ) > 0 ) {
			foreach ( self::$widgets as $widget_class ) {
				Plugin::instance()->widgets_manager->register( new $widget_class() );
			}
		}
	}

	public static function stm_ew_plugin_activation() {
		if ( ! get_option( 'stm_elementor_widget_active', false ) ) {
			update_option( 'stm_elementor_widget_active', true );
		}
	}

	public static function stm_ew_plugin_deactivation() {
		if ( get_option( 'stm_elementor_widget_active', false ) ) {
			delete_option( 'stm_elementor_widget_active' );
		}
	}

	public static function stm_ew_plugin_uninstall() {
		if ( get_option( 'stm_elementor_widget_active', false ) ) {
			delete_option( 'stm_elementor_widget_active' );
		}
	}
}
