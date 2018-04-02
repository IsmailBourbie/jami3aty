<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>
       <?= $data["page_title"] ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?= URL_ROOT ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL_ROOT ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= URL_ROOT ?>css/main.css">
</head>
<?php if (!Session::isLoggedin()) require_once APP_ROOT . "/views/inc/nav-default.php"; ?>
<body>
