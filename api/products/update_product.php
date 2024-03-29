<?php
require_once '../api/db_connect.php';

function update_product_in_db($id, $newName, $newPrice, $newDescription) {
    global $pdo;

    $sql = "UPDATE Produits SET nom = :name, prix = :price, description = :description
            WHERE id_produit = :id";
    $stmt = $pdo->prepare($sql);
    
    $params = [
        ':name' => $newName,
        ':price' => $newPrice,
        ':description' => $newDescription,
        //':image' => 'image',
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