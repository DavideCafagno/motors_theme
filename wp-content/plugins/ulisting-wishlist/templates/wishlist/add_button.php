<?php
/**
 * Wishlist add button
 *
 * Template can be modified by copying it to yourtheme/ulisting/wishlist/add_button.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.1
 */
?>

<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?> >
	<?php echo ( class_exists("\uListing\UlistingWishlist\Classes\UlistingWishlist") AND $element['params']['template']) ? \uListing\UlistingWishlist\Classes\UlistingWishlist::render_add_button($element['params']['template'], $args['model']) : null; ?>
</div>
