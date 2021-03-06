<?php
require_once APP_ROOT . '/views/inc/header.php';
?>
<div class="container">
    <form class="col-md-5 col-md-push-3" action="<?= URL_ROOT ?>users/forgotpass" method="post" style="
            border: 1px solid #DDDDDD;
            text-align: center;
            margin: 100px auto;
            padding:20px 10px;">
        <div class="">
            <h3 style="margin: 20px auto;">Search Email:</h3>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="input-group <?php if ($data["status"] !== OK) echo 'border-err'; ?>">
                    <span class="input-group-addon">@</span>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="error">
                   <?php if ($data["status"] !== OK) echo $data['message']; ?>
                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" name="submit" class="btn btn-success" value="Send">
            </div>
        </div>
       <?php Session::flash('email_send') ?>
    </form>
   <?php
   require_once APP_ROOT . '/views/inc/footer.php';
   ?>
