<?php
require_once 'db_connect.php';

function get_roles() {
    global $pdo;

    $sql = "SELECT * FROM Roles";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $roles = $stmt->fetchAll();
    return $roles;
}