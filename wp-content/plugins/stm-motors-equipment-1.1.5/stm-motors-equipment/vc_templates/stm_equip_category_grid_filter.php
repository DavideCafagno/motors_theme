<?php
stm_equipment_module_enqueue_scripts_styles( 'stm_equip_category_grid_filter' );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$cat_num = array(
	'style_1' => 6,
	'style_2' => 8,
	'style_3' => $cat_numbers,
);

$terms = get_terms(
	$selected_category,
	array(
		'number'     => $cat_num[ $view_style ],
		'hide_empty' => false,
	)
);

?>

<div class="stm_equip_category_grid_filter_wrap <?php echo esc_attr( $css_class . ' ' . $view_style ); ?>">
		<h3><?php echo esc_html( $title ); ?></h3>
		<div class="filter-grid">
			<?php
			if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					stm_equipment_load_template( 'vc_parts/category_grid_' . $view_style, (array) $term );
				}
			}
			?>
		</div>
</div>
