<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_c_f_module_enqueue_scripts_styles('stm_c_f_featured_listings');

?>
<div class="stm-c-f-featured-listings">
	<?php if(!empty($featured_title)): ?>
		<h2><?php echo esc_html($featured_title); ?></h2>
	<?php endif; ?>
	<?php echo do_shortcode('[ulisting-feature listing_type_id="' . $listing_type . '" limit="' . $posts_limit . '"]'); ?>
</div>

<script>
	(function ($) {
		$(window).on('load', function () {
			$('.stm-featured-wrap').addClass('owl-carousel');
		});
	})(jQuery);
</script>