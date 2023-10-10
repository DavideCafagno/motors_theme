<?php
$filter_bg = stm_me_motors_get_wpcfto_mod( 'sidebar_filter_bg', get_template_directory_uri() . '/assets/images/listing-directory-filter-bg.jpg' );

if ( ! empty( $filter_bg ) ) {
	if ( is_int( $filter_bg ) ) {
		$filter_bg = wp_get_attachment_image_url( $filter_bg, 'full' );
	}
	?>
	<style type="text/css">
		.stm-template-listing .filter-sidebar:after {
			background-image: url("<?php echo esc_url( $filter_bg ); ?>");
		}
	</style>
	<?php
}

if ( empty( $action ) ) {
	$action = 'listings-result'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
}

$show_sold = stm_me_get_wpcfto_mod( 'show_sold_listings', false );

if ( stm_is_multilisting() && 'listings' !== $post_type ) {
	set_query_var( 'listings_type', $post_type );
	HooksMultiListing::stm_listings_attributes_filter( array( 'slug' => $post_type ) );
	$filter      = stm_listings_filter( array( 'post_type' => $post_type ) );
	$filter_args = array(
		'filter'    => $filter,
		'post_type' => $post_type,
	);
} else {
	$filter      = stm_listings_filter();
	$filter_args = array( 'filter' => $filter );
}

?>
<div class="mobile-filter">
	<div class="mobile-search-btn icon-<?php echo esc_attr( $isf_mobile_btn_icon_position ); ?>">
		<?php echo wp_kses( $search_options_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
		<span class="mobile-search-btn-text"><?php echo esc_html( $isf_title ); ?></span>
	</div>
</div>
<div class="classic-filter-row motors-elementor-widget">
	<form class="search-filter-form" action="<?php echo esc_url( stm_listings_current_url() ); ?>" method="get" data-trigger="filter"
		data-action="<?php echo esc_attr( $action ); ?>">
		<div class="filter filter-sidebar ajax-filter">
			<?php do_action( 'stm_listings_filter_before' ); ?>
			<div class="sidebar-entry-header icon-<?php echo esc_attr( $isf_icon_position ); ?>">
				<?php echo wp_kses( $search_options_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
				<span class="h4"><?php echo esc_html( $isf_title ); ?></span>
			</div>
			<div class="sidebar-entry-header-mobile">
				<span class="h4"><?php echo esc_html( $isf_title ); ?></span>
				<div class="close-btn">
					<span class="close-btn-item"></span>
					<span class="close-btn-item"></span>
				</div>
			</div>
			<div class="row row-pad-top-24">
				<?php
				if ( empty( $filter['filters'] ) ) :
					$post_type_name = __( 'Listings', 'motors-elementor-widgets' );
					if ( stm_is_multilisting() ) {
						$ml = new STMMultiListing();
						if ( ! empty( $ml->stm_get_current_listing() ) ) {
							$multitype      = $ml->stm_get_current_listing();
							$post_type_name = $multitype['label'];
						}
					}
					?>
					<div class="col-md-12 col-sm-12">
						<p class="text-muted text-center">
							<?php
							/* translators: post type name */
							echo sprintf( esc_html__( 'No categories created for %s', 'motors-elementor-widgets' ), esc_html( $post_type_name ) );
							?>
						</p>
					</div>
					<?php
				else :
					foreach ( $filter['filters'] as $attribute => $config ) :

						if ( ! empty( $isf_price_single ) && 'price' === $attribute && ! empty( $config['slider'] ) ) {
							continue;
						}

						if ( ! empty( $config['slider'] ) && $config['slider'] ) :
							if ( isset( $filter['options'][ $attribute ] ) ) :
								stm_listings_load_template(
									'filter/types/slider',
									array(
										'taxonomy' => $config,
										'options'  => $filter['options'][ $attribute ],
									)
								);
							endif;
						else :
							if ( isset( $filter['options'][ $attribute ] ) ) :
								?>
								<div class="col-md-12 col-sm-6 stm-filter_<?php echo esc_attr( $attribute ); ?>">
									<div class="form-group type-select">
										<?php
										stm_listings_load_template(
											'filter/types/select',
											array(
												'options' => $filter['options'][ $attribute ],
												'name'    => $attribute,
											)
										);
										?>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>

					<?php if ( $show_sold && 'listings-sold' !== $action ) : ?>
					<div class="col-md-12 col-sm-12 stm-filter_listing_status">
						<div class="form-group">
							<select name="listing_status" class="form-control">
								<option value="">
									<?php esc_html_e( 'Listing status', 'motors-elementor-widgets' ); ?>
								</option>
								<option value="active" <?php echo ( isset( $_GET['listing_status'] ) && 'active' === $_GET['listing_status'] ) ? 'selected' : ''; // phpcs:ignore WordPress.Security ?>>
									<?php esc_html_e( 'Active', 'motors-elementor-widgets' ); ?>
								</option>
								<option value="sold" <?php echo ( isset( $_GET['listing_status'] ) && 'sold' === $_GET['listing_status'] ) ? 'selected' : ''; // phpcs:ignore WordPress.Security ?>>
									<?php esc_html_e( 'Sold', 'motors-elementor-widgets' ); ?>
								</option>
							</select>
						</div>
					</div>
				<?php endif; ?>

					<?php stm_listings_load_template( 'filter/types/location' ); ?>

					<?php
					stm_listings_load_template(
						'filter/types/features',
						array(
							'taxonomy' => 'stm_additional_features',
						)
					);
					?>
				<?php endif; ?>

			</div>
			<!--View type-->
			<input type="hidden" id="stm_view_type" name="view_type"
				value="<?php echo esc_attr( stm_listings_input( 'view_type' ) ); ?>"/>
			<!--Filter links-->
			<input type="hidden" id="stm-filter-links-input" name="stm_filter_link" value=""/>
			<!--Popular-->
			<input type="hidden" name="popular" value="<?php echo esc_attr( stm_listings_input( 'popular' ) ); ?>"/>

			<input type="hidden" name="s" value="<?php echo esc_attr( stm_listings_input( 's' ) ); ?>"/>
			<input type="hidden" name="sort_order"
				value="<?php echo esc_attr( stm_listings_input( 'sort_order' ) ); ?>"/>

			<div class="sidebar-action-units">
				<input id="stm-classic-filter-submit" class="hidden" type="submit"
					value="<?php esc_html_e( 'Show cars', 'stm_vehicles_listing' ); ?>"/>

				<a href="<?php echo esc_url( stm_get_listing_archive_link() ); ?>" class="button">
					<?php
					if ( ! empty( $reset_btn_icon ) ) {
						echo wp_kses( $reset_btn_icon, apply_filters( 'stm_ew_kses_svg', array() ) );
					}
					?>
					<span><?php echo esc_html( $reset_btn_label ); ?></span>
				</a>
			</div>
			<?php do_action( 'stm_listings_filter_after' ); ?>
		</div>

		<!--Classified price-->
		<?php
		if ( ! empty( $isf_price_single ) && ! empty( $filter['options']['price'] ) && ! empty( $filter['filters']['price']['slider'] ) ) {
			stm_listings_load_template(
				'filter/types/price',
				array(
					'taxonomy' => 'price',
					'options'  => $filter['options']['price'],
				)
			);
		}
		?>
		<?php stm_listings_load_template( 'filter/types/checkboxes', $filter_args ); ?>
		<?php stm_listings_load_template( 'filter/types/links', $filter_args ); ?>
		<div class="grow-wrapper"></div>
		<div class="sticky-filter-actions">
			<div class="filter-show-cars">
				<button id="show-car-btn-mobile" class="show-car-btn">
					<?php
					if ( ! empty( $isf_mobile_results_btn_text ) ) {
						$total_cars                  = $filter['total'];
						$isf_mobile_results_btn_text = str_replace( '{{total}}', '<span>' . $total_cars . '</span>', $isf_mobile_results_btn_text );
						echo wp_kses_post( $isf_mobile_results_btn_text );
					}
					?>
					</button>
			</div>
			<div class="reset-btn-mobile">
				<a href="<?php echo esc_url( stm_get_listing_archive_link() ); ?>" class="button">
					<?php
					if ( ! empty( $reset_btn_icon ) ) {
						echo wp_kses( $reset_btn_icon, apply_filters( 'stm_ew_kses_svg', array() ) );
					}
					?>
					<span><?php echo esc_html( $reset_btn_label ); ?></span>
				</a>
			</div>
		</div>
	</form>
</div>
