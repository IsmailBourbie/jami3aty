
</head>
<?php if (!Session::isLoggedin()) require_once APP_ROOT . "/views/inc/nav-default.php"; ?>
<body data-type="<?php if(Session::isProf()){echo 0;} else {echo 1;};?>">
