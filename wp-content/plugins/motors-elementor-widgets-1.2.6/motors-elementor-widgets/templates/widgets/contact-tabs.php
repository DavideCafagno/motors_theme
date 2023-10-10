<?php
if ( ! empty( $tab_panels ) ) :
	$unique_id = wp_rand( 1, 99999 );
	?>
	<div class="stm-elementor-contact-tabs">
		<div class="elementor-contact-tabs">
			<div class="elementor-contact-tabs-container">
				<ul class="elementor-contact-tabs-list">
					<?php foreach ( $tab_panels as $key => $data ) : ?>
					<li class="elementor-contact-tab <?php echo ( 0 === $key ) ? 'active' : ''; ?>" data-tab="<?php echo esc_attr( $unique_id . $key ); ?>">
						<span class="tab-item">
							<span class="elementor-contact-title-text">
								<?php
								if ( ! empty( $data['tab_title'] ) ) {
									echo esc_html( $data['tab_title'] );
								}
								?>
							</span>
						</span>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="contact-tabs-containers-wrap">
				<?php foreach ( $tab_panels as $key => $data ) : ?>
					<div class="elementor-contact-panels-container contact-panel-<?php echo esc_attr( $unique_id . $key ); ?> <?php echo ( 0 === $key ) ? 'active' : ''; ?>">
						<?php if ( ! empty( $data['first_icon'] ) || ! empty( $data['first_title'] ) || ! empty( $data['first_content'] ) ) : ?>
						<div class="tab-unit">
							<div class="icon">
								<?php
								if ( ! empty( $data['first_icon']['value'] ) && ! empty( $data['first_icon']['value'] ) ) :
									if ( 'svg' === $data['first_icon']['library'] && ! empty( $data['first_icon']['value']['url'] ) ) :
										?>
										<img src="<?php echo esc_attr( $data['first_icon']['value']['url'] ); ?>">
									<?php else : ?>
										<i class="<?php echo esc_attr( $data['first_icon']['value'] ); ?>"></i>
										<?php
									endif;
								endif;
								?>
							</div>
							<div class="text">
								<h4 class="title heading-font">
									<?php
									if ( ! empty( $data['first_title'] ) ) {
										echo esc_html( $data['first_title'] );
									}
									?>
								</h4>
								<div class="content heading-font">
									<?php
									if ( ! empty( $data['first_content'] ) ) {
										echo wp_kses_post( $data['first_content'] );
									}
									?>
								</div>
							</div>
						</div>
						<?php endif; ?>

						<?php if ( ! empty( $data['second_icon']['value'] ) || ! empty( $data['second_title'] ) || ! empty( $data['second_content'] ) ) : ?>
						<div class="tab-unit">
							<div class="icon">
								<?php
								if ( ! empty( $data['second_icon'] ) && ! empty( $data['second_icon']['value'] ) ) :
									if ( 'svg' === $data['second_icon']['library'] && ! empty( $data['second_icon']['value']['url'] ) ) :
										?>
										<img src="<?php echo esc_attr( $data['second_icon']['value']['url'] ); ?>">
									<?php else : ?>
										<i class="<?php echo esc_attr( $data['second_icon']['value'] ); ?>"></i>
										<?php
									endif;
								endif;
								?>
							</div>
							<div class="text">
								<h4 class="title heading-font">
									<?php
									if ( ! empty( $data['second_title'] ) ) {
										echo esc_html( $data['second_title'] );
									}
									?>
								</h4>
								<div class="content heading-font">
									<?php
									if ( ! empty( $data['second_content'] ) ) {
										echo wp_kses_post( $data['second_content'] );
									}
									?>
								</div>
							</div>
						</div>
						<?php endif; ?>

						<?php if ( ! empty( $data['third_icon']['value'] ) || ! empty( $data['third_title'] ) || ! empty( $data['third_content'] ) ) : ?>
						<div class="tab-unit">
							<div class="icon">
								<?php
								if ( ! empty( $data['third_icon'] ) && ! empty( $data['third_icon']['value'] ) ) :
									if ( 'svg' === $data['third_icon']['library'] && ! empty( $data['third_icon']['value']['url'] ) ) :
										?>
										<img src="<?php echo esc_attr( $data['third_icon']['value']['url'] ); ?>">
									<?php else : ?>
										<i class="<?php echo esc_attr( $data['third_icon']['value'] ); ?>"></i>
										<?php
									endif;
								endif;
								?>
							</div>
							<div class="text">
								<h4 class="title heading-font">
									<?php
									if ( ! empty( $data['third_title'] ) ) {
										echo esc_html( $data['third_title'] );
									}
									?>
								</h4>
								<div class="content heading-font">
									<?php
									if ( ! empty( $data['third_content'] ) ) {
										echo wp_kses_post( $data['third_content'] );
									}
									?>
								</div>
							</div>
						</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
endif;
