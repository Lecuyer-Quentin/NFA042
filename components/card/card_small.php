<?php 

function card_small($product, $image) {
    $id = $product['id_produit'];
    $name = $product['nom'];
    $url = 'index.php?page=product&id=' . $id;
    
    echo "<a href='$url' class='card_small'>";
        echo "<div>";
            echo "<img src='$image' alt='$name'>";
            echo "<span>$name</span>";
        echo "</div>";
    echo "</a>";
}
