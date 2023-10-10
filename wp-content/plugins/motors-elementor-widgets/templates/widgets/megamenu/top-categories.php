<div class="stm_mm_top_categories_wrap">
	<?php if ( ! empty( $title ) ) : ?>
		<h3><?php echo esc_html( $title ); ?></h3>
	<?php endif; ?>
	<div class="stm_mm-cats-grid">
		<?php
		if ( ! empty( $categories ) ) {
			foreach ( $categories as $category ) {

				$cats     = explode( ' | ', $category );
				$stm_cat  = $cats[0];
				$main_cat = $cats[1];

				$stm_term = get_term_by( 'slug', $stm_cat, $main_cat );

				if ( empty( $stm_term ) || ! ( $stm_term instanceof WP_Term ) ) {
					continue;
				}

				$image          = get_term_meta( $stm_term->term_id, 'stm_image', true );
				$image          = wp_get_attachment_image_src( $image, 'stm-img-190-132' );
				$category_image = ( ! empty( $image[0] ) ) ? $image[0] : null;
				?>
				<a href="<?php echo esc_url( stm_get_listing_archive_link( array( $main_cat => $stm_term->slug ) ) ); ?>"
						class="stm_listing_icon_filter_single"
						title="<?php echo esc_attr( $stm_term->name ); ?>">
					<div class="inner">
						<?php if ( ! empty( $category_image ) ) : ?>
							<div class="image">
								<img src="<?php echo esc_url( $category_image ); ?>"
										alt="<?php echo esc_attr( $stm_term->name ); ?>"/>
							</div>
						<?php endif; ?>
						<div class="name"><?php echo esc_html( $stm_term->name ); ?></div>
					</div>
				</a>
				<?php
			}
		}
		?>
	</div>
</div>
