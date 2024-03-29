<?php
require_once 'api/db_connect.php';

function get_users_from_db() {
    global $pdo;

    $sql = "SELECT * FROM Utilisateurs";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    return $users;
   
}