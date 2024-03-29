<?php
require_once '../api/db_connect.php';

function delete_product_from_db($id) {
    global $pdo;

    $sql = "DELETE FROM Produits WHERE id_produit = :id";
    $stmt = $pdo->prepare($sql);
    
    $params = [
        ':id' => $id
    ];
    if($stmt){
        try {
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}