<?php
ob_start();
include 'inc/headers.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        <?= $title ?>
    </title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand"><?= $header ?></a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href='index.php'>Домой</a>
            </li>
            <li><a href='index.php?id=contact'>Контакты</a>
            </li>
            <li><a href='index.php?id=create'>Создание книги</a>
            </li>
            <li><a href='index.php?id=list'>Список книг</a>
            </li>
            <li><a href='index.php?id=download'>Загрузить</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <?php
    include 'inc/routing.inc.php';
    ?>
</div>

<!-- Footer -->
<footer class="page-footer font-small unique-color-dark pt-4">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">&copy; Сайт библиотеки, 2000 &ndash; <?= date('Y') ?></div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</body>

</html>
