<?php

namespace uListing\UlistingWishlist\Classes;

use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmListingType;

class UlistingWishlist {

	const COOKIE_NAME = "ulisting_wishlist";

	public static function init(){
		if(defined("ULISTING_WISHLIST_VERSION")){
			add_shortcode("ulisting-wishlist-link", [self::class, "wishlist_link"]);
			add_filter("ulisting_item_layout_data", [self::class, "ulisting_builder_element"]);
			add_filter("ulisting_single_layout_builder_data", [self::class, "ulisting_builder_element"]);
			add_action( 'wp_loaded', [self::class, "is_user_logged"]);
            add_filter("ulisting_ajax", [self::class, "add_ajax"], 99);

			if(is_admin()) {
                add_action("ulisting_setting_pages_panel", [self::class, "setting_pages"]);
            }
			else{
				add_filter('the_content', [self::class, 'render_main'], 100);
				add_action("ulisting-wishlist-render-page", [self::class, "wishlist_render_page"]);
			}
		}
	}

	public static function is_user_logged(){
		if(is_user_logged_in())
			self::wishlist_cookie_refresh();
	}

	public static function setting_pages(){
		echo ulisting_render_template(ULISTING_WISHLIST_PATH . '/includes/admin/views/settings/pages-panel.php', ['data' => []]);
	}

	/**
	 * @param $content
	 *
	 * @return string
	 */
	public static function render_main($content){
		$post = get_post();
		$wishlist_page = \uListing\Classes\StmListingSettings::getPages("wishlist_page");
		if($wishlist_page AND $post->ID == $wishlist_page){
			global $stm_query;
			$content.= StmListingTemplate::load( "wishlist/main",
				[
					'wishlist_page_url' => get_permalink($post),
					'endpoint' => $stm_query->get_current_endpoint()
				],
				'ulisting/',
				ULISTING_WISHLIST_PATH.'/templates/');
		}
		return $content;
	}

	public static function wishlist_render_page(){
		echo self::render_wishlist_page();
	}

	/**
	 * @param $content
	 *
	 * @return null|string
	 */
	public static function render_wishlist_page(){

		if(!defined("ULISTING_WISHLIST_VERSION"))
			return null;

			$listings = [];
			$listing_types = [];
			$wishlist = self::get_wishlist();

			if(!empty($wishlist))
				$listing_types = \uListing\Classes\StmListingType::query()
								->select(" listing_type.* ")
								->asTable("listing_type")
								->join(" left join ".\uListing\Classes\StmListingTypeRelationships::get_table()." as listing_type_rel on (listing_type_rel.`listing_type_id` = listing_type.ID) ")
								->where_in("listing_type_rel.listing_id", $wishlist)
								->group_by("listing_type.ID")
								->find();

			foreach ($listing_types as $key => $listing_type){
				$listings = \uListing\Classes\StmListing::query()
								->select(" listing.* ")
								->asTable("listing")
								->join(" left join ".\uListing\Classes\StmListingTypeRelationships::get_table()." as listing_type_rel on (listing_type_rel.`listing_id` = listing.ID) ")
								->join(" left join ".StmListingType::get_table()." as listing_type on (listing_type.ID = listing_type_rel.listing_type_id) ")
								->where_in("listing_type_rel.listing_id", $wishlist)
								->where("listing_type.ID", $listing_type->ID)
								->group_by("listing.ID")
								->find();
				$listing_types[$key]->listings = $listings;
			}

			return StmListingTemplate::load(
				"wishlist/wishlist",
				[
					'listings' => $listings,
					'listing_types' => $listing_types,
				],
				'ulisting/',
				ULISTING_WISHLIST_PATH.'/templates/');
	}

	/**
	 * @param $params
	 *
	 * @return bool|string
	 */
	public static function wishlist_link($params){
		if(!defined("ULISTING_WISHLIST_VERSION"))
			return null;

		return StmListingTemplate::load(
			"wishlist/link",
			[
				"total" => 0, //apply_filters('ulisting-wishlist-link-total-count', self::get_total_count()),
				"params" => $params
			],
			'ulisting/',
			ULISTING_WISHLIST_PATH.'/templates/');
	}

	public static function get_total_count(){
		return sizeof(self::get_wishlist());
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public static function ulisting_builder_element($data){
		if(!defined("ULISTING_WISHLIST_VERSION"))
			return $data;

		$name = "ulisting-wishlist";
		$path = explode(DIRECTORY_SEPARATOR, ULISTING_WISHLIST_PATH);
		if( isset($path[count($path) - 1]) )
			$name = $path[count($path) - 1];

		$data['config']['wishlist'] = [
			"field_group" => [
				"template" => [
					"name" => "Template",
					"fields" => [
						[
							"type"   => "blog",
							"label"  => "Style template",
							"name"   => "template",
							"items"  => self::get_wishlist_template()
						]
					]

				],
				"style" => [
					"name" => "Style",
					"fields" => [
						[
							"type"   => "color",
							"label"  => "Background color",
							"name"   => "background_color",
						]
					]
				],
				"advanced" => [
					"name" => "Advanced",
					"fields" => [
						[
							"type"  => "text",
							"label" => "ID",
							"name"  => "id",
						],
						[
							"type"  => "text",
							"label" => "Class",
							"name"  => "class",
						],
						[
							"type"  => "margin",
							"label" => "Margin",
							"name"  => "margin",
						],
						[
							"type"  => "padding",
							"label" => "Padding",
							"name"  => "padding",
						]
					]
				]
			]
		];
		$data['elements'][] = [
			"id" => rand(100, 999)."_".time(),
			"builder_type" => "item_card_layout",
			"title"        => "Wishlist",
			"type"         => "attribute",
			"group"        => "general",
			"module"       => "element",
			"field_group"  => "wishlist",
			"params"       => [
                "template_path"     => "wishlist". DIRECTORY_SEPARATOR ."add_button",
                "default_path"      => "wp-content". DIRECTORY_SEPARATOR ."plugins". DIRECTORY_SEPARATOR .$name.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR,
				"type"              => "wishlist",
				"template"          => "template_1",
				"id"                => "",
				"class"             => "",
				"color"             => "",
				"background_color"  => "",
			],
		];
		return $data;
	}

	/**
	 * @return mixed|void
	 */
	public static function get_wishlist_template(){
		$templates = [
			"template_1" => [
				"icon" => ULISTING_WISHLIST_URL."/assets/img/favourite.png",
				"name" => "Style 1",
				"template" => '<span data-wishlist_id="[id]" onclick="[click]" style="position: relative"  class="ulisting-listing-wishlist stm-cursor-pointer [class] [active] "> <i class="fa fa-heart"></i></span> <span class="[class_load] hidden"><i class="fa fa-heart ld ld-heartbeat"></i></span> ',
			]
		];
		return apply_filters("ulisting_loop_wishlist_template", $templates);
	}

	/**
	 * @param $template_id
	 *
	 * @return string
	 */
	public static function render_add_button($template_id, $model) {
		if(!defined("ULISTING_WISHLIST_VERSION"))
			return null;
		$templates = self::get_wishlist_template();
		if(!isset($templates[$template_id]))
			return "";

		$class = "ulisting_wishlist_".$model->ID;
		$class_load = "ulisting_wishlist_load_".$model->ID;
		$click = "ulisting_wishlist(".$model->ID.")";
		$active = (self::is_active($model->ID)) ? "active" : null;

		$template = $templates[$template_id]['template'];

		$template = str_replace("[class]", $class, $template);
		$template = str_replace("[class_load]", $class_load, $template);
		$template = str_replace("[id]", $model->ID, $template);
		$template = str_replace("[click]", $click, $template);
		$template = str_replace("[active]", $active, $template);

		return $template;
	}

	/**
	 * @return array|mixed|object
	 */
	public static function get_wishlist(){

		if(!function_exists('ulisting_wishlist_active') OR !ulisting_wishlist_active())
			return [];

		$wishlist = [];
		if(!is_user_logged_in() AND isset($_COOKIE['ulisting_wishlist']) AND !empty($_COOKIE['ulisting_wishlist']))
			$wishlist = json_decode( str_replace("|","\"", $_COOKIE['ulisting_wishlist']), true );
		else{
			if($wishlist = get_user_meta(get_current_user_id(), "ulisting_wishlist", true))
				$wishlist = json_decode($wishlist, true);
		}
		return (is_array($wishlist)) ? $wishlist : [];
	}

	/**
	 * @param $id
	 *
	 * @return bool
	 */
	public static function is_active($id){
		$wishlist = self::get_wishlist();
		$result = false;
		if(in_array($id, $wishlist))
			$result = true;
		return $result;
	}

	/**
	 * @param $data
	 */
	public static function add_ajax($data){
		$wishlist = new UlistingWishlist();

		$data[] = [
			"is_admin" => false,
			"tag" => "ulisting_wishlist_add",
			"action" => [$wishlist, "add_wishlist"]
		];

		$data[] = [
			"is_admin" => false,
			"tag" => "ulisting_wishlist_get_count_total",
			"action" => [$wishlist, "get_total_all_ajax"]
		];

		$data[] = [
			"is_admin" => false,
			"tag" => "ulisting_wishlist_check_object",
			"action" => [$wishlist, "check_object"]
		];

		return $data;
	}

	public function check_object(){
		$data = [];
		if( isset($_GET['ids'])  AND ! empty($_GET['ids'])){
			$ids = explode(',' ,$_GET['ids']);
			foreach (self::get_wishlist() as $wishlist){
				if(in_array($wishlist, $ids))
					$data[] = $wishlist;
			}
		}
		wp_send_json($data);
		die;
	}

	public function get_total_all(){
		$result = [
			"total" => 0,
			"wishlist_total" => 0,
			"search_total" => 0
		];

		$items = [];

		if(!is_user_logged_in()) {
			if(isset($_COOKIE['ulisting_wishlist']) AND !empty($_COOKIE['ulisting_wishlist']))
				$items = json_decode( str_replace("|","\"", $_COOKIE['ulisting_wishlist']), true );
		} else {
			$user_id = get_current_user_id();
			$items = get_user_meta($user_id, "ulisting_wishlist", true);
			$items = json_decode($items, true);
		}
		$result['wishlist_total'] = (is_array($items)) ? count($items) : 0;
		$result['search_total'] = apply_filters('ulisting-wishlist-link-total-count', 0);
		return $result;
	}

	public function get_total_all_ajax(){
		wp_send_json($this->get_total_all());
		die;
	}

	public function add_wishlist(){
		$result = [
			"success" => false,
			"message" => "",
			"type" => null,
			"total" => 0,
			"wishlist_total" => 0
		];
		$object_id = 0;

		if(isset($_POST['object_id']))
			$object_id = $_POST['object_id'];

		if(!is_user_logged_in())
			$result = self::wishlist_cookie($result, $object_id);
		else{
			$result = self::wishlist_user($result, $object_id);
		}
		$result['wishlist_total'] = $result['total'];
		$result['total'] = apply_filters('ulisting-add-wishlist-total-count', $result['total']);
		wp_send_json($result);
		die;
	}

	/**
	 * @param $result
	 * @param $object_id
	 *
	 * @return mixed
	 */
	public static function wishlist_cookie($result, $object_id){
		if(isset($_COOKIE['ulisting_wishlist']) AND !empty($_COOKIE['ulisting_wishlist']))
			$cookie_value = json_decode( str_replace("|","\"", $_COOKIE['ulisting_wishlist']), true );

		if(in_array($object_id, $cookie_value)){
			if (($key = array_search($object_id, $cookie_value)) !== false)
				unset($cookie_value[$key]);
			$result["type"] = "remove";
		}else{
			$cookie_value[] = $object_id;
			$result["type"] = "add";
		}
		$result['total'] = sizeof($cookie_value);
		$cookie_value = json_encode($cookie_value);
		$cookie_value = str_replace("\"","|", $cookie_value);

		if(setcookie(self::COOKIE_NAME, $cookie_value, time() + ( (86400 * 30)), "/"))
			$result["success"] = true;

		return $result;
	}

	public static function wishlist_cookie_refresh(){
		if(isset($_COOKIE['ulisting_wishlist']) AND !empty($_COOKIE['ulisting_wishlist']) AND $cookie = json_decode( str_replace("|","\"", $_COOKIE['ulisting_wishlist']), true )){
			if($wishlist = get_user_meta(get_current_user_id(), "ulisting_wishlist", true))
				$wishlist = json_decode($wishlist, true);
			else
				$wishlist = [];
			foreach ($cookie as $item){
				if(!in_array($item, $wishlist))
					$wishlist[] = $item;
			}
			if(setcookie(self::COOKIE_NAME, "", time() + ( (86400 * 30)), "/"))
			update_user_meta(get_current_user_id(), "ulisting_wishlist", json_encode($wishlist));
		}
	}

	/**
	 * @param $result
	 * @param $object_id
	 */
	public static function wishlist_user($result, $object_id){
		$user_id = get_current_user_id();
		$wishlist = get_user_meta($user_id, "ulisting_wishlist", true);
		if(!$wishlist) {
			$wishlist = [$object_id];
			update_user_meta($user_id, "ulisting_wishlist", json_encode($wishlist));
			$result["type"] = "add";
			$result['total'] = sizeof($wishlist);
		}else{
			$wishlist = json_decode($wishlist, true);
			if(in_array($object_id, $wishlist)){
				if (($key = array_search($object_id, $wishlist)) !== false)
					unset($wishlist[$key]);
				$result["type"] = "remove";
			} else {
				$wishlist[] = $object_id;
				$result["type"] = "add";
			}
			$result['total'] = sizeof($wishlist);
			update_user_meta($user_id, "ulisting_wishlist", json_encode($wishlist));
		}
		$result["success"] = true;
		return $result;
	}
}

