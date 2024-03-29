<?php
session_start();

function addToCart($productId, $quantity) {

    // Initialiser le panier s'il n'existe pas
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Ajouter le produit au panier ou augmenter la quantité si le produit est déjà dans le panier
    if(isset($_SESSION['cart'][$productId])){
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
    // Enregistrer le panier dans un cookie depuis la session
    setcookie('cart', json_encode($_SESSION['cart']), time() + 3600 * 24 * 7);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider l'ID du produit
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        die("Invalid product ID");
    }
    $productId = $_POST['id'];

    // Valider la quantité
    if (!isset($_POST['quantity']) || !is_numeric($_POST['quantity']) || $_POST['quantity'] < 1) {
        die("Invalid quantity");
    }
    $quantity = $_POST['quantity'];

    addToCart($productId, $quantity);

    //$url = $_POST['url'];

    // Rediriger l'utilisateur vers la page d'ou il vient
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        // Fallback en cas de non disponibilité de HTTP_REFERER
        header('Location: ../index.php');
    }
    exit;
}