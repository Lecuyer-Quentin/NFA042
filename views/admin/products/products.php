<?php
require_once 'table.php';

function products_details(){
    $details = '<section>';
    $details .= '<h3>Manage products</h3>';
        $details .= display_product_table();
    $details .= '</section>';

    return $details;
}

echo products_details();



