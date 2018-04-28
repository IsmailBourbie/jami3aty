<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
$mail = $data["data"];
//die(var_dump($mails));
?>
    <div class="row reset-margin">
        <div class="aside-left reset-padding">
            <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
        </div>
        <div class="content">
            <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
            <div class="main">
                <div class="mail_layout">
                    <div class="header">
                        <div class="user_logo">
                            <i class="fa fa-user fa-4x"></i>
                        </div>
                        <div class="mail_detail">
                            <h3 class="name_sender reset-margin">Phd Ouared Aek</h3>
                            <span class="time">17 min</span>
                        </div>
                    </div>
                    <div class="body">
                        <div class="subject_detail">
                            <h3><strong>Sujet:</strong></h3>
                            <p class="lead">Lorem ipsum dolor sit amet.</p>
                        </div>
                        <div class="message_text_detail">
                            <h3 class="reset-margin"><strong>Message:</strong></h3>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi quas, est cupiditate. Similique, quia distinctio illo tempora excepturi rerum facere!</p>
                        </div>
                    </div>
                    <div class="footer">
                        <button class="btn btn-primary pull-right">repley</button>
                    </div>
                </div>

            </div>
        </div>
        <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
        <script src="<?= URL_ROOT ?>js/plugins-mails.js"></script>
        <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
