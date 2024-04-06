<?php 

function card_small($product, $image) {
    $id = $product['id_produit'];
    $name = $product['nom'];
    $url = 'index.php?page=product&id=' . $id;
    
    $card = "<a href='$url' class='card_small'>";
        $card .= "<div>";
            $card .= "<img src='$image' alt='$name'>";
            $card .= "<span>$name</span>";
        $card .= "</div>";
    $card .= "</a>";
    return $card;
}
