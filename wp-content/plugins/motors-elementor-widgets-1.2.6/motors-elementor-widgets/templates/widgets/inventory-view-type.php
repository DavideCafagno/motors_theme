<?php
$view_type = stm_listings_input( 'view_type', stm_me_get_wpcfto_mod( 'listing_view_type', 'list' ) );

if ( 'list' === $view_type ) {
	$view_list = 'active';
	$view_grid = '';
} else {
	$view_grid = 'active';
	$view_list = '';
}

?>
<div class="stm-view-by">
	<a href="#" class="view-grid view-type <?php echo esc_attr( $view_grid ); ?>" data-view="grid">
		<i class="stm-icon-grid"></i>
	</a>
	<a href="#" class="view-list view-type <?php echo esc_attr( $view_list ); ?>" data-view="list">
		<i class="stm-icon-list"></i>
	</a>
</div>