<?php
$logo_url = stm_me_get_wpcfto_img_src( 'logo', STM_MOTORS_CAR_RENTAL_URL);

if ( function_exists( 'WC' ) ) {
    $woocommerce_shop_page_id = wc_get_cart_url();
}

$langs = apply_filters( 'wpml_active_languages', null, null );
$rentalHomePage = '';
if(stm_mcr_is_front_page()) {
    $home_logo = get_post_meta(get_the_ID(), 'home_page_logo', true);
    $logo_url = (!empty($home_logo)) ? wp_get_attachment_image_url($home_logo, 'full') : $logo_url;
	$rentalHomePage = get_post_meta(get_the_ID(), 'stm_select_home_page', true);
}
?>

<div class="header-main <?php echo (wp_is_mobile()) ? 'header-main-mobile' : ''; ?>">
    <div class="container">
        <div class="row header-row">
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="stm-header-left">
                    <div class="logo-main">
                        <?php if ( stm_img_exists_by_url($logo_url) ): ?>
                            <a class="bloglogo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo esc_url( $logo_url ); ?>"
                                     style="width: <?php echo stm_me_get_wpcfto_mod( 'logo_width', '138' ); ?>px;"
                                     title="<?php esc_html_e( 'Home', 'stm_motors_car_rental' ); ?>"
                                     alt="<?php esc_html_e( 'Logo', 'stm_motors_car_rental' ); ?>"
                                />
                            </a>
                        <?php else: ?>
                            <a class="blogname" href="<?php echo esc_url( home_url( '/' ) ); ?>"
                               title="<?php _e( 'Home', 'stm_motors_car_rental' ); ?>">
                                <h1><?php echo esc_html( get_bloginfo( 'name' ) ) ?></h1>
                            </a>
                        <?php endif; ?>
                        <div class="mobile-menu-trigger visible-sm visible-xs">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="mobile-menu-holder">
                    <div class="account-lang-wrap">
						<?php stm_car_rental_load_template('header/parts/account'); ?>
						<?php stm_car_rental_load_template('header/parts/lang-switcher'); ?>
                        <div class="mobile-menu-trigger visible-sm visible-xs">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="mobile-menu-wrap">
                        <ul class="header-menu clearfix">
                            <?php
                            $location = ( has_nav_menu( 'primary' ) ) ? 'primary' : '';

                            wp_nav_menu( array(
                                    'theme_location' => $location,
                                    'depth' => 5,
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                    'fallback_cb' => false
                                )
                            );
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="stm-header-right">
                    <?php if(empty($rentalHomePage) || $rentalHomePage == 'home_page_1') : ?>
                    <div class="main-menu">
                        <ul class="header-menu clearfix">
                            <?php
                            $location = ( has_nav_menu( 'primary' ) ) ? 'primary' : '';

                            wp_nav_menu( array(
                                'menu' => $location,
                                'theme_location' => $location,
                                'depth' => 5,
                                'container' => false,
                                'menu_class' => 'header-menu clearfix',
                                'items_wrap' => '%3$s',
                                'fallback_cb' => false
                            ) ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php stm_car_rental_load_template('header/parts/account'); ?>
                    <?php stm_car_rental_load_template('header/parts/lang-switcher'); ?>
                </div>
            </div>
        </div>
    </div> <!--container-->
</div> <!--header-main-->
<?php
if(is_page() && !stm_mcr_is_front_page() && !is_account_page()) {
	stm_car_rental_load_template( 'header/title_box' );
}
?>
<?php if($rentalHomePage == 'home_page_2') : ?>
    <div class="home-page-2-main-menu main-menu mobile-hide">
        <div class="container">
            <ul class="header-menu clearfix">
                <?php
                $location = ( has_nav_menu( 'primary' ) ) ? 'primary' : '';

                wp_nav_menu( array(
                    'menu' => $location,
                    'theme_location' => $location,
                    'depth' => 5,
                    'container' => false,
                    'menu_class' => 'header-menu clearfix',
                    'items_wrap' => '%3$s',
                    'fallback_cb' => false
                ) ); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
