<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_c_f_module_enqueue_scripts_styles('stm_c_f_search_form_category');
?>
<div class="stm-c-f-search-form-category-wrap <?php echo esc_attr( $css_class ); ?>">
	<?php echo do_shortcode('[search-form-category]'); ?>
</div>