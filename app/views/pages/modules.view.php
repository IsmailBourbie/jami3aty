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
                        <h3><?= $response[0]->title ?></h3>
                        <p class="lead description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Dignissimos, voluptate!</p>
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
