<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialiser le panier s'il n'existe pas
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Vider le panier
    $_SESSION['cart'] = [];
    // Rediriger l'utilisateur vers la page du panier
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        // Fallback en cas de non disponibilité de HTTP_REFERER
        header('Location: ../index.php?page=cart');
    }
    exit;
}
