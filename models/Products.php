<?php


class Products
{
    private $pdo;
    private $table = 'Produits';
    public $id_produit;
    public $nom;
    public $description;
    public $prix;
    public $image;
    public $id_categorie;
    public $date_creation;
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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_produit = :id_produit';
        $stmt = $this->pdo->prepare($query);
        $stmt -> bindParam(':id_produit', $this->id_produit);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($result);
        return $result;
    }public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET nom = :nom, description = :description, prix = :prix, image = :image, id_categorie = :id_categorie';
        $nom = htmlspecialchars(strip_tags($this->nom));
        $description = htmlspecialchars(strip_tags($this->description));
        $prix = htmlspecialchars(strip_tags($this->prix));
        $image = htmlspecialchars(strip_tags($this->image));
        $id_categorie = htmlspecialchars(strip_tags($this->id_categorie));
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id_categorie', $id_categorie);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET nom = :nom, description = :description, prix = :prix, image = :image, id_categorie = :id_categorie WHERE id_produit = :id_produit';
        $nom = htmlspecialchars(strip_tags($this->nom));
        $description = htmlspecialchars(strip_tags($this->description));
        $prix = htmlspecialchars(strip_tags($this->prix));
        $image = htmlspecialchars(strip_tags($this->image));
        $id_categorie = htmlspecialchars(strip_tags($this->id_categorie));
        $id = htmlspecialchars(strip_tags($this->id_produit));
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id_categorie', $id_categorie);
        $stmt->bindParam(':id_produit', $id);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_produit = :id_produit';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_produit', $this->id_produit);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function search()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE nom LIKE ? OR description LIKE ?';
        $stmt = $this->pdo->prepare($query);
        $keywords = htmlspecialchars(strip_tags($this->keywords));
        $keywords = "%{$keywords}%";
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        extract($result);
        return $result;
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
//
    //public function search($keywords)
    //{
    //    $query = 'SELECT * FROM ' . $this->table . ' WHERE name LIKE ? OR description LIKE ?';
    //    $stmt = $this->pdo->prepare($query);
    //    $keywords = htmlspecialchars(strip_tags($keywords));
    //    $keywords = "%{$keywords}%";
    //    $stmt->bindParam(1, $keywords);
    //    $stmt->bindParam(2, $keywords);
    //    $stmt->execute();
    //    return $stmt;
    //}
//
    //public function read_category()
    //{
    //    $query = 'SELECT * FROM ' . $this->table . ' WHERE category_id = ?';
    //    $stmt = $this->pdo->prepare($query);
    //    $stmt->bindParam(1, $this->category_id);
    //    $stmt->execute();
    //    return $stmt;
    //}
//
    //public function read_paging($from_record_num, $records_per_page)
    //{
    //    $query = 'SELECT * FROM ' . $this->table . ' LIMIT ?, ?';
    //    $stmt = $this->pdo->prepare($query);
    //    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    //    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    //    $stmt->execute();
    //    return $stmt;
    //}
    //public function read_page($from_record_num, $records_per_page)
    //{
    //    $query = 'SELECT * FROM ' . $this->table . ' LIMIT ?, ?';
    //    $stmt = $this->pdo->prepare($query);
    //    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    //    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    //    $stmt->execute();
    //    return $stmt;
    //}

}

