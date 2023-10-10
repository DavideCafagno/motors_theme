<?php
$excerpt             = get_the_excerpt();
$product             = wc_get_product();
$fields              = stm_get_rental_order_fields_values();
$price               = $product->get_price();
$reg_price           = $product->get_regular_price();
$sale_price          = $product->get_sale_price();
$cart_items          = stm_get_cart_items();
$added               = false;
$options_quantity    = 0;
$single_pay          = get_post_meta( get_the_ID(), '_car_option', true );
$fields['ceil_days'] = ( empty( $fields['ceil_days'] ) ) ? 1 : $fields['ceil_days'];
$days                = ( ! empty( $single_pay ) ) ? 1 : $fields['ceil_days'];
$manage_stock        = get_post_meta( get_the_ID(), '_manage_stock', true );

if ( ! empty( $cart_items['options_list'][ get_the_ID() ] ) ) {
	$added            = true;
	$options_quantity = ( ! empty( $cart_items['options'][0]['quantity'] ) ) ? $cart_items['options'][0]['quantity'] : 0;
}

if ( ! $added ) {
	$gets = array(
		'add-to-cart' => get_the_ID(),
	);
} else {
	$gets = array(
		'remove-from-cart' => get_the_ID(),
	);
}

?>


<div class="stm_rental_option">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="image">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</div>
	<?php endif; ?>
	<div class="stm_rental_option_content">
		<div class="title">
			<h4>
				<?php the_title(); ?>
				<?php if ( ! empty( $excerpt ) ) : ?>
					<div class="opt-info-wrap">
						<i class="fas fa-info" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html( $excerpt ); ?>"></i>
					</div>
				<?php endif; ?>
			</h4>
			<div class="price">
				<?php if ( ! empty( $sale_price ) ) : ?>
					<div class="sale_price">
						<?php
						if ( empty( $single_pay ) ) {
							/* translators: regular price */
							echo wp_kses_post( sprintf( __( '%s/Daily', 'stm_motors_car_rental' ), wc_price( $reg_price ) ) );
						} else {
							/* translators: regular price */
							echo wp_kses_post( sprintf( __( '%s/Single', 'stm_motors_car_rental' ), wc_price( $reg_price ) ) );
						}
						?>
					</div>
				<?php else : ?>
					<div class="empty_sale_price"></div>
				<?php endif; ?>
				<div class="current_price heading-font">
					<?php
					if ( empty( $single_pay ) ) {
						/* translators: sale price */
						echo wp_kses_post( sprintf( __( '%s/Daily', 'stm_motors_car_rental' ), wc_price( $price ) ) );
					} else {
						/* translators: sale price */
						echo wp_kses_post( sprintf( __( '%s/Single', 'stm_motors_car_rental' ), wc_price( $price ) ) );
					}
					?>
				</div>
			</div>
		</div>
		<div class="meta">
			<?php if ( 'yes' === $manage_stock ) : ?>
				<div class="quantity" data-id="<?php echo esc_attr( get_the_ID() ); ?>" data-invis-id="<?php echo esc_attr( $__vars['invisId'] ); ?>" data-price="<?php echo esc_attr( $price ); ?>" data-days="<?php echo esc_attr( $days ); ?>">
					<span class="quantity_actions plus">+</span>
					<input type="text" step="1" min="0" name="quantity" value="<?php echo esc_attr( $options_quantity ); ?>" title="Qty" class="input-text qty text" size="4">
					<span class="quantity_actions minus">-</span>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
