<?php

namespace STM_E_W\Helpers;

class IconManager {
	public function __construct() {
		add_filter( 'elementor/icons_manager/additional_tabs', array( self::class, 'stm_ew_register_custom_icons' ), 10, 1 );
	}

	public static function stm_ew_register_custom_icons( $tabs ) {
		$tabs = apply_filters( 'stm_ew_register_icons_tab', $tabs );

		return $tabs;
	}

	public static function stm_ew_get_icons_view_conf( $file_data ) {

		if ( file_exists( $file_data['path'] ) ) {
			wp_enqueue_style( $file_data['handle'], $file_data['style_url'], array( 'elementor-frontend' ), $file_data['v'] );

			$icon_config = json_decode( file_get_contents( $file_data['url'] ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

			$prefix = $icon_config->preferences->fontPref->prefix;

			$icons_collect = array();

			foreach ( $icon_config->icons as $k => $icon ) {
				$icons_collect[ $prefix . $icon->properties->name ] = $icon->properties->name;
			}

			return $icons_collect;
		}

		return false;
	}
}
