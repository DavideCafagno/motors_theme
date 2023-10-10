<?php
$view_type = stm_me_get_wpcfto_mod( 'listing_view_type', 'grid' );

if ( ! empty( $_GET['view-type'] ) && in_array( array( 'grid', 'list' ), $_GET['view-type'], true ) ) {
	$view_type = sanitize_text_field( $_GET['view-type'] );
}

$ppp = ${'ppp_on_' . $view_type};

if ( ! isset( $post_type ) || empty( $post_type ) ) {
	$post_type = 'listings';
}

?>
<div class="motors-elementor-inventory-search-results" id="listings-result">
	<?php
	stm_listings_load_results(
		array(
			'posts_per_page' => $ppp,
			'post_type'      => $post_type,
		)
	);
	?>
</div>
