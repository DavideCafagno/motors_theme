<?php
use uListing\Classes\StmUser;


$link = stm_c_six_get_page_url('account_page');
?>

<div class="profile-wrap">
    <div class="lOffer-account-unit">
        <a href="<?php echo esc_url($link); ?>" class="lOffer-account">
            <?php
            if(is_user_logged_in()) {
				$user = wp_get_current_user();
				$user = new StmUser($user);
                $user_fields = stm_get_user_custom_fields('');
                if(!empty($user->getAvatarUrl())):
                    ?>
                    <div class="stm-dropdown-user-small-avatar">
                        <img src="<?php echo esc_url($user->getAvatarUrl()); ?>" class="im-responsive"/>
                    </div>
                <?php else: ?>
                    <i class="stm-service-icon-user"></i>
                <?php endif; ?>
            <?php } else { ?>
                <i class="stm-service-icon-user"></i>
            <?php } ?>
        </a>
        <?php stm_c_six_load_template('header/parts/account-dropdown') ; ?>
    </div>
</div>

