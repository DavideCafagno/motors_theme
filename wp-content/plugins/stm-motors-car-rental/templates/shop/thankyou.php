<?php
$order = $__vars['order'];
?>
<div class="col-md-12">
<div class="stm-mcr-thankyou-wrap">

    <?php if ( $order ) : ?>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'stm_motors_car_rental' ); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"
                   class="button pay"><?php _e( 'Pay', 'stm_motors_car_rental' ) ?></a>
                <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
                       class="button pay"><?php _e( 'My Account', 'stm_motors_car_rental' ); ?></a>
                <?php endif; ?>
            </p>

        <?php else : ?>

            <div class="success-block">
                <div class="order-ico">
                    <i class="stm-carent-rental-ico-success"></i>
                </div>
                <div class="order-success-text">
                    <?php echo esc_html__('Your booking was successful!', 'stm_motors_car_rental'); ?>
                </div>
                <div class="order-id">
                    <?php echo esc_html__( 'Reservation Code: ', 'stm_motors_car_rental' ); ?>
                    <span><?php echo esc_html($order->get_order_number())?></span>
                </div>
                <div class="go-to-account">
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php echo esc_html__( 'Go to My Account', 'stm_motors_car_rental' ); ?></a>
                </div>
            </div>
            <h3><?php echo esc_html__( 'Booking information', 'stm_motors_car_rental' ); ?></h3>
            <div class="order-info">
                <?php $stm_order_info = stm_rental_total_order_info_rental_two(); ?>
                <div class="stm-prod-info-wrap">
                    <div class="prod-img">
                        <img src="<?php echo esc_attr( $stm_order_info['vehicle_img'] ); ?>"/>
                    </div>
                    <div class="prod-info">
                        <h4><?php echo esc_html( $stm_order_info['vehicle_name'] ) ?></h4>
                        <div class="prod-attr">
                            <ul>
                                <?php

                                $i = 0;

                                foreach ( $stm_order_info['vehicle_atts'] as $attr ):
                                    if ( $attr['show'] && $i < 2 ) :
                                        ?>
                                        <li>
                                            <?php if ( $attr['img'] ) : ?>
                                                <img src="<?php echo esc_url( $attr['img'] ); ?>"/>
                                            <?php endif; ?>
                                            <div class="attr-title">
                                                <?php echo apply_filters( 'the_content', $attr['value'] ); ?>
                                            </div>
                                        </li>
                                        <?php
                                        $i++;
                                    else:
                                        break;
                                    endif;
                                endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="order-rent-info">
                    <div class="pickup-data">
                        <div class="pickup-ico">
                            <i class="stm-carent-rental-ico-car-get"></i>
                        </div>
                        <div class="pickup-info">
                            <span class="pickup-date"><?php echo (!empty($stm_order_info['pickup_date']) && $stm_order_info['pickup_date'] != '--') ? $stm_order_info['pickup_date'] : ''; ?></span>
                            <span class="pickup-office"><?php echo $stm_order_info['pickup_location'] ?></span>
                        </div>
                    </div>
                    <div class="drop-data">
                        <div class="drop-ico">
                            <i class="stm-carent-rental-ico-car-drop"></i>
                        </div>
                        <div class="drop-info">
                            <span class="drop-date"><?php echo (!empty($stm_order_info['dropoff_date']) && $stm_order_info['dropoff_date'] != '--') ? $stm_order_info['dropoff_date'] : ''; ?></span>
                            <span class="drop-office"><?php echo $stm_order_info['dropoff'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="woocommerce-order-overview__total total">
                    <div><?php echo stm_do_lmth( $order->get_formatted_order_total() ); ?></div>
                </div>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'stm_motors_car_rental' ), null ); ?></p>
    <?php endif; ?>
</div>
</div>


