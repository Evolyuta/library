<?php

function clearStr($data)
{
    global $link;
    $data = trim(strip_tags($data));
    return mysqli_real_escape_string($link, $data);
}

function clearInt($data)
{
    return abs((int)($data));
}

function addItemToBooks($title, $author, $pages, $pubYear, $publisher, $cover)
{
    global $link;
    $sql = 'INSERT INTO books (title, author, pages, pubYear, publisher, cover) VALUES (?,?,?,?,?,?)';

    if (!$stmt = mysqli_prepare($link, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "siiiss", $title, $author, $pages, $pubYear, $publisher, $cover);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function selectItemsFromAuthors()
{
    global $link;
    $sql = 'SELECT id, name, surname, patronymic, country FROM authors';

    if (!$result = mysqli_query($link, $sql)) return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items;
}

function getIdOfAuthor($name, $surname, $patronymic, $country)
{
    $authors = selectItemsFromAuthors();
    foreach ($authors as $author)
        if (($author['name'] == $name)
            and ($author['surname'] == $surname)
            and ($author['patronymic'] == $patronymic)) {
            return $author['id'];
            exit;
        }

    global $link;

    $sql = 'INSERT INTO authors (name, surname, patronymic, country) VALUES (?,?,?,?)';
    if (!$stmt = mysqli_prepare($link, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $patronymic, $country);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $last_id = $link->insert_id;
    return $last_id;
}

function selectItemsFromBooks()
{
    global $link;
    $sql = 'SELECT id, title, author, pages, pubYear, publisher, cover FROM books';

    if (!$result = mysqli_query($link, $sql)) return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items;
}
