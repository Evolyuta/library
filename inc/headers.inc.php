<?
$title = 'Сайт библиотеки';
$header = "Добро пожаловать на наш сайт!";
$id = strtolower(strip_tags(trim($_GET['id'])));
// Инициализация заголовков страницы
switch ($id) {
    case 'contact':
        $title = 'Контакты';
        $header = 'Обратная связь';
        break;
    case 'create':
        $title = 'Создание книги';
        $header = 'Добавление книги';
        break;
    case 'list':
        $title = 'Список книг';
        $header = 'Список имеющихся книг';
        break;
    case 'download':
        $title = 'Загрузить';
        $header = 'Загрузка списка';
        break;
}
