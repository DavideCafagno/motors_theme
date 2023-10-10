<?php
function stm_c_f_get_icons_html()
{
	$fa_icons = stm_get_c_f_icons_fa('fa');
	$custom_icons = stm_get_c_f_icons('stm-all-icon');

	$counter = 0;
	?>

	<div class="stm_vehicles_listing_icons">
		<div class="overlay"></div>
		<div class="inner">
			<!--Nav-->
			<div class="stm_font_nav">
				<div>
					<a href="#stm_font-awesome"
					   class="active"><?php esc_html_e('Font Awesome', 'stm_vehicles_listing') ?></a>
				</div>
				<div>
					<a href="#stm_font-motors"><?php esc_html_e('Motors Pack', 'stm_vehicles_listing') ?></a>
				</div>
			</div>
			<div class="scrollable-content">
				<!--Content-->
				<div id="stm_font-awesome" class="stm_theme_font active">
					<table class="form-table">
						<tr>
							<?php foreach ($fa_icons as $fa_icon):
							$counter++; ?>
							<td class="stm-listings-pick-icon">
								<i class="<?php echo esc_attr($fa_icon); ?>"></i>
							</td>
							<?php if ($counter % 15 == 0): ?>
						</tr>
						<tr>
							<?php endif; ?>
							<?php endforeach; ?>
						</tr>
					</table>
				</div>

				<div id="stm_font-motors" class="stm_theme_font">
					<table class="form-table">
						<tr>
							<?php $counter = 0;
							foreach ($custom_icons as $custom_icon):
							$counter++; ?>
							<td class="stm-listings-pick-icon stm-listings-<?php echo esc_attr($custom_icon); ?>">
								<i class="<?php echo esc_attr($custom_icon); ?>"></i>
							</td>
							<?php if ($counter % 15 == 0): ?>
						</tr>
						<tr>
							<?php endif; ?>
							<?php endforeach; ?>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php }

function stm_get_c_f_icons($font_pack = 'fa')
{
	$fonts = array();

	if(file_exists(STM_MOTORS_C_F_PATH . '/assets/fonts/font-json/' . $font_pack . '.json')) {
		$font_icons = file( STM_MOTORS_C_F_PATH . '/assets/fonts/font-json/' . $font_pack . '.json' );
		$font_icons = json_decode( implode( '', $font_icons ), true );

		//$i = 0;
		foreach ( $font_icons['icons'] as $key => $val ) {
		    //$fonts[] = $i . '": "stm-all-icon-' . $val['properties']['name'];
		    $fonts[] = 'stm-all-icon-' . $val['properties']['name'];
		    //$i++;
		};
	}

	return $fonts;
}

function stm_get_array_icons($font_pack)
{
	$font_pack['stm-all-icon']['name'] = 'Classified Icons';


	if(file_exists(STM_MOTORS_C_F_PATH . '/assets/fonts/font-json/stm-all-icon.json')) {
		$font_icons = file( STM_MOTORS_C_F_PATH . '/assets/fonts/font-json/stm-all-icon.json' );
		$font_icons = json_decode( implode( '', $font_icons ), true );

		foreach ( $font_icons['icons'] as $key => $val ) {
			$font_pack['stm-all-icon']["icons"][] = array(
						"name" => ucfirst(str_replace('_', ' ', $val['properties']['name'])),
						"class" => 'stm-all-icon-' . $val['properties']['name'],
            );
		};
	}

	return $font_pack;
}

add_filter('ulisting_icons', 'stm_get_array_icons');


function stm_get_c_f_icons_fa()
{
	$fonts = array();

    $font_icons = file( STM_MOTORS_C_F_PATH . '/assets/fonts/font-json/fa.json' );
    $font_icons = json_decode( implode( '', $font_icons ), true );

    foreach ( $font_icons as $key => $val ) {
        $fonts[] = $val;
    };

	return $fonts;
}

function stm_c_f_get_category_icon($termId) {
	$icon = get_term_meta($termId, 'stm_c_f_icon', true);

	return $icon;
}

function stm_c_f_get_content_tags($content)
{
	global $shortcode_tags;

	preg_match_all('@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches);

	$tagnames = array_intersect(array_keys($shortcode_tags), $matches[1]);

	$pattern = get_shortcode_regex($tagnames);

	preg_match_all("/$pattern/", $content, $matches, PREG_SET_ORDER);

	return $matches;
}

function stm_c_f_ulisting_html_attributes($data) {
    return $data;
}

//add_filter('ulisting_html_attributes', 'stm_c_f_ulisting_html_attributes');

function changeAttrType () {
    $post_meta = get_post_meta(9, 'stm_listing_item_card_list', true);

	//$post_meta['sections'][0]['rows'][0]['columns'][0]['elements'][1]['columns'][1]['elements'][0]['params']['attribute_type'] = 'price';

	//update_post_meta(9, 'stm_listing_item_card_grid', $post_meta);

	/*echo '<pre>';
	print_r($post_meta);
	//print_r($post_meta['sections'][0]['rows'][0]['columns'][1]['elements'][0]['columns'][1]['elements'][0]['params']);
	echo '</pre>';*/
}

/*
 * Page names
 *
 *  account_page
 *  add_listing
 *  pricing_plan
 *
 * */
function stm_c_f_get_page_url ($page) {
	$pages = get_option('stm_listing_pages', '');

	if(!empty($pages[$page]) && $pages[$page] != 0) {
	    return get_the_permalink($pages[$page]);
    }

    return false;
}

function stm_ulisting_pre($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}


if ( !function_exists( 'stm_c_f_display_user_name' ) ) {
	/**
	 * User display name
	 *
	 * @param $user_id
	 * @param string $user_login
	 * @param string $f_name
	 * @param string $l_name
	 */
	function stm_c_f_display_user_name( $user_id, $user_login = '', $f_name = '', $l_name = '' )
	{
		$user = get_userdata( $user_id );

		if ( empty( $user_login ) ) {
			$login = $user->data->user_login;
		} else {
			$login = $user_login;
		}
		if ( empty( $f_name ) ) {
			$first_name = get_the_author_meta( 'first_name', $user_id );
		} else {
			$first_name = $f_name;
		}

		if ( empty( $l_name ) ) {
			$last_name = get_the_author_meta( 'last_name', $user_id );
		} else {
			$last_name = $l_name;
		}

		$display_name = $login;

		if ( !empty( $first_name ) ) {
			$display_name = $first_name;
		}

		if ( !empty( $first_name ) and !empty( $last_name ) ) {
			$display_name .= ' ' . $last_name;
		}

		if ( empty( $first_name ) and !empty( $last_name ) ) {
			$display_name = $last_name;
		}


		echo apply_filters( 'stm_filter_display_user_name', $display_name, $user_id, $user_login, $f_name, $l_name );

	}
}

function stm_c_f_get_listings_by_listing_type($listing_type, $limit) {

	$listings = uListing\Classes\StmListing::query()
		->asTable("listing")
		->join(" left join " . uListing\Classes\StmListingTypeRelationships::get_table() . " as listing_type_rel on listing_type_rel.listing_id = listing.ID ")
		->where("listing.post_type", "listing")
		->where("listing.post_status", "publish")
		->where("listing_type_rel.listing_type_id", $listing_type)
        ->order("DESC")
        ->limit($limit)
		->find();

	return $listings;
}