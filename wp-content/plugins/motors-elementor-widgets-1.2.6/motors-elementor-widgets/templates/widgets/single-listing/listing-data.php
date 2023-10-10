<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$data             = apply_filters( 'stm_single_car_data', stm_get_single_car_listings() );
$history_link_1   = get_post_meta( $listing_id, 'history_link', true );
$certified_logo_1 = get_post_meta( $listing_id, 'certified_logo_1', true );
$vin_num          = get_post_meta( $listing_id, 'vin_number', true );
$history_link_2   = get_post_meta( $listing_id, 'certified_logo_2_link', true );
$certified_logo_2 = get_post_meta( $listing_id, 'certified_logo_2', true );

if ( ( 'yes' === $show_vin && ! empty( $vin_num ) ) || ! empty( $data ) || ( ! empty( $certified_logo_1 ) && 'yes' === $show_certified_logo_1 ) || ( ! empty( $certified_logo_2 ) && 'yes' === $show_certified_logo_2 ) ) : ?>
	<div class="single-car-data">
		<?php
		/*If automanager, and no image in admin, set default image carfax*/
		if ( stm_check_if_car_imported( $listing_id ) && empty( $certified_logo_1 ) && ! empty( $history_link_1 ) ) {
			$certified_logo_1 = 'automanager_default';
		}

		if ( 'yes' === $show_certified_logo_1 ) :
			if ( 'automanager_default' === $certified_logo_1 ) {
				$certified_logo_1    = array();
				$certified_logo_1[0] = get_stylesheet_directory_uri() . '/assets/images/carfax.png';
			} else {
				$certified_logo_1 = wp_get_attachment_image_src( $certified_logo_1, 'full' );
			}
			if ( ! empty( $certified_logo_1[0] ) ) {
				$certified_logo_1 = $certified_logo_1[0];
				?>
				<div class="text-center stm-single-car-history-image">
					<a href="<?php echo esc_url( $history_link_1 ); ?>" target="_blank">
						<img src="<?php echo esc_url( $certified_logo_1 ); ?>" class="img-responsive dp-in"/>
					</a>
				</div>
				<?php
			}
		endif;

		if ( stm_check_if_car_imported( $listing_id ) && empty( $certified_logo_2 ) && ! empty( $history_link_2 ) ) {
			$certified_logo_2 = 'automanager_default';
		}

		if ( 'yes' === $show_certified_logo_2 ) :
			if ( 'automanager_default' === $certified_logo_2 ) {
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
			<?php
			if ( ! empty( $data ) ) :
				foreach ( $data as $data_value ) :
					$affix = '';
					if ( ! empty( $data_value['number_field_affix'] ) ) {
						$affix = $data_value['number_field_affix'];
					}
					if ( 'price' !== $data_value['slug'] ) :
						$data_meta = get_post_meta( $listing_id, $data_value['slug'], true );
						if ( ! empty( $data_meta ) && 'none' !== $data_meta ) :
							$single_name = ( ! empty( $data_value['single_name'] ) ) ? $data_value['single_name'] : '';
							?>
							<tr>
								<td class="t-label"><?php echo esc_html( $single_name ); ?></td>
								<?php if ( ! empty( $data_value['numeric'] ) && $data_value['numeric'] ) : ?>
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
									<td class="t-value h6"><?php echo esc_html( implode( ', ', $datas ) ); ?></td>
								<?php endif; ?>
							</tr>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>

			<!--VIN NUMBER-->
			<?php if ( ! empty( $vin_num ) && 'yes' === $show_vin ) : ?>
				<tr>
					<td class="t-label"><?php esc_html_e( 'VIN', 'motors-elementor-widgets' ); ?></td>
					<td class="t-value t-vin h6"><?php echo esc_attr( $vin_num ); ?></td>
				</tr>
			<?php endif; ?>
		</table>
	</div>
<?php endif; ?>
