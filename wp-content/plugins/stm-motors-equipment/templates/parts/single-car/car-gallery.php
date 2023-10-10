<?php
$show_compare = stm_me_get_wpcfto_mod( 'show_compare', false );

$sold             = get_post_meta( get_the_ID(), 'car_mark_as_sold', true );
$sold_badge_color = stm_me_get_wpcfto_mod( 'sold_badge_bg_color' );
$cars_in_compare  = stm_get_compared_items();

// remove "special" if the listing is sold
if ( ! empty( $sold ) ) {
	delete_post_meta( get_the_ID(), 'special_car' );
}

$special_car    = get_post_meta( get_the_ID(), 'special_car', true );
$badge_text     = get_post_meta( get_the_ID(), 'badge_text', true );
$badge_bg_color = get_post_meta( get_the_ID(), 'badge_bg_color', true );


if ( empty( $badge_text ) ) {
	$badge_text = 'Special';
}

$badge_style = '';
if ( ! empty( $badge_bg_color ) ) {
	$badge_style = 'style=background-color:' . $badge_bg_color . ';';
}
?>

<?php if ( ! has_post_thumbnail() and stm_check_if_car_imported( get_the_id() ) ) : ?>
	<img
		src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/automanager_placeholders/plchldr798automanager.png' ); ?>"
		class="img-responsive"
		alt="<?php esc_attr_e( 'Placeholder', 'stm_motors_equipment' ); ?>"
		/>
<?php endif; ?>

<div class="stm-car-carousels stm-listing-car-gallery">
	<!--Actions-->
	<div class="stm-gallery-actions">
		<?php if ( ! empty( $show_compare ) ) : ?>
			<?php
				$active = '';
			if ( ! empty( $cars_in_compare ) ) {
				if ( in_array( get_the_ID(), $cars_in_compare ) ) {
					$active = 'active';
				}
			}
			?>
			<div class="stm-gallery-action-unit compare <?php echo esc_attr( $active ); ?>" data-post-type="<?php echo esc_attr( get_post_type( get_the_ID() ) ); ?>" data-id="<?php echo esc_attr( get_the_ID() ); ?>" data-title="<?php echo esc_attr( stm_generate_title_from_slugs( get_the_id() ) ); ?>">
				<i class="stm-service-icon-compare-new"></i>
				<span class="heading-font"><?php esc_html_e( 'Compare', 'stm_motors_equipment' ); ?></span>
			</div>
		<?php endif; ?>
	</div>

	<?php stm_get_boats_image_hover( get_the_ID() ); ?>
	<div class="stm-big-car-gallery">

		<?php
		if ( has_post_thumbnail() ) :
			$full_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
			// Post thumbnail first
			?>
			<div class="stm-single-image" data-id="big-image-<?php echo esc_attr( get_post_thumbnail_id( get_the_id() ) ); ?>">
				<?php if ( empty( $sold ) && ! empty( $special_car ) && $special_car == 'on' ) : ?>
					<div class="special-label special-label-small h6" <?php echo esc_attr( $badge_style ); ?>>
						<?php stm_dynamic_string_translation_e( 'Special Badge Text', $badge_text ); ?>
					</div>
				<?php elseif ( stm_sold_status_enabled() && ! empty( $sold ) ) : ?>
					<?php $badge_style = 'style=background-color:' . $sold_badge_color . ';'; ?>
					<div class="special-label special-label-small h6" <?php echo esc_attr( $badge_style ); ?>>
						<?php _e( 'Sold', 'motors' ); ?>
					</div>
				<?php endif; ?>
				<a href="<?php echo esc_url( $full_src[0] ); ?>" class="stm_fancybox" rel="stm-car-gallery">
					<?php the_post_thumbnail( 'stm-img-825-483', array( 'class' => 'img-responsive' ) ); ?>
				</a>
			</div>
		<?php endif; ?>

	</div>
</div>


<!--Enable carousel-->
<script>
	jQuery(document).ready(function($){
		var big = $('.stm-big-car-gallery');
		var small = $('.stm-thumbs-car-gallery');
		var flag = false;
		var duration = 800;

		big
			.owlCarousel({
				items: 1,
				smartSpeed: 800,
				dots: false,
				nav: false,
				margin:0,
				autoplay: false,
				loop: false,
				responsiveRefreshRate: 1000
			})
			.on('changed.owl.carousel', function (e) {
				$('.stm-thumbs-car-gallery .owl-item').removeClass('current');
				$('.stm-thumbs-car-gallery .owl-item').eq(e.item.index).addClass('current');
				if (!flag) {
					flag = true;
					small.trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}
			});

		small
			.owlCarousel({
				items: 5,
				smartSpeed: 800,
				dots: false,
				margin: 22,
				autoplay: false,
				nav: true,
				loop: false,
				navText: [],
				responsiveRefreshRate: 1000,
				responsive:{
					0:{
						items:2
					},
					500:{
						items:4
					},
					768:{
						items:5
					},
					1000:{
						items:5
					}
				}
			})
			.on('click', '.owl-item', function(event) {
				big.trigger('to.owl.carousel', [$(this).index(), 400, true]);
			})
			.on('changed.owl.carousel', function (e) {
				if (!flag) {
					flag = true;
					big.trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}
			});

		if($('.stm-thumbs-car-gallery .stm-single-image').length < 6) {
			$('.stm-single-car-page .owl-controls').hide();
			$('.stm-thumbs-car-gallery').css({'margin-top': '22px'});
		}
	})
</script>
