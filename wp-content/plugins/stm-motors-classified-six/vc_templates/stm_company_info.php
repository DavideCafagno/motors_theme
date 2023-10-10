<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_c_six_module_enqueue_scripts_styles('stm_company_info');

?>

<div class="stm-c-six-company-info-wrap <?php echo esc_attr( $css_class ); ?>">
    <?php if(!empty($address_value)) : ?>
    <div class="stm-info-block">
        <div class="title heading-font"><?php echo esc_html($address_title); ?></div>
        <div class="value heading-font"><?php echo esc_html($address_value); ?></div>
    </div>
    <?php endif; ?>
	<?php if(!empty($phone_value)) : ?>
        <div class="stm-info-block">
            <div class="title heading-font"><?php echo esc_html($phone_title); ?></div>
            <div class="value heading-font"><?php echo esc_html($phone_value); ?></div>
        </div>
	<?php endif; ?>
	<?php if(!empty($email_value)) : ?>
        <div class="stm-info-block">
            <div class="title heading-font"><?php echo esc_html($email_title); ?></div>
            <div class="value heading-font"><?php echo esc_html($email_value); ?></div>
        </div>
	<?php endif; ?>
</div>
