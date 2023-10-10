<?php
/**
 * @var $items
 * @var $select_prefix
 * @var $select_affix
 * @var $number_prefix
 * @var $number_affix
 * @var $show_amount
 */

$words = compact(
	'select_prefix',
	'select_affix',
	'number_prefix',
	'number_affix',
);

$pt_tax_arr = array();

?>
<div class="stm-c-f-search-form-wrap multilisting-search-tabs-wrap">
	<ul class="nav nav-tabs" role="tablist">
		<?php foreach ( $items as $index => $item ) : ?>
			<?php
			$pt_tax_arr[ $item['listing_type'] ] = $item['listing_type'];
			$active_item_class                   = ( 0 === $index ) ? 'active' : '';
			?>
			<li class="nav-item <?php echo esc_attr( $active_item_class ); ?>">
				<?php $icon = stm_multilisting_get_type_icon_by_slug( $item['listing_type'] ); ?>
				<a href="#<?php echo esc_attr( $item['listing_type'] ); ?>"
						class="nav-link stm-cursor-pointer heading-font <?php echo esc_attr( $active_item_class ); ?>"
						role="tab"
						data-toggle="tab"
						data-slug="<?php echo esc_attr( $item['listing_type'] ); ?>"
						aria-controls="<?php echo esc_attr( $item['listing_type'] ); ?>">
					<?php if ( ! empty( $icon ) ) : ?>
						<i class="<?php echo esc_attr( $icon ); ?>"></i>
					<?php endif; ?>
					<?php echo esc_html( $item['item_title'] ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>

	<div class="tab-content">

		<?php foreach ( $items as $index => $item ) : ?>
			<?php $active_item_class = ( 0 === $index ) ? 'active in' : ''; ?>
			<div class="tab-pane fade <?php echo esc_attr( $active_item_class ); ?>"
					id="<?php echo esc_attr( $item['listing_type'] ); ?>"
					role="tabpanel">
				<?php
				if ( ! empty( $item['listing_type'] ) ) {
					$stm_post_type_link = apply_filters( 'stm_inventory_page_url', false, $item['listing_type'] );
				} else {
					$stm_post_type_link = apply_filters( 'stm_inventory_page_url', false );
				}
				?>
				<form action="<?php echo esc_url( $stm_post_type_link ); ?>" method="get">
					<div class="row">
						<div class="col-md-10">
							<div class="stm-filter-tab-selects filter stm-vc-ajax-filter">
								<input type="hidden" name="posttype" value="<?php echo esc_attr( $item['listing_type'] ); ?>">
								<?php
								set_query_var( 'listings_type', $item['listing_type'] );
								HooksMultiListing::stm_listings_attributes_filter( array( 'slug' => $item['listing_type'] ) );
								$postfix = ( 'listings' === $item['listing_type'] ) ? '' : '_' . $item['listing_type'];
								if ( isset( $item[ 'items_filter_selected' . $postfix ] ) && is_array( $item[ 'items_filter_selected' . $postfix ] ) && ! empty( $item[ 'items_filter_selected' . $postfix ] ) ) {
									stm_listing_filter_get_selects(
										implode( ',', $item[ 'items_filter_selected' . $postfix ] ),
										$item['listing_type'],
										$words,
										$show_amount,
									);
								}
								?>
							</div>
						</div>
						<div class="col-md-2">
							<button class="heading-font" type="submit"><?php echo esc_html( $item['button_label'] ); ?></button>
						</div>
					</div>
				</form>
			</div>
		<?php endforeach; ?>

	</div>
</div>
<?php
$bind_tax = array();
foreach ( $pt_tax_arr as $item ) {
	set_query_var( 'listings_type', $item );
	HooksMultiListing::stm_listings_attributes_filter( array( 'slug' => $item ) );

	$bind_tax = array_merge( $bind_tax, stm_data_binding( true ) );
}

if ( ! empty( $bind_tax ) ) :
	?>
	<script>
		jQuery(function ($) {
			var options = <?php echo wp_json_encode( $bind_tax ); ?>,
				show_amount = <?php echo wp_json_encode( 'yes' === $show_amount ); ?>;

			if (show_amount) {
				$.each(options, function (tax, data) {
					$.each(data.options, function (val, option) {
						option.label += ' (' + option.count + ')';
					});
				});
			}

			$('.stm-filter-tab-selects.filter').each(function () {
				new STMCascadingSelect(this, options);
			});
		});
	</script>
	<?php
endif;
