<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$vin         = get_post_meta( $listing_id, 'vin_number', true );
$price       = get_post_meta( $listing_id, 'price', true );
$sale_price  = get_post_meta( $listing_id, 'sale_price', true );
$guru_style  = $carguru_style;
$guru_rating = $carguru_min_rating;
$guru_height = $carguru_default_height;

if ( ! empty( $sale_price ) ) {
	$price = $sale_price;
}

?>
<!-- only visible in Elementor editor when the widget is empty -->
<div class="stm-elementor-editor-preview-icon" style="margin-bottom: -25px;">
	<i class="fas fa-car" style="font-size: 30px;"></i>
	<p style="margin: 0;"><?php echo esc_html__( 'CarGurus', 'motors-elementor-widgets' ); ?></p>
</div>
<style>
	.stm-elementor-editor-preview-icon {
		display: none;
	}

	.elementor-editor-active .elementor-widget-empty .stm-elementor-editor-preview-icon {
		display: block !important;
		text-align: center;
		max-width: fit-content;
		margin: 0 auto;
		padding: 10px;
	}
</style>
<?php

// @codingStandardsIgnoreStart
if ( ! empty( $guru_style ) && ! empty( $vin ) && ! empty( $price ) ) : ?>
	<script>
        var CarGurus = window.CarGurus || {};
        window.CarGurus = CarGurus;
        CarGurus.DealRatingBadge = window.CarGurus.DealRatingBadge || {};
        CarGurus.DealRatingBadge.options = {
            "style": "<?php echo esc_attr( $guru_style ); ?>",
            "minRating": "<?php echo esc_attr( $guru_rating ); ?>",
			<?php
			if ( strpos( $guru_style, 'STYLE' ) !== false ) :
			?>
            "defaultHeight": "<?php echo esc_attr( $guru_height ); ?>"<?php endif; ?>
        };

        (function () {
            var script = document.createElement('script');
            script.src = "https://static.cargurus.com/js/api/en_US/1.0/dealratingbadge.js";
            script.async = true;
            var entry = document.getElementsByTagName('script')[0];
            entry.parentNode.insertBefore(script, entry);
        })();
	</script>

	<div class="car_gurus_wrapper <?php echo ( strpos( $guru_style, 'STYLE' ) !== false ) ? 'cg_style' : 'cg_banner'; ?>">
		<span data-cg-vin="<?php echo esc_attr( $vin ); ?>" data-cg-price="<?php echo intval( $price ); ?>"></span>
	</div>
<?php
endif;
// @codingStandardsIgnoreEnd
?>
