<?php
if ( function_exists( 'stm_get_rental_order_fields_values' ) ) {
	wp_enqueue_style( 'stmselect2' );
	wp_enqueue_script( 'stmselect2' );
	wp_enqueue_script( 'app-select2' );
	wp_enqueue_script( 'uniform' );
	wp_enqueue_script( 'uniform-init' );
	stm_car_rental_module_enqueue_scripts_styles( 'stm_rental_two_car_form_shortcode' );

	$args = array(
		'post_type'      => 'stm_office',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
	);

	$fields = stm_get_rental_order_fields_values( true );

	$fields['return_same'] = ! empty( $_COOKIE['return_same'] ) ? sanitize_text_field( $_COOKIE['return_same'] ) : '';

	$locations = stm_rental_locations( true );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $__vars['css'], ' ' ) );

	$form_url   = stm_woo_shop_page_url();
	$reserv_url = stm_woo_shop_page_url();

	if ( isset( $__vars['product_page'] ) ) {
		$form_url   = wc_get_checkout_url();
		$reserv_url = wc_get_checkout_url();
	}

	$minHour = 0;
	$maxHour = 0;

	if ( ! empty( $__vars['workHr'] ) ) {
		$tm      = explode( '-', $__vars['workHr'] );
		$minHour = $tm[0];
		$maxHour = $tm[1];
	}

	if ( ! empty( $fields['calc_return_date'] ) ) {
		$return_date = stm_date_create_from_format( $fields['calc_return_date'] );
		if ( $return_date instanceof DateTime ) {
			$fields['calc_return_date'] = $return_date->format( stm_get_clear_date_format() );
		}
	}

	if ( ! empty( $fields['calc_pickup_date'] ) ) {
		$pickup_date = stm_date_create_from_format( $fields['calc_pickup_date'] );
		if ( $pickup_date instanceof DateTime ) {
			$fields['calc_pickup_date'] = $pickup_date->format( stm_get_clear_date_format() );
		}
	}
	$my_locale = explode( '_', get_locale() );
	?>

	<div class="stm_rent_car_two_form_shortcode_wrapper <?php echo esc_attr( $css_class ); ?>">
		<div class="stm_rent_car_two_form">
			<h3><?php echo esc_html( $__vars['title'] ); ?></h3>
			<form action="<?php echo esc_url( $form_url ); ?>" method="get" enctype="text/plain">
				<div class="reserve-form-wrap">
					<div class="fields-wrap show-return-office
					<?php
					if ( ! empty( $fields['pickup_date'] ) && ! empty( $fields['return_date'] ) ) {
						echo 'has-clear';
					}
					?>
				">
						<div class="stm_pickup_location">
							<label><?php esc_html_e( 'Pick-up Location', 'stm_motors_car_rental' ); ?></label>
							<select name="pickup_location" data-class="stm_rent_location">
								<option value=""><?php esc_html_e( 'Select Location', 'stm_motors_car_rental' ); ?></option>
								<?php if ( ! empty( $locations ) ) : ?>
									<?php foreach ( $locations as $location ) : ?>
										<option value="<?php echo esc_attr( $location[5] ); ?>" <?php echo ( esc_attr( $location[5] ) === esc_attr( $fields['pickup_location_id'] ) ) ? 'selected="selected"' : ''; ?>><?php echo esc_html( $location[4] ); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</div>
						<div class="stm_pickup_location stm_drop_location">
							<label><?php esc_html_e( 'Return Location', 'stm_motors_car_rental' ); ?></label>
							<select name="drop_location" data-class="stm_rent_location">
								<option value=""><?php esc_html_e( 'Select Location', 'stm_motors_car_rental' ); ?></option>
								<?php if ( ! empty( $locations ) ) : ?>
									<?php foreach ( $locations as $location ) : ?>
										<option <?php echo ( esc_attr( $location[5] ) === $fields['return_location_id'] ) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr( $location[5] ); ?>"><?php echo esc_attr( $location[4] ); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>

						</div>
						<div class="stm_date_time_input">
							<div class="stm_date_input">
								<div class="dateTimeRangeWrap">
									<label><?php echo esc_html__( 'Pick-up and Return Date-Time', 'stm_motors_car_rental' ); ?></label>
									<div class="start-end-wrap">
										<div class="holder-wrap">
											<i class="stm-carent-rental-ico-calendar"></i>
											<div id="pickup-date-holder" class="rent-date-text-holder"><?php echo ( ! empty( $fields['pickup_date'] ) ) ? esc_html( $fields['pickup_date'] ) : esc_html__( 'Select Date-Time', 'stm_motors_car_rental' );//phpcs:ignore ?></div>
										</div>
										<div class="holder-wrap">
											<i class="stm-carent-rental-ico-calendar"></i>
											<div id="return-date-holder" class="rent-date-text-holder"><?php echo ( ! empty( $fields['return_date'] ) ) ? esc_html( $fields['return_date'] ) : esc_html__( 'Select Date-Time', 'stm_motors_car_rental' );//phpcs:ignore ?></div>
										</div>
									</div>
								</div>

								<input type="text" value="<?php echo esc_attr( $fields['pickup_date'] . ' - ' . $fields['return_date'] ); ?>" class="stm-date-timepicker-holder" name="dt-holder" required readonly/>
								<input type="hidden" value="<?php echo esc_attr( $fields['pickup_date'] ); ?>" class="stm-date-timepicker-start" name="pickup_date" <?php echo ( ! empty( $fields['pickup_date'] ) ) ? 'data-dt-hide="' . $fields['pickup_date'] . '"' : '';//phpcs:ignore ?> required readonly />
								<input type="hidden" class="stm-date-timepicker-end" name="return_date" value="<?php echo $fields['return_date']; ?>" <?php echo ( ! empty( $fields['return_date'] ) ) ? 'data-dt-hide="' . $fields['return_date'] . '"' : '';//phpcs:ignore ?> required readonly/>
							</div>
						</div>
						<?php if ( ! empty( $fields['pickup_date'] ) && ! empty( $fields['return_date'] ) ) : ?>
							<div class="form-btn-wrap">
								<button type="submit" class="clear-data"
										data-type="clear-data"><?php esc_html_e( 'Clear Data', 'stm_motors_car_rental' ); ?></button>
							</div>
						<?php endif; ?>
						<div class="btn-search-wrap">
							<button type="submit"><?php echo esc_html__( 'SEARCH', 'stm_motors_car_rental' ); ?></button>
						</div>
					</div>
					<input type="hidden" name="return_same" checked="checked"/>
				</div>
				<?php
				$oldDays = stm_get_rental_order_fields_values();
				if ( ! empty( $oldDays['order_days'] ) ) :
					?>
					<input type="hidden" name="order_old_days" value="<?php echo esc_attr( $oldDays['order_days'] ); ?>"/>
				<?php endif; ?>
				<?php if ( isset( $_GET["lang"] ) ) : //phpcs:ignore ?>
					<input type="hidden" name="lang" value="<?php echo esc_attr( $_GET["lang"] );//phpcs:ignore ?>"/>
				<?php endif; ?>
			</form>
		</div>
	</div>

	<?php //phpcs:disable ?>
	<script>
        (function ($) {
            "use strict";

            $(document).ready(function () {

                $('.stm_pickup_location select').on('select2:open', function () {
                    $('body').addClass('stm_background_overlay');
                    $('.select2-container').css('width', $('.select2-dropdown').outerWidth());
                });

                $('.stm_pickup_location select').on('select2:close', function () {
                    $('body').removeClass('stm_background_overlay');
                });

                $('.stm_date_time_input input').on('change', function () {
                    if ($(this).val() == '') {
                        $(this).removeClass('active');
                    } else {
                        $(this).addClass('active');
                    }
                });


                var locations = <?php echo json_encode( $locations ); ?>;
                var contents = [];
                var content = '';
                var i = 0;


                for (i = 0; i < locations.length; i++) {
                    content = '<ul class="stm_locations_description">';
                    content += '<li>' + locations[i][0] + '</li>';
                    content += '</ul>';

                    contents.push(content);
                }

                $(document).on('mouseover', '.stm_rent_location .select2-results__options li', function () {
                    var currentLi = ($(this).index()) - 1;
                    $('.stm_rent_location .stm_locations_description').remove();
                    $('.stm_rent_location').append(contents[currentLi]);
                });


                /*Timepicker*/
                var stmToday = new Date();
				<?php if(! empty( $fields['pickup_date'] )) : ?>
                stmToday = '<?php echo $fields['pickup_date'] ?>';
				<?php endif ?>
                var stmTomorrow = new Date(+new Date() + 86400000);
				<?php if(! empty( $fields['return_date'] )) : ?>
                stmTomorrow = '<?php echo $fields['return_date'] ?>';
				<?php endif; ?>
                var minDate = new Date();
                var startDate = false;
                var endDate = false;
				var dateTimeFormat = '<?php echo esc_html( stm_do_lmth( $fields['moment_format'] ) ); ?>';
				var dateTimeFormatHide = '<?php echo esc_html( stm_do_lmth( $fields['moment_format'] ) ); ?>';

                moment.lang('<?php echo esc_js( $my_locale[0] )?>');

                $('.stm-date-timepicker-holder').daterangepicker({
                    minDate: minDate,
                    minHour: <?php echo esc_js( $minHour );?>,
                    maxHour: <?php echo esc_js( $maxHour );?>,
                    startDate: stmToday,
                    endDate: stmTomorrow,
                    timePicker: true,
                    timePicker24Hour: true,
                    timePickerIncrement: 30,
                    autoApply: true,
                    locale: {
                        format: dateTimeFormat,
                    },
                    opens: 'center'
                });

                $('.stm-date-timepicker-holder').on('show.daterangepicker', function (ev, picker) {
                    $('body').addClass('stm_background_overlay stm-lock');
                })

                $('.stm-date-timepicker-holder').on('hide.daterangepicker', function (ev, picker) {


                    startDate = picker.startDate.format(dateTimeFormatHide);
                    endDate = picker.endDate.format(dateTimeFormatHide);

                    $('.stm-date-timepicker-start').attr('data-dt-hide', picker.startDate.format(startDate));
                    $('.stm-date-timepicker-start').val(picker.startDate.format(dateTimeFormat));
                    $('#pickup-date-holder').text(picker.startDate.format(dateTimeFormat));

                    $('.stm-date-timepicker-end').attr('data-dt-hide', picker.endDate.format(endDate));
                    $('.stm-date-timepicker-end').val(picker.endDate.format(dateTimeFormat));
                    $('#return-date-holder').text(picker.endDate.format(dateTimeFormat));

                    if (startDate && endDate) {
                        checkDate(startDate, endDate);
                    }

                    $('body').removeClass('stm_background_overlay stm-lock');
                })

                $('.clear-data').on('click', function (e) {
                    e.preventDefault();

                    $('.stm_rent_car_two_form form').attr('action', '<?php echo stm_do_lmth( $reserv_url ); ?>');
                    $('#pickup-date-holder').text(selectDTHolder);
                    $('#return-date-holder').text(selectDTHolder);

                    jQuery.ajax({
                        url: mcr_ajaxurl,
                        type: "GET",
                        dataType: 'json',
                        context: this,
                        data: 'action=stm_ajax_clear_data&security=' + stm_security_nonce,
                        success: function (data) {
                        }
                    });

                    $.each($('.stm_rent_car_two_form form').serializeArray(), function (i, field) {
                        if (field.name == 'pickup_location' || field.name == 'drop_location') {
                            $("select[name='pickup_location']").val('').trigger('change');
                            $("select[name='drop_location']").val('').trigger('change');
                        } else {
                            $('input[name="' + field.name + '"]').val('');
                        }

                        $.cookie('stm_' + field.name + '_' + stm_mcr_site_blog_id, '', {expires: -1, path: '/'});
                        $.cookie('stm_' + field.name + '_old_' + stm_mcr_site_blog_id, '', {expires: -1, path: '/'});
                        $.cookie('stm_calc_pickup_date_' + stm_mcr_site_blog_id, '', {expires: -1, path: '/'});
                        $.cookie('stm_calc_return_date_' + stm_mcr_site_blog_id, '', {expires: -1, path: '/'});
                        $.cookie('stm_car_watched', '', {expires: -1, path: '/'});
                    });

                    $('.fields-wrap').removeClass('has-clear');
                    $(this).hide();

                    return false;
                });

                /*Set cookie with order data*/
                $('.stm_rent_car_two_form form').on('submit', function (e) {
                    $('.stm_pickup_location').removeClass('stm_error');
                    $('.start-dt-wrap').removeClass('stm_error');
                    $('.end-dt-wrap').removeClass('stm_error');

                    var stm_pickup_location = $('.stm_pickup_location select').val();
                    var return_same = $('input[name="return_same"]').prop('checked');
                    var stm_drop_location = $('.stm_drop_location select').val();
                    var pickDate = $('.stm_date_input').find('input[name="pickup_date"]').attr('data-dt-hide');
                    var returnDate = $('.stm_date_input').find('input[name="return_date"]').attr('data-dt-hide');

                    var error = false;
                    if (stm_pickup_location == '') {
                        $('.stm_pickup_location:not(".stm_drop_location")').addClass('stm_error');
                        error = true;
                    }

                    if (return_same && stm_drop_location == '') {
                        $('.stm_drop_location').addClass('stm_error');
                        error = true;
                    }

                    if (typeof (pickDate) == 'undefined' || pickDate == '') {
                        $('.start-dt-wrap').addClass('stm_error');
                        error = true;
                    }

                    if (typeof (returnDate) == 'undefined' || returnDate == '') {
                        $('.end-dt-wrap').addClass('stm_error');
                        error = true;
                    }

                    if (error) {
                        e.preventDefault();
                    } else {

                        /*Save in cookies all fields*/
                        if ($.cookie('stm_pickup_date_' + stm_mcr_site_blog_id) != null) {
                            $.cookie('stm_pickup_date_old_' + stm_mcr_site_blog_id, $.cookie('stm_pickup_date_' + stm_mcr_site_blog_id), {
                                expires: 7,
                                path: '/'
                            });
                            $.cookie('stm_return_date_old_' + stm_mcr_site_blog_id, $.cookie('stm_return_date_' + stm_mcr_site_blog_id), {
                                expires: 7,
                                path: '/'
                            });
                        }

                        $.each($(this).serializeArray(), function (i, field) {

                            $.cookie('stm_' + field.name + '_' + stm_mcr_site_blog_id, field.value, {
                                expires: 7,
                                path: '/'
                            });

                            if (field.name == 'pickup_date' || field.name == 'return_date') {
                                $.cookie('stm_calc_' + field.name + '_' + stm_mcr_site_blog_id, $('.stm_date_input').find('input[name="' + field.name + '"]').attr('data-dt-hide'), {
                                    expires: 7,
                                    path: '/'
                                });
                            }
                        });


                        if (!$('input[name="return_same"]').prop('checked')) {
                            $.cookie('stm_return_same_' + stm_mcr_site_blog_id, "off", {expires: 7, path: '/'});
                        }
                    }
                });

                $('.stm-template-car_rental .stm_rent_order_info .image.image-placeholder a').on('click', function (e) {
                    var $stmThis = $('.stm_rent_car_two_form form');
                    $stmThis.submit();
                    e.preventDefault();
                });

                $('body').on('click touchstart', '.stm-rental-overlay', function (e) {
                    $('.stm-date-timepicker-start').blur();
                    $('.stm-date-timepicker-end').blur();
                    $('.xdsoft_datetimepicker').hide();
                    $('body').removeClass('stm_background_overlay');
                });

            });

        })(jQuery);

        function checkDate($start, $end) {

            var locationId = jQuery('select[name="pickup_location"]').select2("val");
            var stm_timeout_rental;
            if (locationId != '') {

                jQuery.ajax({
                    url: mcr_ajaxurl,
                    type: "GET",
                    dataType: 'json',
                    context: this,
                    data: 'startDate=' + $start + '&endDate=' + $end + '&action=stm_ajax_check_is_available_car_date&security=' + stm_security_nonce,
                    success: function (data) {
                        jQuery("#select-vehicle-popup").attr("href", $("#select-vehicle-popup").attr('href').split("?")[0] + "?pickup_location=" + locationId);
                        if (data != '') {
                            clearTimeout(stm_timeout_rental);
                            jQuery('.choose-another-class').addClass('single-add-to-compare-visible');
                            jQuery(".choose-another-class").addClass('car-reserved');
                            jQuery(".choose-another-class").find(".stm-title.h5").html(data);
                            stm_timeout_rental = setTimeout(function () {
                                jQuery('.choose-another-class').removeClass('single-add-to-compare-visible').removeClass('car-reserved');
                            }, 10000);
                        }
                    }
                });
            }
        }
	</script>

<?php }//phpcs:enable ?>
