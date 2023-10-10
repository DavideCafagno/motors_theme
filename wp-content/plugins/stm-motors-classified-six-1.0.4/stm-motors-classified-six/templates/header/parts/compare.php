<?php
$compare_page = \uListing\Classes\StmListingSettings::getPages("compare_page");

if ($compare_page):
    $compareCookie = (!empty($_COOKIE['ulisting_compare'])) ? (array) $_COOKIE['ulisting_compare'] : array();
    $compareCount = (!empty($compareCookie)) ? count((array) json_decode(stripslashes($compareCookie[0]))) : 0;
?>
<div class="stm-compare">
    <a class="lOffer-compare" href="<?php echo esc_url(get_the_permalink($compare_page)); ?>"
       title="<?php esc_attr_e('Watch compared', 'motors'); ?>">
        <i class="stm-all-icon-listing-compare"></i>
        <span class="list-badge">
            <span class="stm-current-cars-in-compare">
                <?php if ($compareCount != 0) {
                    echo esc_html($compareCount);
                } ?>
            </span>
        </span>
    </a>
</div>
<?php endif; ?>