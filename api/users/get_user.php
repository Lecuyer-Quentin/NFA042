<?php
require_once 'api/db_connect.php';

function get_user($id) {
    global $pdo;

    $sql = "SELECT * FROM Utilisateurs WHERE id_utilisateur = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
    
}