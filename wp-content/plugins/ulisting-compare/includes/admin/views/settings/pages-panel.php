<hr>
<h3><?php _e("Compare","ulisting");?></h3>
<div class="p-t-30">
	<div class="form-group">
		<div class="stm-row">
			<div class="stm-col-3">
				<label> <?php _e("Compare page","ulisting");?></label>
			</div>
			<div class="stm-col-5">
				<?php ulisting_render_template(ULISTING_ADMIN_PATH . '/views/listing-settings/pages-panel-selectbox.php', ['option_name' => 'compare_page'], true);?>
			</div>
		</div>
	</div>
</div>
