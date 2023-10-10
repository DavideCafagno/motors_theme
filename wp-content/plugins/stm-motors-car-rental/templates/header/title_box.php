<?php
$post_id = get_the_ID();
if ( is_post_type_archive( stm_listings_post_type() ) ) {
	$post_id = stm_listings_user_defined_filter_page();
}

$show_title_box = (get_post_meta( $post_id, 'title', true ) == 'hide') ? false : true;
$breadcrumbs = (get_post_meta( $post_id, 'breadcrumbs', true ) == 'show') ? true : false;

$is_shop = false;
$is_product = false;
$is_product_category = false;

if ( function_exists( 'is_shop' ) && is_shop() ) {
	$is_shop = true;
}

if ( function_exists( 'is_product_category' ) && is_product_category() ) {
	$is_product_category = true;
}

if ( function_exists( 'is_product' ) && is_product() ) {
	$is_product = true;
}

if ( is_category() ) {
	$post_id = get_option( 'page_for_posts' );
}

if ( $is_shop ) {
	$post_id = get_option( 'woocommerce_shop_page_id' );
}

$title = '';

if ( $is_product ) {
	$title = esc_html__( 'Shop', 'stm_motors_car_rental' );
} elseif ( $is_product_category ) {
	$title = single_cat_title( '', false );
	$post_id = get_option( 'woocommerce_shop_page_id' );
} elseif ( is_category() ) {
	$title = single_cat_title( '', false );
} elseif ( is_tag() ) {
	$title = single_tag_title( '', false );
} else {
	$title = get_the_title( $post_id );
}
?>

<?php if($show_title_box): ?>
    <div class="stm-car-rental-title-box-wrap">
        <div class="container">
            <h1 class="h1">
				<?php echo apply_filters( 'stm_balance_tags', $title ); ?>
            </h1>
			<?php if ( $is_shop || $is_product || $is_product_category || is_checkout() ) : ?>
                <div class="title-box-bottom">
                    <?php if($breadcrumbs):?>
                        <div class="stm-mcr-breadcrumbs-wrap">
                            <?php woocommerce_breadcrumb(); ?>
                        </div>
                    <?php endif; ?>
					<?php do_action( 'woocommerce_before_shop_loop' ); ?>
					<?php if ( is_shop() ) stm_car_rental_load_template( 'header/action-bar/view-type' ); ?>
                </div>
			<?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php if ($breadcrumbs && is_page() && !stm_mcr_is_front_page() && function_exists( 'bcn_display' ) && !is_cart() && !is_product() && !is_checkout() ) { ?>
    <div class="container navxtBreads-wrap">
        <div class="navxtBreads">
			<?php bcn_display(); ?>
        </div>
    </div>
<?php }
