<?php if(is_order_received_page()) : ?>
<?php echo do_shortcode('[woocommerce_checkout]');?>
<?php else : ?>

<div class="col-md-9">
    <?php echo do_shortcode('[woocommerce_checkout]');?>
</div>
</div>
<div class="col-md-3">
    <div class="stm_custom_rental_checkout">
        <?php
        stm_car_rental_load_template( 'shop/parts/product-info' );
        stm_car_rental_load_template( 'shop/parts/booking-info', array( 'title' => esc_html__( 'Rental Location and Date-time', 'stm_motors_car_rental' ) ) );
        stm_car_rental_load_template( 'shop/parts/cart-info' );
        ?>
    </div>
</div>

<script>
    (function ($) {

        $(window).load(function () {
            var fields = '.stm_woocommerce_checkout_billing .form-row input, ' +
                '.stm_woocommerce_checkout_billing .form-row select';

            $(fields).each(function () {
                if ($(this).val() == '') {
                    $(this).closest('.form-row').removeClass('woocommerce-validated');
                }
            });

            $(document).on('focusout', fields, function () {
                if ($(this).val() == '') {
                    $(this).closest('.form-row').removeClass('woocommerce-validated');
                }
            })
        });

    })(jQuery)
</script>

<?php endif; ?>