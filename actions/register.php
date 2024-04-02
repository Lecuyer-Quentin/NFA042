<?php
require_once '../api/users/register_user.php';
require_once '../api/users/check_user.php';
require_once '../utils/error_message.php';



if($_SERVER['REQUEST_METHOD'] == "POST") {
    $error_register = [];
    $hashed_password = null;

    if(!isset($_POST['nom'])) {
        $error_register[] = translateErrorMessage('Error_001[NAME]');
    }
    $nom = $_POST['nom'];

    if(!isset($_POST['prenom'])) {
        $error_register[] = translateErrorMessage('Error[PRENOM]');
    }
    $prenom = $_POST['prenom'];

    if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_register[] = translateErrorMessage('Error[EMAIL]');
    }
    $email = $_POST['email'];
   
    if(!isset($_POST['password'])) {
        $error_register[] = translateErrorMessage('Error[PASSWORD]');
    }
    $password = $_POST['password'];

    if(!isset($_POST['password_confirm'])) {
        $error_register[] = translateErrorMessage('Error[PASSWORD_CONFIRM]');
    }
    $password_confirm = $_POST['password_confirm'];

    if(!isset($_POST['role']) || !is_numeric($_POST['role'])) {
        $error_register[] = translateErrorMessage('Error[ROLE]');
    }
    $role = $_POST['role'];

    //? Améliorer la gestion du mot de passe en ajoutant des contraintes de complexité
    //if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
    //     $error_register[] = translateErrorMessage('Error[PASSWORD_COMPLEXITY]');
    //}

    if($password !== $password_confirm) {
        $error_register[] = translateErrorMessage('Error[PASSWORD_CONFIRM]');   
    }
    
    if($password === $password_confirm) { 
        $hashed_password = password_hash($password_confirm, PASSWORD_BCRYPT);
        if ($hashed_password === false) {
            $error_register[] = translateErrorMessage('Error[HASH]');
        }
    }


    try{
        if(registerUserInDb($nom, $prenom, $email, $role, $hashed_password)) {
            if(checkUserInDB($email, $password)) {
                echo 'success';
            } else {
                $error_register[] = translateErrorMessage('Error[LOGIN]');
                echo implode('<br>', $error_register);
            }
        }
        exit();

    } catch (Exception $e) {
        $technical_error_message = $e->getMessage();
        $error_register[] = translateErrorMessage($technical_error_message);
        echo implode('<br>', $error_register);
    }
}
