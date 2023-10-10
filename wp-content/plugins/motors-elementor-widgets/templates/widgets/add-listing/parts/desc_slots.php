<?php
$user = wp_get_current_user();

if ( $custom_listing_type && $listing_types_options ) {
	$_title      = ( $listing_types_options[ $custom_listing_type . '_addl_title' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_title' ] : '';
	$desc        = ( $listing_types_options[ $custom_listing_type . '_addl_description' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_description' ] : '';
	$slots_title = ( $listing_types_options[ $custom_listing_type . '_addl_slots_title' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_slots_title' ] : '';
	$show_slots  = ( $listing_types_options[ $custom_listing_type . '_addl_show_slots' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_show_slots' ] : false;
} else {
	$_title      = stm_me_get_wpcfto_mod( 'addl_title', '' );
	$desc        = stm_me_get_wpcfto_mod( 'addl_description', '' );
	$slots_title = stm_me_get_wpcfto_mod( 'addl_slots_title', '' );
	$show_slots  = stm_me_get_wpcfto_mod( 'addl_show_slots', false );
}
?>
<div class="motors-desc-slots-wrapper">
	<div class="mdsw-left">
		<?php if ( ! empty( $_title ) ) : ?>
			<h3><?php echo esc_html( stm_dynamic_string_translation( 'Add Listing title', $_title ) ); ?></h3>
		<?php endif; ?>
		<?php
		if ( ! empty( $desc ) ) {
			echo wp_kses_post( $desc );
		}
		?>
	</div>
	<div class="mdsw-right">
		<?php
		if ( ! empty( $user->ID ) && $show_slots ) :
			$limits = stm_get_post_limits( $user->ID );
			?>
			<div class="stm-posts-available-number heading-font">
				<?php echo esc_html( stm_dynamic_string_translation( 'Slots Available title', $slots_title ) ); ?>:
				<span><?php echo esc_html( $limits['posts'] ); ?></span>
			</div>
			<?php
		endif;
		?>
	</div>
</div>

<?php if ( defined( 'STM_MOTORS_VIN_DECODERS' ) ) : ?>
<div class="motors-vin-decoder-wrapper">
	<?php do_action( 'stm_vin_auto_complete_require_template' ); ?>
</div>
<?php endif; ?>
