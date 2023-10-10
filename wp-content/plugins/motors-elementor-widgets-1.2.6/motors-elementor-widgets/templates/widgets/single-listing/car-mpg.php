<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$city_mpg    = get_post_meta( $listing_id, 'city_mpg', true );
$highway_mpg = get_post_meta( $listing_id, 'highway_mpg', true );

if ( ! empty( $city_mpg ) || ! empty( $highway_mpg ) ) : ?>
	<div class="stm_single_car_mpg">
		<div class="single-car-mpg heading-font">
			<div class="text-center">
				<div class="clearfix dp-in text-left mpg-mobile-selector">
					<div class="mpg-unit">
						<div class="mpg-value"><?php echo ( ! empty( $city_mpg ) ) ? esc_attr( $city_mpg ) : '-'; ?></div>
						<div class="mpg-label"><?php esc_html_e( 'city mpg', 'motors-elementor-widgets' ); ?></div>
					</div>
					<div class="mpg-icon">
						<?php echo wp_kses( $car_mpg_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
					</div>
					<div class="mpg-unit">
						<div class="mpg-value"><?php echo ( ! empty( $highway_mpg ) ) ? esc_attr( $highway_mpg ) : '-'; ?></div>
						<div class="mpg-label"><?php esc_html_e( 'hwy mpg', 'motors' ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
