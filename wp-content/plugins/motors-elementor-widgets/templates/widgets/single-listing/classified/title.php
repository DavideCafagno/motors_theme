<?php
global $listing_id;

$listing_id = ( is_null( $listing_id ) ) ? get_the_ID() : $listing_id;

$listing_title = stm_generate_title_from_slugs( $listing_id, stm_me_get_wpcfto_mod( 'show_generated_title_as_label', false ) );

?>

<div class="stm-listing-single-price-title heading-font clearfix">
	<div class="stm-single-title-wrap">
		<<?php echo esc_attr( $title_tag ); ?> class="title">
			<?php echo wp_kses_post( $listing_title ); ?>
		</<?php echo esc_attr( $title_tag ); ?>>
		<?php if ( $added_date ) : ?>
			<span class="normal_font">
				<?php echo wp_kses( $date_added_icon, apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
				<?php
					// translators: %s: Added date.
					printf( esc_html__( 'ADDED: %s', 'motors' ), wp_kses_post( get_the_modified_date( 'F d, Y' ) ) );
				?>
			</span>
		<?php endif; ?>
	</div>
</div>
