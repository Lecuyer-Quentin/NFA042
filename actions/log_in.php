<?php
session_start();
require_once '../api/users/check_user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider l'email
    if (!isset($_POST['email'])) {
        die("Invalid email");
    }
    $email = $_POST['email'];

    // Valider le mot de passe
    if (!isset($_POST['password'])) {
        die("Invalid password");
    }
    $password = $_POST['password'];

    // Authentifier l'utilisateur
    try{
        if (checkUserInDB($email, $password)) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Invalid email or password";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}