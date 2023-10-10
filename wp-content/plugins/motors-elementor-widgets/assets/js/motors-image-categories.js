jQuery(document).ready(function ($) {
    let label = $('.stm_icon_filter_label')
    label.off()
    label.on('click', function () {
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
})