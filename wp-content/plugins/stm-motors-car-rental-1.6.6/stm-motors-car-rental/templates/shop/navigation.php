<?php
do_action( 'woocommerce_before_account_navigation' );

$icons = array('dashboard' => 'dashboard', 'orders' => 'orders', 'downloads' => 'download', 'edit-address' => 'addresses', 'edit-account' => 'edit-profile', 'customer-logout' => 'logout');
$userId = get_current_user();
?>

	<nav class="woocommerce-MyAccount-navigation">
		<ul>
			<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ) . ' ' . $endpoint; ?>">
                    <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
                        <i class="stm-carent-rental-ico-<?php echo esc_html($icons[$endpoint]);?>"></i>
                        <?php echo esc_html( $label ); ?>
                    </a>
                </li>
			<?php endforeach; ?>
		</ul>
	</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>