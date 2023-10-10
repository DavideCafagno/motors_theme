<?php
if ( ! empty( $testimonials ) ) :
	$unique_id = 'stm_testimonials_carousel-' . wp_rand( 1, 99999 );

	$thumb_size = 'thumbnail';

	if ( ! empty( $image_size ) ) {
		$exploded = explode( 'x', $image_size );

		if ( ! empty( $exploded ) && ! empty( $exploded[0] ) && is_numeric( $exploded[0] ) && ! empty( $exploded[1] ) && is_numeric( $exploded[1] ) ) {
			$thumb_size = array( intval( $exploded[0] ), intval( $exploded[1] ) );
		} else {
			$thumb_size = $image_size;
		}
	}

	if ( empty( $title_heading ) ) {
		$title_heading = 'h4';
	}

	?>
	<div class="stm-testimonials-carousel-wrapper swiper-container <?php echo esc_attr( $view_style ); ?>" id="<?php echo esc_attr( $unique_id ); ?>">
		<div class="elementor-testimonials-carousel swiper-wrapper">
			<?php
			foreach ( $testimonials as $testimonial ) :
				$thumbnail_img = null;

				if ( ! empty( $testimonial['image'] ) && ! empty( $testimonial['image']['id'] ) ) {
					if ( is_array( $thumb_size ) ) {
						$thumbnail_img = \STM_E_W\Helpers\Helper::stm_ew_resize_image( $testimonial['image']['id'], null, $thumb_size[0], $thumb_size[1] );
					} else {
						$thumbnail_img = wp_get_attachment_image_src( $testimonial['image']['id'], $thumb_size );
					}
				}

				?>
				<div class="testimonial-unit swiper-slide">
					<?php
					if ( 'style_1' === $view_style ) {
						?>
						<div class="clearfix">
							<?php
							if ( is_array( $thumbnail_img ) && ! empty( $thumbnail_img[0] ) ) :
								?>
								<div class="image">
									<img src="<?php echo esc_attr( $thumbnail_img[0] ); ?>" alt="<?php esc_html_e( 'Testimonial photo', 'motors-elementor-widgets' ); ?>">
								</div>
								<?php
							endif;

							if ( stm_is_rental() ) :
								?>
								<div class="testimonial-info">
									<?php if ( ! empty( $testimonial['author_name'] ) ) : ?>
										<div class="author heading-font">
											<?php echo esc_attr( $testimonial['author_name'] ); ?>
										</div>
									<?php endif; ?>


									<?php if ( ! empty( $testimonial['vehicle_model'] ) ) : ?>
										<div class="author-car">
											<?php
											if ( ! empty( $testimonial['icon'] ) && ! empty( $testimonial['icon']['value'] ) ) :
												if ( 'svg' === $testimonial['icon']['library'] && ! empty( $testimonial['icon']['value']['url'] ) ) :
													?>
													<img src="<?php echo esc_attr( $testimonial['icon']['value']['url'] ); ?>" class="svg-icon" alt="<?php esc_html_e( 'SVG icon', 'motors-elementor-widgets' ); ?>">
												<?php else : ?>
													<i class="stm-testimonial-icon <?php echo esc_attr( $testimonial['icon']['value'] ); ?>"></i>
														<?php
												endif;
											endif;
											?>
											<span><?php echo esc_html( $testimonial['vehicle_model'] ); ?></span>
										</div>
									<?php endif; ?>
								</div>
								<?php
							endif;
							?>

							<div class="content">
								<?php if ( ! empty( $testimonial['title'] ) ) : ?>
									<<?php echo esc_attr( $title_heading ); ?> class="title">
										<?php echo esc_html( $testimonial['title'] ); ?>
									</<?php echo esc_attr( $title_heading ); ?>>
								<?php endif; ?>
								<?php echo wp_kses_post( $testimonial['content'] ); ?>
							</div>
						</div>

						<?php
						if ( ! stm_is_rental() ) :
							?>
							<div class="testimonial-meta">
								<?php if ( ! empty( $testimonial['author_name'] ) ) : ?>
									<div class="author heading-font">
										<?php echo esc_attr( $testimonial['author_name'] ); ?>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $testimonial['vehicle_model'] ) ) : ?>
									<div class="author-car">
										<?php
										if ( ! empty( $testimonial['icon'] ) && ! empty( $testimonial['icon']['value'] ) ) :
											if ( 'svg' === $testimonial['icon']['library'] && ! empty( $testimonial['icon']['value']['url'] ) ) :
												?>
												<img src="<?php echo esc_attr( $testimonial['icon']['value']['url'] ); ?>" class="svg-icon" alt="<?php esc_html_e( 'SVG icon', 'motors-elementor-widgets' ); ?>">
											<?php else : ?>
												<i class="stm-testimonial-icon <?php echo esc_attr( $testimonial['icon']['value'] ); ?>"></i>
													<?php
											endif;
										endif;
										?>
										<span><?php echo esc_html( $testimonial['vehicle_model'] ); ?></span>
									</div>
								<?php endif; ?>
							</div>
							<?php
						endif;
					} else {
						?>
						<div class="clearfix">
							<?php if ( is_array( $thumbnail_img ) && ! empty( $thumbnail_img[0] ) ) : ?>
								<div class="image">
								<img src="<?php echo esc_attr( $thumbnail_img[0] ); ?>" alt="<?php esc_html_e( 'Testimonial photo', 'motors-elementor-widgets' ); ?>">
								</div>
							<?php endif; ?>
							<div class="author_info">
								<div class="author_name heading-font"><?php echo esc_html( $testimonial['author_name'] ); ?></div>
								<div class="author_position heading-font"><?php echo ( ! empty( $testimonial['author_position'] ) ) ? esc_html( $testimonial['author_position'] ) : ''; ?></div>
							</div>
							<div class="content normal_font">
								<?php if ( ! empty( $testimonial['title'] ) ) : ?>
									<<?php echo esc_attr( $title_heading ); ?> class="title">
										<?php echo esc_html( $testimonial['title'] ); ?>
									</<?php echo esc_attr( $title_heading ); ?>>
								<?php endif; ?>
								<?php echo wp_kses_post( $testimonial['content'] ); ?>
							</div>
							<?php
							if ( ! empty( $testimonial['icon'] ) && ! empty( $testimonial['icon']['value'] ) ) :
								if ( 'svg' === $testimonial['icon']['library'] && ! empty( $testimonial['icon']['value']['url'] ) ) :
									?>
									<img src="<?php echo esc_attr( $testimonial['icon']['value']['url'] ); ?>" class="svg-icon" alt="<?php esc_html_e( 'SVG icon', 'motors-elementor-widgets' ); ?>">
								<?php else : ?>
									<i class="stm-testimonial-icon <?php echo esc_attr( $testimonial['icon']['value'] ); ?>"></i>
										<?php
								endif;
							endif;
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			endforeach;
			?>
		</div>

		<?php if ( ! empty( $navigation ) ) : ?>
			<div class="stm-swiper-controls">
				<div class="stm-swiper-prev"><i class="fas fa-angle-left"></i></div>
				<div class="stm-swiper-next"><i class="fas fa-angle-right"></i></div>
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
				spaceBetween: 20,
				centerInsufficientSlides: true,
				breakpoints: {
					768: {
						slidesPerView: <?php echo esc_attr( intval( $tablet_items ) ); ?>,
					},
					1024: {
						slidesPerView: <?php echo esc_attr( intval( $desktop_items ) ); ?>,
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
