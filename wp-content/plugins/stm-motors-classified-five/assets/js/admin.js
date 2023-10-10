(function($) {
    $(document).ready(function () {
        $('.stm_vehicles_listing_icons .inner .stm_font_nav a').on('click',function(e){
            e.preventDefault();
            $('.stm_vehicles_listing_icons .inner .stm_font_nav a').removeClass('active');
            $(this).addClass('active');
            var tabId = $(this).attr('href');
            $('.stm_theme_font').removeClass('active');
            $(tabId).addClass('active');
        });

        /*Open/Delete icons*/
        $(document).on('click', '.stm_vehicles_listing_icon .stm_delete_icon', function(e){
            $(this).closest('.stm_form_wrapper_icon').find('input[name="stm_taxonomy_c_f_icon"]').val('');

            $(this).closest('.stm_form_wrapper_icon').find('i').removeAttr('class');
            $(this).closest('.stm_form_wrapper_icon').find('img').removeAttr('class');
            $(this).closest('.stm_form_wrapper_icon').find('img').addClass('stm-default-icon_');
            $(this).closest('.stm_vehicles_listing_icon').removeClass('stm_icon_given');

            e.preventDefault();
            e.preventDefault();
            e.stopPropagation();
            return false;
        });

        var currentTarget = '';
        $(document).on('click', '.stm_vehicles_listing_icon', function(e){
            e.preventDefault();
            $('.stm_vehicles_listing_icons').addClass('visible');
            currentTarget = $(this).closest('.stm_form_wrapper_icon');

            console.log(currentTarget.find('input[name="stm_taxonomy_c_f_icon"]').val());

            var currentVal = '.' + currentTarget.find('input[name="stm_taxonomy_c_f_icon"]').val().replace(' ', '.');
            if(currentVal === '.') {
                return;
            }
            $('.stm-listings-pick-icon').removeClass('chosen');
            $('.stm_vehicles_listing_icons ' + currentVal).closest('.stm-listings-pick-icon').addClass('chosen');
        });

        $('.stm_vehicles_listing_icons .inner td.stm-listings-pick-icon i').on('click', function(){
            var stmClass = $(this).attr('class').replace(' big_icon', '');
            currentTarget.find('input[name="stm_taxonomy_c_f_icon"]').val(stmClass);
            currentTarget.find('.icon i').attr('class', stmClass);

            currentTarget.find('.stm_vehicles_listing_icon').addClass('stm_icon_given');

            stm_listings_close_icons();
        });

        $('.stm_vehicles_listing_icons .overlay').on('click', function(){
            $('.stm_vehicles_listing_icons').removeClass('visible');
        });

        function stm_listings_close_icons() {
            $('.stm_vehicles_listing_icons').removeClass('visible');
        }
    });
})(jQuery)