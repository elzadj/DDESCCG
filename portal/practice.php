<?php
$page = 'practice-page';
require_once('-functions.php');
require_once('-setup.php');
require_once('-head.php');

function showImg($practiceID, $type) {
    if (file_exists('config/practices/' . $practiceID . '/' . $type . '.jpg')) {
        $img = 'config/practices/' . $practiceID . '/' . $type . '.jpg';
    } elseif (file_exists('config/practices/' . $practiceID . '/' . $type . '.png')) {
        $img = 'config/practices/' . $practiceID . '/' . $type . '.png';
    } elseif (file_exists('config/practices/' . $practiceID . '/' . $type . '.gif')) {
        $img = 'config/practices/' . $practiceID . '/' . $type . '.gif';
    } else {
        return FALSE;
    }

    echo '<img src="' . html($img) . '" alt="">';
}
?>

    <main>
        <div class="page-header">
            <a class="button back" href=".">
                <img src="img/arrow-circle-left.svg" alt="">
                <span>Back</span>
            </a>
        </div>


        <div class="images">
            <?php showImg($practiceID, 'logo'); ?>
            <?php showImg($practiceID, 'practice'); ?>
            <?php showImg($practiceID, 'photo'); ?>
        </div>

        <h1><?php echo html($practice->title); ?></h1>
        
        <?php if (isset($practice->about)) { ?>
        <?php if (isset($practice->about->info) && !empty($practice->about->info)) { ?>
        <div class="block">
            <p class="intro">
                <?php echo $parsedown->text($practice->about->info); ?>
            </p>
        </div>
        <?php } ?>
        
        <?php if (isset($practice->about->hours) && !empty($practice->about->hours)) { ?>
        <div class="block hours">
            <h2>Surgery Hours</h2>
            <div class="fields">
                <?php
                if (is_array($practice->about->hours)) {
                    foreach($practice->about->hours as $p) {
                        echo '<div class="practice-hours">';
                        echo '    <div class="practice-hours-title">' . html($p->title) . '</div>';
                        echo '    <div class="practice-hours-hours">' . $parsedown->text($p->hours) . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="practice-hours">';
                    echo '    <div class="practice-hours-hours">' . $parsedown->text($practice->about->hours) . '</div>';
                    echo '</div>';
                }
                ?>
            </div> <!--/fields-->
        </div>
        <?php } ?>

        <div class="block contact">
            <h2>Contact details</h2>
            <div class="fields">
                <?php if (isset($practice->about->address) && !empty($practice->about->address)) { ?>
                <div class="field">
                    <span class="label">Address</span>
                    <div class="value">
                        <strong><?php echo html($practice->title); ?></strong><br>
                        <?php
                        $addr = html($practice->about->address);
                        $arr = explode(',', $addr);
                        $arr = array_map('trim', $arr);
                        echo implode('<br>' . "\n", $arr);
                        ?>
                    </div>
                </div>
                <?php } ?>
                
                <?php if (isset($practice->about->tel) && !empty($practice->about->tel)) { ?>
                <div class="field">
                    <span class="label">Telephone</span>
                    <div class="value">
                        <?php echo $parsedown->text($practice->about->tel); ?>
                    </div>
                </div>
                <?php } ?>
                
                <?php if (isset($practice->about->email) && !empty($practice->about->email)) { ?>
                <div class="field">
                    <span class="label">E-mail</span>
                    <div class="value">
                        <?php echo $parsedown->text($practice->about->email); ?>
                    </div>
                </div>
                <?php } ?>

            </div> <!-- /fields-->
                
            <?php if (isset($practice->about->website) && !empty($practice->about->website)) { ?>
            <div class="site">
                <a class="button" href="<?php echo html($practice->about->website); ?>">
                    <span>Our Website</span>
                    <img src="img/arrow-circle-right.svg" alt="">
                </a>
            </div>
            <?php } ?>
        </div>
        
        <?php } else { ?>
        <p>No practice information to show.</p>
        <?php } ?>
    </main>
    
<?php
require_once('-footer.php');
require_once('-scripts.php');
require_once('-foot.php');
