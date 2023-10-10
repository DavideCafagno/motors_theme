<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_equipment_module_enqueue_scripts_styles('stm_equip_featured');

$args = array(
	'post_type' => stm_listings_post_type(),
	'post_status' => 'publish',
	'posts_per_page' => -1
);

$args['meta_query'][] = array(
	'key'     => 'special_car',
	'value'   => 'on',
	'compare' => '='
);

$special_query = new WP_Query($args);

$carousel_unique_class = 'special-carousel-'.rand(0,99999);

$class = 'listing-cars-carousel owl-carousel ';

$bgImg = '';
if(!empty($carousel_img)) {
    $bgImg = wp_get_attachment_image_url($carousel_img, 'full');
    $bgImg = 'style="background:url(\'' . $bgImg . '\') 0 0 no-repeat; background-color: #1d1f1f; background-position: center; background-size: cover; background-attachment: fixed;"';
}

if(count(explode(' ', $title)) > 1) {
    $titleExpl = explode(' ', $title);
    $titleExpl[0] = '<span class="colored">' . $titleExpl[0] . '</span>';
    $title = implode(' ', $titleExpl);
}

?>

<div class="special-offers carousel">
    <div class="container">
        <div class="title heading-font">
            <h3><?php echo stm_do_lmth($title); ?></h3>
            <a href="<?php echo esc_url(stm_get_listing_archive_link()); ?>?featured_top=true" class="all-offers">
                <span class="vt-top"><?php esc_html_e('Available', 'stm_motors_equipment'); ?></span>
                <span class="lt-blue"><?php echo sprintf(esc_html__('%s Equipment', 'stm_motors_equipment'), $special_query->found_posts); ?></span>
            </a>
        </div>
    </div>

	<?php if($special_query->have_posts()): ?>
		<div class="listing-car-items-units" <?php echo stm_do_lmth($bgImg); ?>>
            <div class="container">
                <div class="listing-car-items <?php echo esc_attr($class); ?> text-center clearfix <?php echo esc_attr($carousel_unique_class); ?>">
                    <?php while($special_query->have_posts()): $special_query->the_post();
                        stm_equipment_load_template('vc_parts/grid-loop');
                    endwhile; ?>
                </div>
            </div>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

</div>

<script>
	(function($) {
		"use strict";

		var owl = $('.<?php echo esc_js($carousel_unique_class); ?>');

		$(document).ready(function () {
			owl.on('initialized.owl.carousel', function(e){
				setTimeout(function () {
					owl.find('.owl-dots').before('<div class="stm-owl-prev"><i class="fas fa-angle-left"></i></div>');
					owl.find('.owl-dots').after('<div class="stm-owl-next"><i class="fas fa-angle-right"></i></div>');
					owl.find('.owl-nav, .owl-dots, .stm-owl-prev, .stm-owl-next').wrapAll("<div class='owl-controls'></div>");
				}, 500);
			});

			var owlRtl = false;
			if( $('body').hasClass('rtl') ) {
				owlRtl = true;
			}

			var owlLoop = true;
            <?php if($special_query->post_count == 1): ?>
                owlLoop = false;
            <?php endif; ?>

			owl.owlCarousel({
				rtl: owlRtl,
				items: 3,
				dots: true,
				autoplay: false,
				slideBy: 3,
				loop: owlLoop,
				responsive:{
					0:{
						items:1,
						slideBy: 1,
                        dots: false
					},
					768:{
						items:2,
						slideBy: 2,
                        dots: true
					},
					992:{
						items:3,
						slideBy: 3
					}
				}
			});
			owl.on('click','.stm-owl-prev', function(){
				owl.trigger('prev.owl.carousel');
			});
			owl.on('click','.stm-owl-next', function(){
				owl.trigger('next.owl.carousel');
			});

			owl.find('.owl-nav.disabled').remove();

			<?php if(!empty($colored_first_word) and $colored_first_word): ?>
			owl.find('.car-title').each(function(){
				var html = $(this).html();
				var word = html.substr(0, html.indexOf(" "));
				var rest = html.substr(html.indexOf(" "));
				$(this).html(rest).prepend($("<span/>").html(word).addClass("stm-base-color"));
			});
			<?php endif; ?>
		});
	})(jQuery);
</script>