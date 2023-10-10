class MotorsImageCategoriesAdmin extends elementorModules.frontend.handlers.Base {

    getDefaultSettings() {
        return {
            selectors: {
                carousel: '.stm_listing_icon_filter.swiper',
                unit: '.stm_icon_filter_unit',
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $carousel: this.$element.find(selectors.carousel),
            $unit: this.$element.find(selectors.unit),
        };
    }

    onInit() {
        super.onInit();
        let data = this.elements.$carousel.data(),
            responsive, options

        let $ = jQuery
        $(this.elements.$unit.find('.stm_icon_filter_label')).off()
        $(this.elements.$unit.find('.stm_icon_filter_label')).on('click', function () {
            if (!$(this).hasClass('active')) {
                $(this).closest('.stm_icon_filter_unit').find('.stm_listing_icon_filter').toggleClass('active');
                $(this).closest('.stm_icon_filter_unit').find('.stm_listing_icon_filter .image').hide();

                $(this).addClass('active');
            } else {
                $(this).closest('.stm_icon_filter_unit').find('.stm_listing_icon_filter').toggleClass('active');
                $(this).closest('.stm_icon_filter_unit').find('.stm_listing_icon_filter .image').show();

                $(this).removeClass('active');
            }
        });

        if (!data || !data.hasOwnProperty('per_row_responsive') || data.per_row_responsive === undefined)
            return

        responsive = data.per_row_responsive
        options = data.options

        let slider_options = {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            simulateTouch: false,
            autoplay: false,
            speed: 500,
            loop: false,
            breakpoints: {
                0: {
                    slidesPerView: responsive.mobile,
                    slidesPerGroup: options.hasOwnProperty('slides_per_transition') ? options.slides_per_transition.mobile : 1,
                },
                768: {
                    slidesPerView: responsive.tablet,
                    slidesPerGroup: options.hasOwnProperty('slides_per_transition') ? options.slides_per_transition.tablet : 1,
                },
                992: {
                    slidesPerView: responsive.desktop,
                    slidesPerGroup: options.hasOwnProperty('slides_per_transition') ? options.slides_per_transition.desktop : 1,
                },
            }
        }

        if (options.hasOwnProperty('click_drag') && options.click_drag)
            slider_options.simulateTouch = true

        if (options.hasOwnProperty('loop') && options.loop)
            slider_options.loop = true

        if (options.hasOwnProperty('autoplay') && options.autoplay) {
            slider_options.autoplay = {
                delay: 1000,
                reverseDirection: false,
            }

            if (options.hasOwnProperty('delay') && options.delay) {
                slider_options.autoplay.delay = options.delay
            }

            if (options.hasOwnProperty('reverse') && options.reverse) {
                slider_options.autoplay.reverseDirection = true
            }

        }

        if (options.hasOwnProperty('transition_speed') && options.transition_speed)
            slider_options.speed = options.transition_speed

        if (options.hasOwnProperty('navigation') && !options.navigation)
            slider_options.navigation = false

        let swiper = new Swiper(this.elements.$carousel.find('.swiper-container'), slider_options);

        if (options.hasOwnProperty('pause_on_mouseover') && options.pause_on_mouseover) {
            $(swiper.$el[0]).hover(swiper.autoplay.stop, swiper.autoplay.start)
        }

    }

}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(MotorsImageCategoriesAdmin, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/motors-image-categories.default', addHandler);
});