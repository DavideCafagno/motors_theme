<?php
// phpcs:disable
add_filter( 'stm_hide_old_headers', 'stm_cr_theme_hide_old_headers' );
add_filter( 'admin_body_class', 'stm_rent_add_admin_body_class' );
add_filter( 'body_class', 'stm_mcr_body_class' );
add_filter( 'stm_is_rental_two', 'stm_motors_car_rental_active' );
add_filter( 'wc_get_template_part', 'stm_cr_wc_get_template_part', 100, 3 );
add_filter( 'wc_price', 'stm_cr_wc_price', 100, 4 );
add_filter( 'woocommerce_product_review_list_args', 'stm_cr_woocommerce_product_review_list_args', 100, 3 );
add_filter( 'woocommerce_layered_nav_term_html', 'stm_cr_woocommerce_layered_nav_term_html', 100, 4 );

add_action( 'stm_mcr_booking_info', 'stm_mcr_booking_info_html' );
add_action( 'after_setup_theme', 'stm_motors_car_rental_setup' );
add_action( 'stm_motors_header', 'stm_cr_include_header' );
add_action( 'stm_mcr_reservation_archive', 'stm_mcr_reservation_archive' );
add_action( 'wp_head', 'stm_mcr_global_vars' );
add_action( 'smt_mcr_thankyou', 'smt_mcr_thankyou_page' );
add_action( 'smt_mcr_login_register', 'smt_mcr_login_register_page' );
add_action( 'smt_mcr_lost_password', 'smt_mcr_lost_password_page' );
add_action( 'smt_mcr_reset_password', 'smt_mcr_reset_password_page' );
add_action( 'smt_mcr_lost_password_success', 'smt_mcr_lost_password_success_page' );
add_action( 'smt_mcr_account_dashboard', 'smt_mcr_account_dashboard_page' );
add_action( 'smt_mcr_account_orders', 'smt_mcr_account_orders_page' );
add_action( 'smt_mcr_account_orders_list', 'smt_mcr_account_orders_list_template', 10, 3 );
add_action( 'smt_mcr_account_downloads', 'smt_mcr_account_downloads_page' );
add_action( 'smt_mcr_account_addresses', 'smt_mcr_account_addresses_page' );
add_action( 'smt_mcr_account_details', 'smt_mcr_account_details_page' );
add_action( 'smt_mcr_account_navigation', 'smt_mcr_account_navigation_template' );
add_action( 'smt_mcr_account_form_edit_template', 'smt_mcr_account_form_edit_template' );
add_action( 'template_redirect', 'stm_mcr_options_add_to_cart' );

function stm_motors_car_rental_setup()
{
    add_image_size( 'stm-mcr-487-274', 487, 274, true );
    add_image_size( 'stm-mcr-974-548', 974, 548, true );
    add_image_size( 'stm-mcr-236-133', 236, 133, true );
    add_image_size( 'stm-mcr-472-266', 472, 266, true );
}

if ( !function_exists( 'stm_motors_car_rental_active' ) ) {
    function stm_motors_car_rental_active()
    {
        return true;
    }
}

if ( !function_exists( 'stm_rent_add_admin_body_class' ) ) {
    function stm_rent_add_admin_body_class( $classes )
    {
        $layout = get_option( 'stm_motors_chosen_template' );

        return ( empty( $layout ) ) ? $classes : "$classes stm-template-" . $layout;
    }
}

if( !function_exists( 'stm_mcr_body_class' )) {
    function stm_mcr_body_class ($classes) {

		$rentalHomePage = get_post_meta(get_the_ID(), 'stm_select_home_page', true);

        if (!empty($rentalHomePage) && stm_mcr_is_front_page()) {
            $classes[] = $rentalHomePage;
        }

        return $classes;
    }
}

if ( !function_exists( 'stm_cr_theme_hide_old_headers' ) ) {
    function stm_cr_theme_hide_old_headers()
    {
        return true;
    }
}

if ( !function_exists( 'stm_cr_include_header' ) ) {
    function stm_cr_include_header()
    {
        if ( !is_404() and !is_page_template( 'coming-soon.php' ) ) {
            stm_car_rental_load_template( 'header/header' );
        } elseif ( is_page_template( 'coming-soon.php' ) ) {
            stm_car_rental_load_template( 'header/header-coming', 'soon' );
        } else {
            stm_car_rental_load_template( 'header/header', '404' );
        }

        echo '<div id="main">';
    }
}

if ( !function_exists( 'stm_mcr_reservation_archive' ) ) {
    function stm_mcr_reservation_archive()
    {
        stm_car_rental_load_template( 'reservation-archive' );
    }
}

if ( !function_exists( 'stm_cr_wc_get_template_part' ) ) {
    function stm_cr_wc_get_template_part( $template, $slug, $name )
    {
        stm_car_rental_load_template( 'shop/tabs/wc-comments' );
    }
}

if ( !function_exists( 'stm_cr_woocommerce_product_review_list_args' ) ) {
    function stm_cr_woocommerce_product_review_list_args( $comment, $args, $depth )
    {
        stm_car_rental_load_template( 'shop/loop/wc-review-item', array( 'comment' => $comment, 'args' => $args, 'depth' => $depth ) );
    }
}

if ( !function_exists( 'stm_cr_woocommerce_layered_nav_term_html' ) ) {
    function stm_cr_woocommerce_layered_nav_term_html( $term_html, $term, $link, $count )
    {
        $imgClass = 'has-checkbox';

        $html = '<a href="' . $link . '" class="term-link ' . $imgClass . '">';
        $html .= '<span class="term-name">';
        $html .= $term->name;
        if ( !empty( $term->count ) ) {
            $html .= '<span class="term-count">(' . $term->count . ')</span>';
        }
        $html .= '</span>';
        $html .= '</a>';

        echo apply_filters( 'stm_wcmap_fc_html_filter', $html );
    }
}

if ( !function_exists( 'stm_cr_wc_price' ) ) {
    function stm_cr_wc_price( $return, $price, $args, $unformatted_price )
    {

        $separator = $args['decimal_separator'];
        $currency = get_woocommerce_currency_symbol( $args['currency'] );
		$currency_pos = get_option( 'woocommerce_currency_pos', 'left' );
        $price_explode = explode( $separator, $price );

        $priceLeft = $price_explode[0];
        $priceRight = ( !empty( $price_explode[1] ) ) ? $separator . $price_explode[1] : '';

        $spacer = ($currency_pos == "left_space" || $currency_pos == "right_space") ? "&nbsp;" : "";

        $return = '<div class="stm-mcr-price-view">';
		if($currency_pos == 'left' || $currency_pos == "left_space") $return .= '<span class="currency">' . $currency . $spacer . '</span>';
        $return .= '<span class="price-big">' . $priceLeft . '</span>';
        $return .= ( !empty( $priceRight ) ) ? '<span class="price-small">' . $priceRight . '</span>' : '';
		if($currency_pos == 'right' || $currency_pos == "right_space") $return .= '<span class="currency">' . $spacer . $currency . '</span>';
        $return .= '</div>';

        return $return;
    }
}

if ( !function_exists( 'stm_mcr_booking_info_html' ) ) {
    function stm_mcr_booking_info_html()
    {
        stm_car_rental_load_template( 'shop/parts/booking-info' );
    }
}

if ( !function_exists( 'stm_mcr_global_vars' ) ) {
    function stm_mcr_global_vars()
    {
		remove_action( 'register_form', 'wsl_render_auth_widget_in_wp_register_form' );
        remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review');
        $my_locale = explode( '_', get_locale() );

        ?>
        <script type="text/javascript">
            var stm_mcr_lang_code = '<?php echo esc_html( $my_locale[0] ); ?>';
            <?php if (class_exists( 'SitePress' )): ?>
            stm_lang_code = '<?php echo ICL_LANGUAGE_CODE; ?>';
            <?php endif; ?>
            var mcr_ajaxurl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
            var stm_mcr_site_blog_id = "<?php echo get_current_blog_id(); ?>";
            var pickupHolder = '<?php echo esc_html__( 'Pickup Date', 'stm_motors_car_rental' ); ?>';
            var returnHolder = '<?php echo esc_html__( 'Return Date', 'stm_motors_car_rental' ); ?>';
            var selectDTHolder = '<?php echo esc_html__( 'Select Date-Time', 'stm_motors_car_rental' ); ?>';
            var pickupTime = '<?php echo esc_html__( 'Pick-Up Time', 'stm_motors_car_rental' ); ?>';
            var returnTime = '<?php echo esc_html__( 'Return Time', 'stm_motors_car_rental' ); ?>';

            var decimalSep = '<?php echo esc_js(get_option('woocommerce_price_decimal_sep')); ?>';
            var decimalNum = '<?php echo esc_js(get_option('woocommerce_price_num_decimals')); ?>';
        </script>
        <?php
    }
}

function stm_mcr_options_add_to_cart()
{
    if(function_exists('stm_get_rental_order_fields_values')) {
		$fields = stm_get_rental_order_fields_values();

		if ( ( is_checkout() || is_cart() ) && empty( $fields['ceil_days'] ) && empty($fields['order_hours']) ) {
			$rental_datepick = stm_me_get_wpcfto_mod( 'rental_datepick', false );
			wp_safe_redirect( get_permalink( $rental_datepick ) );
		}

		$cart = WC()->cart->get_cart();

		if ( !empty( $_GET['option_data'] ) ) {
			$opt = explode( ',', $_GET['option_data'] );

			if ( sizeof( $cart ) > 0 ) {

				foreach ( $cart as $cart_item_id => $cart_item ) {
					if ( $cart_item['data']->get_type() == 'car_option' ) {
						WC()->cart->remove_cart_item( $cart_item_id );
					}
				}

				if ( ! empty( $opt ) ) {
					foreach ( $opt as $val ) {
						$parsed_value = explode( '-', $val );

						if ( ! empty( $parsed_value[0] ) && ! empty( $parsed_value[1] ) && 0 < intval( $parsed_value[1] ) ) {
							$product_id = intval( $parsed_value[0] );
							$quantity   = intval( $parsed_value[1] );
							WC()->cart->add_to_cart( $product_id, $quantity );
						}
					}
				}
			}
		}
	}
}

if(!function_exists('smt_mcr_thankyou_page')) {
    function smt_mcr_thankyou_page ($order) {
        stm_car_rental_load_template('shop/thankyou', array('order' => $order));
    }
}

if(!function_exists('smt_mcr_login_register_page')) {
    function smt_mcr_login_register_page () {
        stm_car_rental_load_template('shop/login-register');
    }
}

if(!function_exists('smt_mcr_lost_password_page')) {
    function smt_mcr_lost_password_page () {
        stm_car_rental_load_template('shop/lost-password');
    }
}

if(!function_exists('smt_mcr_reset_password_page')) {
    function smt_mcr_reset_password_page () {
        stm_car_rental_load_template('shop/reset-password');
    }
}

if(!function_exists('smt_mcr_lost_password_success_page')) {
    function smt_mcr_lost_password_success_page () {
        stm_car_rental_load_template('shop/lost-pass-success');
    }
}

if(!function_exists('smt_mcr_account_dashboard_page')) {
    function smt_mcr_account_dashboard_page ($current_user) {
        stm_car_rental_load_template('shop/my-account-dashboard', array('current_user' => $current_user));
    }
}

if(!function_exists('smt_mcr_account_orders_page')) {
    function smt_mcr_account_orders_page () {
        stm_car_rental_load_template('shop/my-account-orders');
    }
}

if(!function_exists('smt_mcr_account_downloads_page')) {
    function smt_mcr_account_downloads_page () {
        stm_car_rental_load_template('shop/my-account-downloads');
    }
}

if(!function_exists('smt_mcr_account_addresses_page')) {
    function smt_mcr_account_addresses_page () {
        stm_car_rental_load_template('shop/my-account-addresses');
    }
}

if(!function_exists('smt_mcr_account_details_page')) {
    function smt_mcr_account_details_page () {
        stm_car_rental_load_template('shop/my-account-details');
    }
}

if(!function_exists('smt_mcr_account_navigation_template')) {
    function smt_mcr_account_navigation_template () {
        stm_car_rental_load_template('shop/navigation');
    }
}

if(!function_exists('smt_mcr_account_form_edit_template')) {
    function smt_mcr_account_form_edit_template ($user) {
        stm_car_rental_load_template('shop/form-edit', array('user' => $user));
    }
}

if(!function_exists('smt_mcr_account_orders_list_template')) {
    function smt_mcr_account_orders_list_template ($customer_orders, $has_orders, $current_page) {
        stm_car_rental_load_template('shop/orders', array('customer_orders' => $customer_orders, 'has_orders' => $has_orders, 'current_page' => $current_page));
    }
}

if ( ! function_exists( 'stm_remove_rental_two_hooks' ) ) {
	function stm_remove_rental_two_hooks() {
		if ( ! function_exists( 'WC' ) ) {
			return;
		}

		if ( is_shop() || is_checkout() ) {
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices' );
		}
	}

	add_action( 'template_redirect', 'stm_remove_rental_two_hooks' );
}
