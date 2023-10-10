<?php

use STM_E_W\Helpers\Helper;

$args = array(
	'post_type'        => apply_filters( 'stm_listings_post_type', 'listings' ),
	'post_status'      => 'publish',
	'posts_per_page'   => 1,
	'suppress_filters' => 0,
);

if ( stm_sold_status_enabled() ) {
	$args['meta_query'][] = array(
		'key'     => 'car_mark_as_sold',
		'value'   => '',
		'compare' => '=',
	);
}

$all = new WP_Query( $args );
$all = $all->found_posts;

if ( ! empty( $tab_prefix ) ) {
	$tab_prefix = $tab_prefix . ' ';
}

if ( ! empty( $tab_suffix ) ) {
	$tab_suffix = ' ' . $tab_suffix;
}

$uniqid = uniqid();

$lst_advanced_search    = ( isset( $lst_advanced_search ) && 'yes' === $lst_advanced_search );
$selects_advanced_class = ( $lst_advanced_search ) ? ' hide-overflown-controls' : '';

$tab_activity_class      = 'active';
$tab_pane_activity_class = 'in active';
?>
<div
		class="stm_dynamic_listing_filter filter-listing stm-vc-ajax-filter animated fadeIn"
		data-options="<?php echo esc_attr( wp_json_encode( stm_data_binding( true ) ) ); ?>"
		data-show_amount="<?php echo esc_attr( wp_json_encode( 'yes' === $lst_amount ) ); ?>"
>
	<!-- Nav tabs -->
	<ul class="stm_dynamic_listing_filter_nav clearfix heading-font" role="tablist">
		<?php if ( ! empty( $lst_show_all_tab ) ) : ?>
			<li role="presentation" class="<?php echo esc_attr( $tab_activity_class ); ?>">
				<a href="#stm_all_listing_tab-<?php echo esc_attr( $uniqid ); ?>" aria-controls="stm_all_listing_tab" role="tab" data-toggle="tab">
					<?php echo esc_attr( $tab_prefix . $lst_show_all_text . $tab_suffix ); ?>
				</a>
			</li>
			<?php $tab_activity_class = ''; ?>
		<?php endif; ?>

		<?php
		if ( 'yes' === $lst_show_tabs && is_array( $lst_condition_tabs ) && count( $lst_condition_tabs ) > 0 ) :
			$i = 0;
			foreach ( $lst_condition_tabs as $key => $item ) :

				$i ++;
				$data = explode( '|', $item );
				?>

				<li class="<?php echo esc_attr( $tab_activity_class ); ?>">
					<a href="#<?php echo esc_attr( trim( $data[0] ) ); ?>-<?php echo esc_attr( $uniqid ); ?>" aria-controls="<?php echo esc_attr( $data[0] ); ?>"
							role="tab" data-toggle="tab" data-value="<?php echo esc_attr( $data[0] ); ?>"
							data-slug="<?php echo esc_attr( $data[1] ); ?>">
						<?php echo esc_html( $tab_prefix . $data[2] . $tab_suffix ); ?>
					</a>
				</li>
				<?php $tab_activity_class = ''; ?>
				<?php
			endforeach;
			$i = 0;
		endif;
		?>

		<?php if ( defined( 'STM_REVIEW' ) && 'yes' === $lst_enable_reviews ) : ?>
			<li class="<?php echo esc_attr( $tab_activity_class ); ?>">
				<a href="#car-reviews-tab-<?php echo esc_attr( $uniqid ); ?>" role="tab" data-toggle="tab" aria-expanded="false">Car reviews</a>
			</li>
			<?php $tab_activity_class = ''; ?>
		<?php endif; ?>

		<?php if ( defined( 'STM_VALUE_MY_CAR' ) && 'yes' === $lst_enable_value_my_car ) : ?>
			<li class="<?php echo esc_attr( $tab_activity_class ); ?>">
				<a href="#value-my-car-<?php echo esc_attr( $uniqid ); ?>" role="tab" data-toggle="tab" aria-expanded="false"><?php echo esc_html__( 'Value my car', 'motors-elementor-widgets' ); ?></a>
			</li>
			<?php $tab_activity_class = ''; ?>
		<?php endif; ?>

	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<?php if ( ! empty( $lst_show_all_tab ) ) : ?>
			<div role="tabpanel" class="tab-pane fade <?php echo esc_attr( $tab_pane_activity_class ); ?>" id="stm_all_listing_tab-<?php echo esc_attr( $uniqid ); ?>">
				<form action="<?php echo esc_url( stm_get_listing_archive_link() ); ?>" method="GET">
					<div class="stm-filter-tab-selects filter stm-vc-ajax-filter<?php echo esc_attr( $selects_advanced_class ); ?>">
						<?php \STM_E_W\Helpers\Helper::stm_ew_listing_filter_get_selects( $lst_taxonomies, 'stm_all_listing_tab', $lst_amount ); ?>
						<?php if ( $lst_advanced_search && Helper::stm_ew_has_overflown_fields( $lst_taxonomies ) ) : ?>
							<div class="stm-show-more">
								<span class="show-extra-fields" data-tab-id="stm_all_listing_tab-<?php echo esc_attr( $uniqid ); ?>">
									<?php echo esc_html( $lst_advanced_search_label ); ?>
									<i class="fas fa-angle-down"></i>
								</span>
							</div>
						<?php endif; ?>
						<button type="submit" class="search-submit heading-font">
							<?php echo wp_kses( $__button_icon_html__, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
							<?php echo '<span>' . esc_html( $all ) . '</span> ' . esc_html( $lst_btn_postfix ); ?>
						</button>
					</div>
				</form>
			</div>
			<?php $tab_pane_activity_class = ''; ?>
		<?php endif; ?>

		<?php
		if ( 'yes' === $lst_show_tabs && is_array( $lst_condition_tabs ) && count( $lst_condition_tabs ) > 0 ) :
			foreach ( $lst_condition_tabs as $key => $item ) :
				$i ++;

				$data  = explode( '|', $item );
				$_term = trim( $data[0] );
				$_tax  = trim( $data[1] );

				?>
				<div role="tabpanel" class="tab-pane fade <?php echo esc_attr( $tab_pane_activity_class ); ?>"
						id="<?php echo esc_attr( $_term ); ?>-<?php echo esc_attr( $uniqid ); ?>">
					<?php $taxonomy_count = stm_get_custom_taxonomy_count( $_term, $_tax ); ?>
					<form action="<?php echo esc_url( stm_get_listing_archive_link() ); ?>" method="GET">
						<div class="stm-filter-tab-selects filter stm-vc-ajax-filter<?php echo esc_attr( $selects_advanced_class ); ?>">
							<?php \STM_E_W\Helpers\Helper::stm_ew_listing_filter_get_selects( $lst_taxonomies, $_term, $lst_amount ); ?>
							<?php if ( $lst_advanced_search && Helper::stm_ew_has_overflown_fields( $lst_taxonomies ) ) : ?>
								<div class="stm-show-more">
									<span class="show-extra-fields" data-tab-id="<?php echo esc_attr( $_term ); ?>-<?php echo esc_attr( $uniqid ); ?>">
										<?php echo esc_html( $lst_advanced_search_label ); ?>
										<i class="fas fa-angle-down"></i>
									</span>
								</div>
							<?php endif; ?>
							<input type="hidden"
									data-name="<?php echo esc_attr( $_tax ); ?>"
									data-val="<?php echo esc_attr( $_term ); ?>"
									value="<?php echo esc_attr( $_term ); ?>" class="no-cascading hidden_tax"/>
							<button type="submit" class="search-submit heading-font">
								<i class="fas fa-search"></i> <?php echo '<span>' . esc_html( $taxonomy_count ) . '</span> ' . esc_html( $lst_btn_postfix ); ?>
							</button>
						</div>
					</form>
				</div>
				<?php $tab_pane_activity_class = ''; ?>
				<?php
			endforeach;
		endif;
		?>

		<?php if ( defined( 'STM_REVIEW' ) && 'yes' === $lst_enable_reviews ) : ?>
			<div role="tabpanel" class="tab-pane fade <?php echo esc_attr( $tab_pane_activity_class ); ?>" id="car-reviews-tab-<?php echo esc_attr( $uniqid ); ?>">
				<form action="<?php echo esc_url( stm_review_archive_link() ); ?>" method="GET">
					<div class="stm-filter-tab-selects stm-filter-tab-selects-second filter stm-vc-ajax-filter<?php echo esc_attr( $selects_advanced_class ); ?>">
						<?php \STM_E_W\Helpers\Helper::stm_ew_listing_filter_get_selects( $lst_reviews_taxonomies, 'reviews' ); ?>
						<?php if ( $lst_advanced_search && Helper::stm_ew_has_overflown_fields( $lst_reviews_taxonomies ) ) : ?>
							<div class="stm-show-more">
								<span class="show-extra-fields" data-tab-id="car-reviews-tab-<?php echo esc_attr( $uniqid ); ?>">
									<?php echo esc_html( $lst_advanced_search_label ); ?>
									<i class="fas fa-angle-down"></i>
								</span>
							</div>
						<?php endif; ?>
						<input type="hidden" name="listing_type" value="with_review" />
						<button type="submit" class="search-submit heading-font">
							<i class="fas fa-search"></i> <?php echo '<span>' . esc_html( $all ) . '</span> ' . esc_html( $lst_btn_postfix ); ?>
						</button>
					</div>
				</form>
			</div>
			<?php $tab_pane_activity_class = ''; ?>
		<?php endif; ?>

		<?php if ( defined( 'STM_VALUE_MY_CAR' ) && 'yes' === $lst_enable_value_my_car ) : ?>
			<div role="tabpanel" class="tab-pane fade <?php echo esc_attr( $tab_pane_activity_class ); ?>" id="value-my-car-<?php echo esc_attr( $uniqid ); ?>">
				<form method="post" name="vmc-form" type="multipart/formdata">
					<div class="stm-filter-tab-selects stm-filter-tab-selects-second filter stm-vc-ajax-filter">
						<?php
						$vmc_fields_all = Helper::stm_ew_get_value_my_car_options();
						if ( ! empty( $lst_value_my_car_fields ) && is_array( $lst_value_my_car_fields ) ) {
							foreach ( $lst_value_my_car_fields as $vmc_field ) :
								if ( 'photo' === $vmc_field ) {
									?>
								<div class="col-md-3 col-sm-6 col-xs-12 stm-select-col vmc-file-wrap">
									<div class="file-wrap">
										<div class="input-file-holder">
											<span><?php echo esc_attr( $vmc_fields_all[ $vmc_field ] ); ?></span>
											<i class="fas fa-plus"></i>
											<input type="file" name="<?php echo esc_attr( $vmc_field ); ?>" />
										</div>
										<span class="error"></span>
									</div>
								</div>
									<?php
								} elseif ( 'year' === $vmc_field || 'mileage' === $vmc_field ) {
									?>
									<div class="col-md-3 col-sm-6 col-xs-12 stm-select-col">
										<input type="number" name="<?php echo esc_attr( $vmc_field ); ?>" placeholder="<?php echo esc_attr( $vmc_fields_all[ $vmc_field ] ); ?>" />
									</div>
									<?php
								} else {
									?>
									<div class="col-md-3 col-sm-6 col-xs-12 stm-select-col">
										<input type="text" name="<?php echo esc_attr( $vmc_field ); ?>" placeholder="<?php echo esc_attr( $vmc_fields_all[ $vmc_field ] ); ?>" />
									</div>
									<?php
								}
							endforeach;
						}
						?>
						<button type="submit" class="vmc-btn-submit heading-font" data-widget-id="value-my-car-<?php echo esc_attr( $uniqid ); ?>"><?php echo esc_html__( 'Value my Car', 'motors-elementor-widgets' ); ?><i class="fas fa-spinner"></i></button>
						<?php
						if ( class_exists( '\\STM_GDPR\\STM_GDPR' ) ) {
							echo do_shortcode( '[motors_gdpr_checkbox]' );
						}
						?>
					</div>
				</form>
			</div>
			<?php $tab_pane_activity_class = ''; ?>
		<?php endif; ?>

	</div>
</div>
