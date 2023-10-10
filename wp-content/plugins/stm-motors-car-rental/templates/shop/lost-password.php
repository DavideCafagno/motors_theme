<?php
do_action( 'woocommerce_before_lost_password_form' );
?>
<div class="stm-mcr-lost-password">
	<h2><?php echo esc_html__('Forgot Your Password?', 'stm_motors_car_rental')?></h2>
	<p class="desc"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'stm_motors_car_rental' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
	<form method="post" class="woocommerce-ResetPassword lost_reset_password">

		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
			<label for="user_login"><?php esc_html_e( 'Username or email', 'stm_motors_car_rental' ); ?></label>
			<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login"
				   id="user_login" autocomplete="username"/>
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_lostpassword_form' ); ?>

		<p class="woocommerce-form-row form-row form-row-btn-wrap ">
			<input type="hidden" name="wc_reset_password" value="true"/>
			<button type="submit" class="woocommerce-Button button"
					value="<?php esc_attr_e( 'Reset password', 'stm_motors_car_rental' ); ?>"><?php esc_html_e( 'Reset password', 'stm_motors_car_rental' ); ?></button>
		</p>

		<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

	</form>
</div>
<?php
do_action( 'woocommerce_after_lost_password_form' );