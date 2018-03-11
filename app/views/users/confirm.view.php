<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= SITE_NAME ?> - Confirm</title>
    <link rel="stylesheet" href="<?= URL_ROOT ?>css/bootstrap.min.css">
    <style>
        form {
            border: 1px solid #DDDDDD;
            text-align: center;
            width: 50%;
            margin: 100px auto;
            padding:20px 10px;

        }
        form h3 {
            margin: 20px auto;
        }
    </style>
</head>
<body>
<div class="container">
    <form action="<?= URL_ROOT ?>users/confirm" method="post">
        <div class="">
            <h3>Confirmation Email:</h3>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" name="submit" class="btn btn-success" value="Send">
            </div>
        </div>
    </form>
</div>
</body>
</html>