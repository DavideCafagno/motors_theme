<?php
$price = get_post_meta(get_the_ID(), 'price', true);
$sale_price = get_post_meta(get_the_ID(), 'sale_price', true);
$car_price_form_label = get_post_meta(get_the_ID(), 'car_price_form_label', true);

$regular_price_label = get_post_meta(get_the_ID(), 'regular_price_label', true);
$special_price_label = get_post_meta(get_the_ID(), 'special_price_label', true);

$rentPrice = get_post_meta(get_the_ID(), 'rent_price', true);
$saleRentPrice = get_post_meta(get_the_ID(), 'sale_rent_price', true);

$body = get_post_meta(get_the_ID(), 'body', true);
$listingType = get_post_meta(get_the_ID(), 'listing-type', true);

$terms = array();
if($body) {
    foreach (explode(',', $body) as $k => $b) {
	    $bodyName = get_term_by('slug', $b, 'body');
		$terms[] = '<a href="' . stm_get_listing_archive_link() . '?body=' . $bodyName->slug . '">' . $bodyName->name . '</a>';
    }
}

if($listingType) {
	foreach (explode(',', $listingType) as $k => $type) {
	    $lt = get_term_by('slug', $type, 'listing-type');
	    if($lt) {
			$terms[] = '<a href="' . stm_get_listing_archive_link() . '?listing-type=' . $lt->slug . '">' . $lt->name . '</a>';
		}
	}
}

?>

<div class="stm-listing-single-price-title heading-font clearfix">
    <div class="listing-title-wrap">
        <div class="terms-wrap">
            <?php echo (!empty($terms)) ? implode(' | ', $terms) : ''; ?>
        </div>
        <h1 class="title">
            <?php echo stm_generate_title_from_slugs(get_the_ID(), true); ?>
        </h1>
    </div>
    <div class="price-wrap">
        <?php if(!empty($rentPrice) || !empty($saleRentPrice)) { ?>
            <div class="rent-price-wrap">
                <div class="label normal_font"><?php echo (empty($saleRentPrice)) ? esc_html__('Rent Price', 'stm_motors_equipment') : sprintf(esc_html__('%s/Day', 'stm_motors_equipment'), stm_listing_price_view($saleRentPrice)); ?></div>
                <div class="price heading-font"><?php echo sprintf(__('<span>%s</span>/Day', 'stm_motors_equipment'), (!empty($rentPrice)) ? stm_listing_price_view($rentPrice) : stm_listing_price_view($saleRentPrice));?></div>
            </div>
        <?php } ?>

        <?php if(!empty($car_price_form_label)): ?>
            <div class="price_unit">
                <div class="price">
                    <div class="stm_custom_label normal_font">
                        <?php echo esc_attr($car_price_form_label); ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="price_unit">
                <?php if(!empty($sale_price)): ?>
                    <div class="price">
                        <div class="inner heading-font">
                            <?php if(!empty($special_price_label)): ?>
                                <div class="stm_label normal_font"><?php echo $special_price_label; ?></div>
                            <?php else: ?>
                                <div class="stm_label normal_font"><?php echo (empty($sale_price)) ? __('Price', 'stm_motors_equipment') : stm_listing_price_view($price); ?></div>
                            <?php endif; ?>
                            <?php echo (empty($sale_price)) ? stm_listing_price_view($price) : stm_listing_price_view($sale_price); ?>
                        </div>
                    </div>
                <?php elseif(!empty($price)): ?>
                    <div class="price">
                        <div class="inner heading-font">
                            <div class="stm_label normal_font"><?php echo (!empty($regular_price_label)) ? $regular_price_label : esc_html__('Sale Price', 'stm_motors_equipment'); ?></div>
                            <?php echo stm_listing_price_view($price); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>