<?php
/**
 * @var $posts_number
 * @var $style
 * @var $enable_sticky
 * @var $advert_image
 * @var $show_advert
 * @var $advert_link
 * @var $advert_attrs
 * @var $position_advert
 * @var $_settings_
 */


use STM_E_W\Helpers\Helper;

if ( empty( $posts_number ) ) {
	$posts_number = - 1; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
}

$args = array(
	'post_type'      => 'post',
	'status'         => 'publish',
	'posts_per_page' => $posts_number,
);

if ( empty( $enable_sticky ) ) {
	$args['ignore_sticky_posts'] = 1;
}

$query = new WP_Query( $args );

$img         = $advert_image['url'] ?? '';
$ad_position = 0;
if ( isset( $position_advert ) ) {
	$ad_position = (int) $position_advert - 1;
}

$post_count = $query->post_count;

if ( $ad_position < 0 ) {
	$ad_position = 0;
}

$grid_class = ( 'date_labeled' === $style ) ? 'date_labeled' : '';
?>

<?php $i = 0; ?>
<?php if ( $query->have_posts() ) : ?>
	<div class="posts-grid row row-3 <?php echo esc_attr( $grid_class ); ?>">
		<?php
		while ( $query->have_posts() ) :
			if ( ! empty( $advert_link ) && ! empty( $img ) && $i === $ad_position ) {
				Helper::stm_ew_load_template(
					'widgets/posts-grid/posts-grid-ad',
					MOTORS_ELEMENTOR_WIDGETS_PATH,
					compact(
						'advert_attrs',
						'img',
						'_settings_'
					)
				);
			}

			$query->the_post();
			Helper::stm_ew_load_template(
				'widgets/posts-grid/posts-grid-loop',
				MOTORS_ELEMENTOR_WIDGETS_PATH,
				compact( 'style' ),
			);
			$i ++;
		endwhile;

		if ( ! empty( $advert_link ) && ! empty( $img ) && isset( $position_advert ) && (int) $position_advert > $post_count ) {
			Helper::stm_ew_load_template(
				'widgets/posts-grid/posts-grid-ad',
				MOTORS_ELEMENTOR_WIDGETS_PATH,
				compact(
					'advert_attrs',
					'img',
					'_settings_'
				)
			);
		}
		?>
	</div>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
