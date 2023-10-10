<?php

add_action('init', 'motors_equipment_update_existing_shortcodes');

function motors_equipment_update_existing_shortcodes()
{

	if (function_exists('vc_add_params')) {

		if (function_exists('stm_get_car_filter')) {
			$filter_options = stm_get_car_filter();
		} else {
			$filter_options = array();
		}

		$stm_filter_options = array();

		if (!empty($filter_options)) {
			foreach ($filter_options as $filter_option) {

				$stm_filter_options[$filter_option['single_name'] . ' (' . $filter_option['slug'] . ')'] = $filter_option['slug'];
			}
		}

	    vc_map( array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_search.php',
			"name" => esc_html__('STM Search', 'stm_motors_equipment'),
			"base" => "stm_equip_search",
			"content_element" => true,
            'category' => __('STM Equipment', 'stm_motors_equipment'),
            'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __('Search button title', 'stm_motors_equipment'),
					'param_name' => 'search_button_title',
					'std' => __('Search', 'stm_motors_equipment'),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Select Taxonomies, which will be in this tab as filter', 'stm_motors_equipment'),
					'param_name' => 'filter_all',
					'value' => $stm_filter_options,
					'dependency' => array('element' => 'show_all', 'value' => 'yes'),
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
            )
		) );

	    vc_map( array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_category_grid_filter.php',
			"name" => esc_html__('STM Category Grid Filter', 'stm_motors_equipment'),
			"base" => "stm_equip_category_grid_filter",
			"content_element" => true,
            'category' => __('STM Equipment', 'stm_motors_equipment'),
            'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'stm_motors_equipment'),
					'param_name' => 'title',
					'std' => __('Equipment', 'stm_motors_equipment'),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Select Style', 'stm_motors_equipment'),
					'param_name' => 'view_style',
					'value' => array(
						'Style 1' => 'style_1',
						'Style 2' => 'style_2',
						'Style 3' => 'style_3',
					),
					'std' => 'style_1'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Category numbers', 'motors'),
					'param_name' => 'cat_numbers',
					'dependency' => array(
						'element' => 'view_style',
						'value' => array('style_3')
					),
					'value' => array(
						'6' => '6',
						'12' => '12',
					),
					'std' => '12'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Select category', 'stm_motors_equipment'),
					'param_name' => 'selected_category',
					'value' => $stm_filter_options,
					'std' => ''
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
            )
		) );

		vc_map(array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_featured.php',
			'name' => __('STM Featured', 'stm_motors_equipment'),
			'base' => 'stm_equip_featured',
			'category' => __('STM Equipment', 'stm_motors_equipment'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'heading' => __('Title', 'stm_motors_equipment'),
					'param_name' => 'title'
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Carousel BG', 'stm_motors_equipment'),
					'param_name' => 'carousel_img'
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_inventory.php',
			'name' => __('STM Inventory', 'stm_motors_equipment'),
			'base' => 'stm_equip_inventory',
			'category' => __('STM Equipment', 'stm_motors_equipment'),
			'params' => array(
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_data.php',
			'name' => __('STM Equip Data', 'stm_motors_equipment'),
			'base' => 'stm_equip_data',
			'category' => __('STM Equipment', 'stm_motors_equipment'),
			'params' => array(
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_links.php',
			'name' => __('STM Equip Links', 'stm_motors_equipment'),
			'base' => 'stm_equip_links',
			'category' => __('STM Equipment', 'stm_motors_equipment'),
			'params' => array(
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_price_title.php',
			'name' => __('STM Equip Title Price', 'stm_motors_equipment'),
			'base' => 'stm_equip_price_title',
			'category' => __('STM Equipment', 'stm_motors_equipment'),
			'params' => array(
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_gallery.php',
			'name' => __('STM Equip Gallery', 'stm_motors_equipment'),
			'base' => 'stm_equip_gallery',
			'category' => __('STM Equipment', 'stm_motors_equipment'),
			'params' => array(
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_grid_gallery.php',
			'name' => __('STM Grid Gallery', 'stm_motors_equipment'),
			'base' => 'stm_equip_grid_gallery',
			'category' => __('STM Equipment', 'stm_motors_equipment'),
			'params' => array(
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
			)
		));

		vc_map(array(
			'html_template' => STM_MOTORS_EQUIPMENT_PATH . '/vc_templates/stm_equip_contact_info.php',
			'name' => __('STM Contact Information', 'stm_motors_equipment'),
			'base' => 'stm_equip_contact_info',
			'category' => __('STM Equipment', 'stm_motors_equipment'),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'stm_motors_equipment'),
					'param_name' => 'title',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Address', 'stm_motors_equipment'),
					'param_name' => 'address',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Phone', 'stm_motors_equipment'),
					'param_name' => 'phone',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Mail', 'stm_motors_equipment'),
					'param_name' => 'mail',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Hours', 'stm_motors_equipment'),
					'param_name' => 'hours',
				),
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'stm_motors_equipment'),
					'param_name' => 'css',
					'group' => __('Design options', 'stm_motors_equipment')
				)
			)
		));
	}
}


if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Equip_Search extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Category_Grid_Filter extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Featured extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Inventory extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Data extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Links extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Price_Title extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Gallery extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Grid_Gallery extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Equip_Contact_Info extends WPBakeryShortCode {
	}
}