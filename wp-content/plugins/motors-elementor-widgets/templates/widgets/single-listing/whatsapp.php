<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$listing_author_id = get_post_meta( $listing_id, 'stm_car_user', true );
if ( ! empty( $listing_author_id ) ) {
	$user_phone   = get_the_author_meta( 'stm_phone', $listing_author_id );
	$has_whatsapp = get_the_author_meta( 'stm_whatsapp_number', $listing_author_id );

	if ( ! empty( $user_phone ) && ! empty( $has_whatsapp ) ) {
		$phone_number = $user_phone;
	}
}

if ( empty( $phone_number ) ) {
	$blogusers = get_users( array( 'role__in' => array( 'administrator' ) ) );

	if ( ! empty( $blogusers ) ) {
		foreach ( $blogusers as $user ) {
			$phone = get_the_author_meta( 'stm_phone', $user->ID );
			if ( ! empty( $phone ) && empty( $phone_number ) ) {
				$phone_number = $phone;
			}
		}
	}
}

?>
<div class="whats-button-wrap">
	<?php if ( ! empty( $phone_number ) ) : ?>
		<div class="whatsapp">
			<a href="https://wa.me/<?php echo esc_attr( trim( preg_replace( '/[^0-9]/', '', $phone_number ) ) ); ?>" target="_blank">
				<div class="whatsapp-btn heading-font">
					<?php echo wp_kses( $wa_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
					<?php echo esc_html( $wa_label ); ?>
				</div>
			</a>
		</div>
	<?php endif; ?>
</div>

<style>

	.whats-button-wrap .whatsapp .whatsapp-btn {
		display: flex;
		align-items: center;
		text-align: left;
	}

	.whats-button-wrap a,
	.whats-button-wrap a:hover,
	.whats-button-wrap a:focus,
	.whats-button-wrap a:active {
		text-decoration: none;
	}

</style>
