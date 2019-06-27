<?php
switch ($id) {
    case 'contact':
        include 'inc/contact.inc.php';
        break;
    default:
        include 'inc/index.inc.php';
}
