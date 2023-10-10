<?php
if ( ! empty( $images ) ) :
	$thumb_size = 'thumbnail';

	if ( ! empty( $image_size ) ) {
		$exploded = explode( 'x', $image_size );

		if ( ! empty( $exploded ) && ! empty( $exploded[0] ) && is_numeric( $exploded[0] ) && ! empty( $exploded[1] ) && is_numeric( $exploded[1] ) ) {
			$thumb_size = array( intval( $exploded[0] ), intval( $exploded[1] ) );
		} else {
			$thumb_size = $image_size;
		}
	}

	$unique_id = 'stm_image_carousel-' . wp_rand( 1, 99999 );
	?>
	<div class="motors-elementor-widget stm_image_carousel swiper-container" id="<?php echo esc_attr( $unique_id ); ?>">
		<div class="swiper-wrapper">
			<?php
			if ( ! empty( $images ) ) :
				foreach ( $images as $image ) :

					if ( is_array( $thumb_size ) ) {
						$thumbnail_img = \STM_E_W\Helpers\Helper::stm_ew_resize_image( $image['id'], null, $thumb_size[0], $thumb_size[1] );
					} else {
						$thumbnail_img = wp_get_attachment_image_src( $image['id'], $thumb_size );
					}

					if ( ! empty( $thumbnail_img[0] ) ) {
						$thumbnail_img = $thumbnail_img[0];
					} else {
						$thumbnail_img = '';
					}

					?>
					<div class="swiper-slide">
						<?php if ( ! empty( $lightbox ) && 'yes' === $lightbox ) : ?>
						<a class="stm_fancybox" href="<?php echo esc_attr( $image['url'] ); ?>"
							title="<?php esc_html_e( 'Image full version', 'motors-elementor-widgets' ); ?>"
							rel="<?php echo esc_attr( $unique_id ); ?>">
						<?php endif; ?>
							<img src="<?php echo esc_attr( $thumbnail_img ); ?>" alt="<?php esc_html_e( 'Gallery image', 'motors-elementor-widgets' ); ?>">
						<?php if ( ! empty( $lightbox ) && 'yes' === $lightbox ) : ?>
						</a>
						<?php endif; ?>
					</div>
					<?php
				endforeach;
			endif;
			?>
		</div>

		<?php if ( ! empty( $navigation ) || ! empty( $pagination ) ) : ?>
			<div class="stm-swiper-controls">
				<?php if ( ! empty( $navigation ) && 'yes' === $navigation ) : ?>
					<div class="stm-swiper-prev"><i class="fas fa-angle-left"></i></div>
				<?php endif; ?>
				<?php if ( ! empty( $pagination ) && 'yes' === $pagination ) : ?>
					<div class="swiper-pagination"></div>
				<?php endif; ?>
				<?php if ( ! empty( $navigation ) && 'yes' === $navigation ) : ?>
					<div class="stm-swiper-next"><i class="fas fa-angle-right"></i></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<script>
	( function( $ ) {
		"use strict";
		<?php
		$is_elementor_editor = \Elementor\Plugin::$instance->editor->is_edit_mode();
		if ( ! $is_elementor_editor ) :
			?>
		$(window).on('elementor/frontend/init', function() {
		<?php endif; ?>
			let swiper = new Swiper('#<?php echo esc_attr( $unique_id ); ?>', {
				<?php if ( ! empty( $loop ) && 'yes' === $loop ) : ?>
				loop: true,
				<?php endif; ?>

				<?php if ( ! empty( $click_drag ) && 'yes' === $click_drag ) : ?>
					simulateTouch: true,
				<?php else : ?>
					simulateTouch: false,
				<?php endif; ?>

				<?php if ( ! empty( $autoplay ) && 'yes' === $autoplay ) : ?>
					autoplay: {
						<?php if ( ! empty( $delay ) && is_numeric( $delay ) ) : ?>
							delay: <?php echo esc_attr( $delay ); ?>,
						<?php else : ?>
							delay: 3000,
						<?php endif; ?>

						<?php if ( ! empty( $reverse ) && 'yes' === $reverse ) : ?>
							reverseDirection: true,
						<?php endif; ?>
					},
				<?php endif; ?>

				<?php if ( ! empty( $transition_speed ) && is_numeric( $transition_speed ) ) : ?>
					speed: <?php echo esc_attr( $transition_speed ); ?>,
				<?php endif; ?>

				<?php if ( ! empty( $slides_per_transition ) && is_numeric( $slides_per_transition ) ) : ?>
					slidesPerGroup: <?php echo esc_attr( $slides_per_transition ); ?>,
				<?php endif; ?>

				slidesPerView: 1,

				spaceBetween: 12,

				centerInsufficientSlides: true,

				breakpoints: {
					640: {
						slidesPerView: 3,
					},
					992: {
						slidesPerView: <?php echo esc_attr( intval( $items_per_slide ) ); ?>,
					}
				},
				<?php if ( ! empty( $navigation ) && 'yes' === $navigation ) : ?>
					navigation: {
						nextEl: '.stm-swiper-next',
						prevEl: '.stm-swiper-prev',
					},
				<?php else : ?>
					navigation: false,
				<?php endif; ?>

				<?php if ( ! empty( $pagination ) && 'yes' === $pagination ) : ?>
					pagination: {
						el: '.swiper-pagination',
						clickable: true,
					},
				<?php else : ?>
					pagination: false,
				<?php endif; ?>
			});

			<?php if ( ! empty( $pause ) && 'yes' === $pause ) : ?>
				$('#<?php echo esc_attr( $unique_id ); ?>').hover(function() {
					(this).swiper.autoplay.stop();
				}, function() {
					(this).swiper.autoplay.start();
				});
				<?php
			endif;
			if ( ! $is_elementor_editor ) :
				?>
		});
		<?php endif; ?>
	} ( jQuery ) );
	</script>
	<?php
endif;
