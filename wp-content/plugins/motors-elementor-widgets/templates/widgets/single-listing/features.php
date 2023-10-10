<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$features = get_post_meta( $listing_id, 'additional_features', true );
$features = ( ! empty( $features ) ) ? explode( ',', $features ) : '';

if ( empty( $features_list ) || ! is_array( $features_list ) ) {
	$features_list = array();
}

if ( ! empty( $features ) ) {
	$features = array_intersect( $features_list, $features );
} else {
	$features = $features_list;
}

?>
<!-- only visible in Elementor editor when the widget is empty -->
<div class="stm-elementor-editor-preview-icon" style="margin-bottom: -25px;">
	<i class="fas fa-cubes" style="font-size: 30px;"></i>
	<p style="margin: 0;"><?php echo esc_html__( 'Features', 'motors-elementor-widgets' ); ?></p>
</div>
<style>
	.stm-elementor-editor-preview-icon {
		display: none;
	}

	.elementor-editor-active .elementor-widget-empty .stm-elementor-editor-preview-icon {
		display: block !important;
		text-align: center;
		max-width: fit-content;
		margin: 0 auto;
		padding: 10px;
	}
</style>
<?php

if ( ! empty( $features ) ) :
	?>
	<div class="stm-single-listing-car-features">
		<div class="lists-<?php echo esc_attr( $features_type ); ?>">
			<ul>
				<?php foreach ( $features as $key => $feature ) : ?>
					<li class="row-<?php echo esc_attr( $features_rows ); ?>">
						<?php echo wp_kses( $features_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
						<span><?php echo esc_html( stm_dynamic_string_translation( 'Car feature ' . $feature, $feature ) ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>
