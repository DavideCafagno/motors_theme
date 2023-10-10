<?php
$is_elementor_editor            = \Elementor\Plugin::$instance->editor->is_edit_mode();
$args['order']                  = 'DESC';
$args['orderby']                = 'date';
$args['meta_query']['relation'] = 'AND';
$args['post_type']              = ( $is_elementor_editor ) ? stm_listings_post_type() : get_post_type();

require get_template_directory() . '/partials/inventory-search-results-query.php';

$listings  = new WP_Query( $args );
$unique_id = 'elementor-inventory-search-results-' . wp_rand( 1, 99999 );

if ( stm_is_multilisting() ) {
	$back_inventory_link = stm_get_inventory_page_url( $args['post_type'] );
}
?>

<div class="motors-elementor-search-results-wrap swiper-container" id="<?php echo esc_attr( $unique_id ); ?>">
	<div class="navigation-controls">
		<div class="back-search-results heading-font">
			<a href="<?php echo esc_url( $back_inventory_link ); ?>">
				<h4><i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Search results', 'motors-elementor-widgets' ); ?></h4>
			</a>
		</div>
		<div class="next-prev-controls">
			<div class="stm-isearch-prev"><i class="fas fa-angle-left"></i></div>
			<div class="stm-isearch-next"><i class="fas fa-angle-right"></i></div>
		</div>
	</div>

	<div class="stm-isearch-results-carousel car-listing-row swiper-wrapper tablet_<?php echo esc_attr( $tablet_items_count ); ?> desktop_<?php echo esc_attr( $desktop_items_count ); ?>">

		<?php
		if ( $listings->have_posts() ) :
			$current_vehicle_id = get_queried_object_ID();
			while ( $listings->have_posts() ) :
				$listings->the_post();
				?>

				<div class="swiper-slide">
					<?php get_template_part( 'partials/inventory-search-results-carousel-loop', null, array( 'current_vehicle_id' => $current_vehicle_id ) ); ?>
				</div>

				<?php
			endwhile;
		endif;

		wp_reset_postdata();

		?>

	</div>
</div>

<script>
	(function ($) {
		"use strict";
		<?php
		if ( false === $is_elementor_editor ) :
			?>
			$(window).on('elementor/frontend/init', function() {
			<?php
		else :
			?>
			if($('.brazzers-carousel').length > 0) {
				$('.brazzers-carousel').brazzersCarousel();
			}
			<?php
		endif;
		?>

		let search_results_carousel = new Swiper("#<?php echo esc_attr( $unique_id ); ?>", {
			loop: false,
			autoplay: false,
			slidesPerView: 1,
			navigation: false,
			slidesPerGroup: 1,
			<?php if ( ! empty( $transition_speed ) && is_numeric( $transition_speed ) ) : ?>
				speed: <?php echo esc_attr( $transition_speed ); ?>,
			<?php endif; ?>
			<?php if ( ! empty( $click_drag ) && 'yes' === $click_drag ) : ?>
				simulateTouch: true,
			<?php else : ?>
				simulateTouch: false,
			<?php endif; ?>
			slidesPerView: 1,
			breakpoints: {
			320: {
				width: 260,
				spaceBetween: 10,
			},
			480: {
				width: 260,
				spaceBetween: 10,
			},
			768: {
				slidesPerView: <?php echo esc_attr( $tablet_items_count ); ?>.3,
				spaceBetween: 10,
				slidesOffsetBefore: 20,
				slidesOffsetAfter: 20,
			},
			1024: {
				slidesPerView: <?php echo esc_attr( $desktop_items_count ); ?>.3,
				spaceBetween: 10,
				slidesOffsetBefore: 10,
				slidesOffsetAfter: 10,
			}
		}
		});

		$('#<?php echo esc_attr( $unique_id ); ?> .next-prev-controls .stm-isearch-prev').on('click', function(){
			$('#<?php echo esc_attr( $unique_id ); ?> .stm-isearch-next').removeClass('disabled');

			let index = search_results_carousel.activeIndex - 1;
			search_results_carousel.slideTo(index);
		});

		$('#<?php echo esc_attr( $unique_id ); ?> .next-prev-controls .stm-isearch-next').on('click', function(){
			$('#<?php echo esc_attr( $unique_id ); ?> .stm-isearch-prev').removeClass('disabled');

			let index = search_results_carousel.activeIndex + 1;
			search_results_carousel.slideTo(index);
		});

		search_results_carousel.on('reachBeginning', function(){
			$('#<?php echo esc_attr( $unique_id ); ?> .stm-isearch-prev').addClass('disabled');
		});

		search_results_carousel.on('reachEnd', function(){
			$('#<?php echo esc_attr( $unique_id ); ?> .stm-isearch-next').addClass('disabled');
		});

		var toIndex = 0;
		var count = 0;

		$('#<?php echo esc_attr( $unique_id ); ?> .stm-isearch-results-carousel .swiper-slide').each(function(){
			if($(this).find('.stm-template-front-loop').hasClass('current')) {
				toIndex = parseInt(count);
			}
			count++;
		});

		search_results_carousel.slideTo(toIndex);

		$(window).on('resize orientationchange', function(){
			search_results_carousel.update()
		});

		<?php
		if ( ! $is_elementor_editor ) :
			?>
			});
			<?php
		endif;
		?>
	})(jQuery);
</script>
