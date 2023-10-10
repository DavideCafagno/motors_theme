<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = ( ! empty( $css ) ) ? apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) ) : '';

stm_equipment_module_enqueue_scripts_styles( 'stm_equip_inventory' );

$term_title = '';
if ( ! empty( $_GET['body'] ) ) {
	$stm_term = get_term_by( 'slug', sanitize_text_field( $_GET['body'] ), 'body', 'OBJECT' );
	if ( ! empty( $stm_term ) && is_object( $stm_term ) ) {
		$term_title = '<span class="colored">' . $stm_term->name . '</span>';
	}
}

if ( ! empty( $_GET['listing-type'] ) ) {
	$stm_term = get_term_by( 'slug', sanitize_text_field( $_GET['listing-type'] ), 'listing-type', 'OBJECT' );
	if ( ! empty( $stm_term ) && is_object( $stm_term ) ) {
		$term_title = ( ! empty( $term_title ) ) ? $term_title . ' ' . $stm_term->name : $stm_term->name;
	}
}

$inventory_title = ( ! empty( $term_title ) ) ? $term_title : __( '<span class="colored">Inventory</span> For Sale/Rent', 'stm_motors_equipment' );

?>
<div class="stm-equip-inventory">

		<?php
		$query = stm_listings_query();

		if ( $query->have_posts() ) :

			// stm_listings_load_template( 'filter/badges' );

			// stm_listings_load_template( 'classified/filter/featured' );
			?>
			<div class="title">
				<h3 class="heading-font"><?php echo $inventory_title; ?></h3>
				<a href="<?php echo esc_url( stm_get_listing_archive_link() ); ?>?featured_top=true" class="all-offers">
					<span class="vt-top heading-font"><?php esc_html_e( 'Available', 'stm_motors_equipment' ); ?></span>
					<span class="lt-blue heading-font"><?php echo sprintf( esc_html__( '%s Equipment', 'stm_motors_equipment' ), $query->found_posts ); ?></span>
				</a>
			</div>
			<div id="listings-result">
			<?php

			while ( $query->have_posts() ) :
				$query->the_post();
				stm_equipment_load_template( 'vc_parts/grid-loop' );
			endwhile;
			?>
			</div>
		<div class="inventory-bottom">
			<?php stm_listings_load_pagination(); ?>
			<?php stm_equipment_load_template( 'parts/items-per-page' ); ?>
		</div>
			<?php
		else :
			?>
		<h3><?php esc_html_e( 'Sorry, No results', 'stm_motors_equipment' ); ?></h3>
		<?php endif; ?>
		<?php if ( stm_is_aircrafts() ) : ?>
		<script>
			jQuery(document).ready(function (){
				var showing = '<?php echo esc_html( $query->found_posts ); ?>';

				jQuery('.ac-total').text('<?php echo esc_html( $query->found_posts ); ?>');

				if(showing === '0') {
					jQuery('.ac-showing').text('0');
				}
			});
		</script>
			<?php
		endif;
		wp_reset_query();
		?>
</div>
