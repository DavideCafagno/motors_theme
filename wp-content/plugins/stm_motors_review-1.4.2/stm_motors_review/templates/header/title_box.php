<?php

$post_id = get_the_ID();

$show_title_box = 'hide';

$title_style = '';

$title = get_the_title( $post_id );

$alignment                     = get_post_meta( $post_id, 'alignment', true );
$title_style_h1                = array();
$title_style_subtitle          = array();
$title_box_bg_color            = get_post_meta( $post_id, 'title_box_bg_color', true );
$title_box_font_color          = get_post_meta( $post_id, 'title_box_font_color', true );
$title_box_line_color          = get_post_meta( $post_id, 'title_box_line_color', true );
$title_box_custom_bg_image     = get_post_meta( $post_id, 'title_box_custom_bg_image', true );
$sub_title                     = get_post_meta( $post_id, 'sub_title', true );
$breadcrumbs                   = get_post_meta( $post_id, 'breadcrumbs', true );
$breadcrumbs_font_color        = get_post_meta( $post_id, 'breadcrumbs_font_color', true );
$title_box_subtitle_font_color = get_post_meta( $post_id, 'title_box_subtitle_font_color', true );
$sub_title_instead             = get_post_meta( $post_id, 'sub_title_instead', true );

//REVIEW INFO
$selectedCar     = get_post_meta( $post_id, 'review_car', true );
$selectedCarInfo = get_post_meta( $post_id, 'review_car_info' );

$performance = get_post_meta( $post_id, 'performance', true );
$performance = ( ! empty( $performance ) ) ? intval( $performance ) : 0;

$comfort = get_post_meta( $post_id, 'comfort', true );
$comfort = ( ! empty( $comfort ) ) ? intval( $comfort ) : 0;

$interior = get_post_meta( $post_id, 'interior', true );
$interior = ( ! empty( $interior ) ) ? intval( $interior ) : 0;

$exterior = get_post_meta( $post_id, 'exterior', true );
$exterior = ( ! empty( $exterior ) ) ? intval( $exterior ) : 0;

$ratingSumm = ( ( $performance + $comfort + $interior + $exterior ) / 4 );

if ( $title_box_bg_color ) {
	$title_style .= 'background-color: ' . $title_box_bg_color . ';';
}

if ( $title_box_font_color ) {
	$title_style_h1['font_color'] = 'color: ' . $title_box_font_color . ';';
}

if ( $title_box_subtitle_font_color ) {
	$title_style_subtitle['font_color'] = 'color: ' . $title_box_subtitle_font_color . ';';
}

$title_box_custom_bg_image = wp_get_attachment_image_src( $title_box_custom_bg_image, 'full' );
if ( 0 === $selectedCar && $title_box_custom_bg_image ) {
	$title_style .= "background-image: url('" . $title_box_custom_bg_image[0] . "');";
}

if ( 0 !== $selectedCar ) {
	$title_style .= "background-image: url('" . get_the_post_thumbnail_url( $selectedCar, 'full' ) . "');";
}

if ( get_the_post_thumbnail_url( $post_id, 'full' ) !== null ) {
	$title_style .= "background-image: url('" . get_the_post_thumbnail_url( $post_id, 'full' ) . "');";
}

$show_title_box = get_post_meta( $post_id, 'title', true );

$show_title_box = ( 'hide' === $show_title_box ) ? false : true;

$additional_classes = '';

if ( empty( $sub_title ) && empty( $title_box_line_color ) ) {
	$additional_classes = ' small_title_box';
}

$titlePrefix = get_post_meta( $post_id, 'review_title_prefix', true );

if ( $show_title_box ) {
	$disable_overlay = '';
	?>
	<div class="stm-motors-review-header entry-header <?php echo esc_attr( $alignment . $additional_classes . $disable_overlay ); ?>" style="<?php echo esc_attr( apply_filters( 'stm_mr_style_filter', $title_style ) ); ?>">
		<div class="container">
			<div class="left">
				<div class="review-title">
					<h2 style="<?php echo esc_attr( implode( ' ', $title_style_h1 ) ); ?>">
						<span class="stm-review-blue"><?php echo esc_html( $titlePrefix ); ?></span>
						<?php echo esc_html( ( ! empty( $sub_title_instead ) && stm_is_motorcycle() ) ? balanceTags( $sub_title_instead, true ) : balanceTags( $title, true ) ); ?>
					</h2>
					<?php if ( $title_box_line_color ) : ?>
						<div class="colored-separator">
							<div class="first-long"
								<?php if ( ! empty( $title_box_line_color ) ) : ?>
									style="background-color: <?php echo esc_attr( $title_box_line_color ); ?>"
								<?php endif; ?>
							></div>
							<div class="last-short"
								<?php if ( ! empty( $title_box_line_color ) ) : ?>
									style="background-color: <?php echo esc_attr( $title_box_line_color ); ?>"
								<?php endif; ?>
							></div>
						</div>
					<?php endif; ?>
					<?php
					if ( $sub_title && ! is_search() ) {
						?>
						<div class="sub-title h5" style="<?php echo esc_attr( implode( ' ', $title_style_subtitle ) ); ?>"><?php echo esc_html( balanceTags( $sub_title, true ) ); ?></div>
						<?php
					}
					?>
				</div>
				<div class="car-info-wrap">
					<?php
					if ( $selectedCarInfo && isset( $selectedCarInfo[0] ) && ! empty( $selectedCarInfo[0] ) ) :
						foreach ( $selectedCarInfo[0] as $k => $val ) :
							$termName = review_get_terms_array( $selectedCar, $val, 'name' );
							?>
							<div class="car-info">
								<?php $rev_icon_name = ( strpos( $val, 'mpg' ) !== false ) ? 'fuel' : $val; ?>
								<i class="rev-icon-<?php echo esc_attr( $rev_icon_name ); ?>"></i>
								<div class="car-info-text">
									<div class="title normal-font"><?php echo esc_html( getCarInfoTitle( $val ) ); ?></div>
									<?php if ( 'msrp' !== $val ) : ?>
										<?php $car_info_desc = ( count( $termName ) !== 0 ) ? $termName[0] : get_post_meta( $selectedCar, $val, true ); ?>
										<div class="desc heading-font"><?php echo esc_html( $car_info_desc ); ?></div>
									<?php else : ?>
										<div class="desc heading-font"><?php echo esc_html( stm_listing_price_view( get_post_meta( $selectedCar, 'stm_genuine_price', true ) ) ); ?></div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="right">
				<div class="rating">
					<div class="rating-stars">
						<i class="rating-empty"></i>
						<?php $ratSumm = $ratingSumm * 20; ?>
						<i class="rating-color" style="width: <?php echo esc_attr( $ratSumm ); ?>%;"></i>
					</div>
					<div class="rating-text heading-font">
						<?php echo sprintf( esc_html__( 'OVERALL RATING %s of 5.0', 'stm_motors_review' ), esc_html( $ratingSumm ) ); ?>
					</div>
				</div>
				<ul class="rating-params">
					<li>
						<span><?php echo esc_html__( 'Performance', 'stm_motors_review' ); ?></span>
						<div class="rating-pb-wrap">
							<div class="rating-prog-bar" <?php echo 'style="width: ' . esc_attr( 20 * $performance ) . '%;"'; ?>></div>
						</div>
						<span><?php echo sprintf( esc_html__( '%s of 5.0', 'stm_motors_review' ), esc_html( $performance ) ); ?></span>
					</li>
					<li>
						<span><?php echo esc_html__( 'Comfort', 'stm_motors_review' ); ?></span>
						<div class="rating-pb-wrap">
							<div class="rating-prog-bar" <?php echo 'style="width: ' . esc_attr( 20 * $comfort ) . '%;"'; ?>></div>
						</div>
						<span><?php echo sprintf( esc_html__( '%s of 5.0', 'stm_motors_review' ), esc_html( $comfort ) ); ?></span>
					</li>
					<li>
						<span><?php echo esc_html__( 'Interior', 'stm_motors_review' ); ?></span>
						<div class="rating-pb-wrap">
							<div class="rating-prog-bar" <?php echo 'style="width: ' . esc_attr( 20 * $interior ) . '%;"'; ?>></div>
						</div>
						<span><?php echo sprintf( esc_html__( '%s of 5.0', 'stm_motors_review' ), esc_html( $interior ) ); ?></span>
					</li>
					<li>
						<span><?php echo esc_html__( 'Exterior', 'stm_motors_review' ); ?></span>
						<div class="rating-pb-wrap">
							<div class="rating-prog-bar" <?php echo 'style="width: ' . esc_attr( 20 * $exterior ) . '%;"'; ?>></div>
						</div>
						<span><?php echo sprintf( esc_html__( '%s of 5.0', 'stm_motors_review' ), esc_html( $exterior ) ); ?></span>
					</li>
				</ul>
			</div>
		</div>
	</div>
<?php } ?>
	<!-- Breads -->
<?php
if ( 'hide' !== $breadcrumbs ) :
	if ( function_exists( 'bcn_display' ) ) {
		?>
		<div class="stm_breadcrumbs_unit heading-font">
			<div class="container">
				<div class="navxtBreads">
					<?php bcn_display(); ?>
				</div>
			</div>
		</div>
		<?php
	}
endif;
