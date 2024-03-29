<?php
require_once '../api/products/add_product.php';
require_once '../utils/upload_image.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(!isset($_POST['name']) || strlen($_POST['name']) < 3) {
        die("Nom invalide");
    }
    $name = $_POST['name'];

    if(!isset($_POST['description']) || strlen($_POST['description']) < 3) {
        die("Description invalide");
    }
    $description = $_POST['description'];

    if(!isset($_POST['price']) || !is_numeric($_POST['price']) || $_POST['price'] < 0) {
        die("Prix invalide");
    }
    $price = $_POST['price'];

    if(!isset($_POST['category']) || !is_numeric($_POST['category'])) {
        die("Catégorie invalide");
    }
    $category = $_POST['category'];

    if(!isset($_FILES['image'])) {
        die("Image invalide");
    }
    $image = $_FILES['image'];

    $target_file = upload_image($image, "../uploads/products/");

    try {
        add_product_to_db($name, $description, $price, $category, $target_file);
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }

    if(isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: ../index.php?page=admin');
    }
   exit;
}




    