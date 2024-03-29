<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(!isset($_POST['total']) || !is_numeric($_POST['total'])) {
        die('Invalid total');
    }

    //if(!isset($_POST['products']) || !is_array($_POST['products'])) {
    //    die('Invalid products');
    //}

    $total = $_POST['total'];
    //$products = $_POST['products'];

    //? Enregistrement de la commande dans la base de données
    //require_once '../api/orders/create_order.php';
    //$order_id = create_order($total);

    //? Enregistrement des produits de la commande dans la base de données
    //require_once '../api/orders/create_order_product.php';
    //foreach($products as $product) {
    //    $product_id = $product['id'];
    //    $quantity = $product['quantity'];
    //    create_order_product($order_id, $product_id, $quantity);
    //}

    //? Suppression du panier
    //require_once '../features/delete_session_cart.php';
    //delete_session_cart();

    if($_SERVER['HTTP_REFERER']) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: ../index.php?page=products');
    }
    exit;
} else {
    die('Invalid request');
}

