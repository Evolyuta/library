<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = clearStr($_POST['title']);
    $fullName = clearStr($_POST['fullName']);
    $country = clearStr($_POST['country']);
    $pages = clearInt($_POST['pages']);
    $pubYear = clearInt($_POST['pubYear']);
    $publisher = clearStr($_POST['publisher']);
    $cover = clearStr($_POST['cover']);

    $name = explode(" ", $fullName)[0];
    $surname = explode(" ", $fullName)[1];
    $patronymic = explode(" ", $fullName)[2];
    $idAuthor = getIdOfAuthor($name, $surname, $patronymic, $country);

    addItemToBooks($title,$idAuthor,$pages,$pubYear,$publisher,$cover);

    header("Location: " . $_SERVER["REQUEST_URI"]);
    exit;
}
?>

<h3>Добавьте книгу в базу</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    Название: <br/><input type="text" name="title"/><br/>
    ФИО автора: <br/><input type="text" name="fullName"/><br/>
    Страна автора: <br/><input type="text" name="country"/><br/>
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
