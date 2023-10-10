<?php
namespace uListing\ListingCompare\Classes;

use uListing\Classes\StmListing;
use uListing\Classes\StmListingAttribute;
use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmListingType;
use uListing\Classes\StmListingTypeRelationships;
use uListing\Classes\StmSystemStatus;
use uListing\Classes\UlistingCookie;
use uListing\Classes\Vendor\ArrayHelper;

class UlistingListingCompare {

    public static function init(){
        if(defined("ULISTING_LISTING_COMPARE_VERSION")){
            add_shortcode("ulisting-compare-link", [self::class, "compare_link"]);
            add_filter("ulisting_listing_compare_available_attributes_check", [self::class, "listing_compare_available_attributes_check"]);
            add_filter("ulisting_item_layout_data", [self::class, "builder_add_compare_element"]);
            add_filter("ulisting_single_layout_builder_data", [self::class, "builder_add_compare_element"]);
            add_filter("ulisting_template_status_scan_files", [self::class, "template_status_scan_files"]);
            add_action("ulisting_listing_type_save", [self::class, "save_compare_listing_type"]);
            add_filter("ulisting_ajax", [self::class, "add_ajax"]);
            if(is_admin())
                add_action("ulisting_setting_pages_panel", [self::class, "setting_pages"]);
            else {
                add_filter('the_content', [self::class, 'render_compare_page'], 100);
            }
        }
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function add_ajax($data){
        $compare = new UlistingListingCompare();
        $data[] = [
            "is_admin" => false,
            "tag" => "ulisting_compare_get_count_total",
            "action" => [$compare, "get_total_all_ajax"]
        ];

        $data[] = [
            "is_admin" => false,
            "tag" => "ulisting_compare_check_object",
            "action" => [$compare, "check_object"]
        ];

        return $data;
    }

    public function check_object(){
        $data = [];
        if( isset($_GET['ids'])  AND ! empty($_GET['ids'])){
            $ids = explode(',' ,$_GET['ids']);
            if(self::get_compare()){
                foreach (self::get_compare() as $compare){
                    if(in_array($compare, $ids))
                        $data[] = $compare;
                }
            }
        }
        wp_send_json($data);
        die;
    }

    public function get_total_all(){
        $result = [
            "total" => self::get_total_count(),
        ];
        return $result;
    }

    public function get_total_all_ajax(){
        wp_send_json($this->get_total_all());
        die;
    }

    public static function render_compare_page($content){
        global $wpdb;
        $compare_page = \uListing\Classes\StmListingSettings::getPages("compare_page");
        $post = get_post();
        if($compare_page AND $post->ID == $compare_page){
            $compare = (isset($_COOKIE['ulisting_compare'])) ? $_COOKIE['ulisting_compare'] : "";
            $compare = str_replace("\\", "", $compare);
            $compare = json_decode($compare, true);
            $listings = [];
            $listing_types = [];
            $listing_type_attributes = [];

            if(!empty($compare))
                $listing_types = StmListingType::query()
                    ->select(" listing_type.* , 
                                                 (  select count(*) from ". $wpdb->prefix ."posts as l 
                                                    left join ". $wpdb->prefix ."ulisting_listing_type_relationships as _listing_type_rel on (_listing_type_rel.listing_id = l.ID) 
                                                    where l.post_type = 'listing' AND l.ID IN (".implode(',', $compare).") AND _listing_type_rel.listing_type_id = listing_type.ID  
                                                 ) as lisitng_total_count  ")
                    ->asTable("listing_type")
                    ->join(" left join ".StmListingTypeRelationships::get_table()." as listing_type_rel on (listing_type_rel.listing_type_id = listing_type.ID) ")
                    ->where_in("listing_type_rel.listing_id", $compare)
                    ->where("listing_type.post_type",'listing_type')
                    ->group_by("listing_type.ID")
                    ->find();

            $listing_type_id = (isset($_GET['listing_type_id'])) ? $_GET['listing_type_id'] : null;
            $listing_type_ids = ArrayHelper::map($listing_types,'ID',"ID");

            if(!$listing_type_id)
                $listing_type_id =  (!empty($listing_types)) ? $listing_types[0]->ID : null;

            if(!isset($listing_type_ids[$listing_type_id]))
                $listing_type_id =  (!empty($listing_types)) ? $listing_types[0]->ID : null;

            if($listing_type_id AND $listing_types AND $listing_type = StmListingType::find_one($listing_type_id)) {
                $compare_attributes = $listing_type->getMeta('ulisting_listing_compare_attribute');
                $listing_type_attributes = ($compare_attributes) ? StmListingAttribute::query()->where_in('id', $compare_attributes) ->sort_by(" field(id, ".implode(',', $compare_attributes).") ")->find() : [];
                $listings = StmListing::query()
                    ->select(" listing.* ")
                    ->asTable("listing")
                    ->join(" left join ".StmListingTypeRelationships::get_table()." as listing_type_rel on (listing_type_rel.`listing_id` = listing.ID) ")
                    ->where("listing_type_rel.listing_type_id", $listing_type->ID)
                    ->where_in("listing_type_rel.listing_id", $compare)
                    ->group_by(" listing.ID ")
                    ->find();
            }

            $content.= StmListingTemplate::load(
                "listing-compare/compare-page",
                [
                    'listings' => $listings,
                    'listing_types' => $listing_types,
                    'page_url' => get_permalink($post),
                    'listing_type_id' => $listing_type_id,
                    'listing_type_attributes' => $listing_type_attributes,
                ],
                'ulisting/',
                ULISTING_LISTING_COMPARE_PATH.'/templates/');
        }
        return $content;
    }

    public static function setting_pages(){
        echo ulisting_render_template(ULISTING_LISTING_COMPARE_PATH . '/includes/admin/views/settings/pages-panel.php', ['data' => []]);
    }

    /**
     * shortcode for compare link
     */
    public static function compare_link(){
        echo StmListingTemplate::load("listing-compare/compare-link", [], 'ulisting/', ULISTING_LISTING_COMPARE_PATH.'/templates/');
    }

    public static function listing_compare_available_attributes_check($attribute){
        if( !isset($attribute->type) OR
            $attribute->type == StmListingAttribute::TYPE_GALLAEY OR
            $attribute->type == StmListingAttribute::TYPE_LOCATION OR
            $attribute->type == StmListingAttribute::TYPE_FILE
        ){
            return false;
        }
        return true;
    }

    /**
     * @param $listingType
     */
    public static function save_compare_listing_type($listingType){
        if( isset($listingType->ID) AND isset($_POST['StmListingTypeListingCompareAttribute'])) {
            update_post_meta($listingType->ID, "ulisting_listing_compare_attribute", maybe_serialize($_POST['StmListingTypeListingCompareAttribute']));
        }
    }

    /**
     * @param $scan_files
     *
     * @return array
     */
    public static function template_status_scan_files($scan_files){
        $scan_files = array_merge($scan_files, StmSystemStatus::template_files_scan(ULISTING_LISTING_COMPARE_PATH . '/templates' ));
        return $scan_files;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public static function builder_add_compare_element($data){

        $name = "ulisting-compare";
        $path = explode(DIRECTORY_SEPARATOR, ULISTING_LISTING_COMPARE_PATH);
        if( isset($path[count($path) - 1]) )
            $name = $path[count($path) - 1];

        $data['config']["compare"] =  [
            "field_group" => [
                "template" => [
                    "name" => "Template",
                    "fields" => [
                        [
                            "type"   => "blog",
                            "label"  => "Style template",
                            "name"   => "template",
                            "items"  => self::get_compare_template()
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
            "title"        => "Compare",
            "type"         => "attribute",
            "group"        => "general",
            "module"       => "element",
            "field_group"  => "compare",
            "params"       => [
                "template_path"     => "listing-compare". DIRECTORY_SEPARATOR ."listing-compare",
                "default_path"      =>  "wp-content". DIRECTORY_SEPARATOR ."plugins". DIRECTORY_SEPARATOR .$name.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR,
                "template"          => "none",
                "type"              => "compare",
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
    public static function get_compare_template($params = []){
        $listing_id = (isset($params['listing_id'])) ? $params['listing_id'] : 0;
        $active = (isset($params['active'])) ? $params['active'] : "";

        $templates = [
            "template_1" => [
                "icon" => ULISTING_URL."/assets/img/compare.png",
                "name" => "Style 1",
                "template" => " <span data-compare_id='[".$listing_id."]' style='position: relative;' class='ulisting-listing-compare'> <i onclick='add_listing_compare_via_class(".$listing_id.")' id='ulisting_listing_compare_".$listing_id."' class='ulisting_listing_compare_".$listing_id." fa fa-compress ".$active."'></i> </span> ",
            ]
        ];
        return apply_filters("ulisting_loop_compare_template", $templates, $params);
    }

    /**
     * @param $template_id
     *
     * @return string
     */
    public static function render_compare($params) {
        $template_id = $params['template'];
        $templates = self::get_compare_template($params);
        if(!isset($templates[$template_id]))
            return "";
        $template = $templates[$template_id]['template'];
        return $template;
    }

    public static function get_compare(){
        $compare = isset($_COOKIE['ulisting_compare']) ? $_COOKIE['ulisting_compare'] : "";
        return json_decode(str_replace( "\\", "", $compare), true);
    }

    /**
     * @param $listing_id
     *
     * @return bool
     */
    public static function is_active($listing_id) {
        $compare = self::get_compare();
        return (isset($compare[$listing_id])) ? true : false;
    }

    /**
     * @return int
     */
    public static function get_total_count(){
        $compare = self::get_compare();
        if(is_array($compare))
            return sizeof($compare);
        return 0;
    }

    public static function render_attribute_value($listing, $attribute){
        $value = $listing->getAttributeValue($attribute);
        switch ($attribute->type){
            case StmListingAttribute::TYPE_LOCATION:
                return isset($value['address']) ? $value['address'] : __('Unnamed Road', 'ulisting');
                break;
            case StmListingAttribute::TYPE_TEXT:
                return $value;
                break;
            case StmListingAttribute::TYPE_TEXT_AREA:
                return $value;
                break;
            case StmListingAttribute::TYPE_NUMBER:
                return $value;
                break;
            case StmListingAttribute::TYPE_DATE:
                return date_i18n( get_option( 'date_format' ), strtotime( $value ) ) ;
                break;
            case StmListingAttribute::TYPE_TIME:
                return date_i18n( get_option( 'time_format' ), strtotime( $value ) ) ;
                break;
            case StmListingAttribute::TYPE_SELECT:
                return current($value);
                break;
            case StmListingAttribute::TYPE_MULTISELECT:
                return implode(', ', $value);
                break;
            case StmListingAttribute::TYPE_CHECKBOX:
                return implode(', ', $value);
                break;
            case StmListingAttribute::TYPE_RADIO_BUTTON:
                return implode(', ', $value);
                break;
            case StmListingAttribute::TYPE_YES_NO:
                return ($value) ? __("Yes", "ulisting") : __("No", "ulisting");
                break;
            case StmListingAttribute::TYPE_PRICE:
                return (isset($value['price'])) ? ulisting_currency_format($value['price']) : "";
                break;
        }
    }

}