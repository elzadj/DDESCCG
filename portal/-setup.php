<?php

require_once('-device.php');


# Get Practice ID
if (isset($_GET['pid']) && !empty($_GET['pid'])) {
    $practiceID = $_GET['pid'];
    setcookie('practiceID', $practiceID, 0);

} elseif (isset($_COOKIE['practiceID'])) {
    $practiceID = $_COOKIE['practiceID'];

} elseif (isset($device->practices) && count($device->practices) === 1) {
    $practiceID = $device->practices[0];
    setcookie('practiceID', $practiceID, 0);
    
} else {
    header('Location:choose-practice.php?id=' . $deviceID);
    exit();
}

$multiplePractices = !isset($device->practices) || count($device->practices) > 1;


# Load layout data
$layout = getLayout($practiceID);


# Load practices data
$practice = getPractice($practiceID, $deviceID);
