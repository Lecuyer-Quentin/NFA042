<?php
require_once 'api/db_connect.php';

function get_product($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM Produits WHERE id_produit = :id');
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();
    return $product;
}
