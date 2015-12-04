<?php
$page = 'health-page';
require_once('-functions.php');
require_once('-setup.php');
require_once('-head.php');

$path = [];
if (isset($_GET['path']) && strlen($_GET['path'])) {
    $path = explode('.', $_GET['path']);
}

$links = getLinks($path, $practiceID);
?>

    <main>
        <div class="page-header">
            <a class="button back" href=".">
                <img src="img/arrow-circle-left.svg" alt="">
                <span>Main Menu</span>
            </a>
            <?php if (count($path)) {
                $arr = $path;
                array_pop($arr);
            ?>
            <a class="button back" href="health.php?path=<?php echo implode('.', $arr); ?>&amp;id=<?php echo html($deviceID); ?>&amp;pid=<?php echo html($practiceID); ?>">
                <img src="img/arrow-circle-left.svg" alt="">
                <span>Back</span>
            </a>
            <?php } ?>
        </div>

        <h1>Health Information</h1>
        <?php if (isset($links) && count($links)) { ?>
        <ul class="buttons">
            <?php
            for ($i = 0; $i < count($links); $i++) {
                $link = $links[$i];
                $isCategory = isset($link->content);
                if ($isCategory) {
                    $arr = $path;
                    $arr[] = $i;
                    $url = '?path=' . implode('.', $arr);
                    $class = 'cat';
                } else {
                    $url = html($link->url);
                    $class = 'link';
                }
            ?>
            <li>
                <a class="button <?php echo $class; ?>" href="<?php echo $url; ?>">
                    <span>
                        <?php echo html($link->title); ?>
                        <?php echo isset($link->description) ? '<span>' . html($link->description) . '</span>' : ''; ?>
                    </span>
                    <img src="img/arrow-circle-right.svg" alt="">
                </a>
            </li>
            <?php } ?>
        </ul>
        <?php } else { ?>
        <p>No links to show.</p>
        <?php } ?>
    </main>
    
<?php
require_once('-footer.php');
require_once('-scripts.php');
require_once('-foot.php');
