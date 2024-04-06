<?php
session_start();
require_once '../../models/Users.php';
require_once '../../config/database.php';
require_once '../../utils/error_message.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_login = [];

    if (!isset($_POST['email'])) {
        $error_login[] = translateErrorMessage('Error[EMAIL]');
    }
    $email = $_POST['email'];

    if (!isset($_POST['password'])) {
        $error_login[] = translateErrorMessage('Error[PASSWORD]');
    }
    $password = $_POST['password'];

    try{
        $user = new Users($pdo);
        $check_user = $user->check_user($email, $password);
        if($check_user){
            echo 'success';
            $_SESSION['user'] = $check_user;
        } else {
            $error_login[] = translateErrorMessage('Error[LOGIN]');
            echo implode ('<br>', $error_login);
        }
    } catch (Exception $e) {
        $technical_error_message = $e->getMessage();
        $error_login[] = translateErrorMessage($technical_error_message);
        echo implode ('<br>', $error_login);
    }
}