<?php
$bg_color  = ( ! empty( $play_video_btn_color ) ) ? $play_video_btn_color : 'transparent';
$unique_id = wp_rand( 1, 99999 );
$video_url = ( ! empty( $video_link ) && is_array( $video_link ) && isset( $video_link['url'] ) ) ? $video_link['url'] : '';

global $wp_embed;
$embed   = '';
$video_w = 500;
$video_h = $video_w / 1.61;
if ( is_object( $wp_embed ) ) {
	$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $video_url . '[/embed]' );
}
?>

<div class="play-video-wrap youtube-play-video-wrap-<?php echo esc_attr( $unique_id ); ?>">
	<a href="<?php echo esc_url( $video_link['url'] ); ?>"
			target="_blank"
			rel="nofollow noreferrer"
			class="play-video-btn"
			style="background-color: <?php echo esc_attr( $bg_color ); ?>">
		<i class="fas fa-play"></i>
	</a>
</div>

<div id="video-popup-wrap" class="video-popup-wrap video-popup-wrap-<?php echo esc_attr( $unique_id ); ?>" style="display: none;">
	<div class="video-popup">
		<div class="wpb_video_wrapper">
			<?php echo $embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</div>

<script>
	(function($) {
		var yLG = $('.youtube-play-video-wrap-<?php echo esc_attr( $unique_id ); ?>');
		yLG.on('click', function(e) {
			e.stopPropagation();
			e.preventDefault();

			$(this).lightGallery({
				iframe: true,
				youtubePlayerParams: {
					modestbranding: 1,
					showinfo: 0,
					rel: 0,
					controls: 0
				},
				dynamic: true,
				dynamicEl: [{
					src  : $('.video-popup-wrap-<?php echo esc_attr( $unique_id ); ?>').find('iframe').attr('src')
				}],
				download: false,
				mode: 'lg-fade',
			});
		})
	} ( jQuery ) );
</script>
