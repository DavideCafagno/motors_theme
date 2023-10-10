<?php
$orderInfo = stm_get_rental_order_fields_values();

$title = (isset($__vars['title'])) ? $__vars['title'] : esc_html__( 'Booking Information', 'stm_motors_car_rental' );

$dFormat = get_option( 'date_format' );
$tFormat = 'H:i';

$dateTimeFormat = $dFormat . " " . $tFormat;

$prodUrl = '';
$class = 'show-booking-form';
if(is_checkout()) {
    $cart_items = stm_get_cart_items();
    $car_rent = $cart_items['car_class'];
    $id = $car_rent['id'];

    $prodUrl = get_the_permalink($id);
    $class = '';
}

$ordInfo = '';
$ordForm = '';

if(!stm_mcr_check_valid_rent_info() ) {
	$ordInfo = 'hide';
	$ordForm = 'show';
}

//if(!empty($orderInfo['pickup_location_id'])) :
?>
    <div class="stm-mcr-booking-info-wrap">
        <div class="title-wrap">
            <h4><?php echo $title; ?></h4>
            <a href="<?php echo (is_checkout() || is_cart()) ? esc_url($prodUrl) : '#'; ?>" class="<?php echo esc_attr($class); ?>">
                <i class="stm-carent-rental-ico-edit"></i>
            </a>
        </div>
        <div class="rent-info <?php echo esc_attr($ordInfo); ?>">
            <div class="pickup-data">
                <div class="pickup-ico">
                    <i class="stm-carent-rental-ico-car-get"></i>
                </div>
                <div class="pickup-info">
                    <span class="pickup-date"><?php echo (!empty($orderInfo['pickup_date']) && $orderInfo['pickup_date'] != '--') ? $orderInfo['pickup_date'] : ''; ?></span>
                    <span class="pickup-office"><?php echo $orderInfo['pickup_location'] ?></span>
                </div>
            </div>
            <div class="drop-data">
                <div class="drop-ico">
                    <i class="stm-carent-rental-ico-car-drop"></i>
                </div>
                <div class="drop-info">
                    <span class="drop-date"><?php echo (!empty($orderInfo['return_date']) && $orderInfo['return_date'] != '--') ? $orderInfo['return_date'] : ''; ?></span>
                    <span class="drop-office"><?php echo $orderInfo['return_location'] ?></span>
                </div>
            </div>
        </div>
        <div class="rent-form <?php echo esc_attr($ordForm); ?>">
            <?php stm_car_rental_load_template( 'parts/booking-form', array( 'title' => '', 'workHr' => '', 'css' => '' ) ); ?>
        </div>
    </div>
<?php //endif; ?>