<div class="row stm-equip-no-wpb">
	<div class="col-md-9 col-md-push-3 col-sm-push-0 col-sm-12 col-xs-12">
		<div class="stm-single-car-content">
			<!--Title and price-->
			<?php stm_equipment_load_template('parts/single-car/car-price-title'); ?>

			<!--Gallery-->
			<?php stm_equipment_load_template('parts/single-car/car-gallery'); ?>

			<?php the_content(); ?>
		</div>
	</div>

	<div class="col-md-3 col-md-pull-9 col-sm-pull-0 col-sm-12 col-xs-12">
		<div class="stm-single-car-side">

			<!--Data-->
			<?php stm_equipment_load_template('parts/single-car/car-data'); ?>

			<!--Links-->
			<?php stm_equipment_load_template('parts/single-car/car-links'); ?>
		</div>
	</div>
</div>