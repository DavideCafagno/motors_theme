<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_equipment_module_enqueue_scripts_styles('stm_equip_grid_gallery');

?>

<div class="equip-gallery <?php echo esc_attr($css_class); ?>">
	<?php
	$gallery = get_post_meta(get_the_id(), 'gallery', true);

	if(!empty($gallery)):
		?>

        <div class="row">
			<?php foreach($gallery as $gallery_item): ?>
                <div class="col-md-4 col-sm-4">
					<?php
					$src = wp_get_attachment_image_src($gallery_item, 'stm-img-240-140');
					$src_full = wp_get_attachment_image_src($gallery_item, 'full');

					$image_alt = get_post_meta( $gallery_item, '_wp_attachment_image_alt', true);
					$image_alt = (!empty($image_alt)) ? $image_alt : get_the_title($gallery_item);

					if(!empty($src[0]) and !empty($src_full[0])):
						?>
                        <a href="<?php echo esc_url($src_full[0]); ?>" class="stm_fancybox" rel="gallery">
                            <img src="<?php echo esc_url($src[0]) ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
                        </a>
					<?php endif; ?>
                </div>
			<?php endforeach; ?>
        </div>

	<?php endif; ?>
</div>