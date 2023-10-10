<div class="stm-mcr-login-register">
    <div class="container">
		<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
        <div class="row" id="customer_login">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<?php endif; ?>

                <form method="post" class="login">
                    <h4><?php _e( 'Login', 'stm_motors_car_rental' ); ?></h4>
                    <h5><?php esc_html_e( 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur.', 'stm_motors_car_rental' ); ?></h5>
					<?php if ( defined( 'WORDPRESS_SOCIAL_LOGIN_ABS_PATH' ) ): ?>
                        <div class="stm-mcr-social-login-wrap">
							<?php do_action( 'wordpress_social_login' ); ?>
                        </div>
                        <div class="separator_or">
                            <span class="line"></span>
                            <span><?php echo esc_html__( 'or', 'stm_motors_car_rental' ); ?></span>
                            <span class="line"></span>
                        </div>
					<?php endif; ?>
					<?php do_action( 'woocommerce_login_form_start' ); ?>
                    <div class="stm-rent-fields-wrap">
                        <div class="form-row form-row-wide">
                            <label class="h4"><?php _e( 'Login', 'stm_motors_car_rental' ); ?></label>
                            <div class="stm-rent-text-wrap">
                                <input type="text" class="input-text" name="username" id="username"
                                       value="<?php if ( !empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>"
                                       placeholder="<?php esc_attr_e( 'Username or email address', 'stm_motors_car_rental' ); ?> *"/>
                            </div>
                        </div>
                        <div class="form-row form-row-wide stm-rent-pass">
                            <label class="h4"><?php _e( 'Password', 'stm_motors_car_rental' ); ?></label>
                            <div class="stm-rent-pass-wrap">
                                <input class="input-text" type="password" name="password" id="password"
                                       placeholder="<?php esc_attr_e( 'Password', 'stm_motors_car_rental' ); ?> *"/>
                            </div>
                        </div>
						<?php do_action( 'woocommerce_login_form' ); ?>
                        <div class="form-row form-row-login form-row-btn-wrap">
							<?php wp_nonce_field( 'woocommerce-login' ); ?>
                            <label for="rememberme" class="inline">
                                <input name="rememberme" type="checkbox" id="rememberme"
                                       value="forever"/> <?php _e( 'Remember me', 'stm_motors_car_rental' ); ?>
                            </label>
                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'stm_motors_car_rental' ); ?></a>
                            <span class="form-btn-wrap">
                                    <input type="submit" class="button" name="login"
                                           value="<?php _e( 'Login', 'stm_motors_car_rental' ); ?>"/>
                                </span>
                        </div>
                        <div class="clear"></div>
                    </div>
					<?php do_action( 'woocommerce_login_form_end' ); ?>
                </form>
				<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <form method="post" class="register">
                    <h4><?php _e( 'Register Now', 'stm_motors_car_rental' ); ?></h4>
                    <h5><?php esc_html_e( 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur.', 'stm_motors_car_rental' ); ?></h5>
					<?php do_action( 'woocommerce_register_form_start' ); ?>
                    <div class="stm-rent-fields-wrap">
						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                            <div class="form-row form-row-wide">
                                <label class="h4"><?php _e( 'Login', 'stm_motors_car_rental' ); ?></label>
                                <div class="stm-rent-text-wrap">
                                    <input type="text" class="input-text" name="username" id="reg_username"
                                           value="<?php if ( !empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>"
                                           placeholder="<?php esc_attr_e( 'Username', 'stm_motors_car_rental' ); ?> *"/>
                                </div>
                            </div>
						<?php endif; ?>
                        <div class="form-row form-row-wide">
                            <label class="h4"><?php _e( 'E-mail Address', 'stm_motors_car_rental' ); ?></label>
                            <div class="stm-rent-text-wrap">
                                <input type="email" class="input-text" name="email" id="reg_email"
                                       value="<?php if ( !empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>"
                                       placeholder="<?php esc_attr_e( 'Email address', 'stm_motors_car_rental' ); ?> *"/>
                            </div>
                        </div>
						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                            <div class="form-row form-row-wide">
                                <label class="h4"><?php _e( 'Password', 'stm_motors_car_rental' ); ?></label>
                                <div class="stm-rent-pass-wrap">
                                    <input type="password" class="input-text" name="password" id="reg_password"
                                           placeholder="<?php esc_attr_e( 'Password', 'stm_motors_car_rental' ); ?> *"/>
                                </div>
                            </div>
						<?php endif; ?>
                        <!-- Spam Trap -->
                        <div style="<?php echo( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;">
                            <label
                                    for="trap"><?php esc_html_e( 'Anti-spam', 'stm_motors_car_rental' ); ?></label><input
                                    type="text"
                                    name="email_2"
                                    id="trap"
                                    tabindex="-1"/>
                        </div>

						<?php do_action( 'woocommerce_register_form' ); ?>
						<?php do_action( 'register_form' ); ?>

                        <div class="form-row form-row-btn-wrap">
							<?php wp_nonce_field( 'woocommerce-register' ); ?>
                            <span class="form-btn-wrap">
					                <input type="submit" class="button" name="register"
                                           value="<?php _e( 'Register', 'stm_motors_car_rental' ); ?>"/>
                                </span>
                        </div>
                    </div>
					<?php do_action( 'woocommerce_register_form_end' ); ?>
                </form>
            </div>
        </div>
	<?php endif; ?>
		<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
    </div>
</div>