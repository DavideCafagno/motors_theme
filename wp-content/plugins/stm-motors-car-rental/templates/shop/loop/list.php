<?php
global $product;
$stm_id = get_the_ID();

if ( is_product() ) {
	$product = new WC_Product( get_the_ID() );
}

if ( is_cart() ) {
	$cart_items = stm_get_cart_items();
	$stm_id     = $cart_items['car_class']['id'];
	$product    = new WC_Product( $stm_id );
}

if ( empty( $product ) ) {
	return;
}

$has_gallery    = ( ! empty( $product->get_gallery_image_ids() ) ) ? array_chunk( $product->get_gallery_image_ids(), 3 ) : array();
$product_attrs  = stm_mcr_get_product_atts( $product );
$excerpt        = get_the_excerpt( $stm_id );
$current_car    = stm_get_cart_items();
$current_car_id = 0;

if ( ! empty( $current_car['car_class'] ) ) {
	if ( ! empty( $current_car['car_class']['id'] ) ) {
		$current_car_id = $current_car['car_class']['id'];
	}
}

$current_car = '';
if ( $stm_id === $current_car_id ) {
	$current_car = 'current_car';
}

$dates              = ( isset( $_COOKIE[ 'stm_calc_pickup_date_' . get_current_blog_id() ] ) ) ? stm_check_order_available( $stm_id, urldecode( sanitize_text_field( $_COOKIE[ 'stm_calc_pickup_date_' . get_current_blog_id() ] ) ), urldecode( sanitize_text_field( $_COOKIE[ 'stm_calc_return_date_' . get_current_blog_id() ] ) ) ) : array();
$disable_car        = ( count( $dates ) > 0 ) ? 'stm-disable-car' : '';
$disable_button     = ( count( $dates ) > 0 ) ? 'stm-disable-pay-btn' : '';
$invisible_block_id = 'stm-invisible-' . wp_rand( 1, 99999 );

?>
	<div class="smt-cr-list-loop-wrap stm-cr-reservation-page <?php echo esc_attr( $invisible_block_id ); ?> <?php echo esc_attr( $disable_car ); ?>"
		id="product-<?php echo esc_attr( $stm_id ); ?>">
		<div class="reserv-visible-block">
			<div class="reserv-car-info-wrap">
				<div class="car-info-top">
					<div class="car-preview-img">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="image">
								<?php the_post_thumbnail( 'stm-img-350-181', array( 'class' => 'img-responsive' ) ); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="car-data">
						<?php if ( isset( $product_attrs['attribute_pa_vehicle-class'] ) ) : ?>
							<div class="car-class-wrap">
								<div class="car-class">
									<?php echo wp_kses_post( $product_attrs['attribute_pa_vehicle-class']['value'] ); ?>
								</div>
							</div>
						<?php endif; ?>
						<h3><?php the_title(); ?></h3>
						<div class="stm-mcr-similat-text"><?php echo esc_html__( 'or similar', 'stm_motors_car_rental' ); ?></div>
					</div>
				</div>
				<div class="car-info-middle">
					<?php if ( ! empty( $disable_car ) ) : ?>
						<div class="stm-enable-car-date">
							<?php
							$formatted_dates = array();
							foreach ( $dates as $val ) {
								$formatted_dates[] = stm_get_formated_date( $val, 'd M' );
							}
							?>
							<h3>
								<?php echo esc_html__( 'This Class is already booked in: ', 'stm_motors_car_rental' ) . "<span class='yellow'>" . esc_html( implode( ', ', $formatted_dates ) ) . '</span>'; ?>
							</h3>
						</div>
					<?php endif; ?>
				</div>
				<div class="car-info-bottom">
					<ul>
						<?php
						$i = 0;
						foreach ( $product_attrs as $attr ) {
							if ( $attr['show'] && $i < 5 ) {
								?>
								<li>
									<div class="attr-img">
										<img src="<?php echo esc_url( $attr['img'] ); ?>"/>
									</div>
									<div class="attr-value">
										<?php echo wp_kses_post( apply_filters( 'stm_mcr_lmth', $attr['value'] ) ); ?>
									</div>
								</li>
								<?php
								$i++;
							}
						}
						?>
						<li class="view-all-specific" data-invis="<?php echo esc_attr( $invisible_block_id ); ?>"
							data-tab="<?php echo esc_attr( 'specific-' . $stm_id ); ?>">
							<i class="fas fa-chevron-right"></i>
							<span><?php echo esc_html__( 'View All Specifications', 'stm_motors_car_rental' ); ?></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="reserv-price-wrap">
				<?php
				stm_car_rental_load_template(
					'shop/parts/price-view',
					array(
						'is_add_to_cart' => false,
						'invis_id'       => $invisible_block_id,
						'disableBtns'    => $disable_button,
					)
				);
				?>
			</div>
		</div>
		<?php
		$extra_opts   = 'extra-opt-' . $stm_id;
		$terms        = 'terms-' . $stm_id;
		$specific     = 'specific-' . $stm_id;
		$gallery      = 'gallery-' . $stm_id;
		$stm_comments = 'comments-' . $stm_id;
		?>
		<div id="<?php echo esc_attr( $invisible_block_id ); ?>" class="reserv-invisible-block">
			<div class="tabs-wrapper">
				<ul class="nav nav-tabs" id="myTab<?php echo '-' . esc_attr( $stm_id ); ?>" role="tabreserv">
					<li class="nav-item active">
						<a class="nav-link" id="<?php echo esc_attr( $extra_opts ); ?>-tab" data-toggle="tab"
							href="#<?php echo esc_attr( $extra_opts ); ?>" role="tab"
							aria-controls="<?php echo esc_attr( $extra_opts ); ?>" aria-selected="true">
							<?php echo esc_html__( 'Extra Options', 'stm_motors_car_rental' ); ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="<?php echo esc_attr( $terms ); ?>-tab" data-toggle="tab"
							href="#<?php echo esc_attr( $terms ); ?>" role="tab"
							aria-controls="<?php echo esc_attr( $terms ); ?>" aria-selected="false">
							<?php echo esc_html__( 'Rental Terms', 'stm_motors_car_rental' ); ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="<?php echo esc_attr( $specific ); ?>-tab" data-toggle="tab"
							href="#<?php echo esc_attr( $specific ); ?>" role="tab"
							aria-controls="<?php echo esc_attr( $specific ); ?>" aria-selected="false">
							<?php echo esc_html__( 'All Specifications', 'stm_motors_car_rental' ); ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="<?php echo esc_attr( $gallery ); ?>-tab" data-toggle="tab"
							href="#<?php echo esc_attr( $gallery ); ?>" role="tab"
							aria-controls="<?php echo esc_attr( $gallery ); ?>" aria-selected="false">
							<?php echo esc_html__( 'Image Gallery', 'stm_motors_car_rental' ); ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="<?php echo esc_attr( $stm_comments ); ?>-tab" data-toggle="tab"
							href="#<?php echo esc_attr( $stm_comments ); ?>" role="tab"
							aria-controls="<?php echo esc_attr( $stm_comments ); ?>" aria-selected="false">
							<?php echo esc_html__( 'Comments', 'stm_motors_car_rental' ); ?>
						</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade active in" id="<?php echo esc_attr( $extra_opts ); ?>" role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $extra_opts ); ?>-tab">
						<?php stm_car_rental_load_template( 'shop/tabs/car-options', array( 'invisId' => $invisible_block_id ) ); ?>
					</div>
					<div class="tab-pane fade" id="<?php echo esc_attr( $terms ); ?>" role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $terms ); ?>-tab">
						<?php
						$excerpt = get_the_excerpt( $stm_id );
						echo wp_kses_post( apply_filters( 'the_content', $excerpt ) );
						?>
					</div>
					<div class="tab-pane fade" id="<?php echo esc_attr( $specific ); ?>" role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $specific ); ?>-tab">
						<?php stm_car_rental_load_template( 'shop/tabs/specifications', $product_attrs ); ?>
					</div>
					<div class="tab-pane fade" id="<?php echo esc_attr( $gallery ); ?>" role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $gallery ); ?>-tab">
						<?php
						if ( $has_gallery ) {
							stm_car_rental_load_template( 'shop/tabs/gallery', $has_gallery );
						} else {
							echo '<h3>' . esc_html__( 'No Images', 'stm_motors_car_rental' ) . '</h3>';
						}
						?>
					</div>
					<div class="tab-pane fade" id="<?php echo esc_attr( $stm_comments ); ?>" role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $stm_comments ); ?>-tab">
						<?php
						if ( function_exists( 'wc_get_template_part' ) ) {
							wc_get_template_part( 'single-product-reviews' );
						}
						?>
					</div>
				</div>
				<div class="close-invisible" data-invis-id="<?php echo esc_attr( $invisible_block_id ); ?>">
					<i class="stm-carent-rental-ico-plus"></i>
				</div>
			</div>
			<div class="add-to-cart-btns">
				<?php
				stm_car_rental_load_template(
					'shop/parts/price-view',
					array(
						'is_add_to_cart' => true,
						'disableBtns'    => $disable_button,
					)
				);
				?>
			</div>
		</div>
	</div>
