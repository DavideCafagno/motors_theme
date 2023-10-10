<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$currency_symbol = stm_get_price_currency();
$price           = get_post_meta( $listing_id, 'price', true );
$sale_price      = get_post_meta( $listing_id, 'sale_price', true );

if ( ! empty( $sale_price ) ) {
	$price = getConverPrice( $sale_price );
} elseif ( ! empty( $price ) ) {
	$price = getConverPrice( $price );
} else {
	$price = '';
}

/*Calculator default*/
$interest     = $default_interest_rate;
$period       = $default_month_period;
$down_payment = $default_down_payment;

if ( 'percent' === $default_down_payment_type && ! empty( $default_down_payment_percent ) ) {
	if ( $default_down_payment_percent > 100 ) {
		$default_down_payment_percent = 100;
	}

	$down_payment = $price * ( $default_down_payment_percent / 100 );
}
$unique = 'stm_calc_' . wp_rand( 1, 99999 );
?>
<div class="stm_auto_loan_calculator_wrap" id="<?php echo esc_attr( $unique ); ?>">
	<div class="stm_auto_loan_calculator novo">
		<div class="title">
			<?php echo wp_kses( $title_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
			<<?php echo esc_attr( $title_tag ); ?>
			class="heading-font"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 stm_changeable_breakpoint">
					<!--Amount-->
					<div class="form-group">
						<div class="labeled">
							<?php esc_html_e( 'Vehicle price', 'motors-elementor-widgets' ); ?>
							<span class="orange">(<?php echo esc_html( $currency_symbol ); ?>)</span>
						</div>
						<input type="text" class="numbersOnly vehicle_price" value="<?php echo esc_attr( $price ); ?>"/>
					</div>
				</div>
				<div class="col-md-12 stm_changeable_breakpoint">
					<!--Interest rate-->
					<div class="form-group">
						<div class="labeled">
							<?php esc_html_e( 'Interest rate', 'motors-elementor-widgets' ); ?>
							<span class="orange">(%)</span>
						</div>
						<input type="text" class="numbersOnly interest_rate" value="<?php echo esc_attr( $interest ); ?>"/>
					</div>
				</div>
				<div class="col-md-12 stm_changeable_breakpoint">
					<!--Period-->
					<div class="form-group">
						<div class="labeled"><?php esc_html_e( 'Loan Term', 'motors-elementor-widgets' ); ?>
							<span class="orange">(<?php esc_html_e( 'month', 'motors-elementor-widgets' ); ?>)</span>
						</div>
						<input type="text" class="numbersOnly period_month" value="<?php echo esc_attr( $period ); ?>"/>
					</div>
				</div>
				<div class="col-md-12 stm_changeable_breakpoint">
					<!--Down Payment-->
					<div class="form-group">
						<div class="labeled">
							<?php esc_html_e( 'Down Payment', 'motors-elementor-widgets' ); ?>
							<span class="orange">(<?php echo esc_html( $currency_symbol ); ?>)</span>
						</div>
						<input type="text" class="numbersOnly down_payment" value="<?php echo esc_attr( $down_payment ); ?>"/>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 stm_changeable_breakpoint">
					<a href="#" class="button button-sm calculate_loan_payment dp-in">
						<?php esc_html_e( 'Calculate', 'motors-elementor-widgets' ); ?>
					</a>
				</div>
				<div class="col-md-12 stm_changeable_breakpoint">
					<div class="stm_calculator_results">
						<div class="result">
							<div class="stm-calc-label"><?php esc_html_e( 'Monthly Payment', 'motors-elementor-widgets' ); ?></div>
							<div class="monthly_payment h5"></div>
						</div>
						<div class="result">
							<div class="stm-calc-label"><?php esc_html_e( 'Total Interest Payment', 'motors-elementor-widgets' ); ?></div>
							<div class="total_interest_payment h5"></div>
						</div>
						<div class="result">
							<div class="stm-calc-label"><?php esc_html_e( 'Total Amount to Pay', 'motors-elementor-widgets' ); ?></div>
							<div class="total_amount_to_pay h5"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="calculator-alert alert alert-danger"></div>
		</div>
	</div>
</div>
<?php // @codingStandardsIgnoreStart ?>
<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            var vehicle_price;
            var interest_rate;
            var down_payment;
            var period_month;
            var stmCurrency = "<?php echo esc_js( stm_get_price_currency() ); ?>";
            var stmPriceDel = "<?php echo esc_js( stm_me_get_wpcfto_mod( 'price_delimeter', ' ' ) ); ?>";
            var stmCurrencyPos = "<?php echo esc_js( stm_me_get_wpcfto_mod( 'price_currency_position', 'left' ) ); ?>";

            $('.calculate_loan_payment').on('click', function (e) {
                e.preventDefault();

                //Useful vars
                var current_calculator = $(this).closest('.stm_auto_loan_calculator');

                var calculator_alert = current_calculator.find('.calculator-alert');
                //First of all hide alert
                calculator_alert.removeClass('visible-alert');

                //4 values for calculating
                vehicle_price = parseFloat(current_calculator.find('input.vehicle_price').val());

                interest_rate = parseFloat(current_calculator.find('input.interest_rate').val());
                interest_rate = interest_rate / 1200;

                down_payment = parseFloat(current_calculator.find('input.down_payment').val());

                period_month = parseFloat(current_calculator.find('input.period_month').val());

                //Help vars

                var validation_errors = true;

                var monthly_payment = 0;
                var total_interest_payment = 0;
                var total_amount_to_pay = 0;

                //Check if not nan
                if (isNaN(vehicle_price)) {
                    calculator_alert.text("<?php esc_html_e( 'Please fill Vehicle Price field', 'motors-elementor-widgets' ); ?>");
                    calculator_alert.addClass('visible-alert');
                    current_calculator.find('input.vehicle_price').closest('.form-group').addClass('has-error');
                    validation_errors = true;
                } else if (isNaN(interest_rate)) {
                    calculator_alert.text("<?php esc_html_e( 'Please fill Interest Rate field', 'motors-elementor-widgets' ); ?>");
                    calculator_alert.addClass('visible-alert');
                    current_calculator.find('input.interest_rate').closest('.form-group').addClass('has-error');
                    validation_errors = true;
                } else if (isNaN(period_month)) {
                    calculator_alert.text("<?php esc_html_e( 'Please fill Period field', 'motors-elementor-widgets' ); ?>");
                    calculator_alert.addClass('visible-alert');
                    current_calculator.find('input.period_month').closest('.form-group').addClass('has-error');
                    validation_errors = true;
                } else if (isNaN(down_payment)) {
                    calculator_alert.text("<?php esc_html_e( 'Please fill Down Payment field', 'motors-elementor-widgets' ); ?>");
                    calculator_alert.addClass('visible-alert');
                    current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
                    validation_errors = true;
                } else if (down_payment > vehicle_price) {
                    //Check if down payment is not bigger than vehicle price
                    calculator_alert.text("<?php esc_html_e( 'Down payment can not be more than vehicle price', 'motors-elementor-widgets' ); ?>");
                    calculator_alert.addClass('visible-alert');
                    current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
                    validation_errors = true;
                } else {
                    validation_errors = false;
                }

                if (!validation_errors) {
                    var interest_rate_unused = interest_rate;
                    var mathPow = Math.pow(1 + interest_rate, period_month);

                    if (interest_rate == 0) {
                        interest_rate_unused = 1;
                    }

                    monthly_payment = (interest_rate_unused != 1) ? (vehicle_price - down_payment) * interest_rate_unused * mathPow : (vehicle_price - down_payment) / period_month;
                    var monthly_payment_div = (mathPow - 1);
                    if (monthly_payment_div == 0) {
                        monthly_payment_div = 1;
                    }

                    monthly_payment = monthly_payment / monthly_payment_div;
                    monthly_payment = monthly_payment.toFixed(2);

                    total_amount_to_pay = down_payment + (monthly_payment * period_month);
                    total_amount_to_pay = (interest_rate == 0) ? vehicle_price : total_amount_to_pay.toFixed(2);

                    total_interest_payment = total_amount_to_pay - vehicle_price;
                    total_interest_payment = (interest_rate == 0) ? 0 : total_interest_payment.toFixed(2);

                    current_calculator.find('.stm_calculator_results').slideDown();
                    current_calculator.find('.monthly_payment').text(stm_get_price_view(monthly_payment, stmCurrency, stmCurrencyPos, stmPriceDel));
                    current_calculator.find('.total_interest_payment').text(stm_get_price_view(total_interest_payment, stmCurrency, stmCurrencyPos, stmPriceDel));
                    current_calculator.find('.total_amount_to_pay').text(stm_get_price_view(total_amount_to_pay, stmCurrency, stmCurrencyPos, stmPriceDel));
                } else {
                    current_calculator.find('.stm_calculator_results').slideUp();
                    current_calculator.find('.monthly_payment').text('');
                    current_calculator.find('.total_interest_payment').text('');
                    current_calculator.find('.total_amount_to_pay').text('');
                }
            })

            $(".numbersOnly").on("keypress keyup blur", function (event) {
                //this.value = this.value.replace(/[^0-9\.]/g,'');
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }

                if ($(this).val() != '') {
                    $(this).closest('.form-group').removeClass('has-error');
                }
            });

			<?php if ( ! empty( $interest ) && ! empty( $period ) && ! empty( $down_payment ) ) : ?>
            $('.calculate_loan_payment').trigger('click');
			<?php endif; ?>
        });

    })(jQuery);
</script>

<style>
	.stm_auto_loan_calculator.novo .stm_calculator_results .result .h5:before {
		content: '<?php echo esc_attr( $currency_symbol ); ?>';
	}
</style>
</div>

<script>
    (function ($) {
        $(document).on('ready', function () {
            let parent_width = $('#<?php echo esc_js( $unique ); ?>').width();
            if (parent_width < 360) {
                $('#<?php echo esc_js( $unique ); ?> .stm_changeable_breakpoint').removeClass('col-md-3');
                $('#<?php echo esc_js( $unique ); ?> .stm_changeable_breakpoint').removeClass('col-sm-3');
                $('#<?php echo esc_js( $unique ); ?> .stm_changeable_breakpoint').removeClass('col-sm-9');
                $('#<?php echo esc_js( $unique ); ?> .stm_changeable_breakpoint').addClass('col-md-12');
                $('#<?php echo esc_js( $unique ); ?> .stm_calculator_results').css('flex-direction', 'column');
            }
        });
    })(jQuery);
</script>
<?php // @codingStandardsIgnoreEnd ?>