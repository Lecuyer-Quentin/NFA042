<?php
session_start();
require_once '../api/db_connect.php';

function checkUserInDB($email, $password) {
    global $pdo;

    //? on récupère l'utilisateur avec l'email
    $sql = "SELECT * FROM Utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    
    //? on vérifie si le mot de passe correspond
    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}