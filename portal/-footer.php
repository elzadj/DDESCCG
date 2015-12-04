<?php if (!!$deviceTypeConfig->isOffline || !!$deviceTypeConfig->shutDownButton || !!$deviceTypeConfig->batteryStatus) { ?>
<footer class="footer"<?php echo !!$deviceTypeConfig->shutDownButton ? ' style="justify-content: space-between"' : ''; ?>>
    <?php if (!!$deviceTypeConfig->shutDownButton) { ?>
    <div class="buttons">
        <button id="btn-shutdown" type="button">Shut down</button>
    </div>
    <?php } ?>
    
    <?php if (!!$deviceTypeConfig->isOffline || !!$deviceTypeConfig->batteryStatus) { ?>
    <div class="status-icons">
        <?php if (!!$deviceTypeConfig->isOffline) { ?>
        <div class="upload-status"></div>
        <div class="connectivity"></div>
        <?php } ?>
        <?php if (!!$deviceTypeConfig->batteryStatus) { ?>
        <div class="battery-level"></div>
        <?php } ?>
    </div>
    <?php } ?>
</footer>
<?php } ?>
