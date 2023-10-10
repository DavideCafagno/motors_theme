<?php
/****
 * $info_block_style
 * $info_block_position
 * $title
 * $price
 * $per_month
 * $period
 * $content
 * $btn_link
 * $btn_title
 * $btn_icon
 * */


$parse_title = explode( ' ', trim( $title ) );

$new_title = $title;
if ( count( $parse_title ) > 2 ) {
	$new_title = '';
	$new_title = '<span class="stm-white">' . $parse_title[0] . ' ' . $parse_title[1] . '</span>';
	unset( $parse_title[0] );
	unset( $parse_title[1] );
	$new_title .= ' ' . implode( ' ', $parse_title );
}

?>
<!--This Style for Animation-->
<style>
	.stm-hero-banner-wrap .container .stm-info-wrap {
		opacity: 0;
	}
</style>

<div class="stm-hero-banner-wrap <?php echo esc_attr( $info_block_style . ' ' . $info_block_position ); ?>">
	<div class="stm-image-wrap">
		<?php echo wp_get_attachment_image( $bg_img_id, 'full' ); ?>
	</div>
	<div class="container">
		<div class="stm-info-wrap">
			<div class="stm-hb-round">
				<div class="stm-hb-title heading-font">
					<?php echo wp_kses_post( $new_title ); ?>
				</div>
				<?php if ( 'style_3' !== $info_block_style ) : ?>
					<div class="stm-hb-price-unit heading-font">
						<?php if ( ! empty( $price ) ) : ?>
							<span class="stm-hb-currency">
							<?php echo esc_html( stm_me_get_wpcfto_mod( 'price_currency', '$' ) ); ?>
						</span>
							<span class="stm-hb-price">
							<?php echo esc_html( $price ); ?>
						</span>
						<?php endif; ?>
						<?php if ( ! empty( $per_month ) && $period ) : ?>
							<span class="stm-hb-divider"> / </span>
							<span class="stm-hb-labels">
								<span class="stm-hb-time-label">
									<?php echo esc_html( $per_month ); ?>
								</span>
								<span class="stm-hb-time-value">
									<?php echo esc_html( $period ); ?>
								</span>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( 'style_1' !== $info_block_style ) : ?>
				<div class="stm-hb-round-text heading-font">
					<?php echo wp_kses_post( $hb_content ); ?>
				</div>
				<?php endif; ?>
				<?php if ( ! empty( $btn_link ) && ! empty( $btn_title ) ) : ?>
					<a class="stm-button heading-font" href="<?php echo esc_url( $btn_link ); ?>" target="_blank">
						<?php if ( ! empty( $btn_icon ) ) : ?>
							<?php echo wp_kses_post( $btn_icon ); ?>
						<?php endif; ?>
						<?php echo esc_html( $btn_title ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
