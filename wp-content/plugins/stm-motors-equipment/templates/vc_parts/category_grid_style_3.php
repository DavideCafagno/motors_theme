<?php
$term  = $__vars;
$image = get_term_meta( $term['term_id'], 'stm_image', true );

if ( ! empty( $image ) ) {
	$image_alt = get_post_meta( $image, '_wp_attachment_image_alt', true );
	$image_alt = ( ! empty( $image_alt ) ) ? $image_alt : get_the_title( $image );
	$image     = wp_get_attachment_image_src( $image, 'full' );
}

?>

<div class="cat_grid_item">
	<a href="<?php echo esc_url( stm_get_listing_archive_link() . '?' . $term['taxonomy'] . '=' . $term['slug'] ); ?>">
		<div class="wrapper">
			<div class="cat-icon">
				<?php if ( ! empty( $image ) ) : ?>
					<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" />
				<?php else : ?>
					<h4><?php echo esc_html( $term['name'] ); ?></h4>
				<?php endif; ?>
			</div>
		</div>
	</a>
</div>
