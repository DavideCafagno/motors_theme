class MotorsInventorySearchFilter extends elementorModules.frontend.handlers.Base {
	getDefaultSettings() {
		return {
			selectors: {
				search_btn: '.mobile-search-btn',
				filter_row: '.classic-filter-row',
				search_filter: '.search-filter-form',
				close_btn: '.close-btn',
				show_cars_btn:'.show-car-btn',
				html:'html',
				footer: 'footer',
				wrapper: '#wrapper',
				body: 'body',
			},
		};
	}
	getDefaultElements() {
		const selectors = this.getSettings('selectors');
		return {
			$search_btn: this.$element.find(selectors.search_btn),
			$search_filter: this.$element.find(selectors.search_filter),
			$close_btn: this.$element.find(selectors.close_btn),
			$html: this.$element.find(selectors.html),
			$footer: jQuery(selectors.footer),
			$filter_row: this.$element.find(selectors.filter_row),
			$wrapper: jQuery(selectors.wrapper),
			$body: jQuery(selectors.body),
			$show_cars_btn: this.$element.find(selectors.show_cars_btn),
		};
	}
	onInit() {
		super.onInit();
		const overlay = jQuery('<div>').addClass('mobile-filter-overlay');
		const wrapper = this.elements.$wrapper;
		let initialPosition = this.elements.$filter_row.prev();
		
		const updatePosition = () => {
			const html = document.getElementsByTagName('html');
			if (window.innerWidth < 1025) {
				this.elements.$filter_row.addClass('fixed-search-filter').insertBefore(this.elements.$footer);
				this.elements.$filter_row.addClass('mobile-filter-row');
			} else {
				this.elements.$filter_row.removeClass('fixed-search-filter').insertBefore(initialPosition);
				this.elements.$filter_row.removeClass('mobile-filter-row');
				html[0].classList.remove('mobile-overflow-hidden');
			}
		};
		updatePosition();
		
		window.addEventListener('resize', updatePosition);
		overlay.insertBefore(wrapper);
		this.elements.$search_btn.on('click', (e) => {
			const html = document.getElementsByTagName('html');
			const searchFilter = this.elements.$search_filter;
			const body = document.getElementsByTagName('body');
			searchFilter.addClass('active');
			searchFilter.addClass('mobile');
			overlay.addClass('active');
			html[0].classList.add('mobile-overflow-hidden');
		});
		
		this.elements.$close_btn.on('click', (e) => {
			const html = document.getElementsByTagName('html');
			const searchFilter = this.elements.$search_filter;
			searchFilter.removeClass('active');
			html[0].classList.remove('mobile-overflow-hidden');
			overlay.removeClass('active');
		});
		
		overlay.click( (e) => {
			const html = document.getElementsByTagName('html');
			const searchFilter = this.elements.$search_filter;
			overlay.removeClass('active');
			searchFilter.removeClass('active');
			searchFilter.removeClass('mobile');
			html[0].classList.remove('mobile-overflow-hidden');
			overlay.removeClass('active');
		});
		
		this.elements.$show_cars_btn.on('click', (e) => {
			const html = document.getElementsByTagName('html');
			const searchFilter = this.elements.$search_filter;
			searchFilter.removeClass('active');
			html[0].classList.remove('mobile-overflow-hidden');
			overlay.removeClass('active');
		});
	}
}

jQuery(window).on('elementor/frontend/init', () => {
	const addHandler = ($element) => {
		elementorFrontend.elementsHandler.addHandler(MotorsInventorySearchFilter, { $element })
	}
	elementorFrontend.hooks.addAction('frontend/element_ready/motors-inventory-search-filter.default', addHandler);
})