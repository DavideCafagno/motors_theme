(function ($) {
    $(document).ready(function () {
        stmMobileMenu ();

        if($('body').hasClass('home') && window.innerWidth < 992) {
            $('.page-content-wrap').find('.vc_row').removeClass('vc_row-o-full-height').removeClass('vc_row-o-equal-height').attr('style', 'min-height: 100%; width: 100%;');
        }

        if(typeof $('.wp-social-login-provider-list')) {
            $('.wp-social-login-provider').each(function () {
                var provider = $(this).attr('data-provider');
                $(this).append('<span>Signup with ' + provider + ' </span>');
            });
        }

        $('body').on('click', 'a.stm-disable-pay-btn', function (e) {
            e.preventDefault();
        });

        //Default plugins
        $("select:not(.hide)").each(function () {
            $(this).select2({
                width: '100%',
                minimumResultsForSearch: Infinity,
                "language": {
                    "noResults": function(){
                        return noFoundSelect2;
                    }
                }
            });
        });

        $("select:not(.hide)").on("select2:open", function() {

            //$('.select2-search input').prop('focus',false);

            var stmClass = $(this).data('class');
            $('.select2-dropdown--below').parent().addClass(stmClass);

            window.scrollTo(0, $(window).scrollTop() + 1);
            window.scrollTo(0, $(window).scrollTop() - 1);
        });

        var uniform_selectors = ':checkbox:not("#createaccount"),' +
            ':radio:not(".input-radio")';

        $(uniform_selectors).not('#make_featured').uniform({});

        $('[data-toggle="tooltip"]').tooltip();

        // Quantity actions
        $('body').on('click', 'span.quantity_actions', function() {
            var quantityContainer = $(this).closest('.quantity'),
                quantityInput = quantityContainer.find('.qty'),
                quantityVal = quantityInput.attr('value');

            if( $(this).hasClass('plus') ) {
                quantityInput.attr('value', parseInt(quantityVal) + 1);
            } else if( $(this).hasClass('minus') ) {
                if( quantityVal > 0 ) {
                    quantityInput.attr('value', parseInt(quantityVal) - 1);
                }
            }

            modifyLink($(this).parent().attr('data-id'), $(this).parent().attr('data-invis-id'));
            recalcTotal($(this).parent().attr('data-id'), $(this).parent().attr('data-invis-id'));
        });

        $('.rent-now, .view-all-specific').on('click', function (e) {
            e.preventDefault();

            var invisId = $(this).attr('data-invis');

            if($(this).hasClass('view-all-specific')) {
                var tabId = $(this).attr('data-tab');

                $('#' + invisId).find('.nav-item').each(function () {
                    $(this).removeClass('active');
                });

                $('#' + invisId).find('.tab-pane').each(function () {
                    $(this).removeClass('active in');
                });

                $('#' + tabId + '-tab').parent().addClass('active');
                $('#' + tabId).addClass('active in');
            }

            $('.' + invisId).find('.rent-now, .view-all-specific').toggleClass('cancel');
            $('.' + invisId).toggleClass('active');
            $('#' + invisId).toggleClass('show');
        });

        $('.close-invisible').on('click', function(e) {
            e.preventDefault();

            var invisId = $(this).attr('data-invis-id');

            $('.rent-now').removeClass('cancel');
            $('.' + invisId).removeClass('active');
            $('#' + invisId).removeClass('show');
        });

        $('.gallery-item-wrap').lightGallery({
            selector: '.stm-mcr-light-gallery',
            mode : 'lg-fade'
        });

        $('.comment-form-rating').append(
            '<p class="stars">\
                <span>\
                    <a class="star-1" href="#">1</a>\
                    <a class="star-2" href="#">2</a>\
                    <a class="star-3" href="#">3</a>\
                    <a class="star-4" href="#">4</a>\
                    <a class="star-5" href="#">5</a>\
                </span>\
            </p>'
        );

        $('#respond p.stars a').on('click', function() {
            var $star   	= $( this ),
                $rating 	= $( this ).closest( '#respond' ).find( '#rating' ),
                $container 	= $( this ).closest( '.stars' );

            $rating.val( $star.text() );
            $star.siblings( 'a' ).removeClass( 'active' );
            $star.addClass( 'active' );
            $container.addClass( 'selected' );

            return false;
        } )

        $('.show-booking-form').on('click', function (e) {
            e.preventDefault();

            $('.rent-form').toggleClass('show');
            $('.rent-info').toggleClass('hide');

            if($('.rent-form').hasClass('show')) {
                $('.rent-form').slideDown(1000);
                $('.rent-info').slideUp(1000);
            } else {
                $('.rent-info').slideDown(1000);
                $('.rent-form').slideUp(1000);
            }
        });

        // Is on screen
        $.fn.is_on_screen = function(){
            var win = $(window);
            var viewport = {
                top : win.scrollTop(),
                left : win.scrollLeft()
            };
            viewport.right = viewport.left + win.width();
            viewport.bottom = viewport.top + win.height();

            var bounds = this.offset();
            bounds.right = bounds.left + this.outerWidth();
            bounds.bottom = bounds.top + this.outerHeight();

            return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
        };
    })

    $(window).on('load',function () {
        stmPreloader();
    });

    function modifyLink(prodId, invisId) {
        var invisIdw = '#' + invisId;
        var btnOne = $(invisIdw).find('.pay-btn-1');
        var btnTwo = $(invisIdw).find('.pay-btn-2');
        var btnOneUrl = btnOne.attr('data-url');
        var btnTwoUrl = btnTwo.attr('data-url');

        var optData = '';
        $(invisIdw).find('.quantity').each(function () {
            if($(this).find('input[name="quantity"]').val() >= 0) {
                optData = optData.concat($(this).attr('data-id') + '-' + $(this).find('input[name="quantity"]').val() + ',');
            }
        });

        var optParamms = (optData != '') ? '&option_data=' + optData : '';

        btnOne.attr('href', btnOneUrl + optParamms);
        if(typeof (btnTwo) != 'undefined') btnTwo.attr('href', btnTwoUrl + optParamms);
    }

    function recalcTotal(prodId, invisId) {
        var invisIdw = '#' + invisId;

        var currency = $(invisIdw).find('.price-view-1').find('.currency').text();

        var priceOneWrap = $(invisIdw).find('.price-view-1');
        var priceOne = parseFloat(priceOneWrap.attr('data-total-price'));

        var priceTwoWrap = $(invisIdw).find('.price-view-2');
        var priceTwo = parseFloat(priceTwoWrap.attr('data-total-price'));

        var optTotalPrice = 0;
        $(invisIdw).find('.quantity').each(function () {
            if($(this).find('input[name="quantity"]').val() != 0) {

                var price = $(this).attr('data-price');
                var days = $(this).attr('data-days');

                optTotalPrice += price * (days * $(this).find('input[name="quantity"]').val());
            }
        });

        var totalMath = parseFloat(priceOne + optTotalPrice);
        var totalOne = (totalMath.toFixed(2) + '').split('.');

        var cent = (typeof (totalOne[1]) != 'undefined') ? totalOne[1] : '00';
        //cent = (decimalNum == 2 && cent != '00') ? cent + '0' : cent;

        var html = '<span class="currency">' + currency + '</span>' +
            '<span class="price-big">' + totalOne[0] + '</span>' +
            '<span class="price-small">' + decimalSep + cent + '</span>';

        priceOneWrap.find('.stm-mcr-price-view').html(html);

        if(typeof (priceTwoWrap) != 'undefined') {

            var totalMath = parseFloat(priceTwo + optTotalPrice);
            var totalTwo = (totalMath.toFixed(2) + '').split('.');

            var cent = (typeof (totalTwo[1]) != 'undefined') ? totalTwo[1] : '00';

            var html = '<span class="currency">' + currency + '</span>' +
                '<span class="price-big">' + totalTwo[0] + '</span>' +
                '<span class="price-small">' + decimalSep + cent + '</span>';

            priceTwoWrap.find('.stm-mcr-price-view').html(html);
        }
    }

    function stmMobileMenu() {
        $('.mobile-menu-trigger').on('click', function(){
            $('.mobile-menu-trigger').toggleClass('opened');
            $('.mobile-menu-holder').toggleClass('active');
            //$('.mobile-menu-holder').slideToggle();
        })
        $(".mobile-menu-holder .header-menu li.menu-item-has-children > a")
            .after('<span class="arrow"><i class="fas fa-angle-right"></i></span>');

        $('.mobile-menu-holder .header-menu .arrow').on('click', function(){
            $(this).toggleClass('active');
            $(this).closest('li').toggleClass('opened');
            $(this).closest('li').find('> ul.sub-menu').slideToggle(300);
        })

        $(".mobile-menu-holder .header-menu > li.menu-item-has-children > a").on('click', function (e) {
            if( $(this).attr('href') == '#' ){
                e.preventDefault();
                $(this).closest('li').find(' > ul.sub-menu').slideToggle(300);
                $(this).closest('li').toggleClass('opened');
                $(this).closest('li').find('.arrow').toggleClass('active');
            }
        });
    }

    function stmPreloader() {
        if($('html').hasClass('stm-site-preloader')){
            $('html').addClass('stm-site-loaded');

            setTimeout(function(){
                $('html').removeClass('stm-site-preloader stm-site-loaded');
            }, 250);

            var prevent = false;
            $('a[href^=mailto], a[href^=skype], a[href^=tel]').on('click', function(e) {
                prevent = true;
                $('html').removeClass('stm-site-preloader stm-after-hidden');
            });

            $(window).on('beforeunload', function(e, k){
                if(!prevent) {
                    $('html').addClass('stm-site-preloader stm-after-hidden');
                } else {
                    prevent = false;
                }
            });
        }
    }
})(jQuery)