<?php
$page = 'bridge-page';
require_once('-functions.php');
require_once('-setup.php');
require_once('-head.php');
?>

    <main>
        <div class="page-header">
            <a class="button back" href=".">
                <img src="img/arrow-circle-left.svg" alt="">
                <span>Back</span>
            </a>
        </div>

        <h1>The Bridge Young Carers Project</h1>
        
        <?php
        $filepath = 'config/practices/' . $practiceID . '/bridge.html';

        if (file_exists($filepath)) {
            include ($filepath);
        } else {
            echo '<p>No page found</p>';
        }
        ?>

    </main>
    
<?php
require_once('-footer.php');
require_once('-scripts.php');
require_once('-foot.php');
