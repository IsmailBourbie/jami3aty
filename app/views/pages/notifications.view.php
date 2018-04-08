<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
$responses = $data["data"];
?>
    <?php require_once APP_ROOT . '/views/inc/header.php'; ?>
    <div class="row reset-margin">
        <div class="aside-left reset-padding">
            <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
        </div>
        <div class="content">
            <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
            <div class="main">
                <div class="notifications" id="notif-view">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
    <script src="<?=URL_ROOT?>js/plugins-notif.js"></script>
    <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
