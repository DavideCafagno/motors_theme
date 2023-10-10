<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = (!empty($css)) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ')) : '';

stm_c_f_module_enqueue_scripts_styles('stm_c_f_latest_posts');

$posts = new WP_Query(array(
	'post_type' => 'post',
	'posts_per_page' => $posts_per_page,
	'post_status' => 'publish',
	'order' => 'DESC'
));

?>

<div class="stm-c-f-latest-posts-wrap">
	<h2>
		<?php echo esc_html($title);?>
	</h2>
	<div class="subcontent heading-font">
		<?php echo $content; ?>
	</div>
	<div class="latest-posts">
		<?php
		if($posts->have_posts()) {
			while ($posts->have_posts()) {
				$posts->the_post();
				stm_c_f_load_template('vc_parts/recent_post_loop');
			}
		}
		wp_reset_postdata();
		?>
	</div>
</div>

