<?php
require_once 'components/card/card_big.php';
require_once 'api/products/get_product.php';
require_once 'components/form/form.php';
require_once 'utils/get_image.php';

$id_product = $_GET['id'];



function displayProductDetails($id_product) {
    $product_details = get_product($id_product);
    $product_image = get_image($id_product);
    $name = $product_details['nom'];
    $description = $product_details['description'];
    $price = $product_details['prix'];

    echo "<section>";
        echo "<h3>$name</h3>";
        displayCardBig($product_details, $product_image);

        echo "<article>";
            echo "<p>$description</p>";
            echo "<p>$price €</p>";
            generateForm([
                'class' => 'action_btn',
                'submit' => 'Ajouter au panier',
                'action' => 'actions/add_to_cart.php',
                'fields' => [
                    ['type' => 'hidden', 'name' => 'id', 'value' => $id_product, 'required' => 'required'],
                    ['type' => 'hidden', 'name' => 'quantity', 'value' => 1, 'required' => 'required'],
                ],
            ]);
            generateForm([
                'class' => 'action_btn',
                'submit' => 'Retirer du panier',
                'action' => 'actions/remove_from_cart.php',
                'fields' => [
                    ['type' => 'hidden', 'name' => 'id', 'value' => $id_product, 'required' => 'required'],
                    ['type' => 'hidden', 'name' => 'quantity', 'value' => 1, 'required' => 'required'],
                ],
            ]);
        echo "</article>";
        echo "<a href='index.php?page=products'>Back to products</a>";
    echo "</section>";
}


if ($id_product) {
    displayProductDetails($id_product);
} else {
    echo "<p>Product not found</p>";
    echo "<a href='index.php?page=products'>Back to products</a>";
}