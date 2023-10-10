<div class="stm-account-wrap">
    <div class="header-login-url">
        <?php if ( is_user_logged_in() ): ?>
            <div class="stm-rent-lOffer-account-unit-main">
                <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"
                   class="stm-rent-lOffer-account-main">
                    <i class="stm-carent-rental-ico-profile"></i>
                    <span><?php echo esc_html__('My Account', 'stm_motors_car_rental'); ?></span>
                </a>
            </div>
        <?php else: ?>
            <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                <i class="stm-carent-rental-ico-profile"></i><span
                    class="vt-top"><?php _e( 'Login', 'stm_motors_car_rental' ); ?></span>
            </a>
            <span class="or"><?php esc_html_e('or', 'stm_motors_car_rental'); ?></span>
            <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php _e( 'Register', 'stm_motors_car_rental' ); ?></a>
        <?php endif; ?>
    </div>
</div>