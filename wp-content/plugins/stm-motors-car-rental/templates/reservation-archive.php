<?php get_header(); ?>
<?php
$shop_sidebar_id = stm_me_get_wpcfto_mod('shop_sidebar', 768);
$shop_sidebar_position = stm_me_get_wpcfto_mod('shop_sidebar_position', 'left');

if (!empty($shop_sidebar_id)) {
    $shop_sidebar = get_post($shop_sidebar_id);
}
$stm_sidebar_layout_mode = stm_sidebar_layout_mode($shop_sidebar_position, $shop_sidebar_id);
?>

<?php
if(!is_order_received_page() && !is_cart() && !is_checkout() && !is_page()) {
    stm_car_rental_load_template( 'header/title_box' );
}
?>
    <div class="stm-reservation-archive">
        <div class="container">
            <div class="row <?php if(is_checkout()) echo esc_attr('is_checkout_wrap'); ?>">
                <?php
                if(is_shop()) {
                    echo stm_do_lmth($stm_sidebar_layout_mode['content_before']);

                    stm_car_rental_load_template('shop/main-shop');

                    echo stm_do_lmth($stm_sidebar_layout_mode['content_after']);

                    if (isset($shop_sidebar) && !empty($shop_sidebar_id)) {
                        echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_before']);
                        do_action('stm_mcr_booking_info'); ?>
                        <div class="stm-shop-sidebar-area">
                            <?php echo apply_filters('the_content', $shop_sidebar->post_content); ?>
                        </div>
                        <?php echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_after']);
                    }
                } elseif(is_product()) {
                    stm_car_rental_load_template('shop/product-content');
                } elseif(is_cart()) {
            		stm_car_rental_load_template('shop/cart');
                } elseif(is_checkout()) {
                    stm_car_rental_load_template('shop/checkout');
                } elseif (is_product_category() || is_product_tag() || is_product_taxonomy()) {
					echo stm_do_lmth($stm_sidebar_layout_mode['content_before']);

					stm_car_rental_load_template('shop/main-shop');

					echo stm_do_lmth($stm_sidebar_layout_mode['content_after']);

					if (isset($shop_sidebar) && !empty($shop_sidebar_id)) {
						echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_before']);
						do_action('stm_mcr_booking_info'); ?>
                        <div class="stm-shop-sidebar-area">
							<?php echo apply_filters('the_content', $shop_sidebar->post_content); ?>
                        </div>
						<?php echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_after']);
					}
				} else {
                    if(have_posts()) {
                        echo stm_do_lmth($stm_sidebar_layout_mode['content_before']);

                        woocommerce_content();

                        echo stm_do_lmth($stm_sidebar_layout_mode['content_after']);

                        if (isset($shop_sidebar) && !empty($shop_sidebar_id)) {
                            echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_before']);
                            do_action('stm_mcr_booking_info'); ?>
                            <div class="stm-shop-sidebar-area">
                                <?php echo apply_filters('the_content', $shop_sidebar->post_content); ?>
                            </div>
                            <?php echo stm_do_lmth($stm_sidebar_layout_mode['sidebar_after']);
                        }
                    }
                }

                ?>
            </div> <!--row-->
        </div> <!--container-->
    </div>
<?php get_footer(); ?>