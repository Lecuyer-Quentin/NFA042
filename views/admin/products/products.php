<?php
require_once 'products_table.php';

function admin_products_details(){
    echo '<section>';
    echo '<h3>Manage products</h3>';
        echo '<article>';
            admin_products_table();
        echo '</article>';
    echo '</section>';
}

admin_products_details();



