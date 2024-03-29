<?php
require_once 'api/products/get_products.php';
require_once 'components/card/card_small.php';
require_once 'utils/get_image.php';

function order_by_date($a, $b) {
    return strtotime($a['date_creation']) - strtotime($b['date_creation']);
}

function displayProducts() {
    $all_products = get_products();

    usort($all_products, 'order_by_date');

    foreach ($all_products as $product) {
        $image = get_image($product['id_produit']);
        card_small($product, $image);
    }
}

displayProducts();