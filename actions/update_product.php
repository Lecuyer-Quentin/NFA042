<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../api/products/update_product.php';

    //! AJOUTER LES CONDITIONS DE VERIFICATION DES DONNEES
    $id = $_POST['id'];
    $newName = $_POST['name'];
    $newPrice = $_POST['price'];
    $newDescription = $_POST['description'];
    //$newImage = $_POST['image'];
    update_product_in_db($id, $newName, $newPrice, $newDescription);

    if($_SERVER['HTTP_REFERER']){
        header("Location: ".$_SERVER['HTTP_REFERER']);
    } else {
        header("Location: ../index.php");
    }
    exit;
}

