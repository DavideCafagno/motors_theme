<?php
/**
 * @var $advert_attrs
 * @var $img
 * @var $_settings_
 */

use Elementor\Group_Control_Image_Size;

?>

<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="post-grid-single-unit">
		<div class="image">
			<?php if ( ! empty( $advert_attrs ) ) : ?>
			<a <?php echo wp_kses_post( $advert_attrs ); ?>>
				<?php endif; ?>
				<?php
				echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $_settings_, 'advert_size', 'advert_image' ) );
				?>
				<?php if ( ! empty( $advert_attrs ) ) : ?>
			</a>
		<?php endif; ?>
		</div>
	</div>
</div>
