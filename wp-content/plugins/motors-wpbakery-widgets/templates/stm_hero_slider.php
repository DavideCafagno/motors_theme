<?php
/****
 * @var $loop
 * @var $autoplay
 * @var $transition_speed
 * @var $delay
 * @var $pause_on_mouseover
 * @var $navigation
 * */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
$css_class = ( ! empty( $css ) ) ? apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) ) : '';

$slider_options = compact(
	'loop',
	'autoplay',
	'transition_speed',
	'delay',
	'pause_on_mouseover',
	'navigation',
);

$uniqid = uniqid();

?>

<div class="stm-hero-slider stm-hero-slider-<?php echo esc_attr( $uniqid ); ?> swiper swiper-container <?php echo esc_attr( $css_class ); ?>" data-options="<?php echo esc_attr( wp_json_encode( $slider_options ) ); ?>" data-widget-id="<?php echo esc_attr( $uniqid ); ?>">
	<div class="swiper-wrapper">
	<?php echo wp_kses_post( wpb_js_remove_wpautop( $content ) ); ?>
	</div>
	<?php if ( $navigation ) : ?>
		<div class="stm-hero-slider-nav">
			<div class="stm-hero-slider-nav-prev"></div>
			<div class="stm-hero-slider-nav-next"></div>
		</div>
	<?php endif; ?>
</div>
<?php
