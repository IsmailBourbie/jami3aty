<?php
require_once APP_ROOT . '/views/inc/header.php';
require_once APP_ROOT . '/views/inc/css_inc.php';
?>
    <div class="container">
        <form class="col-md-5 col-md-push-3" action="<?= URL_ROOT ?>auth/confirmation" method="post" style="
            border: 1px solid #DDDDDD;
            text-align: center;
            margin: 100px auto;
            padding:20px 10px;">
            <div class="">
                <h3 style="margin: 20px auto;">Confirmation Email:</h3>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    <div class="input-group <?php if ($data["status"] !== OK) echo 'border-err'; ?>">
                        <span class="input-group-addon">@</span>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?=$_SESSION["user_email"]?>">
                    </div>
                    <div class="error">
                        <?php if ($data["status"] !== OK) echo $data['message']; ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="submit" name="submit" class="btn btn-success" value="Send">
                </div>
            </div>
            <?php Session::flash('confirm_email_send')?>
        </form>
        <?php
require_once APP_ROOT . '/views/inc/js_inc.php';
require_once APP_ROOT . '/views/inc/footer.php';
?>
