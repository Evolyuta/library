<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = clearStr($_POST['title']);
    $authorFullName = clearStr($_POST['authorFullName']);
    $authorCountry = clearStr($_POST['authorCountry']);
    $pages = clearInt($_POST['pages']);
    $pubYear = clearInt($_POST['pubYear']);
    $publisher = clearStr($_POST['publisher']);
    $cover = clearStr($_POST['cover']);

    $name = explode(" ", $authorFullName)[0];
    $surname = explode(" ", $authorFullName)[1];
    $patronymic = explode(" ", $authorFullName)[2];
    $idAuthor = getIdOfAuthor($name, $surname, $patronymic, $authorCountry);

    addItemToBooks($title, $idAuthor, $pages, $pubYear, $publisher, $cover);

    header("Location: " . $_SERVER["REQUEST_URI"]);
    exit;
}
?>

<h3>Добавьте книгу в базу</h3>

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
