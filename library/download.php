<?php
require "/config/app.php";
require "/inc/lib.inc.php";
require "/inc/config.inc.php";
header('Content-Type: Application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="' . FILE_NAME . '.xlsx"');

ob_clean();
//flush();


$books = selectItemsFromBooksForExcelFile();
if ($books === false) {
    echo "Error!";
    exit;
}
if (!count($books)) {
    echo "Empty!";
    exit;
}
$data = [];
foreach ($books as $book) {
    $authorId = $book['author'];
    $author = getItemFromAuthors($authorId);
    $authorFullName =
        $author['name']
        . ' ' . $author['surname']
        . ' ' . $author['patronymic'];
    $book['author'] = $authorFullName;
    $data[] = $book;
}


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$phpExcel = new Spreadsheet();
$phpExcel->getProperties()->setCreator('Лукин Дмитрий')
    ->setTitle('Список книг')
    ->setSubject('Книги')
    ->setDescription('Вывод списка книг');
$phpExcel->getActiveSheet()->setTitle("Лист 1");
$phpExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Название')
    ->setCellValue('B1', 'ФИО автора')
    ->setCellValue('C1', 'Количество страниц')
    ->setCellValue('D1', 'Год выпуска')
    ->setCellValue('E1', 'Издатель');
$col = 2;
foreach ($data as $dataRow) {
    $phpExcel->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(1, $col, $dataRow['title'])
        ->setCellValueByColumnAndRow(2, $col, $dataRow['author'])
        ->setCellValueByColumnAndRow(3, $col, $dataRow['pages'])
        ->setCellValueByColumnAndRow(4, $col, $dataRow['pubYear'])
        ->setCellValueByColumnAndRow(5, $col, $dataRow['publisher']);
    $col++;
}
$writer = new Xlsx($phpExcel);
$writer->save('php://output');
exit();

