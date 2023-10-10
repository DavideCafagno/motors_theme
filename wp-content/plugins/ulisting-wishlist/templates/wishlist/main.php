<?php
if(empty($endpoint))
	$endpoint = 'wishlist-list'
?>

<ul class="nav nav-pills nav-fill">

	<li class="nav-item">
		<a href="<?php echo esc_url($wishlist_page_url)?>/wishlist-list"  class="nav-link <?php echo ('wishlist-list' == $endpoint) ? 'active' : null?> ">
			<span  class="badge badge-dark ulisting-wishlist-total-count"><?php echo \uListing\UlistingWishlist\Classes\UlistingWishlist::get_total_count()?></span>
			<?php _e("Wishlist", "ulisting")?>
		</a>
	</li>

	<li class="nav-item">
		<a href="<?php echo esc_url($wishlist_page_url)?>/saved-searches-list" class="nav-link <?php echo ('saved-searches-list' == $endpoint) ? 'active' : null?>  ">
			<span  class="badge badge-dark ulisting-saved-searches-total-count"><?php echo \uListing\Classes\UlistingSearch::get_total_count()?></span>
			<?php _e("Saved Search", "ulisting")?>
		</a>
	</li>

</ul>

<div class="tab-content">
	<div class="tab-pane fade show active" >
		<?php
		switch ($endpoint){
			case "wishlist-list":
				do_action('ulisting-wishlist-render-page');
				break;
			case "saved-searches-list":
				do_action('ulisting-saved-searches-render-page');
				break;
		}
		?>
	</div>
</div>


