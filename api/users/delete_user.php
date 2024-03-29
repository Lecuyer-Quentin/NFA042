<?php
require_once '../api/db_connect.php';
function delete_user_from_db($userId) {
    global $pdo;

    $sql = "DELETE FROM Utilisateurs WHERE id_utilisateur = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);
}