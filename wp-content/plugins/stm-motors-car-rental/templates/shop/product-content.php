<?php
$cart_items = stm_get_cart_items();
?>
<div id="rent_notice">
    <?php wc_print_notices(); ?>
</div>

<div class="col-md-9">
    <?php stm_car_rental_load_template('shop/loop/list'); ?>
</div>
<div class="col-md-3 product-cart-info stm_custom_rental_checkout">
    <?php
    stm_car_rental_load_template( 'shop/parts/booking-info', array( 'title' => esc_html__( 'Rental Location and Date-time', 'stm_motors_car_rental' ) ) );
    if(!empty($cart_items['has_car'])) stm_car_rental_load_template( 'shop/parts/cart-info', array('hide_edit' => true) );
    ?>
</div>

<?php
$remove_params = array( 'add-to-cart', 'product_id', 'variation_id', 'quantity', 'remove-from-cart' );
?>
<script>
    jQuery(document).ready(function () {
        window.history.pushState('', '', '<?php echo esc_url( remove_query_arg( $remove_params ) ) ?>');
    });
</script>