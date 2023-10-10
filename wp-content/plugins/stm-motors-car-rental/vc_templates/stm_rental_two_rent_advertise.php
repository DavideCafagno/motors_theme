<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

stm_car_rental_module_enqueue_scripts_styles('stm_rental_two_rent_advertise');

$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

?>
<div class="stm-mcr-rent-advertise-wrap <?php echo esc_attr($css_class); ?>">
	<div class="banner-wrap">
		<?php if(!empty($image)) : ?>
			<img src="<?php echo wp_get_attachment_image_url($image, 'full'); ?>" />
		<?php endif; ?>
	</div>
	<div class="advert-info">
		<div class="title">
			<?php echo (!empty($title)) ? $title : ''; ?>
		</div>
		<div class="desc">
			<?php echo (!empty($desc)) ? $desc : ''; ?>
		</div>
		<div class="btn-rent">
			<?php if(!empty($link)): ?>
			<a href="<?php echo esc_url($link); ?>"><?php echo esc_html__('Rent now', 'smt_motors_car_rental')?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
