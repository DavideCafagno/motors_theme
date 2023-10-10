<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$specifications = get_post_meta( $listing_id, 'listing_specifications', true );

if ( ! empty( $specifications ) ) :
	?>
	<div class="listing-specification-cols <?php echo esc_attr( $specific_columns ); ?>">
		<?php
		foreach ( $specifications as $k => $specific ) :

			$float = '';
			if ( 'two_column' === $specific_columns ) {
				$float = ( 0 === $k % 2 ) ? 'left' : 'right';
			}
			?>
		<div class="listing-specifications-wrap <?php echo esc_attr( $float ); ?>">
			<div class="title_wrap">
				<?php if ( ! empty( $specific['icon'] ) ) : ?>
					<i class="<?php echo esc_attr( $specific['icon'] ); ?>"></i>
				<?php endif; ?>

				<?php if ( ! empty( $specific['main_title'] ) ) : ?>
				<<?php echo esc_attr( $li_tag ); ?> class="title"><?php echo esc_html( $specific['main_title'] ); ?></<?php echo esc_attr( $li_tag ); ?>>
				<?php endif; ?>
			</div>
			<div class="info-list-wrap">
				<?php
				if ( ! empty( count( $specific['fields'] ) > 0 ) ) {
					echo '<ul>';
					foreach ( $specific['fields'] as $item ) {
						if ( ! empty( $item['item_title'] ) || ! empty( $item['item_val'] ) ) {
							$li  = '<li>';
							$li .= '<span class="item-title">' . $item['item_title'] . '</span>';
							$li .= '<span class="item-value">' . $item['item_val'] . '</span>';
							$li .= '</li>';

							echo wp_kses_post( $li );
						}
					}
					echo '</ul>';
				}
				?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php
endif;
