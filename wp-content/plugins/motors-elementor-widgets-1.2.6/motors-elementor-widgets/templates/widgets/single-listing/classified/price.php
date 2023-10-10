<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$price                = get_post_meta( $listing_id, 'price', true );
$sale_price           = get_post_meta( $listing_id, 'sale_price', true );
$car_price_form_label = get_post_meta( $listing_id, 'car_price_form_label', true );

if ( empty( $price ) && ! empty( $sale_price ) ) {
	$price = $sale_price;
}

if ( ! empty( $price ) && ! empty( $sale_price ) ) {
	$price = $sale_price;
}

$as_sold = get_post_meta( $listing_id, 'car_mark_as_sold', true );
?>

<div class="stm-listing-single-price-title heading-font clearfix">
	<?php if ( ! $as_sold ) : ?>
		<?php if ( ! empty( $car_price_form_label ) ) : ?>
			<a href="#" class="rmv_txt_drctn archive_request_price" data-toggle="modal" data-target="#get-car-price" data-title="<?php echo esc_attr( get_the_title( $listing_id ) ); ?>" data-id="<?php echo esc_attr( $listing_id ); ?>">
				<div class="price"><?php echo esc_attr( $car_price_form_label ); ?></div>
			</a>
		<?php else : ?>
			<?php if ( ! empty( $price ) ) : ?>
				<div class="price"><?php echo wp_kses_post( stm_listing_price_view( $price ) ); ?></div>
			<?php endif; ?>
		<?php endif; ?>
	<?php else : ?>
		<div class="price"><?php echo esc_html__( 'Sold', 'motors' ); ?></div>
	<?php endif; ?>
</div>
