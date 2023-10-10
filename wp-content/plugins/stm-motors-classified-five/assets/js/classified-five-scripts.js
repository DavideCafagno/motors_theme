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
                data: 'phone_owner_id=' + phone_owner_id + '&action=stm_ajax_get_c_f_user_phone&security=' + classified_five_vars.stm_ajax_get_c_f_user_phone,
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

        jQuery('.stm-featured-wrap .owl-dots').remove();
		jQuery('.stm-featured-wrap .owl-nav').remove();
    });
})(jQuery);