<div class="mails">
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
         <button class="new_message_btn">Nouveau Message</button>
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
                     26 avr
                  </td>
               </tr>
            <?php endforeach; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>