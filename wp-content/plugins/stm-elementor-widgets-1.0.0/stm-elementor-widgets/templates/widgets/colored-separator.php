<div class="colored-separator" style="text-align: <?php echo esc_attr( $align ); ?>;">
	<?php if ( stm_is_boats() ) : ?>
		<div
			<?php
			if ( ! empty( $color ) ) :
				?>
				style="color: <?php echo esc_attr( $color ); ?>" <?php endif; ?>><i class="stm-boats-icon-wave stm-base-color"></i></div>
	<?php else : ?>
		<div class="first-long stm-base-background-color"></div>
		<div class="last-short stm-base-background-color"></div>
	<?php endif; ?>
</div>
