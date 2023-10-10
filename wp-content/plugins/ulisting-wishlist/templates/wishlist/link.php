<?php
/**
 * Wishlist link
 *
 * Template can be modified by copying it to yourtheme/ulisting/wishlist/link.php
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.2
 */
$wishlist_page = \uListing\Classes\StmListingSettings::getPages("wishlist_page");
?>
<div class="ulisting-wishlist-link">
	<a href="<?php echo esc_url(get_page_link($wishlist_page))?>">
		<?php _e("Wishlist", "ulisting")?> <span class="ulisting-wishlist-total-count-all"><?php echo esc_attr($total)?></span>
	</a>
	<ul class="ulisting-account-panel-dropdown-menu">
		<li>
			<a class="nav-link " href="<?php echo esc_url(get_page_link($wishlist_page))?>/wishlist-list">
				<?php _e("Listing")?>
				<span class="badge badge-secondary ulisting-wishlist-total-count">0</span>
			</a>
		</li>
		<li>
			<a class="nav-link " href="<?php echo esc_url(get_page_link($wishlist_page))?>/saved-searches-list">
				<?php _e("Search")?>
				<span class="badge badge-secondary ulisting-saved-searches-total-count">0</span>
			</a>
		</li>
	</ul>
</div>

