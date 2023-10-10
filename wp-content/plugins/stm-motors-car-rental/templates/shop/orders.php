<?php
$customer_orders = $__vars['customer_orders'];
$has_orders = $__vars['has_orders'];
$current_page = $__vars['current_page'];

do_action( 'woocommerce_before_account_orders', $has_orders );

if ( $has_orders ) : ?>

    <div class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
        <div class="order-table-titles">
            <div class="woocommerce-orders-table__header"><?php echo esc_html__( 'Vehicle Information', 'stm_motors_car_rental' ); ?></div>
            <div class="woocommerce-orders-table__header"><?php echo esc_html__( 'Rental Information', 'stm_motors_car_rental' ); ?></div>
            <div class="woocommerce-orders-table__header"><?php echo esc_html__( 'Total Price', 'stm_motors_car_rental' ); ?></div>
        </div>

        <div class="order-items-block">
		<?php foreach ( $customer_orders->orders as $customer_order ) :
			$order = wc_get_order( $customer_order );
			$item_count = $order->get_item_count();
			$orderUrl = '';
			$actions = wc_get_account_orders_actions( $order );

			if ( !empty( $actions ) ) {
				foreach ( $actions as $key => $action ) {
					if ( $key == 'view' ) $orderUrl = $action['url'];
				}
			}

			$productData = array();
			$optionsData = array();

            if(!empty($order->get_items())) {
                foreach ( $order->get_items() as $item ) {
                    $prodType = stm_wc_get_product_type( $item['product_id'] );

                    if ( $prodType != 'car_option' ) {
                        $productData = $item->get_data();
                    } else {
                        $optionsData[] = $item->get_data();
                    }
                }
            }

			$orderMeta = get_post_meta( $order->get_order_number(), 'order_car_date' );
			?>
            <?php $stm_order_info = stm_rental_order_item_info_by_id_rental_two( $order->get_order_number(), (!empty($productData['product_id'])) ? $productData['product_id'] : null ); ?>
            <div class="order-item">
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
                            <span class="pickup-date"><?php echo ( !empty( $stm_order_info['pickup_date'] ) && $stm_order_info['pickup_date'] != '--' ) ? $stm_order_info['pickup_date'] : ''; ?></span>
                            <span class="pickup-office"><?php echo $stm_order_info['pickup_location'] ?></span>
                        </div>
                    </div>
                    <div class="drop-data">
                        <div class="drop-ico">
                            <i class="stm-carent-rental-ico-car-drop"></i>
                        </div>
                        <div class="drop-info">
                            <span class="drop-date"><?php echo ( !empty( $stm_order_info['dropoff_date'] ) && $stm_order_info['dropoff_date'] != '--' ) ? $stm_order_info['dropoff_date'] : ''; ?></span>
                            <span class="drop-office"><?php echo $stm_order_info['dropoff'] ?></span>
                        </div>
                    </div>
                    <?php if ( count( $optionsData ) > 0 ): ?>
                        <div class="options-wrap">
                            <div class="opt-title">
                                <?php echo esc_html__( 'Extra Options: ' ); ?>
                            </div>
                            <ul>
                                <?php

                                foreach ( $optionsData as $opt ):
                                    echo '<li>' . esc_html( $opt['name'] ) . '<span class="plus">+</span></li>';
                                endforeach;
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="total-status-wrap">
                    <div class="woocommerce-order-overview__total total">
                        <div class="total-days"><?php echo sprintf(esc_html__('Total %d Days', 'stm_motors_car_rental'), $stm_order_info['order_days'] ); ?></div>
                        <div><?php echo stm_do_lmth( $order->get_formatted_order_total() ); ?></div>
                        <?php if ( count( $optionsData ) > 0 ): ?>
                            <div class="option-inc"><?php echo esc_html__( '(Extra Options Included)', 'stm_motors_car_rental' ); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="status-wrap">
                        <div class="order-id"><a
                                    href="<?php echo esc_url( $orderUrl ); ?>"><?php echo esc_html( $order->get_order_number() ); ?></a>
                        </div>
                        <div class="order-status"><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></div>
                    </div>
                </div>
            </div>
		<?php endforeach; ?>
        </div>
    </div>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
        <div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
                <a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button"
                   href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php _e( 'Previous', 'stm_motors_car_rental' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
                <a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button"
                   href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php _e( 'Next', 'stm_motors_car_rental' ); ?></a>
			<?php endif; ?>
        </div>
	<?php endif; ?>

<?php else : ?>
    <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
        <a class="woocommerce-Button button"
           href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go shop', 'stm_motors_car_rental' ) ?>
        </a>
		<?php _e( 'No order has been made yet.', 'stm_motors_car_rental' ); ?>
    </div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>