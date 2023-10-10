<?php

$arrow_styles = '';

if ( 'yes' === $arrow_top_offset || 'yes' === $arrow_right_offset || 'yes' === $arrow_bottom_offset || 'yes' === $arrow_left_offset ) {

	if ( 'yes' === $arrow_top_offset ) {
		$arrow_styles .= 'top: ' . $arrow_top . 'px;';
	}

	if ( 'yes' === $arrow_right_offset ) {
		$arrow_styles .= 'right: ' . $arrow_right . 'px;';
	}

	if ( 'yes' === $arrow_bottom_offset ) {
		$arrow_styles .= 'bottom: ' . $arrow_bottom . 'px;';
	}

	if ( 'yes' === $arrow_left_offset ) {
		$arrow_styles .= 'left: ' . $arrow_left . 'px;';
	}
}

$arrow_transform_styles = '';

if ( 'yes' === $flip_arrow || ! empty( $arrow_degree['size'] ) ) {
	$arrow_transform_styles = 'transform: ';

	if ( 'yes' === $flip_arrow ) {
		$arrow_transform_styles .= ' scaleX(-1) ';
	}

	if ( ! empty( $arrow_degree['size'] ) ) {
		$arrow_transform_styles .= ' rotate(' . $arrow_degree['size'] . 'deg) ';
	}

	$arrow_transform_styles .= ';';
}

$arrow_styles .= $arrow_transform_styles;
?>
<div class="motors-elementor-arrow-banner">
	<div class="stm-content-arrow-wrap animated fadeIn">
		<div class="centered-banner-content-listing">
			<div class="inner">
				<?php if ( ! empty( $show_arrow ) && 'yes' === $show_arrow ) : ?>
					<div
							class="stm-vivus-arrow"
							style="<?php echo esc_attr( $arrow_styles ); ?>"
					>
						<?php
						$arrow = wp_remote_get( get_template_directory_uri() . '/assets/images/icons/arrow7white.svg' );
						if ( ! is_wp_error( $arrow ) ) {
							echo wp_kses( $arrow['body'], apply_filters( 'stm_ew_kses_svg', array() ) );
						}
						?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $title ) ) : ?>
					<h1><?php echo wp_kses_post( $title ); ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $subtitle ) ) : ?>
					<h3><?php echo wp_kses_post( $subtitle ); ?></h3>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
