<?php

require_once 'components/card/card_small.php';
require_once 'api/products/get_products.php';
require_once 'utils/get_image.php';


function order_by_date($a, $b) {
    return strtotime($a['date_creation']) - strtotime($b['date_creation']);
}

function render_products() {
    $products = get_products();
    usort($products, 'order_by_date');
    $products = array_slice($products, 0, 3);
    echo "<div class='carousel'>";
        foreach($products as $product) {
            $image = get_image($product['id_produit']);
            card_small($product, $image);
        }
    echo "</div>";
}

function displayHero() {
    $title = 'Les produits du Moment';
    echo "<section>";
    echo "<h2>$title</h2>";
    render_products();
    echo "</section>";
}

displayHero();