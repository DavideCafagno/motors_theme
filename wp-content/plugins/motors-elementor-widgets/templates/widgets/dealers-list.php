<?php

/**
 * @var $filter_categories
 * @var $dealer_category_fields
 * @var $button_text
 * @var $button_icon_html
 */

$response = stm_get_filtered_dealers();

$user_list = $response['user_list'];
$title     = $response['title'];

if ( is_array( $dealer_category_fields ) ) {
	$dealer_category_fields = join( ', ', $dealer_category_fields );
}

if ( ! empty( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'dealer_list' ) && ! empty( $_GET['stm_sort_by'] ) ) {
	$sort_by = sanitize_title( wp_unslash( $_GET['stm_sort_by'] ) );
} else {
	$sort_by = 'reviews';
}

$filters = array(
	'alphabet' => esc_html__( 'Alphabet', 'motors-elementor-widgets' ),
	'reviews'  => esc_html__( 'Reviews', 'motors-elementor-widgets' ),
	'date'     => esc_html__( 'Date', 'motors-elementor-widgets' ),
	'cars'     => esc_html__( 'Cars number', 'motors-elementor-widgets' ),
	'watches'  => esc_html__( 'Popularity', 'motors-elementor-widgets' ),
);

?>

<div class="stm_dynamic_listing_filter stm_dynamic_listing_dealer_filter animated fadeIn ">
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane fade in active" id="stm_all_listing_tab">
			<form action="<?php echo esc_url( stm_get_dealer_list_page() ); ?>" method="GET">
				<input type="hidden" name="stm_dealer_show_taxonomies"
						value="<?php echo esc_attr( $dealer_category_fields ); ?>"/>
				<input type="hidden" name="stm_sort_by" value="<?php echo esc_attr( $sort_by ); ?>"/>
				<?php wp_nonce_field( 'dealer_list' ); ?>
				<div class="stm-filter-tab-selects">
					<div class="row">
						<?php if ( is_array( $filter_categories ) && count( $filter_categories ) > 0 ) : ?>
							<?php foreach ( $filter_categories as $stm_filter_dealers ) : ?>
								<?php $terms = stm_get_category_by_slug_all( $stm_filter_dealers ); ?>
								<?php if ( ! empty( $terms ) && 'location' !== $stm_filter_dealers && 'keyword' !== $stm_filter_dealers ) : ?>
									<div class="col-md-4 col-sm-6 col-xs-12 stm-select-col">
										<div class="stm-ajax-reloadable">
											<select
													name="<?php echo esc_attr( $stm_filter_dealers ); ?>"
													data-class="stm_select_overflowed stm_select_dealer">
												<option value="">
													<?php
													esc_html_e( 'Choose', 'motors-elementor-widgets' );
													echo esc_html( ' ' . stm_get_name_by_slug( $stm_filter_dealers ) );
													?>
												</option>

												<?php
												if ( ! empty( $terms ) ) {
													foreach ( $terms as $stm_term ) {
														$selected = '';
														if ( ! empty( $_GET[ $stm_filter_dealers ] ) && $_GET[ $stm_filter_dealers ] === $stm_term->slug ) {
															$selected = 'selected';
														}
														?>
														<option value="<?php echo esc_attr( $stm_term->slug ); ?>" <?php echo esc_attr( $selected ); ?>>
															<?php echo esc_html( $stm_term->name ); ?>
														</option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
						<?php if ( is_array( $filter_categories ) && array_search( 'location', $filter_categories, true ) ) : ?>
							<div class="col-md-4 col-sm-6 col-xs-12 stm-select-col">
								<div class="stm-location-search-unit">
									<input
											type="text"
											class="stm_listing_filter_text stm_listing_search_location"
											id="stm-car-location-stm_all_listing_tab"
											name="ca_location"
											value="<?php echo ! empty( $_GET['ca_location'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_GET['ca_location'] ) ) ) : ''; ?>"
											placeholder="<?php esc_attr_e( 'Enter a location', 'motors-elementor-widgets' ); ?>"
											autocomplete="off">
									<input type="hidden" name="stm_lat"
											value="<?php echo ! empty( $_GET['stm_lat'] ) ? floatval( $_GET['stm_lat'] ) : ''; ?>">
									<input type="hidden" name="stm_lng"
											value="<?php echo ! empty( $_GET['stm_lng'] ) ? floatval( $_GET['stm_lng'] ) : ''; ?>">
								</div>
							</div>
						<?php endif; ?>
						<?php if ( is_array( $filter_categories ) && array_search( 'keyword', $filter_categories, true ) ) : ?>
							<div class="col-md-4 col-sm-6 col-xs-12 stm-select-col">
								<div class="stm-keyword-search-unit">
									<?php
									$dealer_keyword = '';
									if ( ! empty( $_GET['dealer_keyword'] ) ) {
										$dealer_keyword = sanitize_text_field( wp_unslash( $_GET['dealer_keyword'] ) );
									}
									?>
									<input
											type="text"
											class="stm_listing_filter_text stm_listing_search_location"
											name="dealer_keyword"
											value="<?php echo esc_attr( $dealer_keyword ); ?>"
											placeholder="<?php esc_attr_e( 'Keyword', 'motors-elementor-widgets' ); ?>">
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<button type="submit" class="heading-font">
					<?php echo wp_kses( $button_icon_html, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
					<?php echo esc_html( $button_text ); ?>
				</button>
			</form>
		</div>
	</div>

	<div class="dealer-search-title">
		<div class="stm-car-listing-sort-units stm-car-listing-directory-sort-units clearfix">
			<div class="stm-listing-directory-title">
				<div class="title"><?php echo wp_kses_post( $title ); ?></div>
			</div>
			<div class="stm-directory-listing-top__right">
				<div class="clearfix">
					<div class="stm-sort-by-options clearfix">
						<span><?php esc_html_e( 'Sort by:', 'motors-elementor-widgets' ); ?></span>
						<div class="stm-select-sorting">
							<select>
								<?php foreach ( $filters as $filter_name => $filter ) : ?>
									<?php
									$selected = '';
									if ( $sort_by === $filter_name ) {
										$selected = 'selected';
									}
									?>
									<option value="<?php echo esc_attr( $filter_name ); ?>" <?php echo esc_attr( $selected ); ?>>
										<?php echo esc_html( $filter ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="dealer-search-results">
		<?php
		if ( ! empty( $user_list ) ) {
			?>
			<table class="stm_dealer_list_table">
				<?php foreach ( $user_list as $user ) { ?>
					<?php stm_get_single_dealer( $user, $dealer_category_fields ); ?>
				<?php } ?>
			</table>
			<?php if ( ! empty( $response['button'] ) && 'show' === $response['button'] ) : ?>
				<a class="stm-load-more-dealers button" href="#" data-offset="12">
						<span>
							<?php esc_html_e( 'Show more', 'motors-elementor-widgets' ); ?>
						</span>
				</a>
			<?php endif; ?>
		<?php } else { ?>
			<h4><?php esc_html_e( 'No dealers on your search parameters', 'motors-elementor-widgets' ); ?></h4>
			<?php
		}
		?>
	</div>
</div>
