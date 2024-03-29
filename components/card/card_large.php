<?php

//! Optimiser la fonction (working)
function displayCategory($category) {
    require_once 'api/get_category.php';
    $array_category = get_category();
    $category = array_filter($array_category, function($c) use ($category) {
        $c['id_categorie'] === $category;
        return $c;
    });
    $category = array_values($category);
    $category = $category[0];
    echo "<p>$category[nom]</p>";
}


function card_large($product) {
    $id = $product['id_produit'];
    $name = $product['nom'];
    $img = $product['image'];
    $description = $product['description'];
    $price = $product['prix'];
    $category = $product['id_categorie'];
    $url = 'index.php?page=product&id=' . $id;
    
    echo "<a href='$url' class='card_large'>";
        echo "<div>";
            echo "<img src='$img' alt='$name'>";
            echo "<h2>$name</h2>";
            echo "<p>$description</p>";
            echo "<p>$price €</p>";
            echo "<p>$category</p>";
            displayCategory($category);
        echo "</div>";
    echo "</a>";
}