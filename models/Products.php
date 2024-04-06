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
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_produit = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($result);
        return $result;
    }
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET nom = :nom, description = :description, prix = :prix, image = :image, id_categorie = :id_categorie';
        $stmt = $this->pdo->prepare($query);
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->prix = htmlspecialchars(strip_tags($this->prix));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->id_categorie = htmlspecialchars(strip_tags($this->id_categorie));
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    //public function update()
    //{
    //    $query = 'UPDATE ' . $this->table . ' SET name = :name, description = :description, price = :price, image = :image, category_id = :category_id WHERE id = :id';
    //    $stmt = $this->pdo->prepare($query);
    //    $this->name = htmlspecialchars(strip_tags($this->name));
    //    $this->description = htmlspecialchars(strip_tags($this->description));
    //    $this->price = htmlspecialchars(strip_tags($this->price));
    //    $this->image = htmlspecialchars(strip_tags($this->image));
    //    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    //    $this->id = htmlspecialchars(strip_tags($this->id));
    //    $stmt->bindParam(':name', $this->name);
    //    $stmt->bindParam(':description', $this->description);
    //    $stmt->bindParam(':price', $this->price);
    //    $stmt->bindParam(':image', $this->image);
    //    $stmt->bindParam(':category_id', $this->category_id);
    //    $stmt->bindParam(':id', $this->id);
    //    if ($stmt->execute()) {
    //        return true;
    //    }
    //    printf("Error: %s.\n", $stmt->error);
    //    return false;
    //}
    //public function create()
    //{
    //    $query = 'INSERT INTO ' . $this->table . ' SET name = :name, description = :description, price = :price, image = :image, category_id = :category_id';
    //    $stmt = $this->pdo->prepare($query);
    //    $this->name = htmlspecialchars(strip_tags($this->name));
    //    $this->description = htmlspecialchars(strip_tags($this->description));
    //    $this->price = htmlspecialchars(strip_tags($this->price));
    //    $this->image = htmlspecialchars(strip_tags($this->image));
    //    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    //    $stmt->bindParam(':name', $this->name);
    //    $stmt->bindParam(':description', $this->description);
    //    $stmt->bindParam(':price', $this->price);
    //    $stmt->bindParam(':image', $this->image);
    //    $stmt->bindParam(':category_id', $this->category_id);
    //    if ($stmt->execute()) {
    //        return true;
    //    }
    //    printf("Error: %s.\n", $stmt->error);
    //    return false;
    //}
//
    //public function delete()
    //{
    //    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    //    $stmt = $this->pdo->prepare($query);
    //    $this->id = htmlspecialchars(strip_tags($this->id));
    //    $stmt->bindParam(':id', $this->id);
    //    if ($stmt->execute()) {
    //        return true;
    //    }
    //    printf("Error: %s.\n", $stmt->error);
    //    return false;
    //}
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
    public function count()
    {
        $query = 'SELECT COUNT(*) as total_ligne FROM ' . $this->table;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_ligne'];
    }
}

