<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$stock_number = get_post_meta( $listing_id, 'stock_number', true );
$car_brochure = get_post_meta( $listing_id, 'car_brochure', true );
?>
<!-- only visible in Elementor editor when the widget is empty -->
<div class="stm-elementor-editor-preview-icon" style="margin-bottom: -30px;">
	<i class="fas fa-toggle-on" style="font-size: 30px;"></i>
	<p style="margin: 0;"><?php echo esc_html__( 'Actions', 'motors-elementor-widgets' ); ?></p>
</div>
<style>
	.stm-elementor-editor-preview-icon {
		display: none;
	}

	.elementor-editor-active .elementor-widget-empty .stm-elementor-editor-preview-icon {
		display: block !important;
		text-align: center;
		max-width: fit-content;
		margin: 0 auto;
		padding: 10px;
	}
</style>

<div class="single-car-actions">
	<ul class="list-unstyled clearfix">
		<?php if ( ! empty( $show_added_date ) && 'yes' === $show_added_date ) : ?>
			<li class="added-date-action">
				<span class="added_date">
				<i class="far fa-clock"></i>
					<span class="added_date_info">
						<span class="added_date_info_text">
						<?php
						echo esc_html__( 'ADDED: ', 'motors-elementor-widgets' );
						?>
						</span>
						<?php
						printf(
							esc_html( get_the_modified_date( 'F d, Y' ) )
						);
						?>
					</span>
				</span>
			</li>
		<?php endif; ?>

		<!--Stock num-->
		<?php if ( ! empty( $stock_number ) && ! empty( $show_stock ) && 'yes' === $show_stock ) : ?>
			<li>
				<div class="stock-num heading-font"><span><?php echo esc_html__( 'stock', 'motors-elementor-widgets' ); ?>
						# </span><?php echo esc_attr( $stock_number ); ?></div>
			</li>
		<?php endif; ?>

		<!--Schedule-->
		<?php if ( ! empty( $show_test_drive ) && 'yes' === $show_test_drive ) : ?>
			<li>
				<a href="#" class="car-action-unit stm-schedule" data-toggle="modal" data-target="#test-drive">
					<i class="stm-icon-steering_wheel"></i>
					<span><?php esc_html_e( 'Schedule Test Drive', 'motors-elementor-widgets' ); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<!--Compare-->
		<?php if ( ! empty( $show_compare ) && 'yes' === $show_compare ) : ?>
			<li data-compare-id="<?php echo esc_attr( $listing_id ); ?>">
				<a href="#" class="car-action-unit add-to-compare stm-added"
				style="display: none;"
				data-id="<?php echo esc_attr( $listing_id ); ?>"
				data-action="remove"
				data-post-type="<?php echo esc_attr( get_post_type( $listing_id ) ); ?>">
					<i class="stm-icon-added stm-unhover"></i>
					<span class="stm-unhover"><?php esc_html_e( 'in compare list', 'motors-elementor-widgets' ); ?></span>
					<div class="stm-show-on-hover">
						<i class="stm-icon-remove"></i>
						<span><?php esc_html_e( 'Remove from list', 'motors-elementor-widgets' ); ?></span>
					</div>
				</a>
				<a href="#" class="car-action-unit add-to-compare" data-id="<?php echo esc_attr( $listing_id ); ?>" data-action="add" data-post-type="<?php echo esc_attr( get_post_type( $listing_id ) ); ?>">
					<i class="stm-icon-add"></i>
					<span><?php esc_html_e( 'Add to compare', 'motors-elementor-widgets' ); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<!--PDF-->
		<?php if ( ! empty( $show_pdf ) && 'yes' === $show_pdf ) : ?>
			<?php if ( ! empty( $car_brochure ) ) : ?>
				<li>
					<a
							href="<?php echo esc_url( wp_get_attachment_url( $car_brochure ) ); ?>"
							class="car-action-unit stm-brochure"
							title="<?php esc_attr_e( 'Download brochure', 'motors-elementor-widgets' ); ?>"
							download>
						<i class="stm-icon-brochure"></i>
						<span><?php ( stm_is_listing_five() ) ? esc_html_e( 'PDF brochure', 'motors-elementor-widgets' ) : esc_html_e( 'Car brochure', 'motors-elementor-widgets' ); ?></span>
					</a>
				</li>
			<?php endif; ?>
		<?php endif; ?>


		<!--Share-->
		<?php if ( ! empty( $show_share ) && 'yes' === $show_share ) : ?>
			<li class="stm-shareble">

				<a
						href="#"
						class="car-action-unit stm-share"
						title="<?php esc_attr_e( 'Share this', 'motors-elementor-widgets' ); ?>"
						download>
					<i class="stm-icon-share"></i>
					<span><?php esc_html_e( 'Share this', 'motors-elementor-widgets' ); ?></span>
				</a>

				<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) : ?>
					<div class="stm-a2a-popup">
						<?php echo wp_kses_post( stm_add_to_any_shortcode( $listing_id ) ); ?>
					</div>
				<?php endif; ?>
			</li>
		<?php endif; ?>

		<!--Print button-->
		<?php if ( ! empty( $show_print_btn ) && 'yes' === $show_print_btn ) : ?>
			<li>
				<a href="javascript:window.print()" class="car-action-unit stm-car-print">
					<i class="fas fa-print"></i>
					<span><?php echo esc_html__( 'Print page', 'motors-elementor-widgets' ); ?></span>
				</a>
			</li>
		<?php endif; ?>
	</ul>
</div>
