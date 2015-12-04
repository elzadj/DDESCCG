(function ($, vex, undefined) {
    'use strict';

    var
        shutdown = function () {
            try {
                window.external.InitScriptInterface();
                SiteKiosk.ShutdownWindows();
            } catch(e) {
                alert('Could not shut down device');
            }
        },

        shutdownDialog = function () {
            vex.dialog.confirm({
                message: 'Do you really want to shut down the device?',
                buttons: [
                    $.extend({}, vex.dialog.buttons.YES, {
                        text: 'Shut down'
                    }),
                    $.extend({}, vex.dialog.buttons.NO, {
                        text: 'Cancel'
                    })
                ],
                callback: function(value) {
                    if (!!value) {
                        shutdown();
                    }
                }
            });
        };
    

    $('#btn-shutdown').on('click', shutdownDialog);
    
})(jQuery, vex);
