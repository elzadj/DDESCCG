<?php
require_once('vendor/parsedown/parsedown.php');
require_once('vendor/parsedown/parsedown-extra.php');
$parsedown = new ParsedownExtra();

$deviceTypeConfig = $generalConfig->devices->{$deviceType};

?><!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo isset($practice) ? html($practice->title) : 'Choose a practice'; ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/styles.css">
    <?php if (!!$deviceTypeConfig->isOffline || !!$deviceTypeConfig->shutDownButton) { ?>
    <link rel="stylesheet" href="vendor/vex/vex.css">
    <link rel="stylesheet" href="vendor/vex/vex-theme-os.css">
    <?php } ?>
    <?php if (file_exists('config/styles.css')) { ?>
    <link rel="stylesheet" href="config/styles.css">
    <?php } ?>
    <?php if (!$deviceTypeConfig->isOffline) { ?>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Ubuntu:400,600|Open+Sans:400,600">
    <?php } ?>
</head>


<body class="<?php echo $page; ?> container">
    
    <?php if (file_exists('config/header.php')) { ?>
    <header class="app-header">
        <?php include('config/header.php'); ?>
    </header>
    <?php } ?>

    <?php if (isset($multiplePractices) && !!$multiplePractices && isset($practice)) { ?>
    <header class="practice-header">
        <h2><?php echo html($practice->title); ?></h2>
        <a class="button change" href="choose-practice.php?id=<?php echo html($deviceID); ?>">Change practice</a>
    </header>
    <?php } ?>
