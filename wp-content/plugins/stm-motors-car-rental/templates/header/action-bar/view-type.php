<?php
$grid = '';
$list = 'active';

if(!empty($_GET['view-type']) && $_GET['view-type'] == 'grid') {
    $list = '';
    $grid = 'active';
}

$reservId = stm_me_get_wpcfto_mod('rental_datepick', '');
?>
<div class="view-type">
    <ul>
        <li>
            <a href="<?php echo get_the_permalink($reservId)?>?view-type=grid" class="<?php echo esc_attr($grid); ?>">
                <i class="stm-carent-rental-ico-grid"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo get_the_permalink($reservId)?>?view-type=list" class="<?php echo esc_attr($list); ?>">
                <i class="stm-carent-rental-ico-list"></i>
            </a>
        </li>
    </ul>
</div>
