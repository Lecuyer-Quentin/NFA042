<?php
require 'assets/data/temp_data.php';

function item_btn($value, $key) {
    echo '<div class="button">';
    
    echo "<a href='$value'>";
    echo '<span class="hoverBtn"></span>';
    echo '<span class="hoverBtn-bottom"></span>';
    echo "<p>$key</p>";
    echo '</a>';
   echo ' </div>';
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
    echo "<nav>";
        echo "<ul>";
            menu_item();
        echo "</ul>";
    echo "</nav>";
}