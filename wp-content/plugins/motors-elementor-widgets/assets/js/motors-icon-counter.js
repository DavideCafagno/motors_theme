class Counter extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                counterCard: '.stm-mt-icon-counter',
                counterValue: '.stm-mt-icon-counter .stm-value'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $counterCard: this.$element.find(selectors.counterCard),
            $counterValue: this.$element.find(selectors.counterValue)
        };
    }

    onInit() {
        super.onInit();
        this.intersectionObserver = elementorModules.utils.Scroll.scrollObserver({
            callback: event => {
                if (event.isInViewport) {
                    this.intersectionObserver.unobserve(this.elements.$counterCard[0]);
                    const data = this.elements.$counterCard.data(),
                        decimalDigits = data.toValue.toString().match(/\.(.*)/);

                    if (decimalDigits) {
                        data.rounding = decimalDigits[1].length;
                    }

                    this.elements.$counterValue.numerator(data);
                }
            }
        });
        this.intersectionObserver.observe(this.elements.$counterCard[0]);
    }

}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Counter, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/motors-icon-counter.default', addHandler);
});