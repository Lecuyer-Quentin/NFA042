<?php 
require_once '../api/users/update_user.php';


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        throw new Exception('ID invalide');
    }
    $id = $_POST['id'];
    if(!isset($_POST['nom']) || empty($_POST['nom'])) {
        throw new Exception('Nom invalide');
    }
    $nom = $_POST['nom'];
    if(!isset($_POST['prenom']) || empty($_POST['prenom'])) {
        throw new Exception('Prénom invalide');
    }
    $prenom = $_POST['prenom'];
    if(!isset($_POST['email']) || empty($_POST['email'])) {
        throw new Exception('Email invalide');
    }
    $email = $_POST['email'];
    if(!isset($_POST['role']) || !is_numeric($_POST['role'])) {
        throw new Exception('Role invalide');
    }
    $role = $_POST['role'];



    try{
        update_user_in_db($id, $nom, $prenom, $email, $role);
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }

    if($_SERVER['HTTP_REFERER']) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: /admin_users');
    }
}