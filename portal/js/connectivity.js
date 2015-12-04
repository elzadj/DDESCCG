(function ($, undefined) {
    'use strict';

    var
        interval,
        $connectivity = $('.connectivity'),
        
        init = function () {
            updateConnectivity();
            interval = setInterval(updateConnectivity, 1000);
        },

        updateConnectivity = function () {
            var
                status = navigator.onLine ? 'on' : 'off',
                html   = '<div class="connectivity_' + status + '"></div>';

            $connectivity.html(html);
        };

    init();
})(jQuery);
