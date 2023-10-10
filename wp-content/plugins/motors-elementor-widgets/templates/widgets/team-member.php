<?php
$thumb_size = 'medium';

if ( ! empty( $image_size ) ) {
	$exploded = explode( 'x', $image_size );

	if ( ! empty( $exploded ) && ! empty( $exploded[0] ) && is_numeric( $exploded[0] ) && ! empty( $exploded[1] ) && is_numeric( $exploded[1] ) ) {
		$thumb_size = array( intval( $exploded[0] ), intval( $exploded[1] ) );
	} else {
		$thumb_size = $image_size;
	}
}

if ( is_array( $image ) && ! empty( $image ) ) {
	if ( empty( $image_size ) ) {
		$image_size = '257x170';
	}

	if ( is_array( $thumb_size ) ) {
		$thumbnail_img = \STM_E_W\Helpers\Helper::stm_ew_resize_image( $image['id'], null, $thumb_size[0], $thumb_size[1] );
	} else {
		$thumbnail_img = wp_get_attachment_image_src( $image['id'], $thumb_size );
	}

	if ( ! empty( $thumbnail_img[0] ) ) {
		$thumbnail_img = $thumbnail_img[0];
	} else {
		$thumbnail_img = MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/avatar.png';
	}
}

?>

<div class="stm-our-team">
	<?php if ( ! empty( $thumbnail_img ) ) : ?>
		<div class="image">
			<img src="<?php echo esc_attr( $thumbnail_img ); ?>" alt="<?php esc_html_e( 'Team member photo', 'motors-elementor-widgets' ); ?>">

			<?php if ( ! empty( $email ) || ! empty( $phone ) ) : ?>
				<div class="team-info">
					<?php if ( ! empty( $email ) ) : ?>
						<a href="mailto:<?php echo esc_attr( $email ); ?>" class="email">
							<?php echo esc_attr( $email ); ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $phone ) ) : ?>
						<div class="phone heading-font">
							<i class="stm-icon-phone"></i>
							<a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $name ) || ! empty( $position ) ) : ?>
		<div class="meta">
			<?php if ( ! empty( $name ) ) : ?>
				<div class="name h5 heading-font">
					<?php echo esc_attr( $name ); ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $position ) ) : ?>
				<div class="position">
					<?php echo esc_attr( $position ); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
