<?php
require 'assets/data/temp_data.php';

function item_btn($value, $key) {
    echo "<a class='menu_btn' href='$value'>$key</a>";
}

function menu_item() {
    global $menu_item;
    foreach ($menu_item as $key => $value) {
        echo "<li>";
            item_btn($value, $key);
        echo "</li>";
    }
}

function displayNavMenu() {
    echo "<nav><ul>";
        menu_item();
    echo "</ul></nav>";
}