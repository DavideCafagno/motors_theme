<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
stm_car_rental_module_enqueue_scripts_styles('stm_rental_info_box');

$imgVis = wp_get_attachment_image_url($image, 'full');
$imgHide = wp_get_attachment_image_url($hide_image, 'full');

?>
<div class="stm-mcr-info-box <?php echo esc_attr($css_class); ?>">
	<div class="info-wrap">
        <span>
            <div class="stm_iconbox stm_flipbox stm_iconbox__icon-top clearfix">
                <div class="stm_flipbox__front">
                    <div class="inner">
                        <div class="inner-flex">
                            <div class="stm_iconbox__icon">
                                <img src="<?php echo esc_url($imgVis); ?>" />
                            </div>
                            <div class="ib-title heading-font"><?php echo esc_html($title); ?></div>
							<div class="ib-desc"><?php echo stm_do_lmth($description); ?></div>
                        </div>
                    </div>
                </div>
                <div class="stm_flipbox__back">
                    <div class="inner mbc">
                        <div class="inner-flex">
							<div class="stm_iconbox__icon">
                                <img src="<?php echo esc_url($imgHide); ?>" />
                            </div>
                            <div class="ib-desc"><?php echo stm_do_lmth($hide_description); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </span>
	</div>
</div>
