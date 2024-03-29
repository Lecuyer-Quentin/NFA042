<?php
require_once 'api/products/get_product.php';

function get_session_cart() {
    $total = 0;
    $product = [];
    $products = [];

    if(isset($_SESSION['cart'])) {
        //$cart_items = $_SESSION['cart'];
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $id = $product_id;
            // récupération des produits dans la base de données
            $product[$id] = get_product($id);
            // ajout de la quantité au tableau temporaire
            $product[$id]['quantity'] = $quantity;
            // récupération des produits dans le tableau temporaire
            array_push($products, $product[$id]);
        }
        // calcul du total
        foreach ($products as $product) {
            $total += $product['prix'] * $product['quantity'];
        }
    } else {
        
        //$cart_items = [];
    }
    return ['products' => $products, 'total' => $total];
}

