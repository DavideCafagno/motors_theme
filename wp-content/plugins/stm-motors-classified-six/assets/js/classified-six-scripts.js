(function ($) {
    $(document).ready(function () {
        var uniform_selectors = ':checkbox:not("#createaccount"),' +
            ':radio:not(".input-radio")';

        $(uniform_selectors).not('#make_featured').uniform({});

        $('body').on("click", '.stm-show-number', function () {
            var parent = $(this).parent();
            var phone_owner_id = $(this).attr("data-id");
            parent.find(".stm-show-number").text('').addClass('load_number');
            $.ajax({
                url: currentAjaxUrl,
                type: "GET",
                dataType: 'json',
                context: this,
                data: 'phone_owner_id=' + phone_owner_id + '&action=stm_ajax_get_c_six_user_phone&security=' + classified_five_vars.stm_ajax_get_c_six_user_phone,
                success: function (data) {
                    parent.find(".stm-show-number").hide();
                    parent.find(".phone").html('<a href="tel:' + data + '">' + data + '</a>');
                }
            });
        });

        $('.stm-featured-wrap').owlCarousel({
            items: 3,
            loop: true,
            margin: 30,
            nav: true,
            navElement: 'div',
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                450: {
                    items: 2,
                },
                768: {
                    items: 2,
                },
                1024: {
                    items: 3,
                }
            }
        });


        if ($('.stm-contact-us-form-wrapper').length > 0) {
            var windowWidth = $(window).width();
            var containerWidth = $('#main > .container').width();

            $('.stm-contact-us-form-wrapper').attr('style', 'margin-left:' + (windowWidth - containerWidth) / 2 + 'px;');
        }

        jQuery('.stm-featured-wrap .owl-dots').remove();
		jQuery('.stm-featured-wrap .owl-nav').remove();


    });


    var anchorBlockMap = [];
    var anchorsMap = [];

    $(window).on('load', function () {
        if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            if ($(window).width() > 1199) {
                setTimeout(function () {
                    createSectionAnchors();
                }, 200);
            }
        }
    });


    jQuery(window).on('scroll', function () {
        if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            scrollingItems();
        }
    });

    function createSectionAnchors() {
        if ($('div [data-anchor]').length > 0) {

            var floatMenu = '<ul class="stm-float-menu">';

            $('div [data-anchor]').each(function () {

                var top = $('#' + $(this).attr('data-anchor')).offset().top;
                var height = $('#' + $(this).attr('data-anchor')).outerHeight();

                anchorBlockMap.push({
                    'name': $(this).attr('data-anchor'),
                    'top': top,
                    'bottom': top + height,
                    'blockCenter': ((height / 2) + top),
                    'blockHeight': height,
                    color : $(this).attr('data-menu-color')
                });

                if(typeof $(this).attr('data-menu-name') != 'undefined') floatMenu += '<li><a href="#' + $(this).attr('data-anchor') + '" data-color="' + $(this).attr('data-menu-color') + '"><span class="line"></span><label>' + $(this).attr('data-menu-name') + '</label></a></li>';
            });

            floatMenu += '</ul>';

            $('#main').after(floatMenu);

            $('body').on('click', '.stm-float-menu li a', function (e) {
                $('.stm-float-menu li a').removeClass('active');
                $(this).addClass('active');
                $('.stm-float-menu li a').attr('style', 'color: ' + $(this).data('color') + ';');
                $('.stm-float-menu li a .line').attr('style', 'background: ' + $(this).data('color') + ';');

                e.preventDefault();
                var anchor = $(this);
                var name = anchor.attr('href').replace(new RegExp("/#", 'gi'), '');

                $('html, body').stop().animate({
                    scrollTop: $(name).offset().top
                }, 700);
                e.preventDefault();
            });

            createAnchorsMap();
        }
    }

    function createAnchorsMap() {
        $('body').find('.stm-float-menu li label').each(function() {
            var $this = $(this);
            anchorsMap.push({
                element : $this,
                top : $this.offset().top
            });
        });
    }

    $.fn.isInViewport = function() {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    function scrollingItems() {
        var pos = $(window).scrollTop();
        anchorsMap.forEach(function(anchor) {
            var currentAnchorPosition = anchor.top + pos;

            anchorBlockMap.forEach(function(block){
                if(currentAnchorPosition > block.top && currentAnchorPosition < block.bottom) {
                    $(anchor.element).attr('style', 'color: ' + block.color + ';');
                    $(anchor.element).parent().find('.line').attr('style', 'background: ' + block.color + ';');
                }
            })
        })
    }

})(jQuery);