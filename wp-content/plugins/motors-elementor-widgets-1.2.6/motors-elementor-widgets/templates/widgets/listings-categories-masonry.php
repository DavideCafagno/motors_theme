<?php
/**
 * @var $title
 * @var $loop
 * @var $click_drag
 * @var $autoplay
 * @var $transition_speed
 * @var $delay
 * @var $pause_on_mouseover
 * @var $reverse
 * @var $navigation
 * @var $show_as_carousel
 * @var $taxonomy
 * @var $items
 */

$slider_options    = compact(
	'loop',
	'click_drag',
	'autoplay',
	'transition_speed',
	'delay',
	'pause_on_mouseover',
	'reverse',
	'navigation',
);
$cover_image_sizes = array(
	'stm-img-445-255',
	'stm-img-635-255',
);
$uniqid            = uniqid();
?>

<div class="stm-image-filter-wrap stm-image-filter-wrap-<?php echo esc_attr( $uniqid ); ?>">
	<?php if ( ! empty( $title ) || ( $show_as_carousel && $navigation ) ) : ?>
		<div class="title">
			<?php if ( ! empty( $title ) ) : ?>
				<h2><?php echo wp_kses_post( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( $show_as_carousel && $navigation ) : ?>
				<div class="carousel-nav">
					<div class="carousel-nav-prev"></div>
					<div class="carousel-nav-next"></div>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php
	$swiper_container_class = ( $show_as_carousel ) ? ' swiper swiper-container' : '';
	$swiper_wrapper_class   = ( $show_as_carousel ) ? 'swiper-wrapper' : '';
	$swiper_slide_class     = ( $show_as_carousel ) ? ' swiper-slide' : '';
	?>
	<div class="stm-img-filter-container stm-img-4<?php echo esc_attr( $swiper_container_class ); ?>" data-options="<?php echo esc_attr( wp_json_encode( $slider_options ) ); ?>" data-widget-id="<?php echo esc_attr( $uniqid ); ?>">
		<div class="<?php echo esc_attr( $swiper_wrapper_class ); ?>">

			<div class="carousel-slide<?php echo esc_attr( $swiper_slide_class ); ?>">
				<div class="carousel-container">
					<?php
					foreach ( $items as $key => $item ) :

						$index_in_group   = ( $key % 4 );
						$image_size_index = in_array( $index_in_group, array( 1, 2 ), true ) ? 1 : 0;
						$cover_image      = wp_get_attachment_image_src( $item['image']['id'], $cover_image_sizes[ $image_size_index ] );
						$filter_slug      = ( isset( $item[ 'item_' . $item['taxonomy_type'] ] ) ) ? $item[ 'item_' . $item['taxonomy_type'] ] : false;
						$selected_term    = get_term_by( 'slug', $filter_slug, $item['taxonomy_type'] );
						?>

						<div class="img-filter-item template-4-<?php echo esc_attr( $index_in_group ); ?>">
							<?php if ( $selected_term ) : ?>
								<a href="<?php echo esc_url( stm_get_listing_archive_link( array( $item['taxonomy_type'] => $filter_slug ) ) ); ?>">
							<?php endif; ?>
								<div class="img-wrap">
									<?php if ( $cover_image ) : ?>
										<img src="<?php echo esc_attr( $cover_image[0] ); ?>" width="<?php echo esc_attr( $cover_image[1] ); ?>" height="<?php echo esc_attr( $cover_image[2] ); ?>" />
									<?php endif; ?>
								</div>
							<?php if ( $selected_term ) : ?>
								</a>
								<div class="body-type-data">
									<div class="bt-title heading-font"><?php echo esc_html( $selected_term->name ); ?></div>
									<div class="bt-count normal_font"><?php echo esc_html( $selected_term->count ) . ' ' . esc_html__( 'cars', 'motors-elementor-widgets' ); ?></div>
								</div>
							<?php endif; ?>
						</div>

						<?php if ( 3 === $index_in_group && ( $key < ( count( $items ) - 1 ) ) ) : ?>
				</div>
			</div>
			<div class="carousel-slide<?php echo esc_attr( $swiper_slide_class ); ?>">
				<div class="carousel-container">
						<?php endif; ?>

						<?php
					endforeach;
					?>
				</div>
			</div>

		</div>
	</div>
</div>
