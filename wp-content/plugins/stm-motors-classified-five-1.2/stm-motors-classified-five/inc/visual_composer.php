<?php
add_action('vc_before_init', 'motors_c_f_vc_set_as_theme');

function motors_c_f_vc_set_as_theme()
{
	vc_set_as_theme(true);
}

if (function_exists('vc_set_default_editor_post_types')) {
	vc_set_default_editor_post_types(array('page', 'post'));
}

add_action('init', 'motors_c_f_update_existing_shortcodes');

function motors_c_f_update_existing_shortcodes()
{

	if (function_exists('vc_add_params')) {

		$cats = get_categories(
			array(
				'taxonomy' => 'listing-category',
				'hide_empty' => 0,
				'post_type' => 'listing'
			)
		);

		$pages = new WP_Query(array('post_type' => 'listing_type', 'posts_per_page' => -1, 'post_status' => 'publish'));
		$types = array('Select Type' => '');

		if($pages->have_posts()) {
			foreach ( $pages->get_posts() as $post ) {
				$types[$post->post_title] = $post->ID;
			}
		}
		wp_reset_postdata();

		$catsArr = array('Select Category' => '');
		$catsForFeatured = array('Select Category' => '');
		foreach ($cats as $cat) {
			$catsArr[$cat->name] = $cat->slug;
			$catsForFeatured[$cat->name] = $cat->id;
		}

	    vc_map( array(
			'html_template' => STM_MOTORS_C_F_PATH . '/vc_templates/stm_c_f_search_form_category.php',
			"name" => esc_html__('STM Search Form Category', 'stm_motors_classified_five'),
			"base" => "stm_c_f_search_form_category",
			"content_element" => true,
            'category' => __('STM Classified Five', 'stm_motors_classified_five'),
			'params' => array(
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_classified_five'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_classified_five')
				)
			)
		) );

	    vc_map( array(
			'html_template' => STM_MOTORS_C_F_PATH . '/vc_templates/stm_c_f_featured_listings.php',
			"name" => esc_html__('STM Featured Listings', 'stm_motors_classified_five'),
			"base" => "stm_c_f_featured_listings",
			"content_element" => true,
            'category' => __('STM Classified Five', 'stm_motors_classified_five'),
			'params' => array (
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'stm_motors_classified_five'),
					'param_name' => 'featured_title',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Listing Type', 'stm_motors_classified_five'),
					'param_name' => 'listing_type',
					'value' => $types,
				),
				array(
					'type' => 'textfield',
					'heading' => __('Posts Limit', 'stm_motors_classified_five'),
					'param_name' => 'posts_limit',
				),
			)
		) );

	    vc_map( array(
			'html_template' => STM_MOTORS_C_F_PATH . '/vc_templates/stm_c_f_category_tabs.php',
			"name" => esc_html__('STM Categories Tabs', 'stm_motors_classified_five'),
			"base" => "stm_c_f_category_tabs",
			"content_element" => true,
            'category' => __('STM Classified Five', 'stm_motors_classified_five'),
            'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'stm_motors_classified_five'),
					'param_name' => 'categories_title',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Number of Posts', 'stm_motors_classified_five'),
					'param_name' => 'posts_per_page',
					'std' => 8
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_classified_five'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_classified_five')
				)
            )
		) );

	    vc_map( array(
			'html_template' => STM_MOTORS_C_F_PATH . '/vc_templates/stm_c_f_recent_items.php',
			"name" => esc_html__('STM Recent Items', 'stm_motors_classified_five'),
			"base" => "stm_c_f_recent_items",
			"content_element" => true,
            'category' => __('STM Classified Five', 'stm_motors_classified_five'),
            'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'stm_motors_classified_five'),
					'param_name' => 'recent_title',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Listing Type', 'stm_motors_classified_five'),
					'param_name' => 'listing_type',
					'value' => $types,
				),
				array(
					'type' => 'textfield',
					'heading' => __('Number of Posts', 'stm_motors_classified_five'),
					'param_name' => 'posts_per_page',
					'std' => 8
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Show As Carousel', 'stm_motors_classified_five'),
					'param_name' => 'show_as_carousel',
					'value' => array(
						__('Yes', 'stm_motors_classified_five') => 'yes',
					),
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_classified_five'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_classified_five')
				)
            )
		) );


		vc_map(array(
			'html_template' => STM_MOTORS_C_F_PATH . '/vc_templates/stm_browse_by_type.php',
			'name' => __('STM Browse by Type', 'stm_motors_classified_five'),
			'base' => 'stm_browse_by_type',
			'as_parent' => array('only' => 'stm_type'),
			'category' => __('STM Classified Five', 'stm_motors_classified_five'),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'stm_motors_classified_five'),
					'param_name' => 'categories_title',
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Show All Tab', 'stm_motors_classified_five'),
					'param_name' => 'show_all_tab',
					'value' => array(
						__('Yes', 'stm_motors_classified_five') => 'yes',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Load More', 'stm_motors_classified_five'),
					'param_name' => 'load_more',
					'value' => array(
						__('Yes', 'stm_motors_classified_five') => 'yes',
					),
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_classified_five'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_classified_five')
				)
			),
			'js_view' => 'VcColumnView'
		));

		vc_map(array(
			'html_template' => STM_MOTORS_C_F_PATH . '/vc_templates/stm_type.php',
			'name' => __('STM Type', 'stm_motors_classified_five'),
			'base' => 'stm_type',
			'as_child' => array('only' => 'stm_browse_by_type'),
			'category' => __('STM Classified Five', 'stm_motors_classified_five'),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __('Number of Posts', 'stm_motors_classified_five'),
					'param_name' => 'posts_per_page',
					'std' => 8
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Listing Type', 'stm_motors_classified_five'),
					'param_name' => 'listing_type',
					'value' => $types,
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Category', 'stm_motors_classified_five'),
					'param_name' => 'listing_category',
					'value' => $catsArr,
				),
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_C_F_PATH . '/vc_templates/stm_c_f_icon_box.php',
			'name' => __('STM CF Icon Box', 'stm_motors_classified_five'),
			'base' => 'stm_c_f_icon_box',
			'icon' => 'stm_icon_box',
			'category' => __('STM Classified Five', 'stm_motors_classified_five'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'heading' => __('Title', 'stm_motors_classified_five'),
					'param_name' => 'title'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Title Holder', 'stm_motors_classified_five'),
					'param_name' => 'title_holder',
					'value' => array(
						'H1' => 'h1',
						'H2' => 'h2',
						'H3' => 'h3',
						'H4' => 'h4',
						'H5' => 'h5',
						'H6' => 'h6',
					),
					'std' => 'h3'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'stm_motors_classified_five'),
					'param_name' => 'style_layout',
					'value' => array(
						esc_html__('Car dealer', 'stm_motors_classified_five') => 'car_dealer',
						esc_html__('Boats', 'stm_motors_classified_five') => 'boats'
					),
					'std' => 'car_dealer'
				),
				array(
					'type' => 'vc_link',
					'heading' => __('Link', 'stm_motors_classified_five'),
					'param_name' => 'link'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Box background color', 'stm_motors_classified_five'),
					'param_name' => 'box_bg_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Box text color', 'stm_motors_classified_five'),
					'param_name' => 'box_text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Box text color on hover', 'stm_motors_classified_five'),
					'param_name' => 'box_text_color_hover',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon background color', 'stm_motors_classified_five'),
					'param_name' => 'icon_bg_color',
					'description' => __('Don\'t forget to add paddings in Icon design options tab', 'stm_motors_classified_five'),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Show bottom triangle', 'stm_motors_classified_five'),
					'param_name' => 'bottom_triangle',
				),
				array(
					'type' => 'iconpicker',
					'heading' => __('Icon', 'stm_motors_classified_five'),
					'param_name' => 'icon',
					'value' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon color', 'stm_motors_classified_five'),
					'param_name' => 'icon_color',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon Size', 'stm_motors_classified_five'),
					'param_name' => 'icon_size',
					'description' => __('Enter icon size in px', 'stm_motors_classified_five')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Content line height', 'stm_motors_classified_five'),
					'param_name' => 'line_height',
					'description' => __('Optional', 'stm_motors_classified_five')
				),
				array(
					'type' => 'textarea_html',
					'heading' => __('Text', 'stm_motors_classified_five'),
					'param_name' => 'content'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Button text', 'stm_motors_classified_five'),
					'param_name' => 'btn_text'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Button color', 'stm_motors_classified_five'),
					'param_name' => 'btn_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Button hover color', 'stm_motors_classified_five'),
					'param_name' => 'btn_hover_color',
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Icon Css', 'stm_motors_classified_five'),
					'param_name' => 'css_icon',
					'group' => __('Icon Design options', 'stm_motors_classified_five')
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_classified_five'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_classified_five')
				)
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_C_F_PATH . '/vc_templates/stm_c_f_latest_posts.php',
			'name' => __('STM Latest Posts', 'stm_motors_classified_five'),
			'base' => 'stm_latest_posts',
			'category' => __('STM Classified Five', 'stm_motors_classified_five'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'heading' => __('Title', 'stm_motors_classified_five'),
					'param_name' => 'title'
				),
				array(
					'type' => 'textarea_html',
					'heading' => __('Subtitle content', 'stm_motors_classified_five'),
					'param_name' => 'content'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Number of Posts', 'stm_motors_classified_five'),
					'param_name' => 'posts_per_page',
					'std' => 3
				),
			)
		));
	}
}


if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Browse_By_Type extends WPBakeryShortCodesContainer
	{
	}

	class WPBakeryShortCode_Stm_C_F_SearchFormCategory extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_C_F_FeaturedListings extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_C_F_Recent_Items extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_Type extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_Latest_Posts extends WPBakeryShortCode
	{
	}

	/*class WPBakeryShortCode_Stm_C_F_Category_Tabs extends WPBakeryShortCode {
	}*/

	class WPBakeryShortCode_Stm_C_F_Icon_Box extends WPBakeryShortCode {
	}

}

add_filter('vc_iconpicker-type-fontawesome', 'vc_stm_icons');

if (!function_exists('vc_stm_icons')) {
	function vc_stm_icons($fonts)
	{

		global $wp_filesystem;

		if (empty($wp_filesystem)) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$custom_fonts = get_option('stm_fonts');
		foreach ($custom_fonts as $font => $info) {
			$icon_set = array();
			$icons = array();
			$upload_dir = wp_upload_dir();
			$path = trailingslashit($upload_dir['basedir']);
			$file = $path . $info['include'] . '/' . $info['config'];
			include($file);
			if (!empty($icons)) {
				$icon_set = array_merge($icon_set, $icons);
			}
			if (!empty($icon_set)) {
				foreach ($icon_set as $icons) {
					foreach ($icons as $icon) {
						$fonts['Theme Icons'][] = array(
							$font . '-' . $icon['class'] => $icon['class']
						);
					}
				}
			}
		}

		$service_icons = json_decode($wp_filesystem->get_contents(get_template_directory() . '/assets/icons_json/service_icons.json'), true);

		foreach ($service_icons['icons'] as $icon) {
			$fonts['Service Icons'][] = array(
				"stm-service-icon-" . $icon['properties']['name'] => 'STM ' . $icon['properties']['name']
			);
		}

		if (stm_is_boats()) {
			$boat_icons = json_decode($wp_filesystem->get_contents(get_template_directory() . '/assets/icons_json/boat_icons.json'), true);

			foreach ($boat_icons['icons'] as $icon) {
				$fonts['Boat Icons'][] = array(
					"stm-boats-icon-" . $icon['properties']['name'] => 'STM ' . $icon['properties']['name']
				);
			}
		}

		$moto_icons = json_decode($wp_filesystem->get_contents(get_template_directory() . '/assets/icons_json/moto_icons.json'), true);

		foreach ($moto_icons['icons'] as $icon) {
			$fonts['Motorcycle Icons'][] = array(
				"stm-moto-icon-" . $icon['properties']['name'] => 'STM ' . $icon['properties']['name']
			);
		}

		$rent_icons = json_decode($wp_filesystem->get_contents(get_template_directory() . '/assets/icons_json/rental_icons.json'), true);

		foreach ($rent_icons['icons'] as $icon) {
			$fonts['Rental Icons'][] = array(
				"stm-rental-" . $icon['properties']['name'] => 'STM ' . $icon['properties']['name']
			);
		}


		return $fonts;
	}
}