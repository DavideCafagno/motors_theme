<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_c_f_module_enqueue_scripts_styles('stm_c_f_recent_items');

$invPages = uListing\Classes\StmListingSettings::getPages(uListing\Classes\StmListingSettings::PAGE_LISTINGS_TYPE_PAGE);

// if we don't have this listing type, just return the first existing one
if( !empty($listing_type) && is_numeric($listing_type) ) {
    $get_given_type = get_posts( array( 'post_type' => 'listing_type', 'post__in' => array( $listing_type ) ) );
    if ( empty($get_given_type) ) {
        $get_all_types = get_posts( array( 'post_type' => 'listing_type', 'numberposts' => -1 ) );
        if ( !empty($get_all_types) ) {
            $listing_type = $get_all_types[0]->ID;
        }
    }
}

$listings = stm_c_f_get_listings_by_listing_type($listing_type, $posts_per_page);

?>

<div class="stm-c-f-recent-items-wrap">
	<div class="top-wrap <?php echo (!empty($show_as_carousel) && $show_as_carousel == 'yes') ? 'show-nav-carousel' : ''; ?>">
		<h2><?php echo esc_html($recent_title); ?></h2>
		<div class="actions-wrap">
			<a href="<?php echo esc_url(get_the_permalink($invPages[$listing_type]));?>" class="heading-font"><?php echo esc_html__('View all', 'stm_motors_classified_five'); ?></a>
            <?php if(!empty($show_as_carousel) && $show_as_carousel == 'yes') :?>
                <div class="stm-nav">
                    <div class="stm-recent-prev">
                        <i class="stm-all-icon-arrow-left1"></i>
                    </div>
                    <div class="stm-recent-next">
                        <i class="stm-all-icon-arrow-right1"></i>
                    </div>
                </div>
            <?php endif; ?>
		</div>
	</div>
	<div class="recent-items-wrap <?php echo (!empty($show_as_carousel) && $show_as_carousel == 'yes') ? 'as-carousel' : ''; ?>">
		<?php
		uListing\Classes\StmListingTemplate::load_template(
			'listing/ulisting-grid-item',
			[
				"listings" => $listings,
				"view_type" => 'grid',
				"item_class" => 'stm-c-f-recent-item',
			], true);
		?>
	</div>
</div>
<?php if(!empty($show_as_carousel) && $show_as_carousel == 'yes') :?>
<script type="text/javascript">
    (function($){
        $(document).ready(function (){

            var owlRecent = $('.as-carousel .stm-row-override');

            owlRecent.on('initialized.owl.carousel', function(e){
				$('.as-carousel .stm-row-override').addClass('owl-carousel');
			});

            owlRecent.owlCarousel({
                items: 4,
                loop: true,
                nav: false,
                dots: false,
                margin: 30,
                responsive: {
                    0: {
                        items: 1
                    },
                    450: {
                        items: 2,
                    },
                    768: {
                        items: 3,
                    },
                    1024: {
                        items: 4,
                    }
                }
            });

            $('.stm-recent-prev').on('click', function () {
                owlRecent.trigger('prev.owl.carousel', [300]);
            });
            $('.stm-recent-next').on('click', function () {
                owlRecent.trigger('next.owl.carousel');
            });

            jQuery('.stm-row-override .owl-dots').remove();
		    jQuery('.stm-row-override .owl-nav').remove();
        });
    })(jQuery);
</script>
<?php endif; ?>
