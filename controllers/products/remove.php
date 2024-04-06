<?php
require_once '../api/products/delete_product.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
   if(!isset($_POST['id']) || !is_numeric($_POST['id'])) {
       die('Invalid product ID');
   }
    $productId = $_POST['id'];
    try {
        delete_product_from_db($productId);
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