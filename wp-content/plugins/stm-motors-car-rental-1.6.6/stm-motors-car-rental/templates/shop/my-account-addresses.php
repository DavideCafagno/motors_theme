<?php
$customer_id = get_current_user_id();

if ( !wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Addresses', 'stm_motors_car_rental' ) );
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array( 'billing' => __( 'Billing address', 'stm_motors_car_rental' ), 'shipping' => __( 'Shipping address', 'stm_motors_car_rental' ) ), $customer_id );
} else {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', 'stm_motors_car_rental' ) );
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array( 'billing' => __( 'Billing address', 'stm_motors_car_rental' ) ), $customer_id );
}
?>

<h3><?php echo apply_filters( 'stm_balance_tags', $page_title ); ?></h3>

<p class="myaccount_address">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'stm_motors_car_rental' ) ); ?>
</p>

<?php if ( !wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	echo '<div class="addresses">';
} ?>
<?php foreach ( $get_addresses as $name => $title ) : ?>

    <div class="address">
        <header class="title">
            <h3><?php echo apply_filters( 'stm_balance_tags', $title ); ?></h3>
        </header>
		<?php
		$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array( 'country' => array( 'title' => __( 'Country', 'stm_motors_car_rental' ), 'value' => get_user_meta( $customer_id, $name . '_country', true ) ), 'first_name' => array( 'title' => __( 'First Name', 'stm_motors_car_rental' ), 'value' => get_user_meta( $customer_id, $name . '_first_name', true ) ), 'last_name' => array( 'title' => __( 'Last Name', 'stm_motors_car_rental' ), 'value' => get_user_meta( $customer_id, $name . '_last_name', true ) ), 'company' => array( 'title' => __( 'Company', 'motors' ), 'value' => get_user_meta( $customer_id, $name . '_company', true ) ), 'address' => array( 'title' => __( 'Address', 'motors' ), 'value' => get_user_meta( $customer_id, $name . '_address_1', true ) . ' / ' . get_user_meta( $customer_id, $name . '_address_2', true ) ), 'city' => array( 'title' => __( 'City', 'motors' ), 'value' => get_user_meta( $customer_id, $name . '_city', true ) ), 'state' => array( 'title' => __( 'State', 'motors' ), 'value' => get_user_meta( $customer_id, $name . '_state', true ) ), 'postcode' => array( 'title' => __( 'Postcode', 'motors' ), 'value' => get_user_meta( $customer_id, $name . '_postcode', true ) )

		), $customer_id, $name );


		if ( !$address ) {
			_e( 'You have not set up this type of address yet.', 'stm_motors_car_rental' );
		} else {
			$output = '';
		}
		$output .= '<table class="address-table">';
		$output .= '<tbody>';
		foreach ( $address as $value ) {
			$placeholder = '&nbsp;';
			if ( !empty( $value['value'] ) ) {
				$placeholder = '';
			}
			$output .= '<tr><th>' . esc_html( $value['title'] ) . '</th><td>' . $placeholder . esc_html( $value['value'] ) . '</td></tr>';
		}
		$output .= '</tbody>';
		$output .= '</table>';
		echo apply_filters( 'stm_balance_tags', $output );
		?>
        <footer>
            <a href="<?php echo wc_get_endpoint_url( 'edit-address', $name ); ?>"
               class="button edit"><?php _e( 'Edit', 'stm_motors_car_rental' ); ?></a>
        </footer>
    </div>

<?php endforeach; ?>
<?php if ( !wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	echo '</div>';
}
?>
