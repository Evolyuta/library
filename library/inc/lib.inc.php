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

function addItemToBooks($title, $author, $pages, $pubYear, $publisher, $cover, $dateCreated)
{
    global $link;
    $sql = 'INSERT INTO books (title, author, pages, pubYear, publisher, cover, created_at) VALUES (?,?,?,?,?,?,?)';

    if (!$stmt = mysqli_prepare($link, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "siiissi", $title, $author, $pages, $pubYear, $publisher,
        $cover, $dateCreated);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function selectItemsFromAuthors()
{
    global $link;
    $sql = "SELECT id, name, surname, patronymic, country FROM authors";

    if (!$result = mysqli_query($link, $sql)) return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items;
}

function getIdOfAuthor($name, $surname, $patronymic, $country, $dateCreated)
{
    $authors = selectItemsFromAuthors();
    foreach ($authors as $author)
        if (($author['name'] == $name)
            and ($author['surname'] == $surname)
            and ($author['patronymic'] == $patronymic)) {
            return $author['id'];
        }

    global $link;

    $sql = 'INSERT INTO authors (name, surname, patronymic, country, created_at) VALUES (?,?,?,?,?)';
    if (!$stmt = mysqli_prepare($link, $sql)) return false;
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $surname, $patronymic, $country, $dateCreated);
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

function getItemFromBooks($id)
{
    global $link;
    $sql = "SELECT id, title, author, pages, pubYear, publisher, cover FROM books WHERE id = '$id'";

    if (!$result = mysqli_query($link, $sql)) return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items[0];
}


function getItemFromAuthors($id)
{
    global $link;
    $sql = "SELECT id, name, surname, patronymic, country FROM authors WHERE id = '$id'";

    if (!$result = mysqli_query($link, $sql)) return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items[0];
}

function editItemInAuthors($name, $surname, $patronymic, $country, $id, $dateUpDate)
{
    global $link;
    $sql = "UPDATE authors SET name='$name', surname='$surname', patronymic='$patronymic'
,country='$country',updated_at=$dateUpDate WHERE id='$id'";
    mysqli_query($link, $sql);
    return true;
}

function editCountryInAuthors($country, $dateUpDate, $id)
{
    global $link;
    $sql = "UPDATE authors SET country='$country', updated_at=$dateUpDate WHERE id='$id'";
    mysqli_query($link, $sql);
    return true;
}

function editItemInBooks($title, $author, $pages, $pubYear, $publisher, $cover, $dateUpDate, $id)
{
    global $link;
    $sql = "UPDATE books SET title='$title', author='$author', pages='$pages', 
 pubYear='$pubYear', publisher='$publisher', cover='$cover', updated_at=$dateUpDate WHERE id='$id'";
    mysqli_query($link, $sql);
    return true;
}

function deleteItemInBooks($id)
{
    global $link;
    $sql = "DELETE FROM books WHERE id = $id";
    mysqli_query($link, $sql);
    return true;
}

function selectItemsFromBooksForExcelFile()
{
    global $link;
    $sql = 'SELECT title, author, pages, pubYear, publisher FROM books';

    if (!$result = mysqli_query($link, $sql)) return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items;
}
