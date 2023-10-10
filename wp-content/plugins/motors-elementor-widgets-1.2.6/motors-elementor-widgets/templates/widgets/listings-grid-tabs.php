<?php

if ( empty( $listings_number ) ) {
	$listings_number = 8;
}

$search_results_link = stm_get_listing_archive_link();

$filter_cats = array();
if ( ! empty( $taxonomy ) ) {
	$stm_tax    = str_replace( ' ', '', $taxonomy );
	$taxonomies = explode( ',', $stm_tax );
	if ( ! empty( $taxonomies ) ) {
		foreach ( $taxonomies as $categories ) {
			if ( ! empty( $categories ) ) {
				$filter_cats[] = explode( '|', $categories );
			}
		}
	}
}

// Set active from category if no recent and popular included.
$set_active_category = true;

$set_recent_active      = '';
$set_recent_active_fade = '';

$set_popular_active      = '';
$set_popular_active_fade = '';

if ( ! empty( $include_recent ) && 'yes' === $include_recent || ! empty( $include_popular ) && 'yes' === $include_popular || ! empty( $include_featured ) && 'yes' === $include_featured ) {
	$set_active_category = false;
}

if ( empty( $include_featured ) ) {
	$set_recent_active      = 'active';
	$set_recent_active_fade = 'in';
} elseif ( empty( $include_recent ) ) {
	$set_popular_active      = 'active';
	$set_popular_active_fade = 'in';
}

$active_category = 0;

if ( empty( $listing_types ) ) {
	$listing_types = apply_filters( 'stm_listings_post_type', 'listings' );
}

$uniqid = uniqid();

?>

<div class="stm_elementor_listings_grid_tabs_wrap stm_listing_tabs_style_2">

	<div class="clearfix">

		<?php if ( ! empty( $grid_title ) ) : ?>
			<h3 class="hidden-md hidden-lg hidden-sm"><?php echo wp_kses_post( $grid_title ); ?></h3>
		<?php endif; ?>

		<?php
		$tabs_total = count( $filter_cats );

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

				<?php
				foreach ( $filter_cats as $filter_cat ) :
					$active_category ++;
					if ( ! empty( $filter_cat[0] ) && ! ( empty( $filter_cat[1] ) ) ) :
						$current_category = get_term_by( 'slug', $filter_cat[0], $filter_cat[1] );
						if ( ! empty( $current_category ) ) :
							?>
							<li role="presentation"
								<?php
								if ( 1 === $active_category && $set_active_category ) {
									echo esc_attr( 'class=active' );
								}
								?>
							>
								<a href="#car-listing-category-<?php echo esc_attr( $current_category->slug ); ?>"
										role="tab"
										data-toggle="tab">
									<span><?php echo esc_attr( $current_category->name ); ?></span>
								</a>
							</li>
							<?php
						endif;
					endif;
				endforeach;
				?>

				<?php if ( ! empty( $include_popular ) && 'yes' === $include_popular ) : ?>
					<li role="presentation" class="<?php echo esc_attr( $set_popular_active ); ?>">
						<a href="#popular-<?php echo esc_attr( $uniqid ); ?>" aria-controls="popular" role="tab"
								data-toggle="tab"><span><?php echo esc_attr( $popular_label ); ?></span></a>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $include_recent ) && 'yes' === $include_recent ) : ?>
					<li role="presentation" class="<?php echo esc_attr( $set_recent_active ); ?>">
						<a href="#recent-<?php echo esc_attr( $uniqid ); ?>" aria-controls="recent" role="tab"
								data-toggle="tab"><span><?php echo esc_attr( $recent_label ); ?></span></a>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $include_featured ) && 'yes' === $include_featured ) : ?>
					<li role="presentation" class="active">
						<a href="#featured-<?php echo esc_attr( $uniqid ); ?>" aria-controls="recent" role="tab"
								data-toggle="tab"><span><?php echo esc_attr( $featured_label ); ?></span></a>
					</li>
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
		$active_category = 0;
		$per_row         = ( $listings_number_per_row ) ? $listings_number_per_row : 4;
		$template        = 'partials/listing-cars/listing-grid-directory-loop-' . $per_row;
		if ( apply_filters( 'stm_is_motorcycle', false ) ) {
			$per_row  = 3;
			$template = 'partials/listing-cars/motos/moto-single-grid';
		}
		?>
		<?php
		foreach ( $filter_cats as $filter_cat ) :
			$active_category ++;
			if ( ! empty( $filter_cat[0] ) && ! ( empty( $filter_cat[1] ) ) ) :
				// Creating custom query for each tab.
				$args                = array(
					'post_type'      => $listing_types,
					'post_status'    => 'publish',
					'posts_per_page' => $listings_number,
				);
				$args['tax_query'][] = array(
					'taxonomy' => $filter_cat[1],
					'field'    => 'slug',
					'terms'    => array( $filter_cat[0] ),
				);
				$listing_cars        = new WP_Query( $args );
				?>
				<div role="tabpanel" class="tab-pane fade
				<?php
				if ( 1 === $active_category && $set_active_category ) {
					echo esc_attr( 'in active' );
				}
				?>
				" id="car-listing-category-<?php echo esc_attr( $filter_cat[0] ); ?>-<?php echo esc_attr( $uniqid ); ?>">
					<div class="found-cars-clone">
						<div class="found-cars heading-font"><i
									class="stm-icon-car"></i><?php esc_html_e( 'available', 'motors-elementor-widgets' ); ?> <span
									class="blue-lt"><?php echo esc_attr( $listing_cars->found_posts ); ?><?php esc_html_e( ' cars', 'motors-elementor-widgets' ); ?></span>
						</div>
					</div>
					<?php if ( $listing_cars->have_posts() ) : ?>
						<div class="row row-<?php echo intval( $per_row ); ?> car-listing-row">
							<?php
							while ( $listing_cars->have_posts() ) :
								$listing_cars->the_post();
								?>
								<?php get_template_part( $template ); ?>
							<?php endwhile; ?>
						</div>

						<?php if ( ! empty( $show_all_link ) && 'yes' === $show_all_link ) : ?>
							<div class="row">
								<div class="col-xs-12 text-center">
									<div class="dp-in">
										<a class="load-more-btn"
												href="<?php echo esc_url( $search_results_link ) . '?' . esc_attr( $filter_cat[1] ) . '=' . esc_attr( $filter_cat[0] ); ?>">
											<?php echo esc_html( $show_all_link_text ); ?>
										</a>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>


		<?php if ( ! empty( $include_popular ) && 'yes' === $include_popular ) : ?>
			<div role="tabpanel"
					class="tab-pane fade <?php echo esc_attr( $set_popular_active_fade . ' ' . $set_popular_active ); ?>"
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
					<?php if ( ! empty( $show_all_link ) && 'yes' === $show_all_link ) : ?>
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="dp-in">
								<a class="load-more-btn"
										href="<?php echo esc_url( $search_results_link . '?popular=true' ); ?>">
									<?php echo esc_html( $show_all_link_text ); ?>
								</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $include_recent ) && 'yes' === $include_recent ) : ?>
			<div role="tabpanel"
					class="tab-pane fade <?php echo esc_attr( $set_recent_active_fade . ' ' . $set_recent_active ); ?>"
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

					<?php if ( ! empty( $show_all_link ) && 'yes' === $show_all_link ) : ?>
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="dp-in">
								<a class="load-more-btn" href="<?php echo esc_url( $search_results_link ); ?>">
									<?php echo esc_html( $show_all_link_text ); ?>
								</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>

			</div>
		<?php endif; ?>

		<?php if ( ! empty( $include_featured ) && 'yes' === $include_featured ) : ?>
			<div role="tabpanel" class="tab-pane fade active in" id="featured-<?php echo esc_attr( $uniqid ); ?>">
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
					<?php if ( ! empty( $show_all_link ) && 'yes' === $show_all_link ) : ?>
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="dp-in">
								<a class="load-more-btn"
										href="<?php echo esc_url( $search_results_link . '?featured_top=true' ); ?>">
									<?php echo esc_html( $show_all_link_text ); ?>
								</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</div>
