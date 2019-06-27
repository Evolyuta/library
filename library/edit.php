<?php
require "/inc/lib.inc.php";
require "/inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редактирование книги</title>
    <meta charset="utf-8">
</head>
<body>
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
    <p><b>Год публикации:</b>: <?= $book["pubYear"] ?></p>
    <p><b>Издатель</b>: <?= $book["publisher"] ?></p>
    <p><b>Тип обложки:</b>: <?= $book["cover"] ?></p>
    <?


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        if ($_POST['authorFullName']) {
            $name = explode(" ", $_POST['authorFullName'])[0];
            $surname = explode(" ", $_POST['authorFullName'])[1];
            $patronymic = explode(" ", $_POST['authorFullName'])[2];
            if ($_POST['authorCountry']) {
                $authorCountry = $_POST['authorCountry'];
            };
            $newAuthorId = getIdOfAuthor($name, $surname, $patronymic, $authorCountry);
            if ($newAuthorId == $authorId) {
                editItemInAuthors($name, $surname, $patronymic, $authorCountry, $authorId);
            } else $authorId = $newAuthorId;
        };

        if ($_POST['authorCountry']) {
            $authorCountry = $_POST['authorCountry'];
            editCountryInAuthors($authorCountry, $authorId);
        };

        if ($_POST['title']) $title = clearStr($_POST['title']); else $title = $book["title"];
        if ($_POST['pages']) $pages = clearStr($_POST['pages']); else $pages = $book["pages"];
        if ($_POST['pubYear']) $pubYear = clearStr($_POST['pubYear']); else $pubYear = $book["pubYear"];
        if ($_POST['publisher']) $publisher = clearStr($_POST['publisher']); else $publisher = $book["publisher"];
        if ($_POST['cover']) $cover = clearStr($_POST['cover']); else $cover = $book["cover"];
        editItemInBooks($title, $authorId, $pages, $pubYear, $publisher, $cover, $id);

        echo "Книга изменена! <a href='http://library/index.php?id=list'>Вернуться к списку книг";
        exit;
    }
}
?>

<h3>Редактирование</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    Название: <br/><input type="text" name="title"/><br/>
    ФИО автора: <br/><input type="text" name="authorFullName"/><br/>
    Страна автора: <br/><input type="text" name="authorCountry"/><br/>
    Количество страниц: <br/><input type="text" name="pages"/><br/>
    Год публикации: <br/><input type="text" name="pubYear"/><br/>
    Издатель: <br/><input type="text" name="publisher"/><br/>
    Тип обложки: <br/><select name="cover">
        <option value="Твердая">Твердая</option>
        <option value="Мягкая">Мягкая</option>
    </select><br/>

    <br/>

    <input type="submit" name="send" value="Отправить"/>

</form>

</body>
</html>
