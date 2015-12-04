(function ($, undefined) {
    'use strict';

    var
        interval,
        $batteryLevel = $('.battery-level'),

        init = function () {
            getBatteryLevel();
            interval = setInterval(getBatteryLevel, 5000);
        },

        getBatteryLevel = function () {
            //console.log('func: getBatteryLevel()');

            $.ajax({
                cache: false,
                dataType: 'json',
                success: function (d) {
                    updateBatteryLevel(d);
                },
                error: function () {
                    updateBatteryLevel();
                },
                url: '../device-status.json'
            });
        },

        updateBatteryLevel = function (deviceStatus) {
            var level = !!deviceStatus && !!deviceStatus.battery ? parseInt(deviceStatus.battery, 10) : false,
                html;

            if (!!level) {
                html = '<div class="level_' + (Math.ceil(level / 10) || 0) + '">' +
                    '   <div></div>' +
                    '   <p>' + level + '%</p>' +
                    '</div>';

                $batteryLevel.html(html);
            }
        };

    init();
})(jQuery);
