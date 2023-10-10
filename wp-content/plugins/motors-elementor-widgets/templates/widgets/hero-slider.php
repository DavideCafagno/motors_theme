<?php
/****
 * @var $slides
 * @var $loop
 * @var $autoplay
 * @var $transition_speed
 * @var $delay
 * @var $pause_on_mouseover
 * @var $navigation
 * */

$slider_options = compact(
	'loop',
	'autoplay',
	'transition_speed',
	'delay',
	'pause_on_mouseover',
	'navigation',
);

$uniqid = uniqid();

?>
<!--This Style for Animation-->
<style>
	.stm-hero-slider-wrap .container .stm-info-wrap {
		opacity: 0;
	}
</style>

<div class="stm-hero-slider-carousel stm-hero-slider-carousel-<?php echo esc_attr( $uniqid ); ?> swiper swiper-container" data-options="<?php echo esc_attr( wp_json_encode( $slider_options ) ); ?>" data-widget-id="<?php echo esc_attr( $uniqid ); ?>">
	<div class="swiper-wrapper">
	<?php
	foreach ( $slides as $slide ) :

		$parse_title = explode( ' ', trim( $slide['title'] ) );

		$new_title = $slide['title'];
		if ( count( $parse_title ) > 2 ) {
			$new_title = '';
			$new_title = '<span class="stm-white">' . $parse_title[0] . ' ' . $parse_title[1] . '</span>';
			unset( $parse_title[0] );
			unset( $parse_title[1] );
			$new_title .= ' ' . implode( ' ', $parse_title );
		}
		?>
		<div class="swiper-slide">
			<div class="stm-hero-slider-wrap <?php echo esc_attr( $slide['slide_style'] . ' ' . $slide['info_block_position'] ); ?>">
				<div class="stm-image-wrap">
					<?php echo wp_get_attachment_image( $slide['background_image']['id'], 'full' ); ?>
				</div>
				<div class="container">
					<div class="stm-info-wrap">
						<div class="stm-hb-round">
							<div class="stm-hb-title heading-font">
								<?php echo wp_kses_post( $new_title ); ?>
							</div>
							<?php if ( 'style_3' !== $slide['slide_style'] ) : ?>
								<div class="stm-hb-price-unit heading-font">
									<?php if ( ! empty( $slide['price'] ) ) : ?>
										<span class="stm-hb-currency">
										<?php echo esc_html( stm_me_get_wpcfto_mod( 'price_currency', '$' ) ); ?>
								</span>
										<span class="stm-hb-price">
										<?php echo esc_html( $slide['price'] ); ?>
								</span>
									<?php endif; ?>
									<?php if ( ! empty( $slide['per_month'] ) && $slide['period'] ) : ?>
										<span class="stm-hb-divider"> / </span>
										<span class="stm-hb-labels">
										<span class="stm-hb-time-label">
											<?php echo esc_html( $slide['per_month'] ); ?>
										</span>
										<span class="stm-hb-time-value">
											<?php echo esc_html( $slide['period'] ); ?>
										</span>
									</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ( 'style_1' !== $slide['slide_style'] ) : ?>
								<div class="stm-hb-round-text heading-font">
									<?php echo wp_kses_post( $slide['hb_content'] ); ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $slide['btn_link'] ) && ! empty( $slide['btn_title'] ) ) : ?>
								<a class="stm-button heading-font" href="<?php echo esc_url( $slide['btn_link'] ); ?>" target="_blank">
									<?php if ( ! empty( $slide['btn_icon'] ) && ! empty( $slide['btn_icon']['value'] ) ) : ?>
										<i class="<?php echo esc_attr( $slide['btn_icon']['value'] ); ?>"></i>
									<?php endif; ?>
									<?php echo esc_html( $slide['btn_title'] ); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
	<?php if ( $navigation ) : ?>
		<div class="stm-hero-slider-nav">
			<div class="stm-hero-slider-nav-prev"></div>
			<div class="stm-hero-slider-nav-next"></div>
		</div>
	<?php endif; ?>
</div>
