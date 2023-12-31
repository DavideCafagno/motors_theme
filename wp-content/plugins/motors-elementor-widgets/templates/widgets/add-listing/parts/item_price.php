<?php
$_id = stm_listings_input( 'item_id' );

if ( $custom_listing_type && $listing_types_options ) {
	$show_price_label = ( $listing_types_options[ $custom_listing_type . '_addl_price_label' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_price_label' ] : '';
	$stm_title_price  = ( $listing_types_options[ $custom_listing_type . '_addl_price_title' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_price_title' ] : '';
	$stm_title_desc   = ( $listing_types_options[ $custom_listing_type . '_addl_price_desc' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_price_desc' ] : '';
} else {
	$show_price_label = stm_me_get_wpcfto_mod( 'addl_price_label', '' );
	$stm_title_price  = stm_me_get_wpcfto_mod( 'addl_price_title', '' );
	$stm_title_desc   = stm_me_get_wpcfto_mod( 'addl_price_desc', '' );
}

$car_price_form_label = '';
$price                = '';
$sale_price           = '';

if ( ! empty( $_id ) ) {
	$car_price_form_label = get_post_meta( $_id, 'car_price_form_label', true );
	$price                = (int) getConverPrice( get_post_meta( $_id, 'price', true ) );
	$sale_price           = ( ! empty( get_post_meta( $_id, 'sale_price', true ) ) ) ? (int) getConverPrice( get_post_meta( $_id, 'sale_price', true ) ) : '';
}
?>

<div class="stm-form-price-edit">
	<div class="stm-car-listing-data-single stm-border-top-unit ">
		<div class="title heading-font"><?php esc_html_e( 'Set Your Asking Price', 'motors-elementor-widgets' ); ?></div>
	</div>

	<?php if ( ! empty( $show_price_label ) && $show_price_label ) : ?>
		<div class="row stm-relative">
			<div class="col-md-12 col-sm-12 stm-prices-add">
				<?php if ( ! empty( $stm_title_price ) ) : ?>
					<h4><?php echo esc_html( $stm_title_price ); ?></h4>
				<?php endif; ?>
				<?php if ( ! empty( $stm_title_desc ) ) : ?>
					<p><?php echo wp_kses_post( $stm_title_desc ); ?></p>
				<?php endif; ?>
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="row">
					<div class="col-md-4 col-sm-12">
						<div class="stm_price_input">
							<div class="stm_label heading-font"><?php esc_html_e( 'Price', 'motors-elementor-widgets' ); ?>*
								(<?php echo wp_kses_post( stm_get_price_currency() ); ?>)
							</div>
							<input type="number" min="0" class="heading-font" name="stm_car_price" value="<?php echo esc_attr( $price ); ?>" required/>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="stm_price_input">
							<div class="stm_label heading-font"><?php esc_html_e( 'Sale Price', 'motors-elementor-widgets' ); ?>
								(<?php echo wp_kses_post( stm_get_price_currency() ); ?>)
							</div>
							<input type="number" min="0" class="heading-font" name="stm_car_sale_price" value="<?php echo esc_attr( $sale_price ); ?>" required/>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="stm_price_input">
							<div
									class="stm_label heading-font"><?php esc_html_e( 'Custom label instead of price', 'motors-elementor-widgets' ); ?></div>
							<input type="text" class="heading-font" name="car_price_form_label" value="<?php echo esc_attr( $car_price_form_label ); ?>"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<div class="row stm-relative">
			<div class="col-md-4 col-sm-6">
				<div class="stm_price_input">
					<div class="stm_label heading-font"><?php esc_html_e( 'Price', 'motors-elementor-widgets' ); ?>*
						(<?php echo wp_kses_post( stm_get_price_currency() ); ?>)
					</div>
					<input type="number" class="heading-font" name="stm_car_price" value="<?php echo esc_attr( $price ); ?>" required/>
				</div>
			</div>
			<div class="col-md-8 col-sm-6">
				<?php if ( ! empty( $stm_title_price ) ) : ?>
					<h4><?php echo esc_attr( $stm_title_price ); ?></h4>
				<?php endif; ?>
				<?php if ( ! empty( $stm_title_desc ) ) : ?>
					<p><?php echo wp_kses_post( $stm_title_desc ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<input type="hidden" name="btn-type"/>
</div>
