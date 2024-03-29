<?php

require_once '../api/db_connect.php';

function add_product_to_db($name, $description, $price, $category, $image) {
    global $pdo;

    $sql = "INSERT INTO Produits (nom, description, prix, id_categorie, image) VALUES (:name, :description, :price, :category, :image)";
    $stmt = $pdo->prepare($sql);
    
    $params = [
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':category' => $category,
        ':image' => $image,
    ];
    if($stmt){
        try {
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
