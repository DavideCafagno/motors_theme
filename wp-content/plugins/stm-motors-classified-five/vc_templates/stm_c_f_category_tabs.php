<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_c_f_module_enqueue_scripts_styles('stm_c_f_category_tabs');

$cats = get_categories(
	array(
		'taxonomy' => 'listing-category',
		'hide_empty' => 0,
		'post_type' => 'listing'
	)
);

$allObj = array();
$models = array();

$allPosts = new WP_Query(
	array(
        'post_type' => 'listing',
        'posts_per_page' => 8,
        'post_status' => 'publish'
    )
);

if($allPosts->have_posts()) {
	while ($allPosts->have_posts()) {
		$allPosts->the_post();
		$model = uListing\Classes\StmListing::load(get_post());
		$models[] = $model;
	}

	$allObj = ['query' => $allPosts, 'models' => $models];
	wp_reset_postdata();
}



?>
<div class="stm-c-f-categories-tabs-wrap <?php echo esc_attr( $css_class ); ?>">
	<h2>
		<?php echo esc_html($categories_title);?>
	</h2>

	<div class="stm-c-f-tabs-wrap">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true"><?php echo esc_html__('All', 'stm_motors_classified_five');?></a>
			</li>
			<?php foreach ($cats as $cat) : $id = 'id-' . $cat->term_id; ?>
				<li class="nav-item">
					<a class="nav-link" id="<?php echo esc_attr($id); ?>-tab" data-toggle="tab" href="#<?php echo esc_attr($id); ?>" role="tab" aria-controls="<?php echo esc_attr($id); ?>" aria-selected="false"><?php echo $cat->name;?></a>
				</li>
			<?php endforeach;?>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <?php
				uListing\Classes\StmListingTemplate::load_template(
                        'listing/ulisting-feature',
                        [
                            "listings" => $allObj['models'],
                            "view_type" => 'grid',
                            "item_class" => 'stm-c-f-category-item',
                        ], true);
                ?>
            </div>

			<?php foreach ($cats as $cat) : $id = 'id-' . $cat->term_id; ?>
				<div class="tab-pane fade" id="<?php echo esc_attr($id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($id); ?>-tab">
                <?php

                $dinamicObj = array();
                $dinamicModels = array();

				$allPosts = new WP_Query(
					array(
						'post_type' => 'listing',
						'posts_per_page' => 8,
						'post_status' => 'publish',
                        'tax_query' => array(
                                'relation' => 'AND',
							array(
							'taxonomy' => 'listing-category',
							'field'    => 'slug',
							'terms'    => $cat->slug,
                            )
                        )
					)
				);

				if($allPosts->have_posts()) {
					while ($allPosts->have_posts()) {
						$allPosts->the_post();
						$model = uListing\Classes\StmListing::load(get_post());
						$dinamicModels[] = $model;
					}
					$dinamicObj = ['query' => $allPosts, 'models' => $dinamicModels];
					wp_reset_postdata();

					uListing\Classes\StmListingTemplate::load_template(
						'listing/ulisting-feature',
						[
							"listings" => $dinamicObj['models'],
							"view_type" => 'grid',
							"item_class" => 'stm-c-f-category-item',
						], true);
				}

                ?>
                </div>
			<?php endforeach;?>

		</div>
	</div>
</div>
