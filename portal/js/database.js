(function ($, undefined) {
    'use strict';

    var
        interval,
        $uploadStatus = $('.upload-status'),

        databaseErrorDialog = function () {
            vex.dialog.confirm({
                contentCSS: { 'min-width': '500px' },
                message: '<p><strong>Cannot connect to database</strong></p>\n<p>There seems to be a problem connecting to the database.</p>\n<p>This means <strong>new survey responses will not be saved</strong> and older responses cannot be uploaded.</p>\n<p>Restarting the device may solve the issue, but if not and this message shows again, please contact Elephant Kiosks on 01223 812737 for further support.</p>',
                buttons: [
                    $.extend({}, vex.dialog.buttons.YES, {
                        text: 'Shut down',
                        click: shutdown
                    }),
                    $.extend({}, vex.dialog.buttons.YES, {
                        text: 'Restart',
                        click: restart
                    }),
                    $.extend({}, vex.dialog.buttons.NO, {
                        text: 'Cancel'
                    })
                ]
            });
        },
        
        init = function () {
            getDatabaseStatus();
            interval = setInterval(getDatabaseStatus, 5000);
        },

        getDatabaseStatus = function () {
            //console.log('func: getDatabaseStatus()');
            
            $.ajax({
                cache: false,
                dataType: 'json',
                success: function (d) {
                    updateDatabase(d);
                },
                error: function () {
                    updateDatabase();
                },
                url: '-dbstatus.php'
            });
        },

        restart = function () {
            try {
                window.external.InitScriptInterface();
                SiteKiosk.RebootWindows();
            } catch(e) {
                alert('Could not restart device');
            }
        },

        shutdown = function () {
            try {
                window.external.InitScriptInterface();
                SiteKiosk.ShutdownWindows();
            } catch(e) {
                alert('Could not shut down device');
            }
        },

        updateDatabase = function (dbStatus) {
            var error = !!dbStatus.error ? dbStatus.error : false,
                ready = !!dbStatus && !!dbStatus.ready ? dbStatus.ready : 0,
                html  = 'Waiting to upload: ' + ready;

            if (error) {
                databaseErrorDialog();
                $('.upload-status').html('<img src="img/cross.png" alt="">Database error');
                window.clearInterval(interval);

            } else {
                $uploadStatus.html(html);
            }
        };

    init();
})(jQuery);
