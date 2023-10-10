(function($) {
    $(document).ready(function () {
        $('select[name="equip-posts_per_page"]').on('change', function () {
            window.location.href = addParameterToURL(document.location.search, 'posts_per_page', $(this).val());
        });
    });

    function addParameterToURL(search, key, val){
        var newParam = key + '=' + val,
            params = '?' + newParam;

        // If the "search" string exists, then build params from it
        if (search) {
            // Try to replace an existance instance
            params = search.replace(new RegExp('([?&])' + key + '[^&]*'), '$1' + newParam);

            // If nothing was replaced, then add the new param to the end
            if (params === search) {
                params += '&' + newParam;
            }
        }

        return params;
    };

})(jQuery)