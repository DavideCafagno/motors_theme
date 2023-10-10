<?php

$eventsTopBg = stm_me_get_wpcfto_img_src('events_block_title_bg', '');
$eventsTopSubTitle = stm_me_get_wpcfto_mod('events_subtitle');


?>
<div class="stm-motors-event-archive-header entry-header" style="background-image: url('<?php echo esc_url($eventsTopBg)?>'); ">
	<div class="container">
		<h1><?php echo esc_html__('Events', 'stm_motors_events')?></h1>
		<h5><?php echo esc_html($eventsTopSubTitle); ?></h5>
	</div>
</div>

