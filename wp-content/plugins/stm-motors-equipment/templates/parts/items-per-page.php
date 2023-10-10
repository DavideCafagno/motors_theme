<?php
$listing_grid_choices = explode(',', stm_me_get_wpcfto_mod('listing_grid_choices', '9,12,18,27'));
$listing_grid_choice = get_theme_mod('listing_grid_choice', '9');

if (!empty($_GET['posts_per_page'])) {
	$listing_grid_choice = intval($_GET['posts_per_page']);
}

if(!in_array($listing_grid_choice, $listing_grid_choices)) {
	$listing_grid_choices[] = intval($listing_grid_choice);
}

if (!empty($listing_grid_choices)): ?>
	<div class="items-per-page-wrap">
		<span class="stm_label normal_font"><?php esc_html_e('Vehicles per page:', 'stm_motors_equipment'); ?></span>
		<select name="equip-posts_per_page">
			<?php foreach ($listing_grid_choices as $listing_grid_choice_single): ?>
				<?php
				if ($listing_grid_choice_single == $listing_grid_choice) {
					$active = 'selected';
				} else {
					$active = '';
				}

				$link = add_query_arg(array('posts_per_page' => intval($listing_grid_choice_single)));
				$link = preg_replace( "/\/page\/\d+/", '', remove_query_arg(array('paged', 'ajax_action'), $link));
				?>

				<option class="<?php echo esc_attr($active); ?>" <?php echo esc_attr($active); ?>>
					<?php echo intval($listing_grid_choice_single); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
<?php endif; ?>