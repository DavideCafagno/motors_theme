<?php
add_filter( 'stm_hide_old_headers', 'stm_c_f_theme_hide_old_headers' );
add_filter( 'stm_is_ulisting_layout', 'stm_is_c_f_ulisting_layout' );
add_filter( 'ulisting_inventory_layout_data', 'stm_ulisting_inventory_layout_data');
add_filter( 'ulisting_item_layout_data', 'stm_ulisting_item_layout_data');
add_filter( 'ulisting_feature_limit', 'stm_ulisting_feature_limit');
add_filter( 'stm_get_query_vars', 'stm_c_f_get_query_vars');
add_filter( 'ulisting_account_endpoint', 'stm_c_f_ulisting_account_endpoint');
add_filter( 'ulisting_single_layout_builder_data', 'stm_ulisting_single_layout_builder_data');
add_filter( 'ulisting_attribute_gallery_style_templates', 'stm_ulisting_attribute_gallery_style_templates');
add_filter( 'ulisting_loop_wishlist_template', 'stm_ulisting_loop_wishlist_template');

add_action( 'stm_motors_header', 'stm_c_f_include_header' );
add_action( 'ulisting_profile_edit', 'stm_c_f_ulisting_profile_edit', 100, 1);

if ( !function_exists( 'stm_c_f_theme_hide_old_headers' ) ) {
	function stm_c_f_theme_hide_old_headers()
	{
		return false;
	}
}

if ( !function_exists( 'stm_c_f_include_header' ) ) {
	function stm_c_f_include_header ()
	{
		if ( !is_404() and !is_page_template( 'coming-soon.php' ) ) {
			stm_c_f_load_template( 'header/header' );
		} elseif ( is_page_template( 'coming-soon.php' ) ) {
			stm_c_f_load_template( 'header/header-coming', 'soon' );
		} else {
			stm_c_f_load_template( 'header/header', '404' );
		}

		echo '<div id="main">';
	}
}

if(!function_exists('stm_is_c_f_ulisting_layout')) {
	function stm_is_c_f_ulisting_layout() {
		return true;
	}
}

if(!function_exists('stm_ulisting_inventory_layout_data')) {
	function stm_ulisting_inventory_layout_data ($data) {
		$data['elements'][] = [
			"id" => rand(100, 999)."_".time(),
			"title"        => "BreadCrumbs",
			"type"         => "inventory_element",
			"group"        => "general",
			"module"       => "element",
			"field_group"  => "general",
			"params"       => [
				"template_path"		=> "listing-list/breadcrumbs",
				"template"          => "template_1",
				"type"              => "breadcrumbs",
				"id"                => "",
				"class"             => "",
				"color"             => "",
				"background_color"  => "",
			],
		];

		$data['elements'][] = [
			"id" => rand(100, 999)."_".time(),
			"title"        => "Found Posts",
			"type"         => "inventory_element",
			"group"        => "general",
			"module"       => "element",
			"field_group"  => "general",
			"params"       => [
				"template_path"		=> "listing-list/found_posts",
				"template"          => "template_1",
				"type"              => "found_posts",
				"id"                => "",
				"class"             => "",
				"color"             => "",
				"background_color"  => "",
			],
		];

		return $data;
	}
}

if(!function_exists('stm_ulisting_item_layout_data')) {
	function stm_ulisting_item_layout_data ($data) {

		$data['config']['dealer_logo'] = [
			"field_group" => [
				"advanced" => [
					"name" => "Advanced",
					"fields" => [
						[
							"type"   => "text",
							"label"  => "ID",
							"name"   => "id",
						],
						[
							"type"   => "text",
							"label"  => "Class",
							"name"   => "class",
						]
					]
				]
			]
		];

		$data['elements'][] = [
			"id" => rand(100, 999) . "_" . time(),
			"title" => "Dealer Logo",
			"type" => "element",
			"group" => "general",
			"module" => "element",
			"field_group" => "dealer_logo",
			"params" => [
				"template_path" => "custom/dealer_logo",
				"template" => "template_1",
				"type" => "element",
				"id" => "",
				"class" => "",
			],
		];

		$data['elements'][] = [
			"id" => rand(100, 999) . "_" . time(),
			"title" => "Dealer Info",
			"type" => "element",
			"group" => "general",
			"module" => "element",
			"field_group" => "dealer_logo",
			"params" => [
				"template_path" => "custom/dealer_info",
				"template" => "template_1",
				"type" => "element",
				"id" => "",
				"class" => "",
			],
		];

		return $data;
	}
}

if(!function_exists('stm_ulisting_single_layout_builder_data')) {
	function stm_ulisting_single_layout_builder_data ($data) {

		$data['config']['widget_dealer_info'] = [
			"field_group" => [
				"advanced" => [
					"name" => "Advanced",
					"fields" => [
						[
							"type"   => "text",
							"label"  => "ID",
							"name"   => "id",
						],
						[
							"type"   => "text",
							"label"  => "Class",
							"name"   => "class",
						]
					]
				]
			]
		];

		$data['elements'][] = [
			"id" => rand(100, 999) . "_" . time(),
			"title" => "Widget Dealer Info",
			"type" => "element",
			"group" => "general",
			"module" => "element",
			"field_group" => "widget_dealer_info",
			"params" => [
				"template_path" => "custom/widget/widget_dealer_info",
				"template" => "template_1",
				"type" => "element",
				"id" => "",
				"class" => "",
			],
		];

		$data['elements'][] = [
			"id" => rand(100, 999) . "_" . time(),
			"title" => "Dealer Company Name",
			"type" => "element",
			"group" => "general",
			"module" => "element",
			"field_group" => "widget_dealer_info",
			"params" => [
				"template_path" => "custom/dealer_company_name",
				"template" => "template_1",
				"type" => "element",
				"id" => "",
				"class" => "",
			],
		];

		return $data;
	}
}

if(!function_exists('stm_ulisting_loop_wishlist_template')) {
	function stm_ulisting_loop_wishlist_template ($templates) {
		$templates = [
			"template_1" => [
				"icon" => ULISTING_WISHLIST_URL."/assets/img/favourite.png",
				"name" => "Style 1",
				"template" => '<span data-wishlist_id="[id]" onclick="[click]"  class="ulisting-listing-wishlist stm-cursor-pointer [class] [active] "> <i class="fas fa-heart"></i></span> <span class="[class_load] ulisting-listing-wishlist-beat hidden"><i class="fas fa-heart ld ld-heartbeat"></i></span> ',
			]
		];

		return $templates;
	}
}

if(!function_exists('stm_ulisting_feature_limit')) {
	function stm_ulisting_feature_limit () {
		return 4;
	}
}

if(!function_exists('stm_c_f_get_query_vars')) {
	function stm_c_f_get_query_vars ($vars) {
		return $vars;
	}
}

if(!function_exists('stm_c_f_ulisting_account_endpoint')) {
	function stm_c_f_ulisting_account_endpoint($vars) {
		return $vars;
	}
}

if(!function_exists('stm_ulisting_attribute_gallery_style_templates')) {
	function stm_ulisting_attribute_gallery_style_templates( $styles )
	{

		$styles["ulisting_gallery_style_1"] = [ "icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/gallery/gallery_style_1.jpg", "name" => "Style 1", ];

		return $styles;
	}

}


add_filter("ulisting_user_meta_data", function($data) {
	$company_name = get_user_meta( $data['user']->ID, "company_name" );
	$phone = get_user_meta( $data['user']->ID, "phone" );
	$office = get_user_meta( $data['user']->ID, "cful_office" );
	$fax = get_user_meta( $data['user']->ID, "cful_fax" );
	$address = get_user_meta( $data['user']->ID, "cful_address" );
	$license = get_user_meta( $data['user']->ID, "cful_license" );
	$taxNum = get_user_meta( $data['user']->ID, "cful_tax_number" );

	$data['data']['company_name'] = [
		'name' => "Company Name",
		'value' => ( isset( $company_name[0] ) ) ? $company_name[0] : ""
	];

	$data['data']['phone'] = [
		'name' => "Phone number",
		'value' => ( isset( $phone[0] ) ) ? $phone[0] : ""
	];

	$data['data']['cful_office'] = [
		'name' => "Office",
		'value' => ( isset( $office[0] ) ) ? $office[0] : ""
	];

	$data['data']['cful_fax'] = [
		'name' => "Fax",
		'value' => ( isset( $fax[0] ) ) ? $fax[0] : ""
	];

	$data['data']['cful_address'] = [
		'name' => "Address",
		'value' => ( isset( $address[0] ) ) ? $address[0] : ""
	];

	$data['data']['cful_license'] = [
		'name' => "License",
		'value' => ( isset( $license[0] ) ) ? $license[0] : ""
	];

	$data['data']['cful_tax_number'] = [
		'name' => "Tax number",
		'value' => ( isset( $taxNum[0] ) ) ? $taxNum[0] : ""
	];

	return $data;
}, 100);

add_filter('show_uListing_demo_import', function($bool) {
	return false;
}, 100);

add_filter("ulisting_attribute_style_templates", function($styles) {

	$styles["ulisting_style_4"] = [ "icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/attributes/attribute_style_4.jpg", "name" => "Style 4", "attribute_template" => "
            <div class='attribute_style attribute_style_4'>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value heading-font'>[attribute_value]</div>
                 </div>
            </div>
        ", ];

	$styles["ulisting_style_5"] = [ "icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/attributes/attribute_style_5.jpg", "name" => "Style 5", "attribute_template" => "
            <div class='attribute_style attribute_style_5'>
            	<div class='attribute-icon'>
            		[attribute_icon]
				</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-name'>[attribute_name]</div>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
            </div>
        ", ];

	$styles["ulisting_style_6"] = [
		"icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/attributes/attribute_style_6.jpg",
		"name" => "Style 6",
		"attribute_template" => "
            <div class='attribute_style attribute_style_6'>
            	<div class='attribute-icon'>[attribute_icon]</div>
				<div class='attribute-name'>[attribute_name]</div>
			 	<div class='attribute-value'>[attribute_value]</div>
            </div>
        ",
	];

	$styles["ulisting_style_7"] = [
		"icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/attributes/attribute_style_6.jpg",
		"name" => "Style Features",
		"attribute_template" => "
            <div class='attribute_style attribute_style_features'>
                <h4>[attribute_name]</h4> 
                <ul> [option_items]</ul>
            </div>
        ",
		"option_template" => "<li>[attribute_value]</li>",
	];

	return $styles;
} );

add_filter("ulisting_input_block_style_templates", function($styles) {

	$styles["ulisting_style_4"] = [ "icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/attributes/attribute_style_4.jpg", "name" => "Style 4", "attribute_template" => "
            <div class='attribute_style attribute_style_4'>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-value heading-font'>[attribute_value]</div>
                 </div>
            </div>
        ", ];

	$styles["ulisting_style_5"] = [ "icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/attributes/attribute_style_5.jpg", "name" => "Style 5", "attribute_template" => "
            <div class='attribute_style attribute_style_5'>
            	<div class='attribute-icon'>
            		[attribute_icon]
				</div>
                <div class='attribute-parts-wrap'>
                     <div class='attribute-name'>[attribute_name]</div>
                     <div class='attribute-value'>[attribute_value]</div>
                 </div>
            </div>
        ", ];

	$styles["ulisting_style_6"] = [
		"icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/attributes/attribute_style_6.jpg",
		"name" => "Style 6",
		"attribute_template" => "
            <div class='attribute_style attribute_style_6'>
            	<div class='attribute-icon'>[attribute_icon]</div>
				<div class='attribute-name'>[attribute_name]</div>
			 	<div class='attribute-value'>[attribute_value]</div>
            </div>
        ",
	];

	$styles["ulisting_style_7"] = [
		"icon" => STM_MOTORS_C_F_URL . "/assets/img/ulisting/builder/attributes/attribute_style_6.jpg",
		"name" => "Style Features",
		"attribute_template" => "
            <div class='attribute_style attribute_style_features'>
                <h4>[attribute_name]</h4> 
                <ul> [option_items]</ul>
            </div>
        ",
		"option_template" => "<li>[attribute_value]</li>",
	];

	return $styles;
} );

function stm_ajax_get_c_f_user_phone()
{
	check_ajax_referer( 'stm_ajax_get_c_f_user_phone', 'security' );
	$user_added_by = get_user_meta( $_GET["phone_owner_id"], 'phone', true );

	wp_send_json( $user_added_by );
	exit;
}

add_action( 'wp_ajax_stm_ajax_get_c_f_user_phone', 'stm_ajax_get_c_f_user_phone' );
add_action( 'wp_ajax_nopriv_stm_ajax_get_c_f_user_phone', 'stm_ajax_get_c_f_user_phone' );