<div class="stm-elementor-contact-form-seven">
	<div class="icon-title">
		<?php
		if ( ! empty( $icon ) && ! empty( $icon['value'] ) ) :
			if ( 'svg' === $icon['library'] && ! empty( $icon['value']['url'] ) ) :
				?>
				<img src="<?php echo esc_attr( $icon['value']['url'] ); ?>" class="svg-icon" alt="<?php esc_html_e( 'SVG icon', 'stm-elementor-widgets' ); ?>">
				<?php else : ?>
				<i class="stm-elementor-icon <?php echo esc_attr( $icon['value'] ); ?>"></i>
					<?php
			endif;
		endif;

		if ( $title ) :
			?>
			<<?php echo esc_attr( $title_heading ); ?> class="heading-font title">
				<?php echo esc_html( $title ); ?>
			</<?php echo esc_attr( $title_heading ); ?>>
		<?php endif; ?>
	</div>
	<?php
	if ( ! empty( $form_id ) && 'none' !== $form_id ) {
		$cf7 = get_post( $form_id );

		if ( ! empty( $cf7 ) && is_object( $cf7 ) ) {
			echo( do_shortcode( '[contact-form-7 id="' . $cf7->ID . '" title="' . ( $cf7->post_title ) . '"]' ) );
		}
	}
	?>
</div>
