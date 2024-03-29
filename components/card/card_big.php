<?php

function displayCardBig($product, $image) {
    $name = $product['nom'];
    $price = $product['prix'];
    $price = number_format($price,2,'.','');
    
    echo "<div class='card_big'>";
        echo "<span>$price €</span>";
        echo "<img src='$image' alt='$name'>";
    echo "</div>";
}