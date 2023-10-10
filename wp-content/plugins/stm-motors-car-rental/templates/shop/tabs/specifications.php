<div class="car-specifications">
    <?php foreach ($__vars as $var) {
        if(!$var['visible']) continue;
        ?>
        <div class="car-spec-item">
            <div class="img">
                <img src="<?php echo esc_url($var['img']); ?>" />
            </div>
            <div class="type">
                <span><?php echo apply_filters('stm_mcr_lmth', $var['label']); ?></span>
            </div>
            <div class="value">
                <span><?php echo apply_filters('stm_mcr_lmth', $var['value']); ?></span>
            </div>
        </div>
    <?php } ?>
</div>
