<?php
/**
 * Loop listing compare link
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-compare/compare-link.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */

$compare_page = \uListing\Classes\StmListingSettings::getPages("compare_page");
?>
<a href="<?php echo esc_url(get_page_link($compare_page))?>">Compare <span class="ulisting_listing_compare_count_total">0</span> </a>