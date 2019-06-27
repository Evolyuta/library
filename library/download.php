<?php
require "/inc/lib.inc.php";
require "/inc/config.inc.php";

$books = selectItemsFromBooksForExcelFile();
if ($books === false) {
    echo "Error!";
    exit;
}
if (!count($books)) {
    echo "Empty!";
    exit;
}

$data =[];

foreach ($books as $book) {
    $authorId = $book['author'];
    $author = getItemFromAuthors($authorId);
    $authorFullName =
        $author['name']
        . ' ' . $author['surname']
        . ' ' . $author['patronymic'];
    $book['author'] = $authorFullName;
    $data[]=$book;
}

var_dump($data);
