<?php
require_once 'components/menu/nav_menu.php';
require_once 'components/menu/user_menu.php';

function displayHeader() {
    global $title;
    $header = "<header>";
        $header .= "<div><h1>$title</h1></div>";
        $header .= menu_user();
        $header .= nav_menu();
    $header .= "</header>";
    return $header;
}

echo displayHeader();


