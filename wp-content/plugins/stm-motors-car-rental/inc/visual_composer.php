<?php

add_action('init', 'motors_rental_update_existing_shortcodes');

function motors_rental_update_existing_shortcodes()
{

	if (function_exists('vc_add_params')) {

	    $prods = (function_exists('wc_get_products')) ? wc_get_products(array('post_type' => 'product', 'posts_per_page' => -1)) : null;

        $atts = (function_exists('wc_get_attribute_taxonomies')) ? wc_get_attribute_taxonomies() : null;

        $attrList = array();
        if($atts) {
            foreach ($atts as $attr) {
                $attrList[$attr->attribute_label] = $attr->attribute_name;
            }
        }

        $productsList = array();
        if($prods) {
            foreach ( $prods as $prod ) {
                $productsList[$prod->get_name()] = $prod->get_id();
            }
        }

		vc_map( array(
			'html_template' => STM_MOTORS_CAR_RENTAL_PATH . '/vc_templates/stm_rental_two_car_form.php',
			"name" => esc_html__('STM RCT Search Form', 'stm_motors_review'),
			"base" => "stm_rental_two_car_form",
			"content_element" => true,
            'category' => __('STM Rental Two', 'motors'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Title', 'motors'),
                    'param_name' => 'title',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Set working hours. example: 9-18', 'motors'),
                    'param_name' => 'office_working_hours',
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __('Css', 'motors'),
                    'param_name' => 'css',
                    'group' => __('Design options', 'motors')
                )
            )
		) );

		vc_map( array(
			'html_template' => STM_MOTORS_CAR_RENTAL_PATH . '/vc_templates/stm_rental_two_special_product.php',
			"name" => esc_html__('STM RCT Sticky Special Product', 'stm_motors_review'),
			"base" => "stm_rental_two_special_product",
			"content_element" => true,
            'category' => __('STM Rental Two', 'motors'),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select special product', 'motors'),
                    'param_name' => 'special_product',
                    'value' => $productsList,
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __('Check Attribute for Information', 'motors'),
                    'param_name' => 'atts_for_info',
                    'value' => $attrList
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __('Css', 'motors'),
                    'param_name' => 'css',
                    'group' => __('Design options', 'motors')
                )
            )
		) );

		vc_map( array(
			'html_template' => STM_MOTORS_CAR_RENTAL_PATH . '/vc_templates/stm_rental_two_flip_info_box.php',
			"name" => esc_html__('STM RCT Flip Info Box', 'stm_motors_review'),
			"base" => "stm_rental_two_info_box",
			"content_element" => true,
            'category' => __('STM Rental Two', 'motors'),
            'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => __('Image', 'motors'),
					'param_name' => 'image'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'motors'),
					'param_name' => 'title',
				),
				array(
					'type' => 'textarea',
					'heading' => __('Description', 'motors'),
					'param_name' => 'description',
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Hide Image', 'motors'),
					'param_name' => 'hide_image'
				),
				array(
					'type' => 'textarea',
					'heading' => __('Hide Description', 'motors'),
					'param_name' => 'hide_description',
				),
                array(
                    'type' => 'css_editor',
                    'heading' => __('Css', 'motors'),
                    'param_name' => 'css',
                    'group' => __('Design options', 'motors')
                )
            )
		) );

		vc_map( array(
			'html_template' => STM_MOTORS_CAR_RENTAL_PATH . '/vc_templates/stm_rental_two_icon_info_box.php',
			"name" => esc_html__('STM RCT Info Box', 'stm_motors_review'),
			"base" => "stm_rental_two_icon_info_box",
			"content_element" => true,
            'category' => __('STM Rental Two', 'motors'),
            'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => __('SVG Image', 'motors'),
					'param_name' => 'svg_image'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'motors'),
					'param_name' => 'title',
				),
				array(
					'type' => 'textarea',
					'heading' => __('Description', 'motors'),
					'param_name' => 'description',
				),
                array(
                    'type' => 'css_editor',
                    'heading' => __('Css', 'motors'),
                    'param_name' => 'css',
                    'group' => __('Design options', 'motors')
                )
            )
		) );

		vc_map(array(
			'html_template' => STM_MOTORS_CAR_RENTAL_PATH . '/vc_templates/stm_rental_two_team_members.php',
			'name' => __('STM RCT Team Members', 'stm_motors_review'),
			'base' => 'stm_rental_two_team_members',
			'as_parent' => array('only' => 'stm_rental_two_team_member'),
			'category' => __('STM Rental Two', 'motors'),
			'params' => array(
				array(
					'type' => 'css_editor',
					'heading' => __('Css', 'motors'),
					'param_name' => 'css',
					'group' => __('Design options', 'motors')
				)
			),
			'js_view' => 'VcColumnView'
		));

		vc_map( array(
			'html_template' => STM_MOTORS_CAR_RENTAL_PATH . '/vc_templates/stm_rental_two_team_member.php',
			"name" => esc_html__('STM RCT Team Member', 'stm_motors_review'),
			"base" => "stm_rental_two_team_member",
			"content_element" => true,
			'as_child' => array('only' => 'stm_rental_two_team_members'),
            'category' => __('STM Rental Two', 'motors'),
            'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => __('Image', 'motors'),
					'param_name' => 'image'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Member Name', 'motors'),
					'param_name' => 'member_name',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Member Position', 'motors'),
					'param_name' => 'member_position',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Facebook', 'motors'),
					'param_name' => 'fb',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Twitter', 'motors'),
					'param_name' => 'tw',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Instagram', 'motors'),
					'param_name' => 'insta',
				),
                array(
                    'type' => 'css_editor',
                    'heading' => __('Css', 'motors'),
                    'param_name' => 'css',
                    'group' => __('Design options', 'motors')
                )
            )
		) );

		vc_map( array(
			'html_template' => STM_MOTORS_CAR_RENTAL_PATH . '/vc_templates/stm_rental_two_rent_advertise.php',
			"name" => esc_html__('STM RCT Rent Advertise', 'stm_motors_review'),
			"base" => "stm_rental_two_rent_advertise",
			"content_element" => true,
			'category' => __('STM Rental Two', 'motors'),
            'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => __('Banner Image', 'motors'),
					'param_name' => 'image'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'motors'),
					'param_name' => 'title',
				),
				array(
					'type' => 'textarea',
					'heading' => __('Description', 'motors'),
					'param_name' => 'desc',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Button Link', 'motors'),
					'param_name' => 'link',
				),
                array(
                    'type' => 'css_editor',
                    'heading' => __('Css', 'motors'),
                    'param_name' => 'css',
                    'group' => __('Design options', 'motors')
                )
            )
		) );
	}
}


if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Rental_Two_Team_Members extends WPBakeryShortCodesContainer {
	}
	class WPBakeryShortCode_Stm_Rental_Two_Car_Form extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Rental_Two_Special_Product extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Rental_Two_Info_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Rental_Two_Icon_Info_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Rental_Two_Team_Member extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Rental_Two_Rent_Advertise extends WPBakeryShortCode {
	}
}