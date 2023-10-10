<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_c_f_module_enqueue_scripts_styles('stm_browse_by_type');

$atts = stm_c_f_get_content_tags($content);

$scAtts = array();
$catsSlugs = array();
foreach ($atts as $val) {
    $scParse = shortcode_parse_atts($val[3]);
	$scAtts[] = $scParse;
	if(!empty($scParse['listing_category'])) {
		$catsSlugs[] = $scParse['listing_category'];
	}	
}

if(!empty($show_all_tab) && $show_all_tab == 'yes') {
	$allObj = array();
	$models = array();

	$allPosts = new WP_Query( array( 'post_type' => 'listing', 'posts_per_page' => 8, 'post_status' => 'publish', 'orderby' => 'rand', 'tax_query' => array( 'relation' => 'AND', array( 'taxonomy' => 'listing-category', 'field' => 'slug', 'terms' => $catsSlugs, ) ) ) );

	if ( $allPosts->have_posts() ) {
		while ( $allPosts->have_posts() ) {
			$allPosts->the_post();
			$model = uListing\Classes\StmListing::load( get_post() );
			$models[] = $model;
		}

		$allObj = [ 'query' => $allPosts, 'models' => $models ];
		wp_reset_postdata();
	}
}

$rand = rand(100, 10000);
?>

<div class="stm-c-f-categories-tabs-wrap <?php echo esc_attr( $css_class ); ?>">
	<h2>
		<?php echo esc_html($categories_title);?>
	</h2>

	<div class="stm-c-f-tabs-wrap">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php if(!empty($show_all_tab) && $show_all_tab == 'yes') : ?>
            <li class="nav-item">
                <a class="nav-link active" id="all-<?php echo esc_attr($rand); ?>-tab" data-toggle="tab" href="#all-<?php echo esc_attr($rand); ?>" role="tab" aria-controls="all-<?php echo esc_attr($rand); ?>" aria-selected="true"><?php echo esc_html__('All', 'stm_motors_classified_five');?></a>
            </li>
            <?php endif; ?>
			<?php foreach ($scAtts as $k => $cat):
					if(empty($cat['listing_category'])) continue;

					$id = 'id-' . $cat['listing_category']; ?>
				<li class="nav-item <?php echo (empty($show_all_tab) && $k == 0) ? 'active' : ''; ?>">
					<a class="nav-link" id="<?php echo esc_attr($id); ?>-tab" data-toggle="tab" href="#<?php echo esc_attr($id); ?>" role="tab" aria-controls="<?php echo esc_attr($id); ?>" aria-selected="false"><?php echo strtoupper($cat['listing_category']);?></a>
				</li>
			<?php endforeach;?>
		</ul>
		<div class="tab-content" id="myTabContent">
			<?php if(!empty($show_all_tab) && $show_all_tab == 'yes') : ?>
            <div class="tab-pane fade show active" id="all-<?php echo esc_attr($rand); ?>" role="tabpanel" aria-labelledby="all-<?php echo esc_attr($rand); ?>-tab">
				<?php
				uListing\Classes\StmListingTemplate::load_template(
					'listing/ulisting-grid-item',
					[
						"listings" => $allObj['models'],
						"view_type" => 'grid',
						"item_class" => 'stm-c-f-by-type-item',
					], true);
				?>
                <?php if(!empty($load_more) && $load_more == 'yes'): ?>
                <!--<div class="stm-load-more">
                    <a id="all-l-m-<?php /*echo esc_attr($rand); */?>" class="button"><?php /*echo esc_html__('Show More', 'stm_motors_classified_five');*/?></a>
                </div>-->
                <?php endif; ?>
            </div>
            <?php endif; ?>
			<?php

            $listingTypeName = '';

            foreach ($scAtts as $k => $cat):
				if(empty($cat['listing_category'])) continue;
			
				$id = 'id-' . $cat['listing_category']; ?>
				<div class="tab-pane fade <?php echo (empty($show_all_tab) && $k == 0) ? 'show active' : ''; ?>" id="<?php echo esc_attr($id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($id); ?>-tab">
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
									'terms'    => $cat['listing_category'],
								)
							)
						)
					);

					if($allPosts->have_posts()) {
						while ($allPosts->have_posts()) {
							$allPosts->the_post();
							$model = uListing\Classes\StmListing::load(get_post());
							$dinamicModels[] = $model;
							$listingTypeName = $model->getType()->post_name;
						}
						$dinamicObj = ['query' => $allPosts, 'models' => $dinamicModels];
						wp_reset_postdata();

						uListing\Classes\StmListingTemplate::load_template(
							'listing/ulisting-grid-item',
							[
								'listingType' => $cat['listing_type'],
								"listings" => $dinamicObj['models'],
								"view_type" => 'grid',
								"item_class" => 'stm-c-f-by-type-item',
							], true);
					}

					?>
					<?php if(!empty($load_more) && $load_more == 'yes'):
                        $page = get_page_by_title($listingTypeName);
                        ?>
                        <div class="stm-load-more">
                            <a id="<?php echo esc_attr($cat['listing_category']); ?>-l-m-<?php echo esc_attr($rand); ?>" href="<?php echo esc_url($page->guid); ?>" class="button"><?php echo esc_html__('Show More', 'stm_motors_classified_five');?></a>
                        </div>
					<?php endif; ?>
				</div>
			<?php endforeach;?>

		</div>
	</div>
</div>
