class MotorsMultilistingSearchTabs extends elementorModules.frontend.handlers.Base {
	getDefaultSettings() {
		return {
			selectors: {
				selects: 'select:not(".select2-hidden-accessible")',
			},
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings('selectors');
		return {
			$selects: this.$element.find(selectors.selects)
		};
	}

	onInit() {
		super.onInit()
		const selects = this.elements.$selects;
		jQuery(selects).select2();
	}
}

jQuery(window).on('elementor/frontend/init', () => {
	const addHandler = ($element) => {
		elementorFrontend.elementsHandler.addHandler(MotorsMultilistingSearchTabs, { $element })
	}

	elementorFrontend.hooks.addAction('frontend/element_ready/motors-multilisting-search-tabs.default', addHandler);
})
