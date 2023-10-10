<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

stm_car_rental_module_enqueue_scripts_styles( 'stm_rental_two_icon_info_box' );

$imgVis = wp_get_attachment_image_url( $svg_image, 'full' );

?>
<div class="stm-mcr-icon-info-box <?php echo esc_attr( $css_class ); ?>">
    <div class="inner-wrap">
        <div class="stm-iconbox">
            <img src="<?php echo esc_url( $imgVis ); ?>"/>
        </div>
        <div class="title heading-font"><?php echo esc_html( $title ); ?></div>
        <div class="desc"><?php echo stm_do_lmth( $description ); ?></div>
    </div>
</div>
