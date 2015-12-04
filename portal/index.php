<?php
define('COLS_PER_ROW', 2);

$page = 'home-page';
require_once('-functions.php');
require_once('-setup.php');
require_once('-head.php');

//var_dump($practice); exit();
?>

    <main>
        <nav class="tiles">

            <?php
            $col = 0;

            ## Blocks
            foreach ($layout->content as $block) {
                $blockClasses = ['block'];

                if (isset($block->size)) {
                    $blockClasses[] = $block->size;
                }

                echo '<div class="' . implode(' ', $blockClasses) . '">' . "\n";

                ## Cells
                foreach ($block->cells as $cell) {
                    ## get URL
                    $tileClasses = ['tile'];
                    $url = '';
                    $params = [];

                    if (isset($cell->class)) {
                        $tileClasses[] = html($cell->class);
                        $url = $cell->class . '.php';
                        /*$params = [
                            'id'  => html($deviceID),
                            'pid' => html($practiceID)
                        ];*/
                        
                        if ($cell->class === 'fft') {
                            if (!isset($practice->fft)) {
                                exit('no fft sid found in practices.json for ' . $practiceID);
                            }
                            
                            $url = $generalConfig->surveysPath;
                            $params = [
                                'did' => html($deviceID),
                                'sid' => html($practice->fft)
                            ];

                        }

                        if (count($params)) {
                            $url .= '?' . http_build_query($params);
                        }
                    }

                    if (isset($cell->url)) {
                        $url = $cell->url;
                    }

                    ## HTML
                    echo '    <div class="cell">' . "\n";
                    echo '        <div class="' . implode(' ', $tileClasses) . '"' . (isset($cell->styles) ? ' style="' . html(implode('; ', $cell->styles)) . '"' : '') . '>' . "\n";
                    echo '            <a class="button" href="' . html($url) . '">' . "\n";
                    echo '                <span>' . html($cell->title) . '</span>' . "\n";
                    echo '                <img src="img/arrow-circle-right.svg" alt="">' . "\n";
                    echo '            </a>' . "\n";

                    if (isset($cell->description)) {
                        echo '            <footer>' . "\n";
                        echo '                <p>' . html($cell->description) . '</p>' . "\n";
                        echo '            </footer>' . "\n";
                    }

                    echo '        </div>' . "\n";
                    echo '    </div>' . "\n";
                }
                echo '</div>' . "\n\n";
            }
            ?>
            
        </nav>
    </main>

<?php
require_once('-footer.php');
require_once('-scripts.php');
?>

<script>
(function ($, undefined) {
    'use strict';

    $('.tile').on('click', function () {
        var $tile = $(this),
            url   = $('a', $tile).eq(0).attr('href');

        window.location = url;
    });
})(jQuery);
</script>
    
<?php
require_once('-foot.php');
