<?php
define('DEVICE_KIOSK', 'kiosk');
define('DEVICE_PC', 'pc');
define('DEVICE_HANDHELD', 'handheld');
define('DEVICE_WEB', 'web');


# Load general config
$generalConfig = getConfig();


# Get Device ID
$cookieDeviceID = isset($_COOKIE['deviceID']) ? $_COOKIE['deviceID'] : NULL;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $deviceID = $_GET['id'];
    setcookie('deviceID', $deviceID, 0);
    
    ## Unset PID if Device ID has changed
    if (!isset($cookieDeviceID) || $cookieDeviceID !== $deviceID) {
        unset($_COOKIE['practiceID']);
    }

} elseif (isset($_COOKIE['deviceID'])) {
    $deviceID = $_COOKIE['deviceID'];

} else {
    exit('no `id` var in querystring');
}


# Get device data
$device = getDevice($deviceID);


# Device type
switch (substr($deviceID, 0, 2)) {
    case 'K_':
        $deviceType = DEVICE_KIOSK;
        break;

    case 'P_':
        $deviceType = DEVICE_PC;
        break;

    case 'M_':
        $deviceType = DEVICE_HANDHELD;
        break;

    default:
        $deviceType = DEVICE_WEB;
}
