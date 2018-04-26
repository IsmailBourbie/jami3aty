<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
$mails = $data["data"];
$sender_status = "up";
//die(var_dump($mails));
?>
<div class="row reset-margin">
    <div class="aside-left reset-padding">
       <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
    </div>
    <div class="content">
       <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
        <div class="main">
           <?php require_once APP_ROOT . '/views/inc/mails-mold.php'; ?>
        </div>
    </div>
   <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
   <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
