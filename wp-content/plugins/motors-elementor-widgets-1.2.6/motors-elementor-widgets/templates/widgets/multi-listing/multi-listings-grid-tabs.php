<?php

if ( empty( $listings_number ) ) {
	$listings_number = 8;
}

$listing_types = array();

if ( empty( $tabs ) ) {
	$listing_types = apply_filters( 'stm_listings_post_type', 'listings' );
} else {
	foreach ( $tabs as $tab ) {
		$listing_types[] = $tab['listing_type'];
	}
}

$uniqid                  = uniqid();
$tab_activity_class      = 'active';
$tab_pane_activity_class = 'in active';
?>

<div class="stm_elementor_multi_listings_grid_tabs_wrap stm_listing_tabs_style_2">

	<div class="clearfix">

		<?php if ( ! empty( $grid_title ) ) : ?>
			<h3 class="hidden-md hidden-lg hidden-sm"><?php echo wp_kses_post( $grid_title ); ?></h3>
		<?php endif; ?>

		<?php
		$tabs_total = ( isset( $tabs ) && is_array( $tabs ) && ! empty( $tabs ) ) ? count( $tabs ) : 0;

		if ( 'yes' === $include_popular ) {
			$tabs_total++;
		}
		if ( 'yes' === $include_recent ) {
			$tabs_total++;
		}
		if ( 'yes' === $include_featured ) {
			$tabs_total++;
		}

		if ( $tabs_total > 1 ) :
			?>

			<!-- Nav tabs -->
			<ul class="stm_listing_nav_list heading-font" role="tablist">

				<?php if ( ! empty( $tabs ) ) : ?>

					<?php foreach ( $tabs as $index => $tab ) : ?>
						<li role="presentation" class="<?php echo esc_attr( $tab_activity_class ); ?>">
							<a href="#listing-type-<?php echo esc_attr( $tab['listing_type'] . '-' . $uniqid . '-' . $index ); ?>"
									role="tab"
									data-toggle="tab">
								<span><?php echo esc_html( $tab['tab_title'] ); ?></span>
							</a>
						</li>
						<?php $tab_activity_class = ''; ?>
					<?php endforeach; ?>

				<?php endif; ?>

				<?php if ( ! empty( $include_popular ) && 'yes' === $include_popular ) : ?>
					<li role="presentation" class="<?php echo esc_attr( $tab_activity_class ); ?>">
						<a href="#popular-<?php echo esc_attr( $uniqid ); ?>" aria-controls="popular" role="tab"
								data-toggle="tab"><span><?php echo esc_attr( $popular_label ); ?></span></a>
					</li>
					<?php $tab_activity_class = ''; ?>
				<?php endif; ?>

				<?php if ( ! empty( $include_recent ) && 'yes' === $include_recent ) : ?>
					<li role="presentation" class="<?php echo esc_attr( $tab_activity_class ); ?>">
						<a href="#recent-<?php echo esc_attr( $uniqid ); ?>" aria-controls="recent" role="tab"
								data-toggle="tab"><span><?php echo esc_attr( $recent_label ); ?></span></a>
					</li>
					<?php $tab_activity_class = ''; ?>
				<?php endif; ?>

				<?php if ( ! empty( $include_featured ) && 'yes' === $include_featured ) : ?>
					<li role="presentation"  class="<?php echo esc_attr( $tab_activity_class ); ?>">
						<a href="#featured-<?php echo esc_attr( $uniqid ); ?>" aria-controls="recent" role="tab"
								data-toggle="tab"><span><?php echo esc_attr( $featured_label ); ?></span></a>
					</li>
					<?php $tab_activity_class = ''; ?>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

		<?php if ( ! empty( $grid_title ) ) : ?>
			<h3 class="hidden-xs"><?php echo wp_kses_post( $grid_title ); ?></h3>
		<?php endif; ?>

	</div>

	<!-- Tab panes -->
	<div class="tab-content">
		<?php
		$per_row  = ( $listings_number_per_row ) ? $listings_number_per_row : 4;
		$template = 'partials/listing-cars/listing-grid-directory-loop-' . $per_row;
		if ( apply_filters( 'stm_is_motorcycle', false ) ) {
			$per_row  = 3;
			$template = 'partials/listing-cars/motos/moto-single-grid';
		}
		?>

		<?php if ( ! empty( $tabs ) ) : ?>

			<?php foreach ( $tabs as $index => $tab ) : ?>
				<?php
				$args = array(
					'post_type'      => $tab['listing_type'],
					'post_status'    => 'publish',
					'posts_per_page' => $listings_number,
				);

				if ( 'popular' === $tab['items_order_by'] ) {
					$args[] = array(
						'orderby'  => 'meta_value_num',
						'meta_key' => 'stm_car_views',
						'order'    => 'DESC',
					);
				}

				$listing_cars = new WP_Query( $args );
				?>
				<div role="tabpanel" class="tab-pane fade <?php echo esc_attr( $tab_pane_activity_class ); ?>" id="listing-type-<?php echo esc_attr( $tab['listing_type'] . '-' . $uniqid . '-' . $index ); ?>">

					<?php if ( $listing_cars->have_posts() ) : ?>
						<div class="row row-<?php echo intval( $per_row ); ?> car-listing-row">
							<?php
							while ( $listing_cars->have_posts() ) :
								$listing_cars->the_post();
								?>
								<?php get_template_part( $template ); ?>
							<?php endwhile; ?>
						</div>

						<?php if ( ! empty( $tab['show_all_link'] ) && 'yes' === $tab['show_all_link'] && ! empty( $tab['listing_type'] ) && stm_get_inventory_page_url( $tab['listing_type'] ) ) : ?>
							<div class="row">
								<div class="col-xs-12 text-center">
									<div class="dp-in">
										<a class="load-more-btn"
												href="<?php echo esc_url( stm_get_inventory_page_url( $tab['listing_type'] ) ); ?>">
											<?php echo esc_html( $tab['show_all_link_text'] ); ?>
										</a>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>

				</div>
				<?php $tab_pane_activity_class = ''; ?>
			<?php endforeach; ?>

		<?php endif; ?>

		<?php if ( ! empty( $include_popular ) && 'yes' === $include_popular ) : ?>
			<div role="tabpanel"
					class="tab-pane fade <?php echo esc_attr( $tab_pane_activity_class ); ?>"
					id="popular-<?php echo esc_attr( $uniqid ); ?>">
				<?php
				$args = array(
					'post_type'      => $listing_types,
					'post_status'    => 'publish',
					'posts_per_page' => $listings_number,
					'orderby'        => 'meta_value_num',
					'meta_key'       => 'stm_car_views', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
					'order'          => 'DESC',
				);

				$args['meta_query'][] = array(
					'key'     => 'car_mark_as_sold',
					'value'   => '',
					'compare' => '=',
				);

				$recent_query = new WP_Query( $args );

				if ( $recent_query->have_posts() ) :
					?>
					<div class="row row-<?php echo intval( $per_row ); ?> car-listing-row">
						<?php
						while ( $recent_query->have_posts() ) :
							$recent_query->the_post();
							?>
							<?php get_template_part( $template ); ?>
						<?php endwhile; ?>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
			<?php $tab_pane_activity_class = ''; ?>
		<?php endif; ?>

		<?php if ( ! empty( $include_recent ) && 'yes' === $include_recent ) : ?>
			<div role="tabpanel"
					class="tab-pane fade <?php echo esc_attr( $tab_pane_activity_class ); ?>"
					id="recent-<?php echo esc_attr( $uniqid ); ?>">
				<?php
				$args = array(
					'post_type'      => $listing_types,
					'post_status'    => 'publish',
					'posts_per_page' => $listings_number,
				);

				$args['meta_query'][] = array(
					'key'     => 'car_mark_as_sold',
					'value'   => '',
					'compare' => '=',
				);

				$recent_query = new WP_Query( $args );

				if ( $recent_query->have_posts() ) :
					?>
					<div class="row row-<?php echo intval( $per_row ); ?> car-listing-row">
						<?php
						while ( $recent_query->have_posts() ) :
							$recent_query->the_post();
							?>
							<?php get_template_part( $template ); ?>
						<?php endwhile; ?>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>

			</div>
			<?php $tab_pane_activity_class = ''; ?>
		<?php endif; ?>

		<?php if ( ! empty( $include_featured ) && 'yes' === $include_featured ) : ?>
			<div role="tabpanel" class="tab-pane fade <?php echo esc_attr( $tab_pane_activity_class ); ?>" id="featured-<?php echo esc_attr( $uniqid ); ?>">
				<?php
				$args = array(
					'post_type'      => $listing_types,
					'post_status'    => 'publish',
					'posts_per_page' => $listings_number,
					'order'          => 'rand',
					'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
						array(
							'key'     => 'special_car',
							'value'   => 'on',
							'compare' => '=',
						),
						array(
							'key'     => 'car_mark_as_sold',
							'value'   => '',
							'compare' => '=',
						),
					),
				);

				$featured_query = new WP_Query( $args );

				if ( $featured_query->have_posts() ) :
					?>
					<div class="row row-<?php echo intval( $per_row ); ?> car-listing-row">
						<?php
						while ( $featured_query->have_posts() ) :
							$featured_query->the_post();
							?>
							<?php get_template_part( $template ); ?>
						<?php endwhile; ?>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
			<?php $tab_pane_activity_class = ''; ?>
		<?php endif; ?>

	</div>
</div>
