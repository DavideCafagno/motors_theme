<p><?php
	/* translators: 1: user display name 2: logout url */
	printf( __( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'stm_motors_car_rental' ), '<strong>' . esc_html( $current_user->display_name ) . '</strong>', esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) );
	?></p>

<p><?php
	printf( __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'stm_motors_car_rental' ), esc_url( wc_get_endpoint_url( 'orders' ) ), esc_url( wc_get_endpoint_url( 'edit-address' ) ), esc_url( wc_get_endpoint_url( 'edit-account' ) ) );
	?></p>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' );

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_after_my_account' );
?>
