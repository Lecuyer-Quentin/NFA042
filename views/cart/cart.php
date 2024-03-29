<?php

require_once 'components/card/card_small.php';
require_once 'components/form/form.php';
require_once 'utils/get_session_cart.php';

function displayCart() {
    $products = get_session_cart()['products'];
    $total = get_session_cart()['total'];

    echo "<section>";
        echo "<h3>Panier</h3>";
        if (count($products) > 0) {
            displayProductsInCart($products);
        } else {
            displayEmptyCart();
        }
        echo "<p>Total: $total €</p>";
        generateForm([
            'class' => 'addToCart',
            'submit' => 'Payer',
            'action' => 'actions/payment.php',
            'fields' => [['type' => 'hidden', 'name' => 'total', 'value' => $total, 'required' => 'required']],
        ]);
        generateForm([
            'class' => 'addToCart',
            'submit' => 'Vider le panier',
            'action' => 'actions/delete_cart.php',
            'fields' => [],
        ]);
    echo "</section>";
}

function displayProductsInCart($products) {
    echo "<ul style='display: flex; flex-direction: column; align-items: center; width: 100%;'>";
    foreach ($products as $product) {
        echo "<li style='display: flex; flex-direction: row; align-items: center; justify-content: center; width: 100%;'>";
            displayCartItem($product);
        echo "</li>";
    }
    echo "</ul>";
}
function displayEmptyCart() {
    echo "<p>Votre panier est vide</p>";
} 

function displayCartItem($product) {
    $id = $product['id_produit'];
    $name = $product['nom'];
    $description = $product['description'];
    $price = isset($product['prix']) ? $product['prix'] : 0; //??
    $quantity = $product['quantity'];
    $total = $price * $quantity;
    
    //! déplacer le style
    $style = "style='
        position: relative;
        display: flex;
        justify-content: space-between;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    '";

    echo "<div $style>";
        echo "<div style='width: 70%;'>";
            echo "<h3>$name</h3>";
            echo "<p>$description</p>";
            echo "<p>Quantité : $quantity</p>";

        echo "</div>";
        echo "<div style='display: flex; flex-direction: column; align-items: center;'>";
            echo "<p>Prix : $price €</p>";
            echo "<p>Total : $total €</p>";
        echo "</div>";

        echo "<div style='position: absolute; bottom: 0; right: 0; display: flex; flex-direction: row; '>";
            generateForm([
                'class' => 'addToCart',
                'submit' => 'Retirer',
                'action' => 'actions/remove_from_cart.php',
                'fields' => [
                    ['type' => 'hidden', 'name' => 'id', 'value' => $id, 'required' => 'required'],
                    ['type' => 'hidden', 'name' => 'quantity', 'value' => 1, 'required' => 'required'],
                ],
            ]);
            generateForm([
                'class' => 'addToCart',
                'submit' => 'Ajouter',
                'action' => 'actions/add_to_cart.php',
                'fields' => [
                    ['type' => 'hidden', 'name' => 'id', 'value' => $id, 'required' => 'required'],
                    ['type' => 'hidden', 'name' => 'quantity', 'value' => 1, 'required' => 'required'],
                ],
            ]);
        echo "</div>";

    echo "</div>";
}  

displayCart();

