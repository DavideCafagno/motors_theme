<?php
$bgColor = stm_me_get_wpcfto_mod('top_bar_bg_color', '');
$top_bar_address = stm_me_get_wpcfto_mod('top_bar_address', '');
$header_address_url = stm_me_get_wpcfto_mod('header_address_url', '');
?>

<div class="top-bar-wrap">
	<div class="container">
		<div class="stm-c-six-top-bar">
			<?php stm_c_six_load_template('header/parts/lang-switcher'); ?>
            <?php if(!empty($top_bar_address)) : ?>
                <div class="stm-top-address-wrap">
                    <span id="top-bar-address" class="<?php if( !empty($header_address_url) ) echo 'fancy-iframe'; ?>" data-iframe="true" data-src="<?php echo esc_url($header_address_url); ?>">
                        <i class="fas fa-map-marker"></i> <?php stm_dynamic_string_translation_e('Top Bar Address', $top_bar_address ); ?>
                    </span>
                </div>
            <?php endif; ?>
            <div class="pull-right">
                <?php stm_c_six_load_template('header/parts/socials'); ?>
                <?php if(!is_user_logged_in()) stm_c_six_load_template('header/parts/login-reg-links'); ?>
            </div>
		</div>
	</div>
</div>