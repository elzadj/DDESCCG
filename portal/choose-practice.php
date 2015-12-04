<?php
$page = 'list-page';
require_once('-functions.php');
require_once('-device.php');


# Get practices for this device
if (isset($device->practices)) {
    $practiceIDs = array_values($device->practices);

    if (count($practiceIDs) === 1) {
        header('Location:.?id=' . $deviceID . '&pid=' . $practiceIDs[0]);
        exit();
    }

    $practices = getPractices($practiceIDs);

} else {
    $practices = getPractices();
}

# Sort practices
uasort($practices, function ($a, $b) {
    return $a->title > $b->title;
});


require_once('-head.php');
?>

    <main>
        <h1>Choose a practice</h1>
        <ul class="buttons">
            <?php foreach ($practices as $practice) { ?>
            <li>
                <a class="button" href=".?id=<?php echo $deviceID; ?>&amp;pid=<?php echo $practice->id; ?>">
                    <span><?php echo html($practice->title); ?></span>
                    <img src="img/arrow-circle-right.svg" alt="">
                </a>
            </li>
            <?php } ?>
        </ul>
    </main>
    
<?php
require_once('-footer.php');
require_once('-scripts.php');
require_once('-foot.php');
