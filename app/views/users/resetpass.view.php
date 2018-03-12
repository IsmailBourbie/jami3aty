<?php
require_once APP_ROOT . '/views/inc/header.php';
?>
   <div class="container">
   <form action="<?= URL_ROOT ?>users/resetpass/<?=$data['token']?>" method="post" style="
            border: 1px solid #DDDDDD;
            text-align: center;
            width: 50%;
            margin: 100px auto;
            padding:20px 10px;">
      <div class="">
         <h3 style="margin: 20px auto;">Create new password:</h3>
      </div>
       <input type="hidden" name="token" value="<?=$data['token']?>">
      <div class="row">
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">@</span>
               <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
         </div>
         <div class="col-md-6">
            <div class="input-group">
               <span class="input-group-addon">@</span>
               <input type="password" class="form-control" placeholder="Confirm" name="confirmPassword">
            </div>
         </div>
         <div class="col-md-2" style="margin-top: 10px">
            <input type="submit" name="submit" class="btn btn-success" value="Send">
         </div>
      </div>
   </form>
<?php
require_once APP_ROOT . '/views/inc/footer.php';
?>