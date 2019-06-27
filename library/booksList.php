<?php
require "/inc/lib.inc.php";
require "/inc/config.inc.php";
$books = selectItemsFromBooks();
$authors = selectItemsFromAuthors();
if ($books === false) {
    echo "Error!";
    exit;
}
if (!count($books)) {
    echo "Empty!";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Список книг</title>
</head>
<body>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>Название</th>
        <th>ФИО автора</th>
        <th>Страна автора</th>
        <th>Количество страниц</th>
        <th>Год публикации</th>
        <th>Издатель</th>
        <th>Тип обложки</th>
        <th>Посмотреть</th>
        <th>Редактировать</th>
        <th>Удалить</th>
    </tr>
    <?php
    foreach ($books as $book) {
        $authorId = $book['author'];
        foreach ($authors as $author) {
            if ($author['id'] == $authorId) {
                $authorFullName =
                    $author['name']
                    . ' ' . $author['surname']
                    . ' ' . $author['patronymic'];
                $authorCountry = $author['country'];
            }
        }
        ?>
        <tr>
            <td><?= $book['title'] ?></td>
            <td><?= $authorFullName ?></td>
            <td><?= $authorCountry ?></td>
            <td><?= $book['pages'] ?></td>
            <td><?= $book['pubYear'] ?></td>
            <td><?= $book['publisher'] ?></td>
            <td><?= $book['cover'] ?></td>
            <td><a href="show.php?id=<?=
                $book['id'] ?>">Посмотреть</td>
            <td><a href="edit.php?id=<?=
                $book['id'] ?>">Редактировать</td>
            <td><a href="delete.php?id=<?=
                $book['id'] ?>">Удалить</td>
        </tr>
        <?
    }


    ?>
</table>
</body>
</html>