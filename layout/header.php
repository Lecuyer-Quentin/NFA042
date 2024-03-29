<?php
require_once 'components/menu/nav_menu.php';
require_once 'components/menu/user_menu.php';

function displayHeader() {
    global $title;
    echo "<header>";
    echo "<div><h1>$title</h1></div>";
        menu_user();
        displayNavMenu();
        //displayUserMenu();
    echo "</header>";
}

displayHeader();

