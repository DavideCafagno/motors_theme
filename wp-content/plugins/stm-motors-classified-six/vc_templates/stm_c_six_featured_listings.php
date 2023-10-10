<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_c_six_module_enqueue_scripts_styles('stm_c_six_featured_listings');

?>
<div class="stm-c-six-featured-listings">
	<?php if(!empty($featured_title)): ?>
		<h2><?php echo esc_html($featured_title); ?></h2>
	<?php endif; ?>
    <div class="stm-featured-listings-wrap">
	<?php
	$listings = uListing\Classes\StmListing::get_listing(['listing_type' => $listing_type, 'feature' => 1], $posts_limit, 1);


	foreach ($listings['models'] as $k => $listing){
		$item = "";

		$listingType =  $listing->getType();

		if( ($listing_item_card_layout = get_post_meta($listingType->ID, 'stm_listing_item_card_grid')) AND isset($listing_item_card_layout[0]))  {
			$listing_item_card_layout = maybe_unserialize($listing_item_card_layout[0]);
			$config   = $listing_item_card_layout['config'];
			$sections = $listing_item_card_layout['sections'];
		}

		$item.= \uListing\Classes\StmListingTemplate::load_template('loop/loop', [
			'model'       => $listing,
			'view_type'   => 'grid',
			'listingType' => $listingType,
			'item_class'  => 'stm-featured-data stm-featured-' . $k,
			'listing_item_card_layout' => $sections,
		]);

		if($k == 0) {
            echo "<div class='left'><div class='stm-featured-item-poster'>".$item."</div></div>";
        } else {
		    if($k == 1) echo '<div class="right">';
			echo "<div class='stm-featured-item stm-featured-item-{$k}'>".$item."</div>";
			if(count($listings['models']) == $k+1) echo '</div>';
        }
	}

    ?>
    </div>
</div>
