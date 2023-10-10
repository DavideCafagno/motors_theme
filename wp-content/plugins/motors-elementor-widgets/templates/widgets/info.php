<div class="listing-infos-wrap">
	<div class="title_wrap">
		<?php echo wp_kses( $li_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
		<<?php echo esc_attr( $li_tag ); ?> class="title"><?php echo esc_html( $li_title ); ?></<?php echo esc_attr( $li_tag ); ?>>
	</div>
	<div class="info-list-wrap">
		<?php
		if ( ! empty( $listing_info ) ) {
			echo '<ul>';
			foreach ( $listing_info as $item ) {
				$li  = '<li>';
				$li .= '<span class="item-title">' . $item['li_item_title'] . '</span>';
				$li .= '<span class="item-value">' . $item['li_item_desc'] . '</span>';
				$li .= '</li>';

				echo wp_kses_post( $li );
			}
			echo '</ul>';
		}
		?>
	</div>
</div>
