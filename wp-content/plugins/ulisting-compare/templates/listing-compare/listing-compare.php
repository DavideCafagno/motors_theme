<?php
/**
 * Loop listing compare
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-compare/listing-compare.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>

<?php if(ulisting_listing_compare_active()):?>
<?php
	$active = null;
	if(\uListing\ListingCompare\Classes\UlistingListingCompare::is_active($args['model']->ID))
		$active = "active";
?>
	<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?> >
		<div class="ulisting_listing-compare">
			<?php
				$element['params']['listing_id'] = $args['model']->ID;
				$element['params']['active']     = $active;
				echo ($element['params']['template']) ? \uListing\ListingCompare\Classes\UlistingListingCompare::render_compare($element['params']) : null;
			?>
		</div>
	</div>
<?php endif;?>