<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
$mail = $data["data"];
if ($mail->sender == 1) {
   $sender = $mail->fullNameP;
   $receiver = $mail->fullNameS;
} else {
   $sender = $mail->fullNameS;
   $receiver = $mail->fullNameP;
}
//die(var_dump($mail));
?>
    <div class="row reset-margin">
        <div class="aside-left reset-padding">
            <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
        </div>
        <div class="content">
            <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
            <div class="main">
                <div class="mail_layout">
                    <!-- Modal of show message-->
                    <div class="modal fade sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="sendMessageModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="gridSystemModalLabel">Message</h4>
                                </div>
                                <div class="modal-body" id="md-body">
                                    <!-- Header of body -->
                                    <div class="row data-message">
                                        <div class="col-xs-12 subject">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                        <i class="fa fa-clipboard"></i>
                                                    </span>
                                                <div id="subject-reply" class="form-control">
                                                    <?=$mail->subject?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- body of body hahaha -->
                                    <div class="text-message">
                                        <div class="input-group">
                                            <label for="text-message">Message</label>
                                            <textarea id="text-reply-message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="send-reply-btn" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header">
                        <div class="user_logo">
                            <i class="fa fa-user fa-4x"></i>
                        </div>
                        <div class="mail_detail">
                            <div class="name_sender_receiv">
                                <h3 class="name_sender reset-margin">
                                   <span id="id_std" class="hide"><?= $mail->_id_student ?></span>
                                    <?= $sender ?>
                                </h3>
                                <span><i class="fa fa-angle-double-right fa-2x"></i></span>
                                <h3 class="name_receiver reset-margin">
                                <span id="id_prof" class="hide"><?= $mail->_id_professor ?></span>
                                    <?= $receiver ?>
                                </h3>
                            </div>
                            <span class="time"><?= Time::formatTime($mail->date) ?></span>
                        </div>
                    </div>
                    <div class="body">
                        <div class="subject_detail">
                            <h3><strong>Sujet:</strong></h3>
                            <p class="lead">
                                <?= $mail->subject ?>
                            </p>
                        </div>
                        <div class="message_text_detail">
                            <h3 class="reset-margin"><strong>Message:</strong></h3>
                            <p class="lead">
                                <?= $mail->message ?>
                            </p>
                        </div>
                    </div>
                    <div class="footer" data-target="<?=$mail->_id_mail?>">
                        <button id="reply-message" class="btn btn-primary pull-right" data-toggle="modal" data-target=".sendMessageModal">
                        repley
                    </button>
                    </div>
                </div>

            </div>
        </div>
        <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
        <script src="<?= URL_ROOT ?>js/plugins-mails.js"></script>
        <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
