<?php

namespace Motors_E_W;

use \Elementor\Plugin;
use Motors_E_W\Helpers\AddListingMananger;
use Motors_E_W\Helpers\RegisterActions;
use Motors_E_W\Helpers\TemplateManager;
use Motors_E_W\Widgets\WidgetManager\MotorsWidgetsManager;
use STM_E_W\Helpers\Helper;
use STM_E_W\Helpers\IconManager;


class MotorsApp {
	const WIDGET_CATEGORY                    = 'motors';
	const WIDGET_CATEGORY_TITLE              = 'Motors';
	const WIDGET_CATEGORY_SINGLE             = 'motors_single';
	const WIDGET_CATEGORY_MEGAMENU           = 'motors_megamenu';
	const WIDGET_CATEGORY_TITLE_MEGAMENU     = 'Motors MegaMenu';
	const WIDGET_CATEGORY_TITLE_SINGLE       = 'Motors Single Listing';
	const WIDGET_CATEGORY_CLASSIFIED         = 'motors_classified';
	const WIDGET_CATEGORY_TITLE_CLASSIFIED   = 'Motors Classified';
	const WIDGET_CATEGORY_MULTILISTING       = 'motors_multilisting';
	const WIDGET_CATEGORY_TITLE_MULTILISTING = 'Motors Multi-Listing';
	const STM_PREFIX                         = 'motors';

	private static $widgets = array();

	public function __construct() {
		self::$widgets = MotorsWidgetsManager::getInstance()->stm_ew_get_all_registered_widgets();

		RegisterActions::init();

		if ( 'listing_one_elementor' === get_option( 'stm_motors_chosen_template', '' ) || 'listing_four_elementor' === get_option( 'stm_motors_chosen_template', '' ) || 'listing_three_elementor' === get_option( 'stm_motors_chosen_template', '' ) || 'listing_five_elementor' === get_option( 'stm_motors_chosen_template', '' ) ) {
			AddListingMananger::init();
		}

		TemplateManager::init();

		add_action( 'elementor/widgets/register', array( self::class, 'motors_ew_register_elementor_widgets' ) );

		add_action( 'elementor/elements/categories_registered', array( self::class, 'motors_ew_register_elementor_widget_categories' ) );

		add_filter( 'stm_ew_register_icons_tab', array( self::class, 'motors_ew_register_icons_tab' ), 20, 1 );

		add_action( 'admin_init', array( self::class, 'motors_ew_enqueue_scripts' ) );

		add_action( 'elementor/editor/before_enqueue_scripts', array( self::class, 'motors_ew_editor_enqueue_scripts' ) );
	}

	public static function motors_ew_enqueue_scripts() {
		wp_enqueue_style( 'motors-nuxy-general', MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/css/wpcfto/wpcfto-general.css', array( 'stm-theme-admin-css' ), MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, 'all' );
	}

	public static function motors_ew_editor_enqueue_scripts() {
		wp_enqueue_style( 'stm-elementor-icons', MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/icons/style.css', array(), MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		wp_enqueue_style( 'motors-elementor-editor', MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/css/editor.css', array(), MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
	}

	public static function motors_ew_register_elementor_widget_categories() {
		Plugin::instance()->elements_manager->add_category(
			self::WIDGET_CATEGORY,
			array(
				'title' => self::WIDGET_CATEGORY_TITLE,
				'icon'  => '',
			)
		);

		Plugin::instance()->elements_manager->add_category(
			self::WIDGET_CATEGORY_SINGLE,
			array(
				'title' => self::WIDGET_CATEGORY_TITLE_SINGLE,
				'icon'  => '',
			)
		);

		Plugin::instance()->elements_manager->add_category(
			self::WIDGET_CATEGORY_CLASSIFIED,
			array(
				'title' => self::WIDGET_CATEGORY_TITLE_CLASSIFIED,
				'icon'  => '',
			)
		);

		Plugin::instance()->elements_manager->add_category(
			self::WIDGET_CATEGORY_MULTILISTING,
			array(
				'title' => self::WIDGET_CATEGORY_TITLE_MULTILISTING,
				'icon'  => '',
			)
		);

		if ( Helper::is_megamenu_active() ) {
			Plugin::instance()->elements_manager->add_category(
				self::WIDGET_CATEGORY_MEGAMENU,
				array(
					'title' => self::WIDGET_CATEGORY_TITLE_MEGAMENU,
					'icon'  => '',
				)
			);
		}
	}

	public static function motors_ew_register_elementor_widgets() {
		if ( count( self::$widgets ) > 0 ) {
			foreach ( self::$widgets as $widget_class ) {
				Plugin::instance()->widgets_manager->register( new $widget_class() );
			}
		}
	}

	public static function motors_ew_register_icons_tab( $tabs ) {
		$icon_conf = apply_filters( 'stm_motors_all_default_icons', array() );

		if ( ! empty( $icon_conf ) ) {
			foreach ( $icon_conf as $icons ) {
				$tabs[ $icons['handle'] ] = array(
					'name'          => $icons['handle'],
					'label'         => $icons['name'],
					'url'           => '',
					'enqueue'       => array( $icons['style_url'] ),
					'prefix'        => $icons['prefix'],
					'displayPrefix' => '',
					'labelIcon'     => $icons['label_icon'],
					'ver'           => $icons['v'],
					'fetchJson'     => $icons['charmap'],
				);
			}
		}

		return $tabs;
	}

	public static function motors_ew_plugin_activation() {

	}

	public static function motors_ew_plugin_deactivation() {

	}

	public static function motors_ew_plugin_uninstall() {

	}
}
