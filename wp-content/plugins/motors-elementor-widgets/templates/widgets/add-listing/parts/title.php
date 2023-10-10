<?php
$_id = stm_listings_input( 'item_id' );

if ( $custom_listing_type && $listing_types_options && isset( $listing_types_options[ $custom_listing_type . '_addl_car_title' ] ) ) {
	$show_car_title = $listing_types_options[ $custom_listing_type . '_addl_car_title' ];
} else {
	$show_car_title = stm_me_get_wpcfto_mod( 'addl_car_title', true );
}

if ( ! empty( $show_car_title ) && $show_car_title ) :
	$value = '';
	if ( ! empty( $_id ) ) {
		$value = get_the_title( $_id );
	} ?>
	<div class="stm-car-listing-data-single stm-border-top-unit ">
		<div class="stm_add_car_title_form">
			<div class="title heading-font"><?php esc_html_e( 'Listing Title', 'motors-elementor-widgets' ); ?></div>
			<input type="text" name="stm_car_main_title" value="<?php echo esc_attr( $value ); ?>" placeholder="<?php esc_attr_e( 'Title', 'motors-elementor-widgets' ); ?>">
		</div>
	</div>
<?php endif; ?>
