<?php
if ( ! wp_script_is( 'stm_gmap', 'enqueued' ) ) {
	wp_enqueue_script( 'stm_gmap' );
}

$random_id = wp_rand( 1, 99999 );

if ( empty( $lat ) ) {
	$lat = 36.169941;
}

if ( empty( $lng ) ) {
	$lng = - 115.139830;
}

if ( 'yes' === $mouse_wheel ) {
	$mouse_wheel = 'true';
} else {
	$mouse_wheel = 'false';
}

if ( 'yes' === $control_tools ) {
	$control_tools = 'true';
} else {
	$control_tools = 'false';
}

if ( ! empty( $pin ) && ! empty( $pin['url'] ) ) {
	$pin_url = $pin['url'];
}

?>

<div id="stm_map-<?php echo esc_attr( $random_id ); ?>" class="stm-elementor-google-map"></div>

<script>
	jQuery(document).ready(function ($) {
		var center, map;
		function init() {
			var mapStyles = [
				{
					"featureType": "all",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				}
			];

			<?php if ( ! empty( $gmap_style ) && ! empty( json_decode( $gmap_style ) ) ) : ?>
				mapStyles = <?php echo $gmap_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>;
			<?php endif; ?>

			center = new google.maps.LatLng(<?php echo esc_js( $lat ); ?>, <?php echo esc_js( $lng ); ?>);
			var mapOptions = {
				zoom: <?php echo esc_js( $default_zoom ); ?>,
				center: center,
				styles: mapStyles,
				scrollwheel: <?php echo esc_js( $mouse_wheel ); ?>,
				zoomControl: <?php echo esc_js( $control_tools ); ?>,
				mapTypeControl: <?php echo esc_js( $control_tools ); ?>,
				scaleControl: <?php echo esc_js( $control_tools ); ?>,
				streetViewControl: <?php echo esc_js( $control_tools ); ?>,
				rotateControl: <?php echo esc_js( $control_tools ); ?>,
				fullscreenControl: <?php echo esc_js( $control_tools ); ?>
			};
			var mapElement = document.getElementById('stm_map-<?php echo esc_js( $random_id ); ?>');
			map = new google.maps.Map(mapElement, mapOptions);
			var marker = new google.maps.Marker({
				position: center,
				<?php if ( ! empty( $pin_url ) ) : ?>
				icon: '<?php echo esc_url( $pin_url ); ?>',
				<?php endif; ?>
				map: map,
			});

			<?php if ( ! empty( $infowindow_text ) ) : ?>
			var infowindow = new google.maps.InfoWindow({
				content: '<h6><?php echo esc_js( $infowindow_text ); ?></h6>',
				pixelOffset: new google.maps.Size(0,71),
				boxStyle: {
					width: "320px"
				}
			});

			marker.addListener('click', function() {
				infowindow.open(map, marker);
				map.setCenter(center);
			});
			<?php endif; ?>
		}

		$('.vc_tta-tab').on('click', function(){
			if(typeof map != 'undefined' && typeof center != 'undefined') {
				setTimeout(function () {
					google.maps.event.trigger(map, "resize");
					map.setCenter(center);
				}, 1000);
			}
		})

		$('a').on('click', function(){
			if(typeof $(this).data('vc-accordion') !== 'undefined' && typeof map != 'undefined' && typeof center != 'undefined') {
				setTimeout(function () {
					google.maps.event.trigger(map, "resize");
					map.setCenter(center);
				}, 1000);
			}
		})

		$('.wpb_tour_tabs_wrapper.ui-tabs ul.wpb_tabs_nav > li').on('click', function(){
			if(typeof map != 'undefined' && typeof center != 'undefined') {
				setTimeout(function () {
					google.maps.event.trigger(map, "resize");
					map.setCenter(center);
				}, 1000);
			}
		})

		$(window).on('resize', function(){
			if(typeof map != 'undefined' && typeof center != 'undefined') {
				setTimeout(function () {
					map.setCenter(center);
				}, 1000);
			}
		});

		// initialize map
		init();
	});
</script>
