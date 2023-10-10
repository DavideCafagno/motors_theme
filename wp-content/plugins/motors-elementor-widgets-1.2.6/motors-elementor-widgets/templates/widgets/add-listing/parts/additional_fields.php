<?php

if ( $custom_listing_type && $listing_types_options ) {
	$show_registered = ( $listing_types_options[ $custom_listing_type . '_addl_show_registered' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_show_registered' ] : false;
	$show_vin        = ( $listing_types_options[ $custom_listing_type . '_addl_show_vin' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_show_vin' ] : false;
	$show_history    = ( $listing_types_options[ $custom_listing_type . '_addl_show_history' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_show_history' ] : false;
} else {
	$show_registered = stm_me_get_wpcfto_mod( 'addl_show_registered', false );
	$show_vin        = stm_me_get_wpcfto_mod( 'addl_show_vin', false );
	$show_history    = stm_me_get_wpcfto_mod( 'addl_show_history', false );
}

if ( function_exists( 'motors_include_once_scripts_styles' ) ) {
	motors_include_once_scripts_styles( array( 'stmdatetimepicker', 'app-datetime' ) );
}

if ( $show_registered ) {
	$data_value = get_post_meta( $post_id, 'registration_date', true );
	?>
	<div class="stm-form-1-quarter stm_registration_date">
		<input type="text" name="stm_registered" class="stm-years-datepicker
		<?php
		if ( ! empty( $data_value ) ) {
			echo ' stm_has_value';
		}
		?>
		" placeholder="<?php esc_attr_e( 'Enter date', 'motors-elementor-widgets' ); ?>" value="<?php echo esc_attr( $data_value ); ?>"/>
		<div class="stm-label">
			<i class="stm-icon-key"></i>
			<?php esc_html_e( 'Registered', 'motors-elementor-widgets' ); ?>
		</div>
	</div>
	<?php
}

if ( $show_vin ) {
	$data_value = get_post_meta( $post_id, 'vin_number', true );
	?>
	<div class="stm-form-1-quarter stm_vin">
		<input type="text" name="stm_vin"
			<?php
			if ( ! empty( $data_value ) ) {
				?>
				class="stm_has_value" <?php } ?> value="<?php echo esc_attr( $data_value ); ?>" placeholder="<?php esc_attr_e( 'Enter VIN', 'motors-elementor-widgets' ); ?>"/>
		<div class="stm-label">
			<i class="stm-service-icon-vin_check"></i>
			<?php esc_html_e( 'VIN', 'motors-elementor-widgets' ); ?>
		</div>
	</div>
	<?php
}

if ( $show_history ) {
	$data_value      = get_post_meta( $post_id, 'history', true );
	$data_value_link = get_post_meta( $post_id, 'history_link', true );
	?>
	<div class="stm-form-1-quarter stm_history">
		<input type="text" name="stm_history_label" class="<?php echo ( ! empty( $data_value ) ) ? 'stm_has_value' : ''; ?>" value="<?php echo esc_attr( $data_value ); ?>" placeholder="<?php esc_attr_e( 'Vehicle History Report', 'motors-elementor-widgets' ); ?>"/>
		<div class="stm-label">
			<i class="stm-icon-time"></i>
			<?php esc_html_e( 'History', 'motors-elementor-widgets' ); ?>
		</div>

		<div class="stm-history-popup stm-invisible">
			<div class="inner">
				<i class="fas fa-times fa-remove"></i>
				<h5><?php esc_html_e( 'Vehicle history', 'motors-elementor-widgets' ); ?></h5>
				<?php
				if ( ! empty( $histories ) ) :
					$histories = explode( ',', $histories );
					echo '<div class="labels-units">';
					foreach ( $histories as $history ) :
						?>
						<label>
							<input type="radio" name="stm_chosen_history" value="<?php echo esc_attr( $history ); ?>"/>
							<span><?php echo esc_attr( $history ); ?></span>
						</label>
						<?php
					endforeach;
					echo '</div>';
				endif;
				?>
				<input type="text" name="stm_history_link" placeholder="<?php esc_attr_e( 'Insert link', 'motors-elementor-widgets' ); ?>" value="<?php echo esc_attr( $data_value_link ); ?>"/>
				<a href="#" class="button"><?php esc_html_e( 'Apply', 'motors-elementor-widgets' ); ?></a>
			</div>
		</div>
	</div>
	<?php // phpcs:disable ?>
	<script type="text/javascript">
        jQuery(document).ready(function () {
            var $ = jQuery;
            var $stm_handler = $('.stm-form-1-quarter.stm_history input[name="stm_history_label"]');
            $stm_handler.on('focus', function () {
                $('.stm-history-popup').removeClass('stm-invisible');
            });

            $('.stm-history-popup .button').on('click', function (e) {
                e.preventDefault();
                $('.stm-history-popup').addClass('stm-invisible');

                if ($('input[name=stm_chosen_history]:radio:checked').length > 0) {
                    $stm_checked = $('input[name=stm_chosen_history]:radio:checked').val();
                } else {
                    $stm_checked = '';
                }

                $stm_handler.val($stm_checked);
            });

            $('.stm-history-popup .fa-remove').on('click', function () {
                $('.stm-history-popup').addClass('stm-invisible');
            });
        });
	</script>
	<?php
	// phpcs:enable
}
