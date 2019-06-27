<?php
switch ($id) {
    case 'contact':
        include 'inc/contact.inc.php';
        break;
    case 'create':
        include 'library/create.php';
        break;
    default:
        include 'inc/index.inc.php';
}
