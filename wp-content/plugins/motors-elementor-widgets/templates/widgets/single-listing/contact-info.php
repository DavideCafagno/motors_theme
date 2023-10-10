<div class="contact-info-wrap">
	<div class="title_wrap">
		<?php echo wp_kses( $ci_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
		<<?php echo esc_attr( $ci_tag ); ?> class="title"><?php echo esc_html( $ci_title ); ?></<?php echo esc_attr( $ci_tag ); ?>>
	</div>
	<div class="contact-desc">
		<?php echo esc_html( $ci_description ); ?>
	</div>
	<div class="info-list-wrap">
		<?php
		if ( ! empty( $contact_info ) ) {
			foreach ( $contact_info as $item ) {
				$html = '<div class="info-item">';

				if ( ! empty( $item['ci_item_icon'] ) && ! empty( $item['ci_item_icon']['value'] ) ) :
					if ( 'svg' === $item['ci_item_icon']['library'] && ! empty( $item['ci_item_icon']['value']['url'] ) ) :
						$html .= '<img src="' . esc_attr( $item['ci_item_icon']['value']['url'] ) . '" class="stm-accordion-svg-icon" alt="' . esc_html__( 'SVG icon', 'motors-elementor-widgets' ) . '">';
					else :
						$html .= '<i class="' . esc_attr( $item['ci_item_icon']['value'] ) . '"></i>';
					endif;
				endif;
				$html .= '<div class="info-data">';
				$html .= ( ! empty( $item['ci_item_title'] ) ) ? '<span class="item-title">' . $item['ci_item_title'] . '</span>' : '';
				$html .= ( ! empty( $item['ci_item_desc'] ) ) ? '<span class="item-value">' . $item['ci_item_desc'] . '</span>' : '';
				$html .= '</div></div>';

				echo wp_kses_post( $html );
			}
		}
		?>
	</div>
</div>
