class STMListingMap extends elementorModules.frontend.handlers.Base {
	getDefaultSettings() {
		return {
			selectors: {
				stm_listing_map_element: '.stm-single-listing-map__element',
			},
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings('selectors');
		return {
			$stm_listing_map_element: this.$element.find(selectors.stm_listing_map_element),
		};
	}

	mapInit() {
		const mapElement = this.elements.$stm_listing_map_element[0];
		const center = new google.maps.LatLng(mapElement.getAttribute('lat'), mapElement.getAttribute('long'));

		const mapOptions = {
			zoom: 15,
			center: center,
			fullscreenControl: true,
			scrollwheel: false
		};

		const map = new google.maps.Map(mapElement, mapOptions);
		new google.maps.Marker({
			position: center,
			icon: mapElement.getAttribute('icon'),
			map: map
		});

		return map
	}

	onInit() {
		super.onInit()

		const mapElement = this.elements.$stm_listing_map_element[0];
		const center = new google.maps.LatLng(mapElement.getAttribute('lat'), mapElement.getAttribute('long'));

		let map = this.mapInit();
		jQuery(window).on('resize', function () {
			map.setCenter(center);
		});
	}
}

jQuery(window).on('elementor/frontend/init', () => {
	const addHandler = ($element) => {
		elementorFrontend.elementsHandler.addHandler(STMListingMap, {
			$element,
		});
	};

	elementorFrontend.hooks.addAction('frontend/element_ready/motors-single-listing-map.default', addHandler);
});