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
                <div class="notifications">
                    <?php foreach ($responses as $response): ?>
                    <div class="notif_mold">
                        <div class="left">
                            <a href="#" class='header'>
                                <div class="icon">
                                    <i class="fa fa-bell fa-3x"></i>
                                </div>
                                <div class="info">
                                    <div class="title">
                                        <span id="prof_name"><?= $response->fullName ?></span> à publier
                                        <span id="type_post"><?= \App\Classes\Helper::typeOfPostToString($response->type) ?></span>
                                    </div>
                                    <div class="description">
                                        <h4>
                                            <?= $response->title ?>
                                        </h4>
                                        <span class="separitor">.</span>
                                        <span class="time"><?= Time::formatTime($response->date_post) ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
    <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
