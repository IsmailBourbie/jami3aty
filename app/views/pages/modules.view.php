<?php
require_once APP_ROOT . '/views/inc/header.php';
if ($data["status"] == OK) {
   $response = $data["data"];
} else {
   $response = array();
}
?>

    <!--Modules pages-->

    <div class="row reset-margin">
        <div class="col-lg-3  col-md-12 aside-left">
            <?php
       require_once APP_ROOT . '/views/inc/navigation-bar.php';
       ?>
        </div>
        <div class="col-lg-9  col-md-12 modules">
            <div class="row reset-margin">
                <div class="col-lg-4 card_mold">
                    <div class="front">
                        <div class="header">
                            <span class="circle"><?= $response[0]->short_title ?></span>
                        </div>
                        <div class="body">
                            <h3>
                                <?= $response[0]->title ?>
                            </h3>
                            <div class="description text-left">
                                <h4 class="reset-margin">Enseignants:</h4>
                                <ul class="list-unstyled reset-margin professors">
                                    <li><span>Course:</span> Lorem ipsum.</li>
                                    <li><span>TD:</span> Lorem ipsum.</li>
                                    <li><span>TP:</span> Lorem ipsum.</li>
                                </ul>
                            </div>
                            <span class="clickme">Hover to see Contents</span>
                        </div>
                    </div>
                    <div class="back">
                        <ol class="reset-margin">
                            <li>Lorem ipsum dolor.</li>
                            <li>Lorem ipsum dolor.</li>
                            <li>Lorem ipsum dolor.</li>
                            <li>Lorem ipsum dolor.</li>
                            <li>Lorem ipsum dolor.</li>
                            <li>Lorem ipsum dolor.</li>
                            <li>Lorem ipsum dolor.</li>
                            <li>Lorem ipsum dolor.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
require_once APP_ROOT . '/views/inc/footer.php';
?>
