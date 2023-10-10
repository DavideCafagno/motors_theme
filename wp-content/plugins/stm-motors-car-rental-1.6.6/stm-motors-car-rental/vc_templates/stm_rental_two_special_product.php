<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
stm_car_rental_module_enqueue_scripts_styles( 'stm_rental_two_special_product' );
$id = stm_get_wpml_product_parent_id( $special_product );
$product = wc_get_product( $id );
$checkoutUrl = wc_get_checkout_url();

if ( $product->is_type( 'variable' ) ) {
    $variations = $product->get_available_variations();
    $prices = array();

    if ( !empty( $variations ) ) {
        $i = 0;
        foreach ( $variations as $variation ) {

            if ( ( !empty( $variation['display_price'] ) || !empty( $variation['display_regular_price'] ) ) and !empty( $variation['variation_description'] ) ) {

                $gets = array(
                    'add-to-cart' => $id,
                    'product_id' => $id,
                    'variation_id' => $variation['variation_id'],
                );

                foreach ( $variation['attributes'] as $key => $val ) {
                    $gets[$key] = $val;
                }

                $url = add_query_arg( $gets, $checkoutUrl );
            }

            $i++;

        }
    }
} else {
    $gets = array(
        'add-to-cart' => $id,
        'product_id' => $id
    );

    $url = add_query_arg( $gets, $checkoutUrl );
}

$prodImg = get_the_post_thumbnail_url( $product->get_id(), 'stm-img-350-181' );
?>
<div class="stm-mcr-special-product-wrap <?php echo esc_attr($css_class); ?>">
    <div class="row">
        <div class="col-md-5 col-sm-5 col-xs-4">
            <div class="btn-wrap">
                <a href="<?php echo get_the_permalink($id); ?>">
                    <div class="btn-title"><?php echo esc_html__( 'Rent Now', 'stm_motors_car_rental' ); ?></div>
                    <div class="product-title"><?php echo $product->get_name(); ?></div>
                </a>
            </div>
        </div>
        <div class="col-md-7 col-sm-7 col-xs-8">
            <div class="stm-mcr-special-prod-wrap">
                <div class="price-wrap">
                    <span><?php echo esc_html__( 'Start from', 'stm_motors_car_rental' ); ?></span>
                    <?php echo wc_price( $product->get_price() ); ?>
                </div>
                <div class="product-info">
                    <h4><?php echo esc_html( $product->get_name() ); ?></h4>
                    <?php if ( $atts_for_info ): ?>
                        <ul>
                            <?php
                            $prodAtts = stm_mcr_get_product_atts( $product );

                            foreach ( explode( ',', $atts_for_info ) as $val ) {
                                ?>
                                <li>
                                    <div class="attr-ico">
                                        <img src="<?php echo esc_url( $prodAtts['attribute_pa_' . $val]['img'] ); ?>"/>
                                    </div>
                                    <span class="value">
                                        <?php echo apply_filters( 'the_content', $prodAtts['attribute_pa_' . $val]['value'] ); ?>
                                    </span>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="product-img">
                    <img src="<?php echo esc_url( $prodImg ); ?>"/>
                </div>
            </div>
        </div>
    </div>
</div>
