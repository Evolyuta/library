<?php
require "/inc/lib.inc.php";
require "/inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Карточка книги</title>
    <meta charset="utf-8">
</head>
<body>
<h3>Карточка книги</h3>
<?
$id = abs((int)$_GET['id']);
if ($id) {
    $book = getItemFromBooks($id);
    $authorId = $book['author'];
    $author = getItemFromAuthors($authorId);
    $authorFullName =
        $author['name']
        . ' ' . $author['surname']
        . ' ' . $author['patronymic'];
    $authorCountry = $author['country'];
    ?>
    <hr>
    <p><b>Название</b>: <?= $book["title"] ?> </p>
    <p><b>ФИО автора</b>: <?= $authorFullName ?></p>
    <p><b>Страна автора</b>: <?= $authorCountry ?> </p>
    <p><b>Количество страниц</b>: <?= $book["pages"] ?></p>
    <p><b>Uод публикации:</b>: <?= $book["pubYear"] ?></p>
    <p><b>Издатель</b>: <?= $book["publisher"] ?></p>
    <p><b>Тип обложки:</b>: <?= $book["cover"] ?></p>
    <?
    echo "<a href='http://library/index.php?id=list'>Вернуться к списку книг";
}
?>
</body>
</html>
