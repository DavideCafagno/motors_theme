<?php
$user = $__vars['user'];

do_action( 'woocommerce_before_edit_account_form' ); ?>

    <form class="woocommerce-EditAccountForm edit-account" action=""
          method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

        <div class="edit-fields-wrap">
            <h3><?php _e( 'Account Settings', 'stm_motors_car_rental' ); ?></h3>

            <div class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                <label for="account_first_name"><?php esc_html_e( 'First name', 'stm_motors_car_rental' ); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                       name="account_first_name" id="account_first_name" autocomplete="given-name"
                       value="<?php echo esc_attr( $user->first_name ); ?>"/>
            </div>
            <div class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                <label for="account_last_name"><?php esc_html_e( 'Last name', 'stm_motors_car_rental' ); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name"
                       id="account_last_name" autocomplete="family-name"
                       value="<?php echo esc_attr( $user->last_name ); ?>"/>
            </div>

            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="account_display_name"><?php esc_html_e( 'Display name', 'stm_motors_car_rental' ); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                       name="account_display_name" id="account_display_name"
                       value="<?php echo esc_attr( $user->display_name ); ?>"/>
                <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'stm_motors_car_rental' ); ?></em></span>
            </div>

            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="account_email"><?php esc_html_e( 'Email address', 'stm_motors_car_rental' ); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email"
                       id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>"/>
            </div>


        </div>
        <div class="edit-fields-wrap pass-change">
            <h3><?php esc_html_e( 'Password change', 'stm_motors_car_rental' ); ?></h3>

            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<?php if ( stm_is_rental() ): ?>
                    <label for="password_current"><?php esc_html_e( 'Current password', 'stm_motors_car_rental' ); ?><span
                                class="stm-label-small"><?php _e( ' (leave blank to leave unchanged)', 'stm_motors_car_rental' ); ?></span></label>
				<?php else: ?>
                    <label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'stm_motors_car_rental' ); ?></label>
				<?php endif; ?>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                       name="password_current" id="password_current"/>
            </div>
            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<?php if ( stm_is_rental() ): ?>
                    <label for="password_1"><?php esc_html_e( 'New password', 'stm_motors_car_rental' ); ?><span
                                class="stm-label-small"><?php _e( ' (leave blank to leave unchanged)', 'stm_motors_car_rental' ); ?></span></label>
				<?php else: ?>
                    <label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'stm_motors_car_rental' ); ?></label>
				<?php endif; ?>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                       name="password_1" id="password_1"/>
            </div>
            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password_2"><?php esc_html_e( 'Confirm new password', 'stm_motors_car_rental' ); ?></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                       name="password_2" id="password_2"/>
            </div>
        </div>

		<?php do_action( 'woocommerce_edit_account_form' ); ?>

        <div class="button-wrap">
			<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
            <input type="submit" class="woocommerce-Button button" name="save_account_details"
                   value="<?php esc_attr_e( 'Save changes', 'stm_motors_car_rental' ); ?>"/>
            <input type="hidden" name="action" value="save_account_details"/>
        </div>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
    </form>

<?php
do_action( 'woocommerce_after_edit_account_form' );