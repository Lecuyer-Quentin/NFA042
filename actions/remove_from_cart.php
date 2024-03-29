<?php
session_start();

function removeFromCart($productId) {
    // Initialiser le panier s'il n'existe pas
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    //! réécrire cette fonction
    // Retirer le produit du panier
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]--;
        if ($_SESSION['cart'][$productId] <= 0) {
            unset($_SESSION['cart'][$productId]);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider l'ID du produit
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        die("Invalid product ID");
    }
    $productId = $_POST['id'];

    if (!isset($_POST['quantity']) || !is_numeric($_POST['quantity']) || $_POST['quantity'] < 1) {
        die("Invalid quantity");
    }
    $quantity = $_POST['quantity'];


    removeFromCart($productId);

     // Rediriger l'utilisateur vers la page d'ou il vient
     if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        // Fallback en cas de non disponibilité de HTTP_REFERER
        header('Location: ../index.php');
    }
    exit;
}