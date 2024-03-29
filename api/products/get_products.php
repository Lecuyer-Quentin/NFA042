<?php
require_once 'api/db_connect.php';

function get_products() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM Produits');
    $products = $stmt->fetchAll();
    return $products;
}
