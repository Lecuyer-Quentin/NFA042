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
    public $keywords;

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
    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_utilisateur = :id_utilisateur';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_utilisateur', $this->id_utilisateur);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($result);
        return $result;
    }
    public function connect()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';
        $email = htmlspecialchars(strip_tags($this->email));
        $password = htmlspecialchars(strip_tags($this->password));
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }
    public function register()
    {
        $query = 'INSERT INTO ' . $this->table . ' (nom, prenom, email, mot_de_passe, id_role) VALUES (:nom, :prenom, :email, :password, :id_role)';
        $email = htmlspecialchars(strip_tags($this->email));
        $password = htmlspecialchars(strip_tags($this->password));
        $id_role = htmlspecialchars(strip_tags($this->id_role));
        $nom = htmlspecialchars(strip_tags($this->nom));
        $prenom = htmlspecialchars(strip_tags($this->prenom));
        $stmt = $this->pdo->prepare($query);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id_role', $id_role);
        $stmt->execute();
        return $stmt;
    }
    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET nom = :nom, prenom = :prenom, email = :email, id_role = :id_role WHERE id_utilisateur = :id_utilisateur';
        $nom = htmlspecialchars(strip_tags($this->nom));
        $prenom = htmlspecialchars(strip_tags($this->prenom));
        $email = htmlspecialchars(strip_tags($this->email));
        $id_role = htmlspecialchars(strip_tags($this->id_role));
        $id_utilisateur = htmlspecialchars(strip_tags($this->id_utilisateur));
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_role', $id_role);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt;
    }
    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_utilisateur = :id_utilisateur';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_utilisateur', $this->id_utilisateur);
        $stmt->execute();
        return $stmt;
    }
    public function count()
    {
        $query = 'SELECT COUNT(*) as total_ligne FROM ' . $this->table;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($result);
        return $result;
    }
    public function search()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ?';
        $stmt = $this->pdo->prepare($query);
        $keywords = htmlspecialchars(strip_tags($this->keywords));
        $keywords = "%{$keywords}%";
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        extract($result);
        return $result;
    }
}