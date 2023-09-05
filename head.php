<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <?php
    if (empty($title)) $title = 'Enot.io - тестовое задание';
    ?>
    <title><?= $title ?></title>
    <link href="/style/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
</head>
<body>
<header>
    <div class="container-head">
        <div class="logo">
           <a href="/"><img src="https://enot.io/themes/global/img/logo_new.svg" width="105" class="logo"></a>
        </div>
        <div class="title_str"><?= $title ?></div>
    </div>
</header>

<div class="wrapper">
