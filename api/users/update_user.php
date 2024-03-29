<?php
require_once '../api/db_connect.php';

function update_user_in_db($id, $nom, $prenom, $email, $role) {
    global $pdo;

    $sql = "UPDATE Utilisateurs SET nom = :nom, prenom = :prenom, email = :email, id_role = :role WHERE id_utilisateur = :id";
    $stmt = $pdo->prepare($sql);

    $params = [
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':role' => $role,
        ':id' => $id
    ];
    
    if($stmt){
        try {
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}