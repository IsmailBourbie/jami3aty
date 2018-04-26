<div class="mails">
    <!-- Modal of show message-->
    <div class="modal fade showMessageModal" tabindex="-1" role="dialog" aria-labelledby="showMessageModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Message</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".sendMessageModal">Large modal</button>

                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="filter">
            <div class="dropdown">
                <button id="filter-mail" type="button" data-toggle="dropdown">
               Filtrer les messages
               <span class="caret"></span>
            </button>
                <ul class="dropdown-menu reset-margin" aria-labelledby="filter-mail">
                    <li><a class="reset-padding" href="<?=URL_ROOT?>mails">Tout les messages</a></li>
                    <li><a class="reset-padding" href="<?=URL_ROOT?>mails/sent">Messages envoyées</a></li>
                    <li><a class="reset-padding" href="<?=URL_ROOT?>mails/received">Messages reçus</a></li>
                </ul>
            </div>
        </div>
        <div class="new_message">
            <button type="button" class="new_message_btn" data-toggle="modal" data-target=".showMessageModal">Nouveau Message</button>
        </div>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    <?php foreach ($mails as $mail):
               if ($mail->sender == 1) {
                  $sender_status = "down";
               } else {
                  $sender_status = "up";
               } ?>
                    <tr data-target="<?= $mail->_id_mail ?>">
                        <td class="icon_send">
                            <i class="fa fa-arrow-circle-<?= $sender_status ?>"></i>
                        </td>
                        <td class="sender">
                            <?= $mail->fullNameP ?>
                        </td>
                        <td class="content">
                            <div class="nowrap">
                                <span class="subject"><?= $mail->subject ?> - </span>
                                <span class="text-message"><?= $mail->message ?></span>
                            </div>
                        </td>
                        <td class="time">
                            <?= Time::formatTime($mail->date) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
        <!-- Modal of send message-->
    <div class="modal fade sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="sendMessageModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Send</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</div>
