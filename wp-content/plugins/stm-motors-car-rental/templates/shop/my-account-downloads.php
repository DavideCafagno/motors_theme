<?php
$current_user = $__vars['current_user'];
?>
<div class="stm-mcr-account-wrap">
	<?php stm_car_rental_load_template( 'shop/parts/account-navigation' ); ?>
    <div class="woocommerce-MyAccount-wrap">
		<?php
		$downloads = WC()->customer->get_downloadable_products();

		if ( $downloads ) : ?>

			<?php do_action( 'woocommerce_before_available_downloads' ); ?>

            <h2><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', esc_html__( 'Available downloads', 'stm_motors_car_rental' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>

            <ul class="woocommerce-Downloads digital-downloads">
				<?php foreach ( $downloads as $download ) : ?>
                    <li>
						<?php
						do_action( 'woocommerce_available_download_start', $download );

						if ( is_numeric( $download['downloads_remaining'] ) ) {
							/* translators: %s product name */
							echo apply_filters( 'woocommerce_available_download_count', '<span class="woocommerce-Count count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'stm_motors_car_rental' ), $download['downloads_remaining'] ) . '</span> ', $download ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}

						echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

						do_action( 'woocommerce_available_download_end', $download );
						?>
                    </li>
				<?php endforeach; ?>
            </ul>

			<?php do_action( 'woocommerce_after_available_downloads' ); ?>
		<?php endif; ?>
    </div>
</div>
