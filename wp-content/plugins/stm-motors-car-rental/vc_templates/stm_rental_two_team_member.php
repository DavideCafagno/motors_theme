<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

?>

<div class="stm-mcr-team-member <?php echo esc_attr($css_class); ?>">
    <div class="img-wrap">
        <?php if(!empty($image)) : ?>
        <img src="<?php echo wp_get_attachment_image_url($image, 'full'); ?>" />
        <?php endif; ?>
    </div>
    <div class="socials-list">
        <?php if(!empty($fb || $tw || $insta)) : ?>
            <ul>
                <?php if(!empty($fb)) : ?>
                    <li>
                        <a href="<?php echo esc_url($fb);?>"><i class="fab fa-facebook-f"></i></a>
                    </li>
                <?php endif; ?>
                <?php if(!empty($tw)) : ?>
                    <li>
                        <a href="<?php echo esc_url($tw);?>"><i class="fab fa-twitter"></i></a>
                    </li>
                <?php endif; ?>
                <?php if(!empty($insta)) : ?>
                    <li>
                        <a href="<?php echo esc_url($insta);?>"><i class="fab fa-instagram"></i></a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="member-info">
        <div class="member-name"><?php echo (!empty($member_name)) ? $member_name : ''; ?></div>
        <div class="member-position"><?php echo (!empty($member_position)) ? $member_position : ''; ?></div>
    </div>
</div>