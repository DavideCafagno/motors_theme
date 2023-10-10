class MotorsHeroBanner extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                hero_banner_wrap: '.stm-hero-banner-wrap',
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $hero_banner_wrap: this.$element.find(selectors.hero_banner_wrap),
        };
    }

    onInit() {
        super.onInit()

        const heroWrap = this.elements.$hero_banner_wrap[0];
        jQuery(heroWrap).addClass('loaded');
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(MotorsHeroBanner, { $element })
    }

    elementorFrontend.hooks.addAction('frontend/element_ready/motors-hero-banner.default', addHandler);
})
