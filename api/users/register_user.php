<?php
require_once '../api/db_connect.php';

function registerUserInDb($nom, $prenom, $email, $role, $password) {
    global $pdo;
    $sql = "INSERT INTO Utilisateurs (nom, prenom, email, id_role, mot_de_passe) VALUES (:nom, :prenom, :email, :role, :password)";
    $stmt = $pdo->prepare($sql);

    $params = [
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':role' => $role,
        ':password' => $password
    ];

    if($stmt){
        try {
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}