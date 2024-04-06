<?php
require_once 'class/Cart.php';

function countProducts() {
    $cart = new Cart();
    $count = 0;
    $products = $cart->getCart();
    foreach ($products as $product) {
        if (isset($product['quantity']) && is_numeric($product['quantity'])) {
            $count += $product['quantity'];
        }
    }
    return $count;
}