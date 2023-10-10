<?php
$cart_items = stm_get_cart_items();
?>
<div id="rent_notice">
	<?php wc_print_notices(); ?>
</div>

<?php if ( is_cart() && empty( $cart_items['has_car'] ) ): ?>
    <div class="col-md-12 empty-cart-wrap">
        <div class="container">
            <h2><?php echo esc_html__( 'Cart is Empty', 'stm_motors_car_rental' ); ?></h2>
            <a href="<?php echo esc_url( stm_woo_shop_page_url() ); ?>"
               class="btn mcr-btn"><?php echo esc_html__( 'Rent Car', 'stm_motors_car_rental' ); ?></a>
        </div>
    </div>
<?php else: ?>
	<?php $wp_query = new WP_Query( array( 'post_type' => 'product', 'p' => $cart_items['car_class']['id'], 'post_status' => 'publish' ) ); ?>
    <div class="col-md-9">
		<?php
		if ( $wp_query->have_posts() ) {
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();
				stm_car_rental_load_template( 'shop/loop/cart-list' );
			endwhile;
		}
		?>
    </div>
    <div class="col-md-3 product-cart-info stm_custom_rental_checkout">
		<?php
		stm_car_rental_load_template( 'shop/parts/booking-info', array( 'title' => esc_html__( 'Rental Location and Date-time', 'stm_motors_car_rental' ) ) );
		stm_car_rental_load_template( 'shop/parts/cart-info', array( 'hide_edit' => true ) );
		?>
    </div>
<?php endif; ?>

<?php
wp_reset_postdata();
$remove_params = array( 'add-to-cart', 'product_id', 'variation_id', 'quantity', 'remove-from-cart' );
?>
<script>
    jQuery(document).ready(function () {
        window.history.pushState('', '', '<?php echo esc_url( remove_query_arg( $remove_params ) ) ?>');
    });
</script>