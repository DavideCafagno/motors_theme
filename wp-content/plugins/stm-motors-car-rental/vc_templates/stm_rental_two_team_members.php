<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

stm_car_rental_module_enqueue_scripts_styles('stm_rental_two_team_members');

$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

?>

<div class="stm-mcr-team-members-wrap <?php echo esc_attr($css_class); ?>">
    <?php echo wpb_js_remove_wpautop($content); ?>
</div>