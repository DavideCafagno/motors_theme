<?php
$post_id = apply_filters( 'stm_get_wpml_product_parent_id', get_the_ID() );

if ( isset( $__vars['product_id'] ) ) {
	$post_id = stm_get_wpml_product_parent_id( $__vars['product_id'] );
}

$product      = wc_get_product( $post_id );
$fields       = stm_get_rental_order_fields_values();
$product_type = 'default';
$checkoutUrl  = wc_get_checkout_url();
$cart_items   = stm_get_cart_items();
$optTotal     = 0;
$singlePay    = get_post_meta( $post_id, '_car_option', true );

if ( ! empty( $cart_items['options'] ) ) {
	foreach ( $cart_items['options'] as $item ) {
		$optTotal = $optTotal + $item['total'];
	}
}

if ( $__vars['is_add_to_cart'] ) {
	if ( ! empty( $product ) ) :
		if ( $product->is_type( 'variable' ) ) :
			$variations = $product->get_available_variations();

			$prices = array();
			if ( ! empty( $variations ) ) {
				$max_price = 0;
				$i         = 0;
				foreach ( $variations as $variation ) {

					$varId   = $variation['variation_id'];
					$varProd = wc_get_product( $varId );

					if ( ( ! empty( $variation['display_price'] ) || ! empty( $variation['display_regular_price'] ) ) && ! empty( $variation['variation_description'] ) ) {

						$gets = array(
							'add-to-cart'  => $post_id,
							'product_id'   => $post_id,
							'variation_id' => $variation['variation_id'],
						);

						foreach ( $variation['attributes'] as $key => $val ) {
							$gets[ $key ] = $val;
						}

						$url = add_query_arg( $gets, $checkoutUrl );

						$total_price = false;
						if ( ! empty( $fields['order_days'] ) ) {
							$total_price = $varProd->get_price();
						}

						if ( ! empty( $total_price ) ) {
							if ( $max_price < $total_price ) {
								$max_price = $total_price;
							}
						}

						if ( 0 === $fields['order_days'] && PricePerHour::hasPerHour() ) {
							$total_price = PricePerHour::getPricePerHour( $post_id ) * $fields['order_hours'];
						}

						$prices[] = array(
							'price' => stm_get_default_variable_price( $post_id, $i ),
							'text'  => $variation['variation_description'],
							'total' => $total_price,
							'url'   => $url,
						);
					}
					$i ++;

				}
			}

			if ( ! empty( $prices ) ) : ?>
				<div class="stm_rent_prices">
					<?php
					$i = 1;

					foreach ( $prices as $price ) :
						?>
						<div class="stm_rent_price price-view-<?php echo esc_attr( $i ); ?>"
								data-total-price="<?php echo esc_attr( $price['total'] ); ?>">
							<div class="total heading-font">
								<span class="total-price">
									<?php echo wp_kses_post( wc_price( $price['total'] + $optTotal ) ); ?>
								</span>
								<?php
								if ( ! empty( $price['total'] ) ) {
									echo esc_html__( 'Total Price', 'stm_motors_car_rental' );
								}
								?>
							</div>
							<div class="pay">
								<a class="heading-font pay-btn-<?php echo esc_attr( $i ); ?> <?php echo esc_attr( $__vars['disableBtns'] ); ?>"
										href="<?php echo ( empty( $__vars['disableBtns'] ) ) ? esc_url( $price['url'] ) : '#'; ?>"
										data-url="<?php echo ( empty( $__vars['disableBtns'] ) ) ? esc_url( $price['url'] ) : '#'; ?>">
									<?php echo esc_html( wp_strip_all_tags( $price['text'] ) ); ?>
								</a>
							</div>
						</div>
						<?php
						$i ++;
					endforeach;
					?>
				</div>
				<?php
			endif;
		else :
			$price = $product->get_price();

			if ( 0 === $fields['order_days'] && PricePerHour::hasPerHour() ) {
				$price = PricePerHour::getPricePerHour( $post_id ) * $fields['order_hours'];
			}

			$gets = array(
				'add-to-cart' => $post_id,
				'product_id'  => $post_id,
			);

			$url = add_query_arg( $gets, $checkoutUrl );

			if ( ! empty( $price ) && $url ) :
				?>
				<div class="stm_rent_prices">
					<div class="stm_rent_price price-view-1" data-total-price="<?php echo esc_attr( $price ); ?>">
						<div class="total heading-font">
							<span class="total-price"><?php echo wp_kses_post( wc_price( $price + $optTotal ) ); ?></span>
							<?php
							if ( ! empty( $price ) ) {
								echo esc_html__( 'Total Price', 'stm_motors_car_rental' );
							}
							?>
						</div>
						<div class="pay">
							<a class="heading-font pay-btn-1 <?php echo esc_attr( $__vars['disableBtns'] ); ?>"
									href="<?php echo ( empty( $__vars['disableBtns'] ) ) ? esc_url( $url ) : '#'; ?>"
									data-url="<?php echo ( empty( $__vars['disableBtns'] ) ) ? esc_url( $url ) : '#'; ?>">
								<?php esc_html_e( 'Pay now', 'stm_motors_car_rental' ); ?>
							</a>
						</div>
					</div>
				</div>
				<?php
			endif;
		endif;
	endif;
} else {
	$prices    = get_post_meta( $post_id, '_price' );
	$price     = ( ! empty( $prices ) ) ? $prices[0] : 0;
	$orderDays = $fields['order_days'];

	if ( ! empty( $prices ) && ! empty( $prices[0] ) ) {
		$price = $prices[0];
	}

	?>
	<div class="stm_price_info">
		<div class="total_days">
			<?php
			$popupId = $post_id . wp_rand( 1, 99999 );
			if ( PricePerHour::hasPerHour() || PriceForDatePeriod::hasDatePeriod() || ( class_exists( 'DiscountByDays' ) && DiscountByDays::hasDiscount( $post_id ) ) || ( class_exists( 'PriceForQuantityDays' ) && PriceForQuantityDays::hasFixedPrice( $post_id, $fields['order_days'] ) ) ) {
				echo '<div class="stm-show-rent-promo-info" data-popup-id="stm-promo-popup-wrap-' . esc_attr( $popupId ) . '">';
				$orderHours = ( empty( $fields['order_hours'] ) ) ? 0 : $fields['order_hours'];
				echo sprintf( esc_html__( '%1$s Days / %2$s Hours', 'stm_motors_car_rental' ), esc_html( $fields['order_days'] ), esc_html( $orderHours ) );
				echo '</div>';
				stm_get_popup_promo_price( $popupId, $post_id, $price, $fields );
			} else {
				$day = sprintf( esc_html__( 'Total %1$s %2$s', 'stm_motors_car_rental' ), esc_html( $orderDays ), ( esc_html( $orderDays ) < 2 ) ? esc_html_x( 'Day', 'rental_list_days', 'stm_motors_car_rental' ) : esc_html_x( 'Days', 'rental_list_days', 'stm_motors_car_rental' ) );
				echo esc_html( $day );
			}
			?>
		</div>
		<div class="total_price">
			<?php
			if ( 0 === $fields['order_days'] && PricePerHour::hasPerHour() ) {
				$priceTotal = PricePerHour::getPricePerHour( $post_id ) * $fields['order_hours'];
				echo wp_kses_post( wc_price( $priceTotal ) );
			} elseif ( PricePerHour::hasPerHour() || PriceForDatePeriod::hasDatePeriod() || ( class_exists( 'DiscountByDays' ) ) || ( class_exists( 'PriceForQuantityDays' ) && PriceForQuantityDays::hasFixedPrice( $post_id, $fields['order_days'] ) ) ) {
				echo wp_kses_post( wc_price( $product->get_price() ) );
			} elseif ( ! empty( $price ) ) {
				echo wp_kses_post( wc_price( $price * $orderDays ) );
			}
			?>
		</div>
		<div class="daily_price">
			<?php echo sprintf( esc_html__( '%s/Daily', 'stm_motors_car_rental' ), wp_kses_post( wc_price( $price ) ) ); ?>
		</div>
	</div>
	<?php if ( ! empty( $price ) ) : ?>
		<div class="rent-btn-wrap">
			<a href="#" data-invis="<?php echo esc_attr( $__vars['invis_id'] ); ?>" class="rent-now">
			<span class="open">
			<?php echo esc_html__( 'Rent Now!', 'stm_motors_car_rental' ); ?>
			</span>
				<span class="cancel">
			<?php echo esc_html__( 'Cancel', 'stm_motors_car_rental' ); ?>
			</span>
			</a>
		</div>
	<?php endif; ?>
	<?php
}
?>
