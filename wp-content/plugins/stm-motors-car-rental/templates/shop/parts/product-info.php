<?php
$cart_items = stm_get_cart_items();

if ( ! empty( $cart_items['car_class'] ) ) {
	$car_rent = $cart_items['car_class'];
}

if ( ! empty( $car_rent['id'] ) ) {
	$car_id = $car_rent['id'];
}

?>
<?php
if ( has_post_thumbnail( $car_id ) ) :
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $car_id ), 'stm-img-350-181' );

	if ( ! empty( $image[0] ) ) :
		?>
		<div class="image">
			<img src="<?php echo esc_url( $image[0] ); ?>" />
		</div>
	<?php endif; ?>
<?php endif; ?>

<div class="title">
	<h4>
		<?php echo esc_html( $car_rent['name'] ); ?>
	</h4>
	<div class="subtitle heading-font">
		<?php echo esc_html( $car_rent['subname'] ); ?>
	</div>
</div>

<?php
