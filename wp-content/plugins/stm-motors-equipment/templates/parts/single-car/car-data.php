<?php
$data    = apply_filters( 'stm_single_car_data', stm_get_single_car_listings() );
$post_id = get_the_ID();
$vin_num = get_post_meta( get_the_id(), 'vin_number', true );

$show_vin              = stm_me_get_wpcfto_mod( 'show_vin', false );
$show_history          = stm_me_get_wpcfto_mod( 'show_history', false );
$show_certified_logo_1 = stm_me_get_wpcfto_mod( 'show_certified_logo_1', false );
$show_certified_logo_2 = stm_me_get_wpcfto_mod( 'show_certified_logo_2', false );

$history_link_1   = get_post_meta( get_the_ID(), 'history_link', true );
$certified_logo_1 = get_post_meta( get_the_ID(), 'certified_logo_1', true );

$history_link_2   = get_post_meta( get_the_ID(), 'certified_logo_2_link', true );
$certified_logo_2 = get_post_meta( get_the_ID(), 'certified_logo_2', true );

if ( ( $show_vin && ! empty( $vin_num ) ) || ! empty( $data ) || ( ! empty( $certified_logo_1 ) && $show_certified_logo_1 ) || ( ! empty( $certified_logo_2 ) && $show_certified_logo_2 ) ) : ?>
	<div class="single-car-data">
		<?php

		if ( stm_check_if_car_imported( get_the_ID() ) and empty( $certified_logo_1 ) and ! empty( $history_link_1 ) ) {
			$certified_logo_1 = 'automanager_default';
		}

		if ( $show_certified_logo_1 && ! empty( $certified_logo_1 ) ) :
			if ( $certified_logo_1 == 'automanager_default' ) {
				$certified_logo_1    = array();
				$certified_logo_1[0] = get_stylesheet_directory_uri() . '/assets/images/carfax.png';
			} else {
				$certified_logo_1 = wp_get_attachment_image_src( $certified_logo_1, 'stm-img-255-135' );
			}
			if ( ! empty( $certified_logo_1[0] ) ) {
				$certified_logo_1 = $certified_logo_1[0];
				?>
				<div class="text-center stm-single-car-history-image">
					<?php if ( $show_history ) : ?>
					<a href="<?php echo esc_url( $history_link_1 ); ?>" target="_blank">
					<?php endif; ?>
						<img src="<?php echo esc_url( $certified_logo_1 ); ?>" class="img-responsive dp-in"/>
					<?php if ( $show_history ) : ?>
					</a>
					<?php endif; ?>
				</div>
				<?php
			}
		endif;

		if ( stm_check_if_car_imported( get_the_ID() ) and empty( $certified_logo_2 ) and ! empty( $history_link_2 ) ) {
			$certified_logo_2 = 'automanager_default';
		}

		if ( ! empty( $certified_logo_2 ) && $show_certified_logo_2 ) :
			if ( $certified_logo_2 == 'automanager_default' ) {
				$certified_logo_2    = array();
				$certified_logo_2[0] = get_stylesheet_directory_uri() . '/assets/images/carfax.png';
			} else {
				$certified_logo_2 = wp_get_attachment_image_src( $certified_logo_2, 'full' );
			}
			if ( ! empty( $certified_logo_2[0] ) ) {
				$certified_logo_2 = $certified_logo_2[0];
				?>
				<div class="text-center stm-single-car-history-image">
					<a href="<?php echo esc_url( $history_link_2 ); ?>" target="_blank">
						<img src="<?php echo esc_url( $certified_logo_2 ); ?>" class="img-responsive dp-in"/>
					</a>
				</div>
				<?php
			}
		endif;
		?>
		
		
		<table>
			<?php if ( ! empty( $data ) ) : ?>
				<?php foreach ( $data as $data_value ) : ?>
					<?php
					$affix = '';
					if ( ! empty( $data_value['number_field_affix'] ) ) {
						$affix = $data_value['number_field_affix'];
					}
					?>
					
					<?php if ( $data_value['slug'] != 'price' ) : ?>
						<?php $data_meta = get_post_meta( $post_id, $data_value['slug'], true ); ?>
						<?php if ( $data_meta !== '' ) : ?>
							<tr>
								<td class="t-label heading-font"><?php esc_html_e( $data_value['single_name'], 'stm_motors_equipment' ); ?></td>
								<?php if ( ! empty( $data_value['numeric'] ) and $data_value['numeric'] ) : ?>
									<td class="t-value h6"><?php echo esc_attr( ucfirst( $data_meta . $affix ) ); ?></td>
								<?php else : ?>
									<?php
									$data_meta_array = explode( ',', $data_meta );
									$datas           = array();

									if ( ! empty( $data_meta_array ) ) {
										foreach ( $data_meta_array as $data_meta_single ) {
											$data_meta = get_term_by( 'slug', $data_meta_single, $data_value['slug'] );
											if ( ! empty( $data_meta->name ) ) {
												$datas[] = esc_attr( $data_meta->name ) . $affix;
											}
										}
									}
									?>
									<td class="t-value h6"><?php echo implode( ', ', $datas ); ?></td>
								<?php endif; ?>
							</tr>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			<!--VIN NUMBER-->
			<?php if ( $show_vin && ! empty( $vin_num ) ) : ?>
				<tr>
					<td class="t-label"><?php esc_html_e( 'VIN', 'stm_motors_equipment' ); ?></td>
					<td class="t-value t-vin h6"><?php echo esc_attr( $vin_num ); ?></td>
				</tr>
			<?php endif; ?>
		</table>
	</div>
<?php endif; ?>
