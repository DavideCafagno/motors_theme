(function ($) {
    $(document).ready(function () {
        var big = $('.ulisting_gallery_style_1 > .big-carousel-wrap > .big-wrap');
        var small = $('.ulisting_gallery_style_1 > .thumbs-wrap');
        var flag = false;
        var duration = 800;

        var owlRtl = false;
        if ($('body').hasClass('rtl')) {
            owlRtl = true;
        }

        big
            .owlCarousel({
                rtl: owlRtl,
                items: 1,
                smartSpeed: 800,
                dots: false,
                nav: false,
                margin: 0,
                autoplay: false,
                loop: false,
                responsiveRefreshRate: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    1024: {
                        items: 1
                    }
                }

            })
            .on('changed.owl.carousel', function (e) {
                $('.thumbs-wrap .owl-item').removeClass('current');
                $('.thumbs-wrap .owl-item').eq(e.item.index).addClass('current');
                if (!flag) {
                    flag = true;
                    small.trigger('to.owl.carousel', [e.item.index, duration, true]);
                    flag = false;
                }
            });

        small
            .owlCarousel({
                rtl: owlRtl,
                items: 5,
                smartSpeed: 800,
                dots: false,
                margin: 28,
                autoplay: false,
                nav: true,
                navElement: 'div',
                loop: false,
                navText: [],
                responsiveRefreshRate: 1000,
                responsive: {
                    0: {
                        items: 2
                    },
                    500: {
                        items: 4
                    },
                    768: {
                        items: 5
                    },
                    1000: {
                        items: 5
                    }
                }
            })
            .on('click', '.owl-item', function (event) {
                big.trigger('to.owl.carousel', [$(this).index(), 400, true]);
            })
            .on('changed.owl.carousel', function (e) {
                if (!flag) {
                    flag = true;
                    big.trigger('to.owl.carousel', [e.item.index, duration, true]);
                    flag = false;
                }
            });

        if ($('.thumbs-wrap .thumb').length < 6) {
            $('.stm-single-car-page .owl-controls').hide();
            $('.thumbs-wrap').css({'margin-top': '22px'});
        }

        jQuery('.stm-featured-wrap .owl-dots').remove();
		jQuery('.stm-featured-wrap .owl-nav').remove();
    });
})(jQuery);