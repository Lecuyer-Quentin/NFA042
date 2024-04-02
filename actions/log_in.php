<?php
require_once '../api/users/check_user.php';
require_once '../utils/error_message.php';


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
        if(checkUserInDB($email, $password)){
            echo 'success';
        } else {
            $error_login[] = translateErrorMessage('Error[LOGIN]');
            echo implode ('<br>', $error_login);
        }
        exit();
        
    } catch (Exception $e) {
        $technical_error_message = $e->getMessage();
        $error_login[] = translateErrorMessage($technical_error_message);
        echo implode ('<br>', $error_login);
    }
}