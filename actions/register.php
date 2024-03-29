<?php
require_once '../api/users/register_user.php';
require_once '../api/users/check_user.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(!isset($_POST['nom'])) {
        die("Veuillez entrer un nom");
    }
    $nom = $_POST['nom'];
    if(!isset($_POST['prenom'])) {
        die("Veuillez entrer un prénom");
    }
    $prenom = $_POST['prenom'];
    if(!isset($_POST['email'])) {
        die("Veuillez entrer un email");
    }
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email invalide");
    }
    if(!isset($_POST['password'])) {
        die("Veuillez entrer un mot de passe");
    }
    $password = $_POST['password'];
    if(!isset($_POST['password_confirm'])) {
        die("Veuillez confirmer le mot de passe");
    }
    $password_confirm = $_POST['password_confirm'];

    if(!isset($_POST['role']) || !is_numeric($_POST['role'])) {
        die("Invalid role");
    }
    $role = $_POST['role'];

    if($password !== $password_confirm) {
        die("Passwords do not match");
    }

    $hashed_password = password_hash($password_confirm, PASSWORD_BCRYPT);
    if ($hashed_password === false) {
        die("Password hashing failed");
    }

    try{
        registerUserInDb($nom, $prenom, $email, $role, $hashed_password);
        //! checkUserInDB ne fonctionne pas ICI
        //! mais l'utilisateur est bien enregistré
        if (checkUserInDB($email, $hashed_password)) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Invalid email or password";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}