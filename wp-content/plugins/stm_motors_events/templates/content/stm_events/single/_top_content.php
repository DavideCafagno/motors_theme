<?php

$motorsEventsSCE = new SubContentEventEditor();
$id = get_the_ID();

?>
<div class="event-top-content normal_font">
	<div class="img">
		<?php
			$full_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full');
			the_post_thumbnail('m-e-512-288', array('class' => 'img-responsive'));
		?>
	</div>
	<?php echo apply_filters('stm_me_subcontent_filter', $motorsEventsSCE->get_the_event_subcontent());?>
</div>


