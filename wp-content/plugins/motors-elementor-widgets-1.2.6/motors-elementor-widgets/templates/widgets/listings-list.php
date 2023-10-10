<?php
if ( empty( $listing_types ) ) {
	$listing_types = stm_listings_post_type();
}

if ( empty( $listings_number ) ) {
	$listings_number = -1;
}

$args = array(
	'post_type'      => $listing_types,
	'post_status'    => 'publish',
	'posts_per_page' => $listings_number,
);

$args['meta_query'] = array(); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

if ( ! empty( $only_featured ) && 'yes' === $only_featured ) {
	$args['meta_query'][] = array(
		'key'     => 'special_car',
		'value'   => 'on',
		'compare' => '=',
	);
}

if ( empty( $include_sold ) || 'yes' !== $include_sold ) {
	$args['meta_query'][] = array(
		'key'     => 'car_mark_as_sold',
		'value'   => '',
		'compare' => '=',
	);
}

$query     = new WP_Query( $args );
$unique_id = 'selg-' . wp_rand( 1, 99999 );
$class     = 'listing-cars-list';

?>

<div class="stm-elementor_listings_list archive-listing-page stm-ajax-row">
	<?php
	if ( $query->have_posts() ) :
		?>
		<div class="listing-car-items-unit_s" id="<?php echo esc_attr( $unique_id ); ?>">
			<div class="<?php echo esc_attr( $class ); ?> clearfix">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();

					get_template_part( 'partials/listing-cars/listing-list-directory', 'loop' );

					?>
				<?php endwhile; ?>
			</div>
		</div>
		<?php if ( isset( $enable_pagination ) && 'yes' === $enable_pagination ) : ?>
		<div class="stm_ajax_pagination stm-blog-pagination">
			<?php
			echo wp_kses_post(
				paginate_links(
					array(
						'type'      => 'list',
						'total'     => ceil( $query->found_posts / $listings_number ),
						'prev_text' => '<i class="fas fa-angle-left"></i>',
						'next_text' => '<i class="fas fa-angle-right"></i>',
					)
				)
			);
			?>
		</div>
	<?php endif; ?>
		<?php
		wp_reset_postdata();

	endif;
	?>
</div>

<?php // @codingStandardsIgnoreStart ?>
	<script>
		(function ($) {
			"use strict";

			var uniqid = '<?php echo esc_attr( $unique_id ); ?>';

			$('body').on('click', '.stm_ajax_pagination a.page-numbers', function(e){

				e.preventDefault();

				var page = 1;
				var currentPage = parseInt($(this).closest('.stm_ajax_pagination').find('.page-numbers.current').text());

				if ($(this).hasClass('next')) {
					page = currentPage + 1;
				} else if ($(this).hasClass('prev')) {
					page = currentPage - 1;
				} else {
					page = parseInt($(this).text());
				}

				var ajaxContainer = $('#' + uniqid).closest('.stm-ajax-row');

				$.ajax({
					type: "POST",
					url: ajaxurl,
					dataType: 'json',
					data: '<?php echo http_build_query( array( 'query_args' => $args ) ); ?>' + '&paged=' + page + '&action=stm_ajax_load_listings_list_items&security=' + stm_security_nonce,
					beforeSend: function() {
						ajaxContainer.addClass('stm-loading');
					},
					success: function(data) {
						if (data.html) {
							$('#' + uniqid + ' .listing-cars-list').html(data.html);
						}
						if (data.pagination) {
							$('#' + uniqid).parent().find('.stm_ajax_pagination').html(data.pagination);
						}
						ajaxContainer.removeClass('stm-loading');
					},
					error: function(jqXHR, exception) {
						ajaxContainer.removeClass('stm-loading');
					}
				});

				return false;
			})

		})(jQuery);
	</script>
<?php // @codingStandardsIgnoreEnd ?>
