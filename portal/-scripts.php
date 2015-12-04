<script src="vendor/jquery/jquery-2.1.3.min.js"></script>

<?php if (!!$deviceTypeConfig->isOffline || !!$deviceTypeConfig->shutDownButton) { ?>
<script src="vendor/vex/vex.combined.min.js"></script>
<script>
vex.defaultOptions.className = 'vex-theme-os';
</script>
<?php } ?>

<?php if (!!$deviceTypeConfig->shutDownButton) { ?>
<script src="js/shutdown.js"></script>
<?php } ?>
<?php if (!!$deviceTypeConfig->isOffline) { ?>
<script src="js/connectivity.js"></script>
<script src="js/database.js"></script>
<?php } ?>
<?php if (!!$deviceTypeConfig->batteryStatus) { ?>
<script src="js/battery-level.js"></script>
<?php } ?>
