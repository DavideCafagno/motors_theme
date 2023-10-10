<?php
if ( ! empty( $panels ) ) :
	if ( empty( $title_heading ) ) {
		$title_heading = 'h4';
	}
	?>
	<div class="stm-elementor-accordion">
		<div class="stm-elementor-accordion-container">
			<div class="stm-elementor-panels-container">
				<?php foreach ( $panels as $key => $panel ) : ?>
					<div class="stm-elementor-panel <?php echo ( 0 === $key ) ? 'active' : ''; ?>">
						<div class="stm-elementor-panel-heading" data-heading="panel-<?php echo esc_attr( $key ); ?>">
							<<?php echo esc_attr( $title_heading ); ?> class="stm-elementor-panel-title">
								<?php
								if ( ! empty( $panel['icon'] ) && ! empty( $panel['icon']['value'] ) ) :
									if ( 'svg' === $panel['icon']['library'] && ! empty( $panel['icon']['value']['url'] ) ) :
										?>
										<img src="<?php echo esc_attr( $panel['icon']['value']['url'] ); ?>" class="stm-accordion-svg-icon" alt="<?php esc_html_e( 'SVG icon', 'motors-elementor-widgets' ); ?>">
										<?php else : ?>
										<i class="stm-elementor-panel-icon <?php echo esc_attr( $panel['icon']['value'] ); ?>"></i>
											<?php
									endif;
								endif;
								?>
								<span class="panel-title-text">
									<?php echo esc_html( $panel['title'] ); ?>
								</span>
								<i class="stm-elementor-panel-control-icon-chevron fas fa-chevron-down"></i>
							</<?php echo esc_attr( $title_heading ); ?>>
						</div>
						<div class="stm-elementor-panel-body" data-content="panel-<?php echo esc_attr( $key ); ?>" <?php echo ( 0 === $key ) ? 'style="display: block;"' : ''; ?>>
							<div class="stm-elementor-panel-content">
								<div class="panel-content-wrap">
									<?php echo wp_kses_post( $panel['content'] ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
endif;
