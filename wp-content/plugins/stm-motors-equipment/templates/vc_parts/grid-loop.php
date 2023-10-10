<?php
$gallery_hover_interaction = stm_me_get_wpcfto_mod( 'gallery_hover_interaction', false );
$dynamic_class_photo       = 'stm-car-photos-' . get_the_ID() . '-' . wp_rand( 1, 99999 );
$dynamic_class_video       = 'stm-car-videos-' . get_the_ID() . '-' . wp_rand( 1, 99999 );
$image_size                = 'stm-img-350-205';
$show_compare              = stm_me_get_wpcfto_mod( 'show_listing_compare', false );
$car_media                 = stm_get_car_medias( get_the_id() );

?>
<div class="dp-in">
	<div class="listing-car-item">
		<div class="listing-car-item-inner">
			<a href="<?php the_permalink(); ?>" class="rmv_txt_drctn" title="
			<?php
			esc_attr_e( 'Watch full information about', 'stm_motors_equipment' );
			echo esc_attr( ' ' . get_the_title() );
			?>
			">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="text-center">
						<?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size ); ?>
						<?php $img_2x = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'stm-img-796-466' ); ?>
						<div class="image dp-in">

							<?php
							if ( true === $gallery_hover_interaction ) {
								$thumbs = stm_get_hoverable_thumbs( get_the_ID(), $image_size );
								if ( empty( $thumbs['gallery'] ) || 1 === count( $thumbs['gallery'] ) ) :
									?>
									<img src="<?php echo esc_url( $img[0] ); ?>" data-retina="<?php echo esc_url( $img_2x[0] ); ?>" class="img-responsive" alt="<?php the_title(); ?>">
									<?php
									stm_equipment_load_template( 'vc_parts/badge' );
								else :
									$array_keys    = array_keys( $thumbs['gallery'] );
									$last_item_key = array_pop( $array_keys );
									?>
									<div class="interactive-hoverable">
										<div class="hoverable-wrap">
											<?php foreach ( $thumbs['gallery'] as $key => $img_url ) : ?>
												<div class="hoverable-unit <?php echo ( 0 === $key ) ? 'active' : ''; ?>">
													<div class="thumb">
														<?php if ( $key === $last_item_key && 5 === count( $thumbs['gallery'] ) && 0 < $thumbs['remaining'] ) : ?>
															<div class="remaining">
																<i class="stm-icon-album"></i>
																<p>
																	<?php
																		echo esc_html(
																			sprintf(
																				/* translators: number of remaining photos */
																				_n( '%d more photo', '%d more photos', $thumbs['remaining'], 'stm_motors_equipment' ),
																				$thumbs['remaining']
																			)
																		);
																	?>
																</p>
															</div>
														<?php endif; ?>
														<?php if ( is_array( $img_url ) ) : ?>
															<img
																	data-src="<?php echo esc_url( $img_url[0] ); ?>"
																	srcset="<?php echo esc_url( $img_url[0] ); ?> 1x, <?php echo esc_url( $img_url[1] ); ?> 2x"
																	src="<?php echo esc_url( $img_url[0] ); ?>"
																	class="lazy img-responsive"
																	alt="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>" >
														<?php else : ?>
															<img src="<?php echo esc_url( $img_url ); ?>" class="lazy img-responsive" alt="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>" >
														<?php endif; ?>
													</div>
												</div>
												<?php
											endforeach;

											stm_equipment_load_template( 'vc_parts/badge' );
											?>
										</div>
										<div class="hoverable-indicators">
											<?php
											$first = true;
											foreach ( $thumbs['gallery'] as $thumb ) :
												?>
												<div class="indicator <?php echo ( $first ) ? 'active' : ''; ?>"></div>
												<?php
												$first = false;
											endforeach;
											?>
										</div>
									</div>
									<?php
								endif;
							} else {
								?>
								<img src="<?php echo esc_url( $img[0] ); ?>" data-retina="<?php echo esc_url( $img_2x[0] ); ?>" class="img-responsive" alt="<?php the_title(); ?>">
								<?php
								stm_equipment_load_template( 'vc_parts/badge' );
							}
							?>
							<div class="stm-car-medias">
								<?php if ( ! empty( $car_media['car_photos_count'] ) ) : ?>
									<div class="stm-listing-photos-unit stm-car-photos-<?php echo esc_attr( get_the_ID() ); ?> <?php echo esc_attr( $dynamic_class_photo ); ?>">
										<i class="stm-service-icon-photo"></i>
										<span><?php echo esc_html( $car_media['car_photos_count'] ); ?></span>
									</div>

									<script>
										jQuery(document).ready(function(){
											jQuery(".<?php echo esc_attr( $dynamic_class_photo ); ?>").on('click', function(e) {
												e.preventDefault();
												jQuery(this).lightGallery({
													dynamic: true,
													dynamicEl: [
														<?php foreach ( $car_media['car_photos'] as $car_photo ) : ?>
														{
															src  : "<?php echo esc_url( $car_photo ); ?>",
															thumb: "<?php echo esc_url( $car_photo ); ?>",
														},
														<?php endforeach; ?>
													],
													download: false,
													mode: 'lg-fade',
												})
											});
										});

									</script>
								<?php endif; ?>
								<?php if ( ! empty( $car_media['car_videos_count'] ) ) : ?>
									<div class="stm-listing-videos-unit stm-car-videos-<?php echo esc_attr( get_the_ID() ); ?> <?php echo esc_attr( $dynamic_class_video ); ?>">
										<i class="fas fa-film"></i>
										<span><?php echo esc_html( $car_media['car_videos_count'] ); ?></span>
									</div>

									<script>
										jQuery(document).ready(function(){

											jQuery(".<?php echo esc_attr( $dynamic_class_video ); ?>").on('click', function(e) {
												e.preventDefault();

												jQuery(this).lightGallery({
													dynamic: true,
													dynamicEl: [
														<?php foreach ( $car_media['car_videos'] as $car_video ) : ?>
														{
															src  : "<?php echo esc_url( $car_video ); ?>"
														},
														<?php endforeach; ?>
													],
													download: false,
													mode: 'lg-fade',
												})
											}); //click
										}); //ready

									</script>
								<?php endif; ?>
							</div>

							<?php
							$price      = get_post_meta( get_the_id(), 'price', true );
							$sale_price = get_post_meta( get_the_id(), 'sale_price', true );

							$rent_price      = get_post_meta( get_the_id(), 'rent_price', true );
							$rent_sale_price = get_post_meta( get_the_id(), 'rent_sale_price', true );

							$price_label = esc_html__( 'Sale price', 'stm_motors_equipment' );
							$price       = ( ! empty( $sale_price ) ) ? $sale_price : $price;

							if ( ! empty( $_GET['listing-type'] ) && 'for-rent' === $_GET['listing-type'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
								$price_label = esc_html__( 'Rent price', 'stm_motors_equipment' );
								$price       = $rent_price;

								if ( ! empty( $rent_sale_price ) ) {
									$price_label = $rent_price;
									$price       = $rent_sale_price;
								}
							}
							$car_price_form_label = get_post_meta( get_the_ID(), 'car_price_form_label', true );

							?>
							<?php if ( ! empty( $car_price_form_label ) ) : ?>
							<div class="price ">
								<div class="sale-price heading-font"><?php echo esc_attr( $car_price_form_label ); ?></div>
							</div>
							<?php else : ?>
								<div class="price">
									<div class="title-price heading-font">
										<?php echo esc_html( $price_label ); ?>
									</div>
									<div class="sale-price heading-font">
										<?php echo esc_attr( stm_listing_price_view( $price ) ); ?>
									</div>
								</div>
							<?php endif; ?>
							<!--Compare-->
							<?php if ( ! empty( $show_compare ) && $show_compare ) : ?>
								<div class="stm-listing-compare stm-compare-directory-new"
									data-id="<?php echo esc_attr( get_the_id() ); ?>"
									data-post-type="<?php echo esc_attr( get_post_type( get_the_ID() ) ); ?>"
									data-title="<?php echo esc_attr( stm_generate_title_from_slugs( get_the_id(), false ) ); ?>"
									data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e( 'Add to compare', 'stm_motors_equipment' ); ?>"
								>
									<i class="stm-service-icon-compare-new"></i><?php echo esc_html__( 'Compare', 'stm_motors_equipment' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="listing-car-item-meta">
					<div class="car-meta-top heading-font clearfix">
						<?php
						$subtitle  = '';
						$body      = wp_get_post_terms( get_the_ID(), 'body', array( 'fields' => 'names' ) );
						$subtitle .= ( $body ) ? '<span>' . $body[0] . '</span>' : '';
						?>
						<div class="car-subtitle heading-font">
							<?php echo wp_kses_post( $subtitle ); ?>
						</div>
						<div class="car-title">
							<?php echo wp_kses_post( stm_generate_title_from_slugs( get_the_id(), true ) ); ?>
						</div>
					</div>
					<div class="car-meta-bottom">
						<?php
						$stock = get_post_meta( get_the_ID(), 'stock_number', true );
						$hours = get_post_meta( get_the_ID(), 'hours', true );

						$hours = ( ! empty( $hours ) ) ? $hours : 0;
						?>
						<div class="stock-wrap">
							<?php echo '<span>' . esc_html__( 'Stock#', 'stm_motors_equipment' ) . '</span> ' . esc_html( $stock ); ?>
						</div>
						<div class="hours-wrap">
							<?php echo '<span>' . esc_html__( 'Hours:', 'stm_motors_equipment' ) . '</span> ' . esc_html( $hours ); ?>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
