<?php
require_once '../api/users/delete_user.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!isset($_POST["id"]) || !is_numeric($_POST["id"])) {
        die("Invalid user ID");
    }
    $userId = $_POST["id"];
    try {
        delete_user_from_db($userId);
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
    if(isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        header("Location: ../index.php?page=admin");
    }
    exit;

}