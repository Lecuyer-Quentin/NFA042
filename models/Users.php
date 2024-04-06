<?php

class Users
{
    private $pdo;
    private $table = 'Utilisateurs';
    public $id_utilisateur;
    public $nom;
    public $prenom;
    public $email;
    public $password;
    public $date_creation;
    public $id_role;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        extract($result);        
        return $result;
    }

    public function read_single($id)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_utilisateur = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($result);
        return $result;
    }

    public function check_user($email, $password)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }

    public function register_user($nom, $prenom, $email, $password, $id_role)
    {
        $query = 'INSERT INTO ' . $this->table . ' (nom, prenom, email, mot_de_passe, id_role) VALUES (:nom, :prenom, :email, :password, :id_role)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'password' => $password, 'id_role' => $id_role]);
        return $stmt;
    }
    public function update_user($nom, $prenom, $email, $id_role, $id_utilisateur)
    {
        $query = 'UPDATE ' . $this->table . ' SET nom = :nom, prenom = :prenom, email = :email, id_role = :id_role WHERE id_utilisateur = :id_utilisateur';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'id_role' => $id_role, 'id_utilisateur' => $id_utilisateur]);
        return $stmt;
    }
    public function delete_user($id_utilisateur)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_utilisateur = :id_utilisateur';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id_utilisateur' => $id_utilisateur]);
        return $stmt;
    }
}