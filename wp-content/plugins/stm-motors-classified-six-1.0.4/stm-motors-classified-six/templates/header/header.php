<?php
$top_bar = stm_me_get_wpcfto_mod( 'top_bar_enable', false );
$logo_main = stm_me_get_wpcfto_img_src( 'logo', STM_MOTORS_C_SIX_URL . '/assets/img/tmp/logo.svg' );


$fixed_header = stm_me_get_wpcfto_mod( 'header_sticky', false );
if ( !empty( $fixed_header ) and $fixed_header ) {
	$fixed_header_class = 'header-listing-fixed';
} else {
	$fixed_header_class = 'header-listing-unfixed';
}

if ( function_exists( 'WC' ) ) {
	$woocommerce_shop_page_id = wc_get_cart_url();
}

$langs = apply_filters( 'wpml_active_languages', null, null );
?>
<div id="header">
	<?php if ( $top_bar ) stm_c_six_load_template( 'header/top-bar' ); ?>

    <div class="header-main header-main-listing-six <?php echo esc_attr( $fixed_header_class ); ?>">
        <div class="container">
            <div class="row header-row">
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <div class="stm-header-left">
                        <div class="logo-main">
							<?php if ( empty( $logo_main ) ): ?>
                                <a class="blogname" href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                   title="<?php _e( 'Home', 'stm_motors_classified_six' ); ?>">
                                    <h1><?php echo esc_attr( get_bloginfo( 'name' ) ) ?></h1>
                                </a>
							<?php else: ?>
                                <a class="bloglogo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo esc_url( $logo_main ); ?>"
                                         style="width: <?php echo stm_me_get_wpcfto_mod( 'logo_width', '138' ); ?>px;"
                                         title="<?php esc_attr_e( 'Home', 'stm_motors_classified_six' ); ?>"
                                         alt="<?php esc_attr_e( 'Logo', 'stm_motors_classified_six' ); ?>"
                                    />
                                </a>
							<?php endif; ?>
                            <div class="mobile-menu-trigger visible-sm visible-xs">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <?php
						$compare_page = \uListing\Classes\StmListingSettings::getPages("compare_page");
						$wishlist_page = \uListing\Classes\StmListingSettings::getPages("wishlist_page");
						$link = stm_c_six_get_page_url('account_page');
                        ?>
                    <div class="mobile-menu-holder">
                        <div class="account-lang-wrap">
							<?php stm_c_six_load_template( 'header/parts/lang-switcher' ); ?>
                        </div>
                        <div class="mobile-menu-wrap">
                            <ul class="header-menu clearfix">
								<?php
								$location = ( has_nav_menu( 'primary' ) ) ? 'primary' : '';

								wp_nav_menu( array( 'theme_location' => $location, 'depth' => 5, 'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => false ) );
								?>
                                <li>
                                    <a href="<?php echo esc_url($link); ?>" class="lOffer-account">
                                        <?php echo esc_html__('Account', 'motors');?>
                                    </a>
                                </li>
                                <li>
                                    <a class="lOffer-compare" href="<?php echo esc_url(get_the_permalink($compare_page)); ?>">
                                        <?php echo esc_html__('Compare', 'motors');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(get_the_permalink($wishlist_page)); ?>"><?php esc_html_e('Wishlist', 'motors'); ?></a>
                                </li>
                                <li>
                                    <a class="add-listing-btn stm-button heading-font" href="<?php echo stm_c_six_get_page_url( 'add_listing' ); ?>">
                                        <?php echo __( 'Add Your Item', 'stm_motors_classified_six' ); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 hidden-sm hidden-xs">
                    <div class="stm-header-right">
                        <div class="main-menu">
                            <ul class="header-menu clearfix">
								<?php
								$location = ( has_nav_menu( 'primary' ) ) ? 'primary' : '';

								wp_nav_menu( array( 'menu' => $location, 'theme_location' => $location, 'depth' => 5, 'container' => false, 'menu_class' => 'header-menu clearfix', 'items_wrap' => '%3$s', 'fallback_cb' => false ) ); ?>
                            </ul>
                        </div>

						<?php stm_c_six_load_template( 'header/parts/compare' ); ?>

						<?php stm_c_six_load_template( 'header/parts/account' ); ?>

                        <div class="stm-c-six-add-btn-wrap">
                            <a class="add-listing-btn stm-button heading-font"
                               href="<?php echo stm_c_six_get_page_url( 'add_listing' ); ?>">
                                <i class="stm-all-icon-listing_car_plus"></i>
								<?php echo __( 'Add Your Item', 'stm_motors_classified_six' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--container-->
    </div> <!--header-main-->
</div>