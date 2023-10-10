<?php get_header(); ?>

<div class="stm-equip-single-car-page">
	<?php get_template_part( 'partials/single-car-motorcycle/tabs' ); ?>

	<div class="container">
		<?php if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				$vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true );

				if ( $vc_status != 'false' && $vc_status == true ) {
					the_content();
				} else {
					stm_equipment_load_template('parts/single-car/car-main');
				}

			endwhile;

		endif; ?>

		<div class="clearfix"></div>
	</div> <!--cont-->
	
</div> <!--single car page-->

<?php get_footer(); ?>