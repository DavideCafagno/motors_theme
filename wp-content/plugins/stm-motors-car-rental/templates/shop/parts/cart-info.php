<?php
// phpcs:disable
$cart_items = stm_get_cart_items();
$car_rent = $cart_items['car_class'];
$id = $car_rent['id'];

$priceDate = PriceForDatePeriod::getDescribeTotalByDays($car_rent['price'], $id);
$pricePerHour = get_post_meta( $id, 'rental_price_per_hour_info', true );
$discount = (class_exists('DiscountByDays')) ? DiscountByDays::get_days_post_meta( $id ) : null;
$fixedPrice = (class_exists('PriceForQuantityDays')) ? PriceForQuantityDays::get_sorted_fixed_price($id) : null;

?>
<div class="stm-cart-info-wrap">
    <div class="car-rent-info-title">
        <h4><?php echo esc_html__('Rental Price Detail', 'stm_motors_car_rental')?></h4>
        <?php if(empty($__vars['hide_edit'])): ?>
        <a href="<?php echo get_the_permalink($id); ?>">
            <i class="stm-carent-rental-ico-edit"></i>
        </a>
        <?php endif; ?>
    </div>
    <div class="stm_rent_table">
        <div class="heading heading-font"><h4><?php esc_html_e( 'Product', 'stm_motors_car_rental' ); ?></h4></div>
        <table>
            <thead class="heading-font">
            <tr>
                <td><?php esc_html_e( 'QTY', 'stm_motors_car_rental' ); ?></td>
                <td><?php esc_html_e( 'Rate', 'stm_motors_car_rental' ); ?></td>
                <td><?php esc_html_e( 'Subtotal', 'stm_motors_car_rental' ); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php
			$total = $car_rent['price'] * $car_rent['days'];

			if( !empty($priceDate) && count($priceDate['promo_price']) > 0) :
				?>
				<?php
				if(count($priceDate['simple_price']) > 0):
					$total = array_sum($priceDate['simple_price']);
					?>
                    <tr>
                        <td><?php echo sprintf(esc_html__('%s Days', 'motors'), count($priceDate['simple_price'])); ?></td>
                        <td>
							<?php
							if (!empty($fixedPrice)){
								echo wc_price(array_sum($fixedPrice));
							}else {
								echo wc_price($priceDate['simple_price'][0] );
							}
							?>
                        </td>
                        <td>
							<?php
							if (!empty($fixedPrice)){
								$fixedPrice = array_sum($fixedPrice) * count($priceDate['simple_price']);
								echo wc_price($fixedPrice);
							} else{
								echo wc_price(array_sum($priceDate['simple_price']));
							}
						?>
						</td>
                    </tr>
				<?php
				endif;

				if(count($priceDate['promo_price']) > 0) :
					$total = (count($priceDate['simple_price']) > 0) ? $total + array_sum($priceDate['promo_price']) : array_sum($priceDate['promo_price']);
					?>
                    <tr>
                        <td><?php echo sprintf(esc_html__('%s Days', 'motors'), count($priceDate['promo_price'])); ?></td>
                        <td>
							<?php echo wc_price($priceDate['promo_price'][0] ); ?>
                        </td>
                        <td><?php echo wc_price(array_sum($priceDate['promo_price'])); ?></td>
                    </tr>
				<?php endif; ?>
			<?php else: ?>
                <!--FIXED PRICE-->
				<?php
				if(count($priceDate['promo_price']) == 0 && !empty($fixedPrice)) :
					$days = $car_rent['days'];
					$price = 0;

					foreach ($fixedPrice as $k => $val) {
						if($days >= $k) {
							$price = $val;
						}
					}

					$total = $price * $days;
					?>
                    <tr>
                        <td><?php echo sprintf(esc_html__('%s Days', 'motors'), $car_rent['days']); ?></td>
                        <td>
							<?php echo wc_price($price); ?>
							<?php stm_getInfoWindowPriceManip($id); ?>
                        </td>
                        <td><?php echo wc_price($total); ?></td>
                    </tr>
				<?php else : ?>
                    <tr>
                        <td><?php echo sprintf( esc_html__( '%s Days', 'motors' ), $car_rent['days'] ); ?></td>
                        <td>
                            <?php echo wc_price( $car_rent['price'] ); ?>
                        </td>
                        <td><?php
							if ( isset( $car_rent['subtotal'] ) ) {
								echo wc_price( $car_rent['subtotal'] );
							} else {
								echo wc_price( $car_rent['price'] * $car_rent['days'] );
							}
							?>
						</td>
                    </tr>
			    <?php endif; ?>
			<?php endif; ?>
			<?php
			if(!empty($pricePerHour) && !empty($car_rent['hours'])):
				$total = ($total != ($car_rent['hours'] * $pricePerHour)) ? $total + ($car_rent['hours'] * $pricePerHour) : $car_rent['hours'] * $pricePerHour;
				?>
                <tr>
                    <td><?php echo sprintf(esc_html__('%s Hours', 'motors'), $car_rent['hours']); ?></td>
                    <td>
						<?php echo wc_price( $pricePerHour ); ?>
                    </td>
                    <td><?php echo wc_price($car_rent['hours'] * $pricePerHour); ?></td>
                </tr>
			<?php endif; ?>
			<?php
			if ( !empty( $discount ) ) :
				$currentDiscount = 0;
				$days = 0;
				foreach ( $discount as $k => $val ) {
					if($val['days'] <= $car_rent['days']) {
						$days = $val['days'];
						$currentDiscount = $val['percent'];
					}
				}

				$forDiscount = $total;
				$total = $total - (($total / 100) * $currentDiscount);
				?>
                <tr>
                    <td colspan="2" class="stm-discount"><?php echo sprintf(__('Discount: <span class="show-discount-popup">%s Days and more %s sale</span>', 'motors'), $days, $currentDiscount . '%');?></td>
                    <td class="sb-discount-info"><?php echo '- ' . wc_price( ($forDiscount / 100) * $currentDiscount ); ?></td>
                </tr>
			<?php endif; ?>
            </tbody>
            <tfoot class="heading-font">
            <tr>
                <td colspan="2"><?php esc_html_e( 'Rental Charges Rate', 'stm_motors_car_rental' ); ?></td>
                <td><?php echo wp_kses_post($cart_items['total']); ?></td>
            </tr>
            </tfoot>
        </table>
    </div>

    <!--Add-ons-->
	<?php if ( ! empty( $cart_items['options'] ) ) : ?>
		<div class="stm_rent_table">
			<div class="heading heading-font"><h4><?php esc_html_e( 'Add-ons', 'stm_motors_car_rental' ); ?></h4></div>
			<table>
				<thead class="heading-font">
				<tr>
					<td><?php esc_html_e( 'QTY', 'stm_motors_car_rental' ); ?></td>
					<td><?php esc_html_e( 'Rate', 'stm_motors_car_rental' ); ?></td>
					<td><?php esc_html_e( 'Subtotal', 'stm_motors_car_rental' ); ?></td>
				</tr>
				</thead>
				<tbody>
				<?php foreach ( $cart_items['options'] as $car_option ) : ?>
					<tr>
						<td>
							<?php
							$quant = ( ! empty( $car_option['quantity'] ) ) ? $car_option['quantity'] : 1;
							/* translators: 1. option unit quantity, 2. option name, 3. number of days */
							echo sprintf( esc_html__( '%1$s x %2$1s for %3$s day(s)', 'stm_motors_car_rental' ), ( ( ! empty( $car_option['quantity'] ) && ! empty( $car_option['opt_days'] ) ) ? esc_html( $quant ) : 0 ), esc_html( $car_option['name'] ), esc_html( $car_option['opt_days'] ) );
							?>
						</td>
						<td><?php echo wp_kses_post( wc_price( $car_option['price'] ) ); ?></td>
						<td><?php echo wp_kses_post( wc_price( $car_option['total'] ) ); ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
				<tfoot class="heading-font">
				<tr>
					<td colspan="2"><?php esc_html_e( 'Add-ons Charges Rate', 'stm_motors_car_rental' ); ?></td>
					<td><?php echo wp_kses_post( wc_price( $cart_items['option_total'] ) ); ?></td>
				</tr>
				</tfoot>
			</table>
		</div>
	<?php endif; ?>

    <?php get_template_part( 'partials/rental/common/tax' ); ?>

    <?php get_template_part( 'partials/rental/common/coupon' ); ?>

    <div class="stm-rent-total heading-font">
        <div class="total-title"><?php esc_html_e( 'Estimated total', 'stm_motors_car_rental' ); ?></div>
        <div class="total-price"><?php echo stm_do_lmth( $cart_items['total'] ); ?></div>
    </div>
</div>
<?php
if(!empty($discount)):
	$desc = stm_me_get_wpcfto_mod('discount_program_desc', '');
	?>
    <div id="stm-discount-by-days-popup" class="stm-promo-popup-wrap">
        <div class="stm-promo-popup">
            <h5><?php echo __('Discount program', 'motors'); ?></h5>
			<?php if(!empty($desc)) : ?>
                <div class="stm-disc-prog-desc">
					<?php echo esc_html($desc); ?>
                </div>
			<?php endif; ?>
            <div class="stm-table stm-pp-head">
                <div class="stm-pp-row stm-pp-qty heading-font"><?php _e('QTY', 'motors');?></div>
                <div class="stm-pp-row stm-pp-subtotal heading-font"><?php _e('DISCOUNT', 'motors');?></div>
            </div>
			<?php foreach ( $discount as $k => $val ) : ?>
                <div class="stm-table stm-pp-discount">
                    <div class="stm-pp-row"><?php echo sprintf(__('%s Days and more', 'motors'), $val['days']);?></div>
                    <div class="stm-pp-row"><?php echo esc_html('- ' . $val['percent'] . '%'); ?></div>
                </div>
			<?php endforeach; ?>
            <div class="stm-rental-ico-close" data-close-id="stm-discount-by-days-popup"></div>
        </div>
    </div>
<?php endif; ?>