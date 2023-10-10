<?php
if ( empty( $style_layout ) ) {
	$style_layout = 'car_dealer';
}

$div_icon_box_class  = ( ! empty( $ib_btn_text ) ) ? 'with_btn' : '';
$div_icon_box_class .= ( empty( $ib_icon ) ) ? ' no-icon' : '';
?>

<?php if ( ! empty( $ib_link ) && empty( $ib_btn_text ) ) : /*start if url*/ ?>
<a class="icon-box-link" <?php echo wp_kses_post( $ib_link ); ?>>
	<?php endif;/*end if url*/ ?>
	<div class="icon-box stm-layout-box-<?php echo esc_attr( $style_layout ); ?> <?php echo esc_attr( $div_icon_box_class ); ?>">
		<div class="boat-line"></div>
		<?php if ( ! empty( $ib_icon ) ) : /*start if icon*/ ?>
			<div class="icon boat-third-color icon_element">
				<?php echo wp_kses_post( $ib_icon ); ?>
			</div>
		<?php endif; /*end if icon*/ ?>
		<div class="icon-text">
			<?php if ( ! empty( $ib_title ) ) : /*start if !empty text*/ ?>
			<<?php echo esc_attr( $heading_tag ); ?> class="title heading-font">
				<?php echo esc_html( $ib_title ); ?>
		</<?php echo esc_attr( $heading_tag ); ?>>
	<?php endif; /*end if !empty text*/ ?>
		<?php if ( ! empty( $ib_content ) ) : /*start if !empty content*/ ?>
			<div class="content heading-font">
				<?php echo wp_kses_post( $ib_content ); ?>
			</div>
		<?php endif; /*start if !empty content*/ ?>
		<?php if ( ! empty( $show_button ) && ! empty( $ib_link ) && ! empty( $ib_btn_text ) ) : /*start if !empty button text*/ ?>
		<a class="icon-box-link-btn button" <?php echo wp_kses_post( $ib_link ); ?>>
			<?php stm_dynamic_string_translation_e( 'Button text (Stm Icon Box)', $ib_btn_text ); ?>
		</a>
	<?php endif; /*end if !empty button text*/ ?>
	</div>
	<?php if ( ! empty( $bottom_triangle ) && $bottom_triangle ) : ?>
		<div class="icon-box-bottom-triangle"></div>
	<?php endif; ?>
	</div>

	<?php if ( ! empty( $ib_link ) && empty( $ib_btn_text ) ) : ?>
</a>
<?php endif; ?>
