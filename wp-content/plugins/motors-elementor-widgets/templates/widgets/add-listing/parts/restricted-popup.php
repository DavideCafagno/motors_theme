<?php
$restricted        = false;
$car_edit          = false;
$stm_edit_car_form = '';

if ( ! empty( $_GET['edit_car'] ) && $_GET['edit_car'] ) {//phpcs:ignore
	$car_edit          = true;
	$stm_edit_car_form = 'stm_edit_car_form';
}

if ( is_user_logged_in() ) {
	$user         = wp_get_current_user();
	$user_id      = $user->ID;
	$restrictions = stm_get_post_limits( $user_id );
} else {
	$restrictions = stm_get_post_limits( '' );
}

if ( $restrictions['posts'] < 1 ) {
	$restricted = true;
}

$login_page = stm_me_get_wpcfto_mod( 'login_page', 1718 );
$login_page = stm_motors_wpml_is_page( $login_page );

if ( $restricted && ! $car_edit && ! stm_enablePPL() ) : ?>
	<div class="stm-no-available-adds-overlay"></div>
	<div class="stm-no-available-adds">
		<h3><?php esc_html_e( 'Posts Available', 'motors-elementor-widgets' ); ?>: <span>0</span></h3>
		<p><?php esc_html_e( 'You ended the limit of free classified ads. Please select one of the following', 'motors-elementor-widgets' ); ?></p>
		<div class="clearfix">
			<?php if ( stm_pricing_enabled() ) : ?>
				<?php
				$stm_pricing_link = stm_pricing_link();
				if ( ! empty( $stm_pricing_link ) ) :
					?>
					<a href="<?php echo esc_url( $stm_pricing_link ); ?>" class="button stm-green">
						<?php esc_html_e( 'Upgrade Plan', 'motors-elementor-widgets' ); ?>
					</a>
				<?php endif; ?>
			<?php else : ?>
				<?php if ( 'user' === $restrictions['role'] ) : ?>
					<a href="<?php echo esc_url( add_query_arg( array( 'become_dealer' => 1 ), stm_get_author_link( '' ) ) ); ?>" class="button stm-green">
						<?php esc_html_e( 'Become a Dealer', 'motors-elementor-widgets' ); ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( stm_get_author_link( '' ) ); ?>" class="button stm-green-dk"><?php esc_html_e( 'My inventory', 'motors-elementor-widgets' ); ?></a>
			<?php elseif ( $login_page ) : ?>
				<a href="<?php echo esc_url( get_permalink( $login_page ) ); ?>" class="button stm-green-dk"><?php esc_html_e( 'Registration', 'motors-elementor-widgets' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
