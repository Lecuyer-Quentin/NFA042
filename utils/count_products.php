<?php

function countProduct() {
    $count = 0;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $count += $quantity;
        }
    } else {
        $count = 0;
    }
    return $count;
}