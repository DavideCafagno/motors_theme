jQuery(document).ready(function ($) {
	$('.stm-vivus-arrow svg').each(function (index, element) {
		new Vivus(element, {
			duration: 300,
			type: 'delayed',
			delay: 100,
			animTimingFunction: Vivus['EASE_OUT'],
			start: 'manual',
			onReady: function () {
				this.play();
			}
		});
	})
})