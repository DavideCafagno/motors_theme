<?php
use uListing\Classes\StmUser;
if(is_user_logged_in()):

?>
	<?php
		$user = wp_get_current_user();

		if(!is_wp_error($user)):

        $link = stm_c_six_get_page_url('account_page');

		$my_offers = 0;
        $my_fav = 0;

        $userObj = new StmUser($user);

        $wishlist_page = \uListing\Classes\StmListingSettings::getPages("wishlist_page");
	?>

	<div class="lOffer-account-dropdown login">
		<a href="<?php echo esc_url($link . 'edit-profile/'); ?>" class="settings">
			<i class="stm-all-icon-cog"></i>
		</a>
		<div class="name">
			<a href="<?php echo esc_url($link); ?>"><?php echo esc_attr(stm_c_six_display_user_name($user->ID)); ?></a>
		</div>
		<ul class="account-list">
			<li><a href="<?php echo esc_url(\uListing\Classes\StmUser::getUrl('my-listing')); ?>"><?php esc_html_e('My items', 'motors'); ?> (<span><?php echo esc_attr($userObj->getListings(true)); ?></span>)</a></li>
			<li class="stm-my-favourites"><a href="<?php echo esc_url(get_the_permalink($wishlist_page)); ?>"><?php esc_html_e('Wishlist', 'motors'); ?> (<span><?php echo \uListing\UlistingWishlist\Classes\UlistingWishlist::get_total_count()?></span>)</a></li>
		</ul>
		<a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="logout">
			<i class="fas fa-power-off"></i><?php esc_html_e('Logout', 'motors'); ?>
		</a>
	</div>

	<?php endif; ?>

<?php else : ?>
<?php wp_enqueue_script('stm-c-six-login', STM_MOTORS_C_SIX_URL . '/assets/js/c-six-login.js', array('vue'), '1.0', true); ?>
	<div class="lOffer-account-dropdown stm-login-form-unregistered">
        <div id="stm-c-six-listing-login">
            <div class="form-group" data-v-bind_class="{error: errors['login']}">
                <h4> <?php echo esc_html__('Login Or E-mail', "ulisting"); ?></h4>
                <input type="text"
                       data-v-on_keyup.enter="logIn"
                       data-v-model="login"
                       class="form-control"
                       placeholder="<?php esc_html_e('Enter login', "ulisting"); ?>"/>
                <span data-v-if="errors['login']" style="color: red">{{errors['login']}}</span>
            </div>

            <div class="form-group" data-v-bind_class="{error: errors['password']}">
                <h4> <?php echo esc_html__('Password', "ulisting"); ?></h4>
                <input type="password"
                       data-v-on_keyup.enter="logIn"
                       data-v-model="password"
                       class="form-control"
                       placeholder="<?php esc_html_e('Enter password', "ulisting"); ?>"/>
                <span data-v-if="errors['password']" style="color: red">{{errors['password']}}</span>
            </div>

            <div class="form-group">
                <div class="stm-row">
                    <div class="stm-col">
                        <label>
                            <input type="checkbox" value="1" data-v-bind_true-value="1" data-v-bind_false-value="0"
                                   data-v-model="remember"> <?php esc_html_e('Remember me', "ulisting") ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button data-v-on_click="logInCF" type="button"
                        class="btn btn-primary w-full"><?php echo esc_html__('Login', "ulisting"); ?></button>
            </div>
            <div data-v-if="loading">Loading...</div>
            <div data-v-if="message" data-v-bind_class="status">{{message}}</div>
        </div>
	</div>
<?php endif; ?>