<?php
$imgOne = ( !empty( $__vars[0] ) ) ? wp_get_attachment_image_url( $__vars[0], 'stm-mcr-974-548' ) : '';
$imgTwo = ( !empty( $__vars[1] ) ) ? wp_get_attachment_image_url( $__vars[1], 'stm-mcr-472-266' ) : '';
$imgThree = ( !empty( $__vars[2] ) ) ? wp_get_attachment_image_url( $__vars[2], 'stm-mcr-472-266' ) : '';
$imgOneFull = ( !empty( $__vars[0] ) ) ? wp_get_attachment_image_url( $__vars[0], 'full' ) : '';
$imgTwoFull = ( !empty( $__vars[1] ) ) ? wp_get_attachment_image_url( $__vars[1], 'full' ) : '';
$imgThreeFull = ( !empty( $__vars[2] ) ) ? wp_get_attachment_image_url( $__vars[2], 'full' ) : '';
?>
<div class="gallery-item-wrap">
    <?php if ( !empty( $imgOne ) ) : ?>
        <div class="img-one stm-mcr-light-gallery" data-src="<?php echo esc_url($imgOneFull); ?>">
            <img src="<?php echo esc_url( $imgOne ); ?>"/>
            <span class="stm-carent-rental-ico-zoom"></span>
        </div>
    <?php endif; ?>
    <div class="gallery-right">
        <?php if ( !empty( $imgTwo ) ) : ?>
            <div class="img-two stm-mcr-light-gallery" data-src="<?php echo esc_url($imgTwoFull); ?>">
                <img src="<?php echo esc_url( $imgTwo ); ?>"/>
                <span class="stm-carent-rental-ico-zoom"></span>
            </div>
        <?php endif; ?>
        <?php if ( !empty( $imgThree ) ) : ?>
            <div class="img-three stm-mcr-light-gallery" data-src="<?php echo esc_url($imgThreeFull); ?>" >
                <img src="<?php echo esc_url( $imgThree ); ?>"/>
                <span class="stm-carent-rental-ico-zoom"></span>
            </div>
        <?php endif; ?>
    </div>
</div>
